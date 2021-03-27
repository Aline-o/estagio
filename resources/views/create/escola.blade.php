<!--precisa add ModalidaEnsino_idModalidadeEnsino -->
<?php include_once('../../../public/config.php');
  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($NomeEscola==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }elseif($ModalidaEnsino_idModalidadeEnsino==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }else{
      $userCount	=	$db->getQueryCount('escola','idEscola'); //users eh a tabela
      $data	=	array(
        'NomeEscola'=> $NomeEscola, //colunas    
        'ModalidaEnsino_idModalidadeEnsino'=>$ModalidaEnsino_idModalidadeEnsino
      );
      $insert	=	$db->insert('escola',$data);
      if($insert){
        header('location: ../read/escola.blade.php?msg=radd'); //add com sucesso
        exit;
      }else{
        header('location: ../read/escola.blade.php?msg=rerr'); // nao adicionado
        exit;
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Merenda prefeitura</title>

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
      <div class="row">

        <?php include_once('../navEscola.blade.php'); ?>

        <div class="tab-content col-md-10">



          <div id="cadEscola" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">NOVO CADASTRO - Escola
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/escola.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <label for="NomeEscola">Nome da escola</label>
                      <input type="text" class="form-control" name="NomeEscola" placeholder="Insira o nome da escola" required autofocus>
                    </div>                    
                    <div class="form-group col-sm-4">
                      <label for="ModalidaEnsino_idModalidadeEnsino">Modalidade de ensino</label>
                      <select class="form-control" name="ModalidaEnsino_idModalidadeEnsino" id="ModalidaEnsino_idModalidadeEnsino" required>
                        <option selected disabled value="">Escolha uma opção...</option>
                        <?php 

                        $condition	=	'';
                        if(isset($_REQUEST['NomeModalidadeEnsino']) and $_REQUEST['NomeModalidadeEnsino']!=""){
                          $condition	.=	' AND NomeModalidadeEnsino LIKE "%'.$_REQUEST['NomeModalidadeEnsino'].'%" ';
                        }
                        if(isset($_REQUEST['idModalidadeEnsino']) and $_REQUEST['idModalidadeEnsino']!=""){
                          $condition	.=	' AND idModalidadeEnsino LIKE "%'.$_REQUEST['idModalidadeEnsino'].'%" ';
                        }
                        $condition	.=	' AND Status = 1 ';
                        $userData	=	$db->getAllRecords('modalidadeensino','*', $condition,'ORDER BY idModalidadeEnsino DESC');
                      
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idModalidadeEnsino'];?>"> <?php echo $val['NomeModalidadeEnsino'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
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