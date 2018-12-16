<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>HACKATHON MVP - DASA</title>
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery-3.3.1.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark" style=" background-color: #302892">
            <a class="navbar-brand" href="#">DASA - HACKATHON   | </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Agendamento <span class="sr-only">(current)</span></a>
                </li>
              </ul>
              <span class="navbar-text">
                <i class="fas fa-sign-out-alt"></i>  Sair
              </span>
            </div>
        </nav>
        <div class="row">
            <div class="col-3" id="agendamentos" style="border-right: 1px solid #CCC; padding: 0px !important; height: 100vh;">
    
            </div>
            <div class="col-9 ">
                <div class="container-fluid">
                    <h2>Notificações</h2>
                    <hr>
                    <div class="container-fluid" id="notificacoes">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lista de Espera</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="">Cadastro lista de espera</h3>
                    <form>
                        <div class="form-group">
                            <label for="exampleInput1">Nome</label>
                            <input type="nome" class="form-control" id="nome" aria-describedby="" placeholder="Insira o nome">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput2">Telefone</label>
                            <input type="telefone" class="form-control" id="telefone" aria-describedby="" placeholder="Insira o telefone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput1">Tempo de Chegada</label>
                            <input type="nome" class="form-control" id="tempo" aria-describedby="" placeholder="Insira o tempo">
                        </div>
    
                        <button type="button" id="saveListBtn" onclick="saveList()" class="btn btn-primary">Cadastrar</button>
                    </form>
                    <hr>
                    <div class="card" >
                        <div class="card-header">
                            Lista de espera
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>#</th>
                                </thead>
                                <tbody id="lista-espera">

                                </tbody>
                                <tfoot>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>#</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
                </div>
            </div>
        </div>
    </body>
    <script>

        let id = 0;

        $(document).ready(function(){
            
            $.ajax({
                type: 'POST',
                url: 'assets/buscaAgendamentos.php',
                processData: false,
                contentType: false,
                success: function(response){
                    response = JSON.parse(response);
                    

                    for (let i = 0; i < response.length; i++) {
                        const element = response[i];
                        var text = '';
                        var color = '#000';
                        var back = '#FFF';

                        if(element.status_agendamento == 0){
                            text = 'Aguardando confirmação';
                            back = '#FFF';
                        }else if(element.status_agendamento == 1){
                            text = 'Agendamento confirmado';
                            color = 'green';
                            back = '#D4EDDA';
                        }else if(element.status_agendamento == 2){
                            text = 'Agendamento Cancelado';
                            color = '#c0392b';
                            back = '#FFF';
                        }
                        
                        $('#agendamentos').append('<div class="card-agendamento" style="background-color:'+back+'"> \
                                                        <span>'+element.hora+'</span> \
                                                        <p>'+element.nome+' <br/> <small style="color:'+color+'">'+text+'</small> </p> \
                                                        <div class="row icons"> \
                                                            <i style="color:green" onclick="confirmar('+element.id+')" class="far fa-thumbs-up"></i> \
                                                            <i style="color:red" onclick="rejeitar('+element.id+')" class="far fa-thumbs-down"></i> \
                                                            <i style="color:black" onclick="listaEspera('+element.id+')" class="far fa-clock"></i> \
                                                        </div> \
                                                    </div>');

                    }
                }
            })

            $.ajax({
                type: 'POST',
                url: 'assets/buscaNotificacao.php',
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    response = JSON.parse(response);

                    for (let i = 0; i < response.length; i++) {
                        const element = response[i];

                        if(element.mensagem.search('confirmou') !== -1){
                            $('#notificacoes').append('<div class="alert alert-success" role="alert"> \
                                                            '+element.mensagem+' \
                                                       </div>');
                        }else{
                            $('#notificacoes').append('<div class="alert alert-danger" role="alert"> \
                                                            '+element.mensagem+' \
                                                       </div>');
                        }
                        
                    }

                }
            })
        });
        
        function saveList(){
            var data = new FormData();
            data.append('nome', $('#nome').val());
            data.append('tel', $('#telefone').val());
            data.append('email', $('#email').val());
            data.append('tempo', $('#tempo').val());
            data.append('agendamento', id);
            
            $.ajax({
                type: 'POST',
                url: 'assets/saveList.php',
                data: data,
                processData: false,
                contentType: false,
                success: function(response){
                    if(response == 'true'){
                        alert('Cliente cadastrado na lista de espera.');
                    }else{
                        alert('Erro ao cadastrar cliente');
                    }
                }
            })
        }

        function confirmar(agendamento){
            var data = new FormData();
            data.append('agendamento', agendamento);
            
            $.ajax({
                type: 'POST',
                url: 'assets/confirmarAgendamento.php',
                data: data,
                processData: false,
                contentType: false,
                success: function(response){
                    if(response == 'true'){
                        alert('Agendamento confirmado com sucesso.');
                    }else{
                        alert('Erro ao confirmar agendamento.');
                    }

                    window.location.reload();
                }
            })

        }

        function rejeitar(agendamento){

            if(confirm('Tem certeza disso? Ao cancelar o agendamento o seu horário será remanejado para a lista de espera.')){
                var data = new FormData();
                data.append('agendamento', agendamento);
                
                $.ajax({
                    type: 'POST',
                    url: 'assets/rejeitarAgendamento.php',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        if(response == 'true'){
                            alert('Agendamento cancelado! Marque outro horário.');
                        }else{
                            alert('Erro ao cancelar agendamento.');
                        }

                        window.location.reload();
                    }
                });
            }

        }
        
        function listaEspera(agendamento){
            $('#exampleModal').modal('show');
            id = agendamento
            $('#saveListBtn').attr({ 'data-id': agendamento });
            $('#lista-espera').html('');

            var data = new FormData();
            data.append('agendamento', agendamento);

            $.ajax({
                type: 'POST',
                url: 'assets/buscarListaEspera.php',
                data: data,
                processData: false,
                contentType: false,
                success: function(response){
                    response = JSON.parse(response);

                    for (let i = 0; i < response.length; i++) {
                        const element = response[i];
                        console.log(element);
                        
                        var del = '<a class="btn btn-danger" onclick="deleteList('+element.id+')"><i class="fa fa-times"></i></a>';
                        
                        $('#lista-espera').append('<tr> \
                                                        <td>'+element.id+'</td> \
                                                        <td>'+element.nome+'</td> \
                                                        <td>'+del+'</td> \
                                                   </tr>')

                    }

                }
            });

        }

        function deleteList(iditem){
            var data = new FormData();
            data.append('id', iditem);

            $.ajax({
                type: 'POST',
                url: 'assets/deleteFromList.php',
                data: data,
                processData: false,
                contentType: false,
                success: function(response){
                    if(response == 'true'){
                        alert('Cliente apagado da lista de espera.');
                    }else{
                        alert('Erro ao apagar cliente da lista');
                    }

                     $('#exampleModal').modal('hide');
                     $('#exampleModal').modal('show');
                }
            });
        }

    </script>
</html>