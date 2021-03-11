<?php 
include_once('../../../public/config.php');
if(isset($_REQUEST['delId']) and $_REQUEST['delId']!=""){
	$data	=	array(
		'Status'=>0,
	  );
	  $update	=	$db->update('serie',$data,array('idSerie'=>$_REQUEST['delId']));

	//$db->delete('serie',array('idSerie'=>$_REQUEST['delId']));
	header('location: ../read/serie.blade.php?msg=rdel');
	exit;
}
?>