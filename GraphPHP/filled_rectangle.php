<?php

// nouvelle image
$image = imagecreatetruecolor(400,300);

// couleur de fond
$bg = imagecolorallocate($image,0,0,0);

// couleur de remplissage de l'ellipse
$col_ellipse = imagecolorallocate($image,255,255,255);

// on dessine le rectangle blanche
imagefilledrectangle ($image, 10, 10, 20, 60, $col_ellipse);

// on affiche l'image
header("Content-type: image/png");
imagepng($image);

?> 