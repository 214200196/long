<?php

/*
	[插件名称] 会员产品分类
	[适用范围] 所有页面
*/



function MemberProductClass(){

		global $msql,$fsql;

		$coltitle=$GLOBALS["PLUSVARS"]["coltitle"];
		$target=$GLOBALS["PLUSVARS"]["target"];
		$tempname=$GLOBALS["PLUSVARS"]["tempname"];

		//地址栏参数
		if(isset($_GET["mid"]) && $_GET["mid"]!="" && $_GET["mid"]!="0"){
			$mid=$_GET["mid"];
		}else{
			return "";
		}

		$mid=htmlspecialchars($mid);

		$scl="  memberid='$mid' ";





		//模版解释
		$Temp=LoadTemp($tempname);
		$TempArr=SplitTblTemp($Temp);

		
		$str=$TempArr["start"];

			
		$msql->query("select * from {P}_product_pcat where $scl order by xuhao");
		
		while($msql->next_record()){
				$catid=$msql->f("catid");
				$cat=$msql->f("cat");
				$link=ROOTPATH."product/memberproduct.php?mid=".$mid."&pcatid=".$catid;

				$var=array (
				'link' => $link, 
				'cat' => $cat, 
				'target' => $target
				);
				$str.=ShowTplTemp($TempArr["list"],$var);
	
		
		}
		
        $str.=$TempArr["end"];
       
		return $str;

		
}


?>