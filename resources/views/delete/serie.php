<?php 
// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
    	// Status 1 são valores não "deletados" pelo usuario
		'Status'=>0,
	);
	$update	=	$db->update('serie',$data,array('idSerie'=>$_REQUEST['delId']));
	// mensagem deletado
	header('location: ../read/serie.blade.php?msg=rdel');
	exit;
}
?>