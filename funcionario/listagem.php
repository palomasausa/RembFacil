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
    <header id="topo">
      <img src="../img/landrover.jpg">
      <h1>Reembolsa Fácil</h1>
      <?php include("../sessao.php") ?>
    </header><!--header da página-->
    <?php include("../componentes/navbar.php") ?>
    <section>
        <article>
          <!-- Código relacionado à listagem de funcionários -->
          <div class='row'>
          <?php
            include("../bancodedados.php");

            // Redireciona o usuário de volta pra página principal se não houver uma empresa logada
            if (!usuario_logado() || !isset($_SESSION["empresa_id"])){
              header("Location: ../index.php");// bloqueia empresa não logada e limita o acesso dela 
              //á página inicial do sitem
              exit();
            }

            // Ver se a empresa está logada, se ela estiver logada exibir os
            // funcionarios cadastrados por ela 
            // acessar a tabela de funcionarios cadastrados pela empresa:
            // * Acessar o banco;
            // * Pegar essas informações;
            // * Exibir na tela em tabela;
            //Pra isto nós precisamos declarar uma variavel que pegue os dados do banco de dados e guarde
            //nela mesmo e exiba quando ela ser chamada ,ou seja, uaariamos a estrutura Fetch_object.
            $empresa_id = $_SESSION["empresa_id"];
            $abacaxi = $conexao->query(
            // Acessar a tabela de funcionarios cadastrados pela empresa:
                "SELECT id, nome, email FROM funcionarios WHERE empresa_id='{$empresa_id}'"
            );
                // se empresa estiver logada exibir os funcionarios dela
            
            // <table>, é a tag que abre e fecha a tabela
            // <th> (table header), tag pros títulos (nomes das colunas) da tabela
            // <tr> (table row), tag pra cada linha da tabela,é como se fosse a linha da tabela 
            //do banco de dados
            // <td> (table data), tag aonde as informações da tabela
            // <thead> (table head), tag aonde vão os headers(titulo de tabela) da tabela
            // <tbody> (table body), tag aonde vão as linhas com informações(dados da tabela
            //funcionario)

            if ($abacaxi){
              // $funcionario=$abacaxi->fetch_object();está pegando linha á linha da tabela
              // funcionario como nome,email e imprimo cada coluna de funcionario pego em select
              $funcionario = $abacaxi->fetch_object(); 
              //while(funcionario)
              while($funcionario){
                // atributos de html
                //input name=Email" type="email" class="form-control"
                // sm // small (smartphones)
                // md // medium (tablets)
                // lg // large (notebooks, PCs)
                // xl // extra large (ultrawide screens, 4K)
                // <div class='col-12 col-sm-4 col-md-2 col-lg-3'></div>

                echo "
                  <div class='col-12 col-sm-6 col-md-4 my-2'>
                    <div class='card text-left'>
                      <div class='card-header'>
                        <h2>{$funcionario->nome}</h2>
                        <p>{$funcionario->email}</p>
                        <p class='text-right'>
                          <a 
                            class='btn btn-primary'
                            href='edicao.php?fid={$funcionario->id}'
                          >
                            Editar
                          </a>
                          <a 
                            class='btn btn-danger'
                            href='remocao.php?fid={$funcionario->id}'
                          >
                            <ion-icon name='trash-outline'></ion-icon>
                          </a>
                        </p>
                      </div>
                    </div>
                  </div>
                ";
                // neste código é um exemplo de um bloco do while este bloco tem código dentro de do e uma condição dentro //de while ele funciona assim: Ele roda ignorando o while na primeira vez e na segunda vez ele considera o //while se a condição do while for verdadeira caso coontrário ele sai 
                $funcionario =$abacaxi->fetch_object();
              }

            } else 
              echo "<p>Não há dados suficientes cadastrados,cheque os dados com seu responsável</p>";
          ?>
        </div>
        </article>
    </section>
    <footer>
        <h2>Copyright &copy; 2019 -Reembolsa Fácil</h2>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>