<?php

namespace Think\Template\TagLib;

use Think\Template\TagLib;

class Zi extends TagLib {
	// 标签定义
	protected $tags = array (
			
			// 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
			'select' => array (
					'attr' => 'select_name,table,name,value,selected,result',
					'close' => 0 
			),
			'input' => array (
					'attr' => 'type,name,value,checked',
					'close' => 0 
			),
			'linkages' => array (
					'attr' => 'name,nid,type,checked,default',
					'close' => 0 
			),
			'digit' => array (
					'attr' => 'name,start,end,default,value,style',
					'close' => 0 
			) 
	);
	public function _select($tag) {
		$select_name = $tag ['select_name'];
		$table = $tag ['table'];
		$name = $tag ['name'];
		$value = $tag ['value'];
		$selected = $tag ['selected'];
		$result = $tag ['result'];
		if ($result == '')
			$parseStr = '<?php $odata=M("' . $table . '")->getField("' . "$value,$name" . '") ?>';
		else
			$parseStr = '<?php $odata=$' . $result . '?>';
		$parseStr .= "<select name='$select_name' id='$select_name'>";
		$parseStr .= "<option >请选择</option>";
		$parseStr .= '<?php foreach($odata as $key=>$val){ ?>';
		if (! empty ( $selected )) {
			$parseStr .= '<?php if(is_array($val)) {?>';
			$parseStr .= '<?php if($val["' . $value . '"]==$' . $selected . '){?>';
			$parseStr .= '<option selected="selected" value="<?php echo $val["' . $value . '"] ?>"><?php echo $val["' . $name . '"] ?></option>';
			$parseStr .= '<?php }else {?><option value="<?php echo $val["' . $value . '"] ?>"><?php echo $val["' . $name . '"] ?></option><?php }?>';
			$parseStr .= '<?php }else{?>';
			$parseStr .= '<?php if($key==$' . $selected . '){?>';
			$parseStr .= '<option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option>';
			$parseStr .= '<?php }else {?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php }?>';
			$parseStr .= '<?php } }?>';
		} else {
			$parseStr .= '<option value="<?php echo $key ?>"><?php echo $val ?></option>';
			$parseStr .= '<?php }?>';
		}
		$parseStr .= "</select>";
		return $parseStr;
	}
	public function _input($tag) {
		$type = $tag ['type'];
		$name = $tag ['name'];
		$value = $tag ['value'];
		$checked = $tag ['checked'];
		if ($checked != '' && ! is_numeric ( $checked ))
			$checked = $this->autoBuildVar ( $checked );
		if ($type == 'radio') {
			if (! empty ( $checked )) {
				$parseStr = '<?php	$_value = explode(",","' . $value . '");?>';
				$parseStr .= '<?php foreach ($_value as $k => $v){
			             $_check = "";
			             $_v = explode("|",$v);';
				$parseStr .= 'if ($_v[0]==' . $checked . '){
				$_check = " checked=\'checked\'";} ?>';
				$parseStr .= '<input type="radio" value="<?php echo $_v[0]; ?>"  name="' . $name . '" <?php echo $_check; ?>/> <?php echo $_v[1]; ?>';
				$parseStr .= '<?php } ?>';
				return $parseStr;
			} else {
				$parseStr = '<?php	$_value = explode(",","' . $value . '");?>';
				$parseStr .= '<?php foreach ($_value as $k => $v){ $_v = explode("|",$v);?>';
				$parseStr .= '<input type="radio" value="<?php echo $_v[0]; ?>" name="' . $name . '"/> <?php echo $_v[1]; ?>';
				$parseStr .= '<?php } ?>';
				return $parseStr;
			}
		}
	}
	public function _linkages($tag) {
		global $_G;
		$name = $tag ['name'];
		$nid = $tag ['nid'];
		$type = $tag ['type'];
		$checked = $tag ['checked'];
		$default = $tag ['default'];
		if ($checked != '' && ! is_numeric ( $checked ))
			$checked = $this->autoBuildVar ( $checked );
		$parseStr = "<?php \$result=\$_G ['_linkages']['{$nid}']; ?>";
		$parseStr .= "<select name='$name' id=$name>";
		if ($default != '') {
			$parseStr .= "<option value=''>$default</option>";
		}
		$parseStr .= "<?php foreach(\$result as \$key=>\$val) {?>";
		
		if ($checked != '') {
			$parseStr .= '<?php $select="";?>';
			$parseStr .= '<?php if($val["' . $type . '"]==' . $checked . ') $select="selected=\'selected\'";?>';
		}
		$parseStr .= "<option value='<?php echo \$val['$type'];?>' <?php echo \$select;?>><?php echo \$val['name']?></option>";
		$parseStr .= "<?php }?>";
		$parseStr .= '</select>';
		return $parseStr;
	}
	public function _digit($tag) {
		global $_G;
		foreach ( $tag as $_key => $_val ) {
			switch ($_key) {
				case 'name' :
					$$_key = ( string ) $_val;
					break;
				case 'start' :
					$$_key = ( string ) $_val;
					break;
				case 'end' :
					$$_key = $_val;
					break;
				case 'default' :
					$$_key = $_val;
					break;
				case 'value' :
					$$_key = $_val;
					break;
				case 'style' :
					$$_key = $_val;
					break;
				default :
					trigger_error ( "years: extra attribute '$_key' cannot be an array", E_USER_NOTICE );
					break;
			}
		}
		$display = "<?php";
		
		$parseStr = "<select name='$name' id='$name'  style='$style'>";
		if ($default != "") {
			$display .= " echo \"<option value=''>" . urldecode ( $default ) . "</option>\";";
			$parseStr .= "<option value=''>" . urldecode ( $default ) . "</option>";
		}
		if ($start < $end) {
			$parseStr .= "<?php for(\$i=$start;\$i<=$end;\$i++){?>";
			$parseStr .= "<?php if (\$i==$value){ ?>";
			$parseStr .= "<option value='<?php echo \$i;?>' selected><?php echo \$i;?></option>";
			$parseStr .= "<?php }else{?>";
			$parseStr .= "<option value='<?php echo \$i;?>' ><?php echo \$i;?></option>";
			$parseStr .= "<?php }}?>";
		} else {
			$parseStr .= "<?php for(\$i=$start;\$i>=$end;\$i--){?>";
			$parseStr .= "<?php if (\$i==$value){ ?>";
			$parseStr .= "<option value='<?php echo \$i;?>' selected><?php echo \$i;?></option>";
			$parseStr .= "<?php }else{?>";
			$parseStr .= "<option value='<?php echo \$i;?>' ><?php echo \$i;?></option>";
			$parseStr .= "<?php }}?>";
		}
		$parseStr .= '</select>';
		return $parseStr;
	}
}