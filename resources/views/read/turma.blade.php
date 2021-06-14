<?php include_once('../../../public/config.php');?>        
<?php
  $condition	=	'';
  /*
  esse bloco é para a pesquisa do nome da turma.
  */
  if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
    $condition	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
  }
  if(isset($_REQUEST['Ano']) and $_REQUEST['Ano']!=""){
    $condition	.=	' AND Ano LIKE "%'.$_REQUEST['Ano'].'%" ';
  }

  /*
  esse bloco é para a esquisa da modalidade de ensino.
  como é tabela diferente e usa-se chave estrangeira, se feito da mesma forma que o nomeescola,
  teria que pesquisar o id da modalidade, mas isso não e viável, portanto, há um primeiro
  select para achar o nome da modEnsino na tabela, e depois é buscado na escola com o id correspondente
  */
  if(isset($_REQUEST['NomeNivelEnsino']) and $_REQUEST['NomeNivelEnsino']!=""){
    $condition5='';
    $condition5	.=	' AND NomeNivelEnsino LIKE "%'.$_REQUEST['NomeNivelEnsino'].'%" ';
    $userData5	=	$db->getAllRecords('nivelensino','*',$condition5,'ORDER BY idNivelEnsino DESC');
    
    if(count($userData5)>0){ //se retornar algum valor do select...
      $contador=0;
      foreach($userData5 as $valMod){ //para cada valor encontrado...

        if($contador == 0) //primeira vez, primeiro resultado da pesquisa
        {
          $condition	.=	' AND NivelEnsino_idNivelEnsino LIKE '.$valMod['idNivelEnsino'].' ';
          $contador++;
        }else{
          $condition	.=	' OR NivelEnsino_idNivelEnsino LIKE '.$valMod['idNivelEnsino'].' ';
        }
      }
    }
  }

  if(isset($_REQUEST['NomeTurno']) and $_REQUEST['NomeTurno']!=""){
    $condition5='';
    $condition5	.=	' AND NomeTurno LIKE "%'.$_REQUEST['NomeTurno'].'%" ';
    $userData5	=	$db->getAllRecords('turno','*',$condition5,'ORDER BY idTurno DESC');
    
    if(count($userData5)>0){ //se retornar algum valor do select...
      $contador=0;
      foreach($userData5 as $valMod){ //para cada valor encontrado...

        if($contador == 0) //primeira vez, primeiro resultado da pesquisa
        {
          $condition	.=	' AND Turno_idTurno LIKE '.$valMod['idTurno'].' ';
          $contador++;
        }else{
          $condition	.=	' OR Turno_idTurno LIKE '.$valMod['idTurno'].' ';
        }
      }
    }
  }
  if(isset($_REQUEST['NomeSerie']) and $_REQUEST['NomeSerie']!=""){
    $condition5='';
    $condition5	.=	' AND NomeSerie LIKE "%'.$_REQUEST['NomeSerie'].'%" ';
    $userData5	=	$db->getAllRecords('serie','*',$condition5,'ORDER BY idSerie DESC');
    
    if(count($userData5)>0){ //se retornar algum valor do select...
      $contador=0;
      foreach($userData5 as $valMod){ //para cada valor encontrado...

        if($contador == 0) //primeira vez, primeiro resultado da pesquisa
        {
          $condition	.=	' AND Serie_idSerie LIKE '.$valMod['idSerie'].' ';
          $contador++;
        }else{
          $condition	.=	' OR Serie_idSerie LIKE '.$valMod['idSerie'].' ';
        }
      }
    }
  }
  if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
    $condition5='';
    $condition5	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
    $userData5	=	$db->getAllRecords('escola','*',$condition5,'ORDER BY idEscola DESC');
    
    if(count($userData5)>0){ //se retornar algum valor do select...
      $contador=0;
      foreach($userData5 as $valMod){ //para cada valor encontrado...

        if($contador == 0) //primeira vez, primeiro resultado da pesquisa
        {
          $condition	.=	' AND Escola_idEscola LIKE '.$valMod['idEscola'].' ';
          $contador++;
        }else{
          $condition	.=	' OR Escola_idEscola LIKE '.$valMod['idEscola'].' ';
        }
      }
    }
  }
  

  $condition	.=	' AND Status = 1 ';
  $userData	=	$db->getAllRecords('turma','*',$condition,'ORDER BY idTurma DESC');
?>

