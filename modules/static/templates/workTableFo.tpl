	<!-- Zone haut publicitaire -->    
    <div id="mastAdvertWrap">  
    	{$logo}  
    	{$mastAdvert}  
    </div><!--  mastAdvertWrap: [end] -->    
    
	<div id="bodyWrap">    
   		<div id="wrapper" class="home">
        	
			<div id="mastHead">
		    	{*$logInWrap*}  
				<div id="mainZoneRight">
                	{*$searchNav*}
                    {*$mainNavWrap*}
                </div>
			</div><!-- mastHead: [end] -->
			
			<div id="neapolitan">
				<div id="neapolitanTop">
                	<img src="{$j_basepath}design/front/images/v5/cornerTopLeft.gif" alt="" />
                </div><!--neapolitanTop: [end] -->
				<div id="main" class="fullWhite">
                	<div id="white">      
	                    {*$breadcrumbs*}
                       <div id="middleContent">
                            <div class="row" id="mainNews">
	                            <div class="header">
                                	<h3>{$titlePageMain}</h3>
                                </div><!-- header:[end] -->
                                <div class="singleColumnBig">

                                    <!--Pannel pour navigation en espace Culture-->
                                    {*}
                                    <div id="memberWrap" class="{$zMemberWrap}">
                                        <div id="memberNavWrap">
                                             <ul class="memberNav memberNav-example-animate current-about">
                                                 <li class="member_table"><a href="{jurl 'membre~membreFo_tableBord'}" title="Tableau de bord">Tableau de bord</a></li>
                                                 <li class="member_profil"><a href="{jurl 'membre~membreFo_profilDetail'}" title="Votre profil">Votre profil</a></li>
                                                 <li class="member_culture"><a href="{jurl 'culture~cultureFo_cultureList'}" title="Vos cultures">Vos cultures</a></li>
                                                 <li class="member_abonnement"><a href="{jurl 'abonnement~abonnementFo_abonnementList'}" title="Votre abonnement">Votre abonnement</a></li>
                                              </ul>
                                        </div><!-- searchNav: [end] -->
                                    </div>
                                    {*}
                                    <div id="contentPageMain">
									{$contentPageMain}
                                    </div>

                                </div><!-- :[end] -->
            
                            </div><!-- mainStory:[end] -->                         

                        	
                        </div><!-- middleColumn:[end] -->                                                                      
                	</div><!-- end white -->  
                    <div id="brown">
                    	{$innerPageAdSpace} 
                        {$innerPagePetiteAnnonce}            
						<div id="adRightFo">
                           	{*$innerPageAnnonceVehicule}
                           	{$innerPageAnnonceImmobilier}
                           	{$innerPageAnnonceEmploi}
                           	{$innerPageAnnonceAutres*}
                            {*$innerPagePratique*}                                
                        </div><!--adRightFo: [end]-->                            
                    	{*$innerPageAdSpaces*}
                    </div><!--end brown -->   
                </div>
                {$bootWorkFoot}        