<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('turma',$data,array('idTurma'=>$_REQUEST['delId']));
	//$db->delete('Turma',array('idTurma'=>$_REQUEST['delId']));
	header('location: ../read/turma.blade.php?msg=rdel');
	exit;
}
?>