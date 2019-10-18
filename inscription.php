<html>
<head>
  <title>Inscription</title>
</head>
<body>

<a href="./connection_redacteur.php"> se connecter</a>
<a href="./page_acceuil.php">retour à l'acceuil</a>


  <form method="post" action="traitement_inscription.php"> </br>

    Nom :
   <input type="text" size"20" placeholder="Nom" name="nom" required/></br>

   </br>

   Prenom :
   <input type="text" size"20" placeholder="Prenom" name="prenom" required/> </br>

   </br>

   email :
   <input type="email" name="email" size="30" placeholder="email" required/> </br> </br>
   <?php
   session_start();
   if(@$_SESSION['pb']==1||$_SESSION['pb']==3 ) echo"ce mail existe déjà";
   ?>
   mot de passe :
   <input type="password" size"20" placeholder="mot de passe" name="mdp" required/> </br> </br>
<!-- rajouter verif mdp -->
   pseudo :

   <input type="text" size"20" placeholder="pseudo" name="pseudo" required/> </br> </br>
   <?php
   if(@$_SESSION['pb']==1||$_SESSION['pb']==2 ) echo"ce pseudo existe déjà";
   ?>
   </br>
<?php   unset($_SESSION["pb"]);
 ?>
   <input type="submit" name="s'inscrire" value="inscription" required/>
 </form>


</body>
</html>
