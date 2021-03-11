<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('ModalidadeEnsino',$data,array('idModalidadeEnsino'=>$_REQUEST['delId']));
	
	//$db->delete('ModalidadeEnsino',array('idModalidadeEnsino'=>$_REQUEST['delId']));
	header('location: ../read/modEnsino.blade.php?msg=rdel');
	exit;
}
?>