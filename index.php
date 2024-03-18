<!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ALLBINS destruizeus</title>
              <link rel="icon" type="image/png" href="" class="rounded-circle">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/style.css?v=1.0.0" rel="stylesheet" />
    <link href="assets/demo/demo.css" rel="stylesheet" />
  </head>
  <body>
    <div class="col-md-11 mt-4" style="margin: auto;">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body text-center">
              <h4  class="title mb-2">ALLBINS AMAZON destruizeus<img src="" class="rounded" width="65"</h4>
              <textarea style="height: 8.06rem;" class="form-control text-center form-checker mb-2" placeholder="INSIRA SUA LISTA (500 GGS)"></textarea>
              <button class="btn btn-primary btn-play text-white" style="width: 49%; float: left;"><i class="fa fa-play"></i> INICIAR</button>
              <button class="btn btn-danger btn-stop text-white" style="width: 49%; float: right;" disabled><i class="fa fa-stop"></i> PARAR</button>
                              <input type="text" class="input_text blackbb text-white form-control" id="cookie1" name="cookie" value="" placeholder="COOKIE AMAZON BR"   style="warning: 35%; float: left;">
<input type="text" class="input_text blackbb text-white form-control" id="cookie2" name="cookie" value="" placeholder="COOKIE AUDIBLE"   style="warning: 35%; float: left;">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="title"><img src="" width="25"</i> Aprovadas<span class="badge badge-success float-right aprovadas">0</span></h5><hr>

              <h5 class="title"><img src="https://me.org.br/wp-content/uploads/2018/12/x-png-33.png" width="15"</i>   Reprovadas<span class="badge badge-danger float-right reprovadas">0</span></h5><hr>

              <h5 class="title"><img src="https://www.comprasustentavel.com.br/wp-content/uploads/2018/08/Reciclagem-do-plastico-perigo-eminente-1.png" width="15"</i> Testadas<span class="badge badge-warning float-right testadas">0</span></h5><hr>

              <h5 class="title mb-0"><img src="https://image.flaticon.com/icons/png/512/1571/1571772.png" width="15"</i> Carregadas<span class="badge badge-info float-right carregadas">0
			  </div>
			 </div>
			  </span></h5>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <div class="float-right">
                <button type="show" class="btn btn-primary btn-sm show-lives"><i class="fa fa-eye-slash"></i></button>
                <button class="btn btn-success btn-sm btn-copy"><i class="fa fa-copy"></i></button>
              </div>
              <h4 class="title mb-1"><i class="fa fa-check text-info"></i> APROVADAS</h4>
              <div id='lista_aprovadas'></div>
            </div>
          </div>
        </div>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <div class="float-right">
                <button type='hidden' class="btn btn-warning btn-sm show-dies"><i class="fa fa-eye"></i></button>
                <button class="btn btn-danger btn-sm btn-trash"><i class="fa fa-trash"></i></button>
              </div>
              <h4 class="title mb-1"><i class="fa fa-times text-danger"></i> REPROVADAS</h4>
              <div style='display: none;' id='lista_reprovadas'></div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>

