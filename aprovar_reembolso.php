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
  <?php include("sessao.php") ?>
  <?php include("validacoes.php") ?>
	<header id="topo">
    <img src="img\landrover.jpg">
    <h1>Reembolsa Fácil</h1>
  </header>
  <?php include("componentes/navbar.php") ?>
       
<section>
  <article>
      <h1>Bem-vindo(a) à aprovação de reembolsos</h1>
        <?php

          include("bancodedados.php");

          $acao = $_GET["acao"];
          $rid = $_GET["rid"];

          echo "
            <form class='form-container' method='post'>
              <input type='hidden' name='rid' value='{$rid}' />
          ";

          $abacaxi = $conexao->query("
            SELECT reembolsos.id, nome_estabelecimento, valor_compra, data_compra, foto_url, descricao,
                   funcionario.nome as funcionario_nome, funcionario.cpf as funcionario_cpf
              FROM reembolsos 
              INNER JOIN funcionarios as funcionario ON funcionario.id = reembolsos.funcionario_id
              WHERE reembolsos.empresa_id={$_SESSION["empresa_id"]} AND reembolsos.aprovado IS NULL
              AND reembolsos.id = '{$rid}'
          ");

          if ($abacaxi){
            $reembolso = $abacaxi->fetch_object();

            $valor_moeda = number_format($reembolso->valor_compra, 2, ",", ".");

            $data_compra = date_create($reembolso->data_compra);
            $data_compra = date_format($data_compra, "d/m/Y");

            echo "
              <h3>Nome</h3>
              <p>{$reembolso->funcionario_nome}</p>
            ";

            echo "
              <h3>CPF</h3>
              <p>{$reembolso->funcionario_cpf}</p>
            ";

            echo "
              <h3>Nome do estabelecimento</h3>
              <p>{$reembolso->nome_estabelecimento}</p>
            ";

            echo "
              <h3>Valor da compra</h3>
              <p>R$ {$valor_moeda}</p>
            ";

            echo "
              <h3>Data da compra</h3>
              <p>{$data_compra}</p>
            ";

            echo "
              <h3>Descrição</h3>
              <p>{$reembolso->descricao}</p>
            ";

            echo "
              <h3>Nota fiscal</h3>
              <p><img src='{$reembolsor->foto_url}' /></p> 
            ";

            echo "
              <h3>Descrição do reembolso</h3>
              <p>{$reembolso->descricao}</p>
            ";
          } else
            echo "<p>Não foi possível buscar descrição</p>";

          if ($acao == "aprovar"){
            echo "<p>Deseja aprovar este reembolso?</p>";
            echo "<button class='btn btn-primary' type='submit'>Aprovar</button>";
          } else if ($acao == "reprovar"){
            echo "<p> Deseja reprovar este reembolso ? </p>";

            echo "
              <div class='form-group'>
                <label for='justificativa'>Justificativa:</label>
                <textarea class='form-control' name='justificativa' id='justificativa'></textarea>
              </div>
            ";

            // Validação de justificativa
            if ($form_enviado){
              $valida = valida_justificativa($_POST["justificativa"]);
              if ($valida){
                echo $valida;
                $falhou = true;
              }
            }

            echo "<button class='btn btn-primary' type='submit'>Reprovar</button>";
          }

          echo "<a class='btn btn-danger ml-2' href='/site/tela_lista_reembolso.php'>Cancelar</a>";
          // echo "<a href='/site/tela_lista_reembolso.php'>Voltar</a>";
          echo "</form>";

          if ($form_enviado and !$falhou){
            $rid = $_POST["rid"];

            $sql = "UPDATE reembolsos SET aprovado = ";

            if ($acao == "aprovar") 
              $sql .= "true";
            else if ($acao == "reprovar"){
              $justificativa = $_POST["justificativa"];
              $sql .= "false, justificativa = '{$justificativa}'";
            }

            $sql .= " WHERE id = '{$rid}'";
            
            $abacaxi = $conexao->query($sql);

            if ($abacaxi){
              header("Location: tela_lista_reembolso.php");
              exit();
            } else {
              echo "<p>Não foi possível atualizar reembolso</p>";
              // echo mysqli_error($conexao);
            }

          }

        ?>
    </article>
  </section>
  <footer>
      <h2>Copyright &copy; 2019 - RP Reembolso</h2>
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>
</html>