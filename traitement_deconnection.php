<?php
session_start();
if($_POST['action']=='Deconnexion')   unset($_SESSION["pseudo"]);

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'page_acceuil.php';
header("Location: http://$host$uri/$extra");


 ?>
