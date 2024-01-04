{$header}
<h1>Gestion des annonces</h1>

{if isset($listeAnnonceBo)}	
	<h2>Liste des annonces</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'annonce~annonceBo_editionAnnonce'}">Nouvel annonce </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeAnnonceBo}		
	</div>
{else}	  
	<h2>Edition d'un annonce</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='annonceForm' name='annonceForm' action="{jurl 'annonce~annonceBo_sauvegardeAnnonce', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="annonce_id" name="annonce_id" value="{$annonce->annonce_id}">
		  <input type="hidden" id="annonce_abonnementId" name="annonce_abonnementId" value="{$annonce->annonce_abonnementId}">
          
		  <p class="clearfix">
			<label>S&eacute;lectionner une cat&eacute;gorie : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="categorieAnId" id="categorieAnId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Cat&eacute;gorie:</option>
                {foreach $toCategorieAns as $oCategorieAn}
                    {if $oCategorieAn->categorieAn_id==$caid}
                        {assign $selected="selected"}
                    {else}
                        {assign $selected=""}
                    {/if}
                    <option value="{$oCategorieAn->categorieAn_id}" {$selected}>{$oCategorieAn->categorieAn_libelle}</option>
                {/foreach}
            </select>
			</span>
		  </p>
		  <p class="clearfix">
			<label>S&eacute;lectionner une rubrique : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="annonce_rubriqueId" id="annonce_rubriqueId"  tmt:invalidvalue="0" tmt:required="true">			
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
			</span>
		  </p>

		  <p class="clearfix">
			<label>Titre de l'annonce: *</label>
			<span class="champ">
				<input style="width:548px;" class="user_input1" type="text" id="annonce_titre" name="annonce_titre" value="{$annonce->annonce_titre}" tmt:required="true" tmt:filters="" maxlength="70">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Titre de l'annonce: *</label>
			<span class="champ">
				<input style="width:548px;" class="user_input1" type="text" id="annonce_titre" name="annonce_titre" value="{$annonce->annonce_titre}" tmt:required="true" tmt:filters="" maxlength="70">
          	</span>
		  </p>
		  <p class="clearfix">
            {if $toForfait->forfait_packId == 3} {*}PACK EMPLOI{*}                                                                    
                <label>Salaire :</label>
            {else}
            	<label>Prix&nbsp;:</label>                                                                     
            {/if}                                                                    
			<span class="champ">
				<input class="user_input3" type="text" id="annonce_prix" name="annonce_prix" value="{$annonce->annonce_prix}" tmt:pattern="number" tmt:filters="" maxlength="50"> Ar 
                &nbsp;
				<input class="user_input1" type="text" id="annonce_prixInfo" name="annonce_prixInfo" value="{$annonce->annonce_prixInfo}" tmt:filters="" maxlength="20">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Ann&eacute;e&nbsp;: *</label>
			<span class="champ">
				<input style="width:50px;"  class="user_input3" type="text" id="annonce_annee" name="annonce_annee" value="{$annonce->annonce_annee}" tmt:pattern="number" tmt:filters="" maxlength="4">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Etat&nbsp;: *</label>
			<span class="champ">
            <select class="user_input3 user_input_select input_middle" name="annonce_etat" id="annonce_etat">			
                <option value="0">Etat&nbsp;:</option>
                {if $toForfait->forfait_packId == 3} {*}PACK EMPLOI{*}                                                                    
                    <option value="1" {if $annonce->annonce_etat == 1}selected{/if}>Tr&egrave;s urgent</option>
                    <option value="2" {if $annonce->annonce_etat == 2}selected{/if}>Urgent</option>
                    <option value="3" {if $annonce->annonce_etat == 3}selected{/if}>D&egrave;s que possible</option>
                 {else}
                    <option value="1" {if $annonce->annonce_etat == 1}selected{/if}>Neuf</option>
                    <option value="2" {if $annonce->annonce_etat == 2}selected{/if}>Usag&eacute;</option>
                    <option value="3" {if $annonce->annonce_etat == 3}selected{/if}>Epave</option>
                 {/if}
            </select>                                                        
			</span>
		  </p>
		  <p class="clearfix">
			<label>Action: *</label>
			<span class="champ">
            <select class="user_input4 user_input_select input_middle" name="annonce_action" id="annonce_action"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Action:</option>
                {if $toForfait->forfait_packId == 3}
                    <option value="1" {if $annonce->annonce_action == 1}selected{/if}>OFFRE</option>
                    <option value="2" {if $annonce->annonce_action == 2}selected{/if}>DEMANDE</option>
                {else}
                    <option value="3" {if $annonce->annonce_action == 3}selected{/if}>A ACHETER</option>
                    <option value="4" {if $annonce->annonce_action == 4}selected{/if}>A CHERCHER</option>
                    <option value="5" {if $annonce->annonce_action == 5}selected{/if}>A LOUER</option>
                    <option value="6" {if $annonce->annonce_action == 6}selected{/if}>A VENDRE</option>
                    <option value="7" {if $annonce->annonce_action == 7}selected{/if}>A ECHANGER</option>
                    <option value="8" {if $annonce->annonce_action == 8}selected{/if}>RENCONTRE</option>
                {/if}
            </select>                                                        
			</span>
		  </p>
		  <p class="clearfix">
			<label>Offre: *</label>
			<span class="champ">
            <select class="user_input4 user_input_select input_middle" name="annonce_offreId" id="annonce_offreId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Offre:</option>
                <option value="1" {if $annonce->annonce_offreId == 1}selected{/if}>particuli&egrave;re</option>
                <option value="2" {if $annonce->annonce_offreId == 2}selected{/if}>professionnelle</option>
                <option value="3" {if $annonce->annonce_offreId == 3}selected{/if}>commerciale</option>
                <option value="4" {if $annonce->annonce_offreId == 4}selected{/if}>de candidat</option>
            </select>                                                        
			</span>
		  </p>

		  <h2>Personne &agrave; contacter</h2>

		  <p class="clearfix">
			<label>Nom: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactNom" name="annonce_contactNom" value="{if $annonce->annonce_contactNom != ""}{$annonce->annonce_contactNom}{else}{$utilisateur->utilisateur_nom}{/if}" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Pr&eacute;nom: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactPrenom" name="annonce_contactPrenom" value="{if $annonce->annonce_contactPrenom != ""}{$annonce->annonce_contactPrenom}{else}{$utilisateur->utilisateur_prenom}{/if}" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Email: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactEmail" name="annonce_contactEmail" value="{if $annonce->annonce_contactEmail != ""}{$annonce->annonce_contactEmail}{else}{$utilisateur->utilisateur_email}{/if}" tmt:pattern="email" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Adresse: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="annonce_contactAdresse" name="annonce_contactAdresse" value="{if $annonce->annonce_contactAdresse != ""}{$annonce->annonce_contactAdresse}{else}{$utilisateur->utilisateur_adresse}{/if}" tmt:required="true" tmt:filters="" maxlength="50">
          	</span>
		  </p>
                                                    
		  <p class="clearfix">
			<label>Province: *</label>
			<span class="champ">
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
			</span>
		  </p>
		  <p class="clearfix">
			<label>Localit&eacute;: *</label>
			<span class="champ">
            <select style="width:220px;" class="user_input4 user_input_select input_middle" name="annonce_localiteId" id="annonce_localiteId"  tmt:invalidvalue="0" tmt:required="true">			
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
			</span>
		  </p>
		  <p class="clearfix">
			<label>T&eacute;l&eacute;phone: *</label>
			<span class="champ">
				<input class="user_input3" type="text" id="annonce_contactTelephone" name="annonce_contactTelephone" value="{if $annonce->annonce_contactTelephone != ""}{$annonce->annonce_contactTelephone}{else}{$utilisateur->utilisateur_telephone}{/if}" tmt:pattern="phone" tmt:required="true" tmt:filters="" maxlength="50">                                                        
          	</span>
		  </p>
		  <p class="clearfix">
			<label>P&eacute;riode d'appel: *</label>
			<span class="champ">
            <select class="user_input4 user_input_select input_middle" name="annonce_contactPeriodeAppel" id="annonce_contactPeriodeAppel"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">P&eacute;riode:</option>
                <option value="1" {if $annonce->annonce_contactPeriodeAppel == 1}selected{/if}>Matin</option>
                <option value="2" {if $annonce->annonce_contactPeriodeAppel == 2}selected{/if}>Midi</option>
                <option value="3" {if $annonce->annonce_contactPeriodeAppel == 3}selected{/if}>Apr&egrave;s midi</option>
                <option value="4" {if $annonce->annonce_contactPeriodeAppel == 4}selected{/if}>Soir&eacute;e</option>
                <option value="5" {if $annonce->annonce_contactPeriodeAppel == 5}selected{/if}>Nuit</option>
                <option value="6" {if $annonce->annonce_contactPeriodeAppel == 6}selected{/if}>La journ&eacute;e</option>
            </select>                                                        
			</span>
		  </p>

			<div class="clearer"></div>
		  <h2>Photos</h2>
                                                	
            <div class="box_inner box_end">
                <br>
                <table width="610" height="300" class="tableLP">
                    <tbody><tr class="trLPLeft">
                        <td class="tdLPLeft">
                            <table class="tableLP">
                                <tbody><tr class="trLP">
                                    <td width="360" height="290" class="tdLPBlackBorder">
                                        <div id="profileimage" class="profileimage can_edit">
                                            <img width="360" height="270" id="profile_pic" name="profile_pic" src="{$j_basepath}resize/annonce/images/popup/{$annonce->annonce_photo}">
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
                                                    <a id="linkthumb{$oPhotos->photo_id}" href="javascript:voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});"><img width="90" height="68" onmouseover="voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/annonce/images/abrege/{$oPhotos->photo_photo}"></a>

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

		  <p class="clearfix">
			<label>R&eacute;sum&eacute;: </label>
			<span class="champ">
				<textarea style="width:608px;height:60px;" class="user_input_select1" id="annonce_resume" name="annonce_resume" rows="5" tmt:filters="" >{$annonce->annonce_resume}</textarea>
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Description g&eacute;n&eacute;rale: *</label>
			<span class="champ">
				<textarea style="width:608px;height:150px;" class="user_input_select1" id="annonce_description" name="annonce_description" rows="10" tmt:required="true">{$annonce->annonce_description}</textarea>
          	</span>
		  </p>

		  <h2>Publication</h2>
          
		  <p class="clearfix" style="display: block;">
			<label>Publier:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="annonce_publier" name="annonce_publier" {if $annonce->annonce_publier == 1}checked{/if} value="1">
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>PublierHome:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="annonce_publierHome" name="annonce_publierHome" {if $annonce->annonce_publierHome == 1}checked{/if} value="1">
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>A la Une:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="annonce_laUne" name="annonce_laUne" {if $annonce->annonce_laUne == 1}checked{/if} value="1">
			</span>
		  </p>	
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'annonce~annonceBo_listeAnnonces', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>

    {if $annonce->annonce_id != 0}
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
                    <img id="profile_pic_popup" name="profile_pic_popup" src="{$j_basepath}resize/annonce/images/popup/{if $annonce->annonce_photo != ""}{$annonce->annonce_photo}{else}nophoto.jpg{/if}" alt="{$annonce->annonce_titre}">
                </span>
            </div>
            <div class="result_foot">
                {$annonce->annonce_titre}
            </div>
        </div>
        <div class="result_pop_up_foot"></div>
    </div>                                    
    {/if}	
    
{/if}	  
{$footer}