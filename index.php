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
            <h3>Bem-vindo(a) ao Reembolsa Fácil!</h3>
            <p>AQUI VOCÊ APROVA REEMBOLSOS CORPORATIVOS NUM TEMPO RÁPIDO PARA SEU FUNCIONÁRIO.</p>
            <p>
            O REEMBOLSO ,É FEITO A PARTIR DE CUPONS FISCAIS ENVIADOS E PODEM SER GERENCIADOS, ATRAVÉS
            DA NOSSA PLATAFORMA, AQUI VOCÊ APROVA OU NÃO ESTE REEEMBOLSO SEM BUROCRACIA!!
            </p>
            <p>
             COM O PAGAMENTO DESTAS DESPESAS CORPORATIVAS SENDO ÁGIL, ISTO TRAZ A POSSIBILIDADE DE REALIZAR TAREFAS
             QUE NORMALMENTE FICAM EM SEGUNDO PLANO COMO ANÁLISE DE FATURAMENTO E BUSCA DE NOVOS FORNECEDORES. 
             </p>
             <p>NÃO PERCA TEMPO, CADASTRE-SE EM NOSSO SITE!</p>
             <p>OU <a href="contatos.php">ENTRE EM CONTATO CONOSCO</a></p>
            </p>
        </article>
        <aside>
            <p>Anuncie Aqui!!!!</p>
           <img src="img\estrela.png">
           <img src="img\shopping.png">
        </aside>
    </section>
    <footer>
        <h2>Copyright &copy; 2019 - RP Reembolso</h2>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>