<?php

/*
	[插件名称] 自定网页模块导航条
	[适用范围] 自定网页模块
*/


function PageNavPath(){

	global $msql;


	$coltitle=$GLOBALS["PLUSVARS"]["coltitle"];
	$tempname=$GLOBALS["PLUSVARS"]["tempname"];
	$pagename=$GLOBALS["PLUSVARS"]["pagename"];

	$Temp=LoadTemp($tempname);
	$TempArr=SplitTblTemp($Temp);
	
	$Arr=explode("_",$pagename);
	$title=$Arr[1];

	$msql->query("select * from {P}_page where pagefolder='$title'");

		while($msql->next_record()){
			$title=$msql->f('title');

		}
	$var=array (
		'sitename' => $GLOBALS["CONF"]["SiteName"],
		'channel' => $title,
	);

	$str=ShowTplTemp($TempArr["start"],$var);



	$str.=$TempArr["end"];
	return $str;
}

?>