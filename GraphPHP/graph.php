<! GraPHP-IC is a PHP project that allow you to create "png" images which represent statistic charts
   Copyright (C) 2000 Thomas Begrand.

 Project name : GraPHP-IC (Intranet Charts)
 Author :Thomas Begrand
 Author Email : t.begrand@caramail.com
 Sources available on : www.sourceforge.net (project name : GraPHP-IC)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 CERMEX, hereby disclaims all copyright interest in the project
 "GraPHP-IC"(which creates statidtic charts) written by Thomas Begrand.
 Eric Poisse, 29 September 2000
 Eric Poisse, Responsible of the Data processing department.
 Email : eric.poisse@cermex.fr !>

<html>
<head>
<!-- #BeginEditable "doctitle" --> 
<title>Resultats Statistiques - camemberts</title>
<!-- #EndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<?php

$p = array(25, 25, 25,  25);
$l = array('Lyon', 'Paris', 'Marseille', 'Toulouse');
$c = new Camembert();
$c->Trace_camembert('camembert', '2', '4', 'ext', $p, $l) ; 

//Définition d'une classe "Camembert" contenant les paramètres servant à tracer le graph et la fonction de traçage du graph
class Camembert{ 

	var $titre;
	var $back_color;
	var $format;
	var $position;
	var $tab_pourcent;
	var $tab_libelle;

/*********************************************************************************************************************/

	function Trace_camembert($titre,$back_color,$format,$position,$tab_pourcent,$tab_libelle){
		//DONNEES (tests et analyses des paramètres précédents)
		//test permettant de verifier si un titre a ete saisi
		if(!$titre){
			echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de titre pour votre graphique."."<br>");
		}
		
		//test permettant de verifier si un format et une position ont ete definit
		if(!$format && !$position){
			echo("<b>ATTENTION !</b>: Vous n'avez pas choisi de format de graphique ni de position pour les libellés. Des paramètres par défaut ont été adoptés."."<br>");
			$format="3";
			$position="ext";
		}
		if(!$format){ 
			echo("<b>ATTENTION !</b>: Vous n'avez pas choisi de format pour votre graphique. Un format par défaut a été adopté."."<br>");
			$format="3"; 
		}
		if(!$position){
			echo("<b>ATTENTION !</b>: Vous n'avez pas défini la position des libellés sur votre graphique. Une position par défaut a été adopté."."<br>");
			$position="ext";
		}
		
		//test permettant de verifier si des valeurs de % ont ete saisies
		$num_tab_pourcent=count($tab_pourcent);//comptage du nombre de % dans le tableau
		if($num_tab_pourcent==0){
			echo("<b>ATTENTION !</b>: Vous devez entrer des valeurs pour obtenir votre graphique."."<br>");
		}
		//test permettant de verifier si la somme des valeurs saisies est egale à 100
		$somme=0;
		for($add=0;$add<$num_tab_pourcent;++$add ){
			$somme=$tab_pourcent[$add]+$somme;
		}
		if($somme<100){
			echo("<b>ATTENTION !</b>: La somme des valeurs que vous avez saisi (somme=".$somme.") est inférieure à 100."."<br>");
		}
		if($somme>100){
			echo("<b>ATTENTION !</b>: La somme des valeurs que vous avez saisi (somme=".$somme.") est supérieure à 100."."<br>");
		}
		
		//test permettant de verifier si des libelles associes aux % ont ete saisis
		$num_tab_libelle=count($tab_libelle);//comptage du nombre de libelle dans le tableau
		if($num_tab_libelle==0){
			echo("<b>ATTENTION !</b>: Vous n'avez saisi aucun libellé en référence à vos valeurs."."<br>"); 
		}
		if($num_tab_libelle<$num_tab_pourcent){
			echo("<b>ATTENTION !</b>: Vous avez saisi plus de valeurs que de libellés."."<br>"); 
		}
		if($num_tab_libelle>$num_tab_pourcent){
			echo("<b>ATTENTION !</b>: Vous avez saisi plus de libellés que de valeurs."."<br>");
		}
	
		//test si la couleur de fond est égale à une des deux possible
		if($back_color>2){
			echo("<b>ATTENTION !</b>: Seulement deux couleurs de fond d'image sont possible."."<br>");
		}
/*********************************************************************************************************************/

		//AFFECTATION DE LA TAILLE DES ELEMENTS QUI COMPOSENT L'IMAGE
		if($format=="1" && $position=="int"){
			$X_image=300;//longueur de l'image
			$Y_image=300;//hauteur de l'image
			$X_cercle=150;//diametre en longueur du camembert (car camembert=cercle=ellipse particuliere)
			$Y_cercle=150;//diametre en hauteur du camembert
			$X_base=75;//coordonnee de base en abscisse du premier secteur
			$Y_base=150;//coordonnee de base en ordonnee du premier secteur
		}
		if($format=="1" && $position=="ext"){
			$X_image=500;
			$Y_image=300;
			$X_cercle=150;
			$Y_cercle=150;
			$X_base=75;
			$Y_base=150;		
		}
		if($format=="2" && $position=="int"){
			$X_image=400;
			$Y_image=400;
			$X_cercle=200;
			$Y_cercle=200;	
			$X_base=100;
			$Y_base=200;
		}
		if($format=="2" && $position=="ext"){
			$X_image=600;
			$Y_image=400;
			$X_cercle=200;
			$Y_cercle=200;	
			$X_base=100;
			$Y_base=200;
		}
		if($format=="3" && $position=="int"){
			$X_image=500;
			$Y_image=500;
			$X_cercle=300;
			$Y_cercle=300;	
			$X_base=100;
			$Y_base=250;
		}	
		if($format=="3" && $position=="ext"){
			$X_image=700;
			$Y_image=500;
			$X_cercle=300;
			$Y_cercle=300;	
			$X_base=100;
			$Y_base=250;
		}
		if($format=="4" && $position=="int"){
			$X_image=600;
			$Y_image=600;
			$X_cercle=400;
			$Y_cercle=400;	
			$X_base=100;
			$Y_base=300;
		}	
		if($format=="4" && $position=="ext"){
			$X_image=800;
			$Y_image=600;
			$X_cercle=400;
			$Y_cercle=400;	
			$X_base=100;
			$Y_base=300;
		}			
	
/*********************************************************************************************************************/

		//CREATION DE L'IMAGE
		$camembert=imagecreate($X_image,$Y_image);
		
		//DEFINITION DES COULEURS DES ELEMENTS GRAPHIQUES
		$couleurNoir=imagecolorallocate($camembert,0,0,0);
		
		//DEFINITION DES COULEURS SECTEURS
		$couleur[0]=imagecolorallocate($camembert,0,204,204);//couleur Gris/vert
		$couleur[1]=imagecolorallocate($camembert,255,0,0);//couleur Rouge
		$couleur[2]=imagecolorallocate($camembert,255,255,102);//couleur Jaune
		$couleur[3]=imagecolorallocate($camembert,0,0,255);//couleur Bleu
		$couleur[4]=imagecolorallocate($camembert,51,255,153);//couleur Vert
		$couleur[5]=imagecolorallocate($camembert,255,102,51);//couleur Orange
		$couleur[6]=imagecolorallocate($camembert,204,0,204);//couleur Violet
		$couleur[7]=imagecolorallocate($camembert,102,255,255);//couleur Turquoise
		$couleur[8]=imagecolorallocate($camembert,204,0,102);//couleur Bordeaux
		$couleur[9]=imagecolorallocate($camembert,255,0,102);//couleur Rose
		
		//DEFINITION DES COULEURS DE FOND
		$bg_color1=imagecolorallocate($camembert,255,255,255);//couleur Blanc
		$bg_color2=imagecolorallocate($camembert,204,204,204);//couleur griss
		
		//REMPLISSAGE COULEUR DE L'IMAGE
		if($back_color=="1"){
			imagefill($camembert,0,0,$bg_color1);
		}
		if($back_color=="2"){
			imagefill($camembert,0,0,$bg_color2);
		}
		
		//AFFICHAGE DU CAMEMBERT
		imagearc($camembert,($Y_image/2),($Y_image/2),$X_cercle,$Y_cercle,0,360,$couleurNoir);
		
/*********************************************************************************************************************/

		//AFFICHAGE ET REMPLISSAGE COULEUR DES SECTEURS
		imageline($camembert,($Y_image/2),($Y_image/2),$X_base,$Y_base,$couleurNoir);//affichage de la ligne de reference (0%)
		//initialisation des variables
		$pourcent=0;
		$j=0;//variable servant a incrementer les differentes couleurs de secteurs
		$k=0;//variable permettant d'afficher les legendes (codes couleur et libelles) les unes apres les autres
		//insertion des secteurs
		for($ref=0;$ref<$num_tab_pourcent;++$ref ){//$ref: variable de reference pour le trçage des secteurs et l'affichage des libelles
			echo 'oui<br/>';
			$pos=$Y_base*(-1);
			$p = $Y_base*(1);
			echo "pos:" .$pos ." " .$p ."<br/>";
			$rayon=$X_cercle/2;
			$pourcent=$tab_pourcent[$ref]+$pourcent;
			$x_sec=($pos+(cos($pourcent*3.6*M_PI/180)*$rayon))*(-1);
			$y_sec=($pos+(sin($pourcent*3.6*M_PI/180)*$rayon))*(-1);
			
			$x_sec2=($pos+(cos($pourcent*3.6*M_PI/180)*$rayon))*(1);
			$y_sec2=($pos+(sin($pourcent*3.6*M_PI/180)*$rayon))*(1);
			
			echo "x_sec:" .$x_sec ." " .$x_sec2 ."<br/>";
			echo "x_sec:" .$y_sec ." " .$y_sec2 ."<br/>";
			
			imageline($camembert,($Y_image/2),($Y_image/2),$x_sec,$y_sec,$couleurNoir);
			//remplissage des secteurs
			$x_coul=($pos+(cos(($pourcent-($tab_pourcent[$ref]/2))*3.6*M_PI/180)*($rayon-($rayon/2))))*(-1);
			$y_coul=($pos+(sin(($pourcent-($tab_pourcent[$ref]/2))*3.6*M_PI/180)*($rayon-($rayon/2))))*(-1);
			imagefilltoborder($camembert,$x_coul,$y_coul,$couleurNoir,$couleur[$j]);
			
			//echo $x_coul .' ' .$y_coul;
			imageline($camembert, $x_coul,$y_coul,($Y_image/2),($Y_image/2),$couleurNoir);
			
			//insertion des libelles
			//insertion des libelles pour le cas 1
			if($format=="1" && $position=="int" && $num_tab_pourcent<=2){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%";
				imagestring($camembert,2,$x_coul,$y_coul,$champs,$couleurNoir);		
			}
			if($format=="1" && $position=="int" && $num_tab_pourcent>2){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($X_cercle+$rayon+5),($Y_cercle-$rayon+$k),($X_cercle+$rayon+5)+10,($Y_cercle-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($X_cercle+$rayon+5+10)+2,($Y_cercle-$rayon+$k),$champs,$couleurNoir);	
				$k=$k+15;
			}
			if($format=="1" && $position=="ext"){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($X_cercle+$rayon)+50,($Y_cercle-$rayon+$k),($X_cercle+$rayon+50)+10,($Y_cercle-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($X_cercle+$rayon+50+10)+2,($Y_cercle-$rayon+$k),$champs,$couleurNoir);	
				$k=$k+15;
			}
			//insertion des libelles pour le cas 2
			if($format=="2" && $position=="int" && $num_tab_pourcent<=2){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%";
				imagestring($camembert,2,$x_coul,$y_coul,$champs,$couleurNoir);
			}
			if($format=="2" && $position=="int" && $num_tab_pourcent>2){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($X_cercle+$rayon+5),($Y_cercle-$rayon+$k),($X_cercle+$rayon+5)+10,($Y_cercle-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($X_cercle+$rayon+5+10)+2,($Y_cercle-$rayon+$k),$champs,$couleurNoir);	
				$k=$k+15;
			}
			if($format=="2" && $position=="ext"){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($X_cercle+$rayon)+50,($Y_cercle-$rayon+$k),($X_cercle+$rayon+50)+10,($Y_cercle-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($X_cercle+$rayon+50+10)+2,($Y_cercle-$rayon+$k),$champs,$couleurNoir);	
				$k=$k+15;
			}
			//insertion des libelles pour le cas 3
			if($format=="3" && $position=="int" && $num_tab_pourcent<=4){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%";
				imagestring($camembert,2,$x_coul,$y_coul,$champs,$couleurNoir);
			}
			if($format=="3" && $position=="int" && $num_tab_pourcent>4){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($Y_base+$rayon)+5,($Y_base-$rayon)+$k,($Y_base+$rayon+5)+10,($Y_base-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($Y_base+$rayon+5+10)+2,($Y_base-$rayon+$k),$champs,$couleurNoir);		
				$k=$k+15;
			}
			if($format=="3" && $position=="ext"){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($Y_base+$rayon)+50,($Y_base-$rayon)+$k,($Y_base+$rayon+50)+10,($Y_base-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($Y_base+$rayon+50+10)+2,($Y_base-$rayon+$k),$champs,$couleurNoir);		
				$k=$k+15;
			}
			//insertion des libelles pour le cas 4
			if($format=="4" && $position=="int" && $num_tab_pourcent<=4){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%";
				imagestring($camembert,2,$x_coul,$y_coul,$champs,$couleurNoir);
			}
			if($format=="4" && $position=="int" && $num_tab_pourcent>4){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%";
				imagefilledrectangle($camembert,($Y_base+$rayon)+5,($Y_base-$rayon)+$k,($Y_base+$rayon+5)+10,($Y_base-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($Y_base+$rayon+5+10)+2,($Y_base-$rayon+$k),$champs,$couleurNoir);	
				$k=$k+15;
			}
			if($format=="4" && $position=="ext"){
				$libelle=$tab_libelle[$ref];
				$pourcentage=$tab_pourcent[$ref];
				$champs=$libelle.": ".$pourcentage."%"; 
				imagefilledrectangle($camembert,($Y_base+$rayon)+50,($Y_base-$rayon+$k),($Y_base+$rayon+50)+10,($Y_base-$rayon+$k)+10,$couleur[$j]);
				imagestring($camembert,2,($Y_base+$rayon+50+10)+2,($Y_base-$rayon+$k),$champs,$couleurNoir);	
				$k=$k+15;
			}
			$j=$j+1;
			if($j>9){
				$j=0;
			}
		}
		
/*********************************************************************************************************************/
	
		//INSERTION DU TITRE
		if($format=="1"){
			imagestring($camembert,2,0,5,$titre,$colorNoir);
		}
		if($format=="2" || $format=="3"){
			imagestring($camembert,3,0,5,$titre,$colorNoir);
		}
		if($format=="4"){
			imagestring($camembert,5,0,5,$titre,$colorNoir);
		}
	
/*********************************************************************************************************************/

		//ENVOI DE L'IMAGE AU NAVIGATEUR ET AFFICHAGE
		imagepng($camembert,"camembert.png");
		print("<img src=\"camembert.png\">");

		//DESTRUCTION DE L'ESPACE OCCUPE PAR L'IMAGE
		imagedestroy($camembert);
	}//fin fonction
}//fin classe Camembert

?>
 
</body>
</html>



---------------------------------------------------------------------------------------------------- cut here -----------------------------


<! GraPHP-IC is a PHP project that allow you to create "png" images which represent statistic charts
   Copyright (C) 2000 Thomas Begrand.

