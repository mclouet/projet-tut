<?php
  header("Content-type: image/jpeg") ;
  if (isset($_SERVER["REMOTE_ADDR"]))
    $adressIP = $_SERVER["REMOTE_ADDR"] ;
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $adressIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ;

  if (isset ($_GET["image"])) {
    $nomImage = $_GET["image"] ;
    $im = imagecreatefromjpeg("./images/reduction_".$nomImage) ;
    $logo = imagecreate(300, 20) ;
    $background_color = imagecolorallocate($logo, 0, 0, 0);
    $text_color = imagecolorallocate($logo, 233, 14, 91);
    imagestring($logo, 1, 5, 5,  "Votre adresse Ip est ".$adressIP, $text_color);
    imagecopymerge($im, $logo, 10, 10, 0, 0, 200, 47, 75);
    // Affichage de l'image
    imagejpeg($im);
    // Libération de la mémoire
    imagedestroy($im);
  }	
?>