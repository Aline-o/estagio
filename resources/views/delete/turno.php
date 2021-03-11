<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('Turno',$data,array('idTurno'=>$_REQUEST['delId']));

	//$db->delete('Turno',array('idTurno'=>$_REQUEST['delId']));
	header('location: ../read/Turno.blade.php?msg=rdel');
	exit;
}
?>