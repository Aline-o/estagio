<?php include_once('../../../public/config.php');
  if(isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
    $row	=	$db->getAllRecords('aluno, turma','aluno.Matricula,aluno.Turma_idTurma ,
     aluno.Nome, aluno.DataNascimento, aluno.Patologia, turma.idTurma, turma.NomeTurma',
    ' AND Matricula="'.$_REQUEST['editId'].'" AND turma.idTurma = aluno.Turma_idTurma');
    
    $rowAluEspec	=	$db->getAllRecords('alunoespecial',' alunoespecial.Aluno_Matricula, alunoespecial.Patologia_idPatologia ',
    ' AND Aluno_Matricula="'.$_REQUEST['editId'].'"');//$requestid

    foreach($rowAluEspec as $valAE){}
    if(isset($valAE['Patologia_idPatologia'])){
      $patol=$valAE['Patologia_idPatologia'];
      $row2	=	$db->getAllRecords('patologia',' * ',
      ' AND idPatologia="'.$patol.'"');//$requestid
    }
      
  } 
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

    if($Patologia==""){ //sem patologia...
      $Patologia=0;
      if($Nome==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
        exit;
      }elseif($DataNascimento==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
        exit;
      }elseif($Turma_idTurma==""){
        header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
        exit;
      }else{

        $data	=	array(
          'Nome'=> $Nome, //colunas         
          'DataNascimento'=> $DataNascimento,
          'Patologia'=>$Patologia,
        );
        
        $update	=	$db->update('aluno',$data,array('Matricula'=>$editId));
        if($update){
          header('location: ../read/aluno.blade.php?msg=ratt'); //att com sucesso
          exit;
        }else{
          header('location: ../read/aluno.blade.php?msg=rerr'); // nao adicionado
          exit;
        }
      }

    }else{ //com patologia...
      if(isset($valAE['Patologia_idPatologia'])){
        if($Nome==""){
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
          exit;
        }elseif($DataNascimento==""){
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
          exit;
        }elseif($Turma_idTurma==""){
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
          exit;
        }elseif($Descricao==""){ //patologia
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); 
          exit;
        }elseif($Grupo==""){ //patologia
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
          exit;
        }else{
          //$userCount	=	$db->getQueryCount('aluno','Matricula'); //aluno
          $data	=	array(
            'Nome'=> $Nome, //colunas         
            'DataNascimento'=> $DataNascimento,
            'Patologia'=>$Patologia,
          );
          $update	=	$db->update('aluno',$data,array('Matricula'=>$editId)); //aluno


        
        $convAluEspec	=	$db->getAllRecords('alunoespecial',' alunoespecial.Aluno_Matricula, alunoespecial.Patologia_idPatologia ',
        ' AND Aluno_Matricula="'.$editId.'"');//$requestid

        foreach($convAluEspec as $valAE){}
        $patol=$valAE['Patologia_idPatologia'];

        
        /* precisa selecionar através de aluno especial qual é a patologia a ser modificada
        
        $convModEns	=	$db->getAllRecords2('modalidadeensino',' idModalidadeEnsino, NomeModalidadeEnsino ',
        'idModalidadeEnsino ='.$val['ModalidaEnsino_idModalidadeEnsino'].' ');
        foreach($convModEns as $val2){}

         $convPatologia	=	$db->getAllRecords('patologia',' * ',
        ' AND idPatologia="'.$patol.'"');//$requestid
        foreach($convPatologia as $valPat){}
        */

       
        $data2	=	array(
          'Descricao'=> $Descricao, //colunas         
          'Grupo'=> $Grupo,
        );
        $update2	=	$db->update('patologia',$data2,array('idPatologia'=>$patol)); //patologia
 
          if($update && $update2 ){ // 
            header('location: ../read/aluno.blade.php?msg=ratt'); // att com sucesso
            exit;
          }elseif($update2){
            header('location: ../read/aluno.blade.php?msg=ratt'); 
            exit;
          }elseif($update){
            header('location: ../read/aluno.blade.php?msg=ratt'); 
            exit;
          }else{
            header('location: ../read/aluno.blade.php?msg=rnna'); // nenhum adicionado
            exit;
          } 
        }

      }else{
        if($Nome==""){
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
          exit;
        }elseif($DataNascimento==""){
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); //campo obrigatorio
          exit;
        }elseif($Turma_idTurma==""){
          header('location:'.$_SERVER['PHP_SELF'].'?msg=un15'); //campo obrigatorio
          exit;
        }elseif($Descricao==""){ //patologia
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr'); 
          exit;
        }elseif($Grupo==""){ //patologia
          header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
          exit;
        }else{
          //$userCount	=	$db->getQueryCount('aluno','Matricula'); //aluno
          $data	=	array(
            'Nome'=> $Nome, //colunas         
            'DataNascimento'=> $DataNascimento,
            'Patologia'=>$Patologia,
          );
          $update	=	$db->update('aluno',$data,array('Matricula'=>$editId)); //aluno
        


        
        $userCount2	=	$db->getQueryCount('patologia','idPatologia'); //patologia
        $data2	=	array(
          'Descricao'=> $Descricao, //colunas         
          'Grupo'=> $Grupo,
        );
        $insert2	=	$db->insert('patologia',$data2); //patologia


        //aluno especial
        $userData3 = $db->getAllRecords('patologia', 'idPatologia');
        
        foreach($userData3 as $val){
        }

        $Patologia_idPatologia = (int)$val['idPatologia'];
        $Aluno_Matricula = $_REQUEST['editId'];
        $DataPatologia = date('Y-m-d');
        
        //echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> //Aluno tipo: '.gettype($Aluno_Matricula).' valor: '.$Aluno_Matricula.' //Patologia tipo: '.gettype($Patologia_idPatologia) .' valor: '.(int)$Patologia_idPatologia.' //Daaata tipo: '.gettype($DataPatologia).' valor: '.$DataPatologia.' <strong>Vambora!</strong></div>';

        $userCount3	=	$db->getQueryCount('alunoespecial','Aluno_Matricula'); //users eh a tabela
        $data3	=	array(
          'Aluno_Matricula'=>$Aluno_Matricula,
          'Patologia_idPatologia'=>$Patologia_idPatologia, //colunas         
          'DataPatologia'=>$DataPatologia,
        );
        $insert3	=	$db->insert('alunoespecial',$data3);

        if($update && $insert2 && $insert3 ){ // 
          header('location: ../read/aluno.blade.php?msg=ratt'); // add com sucesso
          exit;
        }elseif($update && $insert2){
          header('location: ../read/aluno.blade.php?msg=rerr'); 
          exit;
        }elseif($update && $insert3){
          header('location: ../read/aluno.blade.php?msg=rerr');
          exit;
        }elseif($insert2 && $insert3){
          header('location: ../read/aluno.blade.php?msg=rerr');
          exit;
        }else{
          header('location: ../read/aluno.blade.php?msg=rnna'); // nenhum adicionado
          exit;
        }
      }

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

        <?php include_once('../navAluno.blade.php'); ?>

        <div class="tab-content col-md-10">
          <div id="cadAluno" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">EDITAR CADASTRO - Aluno
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/aluno.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-sm-8">
                      <label for="Nome">Nome do Aluno</label>
                      <input type="text" class="form-control" name="Nome" value="<?php echo $row[0]['Nome']; ?>" placeholder="<?php echo $row[0]['Nome']; ?>" required autofocus>
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="Matricula">Matrícula</label>
                      <input type="text" class="form-control" name="Matricula" value="<?php echo $row[0]['Matricula']; ?>" placeholder="<?php echo $row[0]['Matricula']; ?>" disabled>
                    </div>
                  </div>

                  <?php
                    $condition	=	'';
                    if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
                      $condition	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
                    }
                    if(isset($_REQUEST['idTurma']) and $_REQUEST['idTurma']!=""){
                      $condition	.=	' AND idTurma LIKE "%'.$_REQUEST['idTurma'].'%" ';
                    }
                    $userData	=	$db->getAllRecords('turma',' * ', $condition,' ORDER BY idTurma DESC');
                  ?>

                  <div class="row">
                    <div class="form-group col-sm-3">
                      <label for="DataNascimento">Data de nascimento do aluno</label>
                      <input type="date" class="form-control" name="DataNascimento" id="DataNascimento" value="<?php echo $row[0]['DataNascimento']; ?>" placeholder="<?php echo $row[0]['DataNascimento']; ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="Turma_idTurma">Turma</label>
                      <select class="form-control" id="Turma_idTurma" name="Turma_idTurma" required><!--//php buscando id-->
                        <option selected value="<?php echo $row[0]['idTurma']; ?>"><?php echo $row[0]['NomeTurma']; ?></option>
                        
                        <?php 
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

                    <?php
                      if($row[0]['Patologia']==1){ //se tiver patologia
                        $checkado=' checked ';
                        $exibirCollapse=' show ';
                        $grupo = $row2[0]['Grupo'];
                        $descricao = $row2[0]['Descricao'];
                      }else{
                        $checkado='';
                        $exibirCollapse='';
                        $grupo = '';
                        $descricao = '';
                      }
                    ?>
                    
                    <div class="form-group col-sm-3">
                      <label for="Patologia">Patologia? </label>
                      <div class="form-check" data-toggle="collapse" data-target="#patologiaTable">
                        <input class="form-check-input" type="checkbox" name="Patologia" value=1 id="Patologia" <?php echo $checkado; ?> >
                        <label class="form-check-label" for="Patologia">
                          Sim
                        </label>
                      </div>
                    </div>
                  </div>              

                  <div class="row collapse <?php echo $exibirCollapse; ?>" id="patologiaTable">
                    <div class="form-group col-sm-4">
                      <label for="Grupo">Grupo</label>
                      <input type="text" class="form-control" name="Grupo" value="<?php echo $grupo; ?>" placeholder="<?php if ($grupo != '') echo $grupo; else echo 'Insira o grupo da patologia'; ?>">
                    </div>
                    <div class="form-group col-sm-8">
                      <label for="Descricao">Descrição</label>
                      <input type="text" class="form-control" name="Descricao" value="<?php echo $descricao; ?>" placeholder="<?php if ($descricao != '') echo $descricao; else echo 'Insira a descrição da patologia'; ?>">
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