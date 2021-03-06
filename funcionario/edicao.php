<!DOCTYPE html>
<html>
<head>
<!--indentação correta segundo o Zé-->
	<title>Reembolsa Fácil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
  	<!--o link serve para permitir que se use alguns icones da página mais especifica ionic-->
</head>

<body>
	<?php include ("../validacoes.php") ?>
	<?php include ("../sessao.php") ?>
  	<header id="topo">
    	<img src="../img/landrover.jpg">
    	<h1>Reembolsa Fácil</h1>
  	</header>
	<?php include("../componentes/navbar.php") ?>

    <section>
		<article>
			<p>Cadastre seu funcionario</p>
  
  <!-- <div class="form-group">
  <label for="CPF">Digite o cpf do seu funcionário:</label>
  <input name="cpf" type="text" class="form-control" id="CPF" aria-describedby="cpfHelp">
  <small id="cpfHelp" class="form-text ">Por favor digite um número de cpf valido.</small>
<?php
  if($form_enviado){
  $valida=valida_cpf_de_funcionario($_POST["cpf"]);//O cpf fica assim :"cpf" porque nós estamos acessando uma propriedade  que está no POST correspondente ao nome do dado que no caso é cnpj
    if($valida){
    echo $valida;
    $falhou=true;
    }
    }
    ?>
<div class="form-group">
<label for="Email">Digite seu E-mail:</label>
<input name="email" type="email" class="form-control" id="Email" aria-describedby="EmailHelp">
<small id="EmailHelp" class="form-text text-muted">Por favor digite um e-mail válido.</small>
<?php
//O email fica assim :"email" porque nós estamos acessando uma propriedade  que está no POST coreespondente ao nome do dado que no caso é email
if($form_enviado){
$valida=valida_email_de_usuario($_POST["email"]);
if($valida){
echo $valida;
$falhou=true;
}
}                   
?>
<div class="form-group">
  <label for="name"> Digite o nome de funcionario :</label>
  <input name="nome" type="text" class="form-control" id="name">      
</div>                             -->

<form class="form-container" method="post">
  <?php
    include ("../bancodedados.php");
  
    //if(!usuario_logado()||!isset($_SESSION["empresa_id"])){
      //header("Location:index.php");
      //exit();
    //}

      // /modificacaodedadosfuncionario.php?fid=156465
      //fid é id de funcionário,$_GET vamos pegar o dado pela url para chegar na pagina
      //em vez de chegar  na páginaPOST porque seria necessário chegar nela por formulario  
      $fid = $_GET["fid"];

      $abacaxi = $conexao->query(
        "SELECT cpf, nome, email FROM funcionarios WHERE id={$fid}"
      );              
          //select id from funcionario($funcionario->id)
      if ($abacaxi){ 
        $funcionario = $abacaxi->fetch_object();
        //no input é necessário passar um value é necessário passar porque?
        //o value mostra um valor já preenchido para o usuario
        // a aspas simples é porque a string começa com aspas duas,porque é uma convenção  do php para 
        //as strings
        
        echo "
          <div class='form-group'>
            <label for='CPF'>Digite o cpf do seu funcionário:</label>
            <input name='cpf' type='text' class='form-control' value='{$funcionario->cpf}' id='CPF' aria-describedby='cpfHelp'>
            <small id='cpfHelp' class='form-text '>Por favor digite um número de cpf valido.</small>
        ";
          //validacção do cpf no proprio bloco 
        if($form_enviado){
          $valida=valida_cpf_de_funcionario($_POST['cpf']);//O cpf fica assim :'cpf' porque nós estamos acessando uma propriedade  que está no POST correspondente ao nome do dado que no caso é cnpj
          if($valida){
            echo $valida;
            $falhou=true;
          }
        }

        echo "</div>";

        echo "
          <div class='form-group'>
            <label for='Email'>Digite seu E-mail:</label>
            <input name='email' type='email' class='form-control' value='{$funcionario->email}' id='Email' aria-describedby='EmailHelp'>
            <small id='EmailHelp' class='form-text text-muted'>Por favor digite um e-mail válido.</small>
        ";
        //O email fica assim :'email' porque nós estamos acessando uma propriedade  que está no POST coreespondente ao nome do dado que no caso é email
        if($form_enviado){
          $valida = valida_email_de_usuario($_POST['email']);
          if ($valida){
            echo $valida;
            $falhou=true;
          }
        }                   
        echo "</div>";


        echo "
          <div class='form-group'>
            <label for='name'> Digite o nome de funcionario:</label>
            <input name='nome' type='text' class='form-control'value='{$funcionario->nome}' id='name'>      
          </div>
        ";
          // precisa por ; no echo quando se coloca o colchetes
          // Envio de e-mail será implementado posteriormente
        
        //pegando os dados que estamos recebendo no formulário pelo POST
        // variáveis que o usuario deve digitar
        if($form_enviado && !$falhou){ //checa-se o formulário está chegando pelo POST
          // o update aqui vai atualizar os dados de funcionário que acabamos de editar na página
    
            $cpf= $_POST["cpf"];
            $nome= $_POST["nome"];
            $email= $_POST["email"];
    
            $abacaxi = $conexao->query("
              UPDATE funcionarios 
                SET cpf='{$cpf}', nome='{$nome}', email='{$email}'
                WHERE id={$fid}
            ");
          
            if ($abacaxi){
              header("Location: lista_funcionario.php");
              exit();
            } else
              echo "<p>Infelizmente não deu certo :(</p>";
      
          }


      } else
        echo "<p>Dado não encontrado</p>";
  ?>
  <button type="submit" onsubmit="valida()"class="btn btn-primary">Submit</button>
</form>

</article>
            </section>
<footer>
  <h2>Copyright &copy; 2019 -Reembolsa Fácil</h2>
    </footer>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
       <script src="../js/script.js"></script>
</body>
</html>