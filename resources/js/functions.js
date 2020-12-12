function notify(from, align, icon, type, animIn, animOut, msg){
    $.notify({
      icon: icon,
      title: '',
      message: msg,
      url: ''
    },{
      element: 'body',
      type: type,
      allow_dismiss: true,
      placement: {
        from: from,
        align: align
      },
      offset: {
        x: 20,
        y: 20
      },
      spacing: 10,
      z_index: 1031,
      delay: 2500,
      timer: 1000,
      url_target: '_blank',
      mouse_over: false,
      animate: {
        enter: animIn,
        exit: animOut
      },
      template:   '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
      '<span data-notify="icon"></span> ' +
      '<span data-notify="title">{1}</span> ' +
      '<span data-notify="message">{2}</span>' +
      '<div class="progress" data-notify="progressbar">' +
      '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
      '</div>' +
      '<a href="{3}" target="{4}" data-notify="url"></a>' +
      '<button type="button" aria-hidden="true" data-notify="dismiss" class="alert--notify__close">X</button>' +
      '</div>'
    });
  }
  
  $('.notifications-demo > .btn').click(function(e){
    e.preventDefault();
    var nFrom = $(this).attr('data-from');
    var nAlign = $(this).attr('data-align');
    var nIcons = $(this).attr('data-icon');
    var nType = $(this).attr('data-type');
    var nAnimIn = $(this).attr('data-animation-in');
    var nAnimOut = $(this).attr('data-animation-out');
  
    notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut, msg);
  });
  
  
  function alerta(tipo){
    switch(tipo){
      case 0:
      notify('top', 'right', 'fa fa-check', 'success', 'animated bounceInLeft', 'animated bounceOutLeft', 'SessÃ£o aberta com sucesso!');
      break
  
      case 1:
      notify('top', 'right', '', 'success', 'animated bounceInLeft', 'animated bounceOutLeft', 'SessÃ£o atualizada com sucesso!');
      break
  
      case 2:
      notify('top', 'right', '', 'danger', 'animated bounceInLeft', 'animated bounceOutLeft', 'NÃ£o Ã© possÃ­vel abrir uma nova sessÃ£o enquanto outra estiver aberta!');
      break
  
      case 3:
      notify('top', 'right', '', 'danger', 'animated bounceInLeft', 'animated bounceOutLeft', 'Erro ao abrir uma sessÃ£o!');
      break
  
      case 4:
      notify('top', 'right', '', 'danger', 'animated bounceInLeft', 'animated bounceOutLeft', 'Erro ao atualizar uma sessÃ£o!');
      break
  
      case 5:
      notify('top', 'right', '', 'danger', 'animated bounceInLeft', 'animated bounceOutLeft', 'Erro ao remover uma sessÃ£o! Verifique se nÃ£o hÃ¡ nada vinculado a ela!');
      break
  
      case 6:
      notify('top', 'right', '', 'success', 'animated bounceInLeft', 'animated bounceOutLeft', 'SessÃ£o removida com sucesso!');
      break
  
      case 7:
      notify('top', 'right', '', 'warning', 'animated bounceInLeft', 'animated bounceOutLeft', 'Nenhum questionÃ¡rio disponÃ­vel para ser aplicado ao paciente!');
      break
  
      case 8:
      notify('top', 'right', '', 'warning', 'animated bounceInLeft', 'animated bounceOutLeft', 'Ã‰ necessÃ¡rio que tenha uma sessÃ£o aberta para poder abrir o questionÃ¡rio!');
      break
  
      default:
      notify('top', 'right', '', 'warning', 'animated bounceInLeft', 'animated bounceOutLeft', '${tipo}');
      break
    }
  }
  
  function dataBR($x){
    $data = $x.split("-");
    return $data[2] + "/" + $data[1] + "/" + $data[0];
  }
  
  function dataAM($x){
    $data = $x.split("/");
    return $data[2] + "-" + $data[1] + "-" + $data[0];
  }
  
  function forceKeyPressUppercase(e){
    var charInput = e.keyCode;
    if((charInput >= 97) && (charInput <= 122)) { // lowercase
      if(!e.ctrlKey && !e.metaKey && !e.altKEY) { // no modifier key
        var newChar = charInput - 32;
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
        e.target.setSelectionRange(start+1, start+1);
        e.preventDefault();
      }
    }
  }
  
  function listarSessao(data, rota){
    if(data.error == null){
      $("#listagem-sessao").html("");
      var contador = Object.keys(data.sessoes).length
      data.sessoes.forEach(function(linha, index){
        console.log(linha)
        $("#listagem-sessao").append(`
          <tr class="` + ((linha.aberta == "S") ? `sessaoaberto` : ``) + `">
          <td class="text-center"><a class="editar" href="#!" data-id="` + linha.idSessao + `" data-toggle="modal" data-filter="editar" aria-expanded="false" aria-controls="collapseExample"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a></td>
          <td class="text-center"> ${contador} </td>
          <td class="text-center">` + dataBR(linha.dataSessao) + ` ` + linha.horaSessao + `</td>
          <td class="text-center">` + ((linha.dataFinal != null) ? dataBR(linha.dataFinal) : "Em aberto") + ` ` + ((linha.horaFinal != null) ? linha.horaFinal : "") + `</td>
          <td class="text-center">` + linha.dorInicio + `/` + linha.dorFim + `</td>
          <td class="text-center">` + ((linha.nome != null) ? linha.nome : '') + `</td>
          <td class="text-center">` + linha.nome_func + `</td>
          <td class="text-center">` + ((linha.aberta == "S") ? `Sim` : `NÃ£o`) + `</td>
          <td class="text-center">` + ((linha.fnj == "S") ? `Sim` : `NÃ£o`) + `</td>
          <td class="text-center">
          <a class="editar" href="#!"  data-toggle="modal" data-target="#modal-alert-` + linha.idSessao + `" data-id="` + linha.idSessao + `"><i class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
          <div class="modal fade" id="modal-alert-` + linha.idSessao + `" tabindex="-1">
          <div class="modal-dialog modal-sm">
          <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title pull-left"><i class="zmdi zmdi-alert-triangle"></i> AtenÃ§Ã£o</h5>
          </div>
          <div class="modal-body">
          <div class="row">
          <div class="col-sm-12" id="mensagem-alert">
          VocÃª tem certeza que deseja remover esta sessÃ£o? <br>Essa aÃ§Ã£o nÃ£o poderÃ¡ ser desfeita.
          </div>
          </div>
          <div class="text-right btn-salvar">
          <a href="#!" class="btn btn-primary waves-effect excluir-sessao" data-id="` + linha.idSessao + `">Remover</a>
          <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
          </div>
          </div>
          </div>
          </div>
          </div>
          </td>
          </tr>
          <tr>
          <td colspan="9">
          <div class="row">
          <div class="col-sm-12" id="linha-${linha.idSessao}"></div>
          </div>
          <div>${linha.observacao != null ? linha.observacao.replace("\n","<br>").replace("\n","<br>") : ''}</div>
          </td>
          </tr>
          `)
          contador--
  
          $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: rota,
            dataType: 'JSON',
            data: {
              sessao: linha.idSessao,
            }
          }).done(function (data1) {
            data1.estagiocategorias.forEach(element => {
              $('#linha-' + linha.idSessao).append(element.nomeestagiocategoria + ', ')
            });
          })
        })
      }else{
        alerta(3)
      }
    }