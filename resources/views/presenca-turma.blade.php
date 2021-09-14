<?php 
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

$condition	=	'';
if(isset($_REQUEST['NomeTurma']) and $_REQUEST['NomeTurma']!=""){
  $condition	.=	' AND NomeTurma LIKE "%'.$_REQUEST['NomeTurma'].'%" ';
}
$condition	.=	' AND Status = 1 ';
$userData	=	$db->getAllRecords('turma','*',$condition,'ORDER BY idTurma DESC');
?>

<!doctype html>
<html lang="pt-br">
  <?php 
  /*
  A ideia é fazer uma lista de links de turmas. Ao clicar no link desejado, é encaminhado para uma página 
  mostrando somente os alunos daquela turma em específico.
  Passa o idturma como parametro para a outra pagina.

  Qual o sentido disso? Restringir. Não dar poder ao usuário de trocar a 'turma-alvo' na hora de registrar a presença,
  assim, evitando erros.
  */ ?>
  <?php include_once('head.blade.php'); ?>

  <body>
    <?php include_once('header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('sidebar/navPresenca.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
          
          <?php include_once('../../public/alertMsg.php');?>
        
            <div class="card border-light">
              <h4 class="card-header text-center">Registro por Presença</h4>
              <div class="card-body text-center">                
                <div class="card-title">Selecione a turma!</div>
                <div class="row justify-content-md-center">
                  <div class="col-sm-4 text-justify">
                  
                    <!-------- Tabela -------->
                    <?php 
                    if(count($userData)>0){
                      $s	=	'';
                      foreach($userData as $val){
                        $s++;
                    ?>
            
                    <a href="presenca-alunos.blade.php?chosenId=<?php echo $val['idTurma'];?>"> Turma <?php echo $val['NomeTurma'];?> </a> </br>
                      
            
                    <?php 
                      }
                    }else{
                    ?>
            
                    <tr><td colspan="3" align="center">Nenhuma turma cadastrada!</td></tr>
            
                    <?php 
                    }
                    ?>
          
                  </div>
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