<script>
  $(document).ready(function(){

Swal.fire({
  title: "<font style=color:#292929>Atenção",
  icon:"warning",
  html: "<font style=color:#1C1C1C>A cada 1 live será descontado 1.50 Limite 150 Linhas",
  confirmButtonText: "Ok!",
  confirmButtonColor: "#3CB371",
});

    getSaldo();

    $('.show-lives').click(function() {
      var type = $('.show-lives').attr('type');
      $('#lista_aprovadas').slideToggle();
      if (type == 'show') {
        $('.show-lives').html('<i class="fa fa-eye"></i>');
        $('.show-lives').attr('type', 'hidden');
      } else {
        $('.show-lives').html('<i class="fa fa-eye-slash"></i>');
        $('.show-lives').attr('type', 'show');
      }
    });

    $('.show-dies').click(function() {
      var type = $('.show-dies').attr('type');
      $('#lista_reprovadas').slideToggle();
      if (type == 'show') {
        $('.show-dies').html('<i class="fa fa-eye"></i>');
        $('.show-dies').attr('type', 'hidden');
      } else {
        $('.show-dies').html('<i class="fa fa-eye-slash"></i>');
        $('.show-dies').attr('type', 'show');
      }
    });

    $('.btn-trash').click(function() {
      Swal.fire({
        title: 'Lista de Reprovadas Limpa!',
        icon: 'success',
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        timer: 3000
      });
      $('#lista_reprovadas').text('');
    });

    $('.btn-copy').click(function() {
      Swal.fire({
        title: 'Lista de Aprovadas Copiada!',
        icon: 'success',
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        timer: 3000
      });
      var lista_lives = document.getElementById('lista_aprovadas').innerText;
      var textarea = document.createElement("textarea");
      textarea.value = lista_lives;
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand('copy');
      document.body.removeChild(textarea);
    });

    $('.btn-play').click(function() {
      var lista = $('.form-checker').val().trim();
      var array = lista.split('\n');
      var lives = 0,
        dies = 0,
        testadas = 0,
        txt = '';

      if (!lista) {
        Swal.fire({
          title: 'Erro: Lista Vazia!',
          icon: 'error',
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
          timer: 3000
        });
        return false;
      }

      Swal.fire({
        title: 'Teste Iniciado!',
        icon: 'success',
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
        timer: 3000
      });

      var line = array.filter(function(value) {
        if (value.trim() !== "") {
          txt += value.trim() + '\n';
          return value.trim();
        }
      });

      var total = line.length;
      var token = $('#token').val();

      $('.form-checker').val(txt.trim());

      if (total > 500) {
        Swal.fire({
          title: 'Limite de 500 Linhas Exedido!',
          icon: 'warning',
          showConfirmButton: false,
          toast: true,
          position: 'top-end',
          timer: 3000
        });
        return false;
      }

      $('.carregadas').text(total);
      $('.btn-play').attr('disabled', true);
      var cookie1 = document.getElementById("cookie1").value;
      var cookie2 = document.getElementById("cookie2").value;
      $('.btn-stop').attr('disabled', false);


      var audioLive = new Audio('audio.mp3');
	  
      function processLine(index) {
        if (index >= total) {
          Swal.fire({
            title: 'Teste Finalizado!',
            icon: 'success',
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timer: 3000
          });
          $('.btn-play').attr('disabled', false);
          $('.btn-stop').attr('disabled', true);
          return;
        }

        var data = line[index];
        var callBack = $.ajax({
          url: 'api.php?lista=' + data + '&token=' + token,
            type: "POST",
  data: {
    'lista': data, 
    'cookie1': cookie1, 
    'cookie2': cookie2, 
},
          success: function(retorno) {
            if (retorno.indexOf("Aprovada") >= 0) {
              Swal.fire({
                title: '+1 Aprovada!',
                icon: 'success',
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timer: 3000
              });
              $('#lista_aprovadas').append(retorno);
              removelinha();
              getSaldo();
              lives = lives + 1;
			  audioLive.play();
            } else {
              $('#lista_reprovadas').append(retorno);
              removelinha();
              dies = dies + 1;
            }
            testadas = lives + dies;
            $('.aprovadas').text(lives);
            $('.reprovadas').text(dies);
            $('.testadas').text(testadas);

            setTimeout(function() {
              processLine(index + 1); // Chamada recursiva para a próxima linha após um pequeno atraso
            }, 150); // Ajuste o valor do atraso (em milissegundos) conforme necessário
          }
        });

        $('.btn-stop').click(function() {
          Swal.fire({
            title: 'Teste Parado!',
            icon: 'warning',
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timer: 3000
          });
          $('.btn-play').attr('disabled', false);
          $('.btn-stop').attr('disabled', true);
          callBack.abort();
          return false;
        });
      }

      processLine(0); // Inicia o processamento da primeira linha
    });

    function removelinha() {
      var lines = $('.form-checker').val().split('\n');
      lines.splice(0, 1);
      $('.form-checker').val(lines.join("\n"));
    }

    function getSaldo() {
      $.get('../../getSaldo.php', function(saldo) {
        $('.saldo').text(saldo);
      });
    }
  });
</script>


</body>
</html>