 Project name : GraPHP-IC (Intranet Charts)
 Author :Thomas Begrand
 Author Email : t.begrand@caramail.com
 Sources available on : www.sourceforge.net (project name : GraPHP-IC)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 CERMEX, hereby disclaims all copyright interest in the project
 "GraPHP-IC"(which creates statidtic charts) written by Thomas Begrand.
 Eric Poisse, 29 September 2000
 Eric Poisse, Responsible of the Data processing department.
 Email : eric.poisse@cermex.fr !>

<html>
<head>
<title>RESULTATS STATISTIQUES : COURBES</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">

<?php

$co = new CourbeNum();
$x = array(0, 10, 0);
$y = array(0, 10, 0);
$co->Charge_courbeNum($x,$y,'regis');
$co->Trace_courbeNum('Pourri', "1", "1", "ord", "abs");
//Trace_courbeNum($titre,$back_color,$format,$label_ordonne,$label_abscisse)

//Définition d'une classe "Courbe" contenant les paramètres servant à tracer le graph et la fonction de traçage du graph
class CourbeNum{

        //inertion du mot clé "var" qui permet d'initialiser les variables lors d'une définition de classe
        var $titre;
        var $back_color;
        var $format;
        var $label_ordonne;
        var $label_abscisse;

        var $dataX1;
        var $dataY1;
        var $label_courbe1;

        var $dataX2;
        var $dataY2;
        var $label_courbe2;

        var $dataX3;
        var $dataY3;
        var $label_courbe3;

        var $dataX4;
        var $dataY4;
        var $label_courbe4;

        var $dataX5;
        var $dataY5;
        var $label_courbe5;

        var $dataX6;
        var $dataY6;
        var $label_courbe6;

        var $dataX7;
        var $dataY7;
        var $label_courbe7;

        var $dataX8;
        var $dataY8;
        var $label_courbe8;

        var $dataX9;
        var $dataY9;
        var $label_courbe9;

        var $dataX10;
        var $dataY10;
        var $label_courbe10;

        var $dataX;
        var $dataY;
        var $label_courbe;

/***********************************************************************************************************************/
        function Charge_courbeNum($dataX,$dataY,$label_courbe){
                //insertion du mot clé "global" qui permet le passage de paramètres d'une fonction à l'autre
                global $dataX1;
                global $dataY1;
                global $label_courbe1;

                global $dataX2;
                global $dataY2;
                global $label_courbe2;

                global $dataX3;
                global $dataY3;
                global $label_courbe3;

                global $dataX4;
                global $dataY4;
                global $label_courbe4;

                global $dataX5;
                global $dataY5;
                global $label_courbe5;

                global $dataX6;
                global $dataY6;
                global $label_courbe6;

                global $dataX7;
                global $dataY7;
                global $label_courbe7;

                global $dataX8;
                global $dataY8;
                global $label_courbe8;

                global $dataX9;
                global $dataY9;
                global $label_courbe9;

                global $dataX10;
                global $dataY10;
                global $label_courbe10;

                if(!$dataX1){
                        $dataX1 = $dataX;
                         $dataY1 = $dataY;
                         $label_courbe1 = $label_courbe;
                }
                elseif(!$dataX2){
                        $dataX2 = $dataX;
                         $dataY2 = $dataY;
                         $label_courbe2 = $label_courbe;
                }
                elseif(!$dataX3){
                        $dataX3 = $dataX;
                         $dataY3 = $dataY;
                         $label_courbe3 = $label_courbe;
                }
                elseif(!$dataX4){
                        $dataX4 = $dataX;
                         $dataY4 = $dataY;
                         $label_courbe4 = $label_courbe;
                }
                elseif(!$dataX5){
                        $dataX5 = $dataX;
                         $dataY5 = $dataY;
                         $label_courbe5 = $label_courbe;
                }
                elseif(!$dataX6){
                        $dataX6 = $dataX;
                         $dataY6 = $dataY;
                         $label_courbe6 = $label_courbe;
                }
                elseif(!$dataX7){
                        $dataX7 = $dataX;
                         $dataY7 = $dataY;
                         $label_courbe7 = $label_courbe;
                }
                elseif(!$dataX8){
                        $dataX8 = $dataX;
                         $dataY8 = $dataY;
                         $label_courbe8 = $label_courbe;
                }
                elseif(!$dataX9){
                        $dataX9 = $dataX;
                         $dataY9 = $dataY;
                         $label_courbe9 = $label_courbe;
                }
                elseif(!$dataX10){
                        $dataX10 = $dataX;
                         $dataY10 = $dataY;
                         $label_courbe10 = $label_courbe;
                }

        }//fin fonction chargement des données

