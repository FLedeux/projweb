
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
             echo "<a href=\"./ses_topic.php\"><li> <div>" . $_SESSION['pseudo'] . "</div> </li></a>";
             echo "<a href=\"./traitement_deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><li><div>Deconnexion</div></li></a>";
             echo "<a href=\"./page_acceuil.php\"><li><div>retour à l'acceuil</div></li></a>";
           ?>
         </ul>
       </nav>
     </header>
     <article>
       <h1>Mes sujets</h1>
       <ul>
         <a  href="./creation_topic.php"><li id="crearticle">Creer un nouveau topic</li></a>
         <?php
         $requete = connection()->prepare('select idsujet, titresujet, datesujet  from sujet,redacteur where sujet.idredacteur=redacteur.idredacteur AND redacteur.pseudo=:pseudo ORDER BY idsujet DESC');
         $requete->bindParam(':pseudo',$_SESSION['pseudo'],PDO::PARAM_STR);
         $requete->execute();
         while($value=$requete->fetch()){
           $dateheure = explode(" ",$value['datesujet']); // séparer le temps du jour
           echo "<a href=\"./voir_topic.php?idsujet=" . $value['idsujet'] . "\">";
           echo "<li>" . $value['titresujet'] . " le " . $dateheure[0] . " à " . $dateheure[1] . "</li>";
           echo "</a>";
         }
         ?>
       </ul>
     </article>
   </body>
</html>
