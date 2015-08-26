<?php

namespace Plugins\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function areas() {
		if (IS_AJAX) {
			$city = I ( 'get.area_id' );
			$result = M ( 'areas' )->where ( "pid=$city" )->order ( '`order` desc,id asc' )->select ();
			$category ['id'] = "";
			$category ['name'] = "请选择";
			$categorys [0] = $category;
			if ($result != false) {
				foreach ( $result as $key => $row ) {
					$category = array ();
					$category ['id'] = $row ['id'];
					$category ['name'] = $row ['name'];
					$categorys [$key + 1] = $category;
				}
			}
			$this->ajaxReturn ( $categorys );
			exit ();
		}
		if (isset ( $_REQUEST ['value'] )) {
			$_REQUEST ['area'] = $_REQUEST ['value'];
		}
		
		$name = isset ( $_REQUEST ['name'] ) ? I ( 'request.name' ) : "";
		$type = ! isset ( $_REQUEST ['type'] ) ? "" : I ( 'request.type' );
		if ($type != "") {
			$_type = explode ( ",", $type );
		} else {
			$_type = array (
					"p",
					"c",
					"a" 
			);
		}
		
		$province_id = "";
		$city_id = "";
		$area_id = "";
		if (isset ( $_REQUEST ['area'] ) && $_REQUEST ['area'] != "") {
			$id = I ( 'request.area' );
			$sql = "select pid from {areas} where id=$id " . $order;
			$result1 = M ( 'areas' )->field ( "pid" )->where ( "id=$id" )->order ( '`order` desc,id asc' )->find ();
			if ($result1 == NULL)
				$result1 ['pid'] = 0;
			if ($result1 ['pid'] == 0) {
				$province_id = $id;
			} else {
				$result2 = M ( 'areas' )->field ( "pid" )->where ( "id={$result1 ['pid']}" )->order ( '`order` desc,id asc' )->find ();
				if ($result2 ['pid'] == 0) {
					$province_id = $result1 ['pid'];
					$city_id = $id;
				} else {
					$province_id = $result2 ['pid'];
					$city_id = $result1 ['pid'];
					$area_id = $id;
				}
			}
		}
		
		$_city = "";
		if ($province_id != "") {
			$city_res = M ( 'areas' )->where ( "pid=$province_id" )->order ( '`order` desc,id asc' )->select ();
			foreach ( $city_res as $key => $value ) {
				$sel = "";
				if ($value ['id'] === $city_id) {
					$sel = "selected";
				}
				$_city .= "<option value=" . $value ['id'] . " $sel>" . $value ['name'] . "</option>";
			}
		}
		
		$_area = "";
		if ($city_id != "") {
			$area_res = M ( 'areas' )->where ( "pid=$city_id" )->order ( '`order` desc,id asc' )->select ();
			foreach ( $area_res as $key => $value ) {
				$sel = "";
				if ($value ['id'] === $area_id) {
					$sel = "selected";
				}
				$_area .= "<option value=" . $value ['id'] . " $sel>" . $value ['name'] . "</option>";
			}
		}
		
		$sql = "select * from {areas} where pid=0" . $order;
		$result = M ( 'areas' )->where ( "pid=0" )->order ( '`order` desc,id asc' )->select ();
		;
		$_province = "";
		
		foreach ( $result as $key => $value ) {
			$sel = "";
			if ($value ['id'] === $province_id) {
				$sel = "selected";
			}
			$_province .= "<option value=" . $value ['id'] . " $sel>" . $value ['name'] . "</option>";
		}
		$p = "<select id='{$name}province' name='{$name}province'><option value=''>请选择</option>{$_province}</select>&nbsp;";
		$c = "<select id='{$name}city' name='{$name}city'><option value=''>请选择</option>{$_city}</select>&nbsp;";
		$a = "<select id='{$name}area' name='{$name}area'><option value=''>请选择</option>{$_area}</select>&nbsp;";
		$display = "";
		foreach ( $_type as $key => $value ) {
			$display .= $$value;
		}
		$this->assign ( 'name', $name );
		$this->assign ( 'display', $display );
		$this->display ();
	}
}