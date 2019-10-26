<?php
include ('connection.php');
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
try{

  $requete = connection()->prepare('select blog.creation_redacteur(:nom, :prenom, :email, :mdp, :pseudo);');
  $requete->bindParam(':nom',$_POST['nom'],PDO::PARAM_STR);
  $requete->bindParam(':prenom',$_POST['prenom'],PDO::PARAM_STR);
  $requete->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
  $requete->bindParam(':mdp',$_POST['mdp'],PDO::PARAM_STR);
  $requete->bindParam(':pseudo',$_POST['pseudo'],PDO::PARAM_STR);
  $requete->execute();
  $pb = $requete->fetch();

  session_start();

  if ($pb[0]!=0){
    switch($pb[0]){
      case 2: $_SESSION['mail']=$_POST['mail'];
              break;
      case 3: $_SESSION['pseudo']=$_POST['pseudo'];
              break;
      }
      $_SESSION['nom']=$_POST['nom'];
      $_SESSION['prenom']=$_POST['prenom'];
      $_SESSION['mdp']=$_POST['mdp'];

      $extra = 'inscription.php';
      $_SESSION['pb']=$pb[0];
    }
    else{

      $extra ='page_acceuil.php';
      $_SESSION['pseudo']=$_POST['pseudo'];

    }
}
catch(Exception $e){
  $extra = 'error_dbb.php';
}

header("Location: http://$host$uri/$extra");
exit();

 ?>
