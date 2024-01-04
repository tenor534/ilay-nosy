<?php 
function template_meta_287f928570336f1d28e5771758c74894($t){

return $t->_meta;
}
function template_287f928570336f1d28e5771758c74894($t){
?>	<!-- Zone haut publicitaire -->    
    <div id="mastAdvertWrap">  
    	<?php echo $t->_vars['logo']; ?>  
    	<?php echo $t->_vars['mastAdvert']; ?>  
    </div><!--  mastAdvertWrap: [end] -->    
    
	<div id="bodyWrap">    
   		<div id="wrapper" class="home">
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
						<!--h1>actualit&eacute;s internationales </h1-->
                        <div id="leftColumn">
	                    	<?php echo $t->_vars['leftPageAdsTop']; ?>
                        	<?php echo $t->_vars['leftPageContactTop']; ?>
                        	<?php echo $t->_vars['leftPageHowTop']; ?>
							<?php echo $t->_vars['homePageNew']; ?>
                            <?php echo $t->_vars['homePageAnnonceRencontre']; ?>
							
							
	                    	<?php echo $t->_vars['leftPageAds']; ?>                            
                        </div><!-- leftColumn:[end] -->
                        
                        <div id="middleContent">
	                        <?php echo $t->_vars['contentPageMainAdverts']; ?>
	                        <?php echo $t->_vars['contentPageMainAnnounces']; ?>
                        	
                        	                            
                        </div><!-- middleColumn:[end] -->                                                                      
                	</div><!-- end white -->  
                    <div id="brown">
                    
                    	<?php echo $t->_vars['innerPageAdSpace']; ?>            
                         	<?php echo $t->_vars['innerPagePetiteAnnonce']; ?>
                           	                          
						<div id="adRightFo">
                           	<?php echo $t->_vars['innerPageAnnonceVehicule']; ?>
                           	<?php echo $t->_vars['innerPageAnnonceImmobilier']; ?>
                           	<?php echo $t->_vars['innerPageAnnonceEmploi']; ?>
                           	<?php echo $t->_vars['innerPageAnnonceAutres']; ?>
                                                            
                                                            
                        </div><!--adRightFo: [end]-->                            
                    	<?php echo $t->_vars['innerPageAdSpaces']; ?>
                    </div><!--end brown -->   
                </div>
                <?php echo $t->_vars['bootFoot']; ?>        <?php 
}
?>