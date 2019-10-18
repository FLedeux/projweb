<html>
<head>
  <title>Acceuil</title>
</head>
<body>
  <?php
  session_start();
  if(@$_SESSION['pseudo']){
      echo $_SESSION['pseudo'];
      echo "<a href=\"./deconnection.php\">Deconnexion</a>";
  }
  else{
    //connection et inscription
    echo"<a href=\"./connection_redacteur.php\">Connexion</a>";
    echo "<a href=\"./inscription.php\">Inscription</a>";
  }
  ?>



  <h1>Page acceuil</h1>
  <a href="./create_topic.php">Creerun nouveau topic</a>
  <?php
  // liste des topic


  ?>
</body>
</html>
