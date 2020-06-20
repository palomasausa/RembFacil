<!DOCTYPE html>
<html>
<head>
    <title>Reembolsa Fácil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
     <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->
</head>

<body>
     <?php
     include ("validacoes.php") 
?>
<?php
       include("sessao.php")?>
    <header id="topo">
        <img src="img\landrover.jpg">
        <h1>Reembolsa Fácil</h1>
    </header>
         <?php
          include("componentes/navbar.php") ?>

   
    <section id="pagina-cadastroempresa">
        <article>
            <p>Cadastro sua Empresa</p>
                <form class="form-container" method="post">
                <div class="form-group">
                  <label for="CNPJ">Digite seu Cnpj:</label>
                  <input name="cnpj" type="text" class="form-control" id="CNPJ" aria-describedby="cnpjHelp">
                  <small id="cnpjHelp" class="form-text ">We'll never share your Cnpj with anyone else.</small>
                 <?php
                      if($form_enviado){
                        $valida=valida_cnpj_de_usuario($_POST["cnpj"]);//O cnpj fica assim :"cnpj" porque nós estamos acessando uma propriedade  que está no POST correspondente ao nome do dado que no caso é cnpj
                      if($valida){
                        echo $valida;
                        $falhou=true;
                      }
                    }
                    
                          ?>

                      <div class="form-group">
                        <label for="Email">Digite seu E-mail:</label>
                    <input name="email" type="email" class="form-control" id="Email" aria-describedby="EmailHelp">
                        <small id="EmailHelp" class="form-text text-muted">We'll never share your Email with anyone else.</small>
                        <?php
                      if($form_enviado){
                        $valida=valida_email_de_usuario($_POST["email"]);//O email fica assim :"email" porque nós estamos acessando uma propriedade  que está no POST coreespondente ao nome do dado que no caso é email
                      if($valida){
                        echo $valida;
                        $falhou=true;
                      }
                    }
                    
                          ?>
                  <div class="form-group">
                  <label for="name"> Defina um nome de usuario :</label>
                  <input name="nome" type="text" class="form-control" id="name">
                      <?php
                      if($form_enviado){
                        $valida =valida_nome_de_usuario($_POST["nome"]);//O nome fica assim :"nome" porque nós estamos acessando uma propriedade  que está no POST correspondente ao nome do dado que no caso é name
                         if($valida){
                         echo $valida;
                        $falhou=true;
                      }
                    }
                          ?>
                </div>
                </div>
                <div class="form-group">
                  <label for="Telefone"> Digite seu Telefone:</label>
                  <input name="Telefone" type="text" class="form-control" id="Telefone">
                   <?php 
                   if($form_enviado){
                   $valida = valida_telefone_de_usuario($_POST["Telefone"]);//O Telefone fica assim :"telefone" porque nós estamos acessando uma propriedade  que está no POST coreespondente ao nome do dado que no caso é telefone
                   //validando o telefone de usuário
                    if ($valida){
                        echo $valida;
                        $falhou=true;
                      }
                    }
                    ?>
                </div>
                <div class="form-group">
                  <label for="senha"> Defina uma senha:</label>
                    <!--password aparece pontinhos na senha no site -->
                  <input name="senha" type="password" class="form-control" id="senha">
                        <?php 
                        if($form_enviado){
                        $valida=valida_senha_de_usuario($_POST["senha"]);//O cnpj fica assim :"senha" porque nós estamos acessando uma propriedade  que está no POST coreespondente ao nome do dado que no caso é senha
                        if($valida){
                        echo $valida;
                        $falhou=true;
                      }
                    }
                       ?>
                </div>
                <button type="submit" onsubmit="valida()"class="btn btn-primary">Submit</button>
              </form>

              <?php
                  include ("bancodedados.php");
                    //pegando os dados que estamos recebendo no formulário pelo POST
                  if($form_enviado &&  !$falhou){ //checa-se o formulário está chegando pelo POST
                      

                      // variáveis que o usuario deve digitar
                 $cnpj=$_POST["cnpj"];
                 $nome=$_POST["nome"];
                 $email= $_POST["email"];
                 $Telefone=$_POST["Telefone"]; //fique atento as variavéis com primeira letra maiuscula e também digite cnpj e não cpnj
                 $senha=$_POST["senha"];
                // $checagem=$_POST["checagem"];

                $hash =password_hash($senha,PASSWORD_DEFAULT);// FUNÇÃO QUE CRIPTOGRAFA A SENHA 
              $abacaxi = $conexao->query(
              "INSERT INTO empresas (cnpj, nome, endereco_email,senha, telefone)" .
              " VALUES ('{$cnpj}', '{$nome}','{$email}','{$hash}', '{$Telefone}')"// dentro da string values está sendo usado uma ferramenta chamada interpolação e interpolacao é por o valor de uma variável dentro da String 
            );
                $abacaxi=$conexao->query("SELECT id FROM empresas WHERE cnpj='{$cnpj}' ");
                if($abacaxi)
                echo "<p>    aqui tem a variavel abacaxi  </p>";
                $empresa=$abacaxi->fetch_object();
                $abacaxi=$conexao->query(
               "INSERT INTO reembolsos_tipos( nome,empresa_id,descricao)".//nome,empresa,descrição são colunas 
               
               "VALUES ('Combustivel','{$empresa->id}','Reembolso aplicável apenas para gasolina e álcool .Caso não atenda sua necessidade entre em contato com o suporte técnico'), ".
             
               "('Alimentação','{$empresa->id}',
                'Reembolso aplicável apenas para restaurantes fast food e restaurantes com comida por quilo'),".
            
              "('Hospedagem','{$empresa->id}','Reembolso aplicável apenas para hotéis cadastrados,consulte o recursos humanos da sua empresa para consultar a lista'), " .
              "('Outros', '{$empresa->id}', 'Reembolso aplicável apenas caso não se enquadre nas opções anteriores')"     
             );

                
               if ($abacaxi) 
               echo "<p> Empresa Cadastrada !!!</p>";// precisa por ; no echo quando se coloca o colchetes
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