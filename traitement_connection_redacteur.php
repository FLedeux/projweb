<?php
include ('connection.php');
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
try{

  $securemdp = md5("Ledeux".$_POST['mdp']."Hallowen");
  $requete = connection()->prepare('select pseudo, count(*) AS pb from redacteur where (pseudo=:identifiant OR mail=:identifiant) AND motdepasse="' . $securemdp. '"');
  $requete->bindParam(':identifiant',$_POST['identifiant'],PDO::PARAM_STR);
  $test = $requete->bindParam(':mdp',$securemdp,PDO::PARAM_STR);
  $requete->execute();
  $result = $requete->fetch();

  session_start();
  if ($result['pb']!=1){
    $extra = 'connection_redacteur.php';
    $_SESSION['pb']=$result['pb'];
  }
  else{
    if(isset($_SESSION['extra'])) $extra = $_SESSION['extra'];
    else $extra ='page_acceuil.php';
    $_SESSION['pseudo']=$result['pseudo'];
    unset($_SESSION['extra']);
  }
}

catch(Exception $e){
  $extra = 'error_dbb.php';
}

header("Location: http://$host$uri/$extra");
exit();

 ?>
