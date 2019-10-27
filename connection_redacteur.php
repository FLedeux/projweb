<!-- Page pour se connecter a son compte rédacteur -->

<?php
session_start();
if(isset($_SESSION['pseudo'])){ // regarde si la personne qui accède à la page est déjà connecté, si elle l'est, elle se fait rediriger à la page d'accueil
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'page_acceuil.php';
  header("Location: http://$host$uri/$extra");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <header>
      <nav>
        <ul>
          <?php
          echo "<li><a href=\"./connection_redacteur.php\"><div> se connecter</div/></a></li>";
          echo "<li><a href=\"./page_acceuil.php\"><div>retour à l'acceuil</div></a></li>";
          ?>
        </ul>
      </nav>
    </header>
    <article>
      <h1>Connexion</h1>
      <form method="post" action="traitement_connection_redacteur.php"> </br>

        <div class="no_spe">
          identifiant :

          <input type="text" size="20" placeholder="pseudo ou email" name="identifiant" required autocomplete="off"/> </br> </br>

          mot de passe :
          <input type="password" size="20" placeholder="mot de passe" name="mdp" required/> </br> </br>

          <?php
          if(isset($_SESSION['pb'])) echo"cet identifiant n'existe pas ou le mot de passe est éronné";
          unset($_SESSION["pb"]);
          ?>
          </br>
        </div>
        <input type="submit" name="connexion" value="connection"/>
      </form>
    </article>

  </body>
</html>
