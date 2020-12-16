<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	echo 'Você não pode excluir';
/*
	$db->delete('escola',array('idEscola'=>$_REQUEST['delId']));
	header('location: ../read/escola.blade.php?msg=rds');*/
	exit;
}
?>