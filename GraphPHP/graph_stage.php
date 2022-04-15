<?php

//                         0  400  200 15  10  1
function camembert($freq,$ord,$rm,$rn,$h,$d1,$dt)
{
    //ordre
    if($ord==1) sort($freq);
    if($ord==2) rsort($freq);
   // if($aff) ImageLoadFont();
    $nb=count($freq);
    $somme=array_sum($freq);
    $im=ImageCreate(intval($rm+$d1*$dt*2+$d1*2),intval($rn+$d1*$dt*2+$h*2)); //dessus du camembert
    $white=ImageColorAllocate($im,255,255,255);
    ImageColorTransparent($im,$white);
    $pal=DoubleColorSet($im);
    //if($aff) $black=ImageColorAllocate($im,0,0,0);
    $im2=ImageCreate(intval($rm+$d1*$dt*2+$d1*2),intval($rn+$d1*$dt*2+$h*2)); //3D du camembert
    $white=ImageColorAllocate($im2,255,255,255);
    ImageColorTransparent($im2,$white);
    DoubleColorSet($im2);

    for($last=0,$i=0;$i<$nb;$i++)
    {
        $degree=360*($freq[$i]/$somme);
        $col=$pal[(192/($nb+1))*$i];
        ImageFilledArc($im,(ImageSX($im)/2)+($i==0|$dt)*$d1*cos(($last+$degree/2)/360*2*M_PI),
                           (ImageSY($im)/2)+($i==0|$dt)*$d1*sin(($last+$degree/2)/360*2*M_PI)*($rn/$rm*1.5),
                           $rm,$rn,$last,$last+$degree,$col,IMG_ARC_NOFILL&IMG_ARC_EDGED);
        $last+=$degree;
    }

    ImageCopy($im2,$im,0,0,0,0,ImageSX($im),ImageSY($im));
    ImageColorMod($im2,64);

    for($i=0;$i<$h;$i++)
        ImageCopy($im,$im,0,0,0,1,ImageSX($im),ImageSY($im)); //effet 3D en recopiant l'image h fois sur elle même
    ImageCopy($im,$im2,0,0,0,$h,ImageSX($im),ImageSY($im));
    //if($aff) ImageStringPerso($im,5,5,'left',$aff[0],$black,0);
    drawPNG($im);
    ImageDestroy($im);ImageDestroy($im2);
}



function ImageColorMod($im,$mod) //décale les couleurs d'une palette de $mod composantes r, v er b
{
    $nb=ImageColorsTotal($im);
    for($i=1;$i<$nb;$i++) //ne prend pas la 1e couleur (généralement le fond en transparent)
    {
        $rvb=ImageColorsForIndex($im,$i);
        //teste les débordements
        if(($mod+$rvb['red'])>255) $rvb['red']=255-$mod;
        if(($mod+$rvb['green'])>255) $rvb['green']=255-$mod;
        if(($mod+$rvb['blue'])>255) $rvb['blue']=255-$mod;
        if(($mod+$rvb['red'])<0) $rvb['red']=-$mod;
        if(($mod+$rvb['green'])<0) $rvb['green']=-$mod;
        if(($mod+$rvb['blue'])<0) $rvb['blue']=-$mod;
        //redéfinit la couleur
        ImageColorSet($im,$i,$mod+$rvb['red'],$mod+$rvb['green'],$mod+$rvb['blue']);
    }
}

function DoubleColorSet($im) //192 couleurs
{
    for($i=0;$i<64;$i++)
    {
        $pal[$i]=ImageColorAllocate($im,0,$i*3,192);
        $pal[$i+64]=ImageColorAllocate($im,$i*3,192-$i*3,192);
        $pal[$i+64*2]=ImageColorAllocate($im,255-$i*4,0,192);
    }
    return($pal);
}

function drawPNG($im)
{
    static $n;
    $n++;
    imagePNG($im,"tmp$n.png");
    echo "<img src=\"tmp$n.png\">";
}
?>