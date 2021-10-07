<?php
// CONEXÃO COM O BANCO
include_once('../../public/config.php');
//fuso-horario
date_default_timezone_set("America/Sao_Paulo"); 

if(isset($_REQUEST['chosenId']) and $_REQUEST['chosenId']!=""){
  $userData	=	$db->getAllRecords('aluno','*',' AND Status = 1 AND Turma_idTurma="'.$_REQUEST['chosenId'].'"', 'ORDER BY Nome');
} 

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
  extract($_REQUEST);
  $contador=0;
  if(!empty($_POST['contaCheck'])){
    foreach($_POST['contaCheck'] as $selected){
      //$selected puxa o valor do checkbox, vulgo matricula do aluno
      $Aluno_Matricula = $selected;
      //cardapio predefinido, nao eh variavel
      $Cardapio_idCardapio = 19;

      $condition	=	'';
      $condition	.=	' AND idCardapio LIKE "%'.$Cardapio_idCardapio.'%" ';
      $cardapioDados	=	$db->getAllRecords('cardapio','idCardapio, Valor',$condition,'ORDER BY idCardapio DESC');

      $ValorCobrado = $cardapioDados[0]['Valor'];

      $DataHora = strftime("%H:%M:%S");
      //echo $ValorCobrado." #datahora# </br>";

      $Periodo = strftime("%H:%M:%S"); //Periodo
      $turnoDados	=	$db->getAllRecords('turno','*',' AND Status = 1 ','ORDER BY idTurno DESC');
      /* cardapio nao tem erro pq a busca eh feita com o id, mas o turno pode ocorrer erro se 
      houver algum turno "apagado" para o user, mas com registro no Banco...
      Portanto, é importante que ele apenas considere os turnos ativos, vulgo status 1.
      */
      foreach($turnoDados as $val){
        $h_Inicio = $val['HoraInicio'];
        $h_Fim = $val['HoraFim'];
        
        if($Periodo>=$h_Inicio && $Periodo<=$h_Fim){
          if(strcasecmp($val['NomeTurno'],"integral")){ //If this function returns 0, the two strings are equal.
            $Periodo = $val['NomeTurno'];
          }
        }
      }
      if($Periodo==$DataHora){//caso nao tenha turnos correspondentes
        $Periodo = 'Indefinido ('.$DataHora.')';
      }

      $Status = 1;


      $userCount	=	$db->getQueryCount('consumo','idConsumo');
      // colunas da tabela
      $data	=	array(
          'Aluno_Matricula'=> $Aluno_Matricula,
          'Cardapio_idCardapio'=> $Cardapio_idCardapio,
          'ValorCobrado'=> $ValorCobrado,
          'DataHora'=> $DataHora,
          'Periodo'=> $Periodo,
          'Status'=> $Status
      );
      $insert	=	$db->insert('consumo',$data);

    }    
  }else{ //caso nenhuma presença de aluno foi adicionada...
    // mensagem nenhuma alteração
    header('location:'.$_SERVER['PHP_SELF'].'?chosenId='.$_REQUEST['chosenId'].'&msg=rnna');
    exit;
  }

  if($insert){
    // mensagem add com sucesso
    header('location: presenca-turma.blade.php?msg=radd');
    exit;
  }else{
    // mensagem erro
    header('location: presenca-turma.blade.php?msg=rerr');
    exit;
  }
  
  /*if($Aluno_Matricula==""){
    // mensagem de campo obrigatorio
    header('location:'.$_SERVER['PHP_SELF'].'&msg=robr');
    exit;
  }elseif($Cardapio_idCardapio==""){
    header('location:'.$_SERVER['PHP_SELF'].'&msg=robr');
    exit;
  }elseif($ValorCobrado==""){
    header('location:'.$_SERVER['PHP_SELF'].'&msg=robr');
    exit;
  }elseif($DataHora==""){
    header('location:'.$_SERVER['PHP_SELF'].'&msg=robr');
    exit;
  }elseif($Periodo==""){
    header('location:'.$_SERVER['PHP_SELF'].'&msg=robr');
    exit;
  }else{
    // se pá pode apagar, não testei sem
    $userCount	=	$db->getQueryCount('consumo','idConsumo');
    // colunas da tabela
    $data	=	array(
      'NomeNivelEnsino'=> $NomeNivelEnsino,
        'Aluno_Matricula'=> $Aluno_Matricula,
       'Cardapio_idCardapio'=> $Cardapio_idCardapio,
        'ValorCobrado'=> $ValorCobrado,
        'DataHora'=> $DataHora,
        'Periodo'=> $Periodo,
        'Status'=> $Status
    );
    $insert	=	$db->insert('consumo',$data);
    if($insert){
      // mensagem add com sucesso
      header('location: ../presenca-turma.blade.php?msg=radd');
      exit;
    }else{
      // mensagem erro
      header('location: '.$_SERVER['PHP_SELF'].'?msg=rerr');
      exit;
    }
  }*/
}
/*
  $condition	=	'';
  $condition	.=	' AND idCardapio LIKE "%'.$idcardapio.'%" ';
  $cardapioDados	=	$db->getAllRecords('cardapio','idCardapio, Valor',$condition,'ORDER BY idCardapio DESC');
*/
?>
<!doctype html>
<html lang="pt-br">
  <?php 
  /*
  A ideia é fazer uma lista de links de turmas. Ao clicar na lista desejada, é encaminhado para uma página 
  mostrando exclusivamente os alunos daquela turma em específico.
  */ 
  ?>
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
              <div class="card-body text-justify">      
                <form method="POST">          
                  <div class="card-title"> <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkAll" checked>
                    <label class="form-check-label" for="checkAll"> Selecionar tudo</label>
                  </div> </div>
                  <div class="col-sm-12">
                    


                    <!-- rascunho
                      
                    campos consumo:
                      Aluno_Matricula
                      Cardapio_idCardapio
                      ValorCobrado
                      DataHora
                      Periodo
                      Status
                      
                      --->


                    <!-------- Tabela -------->
                    <table class="table table-striped">
                      <tbody>
                
                        <?php 
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                
                        <tr>
                          <td class="col-sm-2"><div class="form-check">
                            <input type="checkbox" value="<?php echo $val['Matricula'];?>" class="form-check-input" id="contaCheck" name="contaCheck[]" checked>
                            <label class="form-check-label" for="contaCheck">
                              <?php echo $val['Nome'];?>
                            </label>
                          </div></td>
                        </tr>
                
                        <?php 
                          }
                        }else{
                        ?>
                
                        <tr><td colspan="3" align="center">Sem registros encontrados!</td></tr>
                
                        <?php 
                        }
                        ?>
                
                      </tbody>
                    </table>
                  </div>
                  <div class="row justify-content-end">
                    <input type="hidden" name="chosenId" id="chosenId" value="<?php echo $_REQUEST['chosenId']?>">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>

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
    <script>
      $("#checkAll").click(function () {
        $(".form-check-input").prop('checked', $(this).prop('checked'));
    });
    </script>
  </body>
</html>