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
  <?php include("sessao.php")?>
	<header id="topo">
    <img src="img\landrover.jpg">
    <h1>Reembolsa Fácil</h1>
  </header>
  <?php include("componentes/navbar.php") ?>
    
  <div id="overlay"></div>
<section id="pagina-listareembolso">
    <article>
      <h1>Reembolsos</h1>
      <div class="row">
        <?php
          include("bancodedados.php");
          // setando uma queries $abacaxi=$conexao->query("SELECT id,senha,nome FROM empresas where //endereco_email='{$endereco_email}'");
          if(!usuario_logado() || !isset($_SESSION["empresa_id"])){
            header("Location:index.php");
            exit();
          }

          $abacaxi = $conexao->query("
            SELECT reembolsos.id, nome_estabelecimento, valor_compra, data_compra, foto_url, descricao,
                    funcionario.nome as funcionario_nome, funcionario.cpf as funcionario_cpf
              FROM reembolsos 
              INNER JOIN funcionarios as funcionario ON funcionario.id = reembolsos.funcionario_id
              WHERE reembolsos.empresa_id={$_SESSION["empresa_id"]} AND reembolsos.aprovado IS NULL
          ");

          
          if ($abacaxi){
            $reembolso = $abacaxi->fetch_object(); 
            
            if (!$reembolso)
              echo "<p>Não há reembolsos pendentes no momento</p>";
            else {
              
              //inicio da condição while
              while($reembolso){
                // atributos de html
                //input name=Email" type="email" class="form-control"

                $valor_moeda = number_format($reembolso->valor_compra, 2, ",", ".");

                $data_compra = date_create($reembolso->data_compra);
                $data_compra = date_format($data_compra, "d/m/Y");

                echo "
                  <div class='col-md-6'>
                    <div class='card text-left'>
                      <div class='card-header'>
                        <h4>Local:</h4>
                        <h2>{$reembolso->nome_estabelecimento}</h2>
                      </div>
                      <div class='card-body'>
                        <div class='row align-items-center'>
                          <div class='col-12 col-sm-6 col-md-12'>
                            <p><strong>Valor da compra:</strong> R$ {$valor_moeda}</p>
                            <p><strong>Nome do funcionário:</strong> {$reembolso->funcionario_nome}</p>
                            <p><strong>CPF:</strong> {$reembolso->funcionario_cpf}</p>
                            <p><strong>Data da compra:</strong> {$data_compra}</p>
                            <p><strong>Descrição</strong><br />{$reembolso->descricao}</p>
                            <p><strong>O que deseja fazer?</strong></p>
                            <p class='text-right mt-2'>
                              <a
                                class='btn btn-primary'
                                href='/site/aprovar_reembolso.php?rid={$reembolso->id}&acao=aprovar'
                              >
                                Aprovar
                                <ion-icon name='checkmark'></ion-icon>
                              </a>
                              ou
                              <a 
                                class='btn btn-danger'
                                href='/site/aprovar_reembolso.php?rid={$reembolso->id}&acao=reprovar'
                              >
                                Reprovar
                                <ion-icon name='build'></ion-icon>  
                              </a>
                            </p>
                          </div>
                          <div class='col-12 col-sm-6 col-md-12 text-center'>
                            <h4>Nota fiscal</h4>
                            <img class='d-block mx-auto' src='{$reembolso->foto_url}' />
                            <p class='text-secondary'>Clique na imagem para ampliá-la</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                ";

                // neste código é um exemplo de um bloco do while este bloco tem código dentro de do e uma condição dentro //de while ele funciona assim: Ele roda ignorando o while na primeira vez e na segunda vez ele considera o //while se a condição do while for verdadeira caso coontrário ele sai 
                $reembolso = $abacaxi->fetch_object();

              }

            } 

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