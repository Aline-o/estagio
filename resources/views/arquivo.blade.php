<!doctype html>
<html lang="pt-br">
  <?php include_once('head.blade.php'); ?>

  <body>
    <?php include_once('header.blade.php'); ?>

    <div class="container-fluid">
      <div class="row flex-xl-nowrap">
        
        <?php include_once('sidebar/navArquivo.blade.php'); ?>

        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-1 bd-content" role="main">
        
            <div class="card border-light">
              <h4 class="card-header text-center">Registro via Arquivo</h4>
              <div class="card-body text-center">                
                <div class="card-title">Selecione o arquivo!</div>
                <div class="col-sm-12">
                  <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- File Button -->
                        <div class="form-group">
                          <div class="row"> 
                            <label class="col-md-4 control-label text-right" for="file">Selecione Arquivo</label>
                            <div class="col-md-8">
                                <input type="file" name="file" id="file" class="input-large pull-left">
                            </div>
                          </div>
                            
                        </div>
                        <!-- Button -->
                        
                        <div class="form-group">
                          <div class="row">
                            <label class="col-md-4 control-label text-right" for="singlebutton">Importar dados</label>
                            <div class="col-md-8">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading pull-left" data-loading-text="Loading...">Enviar</button>
                            </div>
                          </div>
                        </div>
                        
                    </fieldset>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>