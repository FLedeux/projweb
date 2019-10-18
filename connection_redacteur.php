<html>
<head>
  <title>Connexion</title>
</head>
<body>

<a href="./connection_redacteur.php"> se connecter</a>
<a href="./page_acceuil.php">retour à l'acceuil</a>


  <form method="post" action="traitement_connection_redacteur.php"> </br>

      identifiant :

      <input type="text" size"20" placeholder="pseudo ou email" name="identifiant" required/> </br> </br>

      mot de passe :
      <input type="password" size"20" placeholder="mot de passe" name="mdp" required/> </br> </br>

   <?php
   session_start();
   if(@$_SESSION['pb']==1) echo"ce pseudo n'existe pas ou le mot de passe est éronné";
   unset($_SESSION["pb"]);
   ?>
   </br>

   <input type="submit" name="connexion" value="connection" required/>
 </form>


</body>
</html>
