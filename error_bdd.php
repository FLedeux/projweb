<?php
session_start();
if(!isset($_SESSION['BDD_ERROR'])){ // regarde si la personne qui accède à la page est déjà connecté, si elle l'est, elle se fait rediriger à la page d'accueil
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'page_acceuil.php';
  header("Location: http://$host$uri/$extra");
}
?>
<html>
  <head>
    <title>Erreur de la base de données</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <header>
      <nav>
        <ul>
          <a href="./page_acceuil.php"><li><div>retour à l'acceuil</div></li></a>
        </ul>
      </nav>
    </header>
    <article>
      <h1> Erreur au niveau de la base de données</h1>
      <p>
        <?php
        echo $_SESSION['BDD_ERROR'];
        unset($_SESSION['BDD_ERROR']);
         ?>
        </br>
        </br>
        Veillez contacter un administrateur
      </p>
    </article>

  </body>
</html>
