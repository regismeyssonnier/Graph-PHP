<?php

// Création de l'image
$image = imagecreatetruecolor(200, 200);

// Allocation de quelques couleurs
$white    = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($image, 0x90, 0x00, 0x00);

imagefill($image,0,0,$white);

// Création de l'effet 3D
for ($i = 60; $i > 50; $i--) {
   imagefilledarc($image, 50, $i, 100, 75, 0, 75, $darknavy, IMG_ARC_PIE);
   //imagefilledarc($image, (50 +(cos(90*M_PI/180)*25)), ($i +(sin(90*M_PI/180)*25)), 100, 75, 75, 105 , $darkgray, IMG_ARC_PIE);
   imagefilledarc($image, 50, $i, 100, 75, 75, 105 , $darkgray, IMG_ARC_PIE);
   imagefilledarc($image, 50, $i, 100, 75, 105, 360 , $darkred, IMG_ARC_PIE);
   
}

imagefilledarc($image, 50, 50, 100, 75, 0, 75, $navy, IMG_ARC_PIE);
//imagefilledarc($image,(50 +(cos(90*M_PI/180)*25)), (50 +(sin(90*M_PI/180)*25)), 100, 75, 75, 105 , $gray, IMG_ARC_PIE);
imagefilledarc($image, 50, 50, 100, 75, 75, 105 , $darkgray, IMG_ARC_PIE);
imagefilledarc($image, 50, 50, 100, 75, 105, 360 , $red, IMG_ARC_PIE);



// Affichage de l'image
//header('Content-type: image/png');
echo "ilmage:" .$image;
imagepng($image, "tmp");
echo '<img src="tmp" alt="camembert"/>';
imagedestroy($image);


?>
