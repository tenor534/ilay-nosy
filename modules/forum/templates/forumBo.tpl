{$header}
<h1>Gestion des forums</h1>

{if isset($listeForumBo)}	
	<h2>Liste des forums</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="{jurl 'forum~forumBo_editionForum'}">Nouveau forum </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		{$listeForumBo}		
	</div>
{else}	  
	<h2>Edition d'une forum</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='forumForm' name='forumForm' action="{jurl 'forum~forumBo_sauvegardeForum', array('page'=>$page)}" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="forum_id" name="forum_id" value="{$forum->forum_id}">

		  <p class="clearfix">
			<label>Cat&eacute;gorie : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="forum_categorieForId" id="forum_categorieForId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				{foreach $listeCategorieFor as $olisteCategorieFor}
					{if $olisteCategorieFor->categorieFor_id==$forum->forum_categorieForId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteCategorieFor->categorieFor_id}" {$selected}>{$olisteCategorieFor->categorieFor_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>

		  <div id="divForum">
          <p class="clearfix">
			<label>Parent : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="forum_parentId" id="forum_parentId">			
				<option value="0">Racine</option>
				{foreach $listeForum as $olisteForum}
					{if $olisteForum->forum_id==$forum->forum_parentId}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					{assign $indent=""}
                    {for $i=0; $i<$olisteForum->forum_level;$i++}
						{assign $indent=$indent . " - "}
                    {/for}
					<option value="{$olisteForum->forum_id}" {$selected}>{$indent}{$olisteForum->forum_libelle}</option>
				{/foreach}
			</select>
			</span>
		  </p>
          </div>

		  <p class="clearfix">
			<label>Path: *</label>
			<span class="champ"><input readonly="readonly" class="user_input1" type="text" id='forum_path' name='forum_path' tmt:filters="nohtml" value="{$forum->forum_path|escxml}" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='forum_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="{$forum->forum_libelle|escxml}">
				ex : Appartements
			</span>
		  </p>
		  <p class="clearfix">
			<label>Description :</label>
			<span class="champ">
                <textarea style="width:608px;height:60px;" class="user_input_select1" id="forum_description" name="forum_description" rows="5" tmt:filters="" >{$forum->forum_description}</textarea>
			</span>
		  </p>

		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="{jurl 'forum~forumBo_listeForums', array('page'=>$page)}">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
{/if}	  
{$footer}