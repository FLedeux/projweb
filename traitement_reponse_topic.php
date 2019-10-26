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


  $requete = connection()->prepare('INSERT INTO reponse(idsujet,idredacteur,textereponse) VALUES(:idsujet,:idredacteur,:texte);');
  $requete->bindParam(':idsujet',$_SESSION['idsujet'],PDO::PARAM_INT);
  $requete->bindParam(':idredacteur',$id['idredacteur'],PDO::PARAM_INT);
  $requete->bindParam(':texte',$_POST['texte'],PDO::PARAM_STR);
  $requete->execute();
  $pb = $requete->fetch();

  $extra ='voir_topic.php?idsujet='.$_SESSION['idsujet'];
}
catch(Exception $e){
  $extra = 'error_dbb.php';
}

header("Location: http://$host$uri/$extra");
exit();

 ?>
