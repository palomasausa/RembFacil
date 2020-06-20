<!DOCTYPE html>
<html>
<head>
	<title>Reembolsa Fácil </title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
     <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->
     <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php 
      include("../sessao.php");
      include("../validacoes.php");
    ?>
    <header id="topo">
      <img src="../img/landrover.jpg" />
      <h1>Reembolsa Fácil</h1>
    </header>

    <?php include("../componentes/navbar.php") ?>
    
    <?php
    // verifica-se se o usuario é funcionario 
      if (!usuario_logado() || !isset($_SESSION["funcionario_id"])){
        header("Location: ../index.php");
        exit();
      }
    ?>

    <section>
        <article>
          <p>Inserindo um reembolso</p>
          <form class="form-container" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nomeestabelecimento">Digite o nome do estabelecimento</label>
              <input name="nomeestabelecimento" type="text" class="form-control" id="nomeestabelecimento">
              <?php
                // bloquinho de validação do valor
                  if ($form_enviado){
                    $valida = valida_nome_estabelecimento($_POST["nomeestabelecimento"]);
                    if ($valida){
                      echo $valida;
                      $falhou = true;
                    }
                  }
              ?>
            </div>
            <div class="form-group">
              <label for="valor">Valor da compra</label>
              <input name="valor" type="text" class="form-control" id="valor">
              <?php
                // bloquinho de validação do valor
                if ($form_enviado){
                  $valida = valida_valor_compra($_POST["valor"]);
                  if ($valida){
                    echo $valida;
                    $falhou = true;
                  }
                }
              ?>
            </div>
            <div class="form-group">
              <label for="data">Data da compra</label>
              <input name="data" type="date" class="form-control" id="data">
            </div>
            <div class="form-group">
              <label for="nf">Imagem da nota fiscal:</label> 
              <input name="nf" type="file" accept="image/*" class="form-control" id="nf" required>
              <?php
                if ($form_enviado){
                  $nf = $_FILES["nf"];// variavel nf sendo declarada ou definida 
                  $valida = valida_nota_fiscal($nf);
                  if ($valida){
                    echo $valida;
                    $falhou = true;
                  } else {
                    $tmp_name = $nf["tmp_name"];

                    $extensao = pathinfo($nf["name"], PATHINFO_EXTENSION);
                    $nome_arquivo = basename($tmp_name, ".tmp") . "." . $extensao;
                    
                    $upload_ok = move_uploaded_file($tmp_name, "../arquivo_imagens/{$nome_arquivo}");

                    if ($upload_ok){
                      echo "<p> Parabéns o envio de arquivo foi um sucesso!!!</p>";
                      $nf_url = "/site/arquivo_imagens/{$nome_arquivo}";
                    } else {
                      echo "<p>Buah,infelizmente não deu certo,verifique e tente novamente</p>";
                      $falhou = true;
                    }

                  }
                }
              ?>
             </div>
            <div class="form-group">
              <label for="tipo">Tipo</label>
              <select name="tipo" type="text" class="form-control" id="tipo">
                <option>-- Selecione uma opção --</option>
                <?php

                  include("../bancodedados.php");
                  
                  $funcionario_id = $_SESSION["funcionario_id"];
                  $abacaxi = $conexao->query(
                    "SELECT empresa_id FROM funcionarios WHERE id = {$funcionario_id}"
                  );

                  if ($abacaxi){

                    $empresa_id = $abacaxi->fetch_object()->empresa_id;

                    $abacaxi = $conexao->query(
                      "SELECT id, nome FROM reembolsos_tipos WHERE empresa_id = {$empresa_id}"
                    );

                    if ($abacaxi){
                      $tipo_reemb = $abacaxi->fetch_object();

                      while ($tipo_reemb){

                        echo "<option name='{$tipo_reemb->id}'>{$tipo_reemb->nome}</option>";

                        $tipo_reemb = $abacaxi->fetch_object();
                      }

                    } else
                      echo "<p>Não foi possível buscar tipos de reembolsos";


                  } else
                    echo "<p>Não foi possível buscar sua empresa</p>";

                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="descricao">Descrição</label>
              <textarea name="descricao" class="form-control" id="descricao"></textarea>
              <?php
                // bloquinho de validação da textarea
                if ($form_enviado){
                  $valida = valida_descricao_compra($_POST["descricao"]);
                  if ($valida){
                    echo $valida;
                    $falhou = true;
                  }
                }
              ?>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
          <?php

            include("../bancodedados.php");

            if ($form_enviado and !$falhou){

              $tipo = $_POST["tipo"];
              $valor_compra = $_POST["valor"];
              $data = $_POST["data"];
              $descricao = $_POST["descricao"];
              $nome_estabelecimento = $_POST["nomeestabelecimento"];
            
              $funcionario_id=$_SESSION["funcionario_id"];
                 
              //querendo saber á qual empresa o funcionario pertence sintaxe:
              $abacaxi = $conexao->query(
                "SELECT empresa_id FROM funcionarios WHERE id = {$funcionario_id}"
              );

              if ($abacaxi){

                $empresa_id = $abacaxi->fetch_object()->empresa_id;

                $abacaxi= $conexao->query(
                  "INSERT INTO reembolsos (nome_estabelecimento,foto_url,tipo, descricao, valor_compra, data_compra, funcionario_id, empresa_id)".
                  " VALUES ('{$nome_estabelecimento}','{$nf_url}','{$tipo}','{$descricao}',
                  '{$valor_compra}', '{$data}', '{$funcionario_id}', '{$empresa_id}')"
                );
                // E agora, o que a gente faz?
                if($abacaxi){
                  echo "<p>Formulario Reembolso enviado !</p>";
                } else
                  echo mysqli_error($conexao);
                      // echo "<p> Erro corriga os dados e envie novamente!</p>";
                
              }
              
            }
          ?>
        </article>
    </section>
    <footer>
        <h2>Copyright &copy; 2019 - RP Reembolso</h2>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>
</html>
<!-- //1
// precisa da nota fiscal do estabelecimento
//precisa colocar o valor gasto 
//fazer upload da nota(campo para upload)

//2
//tem uma pagina ele pode ver se foi ou não aprovado 
//ah!não foi aceito disponibizar o e-mail da empresa  -->