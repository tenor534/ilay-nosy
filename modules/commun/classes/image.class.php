<?php
 /**
 * @package rapho
 * @subpackage commun
 * @author      Delestre Mathieu (http://ldbglobe.fried-rice.net/)
 * @author      Benoit clerc     (http://www.zeubeubeu.net/)
 * @author      TeddyBer         (http://ber.free.fr/)
 * @version     1.1a
 * @link        http://ldbglobe.fried-rice.net/blog/2005/03/13/41-traitement-des-images-en-php
 * @since       Disponnible depuis octobre 2004
 * Classe de traitement d'image prennant � sa charge les traitement de base afin de simplifier au maximum la g�n�ration d'image en PHP
 *
 * PHP versions 4 et 5 (GD 1.x et 2.x)
 *
 * Cette classe � �t� developp� dans le but de simplifier la vie de tous. Libre � vous de l'inclure dans vos projet.
 * Une seule limitation, je vous serez reconnaissant de me tenir au courant des �ventuelles corrections,
 * modifications, ajouts que vous pourriez faire afin que je puisse les int�gr�s au projet initial.
 *
 * 
 */

/**
 * Exemple d'utilisation
 * 
 * $IF=new ImageFilter;
 * $IF->loadImage('test.png');
 * $IF->resize('200%','','force',true);
 * $IF->setColorsToWork(16); // default = 256
 * $IF->sepia();
 * $IF->mosaic(3);
 * $IF3->output('PNG');
 *
 */



/**
* Traitement des images
* @package rapho
* @subpackage commun
*/
class ImageFilter
{
    /**
     * $colorsToWork :
     * d�termine le nombre de couleur par d�faut sur lequel travaillerons les filtres
     * Mettre une valeur faible peut avoir des comportement �tonnant
     * selon la version de la librairie et de la plateforme d'execution.
     * En effet si manifestement sous Windows les couleurs sont bien choisit (l'image resultante est plutot fid�le)
     * sous Linux le choix est parfois "particulier" et il n'est pas rare d'obtenir un image au teintes
     * trop claire ou trop sombre (parfois m�me toutes identiques > donc plus d'image ^^)
     * 
     * $GD_VERSION : Peut prendre la valeur 1 ou 2 selon la version de la librairie GD install� sur le serveur
     * 
     */
    var $GD_VERSION=2; 
    var $colorsToWork = 256; 

    function ImageFilter()
    {
        $this->resourceImage=NULL;
    }
	
    /**
	 * Color to work
	 *
	 * @param int $nb = nombre de couleur
     */
	function setColorsToWork($nb)
    {
        $this->colorsToWork=$nb;
    }
    
    function clear()
    {
        imagedestroy($this->resourceImage);
    }
    
    /**
     * Cr�ation d'une image vierge 
	 *
     * @param float $w =largeur 
     * @param float $h =hauteur
     */
    function createImage($w,$h)
    {
        $this->resourceImage = $this->imagecreate($w,$h);
    }
    
    /**
     * Chargement d'une image depuis un fichier
     *
	 * @param string $path =chemin 
     */
    function loadImage($path)
    {
        $this->resourceImage = $this->loadImageFile($path);
        return is_resource($this->resourceImage);
    }
    
    /**
     * M�thode priv� (pas vraiment possible en PHP4) g�rant l'ouverture et la mise en m�moire d'une image depuis un fichier
     * utilis� entre autre par loadImage(...)  et Stamp(...)
     *
	 * @param string $path =chemin
     */
    function loadImageFile($path)
    {
        $info=getimagesize($path);
        switch($info[2])
        {
            case 3 :
                return imagecreatefrompng($path);
            case 2 :
                return imageCreateFromJpeg($path);
            case 1 :
                return imagecreatefromgif($path);
            default : 
                return false;
        }
    }
    
    /**
     * M�thode de lecture des dimension de l'image actuellement en court de traitement
     * il est aussi possible de lui passer en param�tre un objet de type image
     *
	 * @param string $img = image
     */
    function getImageSize($img=NULL)
    {
        if(is_resource($img))
        {
            return array(
                'w'=>imagesx($img),
                'h'=>imagesy($img)
            );
        }
        else
        {
            return array(
                'w'=>imagesx($this->resourceImage),
                'h'=>imagesy($this->resourceImage)
            );
        }
    }

