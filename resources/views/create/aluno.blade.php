<!--precisa add campo patologia, colocar idturma-->
<?php include_once('../../../public/config.php'); 
  if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
    extract($_REQUEST);
    
    /*
        Aluno: 
        Matricula(CP), DataNascimento, Nome, Patologia (0 ou 1), Turma_idTurma


        AlunoEspecial:
        Aluno_Matricula(CP), Patologia_idPatologia(CP), DataPatologia


        Patologia:
        idPatologia, Descricao, Grupo

        */

    if($Matricula==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=un'); //campo obrigatorio
      exit;
    }elseif($Nome==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=un'); //campo obrigatorio
      exit;
    }elseif($DataNascimento==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=un'); //campo obrigatorio
      exit;
    }elseif($Patologia==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=un'); //campo obrigatorio
      exit;
    }elseif($Turma_idTurma==""){
      header('location:'.$_SERVER['PHP_SELF'].'?msg=un'); //campo obrigatorio
      exit;
    }else{
      $userCount	=	$db->getQueryCount('aluno','Matricula'); //users eh a tabela
      $data	=	array(
        'Matricula'=>$Matricula,
        'Nome'=> $Nome, //colunas         
        'DataNascimento'=> $DataNascimento,
        'Patologia'=>$Patologia,
        'Turma_idTurma'=>$Turma_idTurma,
      );
      $insert	=	$db->insert('aluno',$data);
      if($insert){
        header('location: ../read/aluno.blade.php?msg=ras'); //add com sucesso
        exit;
      }else{
        header('location: ../read/aluno.blade.php?msg=rna'); // nao adicionado
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

        <?php include_once('../navAluno.blade.php'); ?>

        <div class="tab-content">
          <div id="cadAluno" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Aluno 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/aluno.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-sm-8">
                      <label for="Nome">Nome do Aluno</label>
                      <input type="text" class="form-control" name="Nome" placeholder="Insira o nome do Aluno" required autofocus>
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="Matricula">Matricula</label>
                      <input type="text" class="form-control" name="Matricula" placeholder="Insira o número da Matricula" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-sm-3">
                      <label for="DataNascimento">Data de nascimento do aluno</label>
                      <input type="date" class="form-control" name="DataNascimento" id="DataNascimento" placeholder="Insira a Data de nascimento do Aluno" required>
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="Turma_idTurma">Turma</label>
                      <select class="form-control" id="Turma_idTurma" required><!--//php buscando id-->
                        <option selected disabled value="">Escolha uma opção...</option>
                        <?php 

                        $condition	=	'';
                        if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
                          $condition	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
                        }
                        if(isset($_REQUEST['idTurma']) and $_REQUEST['idTurma']!=""){
                          $condition	.=	' AND idTurma LIKE "%'.$_REQUEST['idTurma'].'%" ';
                        }
                        $userData	=	$db->getAllRecords('Turma','*', $condition,'ORDER BY idTurma DESC');
                      
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idTurma'];?>"> <?php echo $val['NomeTurma'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-sm-3" id="form333">
                      <label for="Patologia">Patologia? </label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="Patologia" id="PatologiaY" value="1" data-toggle="collapse" href="#patologiaTable" >
                        <label class="form-check-label" for="PatologiaY">
                          Sim
                        </label>                        
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="Patologia" id="PatologiaN" value="0" data-toggle="collapse" href="#patologiaTable" checked>
                        <label class="form-check-label" for="PatologiaN">
                          Não
                        </label>
                      </div>
                    </div>
                  </div>

                  <script>
                    $('#form333 input[type=radio]').on('change', function(event) {
                      var result = $(this).val();
                      
                      if (result=='1')
                      {
                        $('#result').html("selecionado");
                      <?php
                        echo "$('#result').html(result);";
                      ?>
                      }
                      else{
                        $('#result').html("deu ruuuuim");
                        
                      }
                    })
                </script>

                  <?php
                  /*
                  Aluno: 
                  Matricula(CP), DataNascimento, Nome, Patologia (0 ou 1), Turma_idTurma


                  AlunoEspecial:
                  Aluno_Matricula(CP), Patologia_idPatologia(CP), DataPatologia


                  Patologia:
                  idPatologia, Descricao, Grupo

                  
$PatologiaY = $_GET['Patologia'];
                  if($PatologiaY=="1")
                  {
                    echo "selecionadooooooooo";
                  }

                  */
                  
                  
                  ?>


                  <div class="row collapse" id="patologiaTable">
                    <div class="form-group col-sm-4">
                      <label for="Grupo">Grupo</label>
                      <input type="text" class="form-control" name="Grupo" placeholder="Insira o grupo da patologias" required autofocus>
                    </div>
                    <div class="form-group col-sm-8">
                      <label for="Descricao">Descrição</label>
                      <input type="text" class="form-control" name="Descrição" placeholder="Insira a descrição da patologia" required autofocus>
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