        function Trace_courbeNum($titre,$back_color,$format,$label_ordonne,$label_abscisse){
                global $dataX1;
                 global $dataY1;
                   global $label_courbe1;

                global $dataX2;
                global $dataY2;
                global $label_courbe2;

                global $dataX3;
                global $dataY3;
                global $label_courbe3;


                global $dataX4;
                global $dataY4;
                global $label_courbe4;

                global $dataX5;
                global $dataY5;
                global $label_courbe5;


                global $dataX6;
                global $dataY6;
                global $label_courbe6;

                global $dataX7;
                global $dataY7;
                global $label_courbe7;


                global $dataX8;
                global $dataY8;
                global $label_courbe8;

                global $dataX9;
                global $dataY9;
                global $label_courbe9;


                global $dataX10;
                global $dataY10;
                global $label_courbe10;


                //DONNEES (tests, affectations et analyses)
                //tests des données : verification de l'existence des paramètres reçus
                //tests permettant de vérifier si un format a été definit
                if(!$format){
                        echo("<b>ATTENTION !</b> : Vous n'avez pas choisi de format pour votre graphique. Un format par défaut a été adopté."."<br>");
                        $format="3";
                }
                //test l'existence d'un titre
                if($titre==""){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de titre pour votre graphique."."<br>");
                }

                //test l'existence d'un libellé pour l'axe des ordonnés
                if($label_ordonne==""){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de libellé en référence à l'axe des ordonnés."."<br>");
                }

                //test l'existence d'un libellé pour l'axe des abscisses
                if($label_abscisse==""){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de libellé en référence à l'axe des abscisses."."<br>");
                }

                //test le choix de la couleur de fond d'image
                if($back_color>2){
                        echo("<b>ATTENTION !</b>: Seulement deux couleurs de fond d'image sont possible."."<br>");
                }

                //affectation des données : des diverses valeurs aux variables
                for($i=1;$i<10;$i++){
                        if($i=="1" && $dataX1){//si 1er passage dans la boucle et que le tableau existe -> affectation des variables temporaires
                                $dataXtemp=$dataX1;
                                $dataYtemp=$dataY1;
                                $num_dataX1=count($dataX1);
                                $num_dataXtemp=$num_dataX1;
                                $num_dataY1=count($dataY1);
                                $num_dataYtemp=$num_dataY1;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe1==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre première courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe1;
                                }
                        }
                        if($i=="2" && $dataX2){
                                $dataXtemp=$dataX2;
                                $dataYtemp=$dataY2;
                                $num_dataX2=count($dataX2);
                                $num_dataXtemp=$num_dataX2;
                                $num_dataY2=count($dataY2);
                                $num_dataYtemp=$num_dataY2;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe2==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre seconde courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe2;
                                }
                        }
                        if($i=="3" && $dataX3){
                                $dataXtemp=$dataX3;
                                $dataYtemp=$dataY3;
                                $num_dataX3=count($dataX3);
                                $num_dataXtemp=$num_dataX3;
                                $num_dataY3=count($dataY3);
                                $num_dataYtemp=$num_dataY3;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe3==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre troisième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe3;
                                }
                        }
                        if($i=="4" && $dataX4){
                                $dataXtemp=$dataX4;
                                $dataYtemp=$dataY4;
                                $num_dataX4=count($dataX4);
                                $num_dataXtemp=$num_dataX4;
                                $num_dataY4=count($dataY4);
                                $num_dataYtemp=$num_dataY4;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe4==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre quatrième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe4;
                                }
                        }
                        if($i=="5" && $dataX5){
                                $dataXtemp=$dataX5;
                                $dataYtemp=$dataY5;
                                $num_dataX5=count($dataX5);
                                $num_dataXtemp=$num_dataX5;
                                $num_dataY5=count($dataY5);
                                $num_dataYtemp=$num_dataY5;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe5==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre cinquième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe5;
                                }
                        }
                        if($i=="6" && $dataX6){
                                $dataXtemp=$dataX6;
                                $dataYtemp=$dataY6;
                                $num_dataX6=count($dataX6);
                                $num_dataXtemp=$num_dataX6;
                                $num_dataY6=count($dataY6);
                                $num_dataYtemp=$num_dataY6;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe6==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre sixième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe6;
                                }
                        }
                        if($i=="7" && $dataX7){
                                $dataXtemp=$dataX7;
                                $dataYtemp=$dataY7;
                                $num_dataX7=count($dataX7);
                                $num_dataXtemp=$num_dataX7;
                                $num_dataY7=count($dataY7);
                                $num_dataYtemp=$num_dataY7;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe7==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre septième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe7;
                                }
                        }
                        if($i=="8" && $dataX8){
                                $dataXtemp=$dataX8;
                                $dataYtemp=$dataY8;
                                $num_dataX8=count($dataX8);
                                $num_dataXtemp=$num_dataX8;
                                $num_dataY8=count($dataY8);
                                $num_dataYtemp=$num_dataY8;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe8==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre huitième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe8;
                                }
                        }
                        if($i=="9" && $dataX9){
                                $dataXtemp=$dataX9;
                                $dataYtemp=$dataY9;
                                $num_dataX9=count($dataX9);
                                $num_dataXtemp=$num_dataX9;
                                $num_dataY9=count($dataY9);
                                $num_dataYtemp=$num_dataY9;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe9==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre neuvième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe9;
                                }
                        }
                        if($i=="10" && $dataX10){
                                $dataXtemp=$dataX10;
                                $dataYtemp=$dataY10;
                                $num_dataX10=count($dataX10);
                                $num_dataXtemp=$num_dataX10;
                                $num_dataY10=count($dataY10);
                                $num_dataYtemp=$num_dataY10;
                                //test l'existence d'un label pour la courbe
                                if($label_courbe10==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre dixième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe10;
                                }
                        }

                        //analyse des données : détermination de la valeur max du tableau de coordonnées d'abscisses
                        $valX1=0;//$valX1 et $valX2: variables d'environnement en référence au tableau de valeurs (0: 1ère valeur du tableau, 1: 2ème valeur ,...)
                        $valX2=1;
                        $max_Xtemp=0;
                        if($dataXtemp[$valX2]>$dataXtemp[$valX1]){
                                $max_Xtemp=$dataXtemp[$valX2];
                        }
                        else{
                                $max_Xtemp=$dataXtemp[$valX1];
                        }
                        for($valX3=2;$valX3<$num_dataXtemp;$valX3++){
                                if($dataXtemp[$valX3]>$max_Xtemp){
                                        $max_Xtemp=$dataXtemp[$valX3];
                                }
                        }

                        //détermination de la valeur max du tableau de coordonnées d'ordonnées
                        $valY1=0;//$valY1 et $valY2: variables d'environnement en référence au tableau de valeurs (0: 1ère valeur du tableau, 1: 2ème valeur ,...)
                        $valY2=1;
                        $max_Ytemp=0;
                        if($dataYtemp[$valY2]>$dataYtemp[$valY1]){
                                $max_Ytemp=$dataYtemp[$valY2];
                        }
                        else{
                                $max_Ytemp=$dataYtemp[$valY1];
                        }
                        for($valY3=2;$valY3<$num_dataYtemp;$valY3++){
                                if($dataYtemp[$valY3]>$max_Ytemp){
                                        $max_Ytemp=$dataYtemp[$valY3];
                                }
                        }

                        //Détermination des valeurs maximums d'abscisse et d'ordonné
                        if($i=="1"){
                                $max_X=$max_Xtemp;//valeur maxi d'abscisse du premier tableau (dataX1)
                                $max_Y=$max_Ytemp;//valeur maxi d'ordonné du premier tableau (dataY1)
                        }
                        else{
                                if($max_X<$max_Xtemp){
                                        $max_X=$max_Xtemp;
                                }
                                if($max_Y<$max_Ytemp){
                                        $max_Y=$max_Ytemp;
                                }
                        }
                }

/***********************************************************************************************************************/

                //AFFECTATION DE LA TAILLE DES ELEMENTS QUI COMPOSENT L'IMAGE
                //affectation des valeurs en fonction du type de format choisi
                if($format=="1"){
                        $X_image=500;//longueur de l'image
                        $Y_image=300+100;//hauteur de l'image + 100 pour laisser de l'espace pour le titre, et les différentes légendes
                }
                if($format=="2"){
                        $X_image=600;
                        $Y_image=400+100;
                }
                if($format=="3"){
                        $X_image=700;
                        $Y_image=500+100;
                }
                if($format=="4"){
                        $X_image=800;
                        $Y_image=600+100;
                }

/***********************************************************************************************************************/

                //CREATION DE L'IMAGE
                $courbe=imagecreate($X_image,$Y_image);

                //ALLOCATION DES COULEURS
                $bg_color1=imagecolorallocate($courbe,0xFF,0xFF,0xFF);//blanc
                $bg_color2=imagecolorallocate($courbe,204,204,204);//gris
                $text_color=imagecolorallocate($courbe,0x00,0x00,0x00);
                $axes_color=imagecolorallocate($courbe,0x00,0x00,0x00);
                $pixels_color=imagecolorallocate($courbe,0xCC,0x00,0x00);

                $couleur[0]=imagecolorallocate($courbe,0,204,204);//couleur Gris/vert
                $couleur[1]=imagecolorallocate($courbe,255,0,0);//couleur Rouge
                $couleur[2]=imagecolorallocate($courbe,0xFF,0xCC,0);//couleur Jaune
                $couleur[3]=imagecolorallocate($courbe,0,0,255);//couleur Bleu
                $couleur[4]=imagecolorallocate($courbe,51,255,153);//couleur Vert
                $couleur[5]=imagecolorallocate($courbe,255,102,51);//couleur Orange
                $couleur[6]=imagecolorallocate($courbe,204,0,204);//couleur Violet
                $couleur[7]=imagecolorallocate($courbe,102,255,255);//couleur Turquoise
                $couleur[8]=imagecolorallocate($courbe,204,0,102);//couleur Bordeaux
                $couleur[9]=imagecolorallocate($courbe,255,0,102);//couleur Rose

                //COLORIAGE DU FOND DE L'IMAGE
                if($back_color=="1"){
                        imagefill($courbe,0,0,$bg_color1);
                        $grille_color=imagecolorallocate($courbe,204,204,204);
                }
                if($back_color=="2"){
                        imagefill($courbe,0,0,$bg_color2);
                        $grille_color=imagecolorallocate($courbe,255,255,255);
                }
