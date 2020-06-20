<!DOCTYPE html>
<html>
<head>
<!--indentação correta segundo o Zé-->
	<title>Reembolsa Fácil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
  	<!--o link serve para permitir que se use alguns icones da página mais especifica ionic-->
</head>

<body>
	<?php include ("validacoes.php") ?>
	<?php include ("sessao.php") ?>
  	<header id="topo">
    	<img src="img/landrover.jpg">
    	<h1>Reembolsa Fácil</h1>
  	</header>
	<?php include("componentes/navbar.php") ?>

    <section>
		<article>
			<p>Informe seu e-mail</p>
            <form class="form-container" method="post">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name="email" type="email" class="form-control" id="email" >
                </div>
                <button class="btn btn-primary" type="submit">Enviar</button>
            </form>
            <?php

                include("bancodedados.php");

                $tabela = $_GET["tabela"];

                if ($tabela != "empresas" && $tabela != "funcionarios"){
                  echo "<p class='text-danger'>Tabela '{$tabela}' não permitida</p>";
                  exit();
                }
                
                if($form_enviado){

                    $email=$_POST["email"];

                    //query de selecao 
                    $abacaxi = $conexao->query("SELECT id FROM {$tabela} WHERE email='{$email}'");

                    if($abacaxi){
                      $usuario=$abacaxi->fetch_object();
                      
                      if ($usuario){  
                        $uid = $usuario->id;
                        $token = md5(uniqid(rand()));
                
                        $abacaxi = $conexao->query("
                          INSERT INTO tabsenha (usuario_id, token, tabela)
                          VALUES ('{$uid}', '{$token}', '{$tabela}')
                        ");

                        mail(
                          $email, 
                          "Redefina sua senha", 
                          "Bem-vindo ao redefinição de senha,
                            Altere sua senha através deste link:
                            http://localhost/site/definir_senha.php?token={$token}
                          ", 
                          "From: paloma.sausa.jovem.com@gmail.com"
                        );

                        if ($abacaxi)
                          echo "<p>Você receberá um e-mail para redefinição de senha em alguns instantes</p>";
                        else
                          echo "<p>Não foi possível criar link de redefinição de senha.</p>";

                      } else
                        echo "<p>Não foi possível encontrar um usuário com o e-mail informado</p>";

                    } else
                      echo mysqli_error($conexao);
                }


            ?>
        </article>
    </section>
<footer>
  <h2>Copyright &copy; 2019 -Reembolsa Fácil</h2>
    </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
       <script src="js/script.js"></script>
</body>
</html>