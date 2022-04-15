<?php

	class Point
	{
		public $x;
		public $y;
		
		public function __construct($x, $y){
		
			$this->x = $x;
			$this->y = $y;
		
		}
	
	}
	
	class Map_point
	{
		public $point1;
		public $point2;
		public $nom;
		
		public function __construct($p1, $p2){
		
			$this->point1 = $p1;
			$this->point2 = $p2;
		
		}
		
	
	}


	class Diagramme
	{
		private $id_image;
		private $largeur;
		private $hauteur;
		private $palette;
		private $freq;
		private $max_freq;
		private $somme_freq;
		private $marge;
		private $largeur_baton;
		private $espace_baton;
		private $meme_couleur;
		private $pct;
		private $virgule;
		private $nb_freq_dess;
		private $pos_lib;
		private $tab_lib;
		private $max_lib;
		private $nom_fichier;
		private $titre;
		private $titre_lib;
		private $tab_map_point;
		private $nom_map;
		private $max_grille;
	
		public function __construct($n, $f, $l, $h){
		
			$this->nom_fichier = $n;
			$this->freq = $f;
			$this->max_freq = count($f);
			$this->somme_freq = array_sum($f);
			$this->largeur = $l;
			$this->hauteur = $h;
			$this->palette = array();
			$this->marge_gauche = 40;
			$this->marge_droite = 40;
			$this->marge_hb = 20;
			$this->largeur_grille = 400;//$this->largeur - 10 - $this->marge_gauche - $this->marge_droite;
			$this->hauteur_grille = 300;//$this->hauteur - 10 - $this->marge_hb * 2;
			$this->largeur_baton = 20;
			$this->espace_baton = 20;
			$this->meme_couleur = false;
			$this->pct = false;
			$this->virgule = true;
			$this->nb_freq_dess = 0;
			$this->pos_lib = 1;
			$this->tab_lib = '';
			$this->max_lib = 0;
			$this->titre = '';
			$this->titre_lib = '';
			$this->tab_map_point = array();
			$this->nom_map = '';
			$this->max_grille = '';
		
		}
		
		private function creer_image(){
		
			$this->id_image = imagecreate($this->largeur, $this->hauteur);
		
		}
		
		private function init_palette(){
		
			$this->palette[0] = imagecolorallocate($this->id_image, 0xFF, 0xFF, 0xFF);
			
			if($this->meme_couleur)
			{
				$this->palette['orange'] = imagecolorallocate($this->id_image, 222, 149, 7);
				$this->palette['orange_clair'] = imagecolorallocate($this->id_image, 255, 213, 71);
			}
			else
			{
				for($i = 1;$i < 52;$i++)
				{
					$this->palette[$i] = imagecolorallocate($this->id_image, 255, $i*5, 0);
					$this->palette[$i+51] = imagecolorallocate($this->id_image, 255-$i*5, 255, 0);
					$this->palette[$i+51*2] = imagecolorallocate($this->id_image, 0, 255, $i*5);
													
				}
			
			}
			
			$this->palette['noir'] = imagecolorallocate($this->id_image, 0, 0, 0);
		
		}
		
		private function affiche_palette(){
		
			if($this->meme_couleur)
			{
				imagefilledrectangle ($this->id_image, 0, 0, 10, 10, $this->palette['orange']);
				imagefilledrectangle ($this->id_image, 10, 0, 20, 10, $this->palette['orange_clair']);
				
			}
			else
			{
				for($i = 0;$i < 153;$i++)
				{
					imagefilledrectangle ($this->id_image, $i, 10, $i, 60, $this->palette[$i]);
				
				}
			}
		
		}
		
		private function couleur_face_baton($mod, $i){
					 
			$rvb =  imagecolorsforindex($this->id_image, $i);
			if(($mod+$rvb['red'])>255) $rvb['red']=255-$mod;
			if(($mod+$rvb['green'])>255) $rvb['green']=255-$mod;
			if(($mod+$rvb['blue'])>255) $rvb['blue']=255-$mod;
			if(($mod+$rvb['red'])<0) $rvb['red']=-$mod;
			if(($mod+$rvb['green'])<0) $rvb['green']=-$mod;
			if(($mod+$rvb['blue'])<0) $rvb['blue']=-$mod;
			$this->palette['couleur_face'] = imagecolorallocate($this->id_image, $mod+$rvb['red'], $mod+$rvb['green'], $mod+$rvb['blue']);
				
		}
		
		private function getmaxfreq(){
		
			$max = 0;
			for($i = 0;$i < $this->max_freq;$i++)
			{
				if($this->freq[$i] > $max)
					$max = $this->freq[$i];
			}
			
			return $max;
		
		}
		
		public function set_libelle($l){
		
			$this->tab_lib = $l;
			$this->max_lib = count($l);
		
		}
		
		public function set_position_lib($p){
		
			$this->pos_lib = $p;
		
		}
		
		public function set_meme_couleur($c){
		
			$this->meme_couleur = $c;
		
		}
		
		public function set_grille($l, $h){
		
			$this->largeur_grille = $l;
			$this->hauteur_grille = $h;
		
		}
		
		public function set_titre($t){
		
			$this->titre = $t;
		
		}
		
		public function set_titre_lib($t){
		
			$this->titre_lib = $t;
		
		}
		
		public function set_nom_map($n){
		
			$this->nom_map = $n;
		
		}
		
		public function set_pct($p){
		
			$this->pct = $p;
		
		}
		
		public function set_virgule($v){
		
			$this->virgule = $v;
		
		}
		
		public function set_max_grille($m){
		
			$this->max_grille = $m;
		
		}
		
		public function get_map_point(){
		
			return $this->tab_map_point;
		
		}
							
		public function Dessine(){
		
			$this->creer_image();
			$this->init_palette();
			
			//$this->affiche_palette();
			
			
			$max = $this->getmaxfreq();
			$nb = strlen($max)*6;
			if($this->marge_gauche < $nb);
				$this->marge_gauche += $nb;
				
			if($this->titre != '');
			{
				$this->marge_hb += 20;
				$x = $this->marge_gauche + (($this->largeur_grille - (strlen($this->titre)*6)) / 2);
				imagestring($this->id_image, 5, $x, 5, $this->titre, $this->palette['noir']);	
			}
		
			//axe ordonnée
			$x1 = $this->marge_gauche;
			$y1 = $this->hauteur_grille + $this->marge_hb + 10;
			$x2 = $this->marge_gauche;
			$y2 = $this->marge_hb + 10;
			imageline($this->id_image, $x1, $y1, $x2, $y2, $this->palette['noir']);	
			
			//axe abscisse
			$x3 = $this->largeur_grille + $this->marge_gauche;
			imageline($this->id_image, $x1, $y1, $x3, $y1, $this->palette['noir']);
			
			//axe z
			$x4 = $this->marge_gauche + 10;
			$y4 = $this->hauteur_grille + $this->marge_hb;
						
			//axe ordonnée 2
			$y5 = $this->marge_hb;
			imageline($this->id_image, $x4, $y4, $x4, $y5, $this->palette['noir']);	
			
			//axe abscisse 2
			$x6 = $this->largeur_grille + $this->marge_gauche + 10;
			imageline($this->id_image, $x4, $y4, $x6, $y4, $this->palette['noir']);	
			
			//tiret numero
			$esp = $this->hauteur_grille / 10;
			$y1_z = $y1;$y2_z = $y4;$s = 0;
			for($i = 0;$i < 11;$i++)
			{
				//trait z
				imageline($this->id_image, $x1, $y1_z, $x4, $y2_z, $this->palette['noir']);	
				
				//tiret pct
				imageline($this->id_image, $x1, $y1_z, $x1-5, $y1_z, $this->palette['noir']);
				//pct
				if($this->pct)
					imagestring($this->id_image, 2, $x1-29, $y1_z-10, ($i*10)."%", $this->palette['noir']);	
				else
				{
					$max = 0;
					if($this->max_grille == '')
						$max = $this->getmaxfreq();
					else
						$max = $this->max_grille;
					
					$n = round($max / 10, 2);
					$nx = ($this->marge_gauche - (strlen($max)*6)) / 2;
					if($this->virgule)
					{
						imagestring($this->id_image, 2, $nx, $y1_z-10, $s, $this->palette['noir']);	
						$s += $n;
					}
					else
					{
						if($max < 10)
						{
							imagestring($this->id_image, 2, $nx, $y1_z-10, $s, $this->palette['noir']);	
							$s++;
						}
						else
						{
							$_n = split("\.", $n);
							imagestring($this->id_image, 2, $nx, $y1_z-10, $s, $this->palette['noir']);	
							$s += $_n[0]+1;
						}
					
					}
				
				}
				
				//trait pct
				imageline($this->id_image, $x4, $y2_z, $x6, $y2_z, $this->palette['noir']);
				
				$y1_z -= $esp;
				$y2_z -= $esp;
			
			}
			
			//trait z droite
			imageline($this->id_image, $x3, $y1, $x6, $y4, $this->palette['noir']);	
			
			//axe ordonnée droite
			imageline($this->id_image, $x6, $y4, $x6, $y5, $this->palette['noir']);
			
			$this->nb_freq_dess = ($this->largeur_grille - 15) / ($this->largeur_baton + $this->espace_baton);
			$x1_b = $x1 + 15;
			$y1_b = 0;
			$x2_b = 0;
			for($i = 0;($i < $this->max_freq) && ($i < round($this->nb_freq_dess));$i++)
			{
				if($this->pct)
				{
					$y1_b = $y1 - ($this->freq[$i] /  $this->somme_freq) * $this->hauteur_grille;
					
				}
				else
				{
					$max = 0;
					if($this->max_grille == '')
						$max = $this->getmaxfreq();
					else
						$max = $this->max_grille;
					$n = round($max / 10, 2);
					$nx = ($this->marge_gauche - (strlen($max)*6)) / 2;
					if($this->virgule)
					{
						$y1_b = $y1 - ($this->freq[$i] /  ($n * 10)) * $this->hauteur_grille;
						
					}
					else
					{
						if($max < 10)
						{
							$y1_b = $y1 - ($this->freq[$i] /  10) * $this->hauteur_grille;
							
						}
						else
						{
							$_n = split("\.", $n);
							$y1_b = $y1 - ($this->freq[$i] /  (($_n[0]+1) * 10) ) * $this->hauteur_grille;
				
						}
					
					}
				
				}
				
				if($y1_b < ($y1 - $this->hauteur_grille))
				{
					$y1_b = $y1 - $this->hauteur_grille;
				}
				
				$x2_b = $x1_b + $this->largeur_baton;
				
				$c = '';$ind = 0;
				for($j = 1;$j <= 10;$j++)
				{
					if($this->meme_couleur)
						$c = $this->palette['orange'];
					else
					{
						$ind = 152/($this->max_freq+1)*($i+1);
						$c = $this->palette[$ind];
					}
					imagefilledrectangle ($this->id_image, $x1_b+$j, $y1_b-$j, $x2_b+$j, $y1-$j, $c);
				}
				if($this->meme_couleur)
					$c = $this->palette['orange_clair'];
				else
				{
					$this->couleur_face_baton(64, $this->palette[$ind]);
					$c = $this->palette['couleur_face'];
					
				}
				imagefilledrectangle ($this->id_image, $x1_b, $y1_b, $x2_b, $y1, $c);
				//Creation du tableau map point
				$p1 = new Point(round($x1_b), round($y1_b));
				$p2 = new Point(round($x2_b), round($y1));
				$mp = new Map_point($p1, $p2);
				if(($this->tab_lib != '') && ($i < $this->max_lib))
					$mp->nom = $this->tab_lib[$i];
				$this->tab_map_point[$i] = $mp;
				//numero
				imagestring($this->id_image, 2, $x1_b+5, $y1+5, $i+1, $this->palette['noir']);	
				
				
				$x1_b += $this->largeur_baton + $this->espace_baton;
							
			}
			
			if($this->pos_lib == 1)
			{
				$x = $this->marge_gauche + $this->largeur_grille + 20;
				$y = ($this->hauteur - ($this->max_freq * 15)) / 2;
				if($this->titre_lib != '')
				{
					imagestring($this->id_image, 3, $x, $y, $this->titre_lib, $this->palette['noir']);
					$y += 15;
				}
				for($i = 0;$i < $this->max_freq;$i++)
				{
					$ind = 152/($this->max_freq+1)*($i+1);
					if(!$this->meme_couleur)
					{
						$this->couleur_face_baton(64, $this->palette[$ind]);
						imagefilledrectangle ($this->id_image, $x, $y, $x+20, $y+10, $this->palette['couleur_face']);
					}
					$str = $i+1 ." - " .$this->freq[$i];
					if(($this->tab_lib != '') && ($i < $this->max_lib))
						$str .= ' ' .$this->tab_lib[$i];
					imagestring($this->id_image, 2, $x+25, $y, $str, $this->palette['noir']);	
					$y += 15;
				
				
				}
						
			}
			else if($this->pos_lib == 2)
			{
				$max_l = 0;
				for($i = 0;$i < $this->max_freq;$i++)
				{
					$str = $i+1 ." - " .$this->freq[$i];
					if(($this->tab_lib != '') && ($i < $this->max_lib))
						$str .= ' ' .$this->tab_lib[$i];
					$strl = strlen($str) * 6;
					if($strl > $max_l)
						$max_l = $strl;
						
				}
						
				$x = $this->marge_gauche + (($this->largeur_grille - $max_l) / 2);
				$y = $this->hauteur_grille +  $this->marge_hb + 40;
				if($this->titre_lib != '')
				{
					imagestring($this->id_image, 3, $x, $y, $this->titre_lib, $this->palette['noir']);
					$y += 15;
				}
				for($i = 0;$i < $this->max_freq;$i++)
				{
					$ind = 152/($this->max_freq+1)*($i+1);
					if(!$this->meme_couleur)
					{
						$this->couleur_face_baton(32, $this->palette[$ind]);
						imagefilledrectangle ($this->id_image, $x, $y, $x+20, $y+10, $this->palette['couleur_face']);
					}
					$str = $i+1 ." - " .$this->freq[$i];
					if(($this->tab_lib != '') && ($i < $this->max_lib))
						$str .= ' ' .$this->tab_lib[$i];
					imagestring($this->id_image, 2, $x+25, $y, $str, $this->palette['noir']);	
					$y += 15;
				
				
				}
			
			}
			
						
			imagepng($this->id_image, $this->nom_fichier);
			echo '<img src="' .$this->nom_fichier .'" alt="diagramme" ';
			if($this->nom_map != '')
				echo 'usemap="#' .$this->nom_map .'" ';
			echo '/>';
			imagedestroy($this->id_image);
			
			
		
		}
	
	
	
	}
	
	$f = array(15, 1, 1, 8, 20, 16, 12, 45, 51, 10, 10);
	$d = new Diagramme('diagramme.png', $f, 700, 450);
	$d->set_grille(450, 300);
	$d->set_libelle(array('oui', 'non'));
	$d->set_position_lib(1);
	$d->set_meme_couleur(false);
	$d->set_titre('Régis Meyssonnier');
	$d->set_titre_lib('Mois');
	$d->set_nom_map('diagramme');
	$d->set_pct(false);
	$d->set_virgule(false);
	$d->set_max_grille(51);
	$d->Dessine();
		
	$t = $d->get_map_point();
	$n = count($t);
	echo '<map name="diagramme">';
	for($i=0;$i<$n;$i++)
	{
		//echo "point1 x:" .$t[$i]->point1->x ."y:" .$t[$i]->point1->y .'<br/>';
		//echo "point2 x:" .$t[$i]->point2->x ."y:" .$t[$i]->point2->y .'<br/>';
		echo '<area shape="rect" coords="' .$t[$i]->point1->x  ."," .$t[$i]->point1->y ."," .$t[$i]->point2->x ."," .$t[$i]->point2->y .'" href="" alt="' .$t[$i]->nom .'"/>';
		
	}
	echo '</map>';


?>