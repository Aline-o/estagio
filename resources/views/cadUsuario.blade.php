<?php 
// CONEXÃO COM O BANCO
include_once('../../public/config.php');

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
  extract($_REQUEST);
  
  if($CPF==""){
    // mensagem de campo obrigatorio
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }elseif($Login==""){
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }elseif($Senha==""){
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }elseif($Perfil_idPerfil==""){
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }elseif($Escola_idEscola==""){
    header('location:'.$_SERVER['PHP_SELF'].'?msg=robr');
    exit;
  }else{
    //precisa verificar se a pessoa ta logada como admin antes de permitir cadastrar
    //verificar se cpf ja existe no banco
    if($ConfirmaSenha == $Senha){
      // se pá pode apagar, não testei sem
      $userCount	=	$db->getQueryCount('usuario','idusuario');
      // colunas da tabela
      $data	=	array(
        'CPF'=> $CPF, //colunas                        
        'Login'=> $Login, 
        'Senha'=> password_hash($Senha, PASSWORD_DEFAULT), 
        'Perfil_idPerfil'=> $Perfil_idPerfil, 
        'Escola_idEscola'=> $Escola_idEscola, 
      );
      $insert	=	$db->insert('usuario',$data);
      if($insert){
        // mensagem add com sucesso
        header('location:'.$_SERVER['PHP_SELF'].'?msg=radd');
        exit;
      }else{
        // mensagem erro
        header('location:'.$_SERVER['PHP_SELF'].'?msg=rerr');
        exit;
      }

    }else{

      if($Login)
      // mensagem erro
      header('location:'.$_SERVER['PHP_SELF'].'?msg=rerr');
      exit;
    }
  }
}
?>

<!doctype html>
<html lang="pt-br">
  
  <?php include_once('head.blade.php'); ?>

  <body>
  
    <?php include_once('header.blade.php'); ?>

    <div class="container-fluid">
      <div class="tab-content">

        <main  class="container tab-pane active" role="main"><br>
            <div class="mx-auto" style="width: 600px;">
          <div class="card border-light  align-content-center">
            <h4 class="card-header">CADASTRAR NOVO USUÁRIO 
              <a class="btn btn-primary my-2 my-sm-0 btn-sm pull-right" href="login.blade.php" role="button">Já tenho cadastro</a>
            </h4>
            <div class="card-body">

              <!-- mensagens de alerta, ex: adicionado com sucesso, deletado com sucesso, etc -->
              <?php include_once('../../public/alertMsg.php');?>
              
              <div class="card-title">Preencha corretamente o formulário abaixo:</div>
              <form method="POST">
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="CPF">Insira seu CPF</label>
                    <input type="text" maxlength="11" pattern="[0-9]{11}" placeholder="Somente números" title="Insira somente números (11 dígitos), sem pontos, traços ou espaços."
                    class="form-control" name="CPF" required autofocus>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Login">Login</label>
                    <input type="text" maxlength="25" class="form-control" name="Login" placeholder="Insira seu Login"required autofocus>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Senha">Senha</label>
                    <input type="password" minlength="6"maxlength="15" onclick="mostraCampo()" class="form-control" name="Senha" placeholder="Insira sua senha"required autofocus>
                  </div>
                </div>
                <div class="row d-none" id="confirmasenha">
                  <div class="form-group col-sm-12">
                    <label class="text-danger" for="ConfirmaSenha">Insira novamente sua senha*</label>
                    <input type="password" minlength="6"maxlength="15" class="form-control" name="ConfirmaSenha" placeholder="Insira sua senha novamente"required autofocus>
                  </div>
                </div>            
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Perfil_idPerfil">Perfil</label>
                    
                    <a href="#" onclick="return false;" data-toggle="popover" data-placement="bottom" title="Acessos:" data-trigger="focus" data-html="true" data-content="
                    Administrador - acesso integral ao sistema <br>
                    Nutricionista - acesso completo à seção nutricional e relatórios <br>
                    Escola - acesso completo à seção escolar e alunos
                    "><i class="fa fa-question-circle" aria-hidden="true"></i></a>

                    <select class="form-control" name="Perfil_idPerfil" id="Perfil_idPerfil" required>
                      <option selected disabled value="">Escolha uma opção...</option>
                      <option value="1"> Administrador </option>
                      <option value="2"> Nutricionista </option>
                      <option value="3"> Escola </option>
                    </select>
                  </div>      
                </div> 
                <div class="row">
                  <div class="form-group col-sm-12">
                    <label for="Escola_idEscola">Escola</label>
                      <select class="form-control" id="Escola_idEscola" name="Escola_idEscola" required>
                        <option selected disabled value="">Escolha uma opção...</option>
                        
                        <?php 
                        $condition	=	'';
                        if(isset($_REQUEST['NomeEscola']) and $_REQUEST['NomeEscola']!=""){
                          $condition	.=	' AND NomeEscola LIKE "%'.$_REQUEST['NomeEscola'].'%" ';
                        }
                        if(isset($_REQUEST['idEscola']) and $_REQUEST['idEscola']!=""){
                          $condition	.=	' AND idEscola LIKE "%'.$_REQUEST['idEscola'].'%" ';
                        }
                        // Status 1 para valores não "deletados" pelo usuario
                        $condition	.=	' AND Status = 1 ';
                        $userData	=	$db->getAllRecords('escola','*', $condition,'ORDER BY idEscola DESC');
                      
                        if(count($userData)>0){
                          $s	=	'';
                          foreach($userData as $val){
                            $s++;
                        ?>
                        
                        <option value="<?php echo (int)$val['idEscola'];?>"> <?php echo $val['NomeEscola'];?> </option>
                        
                        <?php 
                          }
                        }
                        ?>
                      </select>
                  </div> 
                </div> 

                <div class="row">
                  <div class="col-md-4">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" name="reset" value="reset" id="reset" class="btn">Limpar</button>
                  </div>
                </div>
              </form>
            </div>
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
          function mostraCampo() {
            document.getElementById("confirmasenha").setAttribute("class", "row"); 
          }
        </script>
        <script>
          $(document).ready(function()
          {
            $('[data-toggle="popover"]').popover();      
          });
        </script>
      </body>
    </html>