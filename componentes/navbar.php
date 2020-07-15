<nav>
  <button type="button" class="nav-menu-btn" onclick="toggleNav()">
    <ion-icon name="menu-outline" size="large"></ion-icon>
  </button>
  <a href="/site/index.php">Home</a>
  <a href="/site/quemsomos.php">Quem somos</a>
  <a href="/site/contatos.php">Contato</a>  

  <!-- $_SESSION não fica em cor branca porque falta um plugin de coloração para o sublime o $_SESSION serve para salvar os dados do usuario quando ele loga--> 
  <?php
  //checa-se se há um usuário (funcionário ou empresa) logado

    if(usuario_logado()){
      echo "
        <a href='/site/servicos.php'>Serviços</a>
        <p href='/site/perfil_usuario.php'>
          <ion-icon name ='person-circle-outline'></ion-icon> {$_SESSION["nome"]} 
        </p>
        <a href='/site/deslogar.php'>Sair</a>
        <br />
      ";  

      if (isset($_SESSION["empresa_id"])){
        echo"<a  href='/site/tela_lista_reembolso.php'>Lista de reembolsos cadastrados</a>";
        echo "<a href='/site/listagem_reembolso.php'>Tipo de Reembolso</a>";
        echo "<a href='/site/funcionario/cadastro.php'>Cadastre aqui seu funcionário</a>";
        echo "<a href='/site/funcionario/listagem.php'>Relação de Funcionário Cadastrados</a>";

      } else {
        echo "
          <a href='/site/funcionario/consulta_reembolso.php'>Seus pedidos de reembolso</a>
          <a href='/site/funcionario/novo_reembolso.php'>Cadastrar novo reembolso</a>
        ";
      }
    } else {

      echo "<a href='/site/login.php'>Login</a>";
      echo "<a href='/site/cadastreempresa.php'>Cadastra-se</a>";
    }
  ?>
</nav>
