<?php

/*
	[插件名称] 旋转显示图片特效
	[适用范围] 全站
*/

function ProductCarousel(){

	global $fsql,$msql;

		
		$coltitle=$GLOBALS["PLUSVARS"]["coltitle"];
		$showtj=$GLOBALS["PLUSVARS"]["showtj"];
		$cutword=$GLOBALS["PLUSVARS"]["cutword"];
		$cutbody=$GLOBALS["PLUSVARS"]["cutbody"];
		$target=$GLOBALS["PLUSVARS"]["target"];
		$catid=$GLOBALS["PLUSVARS"]["catid"];
		$projid=$GLOBALS["PLUSVARS"]["projid"];
		$picw=$GLOBALS["PLUSVARS"]["picw"];
		$pich=$GLOBALS["PLUSVARS"]["pich"];
		$tags=$GLOBALS["PLUSVARS"]["tags"];
		$tempname=$GLOBALS["PLUSVARS"]["tempname"];
		$tempcolor=$GLOBALS["PLUSVARS"]["tempcolor"];

		
		//本插件固定3张图片
		$shownums=6;


		//默认条件		
		$scl=" iffb='1' and catid!='0' ";

		if($showtj!="" && $showtj!="0"){
			$scl.=" and tj='1' ";
		}


		//显示分类规则:如果后台不指定分类,则显示当前所在分类,否则不限分类

		if($catid!=0 && $catid!=""){
			$catid=fmpath($catid);
			$scl.=" and catpath regexp '$catid' ";
		}

		//匹配专题
		if($projid!=0 && $projid!=""){
			$projid=fmpath($projid);
			$scl.=" and proj regexp '$projid' ";
		}



		//判断匹配标签
		if($tags!=""){
			$tags=$tags.",";
			$scl.=" and tags regexp '$tags' ";
		}


		//模版解释
		$Temp=LoadTemp($tempname);
		$TempArr=SplitTblTemp($Temp);

		$var=array(
			'coltitle' => $coltitle,
			'tempcolor' => $tempcolor
		);
		
		$str=ShowTplTemp($TempArr["start"],$var);

		$fsql->query("select * from {P}_product_con where $scl order by uptime desc limit 0,$shownums");

		while($fsql->next_record()){
			
			$id=$fsql->f('id');
			$title=$fsql->f('title');
			$catpath=$fsql->f('catpath');
			$dtime=$fsql->f('dtime');
			$nowcatid=$fsql->f('catid');
			$ifnew=$fsql->f('ifnew');
			$ifred=$fsql->f('ifred');
			$ifbold=$fsql->f('ifbold');
			$author=$fsql->f('author');
			$source=$fsql->f('source');
			$cl=$fsql->f('cl');
			$src[]=$fsql->f('src');
			$memo=$fsql->f('memo');

			

			if($GLOBALS["CONF"]["CatchOpen"]=="1" && file_exists(ROOTPATH."product/html/".$id.".html")){
				$link[]=ROOTPATH."product/html/".$id.".html";
			}else{
				$link[]=ROOTPATH."product/html/?".$id.".html";
			}
	

			if($cutword!="0"){$title=csubstr($title,0,$cutword);}
			if($cutbody!="0"){$memo=csubstr($memo,0,$cutbody);}


			//if($src==""){$src="product/pics/nopic.gif";}
			

		}
		
		//模版标签解释
		$var=array (
			'picw' => $picw,
			'pich' => $pich,
			'src1' => ROOTPATH.$src[0],
			'src2' => ROOTPATH.$src[1],
			'src3' => ROOTPATH.$src[2],
			'src4' => ROOTPATH.$src[3],
			'src5' => ROOTPATH.$src[4],
			'src6' => ROOTPATH.$src[5],
			'link1' => ROOTPATH.$link[0],
			'link2' => ROOTPATH.$link[1],
			'link3' => ROOTPATH.$link[2],
			'link4' => ROOTPATH.$link[3],
			'link5' => ROOTPATH.$link[4],
			'link6' => ROOTPATH.$link[5]
		);
		
		$str.=ShowTplTemp($TempArr["list"],$var);
		$str.=$TempArr["end"];

		return $str;

}

?>