<?php
include ('connection.php');
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
try{

  session_start();

  $requete = connection()->prepare('Select idredacteur from redacteur where pseudo=:pseudo');
  $requete->bindParam(':pseudo',$_SESSION['pseudo'],PDO::PARAM_STR);
  $requete->execute();
  $id = $requete->fetch();

  $requete = connection()->prepare('INSERT INTO sujet(idredacteur,titresujet,textesujet) VALUES(:idredacteur,:titre,:texte);');
  $requete->bindParam(':idredacteur',$id['idredacteur'],PDO::PARAM_INT);
  $requete->bindParam(':titre',$_POST['titre'],PDO::PARAM_STR);
  $requete->bindParam(':texte',$_POST['texte'],PDO::PARAM_STR);
  $requete->execute();
  $pb = $requete->fetch();

  $extra ='page_acceuil.php';
}

catch(Exception $e){
  $extra = 'error_dbb.php';
}

header("Location: http://$host$uri/$extra");
exit();

 ?>
