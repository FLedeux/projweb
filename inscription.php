<script type="text/javascript" src="verif_mdp.js"></script>
<?php
session_start();
if(isset($_SESSION['pseudo'])){
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = "page_acceuil";
  header("Location: http://$host$uri/$extra");
}
?>
<html>
  <head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <?php
          echo "<a href=\"./connection_redacteur.php\"><li><div> se connecter</div></li></a>";
          echo "<a href=\"./page_acceuil.php\"><li><div>retour à l'accueil</div></li></a>";
          ?>
        </ul>
      </nav>
    </header>
    <article>
      <form method="post" action="traitement_inscription.php"> </br>

        Nom :
        <input type="text" size"20" placeholder="Nom" name="nom"
        <?php
        if(isset($_SESSION['nom'])) echo 'value="' . $_SESSION['nom'] . '"';
        unset($_SESSION['nom']);
        ?>
        required autocomplete="off" /></br>

        </br>

        Prenom :
        <input type="text" size"20" placeholder="Prenom" name="prenom"
        <?php
        if(isset($_SESSION['prenom'])) echo 'value="' . $_SESSION['prenom'] . '"';
        unset($_SESSION['prenom']);
        ?>
        required autocomplete="off" /> </br>

        </br>

        email :
        <input type="email" name="email" size="30" placeholder="email"
        <?php
        if(isset($_SESSION['mail'])) echo 'value="' . $_SESSION['mail'] . '"';
        unset($_SESSION['mail']);
        ?>
        required autocomplete="off" /> </br> </br>
        <?php if(isset($_SESSION['pb'])&&($_SESSION['pb']==1||$_SESSION['pb']==3 )) echo"ce mail existe déjà"; ?>

        </br>

        mot de passe :
        <input id="mdp1" type="password" oninput="check_mdp()" size"20" placeholder="mot de passe" name="mdp"
        <?php
        if(isset($_SESSION['mdp'])) echo 'value="' . $_SESSION['mdp'] . '"';
        unset($_SESSION['mdp']);
        ?>
        required /> </br> </br>
<!-- rajouter verif mdp -->

        vérification de mot de passe :
        <input id="mdp2" type="password" oninput="check_mdp()" size"20" placeholder="mot de passe" name="mdp"
        <?php
        if(isset($_SESSION['mdp'])) echo 'value="' . $_SESSION['mdp'] . '"';
        unset($_SESSION['mdp']);
        ?>
        required /> </br> </br>

        <p id="label_mdp">

        </p>

        pseudo :
        <input type="text" size"20" placeholder="pseudo" name="pseudo"
        <?php
        if(isset($_SESSION['pseudo²'])) echo 'value="' . $_SESSION['pseudo²'] . '"';
        unset($_SESSION['pseudo²']);
        ?>
        required autocomplete="off" /> </br> </br>

        <?php if(isset($_SESSION['pb'])&&($_SESSION['pb']==1||$_SESSION['pb']==2 )) echo"ce pseudo existe déjà"; ?>
        </br>

        <?php   unset($_SESSION["pb"]);?>

        <input type="submit" onclick="javascript: return check_mdp_valider();" name="s'inscrire" value="inscription" required/>
      </form>
    </article>

  </body>
</html>
