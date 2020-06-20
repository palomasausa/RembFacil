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
			<p>Defina uma senha para utilizar no site</p>
            <form class="form-container" method="post">
                <div class="form-group">
                    <label for="senha">Digite uma senha</label>
                    <input name="senha" type="password" class="form-control" id="senha" >
                    <?php
                        if($form_enviado){
                            $valida=valida_senha_de_funcionario($_POST["senha"]);
                            if($valida){
                                echo $valida;
                                $falhou = true;
                            }
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="senha1">Confirme a senha digitada</label>
                    <input name="senha1" type="password" class="form-control" id="senha1" >
                    <?php
                        if ($form_enviado && $_POST["senha"] != $_POST["senha1"]){
                            echo "<p>Digite novamente a senha</p>";
                            $falhou = true;
                        }
                    ?>
                </div>   
                <button class="btn btn-primary" type="submit">Enviar</button>
            </form>
            <?php

                $token=$_GET["token"];

                // if (!isset($token)){
                //     header("Location:index.php");
                //     exit();
                // }

                include("bancodedados.php");
                if($form_enviado && !$falhou){
                    //query de selecao 
                    $abacaxi = $conexao->query("SELECT usuario_id, tabela FROM tabsenha WHERE token='{$token}'");
                    if($abacaxi){
                        $usuario=$abacaxi->fetch_object();
                        if($usuario){
                            $senha = $_POST["senha"];
                            $hash = password_hash($senha, PASSWORD_DEFAULT);

                            //faremos a query de update de usuário para definir sua senha
                            $abacaxi= $conexao->query("
                                UPDATE {$usuario->tabela} SET senha='{$hash}' WHERE id={$usuario->usuario_id}
                            ");

                            if ($abacaxi){
                                echo "<p>Sua senha foi definida! :D</p>";
                                $abacaxi = $conexao->query("DELETE FROM tabsenha WHERE token='{$token}'");
                            } else {
                                echo "<p>Algo deu errado :(</p>";
                                echo mysqli_error($conexao);
                            }
                        }

                    }
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