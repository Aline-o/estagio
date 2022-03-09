<?php
session_start();

/*
o sistema só tem login para administrador.

usuário e senha para acesso com o banco atual:
usuario: joao
senha: 123




<?php
session_start();

if( empty($_SESSION['nome']) ){
	//header("location: login.php");
}



...

<?php
					if( empty($_SESSION['nome']) ){ //caso não esteja logado
						echo '

						....


						}else{ //caso esteja logado

							....

?>










 */
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
    
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="stylelogin.css">
</head>

<body>
<div class="container h-100">
<?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    ?>
					
			
			  <?php
				if( empty($_SESSION['nome']) ){ //caso não esteja logado
					
				}else{ //caso esteja logado
					header("location: index.php");
				}
				?>


	
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="login.png" class="brand_logo" alt="Logo">
                    </div>
                    
				</div>
				<div class="d-flex justify-content-center form_container">
                   
					<form method="POST" action="valida.php">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="usuario" class="form-control input_user" value="" placeholder="nome">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="senha" class="form-control input_pass" value="" placeholder="senha">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Lembrar me</label>
							</div>
						</div>
						<div class="d-flex justify-content-center mt-3 login_container">
				 	<input type="submit" name="btnLogin" value="Acessar" class="btn login_btn">
				   </div>
				   <div class="d-flex justify-content-end mt-3 login_container">
				   <button role="button" href="cadastrodono.php" class="btn btn-link">Cadastrar</button>
				   </div>
					</form>
				</div>
		
			</div>
		</div>
	</div>
</body>
</html>
