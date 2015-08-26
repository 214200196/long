<?php
if(!defined('InEmpireBak'))
{
	exit();
}

//Database
$phome_db_ver="5.0";
$phome_db_server="localhost";
$phome_db_port="";
$phome_db_username="root";
$phome_db_password="s0LDbUppXM";
$phome_db_dbname="thinkchuangzao";
$baktbpre="";
$phome_db_char="utf8";

//USER
$set_username="czcadnijgk";
$set_password="8f920c483e1de1583e1586b8506c7792";
$set_loginauth="pnE5bBpfX30";
$set_loginrnd="YFfd33mV2MrKwDenkecYWZETWgUwMV";
$set_outtime="60";
$set_loginkey="0";

//COOKIE
$phome_cookiedomain="";
$phome_cookiepath="/";
$phome_cookievarpre="ebak_";

//LANGUAGE
$langr=ReturnUseEbakLang();
$ebaklang=$langr['lang'];
$ebaklangchar=$langr['langchar'];

//BAK
$bakpath="bdata";
$bakzippath="zip";
$filechmod="1";
$phpsafemod="";
$php_outtime="1000";
$limittype="";
$canlistdb="";

//------------ SYSTEM ------------
HeaderIeChar();
?>