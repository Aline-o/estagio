<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('NivelEnsino',$data,array('idNivelEnsino'=>$_REQUEST['delId']));

	//$db->delete('NivelEnsino',array('idNivelEnsino'=>$_REQUEST['delId']));
	header('location: ../read/nivEnsino.blade.php?msg=rdel');
	exit;
}
?>