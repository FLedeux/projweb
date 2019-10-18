<?php
session_start();
?>
<html>
<head>
  <title>Deconnexion</title>
</head>
<body>
  <h1>Voulez vous vous déconnecter?</h1>
  <form method="post" action="traitement_deconnection.php">
    <input type="submit" name="action" value="Deconnexion"/>
    <input type="submit" name="action" value="Annuler"/>
  </form>
</body>
</html>
