<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = "connection_redacteur.php";
  $_SESSION['extra']="creation_topic.php";
  header("Location: http://$host$uri/$extra");
  exit();
}
?>
<!DOCTYPE html>
<html>
 <head>
   <title>Creation d'un article</title>
   <link rel="stylesheet" type="text/css" href="style.css">
 </head>

 <body>
   <header>
     <nav>
       <ul>
         <?php
          echo "<a href=\"./ses_topic.php\"><li> <div>" . $_SESSION['pseudo'] . "</div> </li></a>";
          echo "<a href=\"./traitement_deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><li><div>Deconnexion</div></li></a>";
          echo "<a href=\"./page_acceuil.php\"><li><div>retour à l'accueil</li></div></a>";
          ?>
        </ul>
      </nav>
    </header>
    <article>
      <form method="post" action="traitement_creation_topic.php"> </br>

        titre :

        <input type="text" size="50" placeholder="titre" name="titre" maxlength="100" required/> </br> </br>

        contenu :
        </br>

        <textarea name="texte"  minlength="1" maxlength="5000" required></textarea> </br> </br>

        </br>

        <input type="submit" name="poster" value="poster" required/>
      </form>
    </article>

  </body>
 </html>
