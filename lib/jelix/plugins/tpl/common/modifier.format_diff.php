<?php
/**
 * Plugin from smarty project and adapted for jtpl
 * @package    jelix
 * @subpackage jtpl_plugin
 * @author
 * @contributor Njaka MISAHARISON
 * @copyright  2007 Njaka MISAHARISON
 * @link http://gasyleiss.free.fr
 * @link http://gasyleiss.free.fr
 * @licence   GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
 */

/**
 * modifier plugin :  Formate la différence de 2 dates en 'jr h mn s'(jour, heure, minute, seconde)
 *
 * Formate un nombre résultant de la diffénrece de 2 dates pour avoir la forme Xjr Yh Zmn As
 * @param integer
 * @return string
 */
function jtpl_modifier_common_format_diff($seconde)
{
 	if ($seconde < 60) {//secondes		
		$result = $seconde."s";
	}else{
		if ($seconde >= 60 && $seconde < 3600) //minutes
		{
			$minute	 = intval($seconde/60);	
			$seconde = 	$seconde % 60;			
			$result = $seconde > 0 ? $minute."mn ". $seconde."s" :$minute."mn";
		}else{ //heure
			
			if ($seconde >=3600 && $seconde < 86400) {
				$hour = intval($seconde/3600); 
				$seconde = $seconde % 3600 ; 
				
				if ($seconde < 60)
				{	
					$result = $seconde > 0 ? $hour."h ".$seconde. "s" : $hour."h ";
				}else{				
					$minute = intval($seconde/ 60);
					$seconde = $seconde % 60;
					$result = $seconde > 0 ? $hour."h ".$minute."mn ".$seconde. "s" : $hour."h ".$minute."mn";							
				}
			}else { //jour
				$jour = intval($seconde / 86400);
				$seconde = $seconde % 86400;					
				if ($seconde < 60)
				{	
					$result = $seconde > 0 ? $jour . "jr ".$seconde. "s" : $jour . "jr";
				}else{	
							
					if ($seconde >= 60 && $seconde < 3600) {
						$minute = intval($seconde / 60);				
						$seconde = $seconde % 60;
						$result = $seconde > 0 ? $jour . "jr ".$minute."mn ".$seconde. "s" : $jour . "jr ".$minute."mn";
					}else{
						//echo "sec:".$seconde."<br/>";	
						$hour = intval($seconde / 3600);
						$seconde = $seconde % 3600;
						if ($seconde < 60)
						{	
							$result = $seconde > 0 ? $jour . "jr ".$hour."h ".$seconde. "s" : $jour . "jr ".$hour."h";
						}else{	
									
							$minute = intval($seconde/ 60);	
							$seconde = $seconde % 60;
							$result = $seconde > 0 ? $jour . "jr ".$hour."h ".$minute."mn ".$seconde. "s" : $jour . "jr ".$hour."h ".$minute."mn";							
						}
					}
				}
				
			}
			
		}
	}
	return $result;
}
?>