<?php if (!defined('THINK_PATH')) exit();?>$(document).ready(function (){ 
$("#<?php echo ($name); ?>province").change(function(){
var province = $(this).val();
 var count = 0; 
 $.ajax({
url:"/Plugins/Index/areas/", 
dataType:'json',
data:"area_id="+province,
success:function(json){ $("#<?php echo ($name); ?>city option").each(function(){
$(this).remove(); }); $("#<?php echo ($name); ?>area option").each(function(){
$(this).remove(); 
$("<option value=''>请选择</option>").appendTo("#<?php echo ($name); ?>area");});
 $(json).each(function(){ $("<option value='"+json[count].id+"'>"+json[count].name+"</option>").appendTo("#<?php echo ($name); ?>city"); count++; }); } }); });
$("#<?php echo ($name); ?>city").change(function(){ var province = $(this).val(); var
count = 0; $.ajax({ url:"/Plugins/Index/areas/", dataType:'json',data:"area_id="+province, success:function(json){ $("#<?php echo ($name); ?>areaoption").each(function(){ $(this).remove(); }); $(json).each(function(){
$("<option value='"+json[count].id+"'>"+json[count].name+"</option>").appendTo("#<?php echo ($name); ?>area"); count++; }); if(count>0) {
$("#<?php echo ($name); ?>area").show(); }else { $("#<?php echo ($name); ?>area").hide(); } } }); });
$("#<?php echo ($name); ?>area").change(function(){ }); });
document.write("<?php echo ($display); ?>");