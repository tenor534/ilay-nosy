									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">D&eacute;tail de l' annonce</span> 
                                      	</p>          
   										<p style="clear: both;"></p>
									</div>
                                    
									<p style="clear: both;height:5px;"></p>
									<div id="viewCriteria">
                                    	<div class="headPan"> 
                                        	<span class="viewTitre">R&eacute;capitulatif de vos crit&egrave;res</span> 
                                        </div> 
                                    	<div class="middlePan">
	                                        <div class="blank">
		                                        <div class="content">
                                                    {if $cid}
                                                    <div class="criteria">
                                                        <span class="item">Cat&eacute;gorie:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=> $cid)}">{$zCid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $rid}
                                                    <div class="criteria">
                                                        <span class="item">Rubrique:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=> $rid)}">{$zRid}</a></span>
                                                    </div>
                                                    {/if}
                                            
                                                    {if $mot}
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('mot'=> $mot)}">{$zMot}</a></span>
                                                    </div>
                                                    {/if}        
                                                    {if $crid}
                                                    <div class="criteria">
                                                        <span class="item">Rubrique:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('crid'=> $crid)}">{$zCrid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $parution}
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('parution'=> $parution)}">depuis {$zParution}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $localite}
                                                    <div class="criteria">
                                                        <span class="item">Localit&eacute;:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('localite'=> $localite)}">{$zLocalite}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $province}
                                                    <div class="criteria">
                                                        <span class="item">Province:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('province'=> $province)}">{$zProvince}</a></span>
                                                    </div>
                                                    {/if}
                                            
                                                    {if $prix2}
                                                    <div class="criteria">
                                                        <span class="item">Prix entre:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('prix1'=> $prix1, 'prix2'=> $prix2)}">{$zPrix1} et {$zPrix2} Ar</a></span>
                                                    </div>
                                                    {/if}
                                            
                                                    {if $affichage}
                                                    <div class="criteria">
                                                        <span class="item">Affichage:</span>
                                                        <span class="value">{$zAffichage}</span>
                                                    </div>
                                                    {/if}
	                                         	</div>       
	                                        </div>                                     
                                        </div>                                     
                                    	<div class="footPan">
                                        	<span class="viewTitre">{$iNbEnreg} annonce{if $iNbEnreg > 1}s{/if} trouv&eacute;e{if $iNbEnreg > 1}s{/if}</span> 
                                        </div>                                     
                                    </div>                                    

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='annonceForm' name='annonceForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="annonce_id" name="annonce_id" value="{$annonce->annonce_id}">

                                            <div id="middleCol">
                                                <div class="box" id="box_annonce">
                                                    <div class="box_inner box_end box_annonce_top">

                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                                <li><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>$categorieAn->categorieAn_id)}">{$categorieAn->categorieAn_libelle}</a></li>
                                                                <li><span>&gt;</span> <a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=>$rubrique->rubrique_id)}">{$rubrique->rubrique_libelle}</a></li>
                                                                
                                                            </ul>
                                                        </div>                                                    
                                                        <div id="view_titre">
	                                                        <h1 class="txt_arrows">{$annonce->annonce_titre}</h1>
                                                        </div>
														<ul class="split">
                                                            {if $annonce->annonce_id != 0}
                                                                {if $iFirst}                                                
                                                                
                                                                    <li class="inline"><a class="link_d" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iFirst, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">D&eacute;but</a></li>                                                            
                                                                {/if}   
                                                                {if $iBack}                                                
                                                                    <li class="inline"><a class="link_p" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iBack, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Annonce pr&eacute;c&eacute;dente</a></li>                                                            
                                                                {/if}   
                                                                {if $iNext}                                                
                                                                    <li class="inline"><a class="link_s" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iNext, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Annonce suivante</a></li>                                                            
                                                                {/if}   
                                                                {if $iLast}                                                
                                                                    <li class="inline"><a class="link_f" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iLast, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Fin</a></li>                                                            
                                                                {/if}   
                                                            {/if}			
                                                            <li class="last inline"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_annonce_main_info">                                                    
                                                    
                                                        <div id="view_price" class="float">
                                                            <div class="info_list">
                                                            	{if $annonce->annonce_prix != 0}                                                
                                                                <dl class="price">
                                                                    <dt>Prix&nbsp;:</dt>
                                                                    <dd><div id="view_prix">{if $annonce->annonce_prix}{$annonce->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</div> <span>{$annonce->annonce_prixInfo}</span></dd>
                                                                </dl>
                                                                {/if}
                                                                <dl class="lieu">
                                                                    <dt>Lieu&nbsp;:</dt>
                                                                        {assign $zprovince = $zprovince->province_libelle}
                                                                        {assign $zlocalite = $zlocalite->localite_code . " " . $zlocalite->localite_libelle}
                                                                    <dd><div id="view_lieu">{$zprovince} <span class="date">{$zlocalite}</span></div></dd>
                                                                </dl>
                                                                
                                                                {if $annonce->annonce_annee != 0}
                                                                <dl>
                                                                    <dt>Ann&eacute;e&nbsp;:</dt>
                                                                    <dd><div id="view_annee">{if $annonce->annonce_annee}{$annonce->annonce_annee}{else}N/D{/if}</div></dd>
                                                                </dl>                                                
                                                                {/if}
                                                                {if $annonce->annonce_etat != 0} 
                                                                <dl>
                                                                    {assign $etat = ""}
                                                                    {if $toForfait->forfait_packId != 3} {*}PACK EMPLOI{*}                                                                    
                                                                        {if $annonce->annonce_etat == 1}{assign $etat = "Neuf"}{/if}
                                                                        {if $annonce->annonce_etat == 2}{assign $etat = "Usag&eacute;"}{/if}
                                                                        {if $annonce->annonce_etat == 3}{assign $etat = "Epave"}{/if}
                                                                        {if $annonce->annonce_etat == 0}{assign $etat = "S/O"}{/if}
                                                                     {else}
                                                                        {if $annonce->annonce_etat == 1}{assign $etat = "Tr&egrave;s urgent"}{/if}
                                                                        {if $annonce->annonce_etat == 2}{assign $etat = "Urgent"}{/if}
                                                                        {if $annonce->annonce_etat == 3}{assign $etat = "D&egrave;s que possible"}{/if}
                                                                        {if $annonce->annonce_etat == 0}{assign $etat = "S/O"}{/if}
                                                                     {/if}   
                                                                    <dt>Etat&nbsp;:</dt>
                                                                    <dd><div id="view_etat">{$etat}</div></dd>
                                                                </dl>
                                                                {/if}
                                                            </div>
                                                        </div>
                                                                                                        
                                                        <div id="view_action" class="float_r">
                                                            <ul>
                                                                {assign $action = ""}
                                                                {if $toForfait->forfait_packId == 3}
                                                                    {if $annonce->annonce_action == 1}{assign $action = "OFFRE"}{/if}
                                                                    {if $annonce->annonce_action == 2}{assign $action = "DEMANDE"}{/if}
                                                                {else}    
                                                                    {if $annonce->annonce_action == 3}{assign $action = "A ACHETER"}{/if}
                                                                    {if $annonce->annonce_action == 4}{assign $action = "A CHERCHER"}{/if}
                                                                    {if $annonce->annonce_action == 5}{assign $action = "A LOUER"}{/if}
                                                                    {if $annonce->annonce_action == 6}{assign $action = "A VENDRE"}{/if}
                                                                    {if $annonce->annonce_action == 7}{assign $action = "A ECHANGER"}{/if}
                                                                    {if $annonce->annonce_action == 8}{assign $action = "RENCONTRE"}{/if}
                                                               	{/if}     
                                                                <li><strong>{$action}</strong></li>
                                                            </ul>
                                                        </div>

                                                        <div id="view_offre" class="float_r">
                                                            <ul>
                                                                <li class="ref">Annonce r&eacute;f. {$annonce->annonce_reference}</li>
                                                                {assign $offre = ""}
                                                                {if $annonce->annonce_offreId == 1}{assign $offre = "particuli&egrave;re"}{/if}
                                                                {if $annonce->annonce_offreId == 2}{assign $offre = "professionnelle"}{/if}
                                                                {if $annonce->annonce_offreId == 3}{assign $offre = "commerciale"}{/if}
                                                                {if $annonce->annonce_offreId == 4}{assign $offre = "de candidat"}{/if}
                                                                <li>Offre {$offre}</li>
                                                                <li class="date">Parue depuis {if $annonce->annonce_parution == 0}aujourd'hui{else}{$annonce->annonce_parution} jour{if $annonce->annonce_parution > 1}s{/if}{/if}</li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- box_annonce_main_info end -->

                                                    <div class="clearer"></div>
                                                	
                                                    {if $annonce->annonce_id}
                                                    <div class="box_inner box_end">
                                                        <br>
                                                        {if sizeof($toPhotos)>1}                                                        
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="{$j_basepath}resize/annonce/images/popup/{$annonce->annonce_photo}">
																					<input type="hidden" id="picture_id" name="picture_id" value="{if sizeof($toPhotos)}{$toPhotos[0]->photo_id}{/if}">
																					<input type="hidden" id="picture_photo" name="picture_photo" value="{if sizeof($toPhotos)}{$toPhotos[0]->photo_photo}{/if}"> 
                                                                                    <a title="Changer de photo" id="edit_profilepicture" class="hidden_elem">
                                                                                        Changer de photo
                                                                                        <span id="edit_profilepicture_icon"></span>
                                                                                    </a>
                                                                                    <div id="profile_picture_flyout" class="flyout_menu hidden_elem flyout_menu_18 link_menu">
                                                                                        <div class="flyout_menu_header_shadow">
                                                                                            <div class="flyout_menu_header clearfix">
                                                                                                <div class="flyout_menu_mask"></div>
                                                                                                <div class="flyout_menu_title">Modifier</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="flyout_menu_content_shadow">
                                                                                            <div class="menu_content">
                                                                                                <div class="wrapper">
                                                                                                    <a title="Charger une nouvelle photo" class="icon_link" id="profile_picture_upload" rel="dialog">Charger une photo</a>
                                                                                                    <a title="Si vous le souhaitez, supprimez cette photo" class="icon_link" id="profile_picture_remove" rel="dialog">Supprimer la photo</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>          
                                                                                </div>                                                                      
                                                                          	</td>
                                                                        </tr>
                                                                        <!--
                                                                        <tr class="trLP">
                                                                            <td class="tdLPCenter"><a href="javascript:afficheImage();" class="cmtt">Voir toutes les photos</a></td>
                                                                        </tr>
                                                                        -->
                                                                    </tbody></table>
                                                                </td>                                   
                                    					
                                                                <td class="tdLPRight">
                                                                
                                    
                                                                    <div class="divright">
                                                                        <table class="tableLP">
                                                                            <tbody>
                                                                            {assign $i=0}
                                                                            {foreach $toPhotos as $oPhotos}
                                                                            	{if $i == 0}
                                                                                <tr class="trLP">
                                                                                    <td class="tdLP">
                                                                                        <p class="img_thumb">
                                                                                 {/if}      {if $oPhotos->photo_photo != "noPhoto.jpg"} 
	                                                                                            <a id="linkthumb{$oPhotos->photo_id}" href="javascript:voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});"><img width="90" height="68" onMouseOver="voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/annonce/images/abrege/{$oPhotos->photo_photo}"></a>
                                                                                            {else}
	                                                                                            <a id="linkthumb{$oPhotos->photo_id}"><img width="90" height="68" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/annonce/images/abrege/{$oPhotos->photo_photo}"></a>
                                                                                            {/if}

                                                                            	{if $i == 1}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                {/if}
                                                                                {assign $i++}
                                                                                {if $i > 1 }
	                                                                                {assign $i=0}
                                                                                {/if}
                                                                            {/foreach}

                                                                        </tbody></table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>    
                                                        {else}
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">                                                                            
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="{$j_basepath}resize/annonce/images/popup/{$annonce->annonce_photo}">
																					<input type="hidden" id="picture_id" name="picture_id" value="{if sizeof($toPhotos)}{$toPhotos[0]->photo_id}{/if}">
																					<input type="hidden" id="picture_photo" name="picture_photo" value="{if sizeof($toPhotos)}{$toPhotos[0]->photo_photo}{/if}"> 
                                                                                    <a title="Changer de photo" id="edit_profilepicture" class="hidden_elem">
                                                                                        Changer de photo
                                                                                        <span id="edit_profilepicture_icon"></span>
                                                                                    </a>
                                                                                    <div id="profile_picture_flyout" class="flyout_menu hidden_elem flyout_menu_18 link_menu">
                                                                                        <div class="flyout_menu_header_shadow">
                                                                                            <div class="flyout_menu_header clearfix">
                                                                                                <div class="flyout_menu_mask"></div>
                                                                                                <div class="flyout_menu_title">Modifier</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="flyout_menu_content_shadow">
                                                                                            <div class="menu_content">
                                                                                                <div class="wrapper">
                                                                                                    <a title="Charger une nouvelle photo" class="icon_link" id="profile_picture_upload" rel="dialog">Charger une photo</a>
                                                                                                    <a title="Si vous le souhaitez, supprimez cette photo" class="icon_link" id="profile_picture_remove" rel="dialog">Supprimer la photo</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>          
                                                                                </div>                                                                      
                                                                          	</td>
                                                                        </tr>
                                                                        <!--
                                                                        <tr class="trLP">
                                                                            <td class="tdLPCenter"><a href="javascript:afficheImage();" class="cmtt">Voir toutes les photos</a></td>
                                                                        </tr>
                                                                        -->
                                                                    </tbody></table>
                                                                </td>                                   
                                    					
                                                                <td class="tdLPRight">
                                                                
                                    
                                                                    <div class="divright">
                                                                        <table class="tableLP">
                                                                            <tbody>
                                                                            {assign $i=0}
                                                                            {foreach $toPhotos as $oPhotos}
                                                                            	{if $i == 0}
                                                                                <tr class="trLP">
                                                                                    <td class="tdLP">
                                                                                        <p class="img_thumb">
                                                                                 {/if}      {if $oPhotos->photo_photo != "noPhoto.jpg"} 
	                                                                                            <a id="linkthumb{$oPhotos->photo_id}" href="javascript:voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});"><img width="90" height="68" onMouseOver="voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/annonce/images/abrege/{$oPhotos->photo_photo}"></a>
                                                                                            {else}
	                                                                                            <a id="linkthumb{$oPhotos->photo_id}"><img width="90" height="68" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/annonce/images/abrege/{$oPhotos->photo_photo}"></a>
                                                                                            {/if}

                                                                            	{if $i == 1}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                {/if}
                                                                                {assign $i++}
                                                                                {if $i > 1 }
	                                                                                {assign $i=0}
                                                                                {/if}
                                                                            {/foreach}

                                                                        </tbody></table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                        {/if}                                                                                        
                                                        <div class="clearer"></div>
                                                    </div>
                                                    {/if}
                                            
                                    				<!-- Caractéristique Debut-->   
                                                    {$caracteristique}
                                    				<!-- Caractéristique Fin-->                                                    
                                    				{if $annonce->annonce_resume != ""}
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
                                                        {$annonce->annonce_resume}
                                                        <br><br>                                    
                                                    </div>      
                                                    {/if}                                  
                                                    <div id="view_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>
                                                        {$annonce->annonce_description}
                                                        <br><br>
                                    
                                                    </div>                                        
                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_annonce_foot">
                                                        
														<ul class="split">
                                                            {if $annonce->annonce_id != 0}                                                        
                                                                {if $iFirst}                                                
                                                                    <li class="inline"><a class="link_d" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iFirst, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">D&eacute;but</a></li>                                                            
                                                                {/if}   
                                                                {if $iBack}                                                
                                                                    <li class="inline"><a class="link_p" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iBack, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Annonce pr&eacute;c&eacute;dente</a></li>                                                            
                                                                {/if}   
                                                                {if $iNext}                                                
                                                                    <li class="inline"><a class="link_s" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iNext, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Annonce suivante</a></li>                                                            
                                                                {/if}   
                                                                {if $iLast}                                                
                                                                    <li class="inline"><a class="link_f" href="{jurl 'annonce~annonceFo_annonceDetail', array('anid'=>$iLast, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Fin</a></li>                                                            
                                                                {/if}   
                                                            {/if}
                                                            <li class="last inline"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=> $page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>                                          
                                        </form>
                                    </div>
