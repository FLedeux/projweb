<?php
include ('connection.php');
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
try{
$requete = connection()->prepare('select ledeux2u_blog.connection_redacteur(:identifiant, :mdp);');
$requete->bindParam(':identifiant',$_POST['identifiant'],PDO::PARAM_STR);
$requete->bindParam(':mdp',$_POST['mdp'],PDO::PARAM_STR);
$requete->execute();
$pb = $requete->fetch();
$result->closeCursor();
  session_start();
if ($pb==1){

 $extra = 'connection_redacteur.php';
 $_SESSION['pb']=$pb;
}
else{

  $extra ='page_acceuil.php';
  $_SESSION['pseudo']=$result['pseudo'];
  }
}
catch(Exception $e){
$extra = 'error_dbb.php';
}
header("Location: http://$host$uri/$extra");
exit();

 ?>
