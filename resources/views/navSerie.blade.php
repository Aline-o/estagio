<nav class="col-md-2 d-none d-md-block sidebar"> <!--aqui que coloca o toggler-->
    <div class="sidebar-sticky">
      <ul class="nav flex-column nav nav-pills" role="tablist" >
        <li class="nav-item">
          <a class="nav-link"  href="../MANUTENCAO.BLADE.PHP"><i class="fa fa-home"></i>
            &nbsp;Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#demo"><i  class="fa fa-book"></i>
            &nbsp;Cadastro <i class="fa fa-caret-down"></i></a>   <!--  -->
        </li>

        <div class="collapse.show"  id="demo"> <!--onClick="window.location.reload();"-->
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/aluno.blade.php">&nbsp; Aluno</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/cardapio.blade.php">&nbsp; Cardápio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/escola.blade.php">&nbsp; Escola</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/modEnsino.blade.php">&nbsp; Modalidade de ensino</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/nivEnsino.blade.php">&nbsp; Nível de ensino</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" role="button" href="../read/serie.blade.php">&nbsp; Série</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/turma.blade.php">&nbsp; Turma</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="button" href="../read/turno.blade.php">&nbsp; Turno</a>
          </li>
        </div>
        <li class="nav-item">
          <a class="nav-link" href="../MANUTENCAO.BLADE.PHP"><i class="fa fa-user"></i>
            &nbsp;Registro por presença</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../MANUTENCAO.BLADE.PHP"><i class="fa fa-folder"></i>
            &nbsp;Registro via arquivo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../MANUTENCAO.BLADE.PHP"><i class="fa fa-file-text"></i>
            &nbsp;Relatório</a>
        </li>
      </ul>
    </div>
  </nav>
