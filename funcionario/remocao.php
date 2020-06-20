<?php

  include("../bancodedados.php");  

  $fid = $_GET["fid"];

  $abacaxi = $conexao->query("DELETE FROM funcionarios WHERE idx = {$fid}");

  if ($abacaxi){
    header("Location: listagem.php");
    exit();
  } else {
    // header("listagem.php?erro=remocaofalhou");
    echo "<script>alert('Corrija os dados.')</script>";
    //se colocar uma pou up igual na aula passada 
  }

  // edicao.php?fid=1
  //DELETE FROM funcionarios WHERE nome,email e cpf fid=1     

?>