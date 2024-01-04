									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Edition d'une actualite</span> 
                                      	</p>          
   										<p style="clear: both;"></p>
									</div>

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='actualiteForm' name='actualiteForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="actualite_id" name="actualite_id" value="{$actualite->actualite_id}">
                                         	<input type="hidden" id="actualite_abonnementId" name="actualite_abonnementId" value="{$actualite->actualite_abonnementId}">
                                            
                                         	<input type="hidden" id="actualite_laUne" name="actualite_laUne" value="{$actualite->actualite_laUne}">


                                            <div id="middleCol">
                                                <div class="box" id="box_actualite">
                                                    <div class="box_inner box_end box_actualite_top">

                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                            		{assign $categorieAct = ""}
                                                                    {foreach $toCategorieActs as $oCategorieAct}
                                                                        {if $oCategorieAct->categorieAct_id==$caid}
                                                                            {assign $categorieAct = $oCategorieAct->categorieAct_libelle}
                                                                        {/if}
                                                                    {/foreach}
                                                                    
                                                            		{assign $rubrique = ""}
                                                                    {foreach $toRubriques as $oRubriques}
                                                                        {if $oRubriques->rubrique_id==$raid}
                                                                            {assign $rubrique = $oRubriques->rubrique_libelle}
                                                                        {/if}
                                                                    {/foreach}
                                                            
                                                                <li><a href="#">{$categorieAct}</a></li>
                                                                <li><span>&gt;</span> <a href="#">{$rubrique}</a></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    
                                                        <div id="categ_rubrique">
                                                            <div id="edit_categorie">
                                                                <p style="clear: both;"></p>
                                                                <label for="forum_parue">S&eacute;lectionner une cat&eacute;gorie : </label><br>
                                                                <select class="user_input1 user_input_select input_middle" name="categorieActId" id="categorieActId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                    <option value="0">Cat&eacute;gorie:</option>
                                                                    {foreach $toCategorieActs as $oCategorieAct}
                                                                        {if $oCategorieAct->categorieAct_id==$caid}
                                                                            {assign $selected="selected"}
                                                                        {else}
                                                                            {assign $selected=""}
                                                                        {/if}
                                                                        <option value="{$oCategorieAct->categorieAct_id}" {$selected}>{$oCategorieAct->categorieAct_libelle}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>      
                                                            <div id="edit_rubrique">
                                                                <p style="clear: both;"></p>
                                                                <label for="forum_parue">S&eacute;lectionner une rubrique : </label><br>
                                                                <select class="user_input1 user_input_select input_middle" name="actualite_rubriqueId" id="actualite_rubriqueId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                    <option value="0">Rubrique:</option>
                                                                    {foreach $toRubriques as $oRubriques}
                                                                        {if $oRubriques->rubrique_id==$raid}
                                                                            {assign $selected="selected"}
                                                                        {else}
                                                                            {assign $selected=""}
                                                                        {/if}
                                                                        {assign $ident = ""}
                                                                        {for $i=0; $i< $oRubriques->rubrique_level;$i++}
                                                                        	{assign $ident = $ident . " -- " }
                                                                        {/for}
                                                                        
                                                                        <option value="{$oRubriques->rubrique_id}" {$selected}>{$ident}{$oRubriques->rubrique_libelle}</option>
                                                                    {/foreach}
                                                                </select>
                                                            </div>      
                                                      	</div>                                                        
                                                    
                                                    
                                                        <div id="view_titre">
	                                                        <h1 class="txt_arrows">{$actualite->actualite_titre}</h1>
                                                        </div>
                                                        <div id="edit_titre">
					   										<p style="clear: both;"></p>
                                                            <label for="user_nom">Titre de l'actualite: *</label><br>
                                                            <input style="width:548px;" class="user_input1" type="text" id="actualite_titre" name="actualite_titre" value="{$actualite->actualite_titre}" tmt:required="true" tmt:filters="" maxlength="70">
                                                        </div>
                                                
														<ul class="split">
                                                            {if $actualite->actualite_id != 0}
                                                                {if $iFirst}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iFirst, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">D&eacute;but</a></li>                                                            
                                                                {/if}   
                                                                {if $iBack}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iBack, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Actualite pr&eacute;c&eacute;dente</a></li>                                                            
                                                                {/if}   
                                                                {if $iNext}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iNext, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Actualite suivante</a></li>                                                            
                                                                {/if}   
                                                                {if $iLast}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iLast, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Fin</a></li>                                                            
                                                                {/if}   
                                                            {/if}			
                                                            <li class="" id="link_edit"><a href="#">Editer l'actualite</a></li>                                                            
                                                            <li class="inline" id="link_view"><a href="#">Visualiser l'actualite</a></li>                                                            
                                                            <li class="last inline"><a href="{jurl 'actualite~actualiteFo_actualiteList', array('page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Retour à la liste</a></li>                                                            
                                                        </ul>
                                                        <div class="clearer"></div>
                                                    </div><!-- box_actualite_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_actualite_main_info">                                                    
                                                    
                                                        <div id="view_price" class="float">
                                                            <div class="info_list">
                                                
                                                                <dl class="price">
                                                                    <dt>Prix&nbsp;:</dt>
                                                                    <dd><div id="view_prix">{if $actualite->actualite_prix}{$actualite->actualite_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</div><span id="view_prixInfo">{$actualite->actualite_prixInfo}</span></dd>
                                                                </dl>
                                                                <dl class="lieu">
                                                                    <dt>Lieu&nbsp;:</dt>
																	{assign $province = ""}
                                                                    {foreach $toProvinces as $oProvinces}
                                                                        {if $oProvinces->province_id==$pid}
                                                                            {assign $province = $oProvinces->province_libelle}
                                                                        {/if}
                                                                    {/foreach}
																	{assign $localite = ""}
                                                                    {foreach $toLocalites as $oLocalites}
                                                                        {if $oLocalites->localite_id==$lid}
                                                                            {assign $localite = $oLocalites->localite_code . " " . $oLocalites->localite_libelle}
                                                                        {/if}
                                                                    {/foreach}
                                                                    <dd><div id="view_lieu">{$province} <span class="date">{$localite}</span></div></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Année&nbsp;:</dt>
                                                                    <dd><div id="view_annee">{if $actualite->actualite_annee}{$actualite->actualite_annee}{else}N/D{/if}</div></dd>
                                                                </dl>                                                
                                                                <dl>
                                                                    {assign $etat = ""}
                                                                    {if $toForfait->forfait_packId != 3} {*}PACK EMPLOI{*}                                                                    
                                                                        {if $actualite->actualite_etat == 1}{assign $etat = "Neuf"}{/if}
                                                                        {if $actualite->actualite_etat == 2}{assign $etat = "Usag&eacute;"}{/if}
                                                                        {if $actualite->actualite_etat == 3}{assign $etat = "Epave"}{/if}
                                                                        {if $actualite->actualite_etat == 0}{assign $etat = "S/O"}{/if}
                                                                     {else}
                                                                        {if $actualite->actualite_etat == 1}{assign $etat = "Tr&egrave;s urgent"}{/if}
                                                                        {if $actualite->actualite_etat == 2}{assign $etat = "Urgent"}{/if}
                                                                        {if $actualite->actualite_etat == 3}{assign $etat = "D&egrave;s que possible"}{/if}
                                                                        {if $actualite->actualite_etat == 0}{assign $etat = "S/O"}{/if}
                                                                     {/if}   
                                                                    <dt>État&nbsp;:</dt>
                                                                    <dd><div id="view_etat">{$etat}</div></dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        
                                                        <div id="edit_price" class="float">
                                                            <div class="info_list">
                                                
                                                                <dl class="price">
                                                                    {if $toForfait->forfait_packId == 3} {*}PACK EMPLOI{*}                                                                    
                                                                        <dt>Salaire :</dt>
                                                                     {else}
																		<dt>Prix&nbsp;:</dt>                                                                     
                                                                     {/if}                                                                    
                                                                    <dd>
                                                                    	<input class="user_input3" type="text" id="actualite_prix" name="actualite_prix" value="{$actualite->actualite_prix}" tmt:pattern="number" tmt:filters="" maxlength="50"> Ar 
                                                                    	<span>
	                                                                        <input class="user_input1" type="text" id="actualite_prixInfo" name="actualite_prixInfo" value="{$actualite->actualite_prixInfo}" tmt:filters="" maxlength="20">
                                                                        </span>
                                                                    </dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Année&nbsp;:</dt>
                                                                    <dd><input style="width:50px;"  class="user_input3" type="text" id="actualite_annee" name="actualite_annee" value="{$actualite->actualite_annee}" tmt:pattern="number" tmt:filters="" maxlength="4"></dd>
                                                                </dl>
                                                
                                                                <dl>
                                                                    <dt>État&nbsp;:</dt>
                                                                    <dd>
                                                                        <select class="user_input3 user_input_select input_middle" name="actualite_etat" id="actualite_etat">			
                                                                            <option value="0">État&nbsp;:</option>
                                                                            {if $toForfait->forfait_packId == 3} {*}PACK EMPLOI{*}                                                                    
                                                                                <option value="1" {if $actualite->actualite_etat == 1}selected{/if}>Tr&egrave;s urgent</option>
                                                                                <option value="2" {if $actualite->actualite_etat == 2}selected{/if}>Urgent</option>
                                                                                <option value="3" {if $actualite->actualite_etat == 3}selected{/if}>D&egrave;s que possible</option>
                                                                             {else}
                                                                                <option value="1" {if $actualite->actualite_etat == 1}selected{/if}>Neuf</option>
                                                                                <option value="2" {if $actualite->actualite_etat == 2}selected{/if}>Usag&eacute;</option>
                                                                                <option value="3" {if $actualite->actualite_etat == 3}selected{/if}>Epave</option>
                                                                             {/if}
                                                                        </select>                                                        
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                
                                                        <div id="view_action" class="float_r">
                                                            <ul>
                                                                {assign $action = ""}
                                                                {if $toForfait->forfait_packId == 3}
                                                                    {if $actualite->actualite_action == 1}{assign $action = "OFFRE"}{/if}
                                                                    {if $actualite->actualite_action == 2}{assign $action = "DEMANDE"}{/if}
                                                                {else}    
                                                                    {if $actualite->actualite_action == 3}{assign $action = "A ACHETER"}{/if}
                                                                    {if $actualite->actualite_action == 4}{assign $action = "A CHERCHER"}{/if}
                                                                    {if $actualite->actualite_action == 5}{assign $action = "A LOUER"}{/if}
                                                                    {if $actualite->actualite_action == 6}{assign $action = "A VENDRE"}{/if}
                                                                    {if $actualite->actualite_action == 7}{assign $action = "A ECHANGER"}{/if}
                                                                    {if $actualite->actualite_action == 8}{assign $action = "RENCONTRE"}{/if}
                                                               	{/if}     
                                                                <li><strong>{$action}</strong></li>
                                                            </ul>
                                                        </div>
                                                        <div id="edit_action" class="float_r">
                                                            <label for="actionId">Action : </label><br>
                                                            <select class="user_input4 user_input_select input_middle" name="actualite_action" id="actualite_action"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">Action:</option>
                                                                {if $toForfait->forfait_packId == 3}
                                                                    <option value="1" {if $actualite->actualite_action == 1}selected{/if}>OFFRE</option>
                                                                    <option value="2" {if $actualite->actualite_action == 2}selected{/if}>DEMANDE</option>
                                                                {else}
                                                                    <option value="3" {if $actualite->actualite_action == 3}selected{/if}>A ACHETER</option>
                                                                    <option value="4" {if $actualite->actualite_action == 4}selected{/if}>A CHERCHER</option>
                                                                    <option value="5" {if $actualite->actualite_action == 5}selected{/if}>A LOUER</option>
                                                                    <option value="6" {if $actualite->actualite_action == 6}selected{/if}>A VENDRE</option>
                                                                    <option value="7" {if $actualite->actualite_action == 7}selected{/if}>A ECHANGER</option>
                                                                    <option value="8" {if $actualite->actualite_action == 8}selected{/if}>RENCONTRE</option>
                                                                {/if}
                                                            </select>                                                        
                                                        </div>

                                                        <div id="view_offre" class="float_r">
                                                            <ul>
                                                                <li class="ref">Actualite r&eacute;f. an0000000</li>
                                                                {assign $offre = ""}
                                                                {if $actualite->actualite_offreId == 1}{assign $offre = "particuli&egrave;re"}{/if}
                                                                {if $actualite->actualite_offreId == 2}{assign $offre = "professionnelle"}{/if}
                                                                {if $actualite->actualite_offreId == 3}{assign $offre = "commerciale"}{/if}
                                                                {if $actualite->actualite_offreId == 4}{assign $offre = "de candidat"}{/if}
                                                                <li>Offre {$offre}</li>
                                                                <li class="date">Parue depuis aujourd'hui</li>
                                                            </ul>
                                                        </div>
                                                        <div id="edit_offre" class="float_r">
                                                            <label for="offreId">Offre : </label><br>
                                                            <select class="user_input4 user_input_select input_middle" name="actualite_offreId" id="actualite_offreId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">Offre:</option>
                                                                <option value="1" {if $actualite->actualite_offreId == 1}selected{/if}>particuli&egrave;re</option>
                                                                <option value="2" {if $actualite->actualite_offreId == 2}selected{/if}>professionnelle</option>
                                                                <option value="3" {if $actualite->actualite_offreId == 3}selected{/if}>commerciale</option>
                                                                <option value="4" {if $actualite->actualite_offreId == 4}selected{/if}>de candidat</option>
                                                            </select>                                                        
                                                        </div>

                                                    </div><!-- box_actualite_main_info end -->                                                                                                                                               
                                                    <div id="edit_contact" class="box_inner box_end intro box_actualite_main_info">                                                    
                                                        <h4>Personne &agrave; contacter</h4>
														<br>
                                                        <div id="view_contact1" class="float">
                                                            <div class="info_list">
                                                                <dl>
                                                                    <dt>Nom&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="actualite_contactNom" name="actualite_contactNom" value="{if $actualite->actualite_contactNom != ""}{$actualite->actualite_contactNom}{else}{$utilisateur->utilisateur_nom}{/if}" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Pr&eacute;nom&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="actualite_contactPrenom" name="actualite_contactPrenom" value="{if $actualite->actualite_contactPrenom != ""}{$actualite->actualite_contactPrenom}{else}{$utilisateur->utilisateur_prenom}{/if}" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Email&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="actualite_contactEmail" name="actualite_contactEmail" value="{if $actualite->actualite_contactEmail != ""}{$actualite->actualite_contactEmail}{else}{$utilisateur->utilisateur_email}{/if}" tmt:pattern="email" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Adresse&nbsp;:</dt>
                                                                    <dd><input class="user_input1" type="text" id="actualite_contactAdresse" name="actualite_contactAdresse" value="{if $actualite->actualite_contactAdresse != ""}{$actualite->actualite_contactAdresse}{else}{$utilisateur->utilisateur_adresse}{/if}" tmt:required="true" tmt:filters="" maxlength="50"></dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        <div id="view_contact2" class="float_r">
                                                            <label for="actionId">Localit&eacute; : </label><br>
                                                            <select class="user_input3 user_input_select input_middle" name="provinceId" id="provinceId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">Province:</option>
                                                                {foreach $toProvinces as $oProvinces}
                                                                    {if $oProvinces->province_id==$pid}
                                                                        {assign $selected="selected"}
                                                                    {else}
                                                                        {assign $selected=""}
                                                                    {/if}
                                                                    <option value="{$oProvinces->province_id}" {$selected}>{$oProvinces->province_libelle}</option>
                                                                {/foreach}
                                                            </select>
                                                            <br>
                                                            
                                                            <select style="width:220px;" class="user_input4 user_input_select input_middle" name="actualite_localiteId" id="actualite_localiteId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">Localit&eacute;:</option>
                                                                {foreach $toLocalites as $oLocalites}
                                                                    {if $oLocalites->localite_id==$lid}
                                                                        {assign $selected="selected"}
                                                                    {else}
                                                                        {assign $selected=""}
                                                                    {/if}
                                                                    <option value="{$oLocalites->localite_id}" {$selected}>{$oLocalites->localite_code} {$oLocalites->localite_libelle}</option>
                                                                {/foreach}
                                                            </select>
                                                            <br>
                                                            
                                                        </div>
                                                        <div class="float_r">
                                                            <label for="actualite_contactTelephone">T&eacute;l&eacute;phone : </label><br>
															<input class="user_input3" type="text" id="actualite_contactTelephone" name="actualite_contactTelephone" value="{if $actualite->actualite_contactTelephone != ""}{$actualite->actualite_contactTelephone}{else}{$utilisateur->utilisateur_telephone}{/if}" tmt:pattern="phone" tmt:required="true" tmt:filters="" maxlength="50">                                                        
														</div>                                                            
                                                        <div class="float_r">
                                                            <label for="periodeId">P&eacute;riode d'appel : </label><br>
                                                            <select class="user_input4 user_input_select input_middle" name="actualite_contactPeriodeAppel" id="actualite_contactPeriodeAppel"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">P&eacute;riode:</option>
                                                                <option value="1" {if $actualite->actualite_contactPeriodeAppel == 1}selected{/if}>Matin</option>
                                                                <option value="2" {if $actualite->actualite_contactPeriodeAppel == 2}selected{/if}>Midi</option>
                                                                <option value="3" {if $actualite->actualite_contactPeriodeAppel == 3}selected{/if}>Apr&egrave;s midi</option>
                                                                <option value="4" {if $actualite->actualite_contactPeriodeAppel == 4}selected{/if}>Soir&eacute;e</option>
                                                                <option value="5" {if $actualite->actualite_contactPeriodeAppel == 5}selected{/if}>Nuit</option>
                                                                <option value="6" {if $actualite->actualite_contactPeriodeAppel == 6}selected{/if}>La journ&eacute;e</option>
                                                            </select>                                                        
                                                        </div>
                                                    </div>    

                                                    <div class="clearer"></div>
                                                	
                                                    {if $actualite->actualite_id}
                                                    <div class="box_inner box_end">
                                                        <br>
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="{$j_basepath}resize/actualite/images/popup/{$actualite->actualite_photo}">
																					<input type="hidden" id="picture_id" name="picture_id" value="{$toPhotos[0]->photo_id}">                                                                                
																					<input type="hidden" id="picture_photo" name="picture_photo" value="{$toPhotos[0]->photo_photo}">                                                                                
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
                                                                                 {/if}       
                                                                                            <a id="linkthumb{$oPhotos->photo_id}" href="javascript:voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});"><img width="90" height="68" onmouseover="voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/actualite/images/abrege/{$oPhotos->photo_photo}"></a>

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
                                    
                                    
                                                        <div class="clearer"></div>
                                                    </div>
                                                    {else}
                                                    <div id="edit_photo" class="box_inner intro box_end intro box_actualite_main_info">
                                                        <h4>Photos</h4>
                                                        <br>
                                                        <div id="view_contact1" class="float">
                                                            <div class="info_list">                                                
                                                                {assign $nbPhoto = $toForfait->forfait_nbPhoto}            
                                                                {for $i=0; $i<$nbPhoto;$i++}
                                                                	{assign $it = $i+1}
                                                                    <dl>
                                                                        <dt>Photo&nbsp;{$it}&nbsp;:</dt>
                                                                        <dd>
                                                                        {if $i == 0}
                                                                        	{assign $tmtRequired = " tmt:required=\"true\""}
                                                                        {else}
                                                                        	{assign $tmtRequired = ""}
                                                                        {/if}
                                                                        <input type="file" name="actualite_photo{$i}" id="actualite_photo{$i}" {$tmtRequired} class="inputfile">
                                                                    </dl>
                                                                {/for}                                                        
                                                            </div>
                                                      	</div>      

                                                        
                                                        {assign $nbPhotoAdd = $toForfait->forfait_nbPhotoAdd}                                                                    
                                                        {if $nbPhotoAdd > 0}
	                                                        <div class="clearer"></div>
                                                            <h4>Photos additionnelles</h4>                                                                                                                    
                                                            <br>
                                                            <div id="view_contact1" class="float">
                                                                <div class="info_list">                                                
                                                                    {for $i=0; $i<$nbPhotoAdd;$i++}
                                                                        {assign $it = $i+1}
                                                                        <dl>
                                                                            <dt>Photo&nbsp;{$it}&nbsp;:</dt>
                                                                            <dd>
                                                                            <input type="file" name="actualite_photoAdd{$i}" id="actualite_photoAdd{$i}" class="inputfile">
                                                                        </dl>
                                                                    {/for}                                                        
                                                                </div>
                                                            </div>                                                            
                                                        {/if}
                                                        
                                                        <div class="clearer"></div>
                                                  	</div>      
                                                    {/if}
                                            
                                    				<!-- Caractéristique Debut-->
                                                    	
                                    				<!-- Caractéristique Fin-->                                                    
                                    
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
                                                        {$actualite->actualite_resume}
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="edit_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
														<textarea style="width:608px;height:60px;" class="user_input_select1" id="actualite_resume" name="actualite_resume" rows="5" tmt:filters="" >{$actualite->actualite_resume}</textarea>				
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="view_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>
                                                        {$actualite->actualite_description}
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="edit_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>                                                        
														<textarea style="width:608px;height:150px;" class="user_input_select1" id="actualite_description" name="actualite_description" rows="10" tmt:required="true">{$actualite->actualite_description}</textarea>				
                                                        <br><br>
                                    
                                                    </div>                                        

                                                    <div id="edit_publication" class="box_inner intro box_end">
                                                        <h4>Publication</h4>                                                       
                                                        <br>
                                                        <div id="view_contact1" class="float">
                                                            <div class="info_list">                                                
                                                                <dl>
                                                                    <dt>Publier&nbsp;:</dt>
                                                                    <dd>
                                                                    <input class="radio" type="checkbox" id="actualite_publier" name="actualite_publier" {if $actualite->actualite_publier == 1}checked{/if} value="1">
                                                                    </dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Accueil&nbsp;:</dt>
                                                                    <d>
                                                                    <input class="radio" type="checkbox" id="actualite_publierHome" name="actualite_publierHome" {if $actualite->actualite_publierHome == 1}checked{/if} value="1">                                                                    
                                                                    &nbsp;( publier cette actualite en page d'acceuil de fa&ccedil;on al&eacute;atoire )
                                                                    </d>
                                                                </dl>
                                                                
                                                            </div>
                                                        </div>            
                                                  	</div>      
                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_actualite_foot">
                                                        
														<ul class="split">
                                                            {if $actualite->actualite_id != 0}                                                        
                                                                {if $iFirst}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iFirst, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">D&eacute;but</a></li>                                                            
                                                                {/if}   
                                                                {if $iBack}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iBack, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Actualite pr&eacute;c&eacute;dente</a></li>                                                            
                                                                {/if}   
                                                                {if $iNext}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iNext, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Actualite suivante</a></li>                                                            
                                                                {/if}   
                                                                {if $iLast}                                                
                                                                    <li class="inline"><a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$iLast, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Fin</a></li>                                                            
                                                                {/if}   
                                                            {/if}
                                                            <li class="last inline"><a href="{jurl 'actualite~actualiteFo_actualiteList', array('page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Retour à la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_actualite_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>
                                          
                                            <a href="#" class="formButton_valid">Valider</a>                                    
                                            <p style="clear: both;height:5px;"></p>                                                                        
											<p class="errorMessage" id="errorMessage"></p>  
                                        </form>
                                    </div>
                                    {if $actualite->actualite_id != 0}
                                    <div id="generic_dialog_popup" class="generic_dialog pop_dialog hidden_elem">
                                        <div class="generic_dialog_popup">
                                            <div class="pop_container_advanced">
                                                <div id="pop_content" class="pop_content">
                                                    <h2 class="dialog_title">
                                                        <span>Chargez une nouvelle photo</span>
                                                    </h2>
                                                    <div class="dialog_content">
                                                        <div class="dialog_body">
                                                            <div id="profile_pic_form">
			                                                    <form id="form_upload_profile_pic" name="form_upload_profile_pic" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" id="photo_id" name="photo_id" value="{$toPhotos[0]->photo_id}">
                                                                    <span>Sélectionnez un fichier image sur votre ordinateur (4&nbsp;Mo maximum)&nbsp;:</span>
                                                                    <div class="pfileselector">
                                                                        <input type="file" name="user_photo" id="user_photo" class="inputfile">
                                                                    </div>
			                                                     </form>                                                               
                                                                <div class="tos">
                                                                    Vous certifiez avoir le droit de charger et de diffuser cette photo et qu'elle est conforme aux 
                                                                    <a target="_blank" title="Conditions d'utilisation" href="#">Conditions d'utilisation</a>.
                                                                </div>
                                                            </div>
                                                            <div id="profile_pic_upload_indicator" class="profile_pic_display_none">
                                                                <img alt="" src="http://static.ak.fbcdn.net/rsrc.php/z5R48/hash/ejut8v2y.gif" class="img">
                                                                <div class="load_message">Chargement de la photo en cours</div>
                                                            </div>
                                                        </div>
                                                        <div class="dialog_buttons clearfix">
                                                            <a id="formButton_annuler" class="formButton_annuler"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                        
                                    </div>

                                    <div id="view_pop_up" class="result_pop_up pop_up_middle hidden_elem">
                                        <p class="result_pop_up_top"></p>
                                        <div class="result_pop_up_inner">
                                            <p class="float_r"><a id="bt_close" title="Fermer" class="bt_close">Fermer</a></p>
                                            <div class="pop_up_inner">
                                                <span class="img_photo">
                                                    <img id="profile_pic_popup" name="profile_pic_popup" src="{$j_basepath}resize/actualite/images/popup/{if $actualite->actualite_photo != ""}{$actualite->actualite_photo}{else}nophoto.jpg{/if}" alt="{$actualite->actualite_titre}">
                                                </span>
                                            </div>
                                            <div class="result_foot">
                                                {$actualite->actualite_titre}
                                            </div>
                                        </div>
                                        <div class="result_pop_up_foot"></div>
                                    </div>                                    
									{/if}	