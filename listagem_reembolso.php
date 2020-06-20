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
                        </header>
                            <?php
                            include("componentes/navbar.php") ?>
       
<section>
    <article>
        <h1>Tipos de Reembolsos</h1> 
                <!-- sintaxe do botão <button type="submit" onsubmit="valida()"class="btn btn-primary">Submit</button>!-->
                   <!--Link para a página cadastro_reembolso-->
            <a class='btn btn-primary' href="cadastro_reembolso.php">Cadastrar novo tipo de reembolso</a>

                <!--<form class="form-container"  method="post">   <!-- form-container:Classe criada para centralizar os campos do formulário-->
                <!--<div class="form-group"> <!-- o zé ajudou a configurar está parte -->
                    <!--<label for="Titulo">Digite o nome do Reembolso</label>
                <input name="titulo" type="text" class="form-control" id="Titulo" aria-describedby="Titulohelp">
                <small id="Titulohelp" class="form-text ">È necessário escrever um titulo para cadastrar.</small>
            </div>

            <div class="form-group">
                <label for="descricao">Digite a descrição do reembolso </label>
                <textarea name="descricao" class="form-control" id="descricao"></textarea>
            </div>
            <button type="submit" class=" btn-primary">Submit</button><!-- o zé ajudou a configurar está parte -->
            <!--</form> --> 
            <div class="row mt-4">
                <?php
                    include("bancodedados.php");
                    // setando uma queries $abacaxi=$conexao->query("SELECT id,senha,nome FROM empresas where //endereco_email='{$endereco_email}'");
                        if(!usuario_logado() || !isset($_SESSION["empresa_id"])){
                                header("Location:index.php");
                                exit();
                        }

                        $abacaxi=$conexao->query("SELECT nome,descricao,id FROM reembolsos_tipos WHERE empresa_id={$_SESSION["empresa_id"]}"); 
                        //inicio da condição while
                        $tipo_reemb =$abacaxi->fetch_object(); 
                        while($tipo_reemb){
                          // atributos de html
                          //input name=Email" type="email" class="form-control"
                          echo "
                            <div class='col-12 col-sm-6 col-md-4 my-2'>
                              <div class='card'>
                                <div class='card-header'>
                                  <h3>{$tipo_reemb->nome}</h3>
                                  <p  class= 'hidden'>{$tipo_reemb->descricao}</p>
                                </div>
                              </div>
                            </div>
                          ";
                          // neste código é um exemplo de um bloco do while este bloco tem código dentro de do e uma condição dentro //de while ele funciona assim: Ele roda ignorando o while na primeira vez e na segunda vez ele considera o //while se a condição do while for verdadeira caso coontrário ele sai 
                          $tipo_reemb =$abacaxi->fetch_object();
                      }
                ?>
            </div>   
        </article>
    </section>
    <footer>
        <h2>Copyright &copy; 2019 - RP Reembolso</h2>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>