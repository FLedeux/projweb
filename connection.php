<?php
function connection(){
  try {
    return $objPdo = new PDO('mysql:host=?;port=3306;dbname=?','identifiant','mot de passe'); //a compléter
  }
  catch(Exception $exception){
    session_start();
    $_SESSION['BDD_ERROR']=$exception->getMessage();

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'error_bdd.php';

    header("Location: http://$host$uri/$extra");
    exit();
  }
}
?>
