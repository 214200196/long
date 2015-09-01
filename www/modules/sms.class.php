
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("sms.model.php");
class smsClass 
{
	function AddLog($data) 
	{
		$data ['addtime'] = time ();
		$data ['addip'] = get_client_ip ();
		return M ( 'sms_log')->add ( $data );
	}
	function Actionsms($data = array()) 
	{
		global $mysql;
		if (!IsExiest ( $data ['id'] )) return "sms_id_empty";
		if ($data ['type'] == "delete") 
		{
			$sql = "delete from `{approve_smslog}`  where id in ({$data['id']}
		)";
		M ()->execute ( presql ( $sql ) );
	}
	elseif ($data ['type'] == "yes") 
	{
		$sql = "update `{approve_smslog}`  set status=1 where id in ({$data['id']}
	) ";
	M ()->execute ( presql ( $sql ) );
}
elseif ($data ['type'] == "no") 
{
	$sql = "update `{approve_smslog}`  set status=2 where id in ({$data['id']}
) ";
M ()->execute ( presql ( $sql ) );
}
return $data ['id'];
}
public static function getSmslogList($data) 
{
$result = \approveClass::GetSmslogList ( $data );
return $result;
}
}
?>