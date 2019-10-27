
<?php
include ('connection.php');
session_start();
if(isset($_SESSION['idsujet'])) unset($_SESSION['idsujet']);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <?php
	         if(isset($_SESSION['pseudo'])){
             echo "<li><a href=\"./ses_topic.php\"><div>" . $_SESSION['pseudo'] . "</div></a></li>";
             echo "<li><a href=\"./traitement_deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><div>Deconnexion</div></a></li>";
           }
           else{
             //connection et inscription
             echo "<li><a href=\"./connection_redacteur.php\"><div>Connexion</div></a></li>";
             echo "<li><a href=\"./inscription.php\"><div>Inscription</div></a></li>";
           }
           ?>
         </ul>
       </nav>
     </header>
     <article>
       <h1>Page d'accueil</h1>
       <ul>
         <li><a  href="./creation_topic.php" id="crearticle">Creer un nouveau topic</a></li>
         <?php
         $requete = connection()->prepare('select idsujet, pseudo, titresujet, datesujet  from sujet,redacteur where sujet.idredacteur=redacteur.idredacteur ORDER BY idsujet DESC');
         $requete->execute();
         while($value=$requete->fetch()){
           $dateheure = explode(" ",$value['datesujet']); // séparer le temps du jour
           echo "<li><a href=\"./voir_topic.php?idsujet=" . $value['idsujet'] . "\">";
           echo $value['pseudo'] . " : " . $value['titresujet'] . " le " . $dateheure[0] . " à " . $dateheure[1];
           echo "</a></li>";
         }
         ?>
       </ul>
     </article>
   </body>
</html>
