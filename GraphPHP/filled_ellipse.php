<?php

// nouvelle image
$image = imagecreatetruecolor(400,300);

// couleur de fond
$bg = imagecolorallocate($image,0,0,0);

// couleur de remplissage de l'ellipse
$col_ellipse = imagecolorallocate($image,255,255,255);

// on dessine l'ellipse blanche
imagefilledellipse($image, 200, 150, 300, 200, $col_ellipse);

// on affiche l'image
header("Content-type: image/png");
imagepng($image);

?> 