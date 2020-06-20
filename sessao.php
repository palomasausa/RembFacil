
<?php
  session_start();// a  session start é chamada quando se pretende usar dados de login do usuario para dentro do site .
 //e se dados  existirem então o usuario e terá acesso ao site nas áreas que o sistema permitir e não que ele gostaria de ter acesso 

function logar($tipo,$usuario_id,$nome){ //função function logar será chamada pelo arquivos cadastre.php,login e etc;$nome é um parametro da função 
	$dado="{$tipo}_id";
      //coloca-se a variável {tipo}_id dentro da variável dado e acrescenta-se o id.

	$_SESSION[$dado]=$usuario_id;//S_SESSION é uma variável global que guarda os dados de sessão do usuário ,ela só pode ser usada depois de chamar a sessao session_start 

    $_SESSION["nome"]=$nome; //"nome" vai assim por estamos acessando um dado 
	header("Location: /site/index.php");// é aonde nós acionamos o arquivo,e o usuario é redirecionado para a tela inicial após logar.

}

function deslogar(){//fuction deslogar ($usuario_id identifica se é usuario funcionário ou empresa) e será destruido qualquer dado após ele sair do site
	session_destroy();// é a função chamada para destruir todos os dados de sessão do usuario e será deslogado do sistema
	header("Location: /site/index.php");
}

function usuario_logado(){
	if (isset($_SESSION["empresa_id"])  || isset ($_SESSION["funcionario_id"]))// está função checa se o usuário está logado ou não no sistema seja ele empresa ou funcionário
     return true;
     else 
     return false;
}




?>