/***********************************************************************************************************************/

                //ELABORATION DU GRAPHIQUE ET DE SES ELEMENTS
                $text_font=2;//Définition d'une taille de police
                //emplacement utilisé par l'échelle (echelle_width)= largeur d'1 caractere * nombre maximum de chiffres de la légende + 1 espace pour ne pas toucher l'axe des ordonnées
                //emplacement utilisé par l'echelle ($echelle_height) = hauteur d'1 caractere + 1 espace pour ne pas toucher l'axe des ordonnées
                $echelle_width=imagefontwidth($text_font)*4+3;
                $echelle_height=imagefontwidth($text_font)*4+3;

                //AXE VERTICAL
                //traçage de l'axe vertical
                imageline($courbe,$echelle_width,100,$echelle_width,$Y_image-$echelle_height,$axes_color);
                //TRACAGE DES LIGNES HORIZONTALES ET AFFICHAGE DE L'ECHELLE
                $k=0;//variable qui s'incrémente à chaque nouvelle position de $i
                //pointillés horizontaux
                for($i=100;$i<$Y_image;$i+=$Y_image/($Y_image/50)){
                        imagedashedline($courbe,$echelle_width-5,$i,$X_image-1,$i,$grille_color);
                        $ligne[$k]=$i;
                        $k++;
                }
                //échelle
                $pas_echelle=$max_Y/$k;
                for($l=0;$l<$k;$l++){
                        if($l=="0"){
                                $Y=$max_Y;
                        }
                        else{
                                if($max_Y>9){
                                        $Y=floor($Y-$pas_echelle);
                                }
                                else{
                                        $Y=$Y-$pas_echelle;
                                }
                        }
                        imagestring($courbe,$text_font,0,$ligne[$l],$Y,$text_color);
                        $val_echelle_Y=$Y;//enregistrement de la dernière valeur d'echelle
                }

                //AXE HORIZONTAL
                //emplacement utilisé par l'échelle ($echelle_width)= largeur d'un caractère * nbre maximum de ceux-ci
                //traçage de l'axe horizontal
                imageline($courbe,$echelle_width,$Y_image-$echelle_height,$X_image-1,$Y_image-$echelle_height,$axes_color);
                //TRACAGE DES LIGNES VERTICALES ET AFFICHAGE DE L'ECHELLE
                //pointillés verticaux
                for($i=$X_image-1;$i>$echelle_width;$i-=$X_image/($X_image/50)){
                        imagedashedline($courbe,$i,$Y_image-echelle_height-15,$i,100,$grille_color);
                        //échelle
                        if($max_X>9){
                                $X=floor((($X_image-$i)/$X_image-1)*$max_X);
                        }
                        else{
                                $X=((($X_image-$i)/$X_image-1)*$max_X);
                        }
                        imagestring($courbe,$text_font,$i-$echelle_width,$Y_image-$echelle_height+3,-$X,$text_color);
                }

/***********************************************************************************************************************/

                //INSERTION DES PIXELS REPRESENTATIFS DES POINTS A RELIER POUR L'OBTENTION DE LA COURBE - AFFICHAGE DES POINTS ET DES COURES
                $pasX=$X_image/$max_X;
                $pasY=($Y_image-100-$echelle_height)/$max_Y;

                for($i=1;$i<10;$i++){
                        if($i=="1" && $dataX1){
                                $dataXtemp=$dataX1;
                                $dataYtemp=$dataY1;
                                $num_dataX1=count($dataX1);
                                $num_dataXtemp=$num_dataX1;
                                $label_courbetemp=$label_courbe1;
                                $x_pos1=0;//variables définissant les 4 points pour le traçage du libellé de la courbe
                                $y_pos1=55;
                                $x_pos2=10;
                                $y_pos2=65;
                                $coul=0;//variable associé aux différentes couleurs si plusieurs courbes à tracer
                        }
                        if($i=="2" && $dataX2){
                                $dataXtemp=$dataX2;
                                $dataYtemp=$dataY2;
                                $num_dataX2=count($dataX2);
                                $num_dataXtemp=$num_dataX2;
                                $label_courbetemp=$label_courbe2;
                                $x_pos1=0;
                                $y_pos1=70;
                                $x_pos2=10;
                                $y_pos2=80;
                                $coul=1;
                        }
                        if($i=="3" && $dataX3){
                                $dataXtemp=$dataX3;
                                $dataYtemp=$dataY3;
                                $num_dataX3=count($dataX3);
                                $num_dataXtemp=$num_dataX3;
                                $label_courbetemp=$label_courbe3;
                                $x_pos1=0;
                                $y_pos1=85;
                                $x_pos2=10;
                                $y_pos2=95;
                                $coul=2;
                        }
                        if($i=="4" && $dataX4){
                                $dataXtemp=$dataX4;
                                $dataYtemp=$dataY4;
                                $num_dataX4=count($dataX4);
                                $num_dataXtemp=$num_dataX4;
                                $label_courbetemp=$label_courbe4;
                                $x_pos1=125;
                                $y_pos1=55;
                                $x_pos2=135;
                                $y_pos2=65;
                                $coul=3;
                        }
                        if($i=="5" && $dataX5){
                                $dataXtemp=$dataX5;
                                $dataYtemp=$dataY5;
                                $num_dataX5=count($dataX5);
                                $num_dataXtemp=$num_dataX5;
                                $label_courbetemp=$label_courbe5;
                                $x_pos1=125;
                                $y_pos1=70;
                                $x_pos2=135;
                                $y_pos2=80;
                                $coul=4;
                        }
                        if($i=="6" && $dataX6){
                                $dataXtemp=$dataX6;
                                $dataYtemp=$dataY6;
                                $num_dataX6=count($dataX6);
                                $num_dataXtemp=$num_dataX6;
                                $label_courbetemp=$label_courbe6;
                                $x_pos1=125;
                                $y_pos1=85;
                                $x_pos2=135;
                                $y_pos2=95;
                                $coul=5;
                        }
                        if($i=="7" && $dataX7){
                                $dataXtemp=$dataX7;
                                $dataYtemp=$dataY7;
                                $num_dataX7=count($dataX7);
                                $num_dataXtemp=$num_dataX7;
                                $label_courbetemp=$label_courbe7;
                                $x_pos1=250;
                                $y_pos1=55;
                                $x_pos2=260;
                                $y_pos2=65;
                                $coul=6;
                        }
                        if($i=="8" && $dataX8){
                                $dataXtemp=$dataX8;
                                $dataYtemp=$dataY8;
                                $num_dataX8=count($dataX8);
                                $num_dataXtemp=$num_dataX8;
                                $label_courbetemp=$label_courbe8;
                                $x_pos1=250;
                                $y_pos1=70;
                                $x_pos2=260;
                                $y_pos2=80;
                                $coul=7;
                        }
                        if($i=="9" && $dataX9){
                                $dataXtemp=$dataX9;
                                $dataYtemp=$dataY9;
                                $num_dataX9=count($dataX9);
                                $num_dataXtemp=$num_dataX9;
                                $label_courbetemp=$label_courbe9;
                                $x_pos1=250;
                                $y_pos1=85;
                                $x_pos2=260;
                                $y_pos2=95;
                                $coul=8;
                        }
                        if($i=="10" && $dataX10){
                                $dataXtemp=$dataX10;
                                $dataYtemp=$dataY10;
                                $num_dataX10=count($dataX10);
                                $num_dataXtemp=$num_dataX10;
                                $label_courbetemp=$label_courbe10;
                                $x_pos1=375;
                                $y_pos1=55;
                                $x_pos2=385;
                                $y_pos2=65;
                                $coul=9;
                        }

                        //calcul des points à tracer
                        if($dataXtemp!=0 && $dataYtemp!=0){
                                $k=1;//référence aux secondes valeurs contenues dans le tableau des coordonnées en abscisse et en ordonné
                                for($j=0;$k<$num_dataXtemp;$j++){
                                        $x1=($dataXtemp[$j]*$pasX);
                                        $x2=($dataXtemp[$k]*$pasX);
                                        if($j=="0"){
                                                $x1=$echelle_width+($dataXtemp[$j]*$pasX);
                                        }
                                        if($k=="1" && $dataXtemp[$k]<$echelle_width){
                                                $x2=$echelle_width+($dataXtemp[$k]*$pasX);
                                        }
                                        if($j=="1" && $dataXtemp[$j]<$echelle_width){
                                                $x1=$echelle_width+($dataXtemp[$j]*$pasX);
                                        }
                                        $y1=($Y_image-($echelle_height/2)-2-($dataYtemp[$j]*$pasY))+3;
                                        $y2=($Y_image-($echelle_height/2)-2-($dataYtemp[$k]*$pasY))+3;
                                        if($dataYtemp[$j]=="0"){
                                                $y1=($Y_image-$echelle_height);
                                        }
                                        if($dataYtemp[$k]=="0"){
                                                $y2=($Y_image-$echelle_height);
                                        }
                                        if($dataYtemp[$j]=="$max_Y"){
                                                $y1=100;
                                        }
                                        if($dataYtemp[$k]=="$max_Y"){
                                                $y2=100;
                                        }
                                        if($dataYtemp[$j]<$echelle_height){
                                                $y1=($Y_image-$echelle_height-($dataYtemp[$j]*$pasY));
                                        }
                                        if($dataYtemp[$k]<$echelle_height){
                                                $y2=($Y_image-$echelle_height-($dataYtemp[$k]*$pasY));
                                        }
                                        if($dataYtemp[$j]<$val_echelle_Y){
                                                $y1=($Y_image-$echelle_height-($dataYtemp[$j]*$pasY));
                                        }
                                        if($dataYtemp[$k]<$val_echelle_Y){
                                                $y2=($Y_image-$echelle_height-($dataYtemp[$k]*$pasY));
                                        }
                                        if ($j!=0) {imageline($courbe,$x1,$y1,$x2,$y2,$couleur[$coul]);}
                                        imagesetpixel($courbe,$x1,$y1,$pixels_color);
                                        imagesetpixel($courbe,$x2,$y2,$pixels_color);
                                        $k++;
                                }
                                $dataXtemp=0;
                                $dataYtemp=0;
                                //affichage du code couleur et du libellé de la courbe
                                imagefilledrectangle($courbe,$x_pos1,$y_pos1,$x_pos2,$y_pos2,$couleur[$coul]);
                                imagestring($courbe,2,$x_pos2+5,$y_pos1,$label_courbetemp,$text_color);
                        }
                }

