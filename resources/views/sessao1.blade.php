<?php

session_start();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Aqui, aline</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/cerulean/bootstrap.min.css" integrity="sha384-b+jboW/YIpW2ZZYyYdXczKK6igHlnkPNfN9kYAbqYV7rNQ9PKTXlS2D6j1QZIATW" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="../scss/style.scss" rel="stylesheet"> <!--estilização personalizada-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
    </script>
  </head>


  <body>
    <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Merenda</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
     
        <div class="tab-content">

          <div id="cadSerie" class="container tab-pane active"><br>
          <div class="mx-auto" style="width: 600px;">

            <div class="card border-light center" >


              <?php
              if( empty($_SESSION['Login']) ){ //caso não esteja logado
              ?>
                
              <h4 class="card-header text-center">VC NAO ESTA LOGADO</h4>

              <?php

              }else{ //caso esteja logado
                if($_SESSION['Perfil_idPerfil']==1) //se for perfil de adm...
                {
                ?>
                
              <h4 class="card-header text-center">VC ESTA LOGADO, <?php echo $_SESSION['Login']; ?> </h4>

              <?php
                }else{ //se nao for adm...
					        header("location: accessdenied.blade.php");

              ?>

              <h4 class="card-header text-center">VC NAO TEM PERMISSAO DE ACESSO, <?php echo $_SESSION['Login']; ?></h4>
              <p> A senha q coloquei eh 
                
                <?php 
                  
                  $senhaaa = '1k';
                  $dado['senha'] = password_hash($senhaaa, PASSWORD_DEFAULT);
                  echo '  ';
                  echo $senhaaa ;
                  ?>

 e ela criptografada ficou como 
 
                <?php
                  echo '  ';
                  echo $dado['senha'];
                  ?>
                
                </p>

              <?php
                }
              }
              ?>
              
              
              
              <div class="card-body text-center">                
                <div class="card-title">Ainda estamos trabalhando nesta página! </div>
                <div class="col-sm-12">
                  <p>Clique <a href="login.blade.php">aqui</a> para logar.</p>
                </div>
              </div>
              </div>
            </div>
          </div>

        </div>
     
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>