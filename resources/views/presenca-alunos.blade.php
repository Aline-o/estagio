<?php
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

if(isset($_REQUEST['chosenId']) and $_REQUEST['chosenId']!=""){
  $userData	=	$db->getAllRecords('aluno','*',' AND Status = 1 AND Turma_idTurma="'.$_REQUEST['chosenId'].'"', 'ORDER BY Nome');
} 
/*
$condition	.=	'';
$userData	=	$db->getAllRecords('aluno','*',$condition,);
*/
?>
<!doctype html>
<html lang="pt-br">
  <?php 
  /*
  A ideia é fazer uma lista de links de turmas. Ao clicar na lista desejada, é encaminhado para uma página 
  mostrando exclusivamente os alunos daquela turma em específico.
  */ ?>
  <?php include_once('head.blade.php'); ?>

  <body>
    <?php include_once('header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('sidebar/navPresenca.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
        
            <div class="card border-light">
              <h4 class="card-header text-center">Registro por Presença</h4>
              <div class="card-body text-center">                
                <div class="card-title">Presenca dos alunos!</div>
                <div class="col-sm-12">
                  
              <!-------- Tabela -------->
              <table class="table table-striped">
                <thead>
                  <tr class="bg-primary text-white">
                    <th scope="col">Sr#</th>
                    <th scope="col">Nome do Nível de Ensino</th>
                    <th scope="col" class="text-center">Ação</th>
                  </tr>
                </thead>
                <tbody>
          
                  <?php 
                  if(count($userData)>0){
                    $s	=	'';
                    foreach($userData as $val){
                      $s++;
                  ?>
          
                  <tr>
                    <td><?php echo $s;?></td>
                    <td><?php echo $val['Nome'];?></td>
                    <td align="center">
                      <a href="../update/nivEnsino.blade.php?editId=<?php echo $val['idNivelEnsino'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                      <a href="../delete/nivEnsino.php?delId=<?php echo $val['idNivelEnsino'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                    </td>
                  </tr>
          
                  <?php 
                    }
                  }else{
                  ?>
          
                  <tr><td colspan="3" align="center">No Record(s) Found!</td></tr>
          
                  <?php 
                  }
                  ?>
          
                </tbody>
              </table>
                </div>

              </div>
            </div>
        </main>
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