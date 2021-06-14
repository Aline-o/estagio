<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('patologia',$data,array('idPatologia'=>$_REQUEST['delId']));
	
	//$db->delete('ModalidadeEnsino',array('idModalidadeEnsino'=>$_REQUEST['delId']));
	header('location: ../read/patologia.blade.php?msg=rdel');
	exit;
}
?>