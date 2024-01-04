<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_91ca4087a0fc82c602c828a1cca6fc63($t){

return $t->_meta;
}
function template_91ca4087a0fc82c602c828a1cca6fc63($t){
?>	<!-- Zone haut publicitaire -->    
    <div id="mastAdvertWrap">  
    	<?php echo $t->_vars['logo']; ?>  
    	<?php echo $t->_vars['mastAdvert']; ?>  
    </div><!--  mastAdvertWrap: [end] -->    
    
	<div id="bodyWrap">    
   		<div id="wrapper" class="progonline">
			<div id="mastHead">
		    	<?php echo $t->_vars['logInWrap']; ?>  
				<div id="mainZoneRight">
                	<?php echo $t->_vars['searchNav']; ?>
                    <?php echo $t->_vars['mainNavWrap']; ?>
                </div>
			</div><!-- mastHead: [end] -->
			
			<div id="neapolitan">
				<div id="neapolitanTop">
                	<img src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/v5/cornerTopLeft.gif" alt="" />
                </div><!--neapolitanTop: [end] -->
				<div id="main" class="fullWhite">
                	<div id="white">      
	                    <?php echo $t->_vars['breadcrumbs']; ?>
                       <div id="middleContent">
                            <div class="row" id="mainNews">
	                            <div class="header">
                                	<h3>Espace Membre</h3>
                                </div><!-- header:[end] -->
                                <div class="singleColumnBig">

                                    <!--Pannel pour navigation en espace Membre-->
                                    <div id="memberWrap" class="<?php echo $t->_vars['zMemberWrap']; ?>">
                                        <div id="memberNavWrap">
                                             <ul class="memberNav memberNav-example-animate current-about">
                                                 <li class="member_table"><a href="<?php jtpl_function_html_jurl( $t,'membre~membreFo_tableBord');?>" title="Tableau de bord">Tableau de bord</a></li>
                                                 <li class="member_profil"><a href="<?php jtpl_function_html_jurl( $t,'membre~membreFo_profilDetail');?>" title="Votre profil">Votre profil</a></li>
                                                 <li class="member_annonce"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceList');?>" title="Vos annonces">Vos annonces</a></li>
                                                 <li class="member_abonnement"><a href="<?php jtpl_function_html_jurl( $t,'abonnement~abonnementFo_abonnementList');?>" title="Votre abonnement">Votre abonnement</a></li>
                                              </ul>
                                        </div><!-- searchNav: [end] -->
                                    </div>
                                    <div id="contentPageMain">
									<?php echo $t->_vars['contentPageMain']; ?>
                                    </div>

                                </div><!-- :[end] -->
            
                            </div><!-- mainStory:[end] -->                         

                        	
                        </div><!-- middleColumn:[end] -->                                                                      
                	</div><!-- end white -->  
                    <div id="brown">
                    	       
                        <?php echo $t->_vars['innerPagePetiteAnnonce']; ?>     
						<div id="adRightFo">
                           	<?php echo $t->_vars['innerPageAnnonceVehicule']; ?>
                           	<?php echo $t->_vars['innerPageAnnonceImmobilier']; ?>
                           	<?php echo $t->_vars['innerPageAnnonceEmploi']; ?>
                           	<?php echo $t->_vars['innerPageAnnonceAutres']; ?>
                                                            
                        </div><!--adRightFo: [end]-->                            
                    	
                    </div><!--end brown -->   
                </div>
                <?php echo $t->_vars['bootFoot']; ?>        <?php 
}
?>