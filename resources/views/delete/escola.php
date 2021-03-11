<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('escola',$data,array('idEscola'=>$_REQUEST['delId']));
	
//	$db->delete('escola',array('idEscola'=>$_REQUEST['delId']));
	header('location: ../read/escola.blade.php?msg=rdel');
	exit;
}
?>