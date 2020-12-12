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
        <nav class="col-md-2 d-none d-md-block sidebar"> <!--aqui que coloca o toggler-->
          <div class="sidebar-sticky">
            <ul class="nav flex-column nav nav-pills" role="tablist" >
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#home"><i class="fa fa-home"></i>
                  &nbsp;Início</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#demo"><i  class="fa fa-book"></i>
                  &nbsp;Cadastro <i class="fa fa-caret-down"></i></a>   <!-- data-toggle="pill" -->
              </li>

              <div class="collapse"  id="demo"> <!--onClick="window.location.reload();"-->
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadAluno">&nbsp; Aluno</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadCardapio">&nbsp; Cardápio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadEscola">&nbsp; Escola</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadModEnsino">&nbsp; Modalidade de ensino</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadNivelEnsino">&nbsp; Nível de ensino</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadSerie">&nbsp; Série</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadTurma">&nbsp; Turma</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cadTurno">&nbsp; Turno</a>
                </li>
              </div>
              <li class="nav-item">
                <a class="nav-link"  data-toggle="pill" href="#"><i class="fa fa-user"></i>
                  &nbsp;Registro por presença</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#"><i class="fa fa-folder"></i>
                  &nbsp;Registro via arquivo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#"><i class="fa fa-file-text"></i>
                  &nbsp;Relatório</a>
              </li>
            </ul>
          </div>
        </nav>


        <div class="tab-content">
          <div id="home" class="container tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Home </h4>
              <div class="card-body">
                <div class="card-title">Tela de início</div>
                <p>Início.</p>
              </div>
            </div>            
          </div>

          <div id="cadAluno" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Aluno
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/aluno.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <label>Nome do Aluno</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="nomealuno" placeholder="Insira o nome do Aluno">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Data de nascimento do aluno</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Turma</label>
                    </div>
                  </div>
                    
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <input type="date" class="form-control" name="nascimentoaluno" placeholder="Insira a Data de nascimento do Aluno">
                    </div>
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option value="1">Escolas Municipais de Educação Infantil</option>
                        <option value="3">Escola Municipal de Ensino Fundamental</option>                        
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>            
          </div>

          <div id="cadCardapio" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Cardápio 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/cardapio.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nome do Cardápio</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Sigla do Cardápio</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="nomecardapio" placeholder="Insira o nome do Cardápio">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="siglacardapio" placeholder="Insira a sigla do Cardápio">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Descrição do Cardápio</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Valor do Cardápio</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="descricaocardapio" placeholder="Insira a descrição do Cardápio">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="valorcardapio" placeholder="Insira o valor do Cardápio">
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


          <div id="cadEscola" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - escola
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/escola.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nome da escola</label>
                    </div>
                    <div class="col-sm-4">
                      <label>Modalidade de ensino</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="nomeescola" placeholder="Insira o nome da escola">
                    </div>                    
                    <div class="form-group col-sm-4">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected="selected" value="">Escolha uma modalidade</option>
                        <option value="1">Escolas Municipais de Educação Infantil</option>
                        <option value="3">Escola Municipal de Ensino Fundamental</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          <div id="cadModEnsino" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Modalidade de ensino 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/modEnsino.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nome da Modalidade de ensino</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Sigla da Modalidade de ensino</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="nomemodalidade" placeholder="Insira o nome da Modalidade">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="siglamodalidade" placeholder="Insira a sigla da Modalidade">
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div id="cadNivelEnsino" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Nível de ensino 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/nivEnsino.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-12">
                      <label>Nome do nível de ensino</label>
                    </div>
                  </div>
                      
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="nomenivelensino" placeholder="Insira o nome do nível de ensino">
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div id="cadSerie" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Série 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/serie.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-12">
                      <label>Nome da Série</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" name="nomeserie" placeholder="Insira o nome da Série">
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div id="cadTurma" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Turma
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/turma.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nome da turma</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Ano da turma</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="nometurma" placeholder="Insira o nome da turma">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="anoturma" placeholder="Insira o ano da turma">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Série</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Turno</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected="selected" value="">Escolha uma Série</option>
                        <option value="1">Ensino fundamental 1</option>
                        <option value="3">Ensino fundamental 2</option>
                        <option value="5">Ensino médio</option>
                        <option value="4">Ensino médio 2</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected="selected" value="">Escolha um Turno</option>
                        <option value="1">Ensino fundamental 1</option>
                        <option value="3">Ensino fundamental 2</option>
                        <option value="5">Ensino médio</option>
                        <option value="4">Ensino médio 2</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label>Nível Ensino</label>
                    </div>
                    <div class="col-sm-6">
                      <label>Escola</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected="selected" value="">Escolha um Nível de Ensino</option>
                        <option value="1">Ensino fundamental 1</option>
                        <option value="3">Ensino fundamental 2</option>
                        <option value="5">Ensino médio</option>
                        <option value="4">Ensino médio 2</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-6">
                      <select class="form-control" id="exampleFormControlSelect1">
                        <option selected="selected" value="">Escolha uma Escola</option>
                        <option value="1">Escola Joãozinho</option>
                        <option value="3">Escola Pedrinho</option>
                        <option value="5">Escola Zezinho</option>
                        <option value="4">Escola Mariazinha</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          
          <div id="cadTurno" class="tab-pane active"><br>
            <div class="card border-light">
              <h4 class="card-header">Cadastro - Turno 
                <a class="btn btn-primary my-2 my-sm-0 pull-right" href="../read/turno.blade.php" role="button">Buscar</a>
              </h4>
              <div class="card-body">
                <?php include_once('../../../public/alertMsg.php');?>
                <div class="card-title">Preencha corretamente o formulário abaixo:</div>
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-4">
                      <label>Nome do Turno</label>
                    </div>
                    <div class="col-sm-4">
                      <label>Hora de início</label>
                    </div>
                    <div class="col-sm-4">
                      <label>Hora fim</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="nometurno" placeholder="Insira o nome do Turno">
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="horainicio" placeholder="Insira o horário inicial">
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="horafim" placeholder="Insira o horário final">
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