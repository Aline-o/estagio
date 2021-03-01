<?php include_once('../../../public/config.php');
  if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
    $row	=	$db->getAllRecords('serie','*',' AND idSerie="'.$_REQUEST['editId'].'"');
  }

  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    if($NomeSerie==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //msg campo obrigatorio
      exit;
    }
    $data	=	array(
      'NomeSerie'=>$NomeSerie,
    );
    $update	=	$db->update('serie',$data,array('idSerie'=>$editId));
    if($update){
      header('location: ../read/serie.blade.php?msg=ratt'); #<!-- success -->
      exit;
    }else{
      header('location: ../read/serie.blade.php?msg=rnna'); #<!-- nao teve alteracao -->
      exit;
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
      <div class="row">

        <?php include_once('../navSerie.blade.php'); ?>

        <div class="tab-content">

          <div id="cadSerie" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">EDITAR CADASTRO - Série 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/serie.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>
                
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Nome da Série</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <input type="text" class="form-control" name="NomeSerie" id="NomeSerie" value="<?php echo $row[0]['NomeSerie']; ?>" placeholder="<?php echo $row[0]['NomeSerie']; ?>" autofocus required>
                      </div>
                    </div>

                    <div class="row">
                      <input type="hidden" name="editId" id="editId" value="<?php echo $_REQUEST['editId']?>">
                      <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Editar</button>
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