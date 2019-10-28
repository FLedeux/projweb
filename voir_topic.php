
<?php
include ('connection.php');
session_start();
if(!isset($_SESSION['idsujet']))$_SESSION['idsujet']=$_GET['idsujet'];
?>

<!DOCTYPE html>
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
             echo "<li><a href=\"./ses_topic.php\"><div>" . $_SESSION['pseudo'] . "</div></a></li>";
             echo "<li><a href=\"./traitement_deconnection.php\" onclick=\"javascript: return confirm('voulez vous vous déconnecter?');\"><div>Deconnexion</div></a></li>";
           }
           else{
             echo "<li><a href=\"./connection_redacteur.php\"><div>Connexion</div></li></a></li>";
             echo "<li><a href=\"./inscription.php\"><div>Inscription</div></li></a></li>";
           }
           echo "<li><a href=\"./page_acceuil.php\"><div>Retour à l'accueil</div></a></li>";
           ?>
        </ul>
      </nav>
    </header>
    <article>
      <?php
      if($value['titresujet']){ //cas ou le get donne un id qui existe
          $dateheure = explode(" ",$value['datesujet']); // séparer le temps du jour

          echo "<div>";
          echo "<h1 class=\"center\">" . $value['titresujet'] . "</h1>" . "</br>";
          echo  nl2br($value['textesujet']) ."</br></br>";
          echo "<p class=\"center\">Par " . $value['pseudo'] . " le " . $dateheure[0] . " à " . $dateheure[1] . "</p>";
          echo "</div>";
          echo "</br>";

          $requete = connection()->prepare('select distinct pseudo, textereponse, daterep from sujet,redacteur, reponse where reponse.idredacteur=redacteur.idredacteur AND reponse.idsujet= :idsujet');
          $requete->bindParam(':idsujet',$_SESSION['idsujet'],PDO::PARAM_INT);
          $requete->execute();

          while($value=$requete->fetch()){
            $dateheure = explode(" ",$value['daterep']); // sépare le temps du jour
            echo "<div>" . nl2br($value['textereponse']) ."</br></br><p class=\"center\"> Par " . $value['pseudo'] . " le " . $dateheure[0] . " à " . $dateheure[1] . "</p></div> </br>";
          }

          if(isset($_SESSION['pseudo'])){
            echo '<form method="post" action="traitement_reponse_topic.php"> </br>
            votre réponse : </br>
            <textarea name="texte"  minlength="1" maxlength="1000" required></textarea> </br> </br>

            </br>

            <input type="submit" name="répondre" value="répondre"/>
            </br>
            </br>';
          }
          else echo "<a href=\"./connection_redacteur.php\">Connectez vous pour répondre</a>
          </br>
          </br>";
        }
        else{//cas id inconnu
          echo "<div> la page que vous chercher n'existe pas </br>
          <a href=\"./page_acceuil.php\"> Retour à l'acceuil</a> </div>";
        }
        ?>
      </article>

    </body>
</html>
