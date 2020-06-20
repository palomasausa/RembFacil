<!DOCTYPE html>
<html>
<head>
    <title>Reembolsa Fácil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
     <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script><!--o link serve para permitir que se use alguns icones da página mais especifica ionic -->
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
            <p>Contatos</p>
               <p> Quer nos contatar ?</p>
               <p> 0800 159 2368 </p>
               <p> 19 98258-7894</p>
        </article>
        <aside>
            <p>Anuncie Aqui!!!!</p>
           <img src="img\estrela.png">
           <img src="img\shopping.png">
        </aside>
    </section>
    <footer>
        <h2>Copyright &copy; 2019 -Reembolsa Fácil</h2>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>
</html>