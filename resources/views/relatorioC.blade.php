<!doctype html>
<html lang="pt-br">
  <?php 
  // CONEXÃO COM O BANCO
include_once('../../public/config.php');
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
                  <div class="card-title"> 

                    <div class="row">
                      <div class="form-group col-sm-3">
                        <label for="Cardapio_idCardapio">Cardápio</label>
                        <select class="form-control" name="Cardapio_idCardapio" id="Cardapio_idCardapio" required>
                          <option selected disabled value="">Escolha uma opção...</option>
    
                          <?php 
                          $condition	=	'';
                          if(isset($_REQUEST['Sigla']) and $_REQUEST['Sigla']!=""){
                            $condition	.=	' AND Sigla LIKE "%'.$_REQUEST['Sigla'].'%" ';
                          }
                          if(isset($_REQUEST['idCardapio']) and $_REQUEST['idCardapio']!=""){
                            $condition	.=	' AND idCardapio LIKE "%'.$_REQUEST['idCardapio'].'%" ';
                          }
                          // Status 1 para valores não "deletados" pelo usuario
                          $condition	.=	' AND Status = 1 ';
                          $userDataC	=	$db->getAllRecords('cardapio','*', $condition,'ORDER BY idCardapio DESC');
                        
                          if(count($userDataC)>0){
                            $s	=	'';
                            foreach($userDataC as $valC){
                              $s++;
                          ?>
                          
                          <option value="<?php echo (int)$valC['idCardapio'];?>"> <?php echo $valC['Sigla'];?> </option>
                          
                          <?php 
                            }
                          }
                          ?>
    
                        </select>
                      </div>
                    </div>
                  
                  
                  <div class="form-check">
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
                        if(count($userDataC)>0){
                          $s	=	'';
                          foreach($userDataC as $val){
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