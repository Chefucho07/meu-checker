// set audios vars.
var audioCompleted = new Audio('live.mp3');
var audioStart = new Audio('live.mp3');
var audioLive = new Audio('live.mp3');
var audioClean = new Audio('live.mp3');

function limpar() {
  
  var ccs = $('#ccs').val();  
  
  if (ccs.length == 0) {
    //#Update Status Label.
    document.getElementById("demo").innerHTML = '<div class="label label-danger animation-fadeInQuick"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Lista já está limpa!</div>';
    audioClean.play();

    //#Display CSS Notification.
    $.bootstrapGrowl('<h4><strong> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Erro!</strong></h4> <p> <i class="fa fa-trash" aria-hidden="true"></i> Sua lista já está limpa.</p>', {
         type: 'danger',
         delay: 3000,
         allow_dismiss: true,
         offset: {from: 'top', amount: 20}
        });

      return;
  
    }

  else {
    //#Update Status Label.
    document.getElementById("demo").innerHTML = '<div class="label label-info animation-fadeInQuick"> <i class="fa fa-trash" aria-hidden="true"></i> Lista limpa!</div>';
    document.getElementById("ccs").value = '';    
    audioClean.play();

    //#Display CSS Notification.
    $.bootstrapGrowl('<h4><strong> <i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p> <i class="fa fa-trash" aria-hidden="true"></i> Sua lista foi limpa.</p>', {
         type: 'success',
         delay: 3000,
         allow_dismiss: true,
         offset: {from: 'top', amount: 20}
        });

  }

}

function resetStats() {

  document.getElementById("carregada").innerHTML = '0';

  document.getElementById("testado").innerHTML = '0';

  document.getElementById("CLIVE").innerHTML = '0';

  document.getElementById("CDIE").innerHTML = '0';

  $('.tooltip').not(this).hide();

  $.bootstrapGrowl('<h4><strong> <i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p><i class="fa fa-repeat fa-lg" aria-hidden="true"></i> Contador resetado!', {
   type: 'info',
   delay: 3000,
   allow_dismiss: true,
   offset: {from: 'top', amount: 20}
  });

  document.getElementById("resetStats").disabled = true;
  setTimeout(function(){document.getElementById("resetStats").disabled = false;},3000);

}

function cleanLives() {
  document.getElementById("aprovadas").innerHTML = '';

  //#Display CSS Notification.
  $.bootstrapGrowl('<h4><strong> <i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p> <i class="fa fa-trash" aria-hidden="true"></i> Sua lista de <strong>aprovadas</strong> foi limpa.</p>', {
       type: 'success',
       delay: 3000,
       allow_dismiss: true,
       offset: {from: 'top', amount: 20}
      });
}

function cleanDeads() {
  document.getElementById("cleanDeads").disabled = true;
  setTimeout(function(){document.getElementById("cleanDeads").disabled = false;},3000);

  document.getElementById("reprovadas").innerHTML = '';

  $('.tooltip').not(this).hide();

  $.bootstrapGrowl('<h4><strong><i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p> <i class="fa fa-trash" aria-hidden="true"></i> Sua lista de <strong>reprovadas</strong> foi limpa.</p>', {
       type: 'success',
       delay: 3000,
       allow_dismiss: true,
       offset: {from: 'top', amount: 20}
      });
}

