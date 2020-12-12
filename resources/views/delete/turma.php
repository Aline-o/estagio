<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$db->delete('Turma',array('idTurma'=>$_REQUEST['delId']));
	header('location: ../read/Turma.blade.php?msg=rds');
	exit;
}
?>