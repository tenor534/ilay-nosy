		<!-- Zone haut publicitaire -->    
    <div id="mastAdvertWrap">  
    	{$logo}  
    	{$mastAdvert}  
    </div><!--  mastAdvertWrap: [end] -->    
    
	<div id="bodyWrap">    
   		<div id="wrapper" class="news">
        
			<div id="mastHead">
		    	{$logInWrap}  
				<div id="mainZoneRight">
                	{$searchNav}
                    {$mainNavWrap}
                </div>
			</div><!-- mastHead: [end] -->
		
			<div id="neapolitan">
            	
				<div id="neapolitanTop">
                	<img src="{$j_basepath}design/front/images/v5/cornerTopLeft.gif" alt="" />
                </div><!--neapolitanTop: [end] -->
               
				<div id="main" class="fullWhite">
                	
                	<div id="white">      
	                    {$breadcrumbs}
                       <div id="middleContent">
                            <div class="row" id="mainNews">
                            
	                            <div class="header">
                                	<h3>Actualit&eacute;s</h3>
                                </div><!-- header:[end] -->
                                <div class="singleColumnBig">                                
                                    <div id="contentPageMain">
									{$contentPageMain}
                                    </div>
                                    <div id="contentPageComment">
                                    {$contentPageComment}                                    
                                    </div>
                                </div><!-- :[end] -->
            
                            </div><!-- mainStory:[end] -->                         

                        	
                        </div><!-- middleColumn:[end] -->                                                                      
                	</div><!-- end white -->  
                    
                    <div id="brown">
                    	{*$innerPageAdSpace*}    
                        {$innerPageNew}       
                        {$innerPagePetiteAnnonce} 
						<div id="adRightFo">
                            {*$innerPagePratique*}  
                           	{$innerPageAnnonceVehicule}
                           	{$innerPageAnnonceImmobilier}
                           	{$innerPageAnnonceEmploi}
                           	{$innerPageAnnonceAutres}
                        </div><!--adRightFo: [end]-->                            
                    	{*$innerPageAdSpaces*}
                    </div><!--end brown -->   
                    
                </div>
                
                {$bootFoot}        
              