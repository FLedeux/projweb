
<?php
include ('connection.php');
session_start();
if(!isset($_SESSION['pseudo'])){
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'page_acceuil.php';
  header("Location: http://$host$uri/$extra");
  exit();
}
if(isset($_SESSION['idsujet'])) unset($_SESSION['idsujet']);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mes sujets</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <?php
             echo "<li><a href=\"./ses_topic.php\"> <div>" . $_SESSION['pseudo'] . "</div></a></li>";
             echo "<li><a href=\"./traitement_deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><div>Deconnexion</div></a></li>";
             echo "<li><a href=\"./page_acceuil.php\"><div>retour à l'acceuil</div></a></li>";
           ?>
         </ul>
       </nav>
     </header>
     <article>
       <h1>Mes sujets</h1>
       <ul>
         <li><a  href="./creation_topic.php" id="crearticle">Creer un nouveau topic</a></li>
         <?php
         $requete = connection()->prepare('select idsujet, titresujet, datesujet  from sujet,redacteur where sujet.idredacteur=redacteur.idredacteur AND redacteur.pseudo=:pseudo ORDER BY idsujet DESC');
         $requete->bindParam(':pseudo',$_SESSION['pseudo'],PDO::PARAM_STR);
         $requete->execute();
         while($value=$requete->fetch()){
           $dateheure = explode(" ",$value['datesujet']); // séparer le temps du jour
           echo "<li><a href=\"./voir_topic.php?idsujet=" . $value['idsujet'] . "\">";
           echo $value['titresujet'] . " le " . $dateheure[0] . " à " . $dateheure[1];
           echo "</a></li>";
         }
         ?>
       </ul>
     </article>
   </body>
</html>
