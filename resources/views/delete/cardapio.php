<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('Cardapio',$data,array('idCardapio'=>$_REQUEST['delId']));
	//$db->delete('Cardapio',array('idCardapio'=>$_REQUEST['delId']));
	header('location: ../read/Cardapio.blade.php?msg=rdel');
	exit;
}
?>