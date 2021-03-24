<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('aluno',$data,array('Matricula'=>$_REQUEST['delId']));
	//$db->delete('Aluno',array('Matricula'=>$_REQUEST['delId']));
	header('location: ../read/aluno.blade.php?msg=rdel');
	exit;
}
?>