<?php

/*
	[插件名称] 图片详情插件
	[适用范围] 详情页
*/


function PhotoContent(){

	global $fsql,$msql;


	$tempname=$GLOBALS["PLUSVARS"]["tempname"];


	//获取地址栏参数
	if(strstr($_SERVER["QUERY_STRING"],".html")){
		$idArr=explode(".html",$_SERVER["QUERY_STRING"]);
		$id=$idArr[0];
	}elseif(isset($_GET["id"]) && $_GET["id"]!=""){
		$id=$_GET["id"];
	}
	$id=htmlspecialchars($id);



	//模版解释
	$Temp=LoadTemp($tempname);
	$TempArr=SplitTblTemp($Temp);


	$fsql->query("select * from {P}_photo_con where id='$id'");
	if($fsql->next_record()){
		$catid=$fsql->f('catid');
		$catpath=$fsql->f('catpath');
		$memberid=$fsql->f('memberid');
		$memo=$fsql->f('memo');
		$dtime=$fsql->f('dtime');
		$title=$fsql->f('title');
		$source=$fsql->f('source');
		$author=$fsql->f('author');
		$iffb=$fsql->f('iffb');
		$cl=$fsql->f('cl');
		$secure=$fsql->f('secure');
		$src=$fsql->f('src');
		$tags=$fsql->f('tags');
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
		$zhichi=$fsql->f('zhichi');
		$fandui=$fsql->f('fandui');
		
	}else{
		$str.=$TempArr["err1"];
		return $str;
	}

	$fsql->query("update {P}_photo_con set cl=cl+1 where id='$id'");
	
	//发布校验-管理员可看
	if(AdminCheckModle()==false && $iffb!="1"){
		$str.=$TempArr["err1"];
		return $str;
	}

	//定义全局变量，使内容阅读权限限制时不生成静态页
	$GLOBALS["consecure"]=$secure;


	//页头标题定义
	$GLOBALS["pagetitle"]=$title;
	

	//判断阅读权限
	if($secure>0){
		if(AdminCheckModle()==false && (!isLogin() || $_COOKIE["SE"]<$secure)){
			$str.=$TempArr["err2"];
			return $str;
		}
	}

	//标签
	if($tags!=""){
		$tagsarr=explode(",",$tags);
		for($i=0;$i<sizeof($tagsarr);$i++){
			if($tagsarr[$i]!=""){
				$tagstr.="<a href='".ROOTPATH."photo/class/index.php?showtag=".urlencode($tagsarr[$i])."'>".$tagsarr[$i]."</a> ";
			}
		}
		$showtag="block";
	}else{
		$showtag="none";
	}

	//评论数
	$msql->query("select count(id) from {P}_comment where catid='2' and rid='$id'");
	if($msql->next_record()){
		$commentcount=$msql->f('count(id)');
	}

	//评分总和
	$msql->query("select sum(pj1) from {P}_comment where catid='2' and rid='$id'");
	if($msql->next_record()){
		$totalcent=$msql->f('sum(pj1)');
	}

	//计算平均分
	if($commentcount>0){
		$centavg=ceil($totalcent/$commentcount);
	}else{
		$centavg=0;
	}

	//评论网址
	$commentutl=ROOTPATH."comment/class/index.php?catid=2&rid=".$id;


	$dtime=date("Y-m-d H:i:s",$dtime);

	if($src==""){$src="photo/pics/nopic.gif";}
	$src=ROOTPATH.$src;

	if($memo!=""){
		$memo=nl2br($memo);
		$showmemo="block";
	}else{
		$showmemo="none";
	}

	
	//发布人网址
	if($memberid!="0"){
		$memberurl=ROOTPATH."member/home.php?mid=".$memberid;
	}else{
		$memberurl="#";
	}


	$var=array (
		'sitename' => $GLOBALS["CONF"]["SiteName"],
		'id' => $id, 
		'body' => $body, 
		'memo' => $memo, 
		'showmemo' => $showmemo, 
		'src' => $src, 
		'dtime' => $dtime, 
		'title' => $title, 
		'source' => $source, 
		'iffb' => $iffb, 
		'author' => $author, 
		'tagstr' => $tagstr, 
		'showtag' => $showtag, 
		'commentutl' => $commentutl, 
		'commentcount' => $commentcount, 
		'memberurl' => $memberurl, 
		'centavg' => $centavg, 
		'zhichi' => $zhichi, 
		'fandui' => $fandui, 
		'cl' => $cl
	);

    $str=ShowTplTemp($TempArr["start"],$var);


	
	/*
	//属性列
	$propstr=$TempArr["list"];

	$i=1;
	$msql->query("select * from {P}_photo_prop where catid='$catid' order by xuhao");
	while($msql->next_record()){
		$propname=$msql->f('propname');
		$pn="prop".$i;

		$pstr=str_replace("{#propname#}",$propname,$propstr);
		$pstr=str_replace("{#prop#}",$$pn,$pstr);

		$str.=$pstr;

	$i++;
	}


	$var=array (
		'id' => $id, 
		'memo' => $memo, 
		'src' => $src, 
		'dtime' => $dtime, 
		'title' => $title, 
		'source' => $source, 
		'iffb' => $iffb, 
		'author' => $author, 
		'cl' => $cl
	);

    $str.=ShowTplTemp($TempArr["end"],$var);
	*/

	$str.=$TempArr["end"];

	return $str;


}

?>