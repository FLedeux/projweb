
<?php
include ('connection.php');
session_start();
if(isset($_SESSION['idsujet'])) unset($_SESSION['idsujet']);
?>
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
             echo "<a href=\"./ses_topic.php\"><li> <div>" . $_SESSION['pseudo'] . "</div> </li></a>";
             echo "<a href=\"./traitement_deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><li><div>Deconnexion</div></li></a>";
           }
           else{
             //connection et inscription
             echo "<a href=\"./connection_redacteur.php\"><li><div>Connexion</div></li></a>";
             echo "<a href=\"./inscription.php\"><li><div>Inscription</div></li></a>";
           }
           ?>
         </ul>
       </nav>
     </header>
     <article>
       <h1>Page d'accueil</h1>
       <ul>
         <a  href="./creation_topic.php"><li id="crearticle">Creer un nouveau topic</li></a>
         <?php
         $requete = connection()->prepare('select idsujet, pseudo, titresujet, datesujet  from sujet,redacteur where sujet.idredacteur=redacteur.idredacteur ORDER BY idsujet DESC');
         $requete->execute();
         while($value=$requete->fetch()){
           $dateheure = explode(" ",$value['datesujet']); // séparer le temps du jour
           echo "<a href=\"./voir_topic.php?idsujet=" . $value['idsujet'] . "\">";
           echo "<li>" . $value['pseudo'] . " : " . $value['titresujet'] . " le " . $dateheure[0] . " à " . $dateheure[1] . "</li>";
           echo "</a>";
         }
         ?>
       </ul>
     </article>
   </body>
</html>