/***********************************************************************************************************************/

                //INSERTION DES ELEMENTS EXTERNES AU GRAPHIQUE (titre, libellé, légende)
                //insertion du titre
                if($format=="1"){
                        imagestring($courbe,2,0,5,$titre,$text_color);
                }
                if($format=="2" || $format=="3"){
                        imagestring($courbe,3,0,5,$titre,$text_color);
                }
                if($format=="4"){
                        imagestring($courbe,5,0,5,$titre,$text_color);
                }

                //insertion des champs indiquant les libellés des deux axes
                $label_Y="Axe des ordonnés : " . $label_ordonne;
                $label_X="Axe des abscisses : " . $label_abscisse;
                imagestring($courbe,2,0,25,$label_Y,$text_color);
                imagestring($courbe,2,0,35,$label_X,$text_color);

/***********************************************************************************************************************/

                //ENVOI DE L'IMAGE AU NAVIGATEUR ET AFFICHAGE
                $hour = gettimeofday();
                $sec = $hour['sec'];
                $usec = $hour['usec'];
                $nomunique = $sec.$usec.".png";

                imagepng($courbe,"".$nomunique);
                print("<img src=\"".$nomunique."\">");

                //DESTRUCTION DE L'ESPACE OCCUPE PAR L'IMAGE
                imagedestroy($courbe);
        }//fin fonction
}//fin classe

?>

</body>
</html>



---------------------------------------------------------------------------------------------------- cut here -----------------------------

<! GraPHP-IC is a PHP project that allow you to create "png" images which represent statistic charts
   Copyright (C) 2000 Thomas Begrand.

 Project name : GraPHP-IC (Intranet Charts)
 Author :Thomas Begrand
 Author Email : t.begrand@caramail.com
 Sources available on : www.sourceforge.net (project name : GraPHP-IC)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 CERMEX, hereby disclaims all copyright interest in the project
 "GraPHP-IC"(which creates statidtic charts) written by Thomas Begrand.
 Eric Poisse, 29 September 2000
 Eric Poisse, Responsible of the Data processing department.
 Email : eric.poisse@cermex.fr !>


<html>
<head>
<title>RESULTATS STATISTIQUES : COURBES</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<?php

//Définition d'une classe "CourbeAlphanum" contenant les paramètres servant à tracer le graph et la fonction de traçage du graph
class CourbeAlphanum{

        //insertion du mot clé "var" obligatoire pour initialiser la variable lors d'une définition de classe
        var $titre;
        var $back_color;
        var $format;
        var $label_axe;
        var $label;

        var $data1;
        var $label_courbe1;

        var $data2;
        var $label_courbe2;

        var $data3;
        var $label_courbe3;

        var $data4;
        var $label_courbe4;

        var $data5;
        var $label_courbe5;

        var $data6;
        var $label_courbe6;

        var $data7;
        var $label_courbe7;

        var $data8;
        var $label_courbe8;

        var $data9;
        var $label_courbe9;

        var $data10;
        var $label_courbe10;

/***********************************************************************************************************************/

        function Charge_courbeAlphanum($data,$label_courbe){
                //déclaration des variables en "global", ceci permet le passage des paramètres d'une fonction à l'autre
                global $data1;
                global $label_courbe1;

                global $data2;
                global $label_courbe2;

                global $data3;
                global $label_courbe3;

                global $data4;
                global $label_courbe4;

                global $data5;
                global $label_courbe5;

                global $data6;
                global $label_courbe6;

                global $data7;
                global $label7;
                global $label_courbe7;

                global $data8;
                global $label_courbe8;

                global $data9;
                global $label_courbe9;

                global $data10;
                global $label_courbe10;

                if(!$data1){
                        $data1 = $data;
                         $label_courbe1 = $label_courbe;
                }
                elseif(!$data2){
                        $data2 = $data;
                         $label_courbe2 = $label_courbe;
                }
                elseif(!$data3){
                        $data3 = $data;
                         $label_courbe3 = $label_courbe;
                }
                elseif(!$data4){
                        $data4 = $data;
                         $label_courbe4 = $label_courbe;
                }
                elseif(!$data5){
                        $data5 = $data;
                         $label_courbe5 = $label_courbe;
                }
                elseif(!$data6){
                        $data6 = $data;
                         $label_courbe6 = $label_courbe;
                }
                elseif(!$data7){
                        $data7 = $data;
                         $label_courbe7 = $label_courbe;
                }
                elseif(!$data8){
                        $data8 = $data;
                         $label_courbe8 = $label_courbe;
                }
                elseif(!$data9){
                        $data9 = $data;
                         $label_courbe9 = $label_courbe;
                }
                elseif(!$data10){
                        $data10 = $data;
                         $label_courbe10 = $label_courbe;
                }

        }//fin fonction de chargement des données

        function Trace_courbeAlphanum($titre,$back_color,$format,$label_axe,$label){
                global $data1;
                global $label1;
                global $label_courbe1;

                global $data2;
                global $label2;
                global $label_courbe2;

                global $data3;
                global $label3;
                global $label_courbe3;

                global $data4;
                global $label4;
                global $label_courbe4;

                global $data5;
                global $label5;
                global $label_courbe5;

                global $data6;
                global $label6;
                global $label_courbe6;

                global $data7;
                global $label7;
                global $label_courbe7;

                global $data8;
                global $label8;
                global $label_courbe8;

                global $data9;
                global $label9;
                global $label_courbe9;

                global $data10;
                global $label10;
                global $label_courbe10;

                //DONNEES (tests,affectations, analyses)
                //tests données : vérification de l'existence des paramètres reçus
                //test permettant de vérifier qu'un format a été déterminer.
                if(!$format){
                        echo("<b>ATTENTION !</b> : Vous n'avez pas choisi de format pour votre graphique. Un format a été adopté par défaut."."<br>");
                        $format="2";
                }
                //test l'existence d'un titre
                if(!$titre){
                        echo("<b>ATTENTION !</b> : Vous n'avez pas saisi de titre pour votre graphique."."<br>");
                }
                //test l'existence d'un libellé d'axe
                if($label_axe==""){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de libellé en référence à l'axe des ordonnés."."<br>");
                }
                //test l'existence d'étiquettes en référence aux valeurs
                $num_label=count($label);
                //test permettant de vérifier si des libellés associés aux valeurs ont été saisis
                if($num_label==0){
                        echo("<b>ATTENTION !</b>: Vous n'avez saisi aucun libellé en référence à vos valeurs."."<br>");
                }

                //test le choix de la couleur de fond d'image
                if($back_color>2){
                        echo("<b>ATTENTION !</b>: Seulement deux couleurs de fond d'image sont possible."."<br>");
                }

                //affectation des données
                for($i=1;$i<10;$i++){
                        if($i=="1" && $data1){
                                $datatemp=$data1;
                                $num_data1=count($data1);
                                $num_datatemp=$num_data1;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe1==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre première courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe1;
                                }
                        }
                        if($i=="2" && $data2){
                                $datatemp=$data2;
                                $num_data2=count($data2);
                                $num_datatemp=$num_data2;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe2==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre seconde courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe2;
                                }
                        }
                        if($i=="3" && $data3){
                                $datatemp=$data3;
                                $num_data3=count($data3);
                                $num_datatemp=$num_data3;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe3==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre troisième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe3;
                                }
                        }
                        if($i=="4" && $data4){
                                $datatemp=$data4;
                                $num_data4=count($data4);
                                $num_datatemp=$num_data4;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe4==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre quatrième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe4;
                                }
                        }
                        if($i=="5" && $data5){
                                $datatemp=$data5;
                                $num_data5=count($data5);
                                $num_datatemp=$num_data5;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe5==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre cinquième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe5;
                                }
                        }
                        if($i=="6" && $data6){
                                $datatemp=$data6;
                                $num_data6=count($data6);
                                $num_datatemp=$num_data6;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe6==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre sixième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe6;
                                }
                        }
                        if($i=="7" && $data7){
                                $datatemp=$data7;
                                $num_data7=count($data7);
                                $num_datatemp=$num_data7;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe7==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre septième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe7;
                                }
                        }
                        if($i=="8" && $data8){
                                $datatemp=$data8;
                                $num_data8=count($data8);
                                $num_datatemp=$num_data8;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe8==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre huitième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe8;
                                }
                        }
                        if($i=="9" && $data9){
                                $datatemp=$data9;
                                $num_data9=count($data9);
                                $num_datatemp=$num_data9;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe9==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre neuvième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe9;
                                }
                        }
                        if($i=="10" && $data10){
                                $datatemp=$data10;
                                $num_data10=count($data10);
                                $num_datatemp=$num_data10;
                                //test de l'existence d'un label pour la courbe
                                if($label_courbe10==""){
                                        echo("<b>ATTENTION !</b>: Vous n'avez pas défini ce que représente votre dixième courbe."."<br>");
                                }
                                else{
                                        $label_courbetemp=$label_courbe10;
                                }
                        }

                        //détermination de la valeur max du tableau de valeurs pour ajustement automatique de l'échelle
                        $val1=0;//$val1 et $val2: variables d'environnement en référence au tableau de valeurs (0: 1ère valeur du tableau, 1: 2ème valeur ,...)
                        $val2=1;
                        $maxtemp=0;
                        if($datatemp[$val2]>$datatemp[$val1]){
                                $maxtemp=$datatemp[$val2];
                        }
                        else{
                                $maxtemp=$datatemp[$val1];
                        }
                        for($val3=2;$val3<$num_datatemp;$val3++){
                                if($datatemp[$val3]>$maxtemp){
                                        $maxtemp=$datatemp[$val3];
                                }
                        }

                        //Détermination de la valeur maxi d'ordonné
                        if($i=="1"){
                                $max=$maxtemp;//valeur maxi du premier tableau
                        }
                        else{
                                if($max<$maxtemp){
                                        $max=$maxtemp;
                                }
                        }
                }

