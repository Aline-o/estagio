<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	echo 'Você não pode excluir';

	/*$db->delete('NivelEnsino',array('idNivelEnsino'=>$_REQUEST['delId']));
	header('location: ../read/nivEnsino.blade.php?msg=rds');*/
	exit;
}
?>