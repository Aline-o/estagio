<?php 
  /*
  pesquisa de escola está bugado.
  quando pesquisa mais de um termo, não vem o resultado certo.
  erro provavelmente está em Turma também.
  */

// CONEXÃO COM O BANCO
include_once('../../../public/config.php');

  $condition	=	'';
  $SiglaCont= -1; //neutro
  if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
    $condition	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
  }

  ##################################################################
  //chave estrangeira, então necessita de tratamento diferenciado...

  /*
  esse bloco é para a pesquisa da modalidade de ensino.
  como é tabela diferente e usa-se chave estrangeira, se feito da mesma forma que o nomeescola,
  teria que pesquisar o id da modalidade, mas isso não e viável, portanto, há um primeiro
  select para achar o nome da modEnsino na tabela, e depois é buscado na escola com o id correspondente
  */
  if(isset($_REQUEST['Sigla']) and $_REQUEST['Sigla']!=""){
    $condition5='';
    $condition5	.=	' AND Sigla LIKE "%'.$_REQUEST['Sigla'].'%" ';
    $userData5	=	$db->getAllRecords('modalidadeensino','*',$condition5,'ORDER BY idModalidadeEnsino DESC');
    
    //se retornar algum valor do select...
    if(count($userData5)>0){ 
      $contador=0;
      //para cada valor encontrado...
      foreach($userData5 as $valMod){ 
        //primeira vez, primeiro resultado da pesquisa
        if($contador == 0) 
        {
          $condition	.=	' AND ModalidaEnsino_idModalidadeEnsino LIKE '.$valMod['idModalidadeEnsino'].' ';
          $condition	.=	' AND Status = 1 ';
          $contador++;
        }else{
          $condition	.=	' OR ModalidaEnsino_idModalidadeEnsino LIKE '.$valMod['idModalidadeEnsino'].' ';
          $SiglaCont=1; //tem pelo menos 1 resultado confirmado.
        }
      }
    }else{
      $SiglaCont=0; //veio nada
    }
  }

  $condition	.=	' AND Status = 1 ';
  $userData	=	$db->getAllRecords('escola','*',$condition,'ORDER BY idEscola DESC');
?>

<!doctype html>
<html lang="pt-br">
  
  <?php include_once('../head.blade.php'); ?>

  <body>
    
    <?php include_once('../header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('../sidebar/navEscola.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
          <div class="card border-light">
            <h4 class="card-header">
              <a href="#" onclick="return false;" data-toggle="popover" data-placement="bottom" title="Pré-cadastros necessários" data-trigger="focus" data-html="true" data-content="Cadastros que devem ser feitos antes deste:  <br>Modalidade de Ensino."><i class="fa fa-question-circle" aria-hidden="true"></i></a>
              Lista de Escolas
              <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../create/escola.blade.php" role="button">Novo cadastro</a>
            </h4>
            <div class="card-body">

              <?php include_once('../../../public/alertMsg.php');?>

              <div class="card-title">
                <!-------- Barra de pesquisa -------->
                <form method="get">
                  <div class="row">
                    <div class="form-group col-sm-5">
                      <label for="NomeEscola">Escola</label>
                      <input type="text" name="NomeEscola" id="NomeEscola" class="form-control" value="<?php echo isset($_REQUEST['NomeEscola'])?$_REQUEST['NomeEscola']:''?>" placeholder="Entra Escola">
                    </div>
                    <div class="form-group col-sm-7">
                      <label for="Sigla">Modalidade de ensino</label>
                      <input type="text" name="Sigla" id="Sigla" class="form-control" value="<?php echo isset($_REQUEST['Sigla'])?$_REQUEST['Sigla']:''?>" placeholder="Entra Modalidade de ensino">
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Pesquisar</button>
                    <a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger offset-md-1"><i class="fa fa-times"></i> Limpar</a>
                  </div>   
                </form>
              </div>
              
              <!-------- Tabela -------->
              <table class="table table-striped">
                <thead>
                  <tr class="bg-primary text-white">
                    <th scope="col">Sr#</th>
                    <th scope="col">Nome da Escola</th>
                    <th scope="col">Modalidade de ensino</th>
                    <th scope="col" class="text-center">Ação</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 
                  if(count($userData)>0){
                    $s	=	'';
                    foreach($userData as $val){
                    $userDataModEns	=	$db->getAllRecords2('modalidadeensino',' idModalidadeEnsino, Sigla ','idModalidadeEnsino ='.$val['ModalidaEnsino_idModalidadeEnsino'].' ');
                    foreach($userDataModEns as $val2){}
                      $s++;
                  ?>

                  <tr>
                    <td><?php echo $s;?></td>
                    <td><?php echo $val['NomeEscola'];?></td>
                    <td><?php echo $val2['Sigla'];?></td>
                    <td align="center">
                      <a href="../update/escola.blade.php?editId=<?php echo $val['idEscola'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Editar</a> | 
                      <a href="../delete/escola.php?delId=<?php echo $val['idEscola'];?>" class="text-danger" onClick="return confirm('Tem certeza que deseja excluir?');"><i class="fa fa-fw fa-trash"></i> Deletar</a>
                    </td>
                  </tr>  

                  <?php 
                        
                      }
                    
                  ?>

                                  
                  
                  <?php 
                  }else{
                  ?>

                  <tr><td colspan="4" align="center">teste No Record(s) Found!</td></tr>
                  <tr><td colspan="4" align="center">No Record(s) Found!</td></tr>
                  
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