    /**
     * M�thode de sorti
     * Il est possible de g�n�rer soit des PNG soit des JPEG (gestion du niveau de qualit�)
     * l'image peut soit �tre envoy� soit en flux direct, soit enregistr� dans un fichier
     * ex:
     * $IF->output('JPEG',NULL,NULL,80); // JPEG Q80 en flux direct
     * $IF->output('JPEG','cache.jpg',false,80); // JPEG Q80 enregistr� dans cache.jpg sans �crasement si d�j� existant
	 * @param string $type = type
	 * @param string $file = fichier
	 * @param string $overwrite = autre ecriture
	 * @param string $JPG_Q = jpg
     */
    function output($type='PNG',$file=NULL,$overwrite=true,$JPG_Q=90)
    {

        if($file==NULL)
        {
			header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
            header('Pragma: no-cache');
            switch($type)
            {
                case 'PNG' :
                    header ('Content-type: image/png');
                    imagepng($this->resourceImage);
                    return true;
                case 'JPEG' : 
                    header ('Content-type: image/jpeg');
                    imagejpeg($this->resourceImage,NULL,$JPG_Q);
                    return true;
                default :
                    return false;
            }
        }
        else
        {
			if($overwrite or !file_exists($file))
            {
				if (file_exists($file)){
					unlink($file);
				}

                switch($type)
                {
                    case 'PNG' :
                        return imagepng($this->resourceImage,$file);
                    case 'JPEG' : 
                        return imagejpeg($this->resourceImage,$file,$JPG_Q);
                    default :
                        return false;
                }
            }
        }
    }
    
    /**
     * M�thode de d�coupe
     * ex
     * $IF->crop(10,10,50,50) // d�coupe l'image courante depuis le point 10,10 sur une zone de 50x50 pixel
     * l'image courante devient l'�l�ment d�coup�
	 *
	 * @param float $X = nouveau longeur
	 * @param float $Y = nouveau hauteur 
	 * @param float $WIDTH = longeur 
	 * @param float $HEIGHT = hauteur 
     */
    function crop($X,$Y,$WIDTH,$HEIGHT)
    {
        if(min($WIDTH,$HEIGHT)==0)
            return false;

        $img2=$this->imagecreate($WIDTH,$HEIGHT);
        $this->imagecopyresampled($img2,$this->resourceImage,0,0,$X,$Y,$WIDTH,$HEIGHT,$WIDTH,$HEIGHT);
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
        return true;
    }
    
