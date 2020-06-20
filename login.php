<!DOCTYPE html>
<html>
<head>
    <title>Reembolsa Fácil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--link do bootstrap-->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--<link rel="stylesheet" type="text/css" href="css/batata.css">-->
</head>
</head>
<body> <!--tag para abrir o php-->
     <?php
     include ("validacoes.php") 
     ?>
    <header id="topo">
        <img src="img\landrover.jpg">
        <h1>Reembolsa Fácil</h1>
           <?php
              include("sessao.php")?>
    </header>
         <?php
          include("componentes/navbar.php") ?>

    <section id="pagina-login">
        <article>
            <p>Login de Empresa</p> 
               <form class="form-container"  method="post">   <!-- form-container:Classe criada para centralizar os campos do formulário-->
                <div class="form-group"> <!-- o zé ajudou a configurar está parte -->
                    <label for="Email">Digite seu E-mail:</label>
                    <input name="email" type="email" class="form-control" id="Email" aria-describedby="EmailHelp">
                        <small id="EmailHelp" class="form-text ">We'll never share your Email with anyone else.</small>
                </div>

                <div class="form-group">
                  <label for="senha">Digite sua senha </label>
                  <input type="password" name="senha" class="form-control" id="senha">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button><!-- o zé ajudou a configurar está parte -->
                <p class="mt-3">
                  <a class="mr-2" href="/site/esqueci_minha_senha.php?tabela=empresas">Esqueci minha senha</a>
                  <a href="/site/funcionario/login.php">Logar como funcionário</a>
                </p>
              </form>  
             <?php  // o Richard  ajudou a configurar está parte -->

            include ("bancodedados.php");//inclue os dados do arquivo bancodedados.php no codigo de login.php
            // ou seja pega a váriavel conexão e faz ela interagir com o código

             if(!isset($_POST["email"])) // checando se  o email existe dentro do POST
             echo "<p> Insira um e-mail </p>"; //estou chamando  o email em php 
            if(!isset($_POST["senha"])) // checando se  o senha existe dentro do POST ou seja o usuario mandou algo
             echo "<p> Insira uma senha </p>"; // print do html em php 
             

                 if($form_enviado){
                 $endereco_email=$_POST["email"];
                 //nos queremos saber se  entre as empresas cadastradas  o e-mail digitado existi 
                 $abacaxi=$conexao->query("SELECT id,senha,nome FROM empresas where endereco_email='{$endereco_email}'");
                  if($abacaxi){
                    echo"<p>E-mail encontrado no banco </p>";
                    $empresa = $abacaxi->fetch_object(); // relemmbrando queries do banco; O metodo fetch_object responsável por acessar os dados da variavel abacaxi no banco de dados,o abacaxi é a tabela retornada pelo select e o fetch_object pea os dados da primeira linha.

                    if ($empresa){
                      echo "<p>{$empresa->nome}</p>";
  
                      $senha =$_POST["senha"];
                       if(password_verify($senha,$empresa->senha)){
                        echo "<p> a senha bate!</p>";
                        logar("empresa",$empresa->id,$empresa->nome);// função logar
                        }else 
                          echo"<p> senha não corresponde á digitada!!!!</p>";          
                    } else
                      echo "<p>Empresa não encontrada</p>";
                   }
                   else
                    echo"<p> não foi possivel atingir o banco de dados</p>"; 
                     
                  }

                
                // exemplos de queries em php
            //$abacaxi = $conexao->query( // estou pedindo para executar no banco de dados e o resultado que vier de volta eu armazeno em abacaxi

              // Exemplo de INSERT
              //testes com queries baicas do mysql
                  //"INSERT INTO reembolsos_tipos (nome) VALUES ('Comida'), ('Combustível')"
                //);

                //if ($abacaxi)
                 // echo "<p>[ABACAXI - INSERT] tudo certo :)";
                
                // Exemplo de UPDATE
                //$abacaxi = $conexao->query(
                  //"UPDATE reembolsos_tipos SET nome = 'Batata' where nome = 'Comida'"
                //);

                //if ($abacaxi)
                 // echo "<p>[ABACAXI - UPDATE] tudo certo :)";

                // Exemplo de DELETE
                //$abacaxi = $conexao->query(
                 // "DELETE FROM reembolsos_tipos WHERE nome = 'Batata' or nome = 'Combustível'"
                //);

               // if ($abacaxi)
                  //echo "<p>[ABACAXI - DELETE] tudo certo :)</p>";
                ?><!-- o Richard  ajudou a configurrar está parte -->


        </article>
    </section>
    <footer>
        <h2>Copyright &copy; 2019 -Reembolsa Fácil</h2>
    </footer>

    <!--Parte logica  javascript do bootstap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>