/***********************************************************************************************************************/

                //AFFECTATION DE LA TAILLE DES ELEMENTS QUI COMPOSENT L'IMAGE
                //affectation des valeurs aux variables en fonction des paramètres
                if($format=="1"){
                        $X_image=500;//longueur de l'image
                        $Y_image=300+100+200;//hauteur de l'image + 100: hauteur nécessaire à l'insertion du titre et des infos annexes + 200: hauteur necessaire à l'insertion des libellés
                }
                if($format=="2"){
                        $X_image=600;
                        $Y_image=400+100+200;
                }
                if($format=="3"){
                        $X_image=700;
                        $Y_image=500+100+200;
                }
                if($format=="4"){
                        $X_image=800;
                        $Y_image=600+100+200;
                }

/***********************************************************************************************************************/

                //CREATION DE L'IMAGE
                $courbe2=imagecreate($X_image,$Y_image);

                //ALLOCATION DES COULEURS
                $bg_color1=imagecolorallocate($courbe2,0xFF,0xFF,0xFF);//blanc
                $bg_color2=imagecolorallocate($courbe2,204,204,204);//gris
                $text_color=imagecolorallocate($courbe2,0x00,0x00,0x00);//noir
                $axes_color=imagecolorallocate($courbe2,0x00,0x00,0x00);//noir

                $couleur[0]=imagecolorallocate($courbe2,0,204,204);//couleur Gris/vert
                $couleur[1]=imagecolorallocate($courbe2,255,0,0);//couleur Rouge
                $couleur[2]=imagecolorallocate($courbe2,0xFF,0xCC,0);//couleur Jaune
                $couleur[3]=imagecolorallocate($courbe2,0,0,255);//couleur Bleu
                $couleur[4]=imagecolorallocate($courbe2,51,255,153);//couleur Vert
                $couleur[5]=imagecolorallocate($courbe2,255,102,51);//couleur Orange
                $couleur[6]=imagecolorallocate($courbe2,204,0,204);//couleur Violet
                $couleur[7]=imagecolorallocate($courbe2,102,255,255);//couleur Turquoise
                $couleur[8]=imagecolorallocate($courbe2,204,0,102);//couleur Bordeaux
                $couleur[9]=imagecolorallocate($courbe2,255,0,102);//couleur Rose

                //COLORIAGE DU FOND DE L'IMAGE
                if($back_color=="1"){
                        imagefill($courbe2,0,0,$bg_color1);//blanc
                        $grille_color=imagecolorallocate($courbe2,204,204,204);//gris
                }
                if($back_color=="2"){
                        imagefill($courbe2,0,0,$bg_color2);//blanc
                        $grille_color=imagecolorallocate($courbe2,255,255,255);//blanc
                }
/***********************************************************************************************************************/

                //ELABORATION DU GRAPHIQUE ET DE SES ELEMENTS SUIVANT LE CHOIX FAIT POUR LE POSITONNEMENT DU GRAPH
                $text_font=2;
                $text_font2=3;
                $text_font3=1;

                //AXE VERTICAL
                //emplacement utilisé par l'échelle = largeur d'1 caractere * nombre maximum de chiffres de la légende + 1 espace pour ne pas toucher l'axe des ordonnées
                $echelle_width=imagefontwidth($text_font)*6+3;
                //traçage de l'axe vertical
                imageline($courbe2,$echelle_width,100,$echelle_width,$Y_image-1-200,$axes_color);

                //AXE HORIZONTAL
                imageline($courbe2,$echelle_width,$Y_image-1-200,$X_image-1,$Y_image-1-200,$axes_color);

                //TRACAGE DES LIGNES HORIZONTALES ET AFFICHAGE DE L'ECHELLE
                //pointillés horizontaux
                $j=0;//variable associée aux nombres de lignes horizontales tracées
                for($i=100;$i<$Y_image-200;$i+=$Y_image/($Y_image/50)){
                        imagedashedline($courbe2,$echelle_width-5,$i,$X_image-1,$i,$grille_color);
                        $ligne[$j]=$i;
                        $j++;
                }
                //échelle
                $pas_echelle=$max/$j;
                for($k=0;$k<$j;$k++){
                        if($k=="0"){
                                $Y=$max;
                        }
                        else{
                                if($max>9){
                                        $Y=floor($Y-$pas_echelle);
                                }
                                else{
                                        $Y=$Y-$pas_echelle;
                                }
                        }
                        imagestring($courbe2,$text_font,0,$ligne[$k],$Y,$text_color);
                }

/***********************************************************************************************************************/

                //CALCUL DE LA LARGEUR DE CHAQUE RECTANGLE
                $pas=($Y_image-100-200)/$max;//variable servant de référence pour le traçage des rectangles
                $rect_width=($X_image-$echelle_width+1)/$num_label;//calcul de la largeur d'un rectangle

                for($i=1;$i<10;$i++){
                        if($i=="1" && $data1){
                                $datatemp=$data1;
                                $num_data1=count($data1);
                                $num_datatemp=$num_data1;
                                $label_courbetemp=$label_courbe1;
                                $x=$echelle_width;//x et y représentent les coordonnées d'origine pour chaque courbe
                                $y=$Y_image-1-200;
                                $x_pos1=0;//variables définissant les 4 points pour le trçage du libellé de la courbe
                                $y_pos1=55;
                                $x_pos2=10;
                                $y_pos2=65;
                                $coul=0;//variable associée à la couleur de la courbe
                        }
                        if($i=="2" && $data2){
                                $datatemp=$data2;
                                $num_data2=count($data2);
                                $num_datatemp=$num_data2;
                                $label_courbetemp=$label_courbe2;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=0;
                                $y_pos1=70;
                                $x_pos2=10;
                                $y_pos2=80;
                                $coul=1;
                        }
                        if($i=="3" && $data3){
                                $datatemp=$data3;
                                $num_data3=count($data3);
                                $num_datatemp=$num_data3;
                                $label_courbetemp=$label_courbe3;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=0;
                                $y_pos1=85;
                                $x_pos2=10;
                                $y_pos2=95;
                                $coul=2;
                        }
                        if($i=="4" && $data4){
                                $datatemp=$data4;
                                $num_data4=count($data4);
                                $num_datatemp=$num_data4;
                                $label_courbetemp=$label_courbe4;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=125;
                                $y_pos1=55;
                                $x_pos2=135;
                                $y_pos2=65;
                                $coul=3;
                        }
                        if($i=="5" && $data5){
                                $datatemp=$data5;
                                $num_data5=count($data5);
                                $num_datatemp=$num_data5;
                                $label_courbetemp=$label_courbe5;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=125;
                                $y_pos1=70;
                                $x_pos2=135;
                                $y_pos2=80;
                                $coul=4;
                        }
                        if($i=="6" && $data6){
                                $datatemp=$data6;
                                $num_data6=count($data6);
                                $num_datatemp=$num_data6;
                                $label_courbetemp=$label_courbe6;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=125;
                                $y_pos1=85;
                                $x_pos2=135;
                                $y_pos2=95;
                                $coul=5;
                        }
                        if($i=="7" && $data7){
                                $datatemp=$data7;
                                $num_data7=count($data7);
                                $num_datatemp=$num_data7;
                                $label_courbetemp=$label_courbe7;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=250;
                                $y_pos1=55;
                                $x_pos2=260;
                                $y_pos2=65;
                                $coul=6;
                        }
                        if($i=="8" && $data8){
                                $datatemp=$data8;
                                $num_data8=count($data8);
                                $num_datatemp=$num_data8;
                                $label_courbetemp=$label_courbe8;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=250;
                                $y_pos1=70;
                                $x_pos2=260;
                                $y_pos2=80;
                                $coul=7;
                        }
                        if($i=="9" && $data9){
                                $datatemp=$data9;
                                $num_data9=count($data9);
                                $num_datatemp=$num_data9;
                                $label_courbetemp=$label_courbe9;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=250;
                                $y_pos1=85;
                                $x_pos2=260;
                                $y_pos2=95;
                                $coul=8;
                        }
                        if($i=="10" && $data10){
                                $datatemp=$data10;
                                $num_data10=count($data10);
                                $num_datatemp=$num_data10;
                                $label_courbetemp=$label_courbe10;
                                $x=$echelle_width;
                                $y=$Y_image-1-200;
                                $x_pos1=375;
                                $y_pos1=55;
                                $x_pos2=385;
                                $y_pos2=65;
                                $coul=9;
                        }

                        //calcul et traçage des points
                        if($datatemp!=0){
                                for($j=0;$j<$num_datatemp;$j++){

                                        //obtention des coordonnées des points supérieur gauche et inférieur droit (pour situé le milieu et tracer le libellé correspondant au point)
                                        //largeur de l'échelle + axe vertical + largeur d'1 rectangle * nbre de rectangle déjà tracés
                                        $rect_haut_g_X=$echelle_width+1+($j*$rect_width);
                                        //hauteur de l'image - valeur des données * echelle
                                        $rect_haut_g_Y=$Y_image-200-2-$datatemp[$j]*$pas;
                                        //abscisse du point supérieur gauche + largeur d'1 rectangle
                                        $rect_bas_d_X=$rect_haut_g_X+$rect_width;
                                        //hauteur de l'image - axe horizontal
                                        $rect_bas_d_Y=$Y_image-1-200 - 1;

                                        //insertion du pixel representatif du point correspondant
                                        imagesetpixel($courbe2,$rect_haut_g_X+(($rect_bas_d_X-$rect_haut_g_X)/2),$rect_haut_g_Y,$couleur[$coul]);
                                        //trace de la courbe reliant les pixels de chaque barre
                                        $x1=$rect_haut_g_X+(($rect_bas_d_X-$rect_haut_g_X)/2);
                                        $y1=$rect_haut_g_Y;
                                        if ($j!=0) {imageline($courbe2,$x,$y,$x1,$y1,$couleur[$coul]);}
                                        $x=$x1;
                                        $y=$y1;

                                        //insertion du code couleur et du libellé de la courbe
                                        imagefilledrectangle($courbe2,$x_pos1,$y_pos1,$x_pos2,$y_pos2,$couleur[$coul]);
                                        imagestring($courbe2,2,$x_pos2+5,$y_pos1,$label_courbetemp,$text_color);

                                        if($i=="1"){
                                                //insertion des pointillés verticaux (rendre la lecture du graphique + claire)
                                                imagedashedline($courbe2,$x,$Y_image-1-200,$x,100,$grille_color);

                                                //affichage des étiquettes correspondantes aux valeurs précédement tracées
                                                $long_string=strlen($label[$j]);
                                                if($long_string<="14"){
                                                        imagestringup($courbe2,$text_font2,$x,$Y_image-100,$label[$j],$text_color);
                                                }
                                                if($long_string>"14" && $long_string<="21"){
                                                        imagestringup($courbe2,$text_font2,$x,$Y_image-50,$label[$j],$text_color);
                                                }
                                                if($long_string>"21"){
                                                        imagestringup($courbe2,$text_font2,$x,$Y_image-1,$label[$j],$text_color);
                                                }
                                        }
                                }
                                //Réinitialisation de la variable pour éviter de boucler 10 fois si nbre de courbe < 10
                                $datatemp=0;
                        }
                }

