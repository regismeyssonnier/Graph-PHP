<?php


	class Camembert
	{
		private $id_image;
		private $largeur;
		private $hauteur;
		private $palette;
		private $freq;
		private $max_freq;
		private $somme_freq;
		private $epaisseur_cam;
		private $centre_x;
		private $centre_y;
		private $largeur_cam;
		private $hauteur_cam;
		private $rayon_cam;
		private $libelle;
		private $ecartement;
		private $etat;
		private $sel_tranche;
		private $indicateur;
		private $max_lib;
		private $titre;
		private $titre_lib;
		private $nom_fichier;
		private $taille_indicateur;
		private $rayon_cam_y;
		private $margex;
		private $margey;
		private $pos_x_lib;
		private $pos_y_lib;
			
		public function __construct($n, $f, $l, $h){
		
			$this->nom_fichier = $n;
			$this->freq = $f;
			$this->max_freq = count($f);
			$this->somme_freq = array_sum($f);
			$this->largeur = $l;
			$this->hauteur = $h;
			$this->palette = array();
			$this->epaisseur_cam = 50;
			$this->ecartement = 0;
			$this->largeur_cam = 300;
			$this->hauteur_cam = 200;
			$this->rayon_cam = $this->largeur_cam / 2;
			$this->rayon_cam_y = $this->hauteur_cam / 2;
			$this->indicateur = false;
			$this->taille_indicateur = 90;
			$this->margex = 20;
			$this->margey = 20;
			if($this->indicateur)
			{
				$this->margex = $this->taille_indicateur + 10;
				$this->margey = $this->taille_indicateur + 50;
			}
			$this->centre_x = $this->rayon_cam + $this->ecartement + $this->margex;
			$this->centre_y = $this->rayon_cam_y + $this->ecartement + $this->epaisseur_cam + $this->margey;
			$this->libelle = true;
			$this->etat = 1;
			$this->sel_tranche = 14;
			$this->tab_lib = '';
			$this->max_lib = 0;
			$this->titre = '';
			$this->titre_lib = '';
			$this->pos_x_lib = '';
			$this->pos_y_lib = '';
			
			
					
		}
		
		private function calcule_centre(){
		
			$this->rayon_cam = $this->largeur_cam / 2;
			$this->rayon_cam_y = $this->hauteur_cam / 2;
			$this->margex = 20;
			$this->margey = 20;
			if($this->indicateur)
			{
				$this->margex = $this->taille_indicateur + 10;
				$this->margey = $this->taille_indicateur + 50;
			}
			$this->centre_x = $this->rayon_cam + $this->ecartement + $this->margex;
			$this->centre_y = $this->rayon_cam_y + $this->ecartement + $this->epaisseur_cam + $this->margey;
					
		}
		
		public function init_libelle($lib){
		
			$this->tab_lib = $lib;
			$this->max_lib = count($lib);
		
		}
	
		private function init_palette(){
		
			$this->palette[0] = imagecolorallocate($this->id_image, 0xFF, 0xFF, 0xFF);
			
			for($i = 1;$i < 52;$i++)
			{
				$this->palette[$i] = imagecolorallocate($this->id_image, 255, $i*5, 0);
				$this->palette[$i+51] = imagecolorallocate($this->id_image, 255-$i*5, 255, 0);
				$this->palette[$i+51*2] = imagecolorallocate($this->id_image, 0, 255, $i*5);
				$this->palette[$i+51*3] = imagecolorallocate($this->id_image, 0, 255-$i*5, 255);
				$ind = $i+51*4;
				if($ind < 255)
					$this->palette[$ind] = imagecolorallocate($this->id_image, $i*5, 0, 255);
								
			}
			
			$this->palette['noir'] = imagecolorallocate($this->id_image, 0, 0, 0);
			
			/*$this->palette[1]     = imagecolorallocate($this->id_image, 0xC0, 0xC0, 0xC0);
			$this->palette[2] = imagecolorallocate($this->id_image, 0x90, 0x90, 0x90);
			$this->palette[3]     = imagecolorallocate($this->id_image, 0x00, 0x00, 0x80);
			$this->palette[4] = imagecolorallocate($this->id_image, 0x00, 0x00, 0x50);
			$this->palette[5]      = imagecolorallocate($this->id_image, 0xFF, 0x00, 0x00);
			$this->palette[6]  = imagecolorallocate($this->id_image, 0x90, 0x00, 0x00);
			*/
				
		
		}
		
		private function creer_image(){
		
			$this->id_image = imagecreate($this->largeur, $this->hauteur);
					
		}
		
		private function affiche_palette(){
		
			for($i = 0;$i < 255;$i++)
			{
				imagefilledrectangle ($this->id_image, $i, 10, $i, 60, $this->palette[$i]);
			
			}
		
		}
		
		private function image_modul_couleur($im, $mod){
		
			 $nb = imagecolorstotal($im);
			 
			 for($i = 1;$i < $nb;$i++) 
    		 {
			 	$rvb =  imagecolorsforindex($im,$i);
				if(($mod+$rvb['red'])>255) $rvb['red']=255-$mod;
				if(($mod+$rvb['green'])>255) $rvb['green']=255-$mod;
				if(($mod+$rvb['blue'])>255) $rvb['blue']=255-$mod;
				if(($mod+$rvb['red'])<0) $rvb['red']=-$mod;
				if(($mod+$rvb['green'])<0) $rvb['green']=-$mod;
				if(($mod+$rvb['blue'])<0) $rvb['blue']=-$mod;
				imagecolorset($im,$i,$mod+$rvb['red'],$mod+$rvb['green'],$mod+$rvb['blue']);
			 }
		
		
		}
		
		public function set_titre($t){
		
			$this->titre = $t;
		
		}
		
		public function set_titre_lib($t){
		
			$this->titre_lib = $t;
		
		}
		
		public function set_etat($e){
		
			$this->etat = $e;
		
		}
		
		public function set_sel_tranche($t){
		
			$this->sel_tranche = $t;
		
		}
		
		public function set_indicateur_auto($i){
		
			$this->indicateur = $i;
			$this->calcule_centre();
		
		}
		
		public function set_indicateur($i){
		
			$this->indicateur = $i;
					
		}
		
		public function set_epaisseur_cam_auto($e){
		
			$this->epaisseur_cam = $e;
			$this->calcule_centre();
					
		}
		
		public function set_epaisseur_cam($e){
		
			$this->epaisseur_cam = $e;
								
		}
		
		public function set_ecartement_auto($e){
		
			if($this->etat != 1)
			{
				$this->ecartement = $e;
				$this->calcule_centre();
			}
		
		}
		
		public function set_ecartement($e){
		
			if($this->etat != 1)
			{
				$this->ecartement = $e;
				
			}
		
		}
		
		public function set_taille_cam_auto($l, $h){
		
			$this->largeur_cam = $l;
			$this->hauteur_cam = $h;
			$this->calcule_centre();
		
		}
		
		public function set_taille_cam($l, $h){
		
			$this->largeur_cam = $l;
			$this->hauteur_cam = $h;
				
		}
		
		public function set_centre($x, $y){
		
			$this->centre_x = $x;
			$this->centre_y = $y;
		
		}
		
		public function set_position_lib($x, $y){
		
			$this->pos_x_lib = $x;
			$this->pos_y_lib = $y;
		
		}
				
		public function Dessine(){
		
			$this->creer_image();
			$this->init_palette();
			
			$im2 = imagecreate($this->largeur, $this->hauteur);
			$w = imagecolorallocate($im2, 0xFF, 0xFF, 0xFF);
			imagecolortransparent($im2,$w);
			
			//imagefill($this->id_image, 0, 0, $this->palette['fond']);
			imagecolortransparent($this->id_image,$this->palette[0]);
			//$this->Affiche_palette();
			
												
			$tot_deg = 0;$tab_deg = array(0);
			for($i = 0;$i < $this->max_freq;$i++)
			{
				$degre = 360 * ($this->freq[$i] / $this->somme_freq);
				if($degre < 0.5)$degre = 0.5;
				$angle = ($degre / 2) + $tot_deg;
				$ec = 0;
				if($this->etat == 2)
				{
					$ec = $this->ecartement;
				}
				if($this->etat == 3)
				{
					if($this->sel_tranche == $i)
					{
						$ec = $this->ecartement;
						
					}
					
				}
				
				$x = cos($angle*M_PI/180);
				$y = sin($angle*M_PI/180) * ($this->hauteur_cam/$this->largeur_cam);
				imagefilledarc($this->id_image, $this->centre_x + ($x * $ec) , $this->centre_y + ($y * $ec), $this->largeur_cam, $this->hauteur_cam, $tot_deg, $tot_deg + $degre, $this->palette[255/($this->max_freq+1)*($i+1)] , IMG_ARC_NOFILL&IMG_ARC_EDGED);
				$tot_deg += $degre;
				$tab_deg[$i+1] = $tot_deg;
						
			}
			
			
									
			imagecopy($im2,$this->id_image,0,0,0,0,imagesx($this->id_image),imagesy($this->id_image));
			$this->image_modul_couleur($im2, 51);
			
			for($j = 0;$j < $this->epaisseur_cam;$j++)
				imagecopy($this->id_image,$this->id_image,0,0,0,1,imagesx($this->id_image),imagesy($this->id_image));
				
			imagecopy($this->id_image,$im2,0,0,0,$this->epaisseur_cam,imagesx($this->id_image),imagesy($this->id_image));
			
			if($this->titre != '')
			{
				$x = $this->centre_x -  ((strlen($this->titre)*6) / 2);
				imagestring($this->id_image, 5, $x, 0, $this->titre, $this->palette['noir']);	
				
			}
			
			if($this->indicateur)
			{
				for($i = 1;$i < $this->max_freq + 1;$i++)
				{
					$ec = 0;$c = $this->palette['noir'];
					if($this->etat == 2)
					{
						$ec = $this->ecartement;
					}
					if($this->etat == 3)
					{
						if($this->sel_tranche == $i-1)
						{
							$ec = $this->ecartement;
							$c = $this->palette[1];
						}
						
					}
					$angle = $tab_deg[$i-1] + (($tab_deg[$i] - $tab_deg[$i-1]) / 2);
					$x1 = ($this->centre_x +(cos($angle*M_PI/180) *($this->rayon_cam+$ec)));
					$y1 = ($this->centre_y - $this->epaisseur_cam) + ((sin($angle*M_PI/180) * ($this->hauteur_cam/$this->largeur_cam)) * ($this->rayon_cam+$ec));
					$x2 = ($this->centre_x + (cos($angle*M_PI/180) *($this->rayon_cam+$this->taille_indicateur+$ec)));
					$y2 = ($this->centre_y - $this->epaisseur_cam) + ((sin($angle*M_PI/180) * ($this->hauteur_cam/$this->largeur_cam) ) * ($this->rayon_cam+$this->taille_indicateur+$ec));
					$x3 = ($this->centre_x + (cos($angle*M_PI/180) *($this->rayon_cam+$this->taille_indicateur+15+$ec)));
					$y3 = ($this->centre_y - $this->epaisseur_cam) + ((sin($angle*M_PI/180) * ($this->hauteur_cam/$this->largeur_cam) ) * ($this->rayon_cam+$this->taille_indicateur+30+$ec));
					imageline($this->id_image, $x1, $y1, $x2, $y2, $this->palette['noir']);	
					imagestring($this->id_image, 2, $x3, $y3, $i, $c);	
				}
				
			}
			
			
			
			if($this->libelle)
			{
				$m = 20;
				if($this->indicateur)
				{
					$m = $this->taille_indicateur ;
					if($this->ecartement <= 25)$m +=  30 - $this->ecartement; 
				}
				
				if(($this->pos_x_lib == '') && ($this->pos_y_lib == ''))
				{
					$this->pos_x_lib = $this->centre_x + $this->rayon_cam + $this->ecartement * 2 + $m;
					$this->pos_y_lib = ($this->hauteur - ($this->max_freq * 16)) / 2;
				}
				$y = $this->pos_y_lib;
				if($this->titre_lib != '')
				{
					imagestring($this->id_image, 3, $this->pos_x_lib, $y, $this->titre_lib, $this->palette['noir']);
					$y+=15;
				}
				for($i = 0;$i < $this->max_freq;$i++)
				{
					imagefilledrectangle ($this->id_image, $this->pos_x_lib, $y, $this->pos_x_lib+20, $y+10, $this->palette[255/($this->max_freq+1)*($i+1)]);
					$str = '';
					if($this->indicateur)
						$str = $i+1 ." - ";
					$str .= $this->freq[$i];
					if(($this->tab_lib != '') && ($i < $this->max_lib))
						$str .= ' ' .$this->tab_lib[$i];
					$c = $this->palette['noir'];
					if($this->etat == 3)
					{
						if($this->sel_tranche == $i)
							$c = $this->palette[1];
					}
					imagestring($this->id_image, 2, $this->pos_x_lib+25, $y, $str, $c);	
					$y += 15;
				}
				
			
			}
			
			
			imagepng($this->id_image, $this->nom_fichier);
			echo '<img src="' .$this->nom_fichier .'" alt="camembert"/>';
			imagedestroy($this->id_image);
		
		}
	
	

	}

	$t = array(100, 500, 300, 200, 20, 154, 1, 500, 300, 200, 20, 154, 1, 500, 300, 200, 20, 154);
	$c = new Camembert('camembert.png', $t, 755, 550);
	$l = array('Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris','Paris'); 
	$c->init_libelle($l);
	$c->set_titre('Titre');
	$c->set_titre_lib('Titre lib');
	//$c->set_centre(400, 300);
	$c->set_etat(1);
	$c->set_sel_tranche(10);
	$c->set_indicateur_auto(true);
	$c->set_epaisseur_cam_auto(50);
	$c->set_ecartement_auto(50);
	$c->set_taille_cam_auto(250, 200);
	//$c->set_position_lib(10, 50);
	
	$c->Dessine();














?>