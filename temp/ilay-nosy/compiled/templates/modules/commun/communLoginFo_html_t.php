<?php 
function template_meta_788f48cdf8434843e43d1a9e97dbb9dd($t){

return $t->_meta;
}
function template_788f48cdf8434843e43d1a9e97dbb9dd($t){
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
	                    <?php echo $t->_vars['breadcrumbs']; ?>
						<!--h1>actualit&eacute;s internationales </h1-->
                        <div id="leftColumn">
                        	<?php echo $t->_vars['leftPageHowTop']; ?>
	                        <?php echo $t->_vars['homePageAnnonceRencontre']; ?>
	                    	                            
                        </div><!-- leftColumn:[end] -->
                        
                        <div id="middleContent">
                        	<?php echo $t->_vars['contentPageMainLogin']; ?>
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