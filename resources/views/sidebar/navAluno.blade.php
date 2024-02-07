<?php

session_start();
if( empty($_SESSION['Login']) ){ //caso não esteja logado
  header("Location: ../login.blade.php");


}else{ //caso esteja logado
  if($_SESSION['Perfil_idPerfil']==2) //se for perfil de nutri...
  {
  ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var escola=document.getElementById("idEscola");
      escola.style.display = "none";
      });
      
  </script>
  
  <?php
    }else if($_SESSION['Perfil_idPerfil']==1){ //admin...
  ?>

    <script>
      
      /*var elementosParaEsconder = ["idCardapio","idRelatorio","idArquivo",
      "idModEnsino","idNivEnsino","idPatologia","idSerie","idTurno",
      "idEscola","idTurma","idAluno","idPresenca"];

      var escondeNutri = ["idArquivo","idPresenca"];

      var escondeEscola = ["idCardapio",
      "idModEnsino","idNivEnsino","idPatologia","idTurno",
      "idEscola"];*/

    document.addEventListener("DOMContentLoaded", function() {
      var escola=document.getElementById("idCardapio");
      escola.style.display = "none";
      });
      
  </script>
  <?php
    }
  }
  ?>
<div>
  <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-expanded="true" aria-label="Toggle docs navigation">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false" role="img">
      <title>Menu</title>
      <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
    </svg>
  </button>
</div>
<nav class="col-12 col-xs-12 col-md-3 col-xl-2 d-md-block sidebar collapse show" id="bd-docs-nav" style> <!--aqui que coloca o toggler-->
  <div class="sidebar-sticky">
    <ul class="nav flex-column nav nav-pills" role="tablist" >
      <li class="nav-item">
        <a class="nav-link"  href="../MANUTENCAO.BLADE.PHP"><i class="fa fa-home"></i>
          &nbsp;Início</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#demo"><i  class="fa fa-book"></i>
          &nbsp;Cadastro <i class="fa fa-caret-down"></i></a>
      </li>
        <div class="collapse.show"  id="demo">
          <li class="nav-item" name="idCardapio" id="idCardapio">
            <a class="nav-link" role="button" href="../read/cardapio.blade.php">&nbsp; Cardápio</a>
          </li>
          <li class="nav-item" name="idModEnsino" id="idModEnsino">
            <a class="nav-link" role="button" href="../read/modEnsino.blade.php">&nbsp; Modalidade de ensino</a>
          </li>
          <li class="nav-item" name="idNivEnsino" id="idNivEnsino">
            <a class="nav-link" role="button" href="../read/nivEnsino.blade.php">&nbsp; Nível de ensino</a>
          </li>
          <li class="nav-item" name="idPatologia" id="idPatologia">
            <a class="nav-link" role="button" href="../read/patologia.blade.php">&nbsp; Restrição alimentar</a>
          </li>
          <li class="nav-item" name="idSerie" id="idSerie">
            <a class="nav-link" role="button" href="../read/serie.blade.php">&nbsp; Série</a>
          </li>
          <li class="nav-item" name="idTurno" id="idTurno">
            <a class="nav-link" role="button" href="../read/turno.blade.php">&nbsp; Turno</a>
          </li>
          <li class="nav-item" name="idEscola" id="idEscola">
            <a class="nav-link" role="button" href="../read/escola.blade.php">&nbsp; Escola</a>
          </li>
          <li class="nav-item" name="idTurma" id="idTurma">
            <a class="nav-link" role="button" href="../read/turma.blade.php">&nbsp; Turma</a>
          </li>
          <li class="nav-item" name="idAluno" id="idAluno">
            <a class="nav-link active" role="button" href="../read/aluno.blade.php">&nbsp; Aluno</a>
          </li>
          
        </div>

      <li class="nav-item" name="idPresenca" id="idPresenca">
        <a class="nav-link" href="../presenca-turma.blade.php"><i class="fa fa-user"></i>
          &nbsp;Registro por presença</a>
      </li>
      <li class="nav-item" name="idArquivo" id="idArquivo">
        <a class="nav-link" href="../arquivo.blade.php"><i class="fa fa-folder"></i>
          &nbsp;Registro via arquivo</a>
      </li>
      <li class="nav-item" name="idRelatorio" id="idRelatorio">
        <a class="nav-link" href="../relatorio.blade.php"><i class="fa fa-file-text"></i>
          &nbsp;Relatório</a>
      </li>
    </ul>
  </div>
</nav>

