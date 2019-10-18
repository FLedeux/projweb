<?php
function connection(){
try {
  return $objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=ledeux2u_blog','ledeux2u_appli','31802662');
}
catch(Exception $exception){
  die($exception->getMessage());
}
}
?>
