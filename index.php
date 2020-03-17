<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Upload de Arquivos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <style>
    html, body {
      height: 100%;
      width: 100%;
      margin: 0px;
      overflow: hidden;
    }
    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      background-color: rgb(63, 63, 63);
      text-align: center;
    }
    * {
      color: white;
      font-family: monospace;
      transition: 500ms;
    }
    div {
      width: 100%;
    }
    h3 {
      margin: 30px;
      text-align: center;
    }
    p {
      margin: 30px 0 0 0 ;
    }
    form {
      text-align: center;
      margin-top: 50px;
    }
    input {
      margin: 50px;
      border: 0;
    }
    #button {
      margin: 30px;
      color: black;
      padding: 20px;
      border: 0;
    }
    label {
      cursor: pointer;
      background-color: #dfdfdf;
      padding: 20px;
      margin: 50px;
      color: black;
    }
    #fileToUpload {
      position: absolute;
      width: 0px;
      opacity: 0;
      padding: 0px;
      margin: 0px;
      z-index: -10;
    }
    a {
      cursor: pointer;
    }
    #lista {
      margin-top: 40px;
      max-height: 150px;
      display: none;
      overflow-y: scroll;
      overflow-x: hide;
    }
  </style>

<div>
  <?php
    if (isset($_GET['status'])){
      if ($_GET['status'] == "1"){
        echo '<h2 style="color: green">Arquivo <span style="color: limegreen">"'. $_GET['nome'] .'"</span> salvo!</h2>';
      } elseif($_GET['status'] == "0"){
        echo '<h2 style="color: crimson">Erro ao salvar <span style="color: red">"'. $_GET['nome'] .'"</span>!</h2>';
      } elseif($_GET['status'] == "-1"){
        echo '<h2 style="color: crimson">Erro no servidor <span style="color: red">"'. $_GET['nome'] .'"</span>!</h2>';
      }
    }
  ?>
  <h3>Selecione o arquivo:</h3>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">Browse...</label>
    <input type="file" name="fileToUpload" id="fileToUpload" onchange="setName(this)">
    <p id="label"></p>
    <input id="button" type="submit" name="submit" value="Enviar"></input>
  </form>
  <a onclick="listFile()">Lista de arquivos:</a>
  <div id="lista">

    <?php

      $files = scandir('./arquivos');

      foreach ($files as $i => $v) {
        if ($i == 0 || $i == 1){
          echo '';
        } else {
          echo '<a href="/arquivos/' . $v . '" target="_blank">' . $v . '</a><br><br>';
        };
      };

    ?>

  </div>
</div>
  
<script>
function setName(t){
  document.getElementById('label').innerText = t.files[0].name;
}
function listFile(e){
  var estado = document.getElementById("lista").style.display
  if (estado == 'block'){
    document.getElementById("lista").style.display = 'none';
  } else {
    document.getElementById("lista").style.display = 'block'
  }
}
</script>

</body>
</html>