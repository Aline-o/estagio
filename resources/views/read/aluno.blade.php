<?php 
include_once('../../../public/config.php');?>

<!doctype html>
<html lang="pt-br">
  <?php include_once('../head.blade.php'); ?>

  <body>
    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navAluno.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
          <?php
            $condition	=	'';
            if(isset($_REQUEST['Nome']) and $_REQUEST['Nome']!=""){
              $condition	.=	' AND Nome LIKE "%'.$_REQUEST['Nome'].'%" ';
            }
            if(isset($_REQUEST['DataNascimento']) and $_REQUEST['DataNascimento']!=""){
              $condition	.=	' AND DataNascimento LIKE "%'.$_REQUEST['DataNascimento'].'%" ';
            }
            if(isset($_REQUEST['Patologia']) and $_REQUEST['Patologia']!=""){
              if(!strcasecmp($_REQUEST['Patologia'],"s") || !strcasecmp($_REQUEST['Patologia'],"sim") || !strcasecmp($_REQUEST['Patologia'],"y")){ //If this function returns 0, the two strings are equal.
                $pat=1;
              }elseif(strcasecmp($_REQUEST['Patologia'],"n")==0 || strcasecmp($_REQUEST['Patologia'],"nao")==0 || strcasecmp($_REQUEST['Patologia'],"não")==0){
                $pat=0;
              }else{
                $pat=$_REQUEST['Patologia'];
              }
              $condition	.=	' AND Patologia LIKE "%'.$pat.'%" ';
            }

            if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
              $condition5='';
              $condition5	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
              $userData5	=	$db->getAllRecords('turma','*',$condition5,'ORDER BY idTurma DESC');
              
              if(count($userData5)>0){ //se retornar algum valor do select...
                $contador=0;
                foreach($userData5 as $valTur){ //para cada valor encontrado...

                  if($contador == 0) //primeira vez, primeiro resultado da pesquisa
                  {
                    $condition	.=	' AND Turma_idTurma LIKE '.$valTur['idTurma'].' ';
                    $contador++;
                  }else{
                    $condition	.=	' OR Turma_idTurma LIKE '.$valTur['idTurma'].' ';
                  }
                  //echo "<span>  ".$valMod['idModalidadeEnsino']." \br </span>";

                }
              }
            }
            $condition	.=	' AND Status = 1 ';
            $userData	=	$db->getAllRecords('aluno','*',$condition,'ORDER BY Matricula DESC');
          ?>

            <div class="card border-light">
              <h4 class="card-header">
                <a href="#" onclick="return false;" data-toggle="popover" data-placement="bottom" title="Pré-cadastros necessários" data-trigger="focus" data-html="true" data-content="Cadastros que devem ser feitos antes deste:  <br>Restrição Alimentar, Turma."><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                Lista de Alunos
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/aluno.blade.php" role="button">Novo cadastro</a>
              </h4>
              <div class="card-body">

                <?php include_once('../../../public/alertMsg.php');?>

                <div class="card-title">
                    <form method="get">
                      <div class="row">
                        <div class="form-group col-sm-4">
                          <label for="Nome">Aluno</label>
                          <input type="text" name="Nome" id="Nome" class="form-control" value="<?php echo isset($_REQUEST['Nome'])?$_REQUEST['Nome']:''?>" placeholder="Entra Nome do Aluno">
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="DataNascimento">Data nascimento</label>
                          <input type="date" name="DataNascimento" id="DataNascimento" class="form-control" value="<?php echo isset($_REQUEST['DataNascimento'])?$_REQUEST['DataNascimento']:''?>" placeholder="Entra Data Nascimento">
                        </div>
                        <div class="form-group col-sm-2">
                          <label for="Patologia">Restr. Alimentar</label>
                          <input type="text" name="Patologia" id="Patologia" class="form-control" value="<?php echo isset($_REQUEST['Patologia'])?$_REQUEST['Patologia']:''?>" placeholder="S/N">
                        </div>
                        <div class="form-group col-sm-3">
                          <label for="NomeTurma">Turma</label>
                          <input type="text" name="NomeTurma" id="NomeTurma" class="form-control" value="<?php echo isset($_REQUEST['NomeTurma'])?$_REQUEST['NomeTurma']:''?>" placeholder="Entra Turma">
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
                      <th scope="col">Nome Completo</th>
                      <th scope="col">Data Nascimento</th>
                      <th scope="col">Restr. Alimentar</th>
                      <th scope="col">Turma</th>
                      <th scope="col" class="text-center">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(count($userData)>0){
                        $s	=	'';
                        foreach($userData as $val){
                          $s++;

                          $convTurma	=	$db->getAllRecords2(' turma ',' idTurma, NomeTurma ',' idTurma ='.$val['Turma_idTurma'].' ');
                        foreach($convTurma as $convT){}
                    ?>
                    <tr>
                      <td><?php echo $s;?></td>
                      <td><?php echo $val['Nome'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td><?php echo $val['DataNascimento'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <?php
                      if($val['Patologia']==1)
                      {

                        $rowAluEspec	=	$db->getAllRecords('alunoespecial',' alunoespecial.Aluno_Matricula, alunoespecial.Patologia_idPatologia ',
                        ' AND Aluno_Matricula="'.$val['Matricula'].'"');//$requestid
                        foreach($rowAluEspec as $valAE){}
                        if(isset($valAE['Patologia_idPatologia'])){
                          $patol=$valAE['Patologia_idPatologia'];
                          $row2	=	$db->getAllRecords('patologia',' * ',
                          ' AND idPatologia="'.$patol.'"');//$requestid
                        }
                        $grupo = $row2[0]['Grupo'];
                        $descricao = $row2[0]['Descricao'];

                        $printPatologia='<a href="#" onclick="return false;" data-toggle="popover" title="Restrição Alimentar" data-trigger="focus" data-html="true" data-content="Grupo: '.$grupo.' <br>Descrição: '.$descricao.'"> S </a>';
                      }else{
                        $printPatologia='N';
                      }
                      ?>

                      <td><?php echo $printPatologia;?></td> <!-- patologia aqui -->
                        
                      <td><?php echo $convT['NomeTurma'];?></td> <!-- Precisa ser exatamente como esta no banco -->
                      <td align="center">
                        <a href="../update/aluno.blade.php?editId=<?php echo $val['Matricula'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                        <a href="../delete/aluno.php?delId=<?php echo $val['Matricula'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                      </td>
                    </tr>
                    <?php 
                        }
                      }else{
                    ?>
                    <tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
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