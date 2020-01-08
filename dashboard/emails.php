<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-mails</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" class="style">

</head>
<body>

<?php require_once("inc/header.php") ?>

    <div class="container py-5" >

        <div class="card-columns">
            
           
            <div class="card bg-dark text-white text-center p-3">
              <blockquote class="blockquote mb-0">
                <p>Total de Contatos</p>
                <h4><p id="nSend"></p></h4>
                
              </blockquote>
            </div>
            
            <div class="card bg-dark text-white text-center p-3">
                <blockquote class="blockquote mb-0">
                  <p>Total de Distribuidores</p>
                  <h4><p id="nSendd"></p></h4>
                </blockquote>
              </div>
              <div class="card bg-warning text-white text-center p-3 disabled">
                  <blockquote class="blockquote mb-0">
                    <p>Relatórios</p>
                    <h4><p id="">Em breve</p></h4>
                  </blockquote>
                </div>
                </div>

        
        
        <ul class="nav nav-tabs py-3" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active text-secondary" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Contato </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Seja um Distribuidor</a>
            </li>
            
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              
                <table class="table" id="usuarios_table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Assunto</th>
                        <th scope="col">Mensagem</th>
                        
                      </tr>
                    </thead>
                    <tbody id="myTable">
                          
                      </tbody>
                  </table>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <table class="table" id="distribuidores">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Mensagem</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody id="myTable">
                          
                      </tbody>
                  </table>

            </div>
          </div>

    

<script>
  $.getJSON("json/contato.json", (data) =>{
    console.log(data.usuarios)
     var i = 0;
    $.each(data.usuarios, (key, value) => {
      $('#usuarios_table').append(
        `<tr> 
          <td>${value.nome}</td> 
          <td>${value.email}</td> 
          <td>${value.telefone}</td> 
          <td>${value.assunto}</td> 
          <td>${value.mensagem}</td> 
           
        </tr>`);

        i += 1;
    });
    $('#nSend').append(i);

  });
</script>

<script>
  $.getJSON("json/distribuidores.json", (data) =>{
    console.log(data.usuarios)
     var i = 0;
    $.each(data.usuarios, (key, value) => {
      $('#distribuidores').append(
        `<tr> 
          <td>${value.nome}</td> 
          <td>${value.email}</td> 
          <td>${value.telefone}</td> 
          <td>${value.estado}</td> 
          <td>${value.quantidade}</td> 
          <td>${value.mensagem}</td> 
         
           
        </tr>`);

        i += 1;
    });
    $('#nSendd').append(i);

  });
</script>

    



    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>