/***********************************************************************************************************************/

                //insertion du titre
                if($format=="1"){
                        imagestring($courbe2,2,0,5,$titre,$text_color);
                }
                if($format=="2" || $format=="3"){
                        imagestring($courbe2,3,0,5,$titre,$text_color);
                }
                if($format=="4"){
                        imagestring($courbe2,5,0,5,$titre,$text_color);
                }

                //insertion des champs indiquant le libellé de l'axe
                $label_Y="Axe des ordonnés : " . $label_axe;
                imagestring($courbe2,2,0,25,$label_Y,$text_color);

/***********************************************************************************************************************/

                //ENVOI DE L'IMAGE AU NAVIGATEUR ET AFFICHAGE
                $hour = gettimeofday();
                $sec = $hour['sec'];
                $usec = $hour['usec'];
                $nomunique = $sec.$usec.".png";

                imagepng($courbe2,"../../imagesTemp/".$nomunique);
                print("<img src=\"../../imagesTemp/".$nomunique."\">");

                //DESTRUCTION DE L'ESPACE OCCUPE PAR L'IMAGE
                imagedestroy($courbe2);
        }//fin fonction
}//fin classe

?>

</body>
</html>


---------------------------------------------------------------------------------------------------- cut here -----------------------------


<! GraPHP-IC is a PHP project that allow you to create "png" images which represent statistic charts
   Copyright (C) 2000 Thomas Begrand.

 Project name : GraPHP-IC (Intranet Charts)
 Author :Thomas Begrand
 Author Email : t.begrand@caramail.com
 Sources available on : www.sourceforge.net (project name : GraPHP-IC)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 CERMEX, hereby disclaims all copyright interest in the project
 "GraPHP-IC"(which creates statidtic charts) written by Thomas Begrand.
 Eric Poisse, 29 September 2000
 Eric Poisse, Responsible of the Data processing department.
 Email : eric.poisse@cermex.fr !>

<html>
<head>
<title>RESULTATS STATISTIQUES : HISTOGRAMMES</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF">
<?php

//Définition d'une classe "Histogramme" contenant les paramètres servant à tracer le graph et la fonction de traçage du graph

class Histogramme{

        var $titre;
        var $back_color;
        var $format;
        var $position;
        var $bar_color;
        var $label_ordonne;
        var $label_abscisse;
        var $data;
        var $label;

/***********************************************************************************************************************/

