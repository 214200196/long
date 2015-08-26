<?php

/*
	[插件名称] 产品检索
	[适用范围] 分类检索页
*/ 


function ProductQuery(){

	global $fsql,$msql;

	
	
	$shownums=$GLOBALS["PLUSVARS"]["shownums"];
	$cutword=$GLOBALS["PLUSVARS"]["cutword"];
	$target=$GLOBALS["PLUSVARS"]["target"];
	$tempname=$GLOBALS["PLUSVARS"]["tempname"];
	$picw=$GLOBALS["PLUSVARS"]["picw"];
	$pich=$GLOBALS["PLUSVARS"]["pich"];
	$fittype=$GLOBALS["PLUSVARS"]["fittype"];
	$cutbody=$GLOBALS["PLUSVARS"]["cutbody"];
	

	//地址栏参数
	if(strstr($_SERVER["QUERY_STRING"],".html")){
		$Arr=explode(".html",$_SERVER["QUERY_STRING"]);
		$catid=$Arr[0];
	}elseif($_GET["catid"]>0){
		$catid=$_GET["catid"];
	}else{
		$catid=0;
	}

	$catid=htmlspecialchars($catid);

	$key=htmlspecialchars($_GET["key"]);
	$showtj=htmlspecialchars($_GET["showtj"]);
	$page=htmlspecialchars($_GET["page"]);
	$myord=htmlspecialchars($_GET["myord"]);
	$myshownums=htmlspecialchars($_GET["myshownums"]);
	$memberid=htmlspecialchars($_GET["memberid"]);
	$showtag=htmlspecialchars($_GET["showtag"]);


	if($myord==""){
		$myord="uptime";
	}

	if($myshownums!="" && $myshownums!="0"){
		$shownums=$myshownums;
	}





	//模版解释
	$Temp=LoadTemp($tempname);
	$TempArr=SplitTblTemp($Temp);

	$str=$TempArr["start"];


	$scl=" iffb='1' and catid!='0' ";

	if($catid!="0" && $catid!=""){
		$fmdpath=fmpath($catid);
		$scl.=" and catpath regexp '$fmdpath' ";
	}

	if($showtj!="" && $showtj!="all"){
	$scl.=" and tj='$showtj' ";

	}
	if($memberid!="" && $memberid!="all"){
	$scl.=" and memberid='$memberid' ";

	}


	if($key!=""){
		
		$scl.=" and (title regexp '$key' or memo regexp '$key') ";
	}
	
	if($showtag!=""){
		$scl.=" and tags regexp '$showtag' ";
	}

	
	include(ROOTPATH."includes/pages.inc.php");
	$pages=new pages;

	$totalnums=TblCount("_product_con","id",$scl);
	
	$pages->setvar(array("catid" => $catid,"myord" => $myord,"myshownums" => $myshownums,"showtj" => $showtj,"author" => $author,"key" => $key));

	$pages->set($shownums,$totalnums);		                          
		
	$pagelimit=$pages->limit();	  
	

	$fsql->query("select * from {P}_product_con where $scl order by $myord desc limit $pagelimit");

	while($fsql->next_record()){
		
		$id=$fsql->f('id');
		$title=$fsql->f('title');
		$catid=$fsql->f('catid');
		$catpath=$fsql->f('catpath');
		$dtime=$fsql->f('dtime');
		$nowcatid=$fsql->f('catid');
		$ifbold=$fsql->f('ifbold');
		$ifred=$fsql->f('ifred');
		$author=$fsql->f('author');
		$source=$fsql->f('source');
		$type=$fsql->f('type');
		$src=$fsql->f('src');
		$cl=$fsql->f('cl');
		$prop1=$fsql->f('prop1');
		$prop2=$fsql->f('prop2');
		$prop3=$fsql->f('prop3');
		$prop4=$fsql->f('prop4');
		$prop5=$fsql->f('prop5');
		$prop6=$fsql->f('prop6');
		$prop7=$fsql->f('prop7');
		$prop8=$fsql->f('prop8');
		$prop9=$fsql->f('prop9');
		$prop10=$fsql->f('prop10');
		$prop11=$fsql->f('prop11');
		$prop12=$fsql->f('prop12');
		$prop13=$fsql->f('prop13');
		$prop14=$fsql->f('prop14');
		$prop15=$fsql->f('prop15');
		$prop16=$fsql->f('prop16');
		$prop17=$fsql->f('prop17');
		$prop18=$fsql->f('prop18');
		$prop19=$fsql->f('prop19');
		$prop20=$fsql->f('prop20');
		$memo=$fsql->f('memo');

		$dtime=date("Y-m-d",$dtime);
		
		if($GLOBALS["CONF"]["CatchOpen"]=="1" && file_exists(ROOTPATH."product/html/".$id.".html")){
			$link=ROOTPATH."product/html/".$id.".html";
		}else{
			$link=ROOTPATH."product/html/?".$id.".html";
		}

		if($ifbold=="1"){$bold=" style='font-weight:bold' ";}else{$bold="";}
		if($ifred!="0"){$red=" style='color:".$ifred."' ";}else{$red="";}

		if($cutword!="0"){$title=csubstr($title,0,$cutword);}
		if($cutbody!="0"){$memo=csubstr($memo,0,$cutbody);}

		if($src==""){
			$src="product/pics/nopic.gif";
		}
		$src=ROOTPATH.$src;



		//参数列
		$propstr="";

		$i=1;
		$msql->query("select * from {P}_product_prop where catid='$catid' order by xuhao");
		while($msql->next_record()){
			$propname=$msql->f('propname');
			$pn="prop".$i;
			$pstr=str_replace("{#propname#}",$propname,$TempArr["m1"]);
			$pstr=str_replace("{#prop#}",$$pn,$pstr);

			$propstr.=$pstr;

		$i++;
		}



		$var=array (
		'id' => $id, 
		'title' => $title, 
		'propstr' => $propstr, 
		'dtime' => $dtime, 
		'red' => $red, 
		'author' => $author, 
		'source' => $source,
		'src' => $src, 
		'cl' => $cl, 
		'link' => $link,
		'target' => $target,
		'memo' => $memo,
		'picw' => $picw,
		'pich' => $pich,
		'bold' => $bold
		);

		$str.=ShowTplTemp($TempArr["list"],$var);
		

	}

	$str.=$TempArr["end"];

	$pagesinfo=$pages->ShowNow();

	$var=array (
	'fittype' => $fittype,
	'showpages' => $pages->output(1),
	'pagestotal' => $pagesinfo["total"],
	'pagesnow' => $pagesinfo["now"],
	'pagesshownum' => $pagesinfo["shownum"],
	'pagesfrom' => $pagesinfo["from"],
	'pagesto' => $pagesinfo["to"],
	'totalnums' => $totalnums
	);

	$str=ShowTplTemp($str,$var);

	return $str;


}
?>