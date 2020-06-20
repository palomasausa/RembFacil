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
	<header id="topo">
    <img src="../img/landrover.jpg">
    <h1>Reembolsa Fácil</h1>
  </header>

  <?php include("../componentes/navbar.php") ?>
  <div id="overlay"></div>
<section id="pagina-consultareembolso">
    <article>
      <h1>Reembolsos</h1>
      <div class="row">
        <?php
          include("../bancodedados.php");
          // setando uma queries $abacaxi=$conexao->query("SELECT id,senha,nome FROM empresas where //endereco_email='{$endereco_email}'");
          if(!usuario_logado() || !isset($_SESSION["funcionario_id"])){
            header("Location: ../index.php");
            exit();
          }

          $abacaxi = $conexao->query("
            SELECT reembolsos.id, nome_estabelecimento, valor_compra, data_compra, foto_url, descricao, aprovado
              FROM reembolsos 
              INNER JOIN funcionarios as funcionario ON funcionario.id = reembolsos.funcionario_id
              WHERE reembolsos.funcionario_id = '{$_SESSION["funcionario_id"]}'
          ");

          //inicio da condição while

          if ($abacaxi){
            $reembolso = $abacaxi->fetch_object(); 

            if (!$reembolso)
              echo "<p>Não há reembolsos pendentes no momento</p>";
            else {
              while($reembolso){
                // atributos de html
                //input name=Email" type="email" class="form-control"
  
                $valor_moeda = number_format($reembolso->valor_compra, 2, ",", ".");
  
                $data_compra = date_create($reembolso->data_compra);
                $data_compra = date_format($data_compra, "d/m/Y");
                
                if (is_null($reembolso->aprovado))
                  $estado_reembolso = "Pendente";
                else if ($reembolso->aprovado)
                  $estado_reembolso = "Aprovado";
                else
                  $estado_reembolso = "Reprovado";
                
                if (!is_null($reembolso->aprovado))
                  $acao_possivel = "
                    <span class='text-danger'>
                      <ion-icon name='close-circle' ></ion-icon>
                      Reembolso já avaliado
                    </span>
                  ";
                else
                  $acao_possivel = "
                    <a 
                      class='btn btn-danger'
                      href='remover_reembolso.php?rid={$reembolso->id}'
                    >
                      <ion-icon name='trash'></ion-icon>
                      Deletar
                    </a>
                  ";
  
                echo "
                  <div class='col-12 col-sm-6 col-lg-4 my-2'>
                    <div class='card text-left'>
                      <div class='card-header'>
                        <h4>Local:</h4>
                        <h2>{$reembolso->nome_estabelecimento}</h2>
                      </div>
                      <div class='card-body'>
                        <p><strong>Valor da compra:</strong> R$ {$valor_moeda}</p>
                        <p><strong>Data da compra:</strong> {$data_compra}</p>
                        <p><strong>Estado do reembolso:</strong> {$estado_reembolso}</p>
                        <p><strong>Descrição</strong></p>
                        <p>{$reembolso->descricao}</p>
                        <div class='text-center'>
                          <h5>Nota fiscal</h5>
                          <img src='{$reembolso->foto_url}' />
                          <p class='text-secondary'>Clique na imagem pra ampliá-la</p>
                        </div>
                        <p class='text-right'>{$acao_possivel}</p>
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
  <script src="../js/script.js"></script>
</body>
</html>