    /**
     * M�thode de redimensionnement.
     * 
     * Les deux param�tre $WIDTH et $HEIGHT peuvent �tre pr�cis� soit en pixel (70) soit en % ('70%')
     * 
     * 3 mode sont possibles : "force", "crop" ou "ratio"
     *    - force = par d�formation
     *    - crop = par recadrage au centre
     *    - ratio = par conservation de l'aspect ratio ($WIDTH et $HEIGHT = Boite de travail) 
     * 
     * Le param�tre expand permet de pr�ciser si les agrandissement sont autoris�
	 *
	 * @param string $EXPAND
	 * @param string $MODE = mode
	 * @param float $WIDTH = longeur 
	 * @param float $HEIGHT = hauteur 
    **/
    function resize($WIDTH,$HEIGHT,$MODE='force',$EXPAND=false)
    {

        $info=$this->getImageSize();
        $imgWidth=$info['w'];
        $imgHeight=$info['h'];

        $ratio=$imgWidth/$imgHeight;
    
        //gestion des dimension en %
        if(strpos($WIDTH,'%',0))
            $WIDTH=$imgWidth * $WIDTH / 100;
        if(strpos($HEIGHT,'%',0))
            $HEIGHT=$imgHeight * $HEIGHT / 100;
    
        //si pas de dimension pr�cis�es alors echec
        if($WIDTH==0 && $HEIGHT==0)
            return false;
            
        //si jamais une dimension = 0 on d�termine la valeur la plus appropri�.
        if(min($WIDTH,$HEIGHT)==0)
        {
            switch($MODE)
            {
                case 'crop' : //on coupe en carr�
                    $WIDTH=$HEIGHT=max($WIDTH,$HEIGHT);
                    break;
                    
                case 'force': //on passe en ratio pour �viter les d�formation
                    //$MODE='ratio';
                    break;
                    
                case 'ratio' : //on prend une taille tr�s grand pour ne pas limiter sur la cote non pr�cis�
                    if($WIDTH==0)
                        $WIDTH=9999;
                    else
                        $HEIGHT=9999;                    
                    break;
                    
                default :
                    break;
            }
        }
        
        //on d�termine les dimension du resize ($_w et $_h)
        if($MODE=='ratio')
        {
            $_w=99999;
            if($HEIGHT>0)
            {
                $_h=$HEIGHT;
                $_w=$_h*$ratio;
            }
            if($WIDTH>0 && $_w>$WIDTH)
            {
                $_w=$WIDTH;
                $_h=$_w/$ratio;
            }
            
            if(!$EXPAND && $_w>$imgWidth)
            {
                $_w=$imgWidth;
                $_h=$imgHeight;
            }
        }
        else
        {
            //par d�coupage de l'image source
            $_w=$WIDTH;
            $_h=$HEIGHT;
        }
        
		if($MODE == 'fixed'){
            $_w=$WIDTH;
            $_h=$HEIGHT;
			
			if ($_w/$_h > $ratio) {
			   $_w = $_h*$ratio;
			} else {
			   $_h = $_w/$ratio;
			}
		}


        if($MODE=='force')
        {
            if(!$EXPAND && $_w>$imgWidth)
                $_w=$imgWidth;
            if(!$EXPAND && $_h>$imgHeight)                
                $_h=$imgHeight;
            
            $cropW=$imgWidth;
            $cropH=$imgHeight;
            $decalW=0;
            $decalH=0;
        }
        else //crop
        {
            //on d�termine ensuite la zone d'affiche r�el pour l'image    
            $innerRatio=$_w/$_h;
            if($ratio>=$innerRatio)
            {
                $cropH=$imgHeight;
                $cropW=$imgHeight*$innerRatio;
                $decalH=0;
                $decalW=($imgWidth-$cropW)/2;
            }
            else
            {
                $cropW=$imgWidth;
                $cropH=$imgWidth/$innerRatio;
                $decalW=0;
                $decalH=($imgHeight-$cropH)/2;
            }
        }

        //$img2=$this->imagecreate($_w,$_h);
		$img2 = imagecreatetruecolor($_w, $_h);
        $this->imagecopyresampled($img2,$this->resourceImage,0,0,$decalW,$decalH,$_w,$_h,$cropW,$cropH);
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
        return true;
    }

    /**
     * M�thode de remplissage (outils pot de peinture ^^)
     * $IF->fill(10,10,255,255,255) //on rempli au point 10,10 avec du blanc
	 *
	 * @param float $x
	 * @param float $y
	 * @param float $r
	 * @param float $g
	 * @param float $b
     */
    function fill($x,$y,$r,$g,$b)
    {
        $col=imagecolorallocate($this->resourceImage,$r,$g,$b);
        imagefill($this->resourceImage,$x,$y,$col);
    }
    
    /**
     * M�thode de correction de la luminosit� et du contraste
     * $IF->lightContrast(10,50) // L et C de -100 � 100
     *
	 * @param string $L luminosite
	 * @param string $C contraste
     */
    function lightContrast($L=0,$C=0)
    {
        if($this->GD_VERSION==2)
            imagetruecolortopalette($this->resourceImage, true, $this->colorsToWork);

        $numColors = imagecolorstotal($this->resourceImage);
        
        for ($x=0; $x<$numColors; $x++)
        {
            $src_colors     = imagecolorsforindex($this->resourceImage,$x);
            $r=$src_colors["red"];
            $g=$src_colors["green"];
            $b=$src_colors["blue"];
            
            //Contraste:
            $r = round($r + $C / 100 * ($r-127));
            $g = round($g + $C / 100 * ($g-127));
            $b = round($b + $C / 100 * ($b-127));
            
            //Luminosit� :
            $r = round($r * ( 1 + $L / 100));
            $g = round($g * ( 1 + $L / 100));
            $b = round($b * ( 1 + $L / 100));
            
            $r = max(0,min(255,$r));
            $g = max(0,min(255,$g));
            $b = max(0,min(255,$b));
            
            imagecolorset($this->resourceImage,$x,$r,$g,$b);
        }
        $this->palettedToTrueColor();
        return true;
    }
    