$("button[id=CopyLIVES]").click(function () {
  var el = document.getElementById("aprovadas");
  var range = document.createRange();
  range.selectNodeContents(el);
  var sel = window.getSelection();
  sel.removeAllRanges();
  sel.addRange(range);
  document.execCommand('copy');
  window.getSelection().removeAllRanges();

  $.bootstrapGrowl('<h4><strong> <i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p> <i class="fa fa-clipboard" aria-hidden="true"></i> Aprovadas foram copiadas.</p>', {
      type: 'info',
      delay: 3000,
      allow_dismiss: true,
      offset: { from: 'top', amount: 20 }
  });

  document.getElementById("copyBtn").disabled = true;
  document.getElementById("copyBtn").innerHTML = "<i class=\"fa fa-check\" aria-hidden=\"true\"></i> Copiado!";
  setTimeout(function () { document.getElementById("copyBtn").disabled = false; }, 3000);
  setTimeout(function () { document.getElementById("copyBtn").innerHTML = "<i class=\"fa fa-clipboard\" aria-hidden=\"true\"></i> Copiar Aprovadas"; }, 3000);
});



  function rmLinha(id) {
    var lines = $(id).val().split('\n');
    lines.splice(0, 1);
    $(id).val(lines.join("\n"));
  }

  function start() {   

  var ccs = $('#ccs').val();

    if (ccs.length == 0) {
    document.getElementById("demo").innerHTML = '<div class="label label-danger animation-fadeInQuick"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Carregue sua lista!</div>';
    // audioStart.play();
  
    //#Display CSS Notification.
    $.bootstrapGrowl('<h4><strong> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Erro!</strong></h4> <p> <i class="fa fa-play-circle" aria-hidden="true"></i> Carregue sua lista.</p>', {
       type: 'danger',
       delay: 3000,
       allow_dismiss: true,
       offset: {from: 'top', amount: 20}
      });

      return;
  }

  else {
   
    document.getElementById("demo").innerHTML = '<div class="label label-success animation-fadeInQuick"> <i class="fa fa-play-circle" aria-hidden="true"></i> Iniciado!</div>';
    // App.sidebar('close-sidebar');
    // audioStart.play();

    document.getElementById("submit").disabled = true;
    setTimeout(function(){document.getElementById("submit").disabled = false;},3000);

    //#Display CSS Notification.
    $.bootstrapGrowl('<h4><strong><i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p> Teste iniciado, aguarde resultados.</p>', {
       type: 'success',
       delay: 3000,
       allow_dismiss: true,
       offset: {from: 'top', amount: 20}
      });
  }

  var i;
  var ccs = $('#ccs').val();
  var cc = ccs.split("\n");
  var separador = $('#separador').val();

  for (i = 0; i < cc.length; i++) {
    var cc2 = cc[i];
    var id = i;
    check(cc2, separador, id)
  }

  var textarea = document.getElementById("ccs").value;
  var textareacount = textarea.split('\n');
  var textareaMatch = count(textareacount, 'COUNT_RECURSIVE');

  var myString = textarea;
  var myArray = listToArray(myString, '\n');

  document.getElementById("carregada").innerHTML = textareaMatch;

  for (var i = 0; i < textareaMatch; i++) {
    
    var cclst = myArray[i];
    var cemail = cclst.split("|");
    var csids = 'csid_' + i;
    var ccids = 'ccid_' + i;

    var output = document.getElementById("ccs").value;

    var replaced = ccs.split('\n');

    for (var i = replaced.length; i < 0; i++) {
      var item = replaced[i].split('|');
    }

    output = output.replace(cclst, "");
    output = output.replace("\n", "");
    document.getElementById("ccs").innerHTML = output;

    }
  }

  var a = 1;
  var b = 2;
  var myLink = "posts/" + server;

  function check(cc2, separador, id) {
    setTimeout(function() {
      $.ajax({
        type: 'GET',
        url: 'api.php',
        dataType: 'html',
        data: {
          'testar': 'cc',
          'lista': cc2,
          'separador': separador},

        success: function(msg)


        {

          
          document.getElementById("testado").innerHTML = (eval(document.getElementById("testado").innerHTML) + 1);

          // Check if something is wrong with the user's account.
          if (msg.indexOf('"error":99') > 0) { var obj = JSON.parse(msg); displayModal(obj.msg); }

          if (msg.indexOf("Aprovada") > 0) {
         
            document.getElementById("CLIVE").innerHTML = (eval(document.getElementById("CLIVE").innerHTML) + 1);
            $("#aprovadas").append(msg);
            rmLinha('#ccs');            
            audioLive.play();

            //# Decrement from sidebar balance.
            

            //#Display CSS Notification.
            $.bootstrapGrowl('<h4><strong>Sucesso!</strong></h4> <b>+1</b> ' + type_txt + ' aprovado!', {
               type: 'success',
               delay: 3000,
               allow_dismiss: true,
               offset: {from: 'top', amount: 20}
              });

              document.getElementById("demo").innerHTML = '<div class="label label-success animation-fadeInQuick"><i class="fa fa-check-circle" aria-hidden="true"></i> Aprovada!</div>';

              checkCompleted();

              setTimeout(
                              function() {
                                  document.getElementById("demo").innerHTML = '<div class="label label-info animation-fadeInQuick"> <i class="fa fa-spinner fa-spin fa-fw"></i> Testando.</div>';
                              }, 500);
                          setTimeout(
                              function() {
                                  document.getElementById("demo").innerHTML = '<div class="label label-info"> <i class="fa fa-spinner fa-spin fa-fw"></i> Testando..</div>';
                              }, 750);
                          setTimeout(
                              function() {
                                  document.getElementById("demo").innerHTML = '<div class="label label-info"> <i class="fa fa-spinner fa-spin fa-fw"></i> Testando...</div>';
                              }, 1000);
                          console.log('{"Success":"', document.getElementById("testado").innerHTML, '":"true"}')

          }

          else {
            $("#reprovadas").append(msg);
            rmLinha('#ccs');

          
            document.getElementById("CDIE").innerHTML = (eval(document.getElementById("CDIE").innerHTML) + 1);
            document.getElementById("demo").innerHTML = '<div class="label label-danger animation-fadeInQuick"><i class="fa fa-times-circle" aria-hidden="true"></i> Reprovada!</div>';

            checkCompleted(); 

            setTimeout(
                              function() {
                                  document.getElementById("demo").innerHTML = '<div class="label label-info animation-fadeInQuick"> <i class="fa fa-spinner fa-spin fa-fw"></i> Testando.</div>';
                              }, 500);
                          setTimeout(
                              function() {
                                  document.getElementById("demo").innerHTML = '<div class="label label-info"> <i class="fa fa-spinner fa-spin fa-fw"></i> Testando..</div>';
                              }, 750);
                          setTimeout(
                              function() {
                                  document.getElementById("demo").innerHTML = '<div class="label label-info"> <i class="fa fa-spinner fa-spin fa-fw"></i> Testando...</div>';
                              }, 1000);
                          console.log('{"Success":"', document.getElementById("testado").innerHTML, '":"false"}')
          }
        }
      });
    }, id * 2000);
}

