<!DOCTYPE html>
  <html>
    <head>
      <title>Reembolsa Fácil </title>
        <meta charset="utf-8">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
            <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->
              <link rel="stylesheet" type="text/css" href="css/style.css">
                </head>
                  <body>
                    <header id="topo">
                      <img src="img\landrover.jpg">
                        <h1>Reembolsa Fácil</h1>
<?php
  include("sessao.php")?>
  <?php
    include("validacoes.php")?>
                  
</header>
  <?php
    include("componentes/navbar.php") ?>
                   
                <!-- sintaxe do botão <button type="submit" onsubmit="valida()"class="btn btn-primary">Submit</button>!-->

<section>                        
  <article>
    <h3>Cadastrando novo reembolso</h3>
      <form class="form-container"  method="post">   
         <!-- form-container:Classe criada para centralizar os campos do formulário-->
            <div class="form-group"> <!-- o zé ajudou a configurar está parte -->
              <label for="Titulo">Digite o nome do Reembolso:</label>
                 <input name="titulo" type="text" class="form-control" id="Titulo" aria-describedby="Titulohelp">
                    <small id="Titulohelp" class="form-text ">È necessário escrever um titulo para cadastrar.</small>

                      <?php
                        if ($form_enviado) {
                          $valida=valida_titulo($_POST["titulo"]);
                            if($valida){
                              echo $valida;
                                $falhou=true;
               }
              }
          ?>
</div>
  <div class="form-group">
    <label for="descricao">Digite a descrição do reembolso </label>
      <textarea name="descricao" class="form-control" id="descricao"></textarea>
        <?php
          if ($form_enviado) {
            $valida=valida_descricao($_POST["descricao"]);
              if($valida){
                echo $valida;
                  $falhou=true;
               }
             }
?>
</div>
  <button type="submit" class=" btn-primary">Submit</button><!-- o zé ajudou a configurar está parte -->
    </form> 
      <?php
        include ("bancodedados.php");
          if(!usuario_logado() || !isset($_SESSION["empresa_id"])){
            header("Location:index.php");
              exit();
}
if($form_enviado && !$falhou){

// declarando a variavel $titulo e variavel $descricao é necessário usar o cifrão nome da variavel e = além se usar o metodo $_POST e as "".
  $empresa_id=$_SESSION["empresa_id"];
    $titulo=$_POST["titulo"];
      $descricao=$_POST["descricao"];

//DECLARANDO AS QUERIES COM A SINTAXE INSERT INTO E VALUES,a coluna nome está presente no banco mysql então por isto,nós chamamos ela na querie insert into
$abacaxi = $conexao->query(
  "INSERT INTO reembolsos_tipos (nome, descricao,empresa_id)" .
    " VALUES ('{$titulo}', '{$descricao}','{$empresa_id}')"
);
  //EM INSERT INTO ESTÁ chamando a tabela reembolsos_tipos porque no banco mysql este é onome da tabela que contém as informações dos reembolsos já cadastrados e não cadastrado
if($abacaxi)
  echo"<p>aqui tem abacaxi :) </p>";
   }

?>

</article> 
  </section>
    <footer>
      <h2>Copyright &copy; 2019 - RP Reembolso</h2>
        </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
          </body>
            </html>