<?php
session_start();
include_once('../../public/conexao.php');
//include_once("conexao.php");
//usuario: admin  /  nutri / esco
//senha: 123  /  1k / aaaaaa

$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'Login', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'Senha', FILTER_SANITIZE_STRING);
	//echo "$usuario - $senha";
	if((!empty($usuario)) AND (!empty($senha))){
		//Gerar a senha criptografa
		//echo password_hash($senha, PASSWORD_DEFAULT);
		//Pesquisar o usuário no BD
		$result_usuario = "SELECT idUsuario, CPF, Login, Senha, Status, Escola_idEscola, Perfil_idPerfil FROM usuario WHERE Login='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);

		
		
		//$userData5	=	$db->getAllRecords('modalidadeensino','*',$condition5,'ORDER BY idModalidadeEnsino DESC');
		
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if(password_verify($senha, $row_usuario['Senha'])){
				$_SESSION['idUsuario'] = $row_usuario['idUsuario'];
				$_SESSION['CPF'] = $row_usuario['CPF'];
				$_SESSION['Login'] = $row_usuario['Login'];
				$_SESSION['Status'] = $row_usuario['Status'];
				$_SESSION['Escola_idEscola'] = $row_usuario['Escola_idEscola'];
				$_SESSION['Perfil_idPerfil'] = $row_usuario['Perfil_idPerfil'];
				header("Location: sessao1.blade.php"); //login ok
			}else{
				$_SESSION['msg'] = "<p style='color:red;'> *LOGIN OU SENHA INCORRETO* </p>";
				header("Location: login.blade.php?msg=rlog");
			}
		}
	}else{
		$_SESSION['msg'] ="<p style='color:red;'> Insira os dados </p>";
		header("Location: login.blade.php?msg=robr");
	}
}else{
	$_SESSION['msg'] = " O acesso direto não é permitido ";
	header("Location: login.blade.php?msg=rerr");
}
