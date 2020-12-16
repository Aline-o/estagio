<?php 
include_once('../../../public/config.php');


if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	//echo 'Você não pode excluir';
	$db->delete('serie',array('idSerie'=>$_REQUEST['delId']));
	header('location: ../read/serie.blade.php?msg=rds');
	exit;
}
?>