        function Trace_histogramme($titre,$back_color,$format,$position,$bar_color,$label_ordonne,$label_abscisse,$data,$label){
                //DONNEES (analyse et tests)
                //test permettant de verifier si un titre et des libellés d'axe ont été saisis
                if(!$titre){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de titre pour votre graphique."."<br>");
                }
                if(!label_ordonne){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de libellé pour l'axe des ordonnés."."<br>");
                }
                if(!label_abscisse){
                        echo("<b>ATTENTION !</b>: Vous n'avez pas saisi de libellé pour l'axe des abscisses."."<br>");
                }

                //test permettant de verifier si des valeurs ont été saisies
                $num_data=count($data);
                if($num_data==0){
                        echo("<b>ATTENTION !</b>: Vous devez entrer des valeurs pour obtenir votre graphique."."<br>");
                }
                //détermination de la valeur max du tableau de valeurs pour ajustement automatique de l'échelle
                $val1=0;//$val1 et $val2: variables d'environnement en référence au tableau de valeurs (0: 1ère valeur du tableau, 1: 2ème valeur ,...)
                $val2=1;
                $max=0;
                if($data[$val2]>$data[$val1]){
                        $max=$data[$val2];
                }
                else{
                        $max=$data[$val1];
                }
                for($c=val3;$val3<$num_data;$val3++){
                        if($data[$val3]>$max){
                                $max=$data[$val3];
                        }
                }

                //tests permettant de vérifier si un format et une position ont été definis
                if(!$format && !$position){
                        echo("<b>ATTENTION !</b> : Vous n'avez pas choisi de format ni de position pour votre graphique. Des paramètres par défaut ont été adoptés."."<br>");
                        $format="3";
                        $position="1";
                }
                if(!$format){
                        echo("<b>ATTENTION !</b> : Vous n'avez pas choisi de format pour votre graphique. Un format a été adopté par défaut."."<br>");
                        $format="2";
                }
                if(!$position){
                        echo("<b>ATTENTION !</b> : Vous n'avez pas défini la position de votre graphique. Une position a été adopté par défaut ."."<br>");
                        $position="1";
                }

                //test permettant de vérifier si des libellés associés aux valeurs ont été saisis
                $num_label=count($label);
                if($num_label==0){
                        echo("<b>ATTENTION !</b>: Vous n'avez saisi aucun libellé en référence à vos valeurs."."<br>");
                }
                //test permettant de vérifier si autant de valeurs que de libellés ont été saisies
                if($num_label<$num_data){
                        echo("<b>ATTENTION !</b>: Vous avez saisi plus de valeurs que de libellés."."<br>");
                }
                if($num_label>$num_data){
                        echo("<b>ATTENTION !</b>: Vous avez saisi plus de libellés que de valeurs."."<br>");
                }

                if($back_color>2){
                        echo("<b>ATTENTION !</b>: Seulement deux couleurs de fond d'image sont possible."."<br>");
                }
/***********************************************************************************************************************/

                //AFFECTATION DE LA TAILLE DES ELEMENTS QUI COMPOSENT L'IMAGE
                //affectation des valeurs aux variables en fonction des paramètres
                if($format=="1" && $position=="1"){
                        $X_image=500;//longueur de l'image
                        $Y_image=300+100;//hauteur de l'image
                }

                if($format=="1" && $position=="2"){
                        $X_image=300;
                        $Y_image=500+100;
                }

                if($format=="2" && $position=="1"){
                        $X_image=600;
                        $Y_image=400+100;
                }

                if($format=="2" && $position=="2"){
                        $X_image=400;
                        $Y_image=600+100;
                }

                if($format=="3" && $position=="1"){
                        $X_image=700;
                        $Y_image=500+100;
                }

                if($format=="3" && $position=="2"){
                        $X_image=500;
                        $Y_image=700+100;
                }

                if($format=="4" && $position=="1"){
                        $X_image=800;
                        $Y_image=600+100;
                }
                if($format=="4" && $position=="2"){
                        $X_image=600;
                        $Y_image=800+100;
                }

/***********************************************************************************************************************/

                //CREATION DE L'IMAGE
                $histogramme=imagecreate($X_image,$Y_image);

                //ALLOCATION DES COULEURS
                $bg_color0=imagecolorallocate($histogramme,0xFF,0xFF,0xFF);//blanc
                $bg_color1=imagecolorallocate($histogramme,204,204,204);//gris
                $text_color=imagecolorallocate($histogramme,0x00,0x00,0x00);
                $axes_color=imagecolorallocate($histogramme,0x00,0x00,0x00);

                //DEFINITION DES COULEURS DE REMPLISSAGE DES BARRES
                if($bar_color=="1"){
                        $rect_color=imagecolorallocate($histogramme,0,204,204);//couleur Gris/vert
                }
                if($bar_color=="2"){
                        $rect_color=imagecolorallocate($histogramme,255,0,0);//couleur Rouge
                }
                if($bar_color=="3"){
                        $rect_color=imagecolorallocate($histogramme,255,255,102);//couleur Jaune
                }
                if($bar_color=="4"){
                        $rect_color=imagecolorallocate($histogramme,0,0,255);//couleur Bleu
                }
                if($bar_color=="5"){
                        $rect_color=imagecolorallocate($histogramme,51,255,153);//couleur Vert
                }
                if($bar_color=="6"){
                        $rect_color=imagecolorallocate($histogramme,255,102,51);//couleur Orange
                }
                if($bar_color=="7"){
                        $rect_color=imagecolorallocate($histogramme,204,0,204);//couleur Violet
                }
                if($bar_color=="8"){
                        $rect_color=imagecolorallocate($histogramme,102,255,255);//couleur Turquoise
                }
                if($bar_color=="9"){
                        $rect_color=imagecolorallocate($histogramme,204,0,102);//couleur Bordeaux
                }
                if($bar_color=="10"){
                        $rect_color=imagecolorallocate($histogramme,255,0,102);//couleur Rose
                }
                if($bar_color=="11"){
                        $rect_color=imagecolorallocate($histogramme,106,177,249);//couleur Bleu Icare
                }

                //COLORIAGE DU FOND DE L'IMAGE
                if($back_color=="1"){
                        imagefill($histogramme,0,0,$bg_color0);
                        $grille_color=imagecolorallocate($histogramme,204,204,204);
                }
                if($back_color=="2"){
                        imagefill($histogramme,0,0,$bg_color1);
                        $grille_color=imagecolorallocate($histogramme,255,255,255);
                }

/***********************************************************************************************************************/

                //ELABORATION DU GRAPHIQUE ET DE SES ELEMENTS SUIVANT LE CHOIX FAIT POUR LE POSITONNEMENT DU GRAPH
                //définition de trois police d'écriture
                $text_font=2;
                $text_font2=3;
                $text_font3=1;

                if($position=="1"){
                        //AXE VERTICAL
                        //emplacement utilisé par l'échelle = largeur d'1 caractere * nombre maximum de chiffres de la légende + 1 espace pour ne pas toucher l'axe des ordonnées
                        $echelle_width=imagefontwidth($text_font)*6+3;
                        //traçage de l'axe vertical
                        imageline($histogramme,$echelle_width,100,$echelle_width,$Y_image-1,$axes_color);

                        //AXE HORIZONTAL
                        imageline($histogramme,$echelle_width,$Y_image-1,$X_image-1,$Y_image-1,$axes_color);

                        //TRACAGE DES LIGNES HORIZONTALES ET AFFICHAGE DE L'ECHELLE
                        $k=0;//variable qui s'incrémente à chaque nouvelle position de $i
                        //pointillés horizontaux
                        for($i=100;$i<$Y_image;$i+=$Y_image/($Y_image/50)){
                                imagedashedline($histogramme,$echelle_width-5,$i,$X_image-1,$i,$grille_color);
                                $ligne[$k]=$i;
                                $k++;
                        }
                        //échelle
                        $pas_echelle=$max/$k;
                        for($l=0;$l<$k;$l++){
                                if($l=="0"){
                                        $Y=$max;
                                }
                                else{
                                        if($max>9){
                                                $Y=floor($Y-$pas_echelle);
                                        }
                                        else{
                                                $Y=$Y-$pas_echelle;
                                        }
                                }
                                imagestring($histogramme,$text_font,0,$ligne[$l],$Y,$text_color);
                        }

                        //CALCUL DE LA LARGEUR DE CHAQUE RECTANGLE
                        $pas=($Y_image-100)/$max;//variable servant de référence pour le traçage des rectangles
                        $rect_width=($X_image-$echelle_width+1)/count($data);//calcul de la largeur d'un rectangle

                        for($i=0;$i<$num_data;$i++){
                                //obtention des coordonnées des points supérieur gauche et inférieur droit des rectangles a tracer
                                //largeur de l'échelle + axe vertical + largeur d'1 rectangle * nbre de rectangle déjà tracés
                                $rect_haut_g_X=$echelle_width+1+($i*$rect_width);
                                //hauteur de l'image - valeur des données * echelle
                                $rect_haut_g_Y=$Y_image-2-$data[$i]*$pas;
                                //abscisse du point supérieur gauche + largeur d'1 rectangle
                                $rect_bas_d_X=$rect_haut_g_X+$rect_width;
                                //hauteur de l'image - axe horizontal
                                $rect_bas_d_Y=$Y_image-1 - 1;

                                //AFFICHAGE DES RECTANGLES(-2 pour éviter qu'ils se touchent)
                                imagefilledrectangle($histogramme,$rect_haut_g_X,$rect_haut_g_Y,$rect_bas_d_X-3,$rect_bas_d_Y,$rect_color);

                                //AFFICHAGE DES ETIQUETTES SUR CHACUN DES RECTANGLES
                                //on cherche les coordonnées de chaque étiquette pour que le texte soit centré horizontalement par rapport a son rectangle  et placé verticalement a 10 du bas de l'image
                                $label_X=$rect_bas_d_X-(($rect_bas_d_X - $rect_haut_g_X)/2)-(imagefontheight(text_font2)/2);
                                $label_Y=$Y_image-2 - 10;
                                //on place les étiquettes
                                if($num_data>=40)
                                        imagestringup($histogramme,$text_font3,$label_X,$label_Y,($label[$i]." = ".$data[$i]),$text_color);
                                else{
                                        imagestringup($histogramme,$text_font2,$label_X,$label_Y,($label[$i]." = ".$data[$i]),$text_color);
                                }
                                $j++;
                                if($j=="10"){
                                        $j=0;
                                }
                        }
                }

/***********************************************************************************************************************/

                if($position=="2"){
                        //AXE HORIZONTAL
                        //emplacement utilisé par l'echelle ($echelle_height) = hauteur d'1 caractere + 1 espace pour ne pas toucher l'axe des ordonnées
                        //emplacement utilisé par l'échelle ($echelle_width= largeur d'un caractère * nbre maximum de ceux-ci
                        $echelle_height=imagefontheight($text_font)+3;
                        $echelle_width=imagefontwidth($text_font)*4;
                        $couleur=$couleur0;//choix de 0 à 9
                        //traçage de l'axe horizontal
                        imageline($histogramme,0,$Y_image-$echelle_height,$X_image-1,$Y_image-$echelle_height,$axes_color);

                        //AXE VERTICAL
                        imageline($histogramme,0,100,0,$Y_image-$echelle_height,$axes_color);

                        //TRACAGE DES LIGNES VERTICALES ET AFFICHAGE DE L'ECHELLE
                        //pointillés verticaux
                        $k=0;
                        for($i=0;$i<$X_image;$i+=$X_image/($X_image/50)){
                                imagedashedline($histogramme,$i,$Y_image+$echelle_height,$i,100,$grille_color);
                                $colonne[$k]=$i;
                                $k++;
                        }
                        imageline($histogramme,0,100,0,$Y_image-$echelle_height,$axes_color);
                        imagedashedline($histogramme,$X_image-1,$Y_image+$echelle_height,$X_image-1,100,$grille_color);
                        //echelle
                        $m=$k;//variable d'environnement associée aux différentes valeurs de $i classées dans le tableau
                        for($l=0;$m>0;$l++){
                                if($max>9){
                                        $max2=floor((($X_image-$colonne[$l])/$X_image)*$max);
                                }
                                else{
                                        $max2=(($X_image-$colonne[$l])/$X_image)*$max;
                                }
                                imagestring($histogramme,$text_font,$colonne[$m]-$echelle_width,$Y_image-$echelle_height+5,$max2,$text_color);
                                $m--;
                        }
                        imagestring($histogramme,$text_font,$X_image-1-$echelle_width,$Y_image-$echelle_height+5,$max,$text_color);

                        //CALCUL DE LA LARGEUR DE CHAQUE RECTANGLE
                        $pas=$X_image/$max;//variable servant de référence pour le traçage des rectangles
                        $rect_height=($Y_image-100-$echelle_height+1)/$num_data;//variable associée à la grosseur des rectangles en fonction du nombre de données
                        $j=0;//variable en référence aux tableaux de données et de labels
                        for($i=1;$j<$num_data;$i++){
                                //obtention des coordonnées des points supérieurs gauches et inférieurs droits des rectangles à tracer
                                //abscisse du coin supérieur gauche du rectangle
                                $rect_haut_g_X=1;
                                //ordonnée du coin supérieur gauche du rectangle: hauteur de l'image - espace laissé pour l'affichage des coordonnées - hauteur d'un rectangle * nombre de rectangle déjà tracé
                                $rect_haut_g_Y=($Y_image-$echelle_height-1)-($rect_height*$i);
                                //abscisse du coin inférieur droit des rectangles (représente la valeur du tableau de données): donnée * pas
                                $rect_bas_d_X=$data[$j]*$pas;
                                //ordonnée du coin inférieur droit des rectangles: coin supérieur gauche + hauteur d'un rectangle
                                $rect_bas_d_Y=$rect_haut_g_Y+$rect_height;
                                //incrémentation de la variable en référence au tableau de données

                                //AFFICHAGE DES RECTANGLES(-2 pour eviter qu'ils se touchent)
                                if($i==1){
                                        imagefilledrectangle($histogramme,$rect_haut_g_X,$rect_haut_g_Y,$rect_bas_d_X,$rect_bas_d_Y,$rect_color);
                                }
                                else{
                                        imagefilledrectangle($histogramme,$rect_haut_g_X,$rect_haut_g_Y,$rect_bas_d_X,$rect_bas_d_Y-3,$rect_color);
                                }

                                //AFFICHAGE DES ETIQUETTES SUR CHACUN DES RECTANGLES
                                //on cherche les coordonnées de chaque étiquette pour que le texte soit centré verticalement par rapport a son rectangle  et placé horizontalement à 10 du bord gauche de l'image
                                $label_X=$rect_haut_g_X+10;
                                $label_Y=$rect_bas_d_Y-(($rect_bas_d_Y-$rect_haut_g_Y)/2)-(imagefontwidth(text_font2)/2)-3;
                                //on place les étiquettes
                                if($num_data>=40)
                                        imagestring($histogramme,$text_font3,$label_X,$label_Y,($label[$j]." = ".$data[$j]),$text_color);
                                else{
                                        imagestring($histogramme,$text_font2,$label_X,$label_Y,($label[$j]." = ".$data[$j]),$text_color);
                                }
                                $j++;
                                $l++;
                                if($l=="10"){
                                        $l=0;
                                }
                        }
                }

/***********************************************************************************************************************/

                //INSERTION DU TITRE DU GRAPHIQUE ET DES ELEMENTS EXTERNES AU GRAPHIQUE
                //insertion du titre
                if($format=="1"){
                        imagestring($histogramme,2,0,10,$titre,$text_color);
                }
                if($format=="2"){
                        imagestring($histogramme,2,0,10,$titre,$text_color);
                }
                if($format=="3"){
                        imagestring($histogramme,3,0,10,$titre,$text_color);
                }
                if($format=="4"){
                        imagestring($histogramme,4,0,10,$titre,$text_color);
                }
                //insertion du label pour l'identification de l'axe du graph
                //pour graphique en longueur
                if($position=="1"){
                        $label_Y="Axe des ordonnés : " . $label_ordonne;
                        imagestring($histogramme,2,0,40,$label_Y,$text_color);
                }
                //pour graphique en hauteur
                if($position=="2"){
                        $label_X="Axe des abscisses : " . $label_abscisse;
                        imagestring($histogramme,2,0,35,$label_X,$text_color);
                }


/***********************************************************************************************************************/

                //ENVOI DE L'IMAGE AU NAVIGATEUR ET AFFICHAGE

    $hour = gettimeofday();
    $sec = $hour['sec'];
    $usec = $hour['usec'];
    $nomunique = $sec.$usec.".png";

                imagepng($histogramme,"../../imagesTemp/".$nomunique);
                print("<img src=\"../../imagesTemp/".$nomunique."\">");

                //DESTRUCTION DE L'ESPACE OCCUPE PAR L'IMAGE
                imagedestroy($histogramme);
        }//fin fonction
}//fin classe
?>

</body>
</html>