    /**
     * G�n�re le n�gatif de l'image courante
     *
     */
    function negative()
    {
        if($this->GD_VERSION==2)
            imagetruecolortopalette($this->resourceImage, true, $this->colorsToWork);

        $numColors = imagecolorstotal($this->resourceImage);
        
        for ($x=0; $x<$numColors; $x++)
        {
            $src_colors     = imagecolorsforindex($this->resourceImage,$x);
            $r              = min(255,255-$src_colors["red"]);
            $g              = min(255,255-$src_colors["green"]);
            $b              = min(255,255-$src_colors["blue"]);
            imagecolorset($this->resourceImage,$x,$r,$g,$b);
        }
        $this->palettedToTrueColor();
        return true;
    }
    
    /**
     * Modification de teinte sur l'image courante
     * whiteness = correction de la luminosit� (un d�calage peut �tre introduit lors du changement de teinte)
     * decal R,G,B = d�calage de teinte sur les 3 cannaux
     *
	 * @param string $whiteness luminosite
	 * @param string $decalR decal red
	 * @param string $decalG decal green
	 * @param string $decalB decal blue
     */
    function colorize($whiteness, $decalR, $decalG, $decalB)
    {
        if($this->GD_VERSION==2)
            imagetruecolortopalette($this->resourceImage, true, $this->colorsToWork);
            
        $numColors = imagecolorstotal($this->resourceImage);
        
        for ($x=0; $x<$numColors; $x++)
        {
            $src_colors     = imagecolorsforindex($this->resourceImage,$x);
            $luminance        = ($src_colors["red"]+$src_colors["green"]+$src_colors["blue"])/3;
            $r              = max(0,min(255,$src_colors["red"]+$decalR));
            $g              = max(0,min(255,$src_colors["green"]+$decalG));
            $b              = max(0,min(255,$src_colors["blue"]+$decalB));

            $luminance2        = ($r+$g+$b)/3;
            $r                = max(0,min(255,$r*($luminance/$luminance2)+3+$whiteness));
            $g                = max(0,min(255,$g*($luminance/$luminance2)+3+$whiteness));
            $b                = max(0,min(255,$b*($luminance/$luminance2)+3+$whiteness));

            imagecolorset($this->resourceImage,$x,$r,$g,$b);
        }
        $this->palettedToTrueColor();
        return true;
    }
    
    /**
     * D�saturation de l'image courante
     *
	 * @param int $taux taux
     */
    function grayscale($taux=1)
    {
        if($this->GD_VERSION==2)
            imagetruecolortopalette($this->resourceImage, true, $this->colorsToWork);
            
        $numColors = imagecolorstotal($this->resourceImage);
        
        for ($x=0; $x<$numColors; $x++)
        {
            $src_colors     = imagecolorsforindex($this->resourceImage,$x);
            $new_color      = min(255, abs( ( $src_colors["red"] + $src_colors["green"] + $src_colors["blue"] ) / 3 ) + 3 );
            $r                = min(255, abs( $src_colors["red"]   * (1 - $taux)  + $new_color * $taux ) );
            $g                = min(255, abs( $src_colors["green"] * (1 - $taux)  + $new_color * $taux ) );
            $b                = min(255, abs( $src_colors["blue"]  * (1 - $taux)  + $new_color * $taux ) );
            imagecolorset($this->resourceImage,$x,$r,$g,$b);
        }
        $this->palettedToTrueColor();
        return true;
    }
    
    /**
     * Modification de teinte pr�-r�gl� pour r�aliser l'effet sepia
     *
     */
    function sepia()
    {
        $this->grayscale();
        return $this->colorize(10, 255, 60, -10);
    }
    
