<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	echo 'Você não pode excluir';
	
	//$db->delete('ModalidadeEnsino',array('idModalidadeEnsino'=>$_REQUEST['delId']));
	//header('location: ../read/modEnsino.blade.php?msg=rds');
	exit;
}
?>