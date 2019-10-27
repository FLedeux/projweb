
<?php
include ('connection.php');
session_start();
if(!isset($_SESSION['idsujet']))$_SESSION['idsujet']=$_GET['idsujet'];
?>


<html>
  <head>
    <?php
    $requete = connection()->prepare('select pseudo, titresujet, datesujet, textesujet from sujet,redacteur where sujet.idredacteur=redacteur.idredacteur AND idsujet= :idsujet');
    $requete->bindParam(':idsujet',$_SESSION['idsujet'],PDO::PARAM_INT);
    $requete->execute();
    $value=$requete->fetch();

    if($value['titresujet']) echo "<title>" . $value['titresujet'] . "</title>";
    else echo "<title> Erreur sélection de topic </title>";
    ?>

    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <?php
	         if(isset($_SESSION['pseudo'])){
             echo "<a href=\"./ses_topic.php\"><li> <div>" . $_SESSION['pseudo'] . "</div> </li></a>";
             echo "<a href=\"./deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><li><div>Deconnexion</div></li></a>";
           }
           else{
             echo "<a href=\"./connection_redacteur.php\"><li><div>Connexion</div></li></a>";
             echo "<a href=\"./inscription.php\"><li><div>Inscription</div></li></a>";
           }
           echo "<a href=\"./page_acceuil.php\"><li><div>Retour à l'accueil</div></li></a>";
           ?>
        </ul>
      </nav>
    </header>
    <article>
      <?php
      if($value['titresujet']){ //cas ou le get donne un id qui existe
          $dateheure = explode(" ",$value['datesujet']); // séparer le temps du jour

          echo "<div>";
          echo "<h1>" . $value['titresujet'] . "</h1>" . "</br>";
          echo  nl2br($value['textesujet']) ."</br></br>";
          echo "Par " . $value['pseudo'] . " le " . $dateheure[0] . " à " . $dateheure[1];
          echo "</div>";
          echo "</br>";

          $requete = connection()->prepare('select distinct pseudo, textereponse, daterep from sujet,redacteur, reponse where reponse.idredacteur=redacteur.idredacteur AND reponse.idsujet= :idsujet');
          $requete->bindParam(':idsujet',$_SESSION['idsujet'],PDO::PARAM_INT);
          $requete->execute();

          while($value=$requete->fetch()){
            $dateheure = explode(" ",$value['daterep']); // séparer le temps du jour
            echo "<div>" . nl2br($value['textereponse']) ."</br></br> Par " . $value['pseudo'] . " le " . $dateheure[0] . " à " . $dateheure[1] . "</div> </br>";
          }

          if(isset($_SESSION['pseudo'])){
            echo '<form method="post" action="traitement_reponse_topic.php"> </br>
            votre réponse : </br>
            <textarea name="texte"  minlength="1" maxlength="1000" required></textarea> </br> </br>

            </br>

            <input type="submit" name="répondre" value="répondre" required/>';
          }
          else echo "<a href=\"./connection_redacteur.php\">Connectez vous pour répondre</a>";
        }
        else{//cas id inconnu
          echo "<div> la page que vous chercher n'existe pas </br>
          <a href=\"./page_acceuil.php\"> Retour à l'acceuil</a> </div>";
        }
        ?>
      </article>

    </body>
</html>
