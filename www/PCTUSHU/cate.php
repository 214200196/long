<?php
/**
* @author: huliang
* @description: 无限分类示例
**/
header('Content-type: text/html; charset=gb2312');

//模拟数据格式,实际应用中可能数据来自于数据库
$array[] = array("id"=>1,"pid"=>0,"name"=>"计算机操作系统");
$array[] = array("id"=>2,"pid"=>0,"name"=>"探险");
$array[] = array("id"=>3,"pid"=>1,"name"=>"Linux 系统");
$array[] = array("id"=>4,"pid"=>1,"name"=>"Windows 系统");
$array[] = array("id"=>5,"pid"=>3,"name"=>"Linux相关网站");
$array[] = array("id"=>6,"pid"=>5,"name"=>"<a href='http://linuxpig.com' target='_blank'>Linuxpig.com</a>");
$array[] = array("id"=>7,"pid"=>5,"name"=>"<a href='http://linux.org' target='_blank'>Linux.org</a>");
$array[] = array("id"=>8,"pid"=>2,"name"=>"<a href='http://52risk.com' target='_blank'>52risk.com</a>");

showCategory($array);

function showCategory($array){
    $tree = array();
    if( $array ){
        foreach ( $array as $v ){
            $pid = $v['pid'];
            $list = @$tree[$pid] ?$tree[$pid] : array();
            array_push( $list, $v );
            $tree[$pid] = $list;
        }
    }

    //遍历输出根分类
    foreach($tree[0] as $k=>$v)
    {
        echo "$v[name]<br />";
        //遍历输出根分类相应的子分类
        if($tree[$v['id']]) drawTree($tree[$v['id']],$tree,0);
        echo "<div style='height:10px;'></div>";
    }
}

function drawTree($arr,$tree,$level)
{
    $level++;
    $prefix = str_pad("|",$level+1,'-',STR_PAD_RIGHT);
    foreach($arr as $k2=>$v2)
    {
        echo "$prefix$v2[name]<br />";
        if(isset($tree[$v2['id']])) drawTree($tree[$v2['id']],$tree,$level);

    }
}
?>