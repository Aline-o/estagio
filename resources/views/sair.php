<?php

session_start();
unset( $_SESSION['idUsuario'], 
$_SESSION['CPF'], 
$_SESSION['Login'], 
$_SESSION['Status'],
$_SESSION['Escola_idEscola'],
$_SESSION['Perfil_idPerfil']
);

$_SESSION['msg'] = "<p style='color:green;'> *DESLOGADO COM SUCESSO </p>";

echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Deslogado com sucesso!</div>';
echo	$_SESSION['msg'];

//header("Location: login.blade.php");