    /**
     * Pixelisation de l'image courante � la taille choisit
     * Par d�fault la mosaic sera carr� $w=$h mais il est possible en pr�cisant 2 param�tre de g�n�rer des blocs r�ctangulaires
     *
	 * @param float $wSize longeur size
	 * @param float $hSize hauteur size
     */
    function mosaic($wSize,$hSize=0)
    {
        if($hSize<=0)
        {
            $hSize=$wSize;
        }

        if($wSize>0 and $hSize>0)
        {
            $info=$this->getImageSize();
            $imgWidth=$info['w'];
            $imgHeight=$info['h'];
            
            $imgWidth2=floor($imgWidth/$wSize);
            $imgHeight2=floor($imgHeight/$hSize);
            
            $img2=$this->imagecreate($imgWidth2,$imgHeight2);
            imagecopyresized($img2,$this->resourceImage,0,0,0,0,$imgWidth2,$imgHeight2,$imgWidth,$imgHeight);
            imagecopyresized($this->resourceImage,$img2,0,0,0,0,$imgWidth,$imgHeight,$imgWidth2-1,$imgHeight2-1);
            imagedestroy($img2);

            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Application d'un tampon sur l'image courante.
     *
     * le tampon peut �tre soit un objet image (g�n�r� ou non via la classe ImageFilter), soit un fichier 
     * (meilleur m�thode pour pr�server les couleurs et transparence)
     *
     * x et y d�termine le point d'aplication du tampon
     * 
     * 6 mode  de fusion sont disponibles (tous les mode respecte la couche alpha - si pr�sent)
     *    - normal = Pix1 <= Pix2
     *    - multiply = Pix1 <= Pix1*Pix2/255 (si Pix2 = 255 = Blanc pas de changement)
     *    - add = Pix1 <= Pix1+Pix2
     *    - difference = Pix1 <= Abs(Pix1-Pix2)
     *    - lighten = Pix1 <= max(Pix1,Pix2)
     *    - darken = Pix1 <= min(Pix1,Pix2)
	 *
	 * @param string $img image
	 * @param float $x
	 * @param float $y
 	 * @param string $mode mode de l'image
     *
	*/
    function stamp($img,$x,$y,$mode='normal')
    {
        $deleteRes=false;
        if(!is_resource($img))
        {
            $img=$this->loadImageFile($img);
            $deleteRes=true;
        }
        $this->palettedToTrueColor();
        $info=$this->getImageSize($img);
        
        if($mode=='normal')
        {
            $this->imagecopyresampled($this->resourceImage,$img,$x,$y,0,0,$info['w'],$info['h'],$info['w'],$info['h']);
        }
        else
        {
            $infOrg=$this->getImageSize($this->resourceImage);
            $img2=$this->imagecreate($infOrg['w'],$infOrg['h']);
            imagecopy($img2,$this->resourceImage,0,0,0,0,$infOrg['w'],$infOrg['h']);

            switch($mode)
            {
                case 'multiply':
                    for($px=0;$px<$info['w'];$px++)
                    {
                        for($py=0;$py<$info['h'];$py++)
                        {
                            $rgb1=imagecolorat($this->resourceImage,$px+$x,$py+$y);
                            $rgb1=imagecolorsforindex($this->resourceImage,$rgb1);
                            $rgb2=imagecolorat($img,$px,$py);
                            $rgb2=imagecolorsforindex($img,$rgb2);
                                
                            $r=min(255,max(0,$rgb1['red']   * max($rgb2['red']   , 2*$rgb2['alpha']) /255 ));
                            $g=min(255,max(0,$rgb1['green'] * max($rgb2['green'] , 2*$rgb2['alpha']) /255 ));
                            $b=min(255,max(0,$rgb1['blue']  * max($rgb2['blue']  , 2*$rgb2['alpha']) /255 ));
                            
                            $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                            imagesetpixel($img2,$px+$x,$py+$y,$cols[$r][$g][$b]);
                        }
                    }
                    break;
                    
                case 'add':
                    for($px=0;$px<$info['w'];$px++)
                    {
                        for($py=0;$py<$info['h'];$py++)
                        {
                            $rgb1=imagecolorat($this->resourceImage,$px+$x,$py+$y);
                            $rgb1=imagecolorsforindex($this->resourceImage,$rgb1);
                            $rgb2=imagecolorat($img,$px,$py);
                            $rgb2=imagecolorsforindex($img,$rgb2);
                                
                            $r=min(255,max(0,$rgb1['red']   + $rgb2['red']   * (127-$rgb2['alpha'])/127  ));
                            $g=min(255,max(0,$rgb1['green'] + $rgb2['green'] * (127-$rgb2['alpha'])/127  ));
                            $b=min(255,max(0,$rgb1['blue']  + $rgb2['blue']  * (127-$rgb2['alpha'])/127  ));
                            
                            $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                            imagesetpixel($img2,$px+$x,$py+$y,$cols[$r][$g][$b]);
                        }
                    }
                    break;
    
                case 'difference':
                    for($px=0;$px<$info['w'];$px++)
                    {
                        for($py=0;$py<$info['h'];$py++)
                        {
                            $rgb1=imagecolorat($this->resourceImage,$px+$x,$py+$y);
                            $rgb1=imagecolorsforindex($this->resourceImage,$rgb1);
                            $rgb2=imagecolorat($img,$px,$py);
                            $rgb2=imagecolorsforindex($img,$rgb2);
                                
                            $r=min(255,max(0, abs($rgb1['red']   - $rgb2['red']   * (127-$rgb2['alpha'])/127 ) ));
                            $g=min(255,max(0, abs($rgb1['green'] - $rgb2['green'] * (127-$rgb2['alpha'])/127 ) ));
                            $b=min(255,max(0, abs($rgb1['blue']  - $rgb2['blue']  * (127-$rgb2['alpha'])/127 ) ));
                            
                            $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                            imagesetpixel($img2,$px+$x,$py+$y,$cols[$r][$g][$b]);
                        }
                    }
                    break;
                    
                case 'lighten':
                    for($px=0;$px<$info['w'];$px++)
                    {
                        for($py=0;$py<$info['h'];$py++)
                        {
                            $rgb1=imagecolorat($this->resourceImage,$px+$x,$py+$y);
                            $rgb1=imagecolorsforindex($this->resourceImage,$rgb1);
                            $rgb2=imagecolorat($img,$px,$py);
                            $rgb2=imagecolorsforindex($img,$rgb2);
                                
                            $r=max($rgb1['red'],$rgb2['red']);
                            $g=max($rgb1['green'],$rgb2['green']);
                            $b=max($rgb1['blue'],$rgb2['blue']);
                            
                            $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                            imagesetpixel($img2,$px+$x,$py+$y,$cols[$r][$g][$b]);
                        }
                    }
                    break;
                    
                case 'darken':
                    for($px=0;$px<$info['w'];$px++)
                    {
                        for($py=0;$py<$info['h'];$py++)
                        {
                            $rgb1=imagecolorat($this->resourceImage,$px+$x,$py+$y);
                            $rgb1=imagecolorsforindex($this->resourceImage,$rgb1);
                            $rgb2=imagecolorat($img,$px,$py);
                            $rgb2=imagecolorsforindex($img,$rgb2);
                                
                            $r=min($rgb1['red'],$rgb2['red']);
                            $g=min($rgb1['green'],$rgb2['green']);
                            $b=min($rgb1['blue'],$rgb2['blue']);
                            
                            $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                            imagesetpixel($img2,$px+$x,$py+$y,$cols[$r][$g][$b]);
                        }
                    }
                    break;
            }
            imagedestroy($this->resourceImage); //on supprime l'image d'origine
            $this->resourceImage=$img2; // et on la remplace par la version modifi�
        }
        if($deleteRes)
        {
            //on supprime l'image temporaire
            imagedestroy($img);
        }
        return true;
    }
    
    /**
     * On repasse en mode couleur vrai (24bits)
     * !!! peut entrainer la suppression de la couche alpha
     *
     */
    function palettedToTrueColor()
    {
        $info=$this->getImageSize();
        $img2=$this->imagecreate($info['w'],$info['h']);
        $this->imagecopyresampled($img2,$this->resourceImage,0,0,0,0,$info['w'],$info['h'],$info['w'],$info['h']);
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
    }
    
    /**
     * Application d'un filtre 3x3
     * en fonction des param�tres il est alors possible de r�aliser des passes hauts, passes bas, etc...
     *
	 * @param string $matrix
     */
    function applyMatrix3x3($matrix)
    {
        $info=$this->getImageSize();
        $img2=$this->imagecreate($info['w']-2,$info['h']-2);
        
        for($x=1;$x<$info['w']-1;$x++)
        {
            for($y=1;$y<$info['h']-1;$y++)
            {
                $r=$g=$b=0;
    
                for($Mx=0;$Mx<3;$Mx++)
                {
                    for($My=0;$My<3;$My++)
                    {
                        $rgb=imagecolorat($this->resourceImage,$x-1+$Mx,$y-1+$My);
                    
                        $r += $matrix[$Mx][$My]*(($rgb >> 16) & 0xFF); //r
                        $g += $matrix[$Mx][$My]*(($rgb >>  8) & 0xFF); //g
                        $b += $matrix[$Mx][$My]*(($rgb      ) & 0xFF); //b
                    }
                }
                $r=min(255,max(0,$r));
                $g=min(255,max(0,$g));
                $b=min(255,max(0,$b));
                
                if(!isset($cols[$r][$g][$b]))
                {
                    //on minimise les allocation de couleur
                    $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                }
                imagesetpixel($img2,$x-1,$y-1,$cols[$r][$g][$b]);
            }
        }
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
    }
    
    /**
     * Utilisation du filtre matriciel pour faire un floutage (passe bas)
     *
	 * @param int $k
     */
    function Blur($k=1)
    {
        $k*=1/9;
        return $this->applyMatrix3x3(array(
                                        array($k,$k,$k),
                                        array($k,1-9*$k,$k),
                                        array($k,$k,$k)
                                    ));
    }

    /**
     * Utilisation du filtre matriciel pour une detection de contour
     *
	 * @param int $k
     */
    function Edge($k=1)
    {
        return $this->applyMatrix3x3(array(
                                        array(0,-$k,0),
                                        array(-$k,1-$k,$k),
                                        array(0,$k,0)
                                    ));
    }

    /**
     * M�thode bas� sur le filtre matriciel optimis� pour r�aliser une accentuation de d�tail (passe haut)
     *
	 * @param int $k
     */
    function Sharpen($k=1)
    {
        $info=$this->getImageSize();
        
        $img2=$this->imagecreate($info['w']-2,$info['h']-2);
        for($x=1;$x<$info['w']-1;$x++)
        {
            for($y=1;$y<$info['h']-1;$y++)
            {
                $rgb[1][0]=imagecolorat($this->resourceImage,$x,$y-1);
                $rgb[0][1]=imagecolorat($this->resourceImage,$x-1,$y);
                $rgb[1][1]=imagecolorat($this->resourceImage,$x,$y);
                $rgb[2][1]=imagecolorat($this->resourceImage,$x+1,$y);
                $rgb[1][2]=imagecolorat($this->resourceImage,$x,$y+1);

                $r =      -$k *(($rgb[1][0] >> 16) & 0xFF) +
                         -$k *(($rgb[0][1] >> 16) & 0xFF) +
                    (1+4*$k) *(($rgb[1][1] >> 16) & 0xFF) +
                         -$k *(($rgb[2][1] >> 16) & 0xFF) +
                         -$k *(($rgb[1][2] >> 16) & 0xFF) ;

                $g =      -$k *(($rgb[1][0] >> 8) & 0xFF) +
                         -$k *(($rgb[0][1] >> 8) & 0xFF) +
                    (1+4*$k) *(($rgb[1][1] >> 8) & 0xFF) +
                         -$k *(($rgb[2][1] >> 8) & 0xFF) +
                         -$k *(($rgb[1][2] >> 8) & 0xFF) ;

                $b =      -$k *($rgb[1][0] & 0xFF) +
                         -$k *($rgb[0][1] & 0xFF) +
                    (1+4*$k) *($rgb[1][1] & 0xFF) +
                         -$k *($rgb[2][1] & 0xFF) +
                         -$k *($rgb[1][2] & 0xFF) ;

                $r=min(255,max(0,$r));
                $g=min(255,max(0,$g));
                $b=min(255,max(0,$b));

                if(!$cols[$r][$g][$b])
                {
                    //on minimise les allocation de couleur
                    $cols[$r][$g][$b]=imagecolorallocate($img2,$r,$g,$b);
                }
                imagesetpixel($img2,$x-1,$y-1,$cols[$r][$g][$b]);
            }
        }
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
        return true;
    }
    
    /**
     * Op�ration de mirroir sur l'image (horizontale ou vertical)
     * type de flip h > horizontal, v > vertical
     *
	 * @param string $flip
     */
    function flip($flip='h')
    {
        $info = $this->getImageSize();
        $img2 = $this->imagecreate($info['w'],$info['h']);
        
        if ( $flip == 'v' )
        {
            for ( $i=0; $i<$info['h']; $i++ ) imagecopy($img2,$this->resourceImage,0,$info['h']-1-$i,0,$i,$info['w'],1);
        }
        elseif ( $flip == 'h' )
        {
            for ( $i=0; $i<$info['w']; $i++ ) imagecopy($img2,$this->resourceImage,$info['w']-1-$i,0,$i,0,1,$info['h']);
        }
        else return false;
        
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
        
        return true;
    }
    
    /**
     * Op�ration rotation
     * angle de rotation (90�, 180�, 270�)
     *
	 * @param int $angle angle
     */
    function rotation($angle=90)
    {
        $this->palettedToTrueColor();
        
        $info = $this->getImageSize();
        $img2 = $angle == 180 ? $this->imagecreate($info['w'],$info['h']) : $this->imagecreate($info['h'],$info['w']);
        
        switch ( $angle )
        {
            case 180 :
                for ( $j=0; $j<$info['h']; $j++)
                {
                    for ( $i=0; $i<$info['w']; $i++ )
                    {
                        $c = imagecolorat($this->resourceImage,$i,$j);
                        imagesetpixel($img2,$info['w']-$i-1,$info['h']-$j-1,$c);
                    }
                }                
            break;
            
            case 270 :
                for ( $j=0; $j<$info['h']; $j++ )
                {
                    for ( $i = $info['w']; $i>=0; $i-- )
                    {
                        $c = imagecolorat($this->resourceImage,$i,$j);
                        imagesetpixel($img2,$j,$info['w']-$i-1,$c);
                    }
                }
            break;
            
            case 90 :
                for ( $i = 0; $i<$info['w']; $i++ )
                {
                    for ( $j=0; $j<$info['h']; $j++ )
                    {
                        $c  = imagecolorat($this->resourceImage,$i,$j);
                        imagesetpixel($img2,$info['h']-$j-1,$i,$c);
                    }
                }
            break;
            
            default:
                return false;
            break;
        }
        
        imagedestroy($this->resourceImage);
        $this->resourceImage=$img2;
        
        return true;
    }    
    
    /**
     * M�thode permettant l'execution automatique d'une s�rie de m�thode.
     *
     * $commands=array(
     *     array('filter'=>'loadImage','params'=>array('test.png')),
     *    array('filter'=>'resize','params'=>array('200%','','force',true)),
     *    array('filter'=>'sepia','params'=>array()),
     *    array('filter'=>'mosaic','params'=>array(3)),
     *    array('filter'=>'flip','params'=>array('h')),
     *    array('filter'=>'stamp','params'=>array('testStamp.png',0,0)),
     *    array('filter'=>'rotation','params'=>array('90')),
     *    array('filter'=>'stamp','params'=>array('test.png',0,0,'multiply')),
     *    array('filter'=>'lightContrast','params'=>array(0,100)),
     *    array('filter'=>'output','params'=>array('PNG'))
     * );
     *
     * $IF->batchFilter($commands);
     * 
	 * @param string $commands
     **/
    function batchFilter($commands)
    {
        foreach($commands as $command)
        {
            if(method_exists($this,$command['filter']))
            {
                 call_user_method_array($command['filter'],$this,$command['params']);
            }
        }
        return true;
    }
    
    /**
     * M�thode de redimesionnement selon la version de librairie GD (1 ou 2)
     * GD 1.x ne g�rant pas les images 24bits, elle ne fait pas de r�-�chantillonnage sur les redimensionnemnt
     *
	 * @param string $out
	 * @param string $in
	 * @param float $dstX
	 * @param float $dstY
	 * @param float $srcX
	 * @param float $srcY
	 * @param float $dstW
	 * @param float $dstH
	 * @param float $srcW
	 * @param float $srcH
     */
    function imagecopyresampled($out, $in, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH)
    {
        if($this->GD_VERSION==2)
            return imagecopyresampled($out, $in, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
        else
            return imagecopyresized($out, $in, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
    }

    /**
     * M�thode de cr�ation d'image  selon la version de librairie GD (1 ou 2)
     * GD 1.x ne g�re pas les images en 24bits on cr�e alors une image 256 couleurs
     *
	 * @param float $w longeur
	 * @param float $h hauteur
     */    
    function imagecreate($w,$h)
    {
        if($this->GD_VERSION==2)
            return imagecreatetruecolor($w,$h);
        else
            return imagecreate($w,$h);
    }
}
?>
