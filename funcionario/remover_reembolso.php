<!DOCTYPE html>
<html>
<head>
	<title>Reembolsa Fácil </title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
     <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->
     <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <?php include("../sessao.php") ?>
  <?php include("../validacoes.php") ?>
	<header id="topo">
    <img src="../img/landrover.jpg">
    <h1>Reembolsa Fácil</h1>
  </header>
  <?php include("../componentes/navbar.php") ?>
       
<section>
  <article>
      <h1>Remoção de reembolsos</h1>
      <p>Deseja realmente deletar este reembolso?</p>
        <?php

          include("../bancodedados.php");

          $rid = $_GET["rid"];

          // Redireciona pra homepage se não vier com dado definido
          if (!$rid){
            header("Location: /site/index.php");
            exit();
          }

          echo "
            <form class='form-container' method='post'>
              <input type='hidden' name='rid' value='{$rid}' />
          ";
        ?>
        <button class='btn btn-primary' type='submit'>Deletar</button>
        <a class='btn btn-danger' href='./consulta_reembolso.php'>Cancelar</a>
        <!-- <a href='/site/funcionario/consulta_reembolso.php'>Voltar</a> -->
        </form>

        <?php
          if ($form_enviado){
            $rid = $_POST["rid"];
            
            $abacaxi = $conexao->query("DELETE FROM reembolsos WHERE id = '{$rid}'");

            if ($abacaxi){
              header("Location: ./consulta_reembolso.php");
              exit();
            } else {
              echo "<p>Não foi possível atualizar reembolso</p>";
              // echo mysqli_error($conexao);
            }

          }

        ?>
    </article>
  </section>
  <footer>
      <h2>Copyright &copy; 2019 - RP Reembolso</h2>
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="../js/script.js"></script>
</body>
</html>


