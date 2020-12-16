<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	echo 'Você não pode excluir';

	/*$db->delete('Turno',array('idTurno'=>$_REQUEST['delId']));
	header('location: ../read/Turno.blade.php?msg=rds');*/
	exit;
}
?>