function listToArray(fullString, separator) {
  var fullArray = [];

  if (fullString !== undefined) {
    if (fullString.indexOf(separator) == -1) {
      fullArray.push(fullString);
    }

    else {
      fullArray = fullString.split(separator);
    }
  }

  return fullArray;

}


function count(mixed_var, mode) {
  var key, cnt = 0;

  if (mixed_var === null || typeof mixed_var === 'undefined') {
    return 0;
  }

  else if (mixed_var.constructor !== Array && mixed_var.constructor !== Object) {
    return 1;
  }

  if (mode === 'COUNT_RECURSIVE') {
    mode = 1;
  }

  if (mode != 1) {
    mode = 0;
  }

  for (key in mixed_var) {
        if (mixed_var.hasOwnProperty(key)) {
            cnt++;
            if (mode == 1 && mixed_var[key] && (mixed_var[key].constructor === Array || mixed_var[key].constructor ===
                    Object)) {
                cnt += this.count(mixed_var[key], 1);
            }
        }
    }

    return cnt;

}

function pushcsB(c, p) {
  document.getElementById(p).innerHTML = document.getElementById(p).innerHTML + c + "\n<br>";
}

function checkCompleted() {
  if (document.getElementById("ccs").value == "") {    
    audioCompleted.play();
  
  document.getElementById("demo").innerHTML = '<div class="label label-vip animation-fadeInQuick"><i class="fa fa-check-circle" aria-hidden="true"></i> Teste completo!</div>';

  $.bootstrapGrowl('<h4><strong> <i class="fa fa-check-circle" aria-hidden="true"></i> Sucesso!</strong></h4> <p> <i class="fa fa-flag" aria-hidden="true"></i> Teste completo!', {
     type: 'info',
     delay: 3000,
     allow_dismiss: true,
     offset: {from: 'top', amount: 20}
    });

  throw ("Checker finished at " + new Date().toLocaleString('pt-BR'));
  }
}