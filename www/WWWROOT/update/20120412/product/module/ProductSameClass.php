<?php

/*
	[�������] ͬ������
	[���÷�Χ] ����ҳ(��ʾ��ǰ���ͬһ������)
*/



function ProductSameClass(){

		global $msql,$fsql;


		$coltitle=$GLOBALS["PLUSVARS"]["coltitle"];
		$shownums=$GLOBALS["PLUSVARS"]["shownums"];
		$showtj=$GLOBALS["PLUSVARS"]["showtj"];
		$target=$GLOBALS["PLUSVARS"]["target"];
		$tempname=$GLOBALS["PLUSVARS"]["tempname"];


		//��ַ������
		if(strstr($_SERVER["QUERY_STRING"],".html")){
			$Arr=explode(".html",$_SERVER["QUERY_STRING"]);
			$nowcatid=$Arr[0];
		}elseif($_GET["catid"]>0){
			$nowcatid=$_GET["catid"];
		}else{
			$nowcatid=0;
		}

		$nowcatid=htmlspecialchars($nowcatid);
		
		if($nowcatid!="0"){
			$msql->query("select pid from {P}_product_cat where catid='$nowcatid'");
			if($msql->next_record()){
				$pid=$msql->f("pid");
			}else{
				$pid=0;
			}
		}else{
			$pid=0;
		}



		$scl=" pid='$pid' ";
		
		if($showtj!="" && $showtj!="0"){
			$scl.=" and tj='1' ";
		}


		//ģ�����
		$Temp=LoadTemp($tempname);
		$TempArr=SplitTblTemp($Temp);

		
		//ѭ����ʼ
		$var=array('coltitle' => $coltitle);
		$str=ShowTplTemp($TempArr["start"],$var);


		$msql->query("select * from {P}_product_cat where $scl order by xuhao");
		
		while($msql->next_record()){
				$pid=$msql->f("pid");
				$catid=$msql->f("catid");
				$cat=$msql->f("cat");
				$catpath=$msql->f("catpath");
				$ifchannel=$msql->f('ifchannel');
				if($ifchannel=="1"){
					$link=ROOTPATH."product/class/".$catid."/";
				}else{
					if($GLOBALS["CONF"]["CatchOpen"]=="1" && file_exists(ROOTPATH."product/class/".$catid.".html")){
						$link=ROOTPATH."product/class/".$catid.".html";
					}else{
						$link=ROOTPATH."product/class/?".$catid.".html";
					}
				}

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