<?php

/*
	[插件名称] 反馈表单
	[适用范围] 表单页
*/

function DDYuyueForm(){

	global $fsql,$tsql;


	$coltitle=$GLOBALS["PLUSVARS"]["coltitle"];
	$groupid=$GLOBALS["PLUSVARS"]["groupid"];
	$tempname=$GLOBALS["PLUSVARS"]["tempname"];

	$Temp=LoadTemp($tempname);
	$TempArr=SplitTblTemp($Temp);

	$var=array (
	'coltitle' => $coltitle,
	'groupname' => $groupname
	);

	$str=ShowTplTemp($TempArr["start"],$var);
	$str.=ShowTplTemp($TempArr["end"],$var);

	
	$GLOBALS["groupname"]=$groupname;
	$GLOBALS["pagetitle"]=$groupname;

	return $str;
	
}

?>