<!doctype html>
<html lang="pt-br">
  <?php include_once('../header.blade.php'); ?>


  <body>
    <header class="navbar navbar-expand navbar-dark bg-primary flex-column flex-md-row bd-navbar justify-content-between">
      <a class="navbar-brand mr-0 mr-md-2">Merendinha </a>
      <div class="navbar-nav-scroll align-items-end">
        <ul class="navbar-nav bd-navbar-nav flex-row ">
          <li class="nav-item">
            <a class="nav-link" href="#"> Sair </a>
          </li>
        </ul>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../navAluno.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
        
            <div class="card border-light">
              <h4 class="card-header">
                <a href="#" onclick="return false;" data-toggle="popover" data-placement="bottom" title="Pré-cadastros necessários" data-trigger="focus" data-html="true" data-content="Cadastros que devem ser feitos antes deste:  <br>Escola, Nível de Ensino, Série, Turno."><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                Lista de Turmas
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/turma.blade.php" role="button">Novo cadastro</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>

                <div class="card-title">
                    <form method="get">
                      <div class="row">
                        <div class="form-group col-sm-2">
                          <label for="NomeTurma">Turma</label>
                          <input type="text" name="NomeTurma" id="NomeTurma" class="form-control" value="<?php echo isset($_REQUEST['NomeTurma'])?$_REQUEST['NomeTurma']:''?>" placeholder="Entra Turma">
                        </div>
                        <div class="form-group col-sm-1">
                          <label for="Ano">Ano</label>
                          <input type="text" name="Ano" id="Ano" class="form-control" value="<?php echo isset($_REQUEST['Ano'])?$_REQUEST['Ano']:''?>" placeholder="Entra Ano">
                        </div>
                        <div class="form-group col-sm-2">
                          <label for="NomeNivelEnsino">Nível de ensino</label>
                          <input type="text" name="NomeNivelEnsino" id="NomeNivelEnsino" class="form-control" value="<?php echo isset($_REQUEST['NomeNivelEnsino'])?$_REQUEST['NomeNivelEnsino']:''?>" placeholder="Entra Niv. de ensino">
                        </div>
                        <div class="form-group col-sm-2">
                          <label for="NomeTurno">Turno</label>
                          <input type="text" name="NomeTurno" id="NomeTurno" class="form-control" value="<?php echo isset($_REQUEST['NomeTurno'])?$_REQUEST['NomeTurno']:''?>" placeholder="Entra Turno">
                        </div>
                        <div class="form-group col-sm-2">
                          <label for="NomeSerie">Série</label>
                          <input type="text" name="NomeSerie" id="NomeSerie" class="form-control" value="<?php echo isset($_REQUEST['NomeSerie'])?$_REQUEST['NomeSerie']:''?>" placeholder="Entra Serie">
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="NomeEscola">Escola</label>
                          <input type="text" name="NomeEscola" id="NomeEscola" class="form-control" value="<?php echo isset($_REQUEST['NomeEscola'])?$_REQUEST['NomeEscola']:''?>" placeholder="Entra Escola">
                        </div>
                      </div>

                      <div class="row">
                        <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Pesquisar</button>
                        <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger offset-md-1"><i class="fa fa-times"></i> Limpar</a>
                      </div>  
                    </form>
                </div>
                <table class="table table-striped">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th scope="col">Sr#</th>
                      <th scope="col">Nome da Turma</th>
                      <th scope="col">Ano</th>
                      <th scope="col">Nível de ensino</th>
                      <th scope="col">Turno</th>
                      <th scope="col">Série</th>
                      <th scope="col">Escola</th>
                      <th scope="col" class="text-center">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;

                          $convNivEns	=	$db->getAllRecords2('nivelensino',' idNivelEnsino, NomeNivelEnsino ','idNivelEnsino ='.$val['NivelEnsino_idNivelEnsino'].' ');
                          foreach($convNivEns as $val2){}
                          $convTurno	=	$db->getAllRecords2('turno',' idTurno, NomeTurno ','idTurno ='.$val['Turno_idTurno'].' ');
                          foreach($convTurno as $val3){}
                          $convSerie	=	$db->getAllRecords2('serie',' idSerie, NomeSerie ','idSerie ='.$val['Serie_idSerie'].' ');
                          foreach($convSerie as $val4){}
                          $convEscola	=	$db->getAllRecords2('escola',' idEscola, NomeEscola ','idEscola ='.$val['Escola_idEscola'].' ');
                          foreach($convEscola as $val5){}
                          /*
                          NomeNivelEnsino / NivelEnsino_idNivelEnsino
                          NomeTurno / Turno_idTurno
                          NomeSerie / Serie_idSerie
                          NomeEscola / Escola_idEscola
                          */
                    ?>
                    <tr>
                      <td><?php echo $s;?></td>
                      <td><?php echo $val['NomeTurma'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td><?php echo $val['Ano'];?></td>
                      <td><?php echo $val2['NomeNivelEnsino'];?></td>
                      <td><?php echo $val3['NomeTurno'];?></td>
                      <td><?php echo $val4['NomeSerie'];?></td>
                      <td><?php echo $val5['NomeEscola'];?></td>
                      <td align="center">
                        <a href="../update/turma.blade.php?editId=<?php echo $val['idTurma'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                        <a href="../delete/turma.php?delId=<?php echo $val['idTurma'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                      </td>
                    </tr>
                    <?php 
                        }
                      }else{
                    ?>
                    <tr><td colspan="8" align="center">No Record(s) Found!</td></tr>
                    <?php 
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>            
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function()
      {
        $('[data-toggle="popover"]').popover();      
      });
    </script>
  </body>
</html>