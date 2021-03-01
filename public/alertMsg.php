<?php
    if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="robr"){
        echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Preencha todos os campos obrigatórios!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="radd"){
        echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Adicionado com sucesso!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rdel"){
        echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Deletado com sucesso!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ratt"){
        echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Atualizado com sucesso!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnna"){
        echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Você não fez nenhuma alteração!</div>';
    }elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rerr"){
        echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Ocorreu um erro <strong>Por favor, tente novamente!</strong></div>';
    }
?>