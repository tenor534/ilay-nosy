<?php 
function template_meta_91cb52d1c02e72e13b8fef7c08e7f9ca($t){

return $t->_meta;
}
function template_91cb52d1c02e72e13b8fef7c08e7f9ca($t){
?>	<!-- Zone haut publicitaire -->    
    <div id="mastAdvertWrap">  
    	<?php echo $t->_vars['logo']; ?>  
    	<?php echo $t->_vars['mastAdvert']; ?>  
    </div><!--  mastAdvertWrap: [end] -->    
    
	<div id="bodyWrap">    
   		<div id="wrapper" class="announces">
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
                                	<h3>Vos annonces class&eacute;es</h3>
                                </div><!-- header:[end] -->
                                <div class="singleColumnBig">                                
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