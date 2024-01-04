{$header}
<h1>Gestion des pages de groupe, officiel, communaut&eacute;</h1>

{if isset($listeOfficielBo)}	
	<h2>Liste des Pages / Groupes / Communaut&eacute;s</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'officiel~officielBo_editionOfficiel'}">Nouvelle page </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeOfficielBo}		
	</div>
{else}	  
	<h2>Edition d'une page</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='officielForm' name='officielForm' action="{jurl 'officiel~officielBo_sauvegardeOfficiel', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="officiel_id" name="officiel_id" value="{$officiel->officiel_id}">
		  <input type="hidden" id="officiel_photo" name="officiel_photo" value="{if $officiel->officiel_photo}{$j_basepath}resize/officiel/photos/{$officiel->officiel_photo}{/if}">
		  <input type="hidden" id="officiel_photoSave" name="officiel_photoSave" value="{if $officiel->officiel_photo}{$j_basepath}resize/officiel/photos/{$officiel->officiel_photo}{/if}">
		  <input type="hidden" id="auxvisuel" name="auxvisuel" value="">
          
		  <p class="clearfix">
			<label>S&eacute;lectionner une cat&eacute;gorie : *</label>
			<span class="champ">
            <select class="user_input1 user_input_select input_middle" name="officiel_categorieOffId" id="officiel_categorieOffId"  tmt:invalidvalue="0" tmt:required="true">			
                <option value="0">Cat&eacute;gorie:</option>
                {foreach $toCategorieOffs as $oCategorieOff}
                    {if $oCategorieOff->categorieOff_id==$officiel->officiel_categorieOffId}
                        {assign $selected="selected"}
                    {else}
                        {assign $selected=""}
                    {/if}
                    <option value="{$oCategorieOff->categorieOff_id}" {$selected}>{$oCategorieOff->categorieOff_libelle}</option>
                {/foreach}
            </select>
			</span>
		  </p>
		  {if $officiel->officiel_id != 0}
		  <p class="clearfix">
			<label>R&eacute;f&eacute;rence: </label>
			<span class="champ">
				<input readonly="readonly" style="width:548px;background-color:#AEE0F5;border-color:#AEE0F5;font-weight:bold;" class="user_input1" type="text" id="officiel_reference" name="officiel_reference" value="{$officiel->officiel_reference}" tmt:filters="" maxlength="70">
          	</span>
		  </p>
          {/if}
		  <p class="clearfix">
			<label>Titre de l'officiel: *</label>
			<span class="champ">
				<input style="width:548px;" class="user_input1" type="text" id="officiel_titre" name="officiel_titre" value="{$officiel->officiel_titre}" tmt:required="true" tmt:filters="" maxlength="70">
          	</span>
		  </p>
          
		  <p class="clearfix">
			<label>R&eacute;sum&eacute;: </label>
			<span class="champ">
				<textarea style="width:608px;height:60px;" class="user_input_select1" id="officiel_resume" name="officiel_resume" rows="5" tmt:filters="" >{$officiel->officiel_resume}</textarea>
          	</span>
		  </p>
		  <p class="clearfix">
			<label>Corp: *</label>
			<span class="champ">
				<textarea style="width:608px;height:150px;" class="user_input_select1" id="officiel_texte" name="officiel_texte" rows="10" tmt:required="true">{$officiel->officiel_texte}</textarea>
          	</span>
		  </p>
          
		  <p class="clearfix">
			<label>Source: *</label>
			<span class="champ">
				<input style="width:548px;" class="user_input1" type="text" id="officiel_source" name="officiel_source" value="{$officiel->officiel_source}" tmt:required="true" tmt:filters="" maxlength="70">
          	</span>
		  </p>


		  <p class="clearfix">
			<label>Photo: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="champsvisuel" name="champsvisuel" {if !$officiel->officiel_photo}tmt:required="true"{/if}  style="width:300px;" value="" readonly>
				&nbsp;&nbsp;&nbsp;
				<a class="bouton" id="photo" href="javascript:;">Browse ...</a>
			</span>
		  </p>
		  <div id="appercuPhoto" style="padding-left:5px;background-color:#AEE0F5;margin:0px 5px 3px; overflow:auto; width:98%;">{$visuel}</div>

        {if $officiel->officiel_fichier != ''}
        <p class="clearfix">
            <label>Actual File linked</label>
            <span class="champ">
                <input type="text" name="officiel_fichier_view" id="officiel_fichier_view" value="{if $officiel->officiel_fichier}{$officiel->officiel_fichier}{/if}" style="width:240px;vertical-align:middle;top:auto;border:0px; "  readonly="readonly" />
            </span> 
        </p>
        {/if}			
        <p class="clearfix">
            {if $officiel->officiel_fichier != ''}
            <label>Replace by*</label>
            {else}
            <label>File to link*</label>
            {/if}
            <span class="champ">
                <input type="hidden" name="officiel_fichier" id="officiel_fichier" value="{if $officiel->officiel_fichier}{$j_basepath}resize/officiel/{$officiel->officiel_fichier}{/if}" />
                <input class="user_input1" type="text" name="champs_fichier" id="champs_fichier" style="width:388px" value="" readonly  {if $officiel->officiel_id==""} tmt:required="true"{/if} /> 
                &nbsp;&nbsp;&nbsp;<a class="bouton" id="fichier"  href="#">Parcourir ...</a>
            </span> 
        </p>			


		  <h2>Publication</h2>
          
		  <p class="clearfix" style="display: block;">
			<label>Date :</label>
			<span class="champ">
				{*}<input style="width:120px;" class="user_input3" type="text" id="officiel_datePublication" name="officiel_datePublication" value="{$officiel->officiel_datePublication|date_format:'%d/%m/%Y %H:%M:%S'}" tmt:required="true" tmt:datepattern="DD/MM/YYYY HH:ii:ss" maxlength="19">{*}
                <input style="width:120px;" class="user_input3" type="text" id="officiel_datePublication" name="officiel_datePublication" value="{$officiel->officiel_datePublication|date_format:'%d/%m/%Y %H:%M:%S'}" tmt:required="true" maxlength="19">
                DD/MM/YYYY HH:ii:ss
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>Publier:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="officiel_publier" name="officiel_publier" {if $officiel->officiel_publier == 1}checked{/if} value="1">
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>PublierHome:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="officiel_publierHome" name="officiel_publierHome" {if $officiel->officiel_publierHome == 1}checked{/if} value="1">
			</span>
		  </p>	
		  <p class="clearfix" style="display: block;">
			<label>A la Une:</label>
			<span class="champ">
				<input class="radio" type="checkbox" id="officiel_laUne" name="officiel_laUne" {if $officiel->officiel_laUne == 1}checked{/if} value="1">
			</span>
		  </p>	

		 {if $officiel->officiel_id != 0}
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
                                            <img width="360" height="270" id="profile_pic" name="profile_pic" src="{$j_basepath}resize/officiel/images/popup/{$toPhotos[0]->photo_photo}">
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
                                                    <a id="linkthumb{$oPhotos->photo_id}" href="javascript:voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});"><img width="90" height="68" onmouseover="voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/officiel/images/abrege/{$oPhotos->photo_photo}"></a>

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
			{/if}
		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'officiel~officielBo_listeOfficiels', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>

    {if $officiel->officiel_id != 0}
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
                    <img id="profile_pic_popup" name="profile_pic_popup" src="{$j_basepath}resize/officiel/images/popup/{if $officiel->officiel_photo != ""}{$officiel->officiel_photo}{else}nophoto.jpg{/if}" alt="{$officiel->officiel_titre}">
                </span>
            </div>
            <div class="result_foot">
                {$officiel->officiel_titre}
            </div>
        </div>
        <div class="result_pop_up_foot"></div>
    </div>                                    
    {/if}	
    
{/if}	  
{$footer}