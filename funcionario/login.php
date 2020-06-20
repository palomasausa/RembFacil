
<!DOCTYPE html>
<html>
<head>
    <title>Reembolsa Fácil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
     <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->
</head>

<body>
     <?php
     include ("../validacoes.php") 
?>
<?php
  include("../sessao.php")?>
    <header id="topo">
        <img src="../img/landrover.jpg">
        <h1>Reembolsa Fácil</h1>
    </header>
         <?php
          include("../componentes/navbar.php") ?>  
    <section id="pagina-cadastrofuncionario">
        <article>
            <p>Login de funcionário</p>
                <form class="form-container" method="post">
                <div class="form-group">
                 <!--<label for="CPF">Digite o cpf do seu funcionário:</label>-->
                  <!--<input name="cpf" type="text" class="form-control" id="CPF" aria-describedby="cpfHelp">-->
                  <!--<small id="cpfHelp" class="form-text ">Por favor digite um número de cpf valido.</small>-->
<!--<?php
  //if($form_enviado){
      //$valida=valida_cpf_de_funcionario($_POST["cpf"]);//O cpf fica assim :"cpf" porque nós estamos acessando uma propriedade  que está no POST correspondente ao nome do dado que no caso é cnpj
        //if($valida){
          //echo $valida;
            //$falhou=true;
              //}
               // }
                  //?>-->
<div class="form-group">
<label for="Email">Digite seu E-mail:</label>
<input name="email" type="email" class="form-control" id="Email" aria-describedby="EmailHelp">
<small id="EmailHelp" class="form-text text-muted">Por favor digite um e-mail válido.</small>
 <?php
//O email fica assim :"email" porque nós estamos acessando uma propriedade  que está no POST coreespondente ao nome do dado que no caso é emai
 if($form_enviado){
 $valida=valida_email_de_usuario($_POST["email"]);
if($valida){
echo $valida;
$falhou=true;
  }
    }                   
     ?>
    <div class="form-group">
    <label for="senha"> Digite o senha de funcionario :</label>
    <input name="senha" type="password" class="form-control" id="senha">                                  
    <button type="submit" onsubmit="valida()"class="btn btn-primary">Submit</button>
    </form>
    <p class="mt-3">
      <a href="/site/esqueci_minha_senha.php?tabela=funcionarios">Esqueci minha senha</a>
    </p>

<?php
  include ("../bancodedados.php");
  // echo "<script>alert('Potato');</script>";
  // if(!usuario_logado()||!isset($_SESSION["empresa_id"])){
  //   header("Location: ../index.php");
  //   exit();
  // }
    
    //pegando os dados que estamos recebendo no formulário pelo POST
    if($form_enviado &&  !$falhou){ //checa-se o formulário está chegando pelo POST
      // variáveis que o usuario deve digitar
      //$cpf=$_POST["cpf"];
      //$nome=$_POST["nome"];
      $email= $_POST["email"];
      //$Telefone=$_POST["Telefone"]; //fique atento as variavéis com primeira letra maiuscula e também digite cnpj e não cpnj
      $senha=$_POST["senha"];
      // $checagem=$_POST["checagem"];
      //$hash =password_hash($senha,PASSWORD_DEFAULT);// FUNÇÃO QUE CRIPTOGRAFA A SENHA
      //$empresa_id=$_SESSION["empresa_id"]; 
      $abacaxi = $conexao->query(
        "SELECT id,nome,senha FROM  funcionarios where email='{$email}'"
        );
          // VALUES('{$cpf}', '{$nome}','{$email}','{$empresa_id}')"
         // dentro da string values está sendo usado uma ferramenta chamada interpolação e interpolacao é
        
          //por o valor de uma variável dentro da String             
          if ($abacaxi){
             $funcionario=$abacaxi->fetch_object(); // relemmbrando queries do banco; O metodo fetch_object responsável por acessar os dados da variavel abacaxi no banco de dados,o abacaxi é a tabela retornada pelo select e o fetch_object pea os dados da primeira linha.
  
            // Checar se a senha que o usuário passou no formulário bate com a do banco (que é uma
            // hash)
            //$senha=$_POST["senha"];
            if(password_verify($senha,$funcionario->senha)){
              echo"<p> A senha bate!</p>";
              echo "<script>alert('Login efetuado com sucesso');</script>";

              // chamando a função logar
              logar('funcionario', $funcionario->id, $funcionario->nome);
            }
          }
          	else
          		echo"<p>Não existe usuário com este e-mail,por favor digite um e-mail válido</p>";
          } 
          // echo "<p> Funcionário Cadastrado !!!</p>";
          // precisa por ; no echo quando se coloca o colchetes
          // Envio de e-mail será implementado posteriormente
          ?>
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