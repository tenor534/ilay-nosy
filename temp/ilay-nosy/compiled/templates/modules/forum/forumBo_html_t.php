<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_a5c6ea6e33e97028b08c2315200a9879($t){

return $t->_meta;
}
function template_a5c6ea6e33e97028b08c2315200a9879($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des forums</h1>

<?php if(isset($t->_vars['listeForumBo'])):?>	
	<h2>Liste des forums</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'forum~forumBo_editionForum');?>">Nouveau forum </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeForumBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'une forum</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='forumForm' name='forumForm' action="<?php jtpl_function_html_jurl( $t,'forum~forumBo_sauvegardeForum', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="forum_id" name="forum_id" value="<?php echo $t->_vars['forum']->forum_id; ?>">

		  <p class="clearfix">
			<label>Cat&eacute;gorie : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="forum_categorieForId" id="forum_categorieForId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php foreach($t->_vars['listeCategorieFor'] as $t->_vars['olisteCategorieFor']):?>
					<?php if($t->_vars['olisteCategorieFor']->categorieFor_id==$t->_vars['forum']->forum_categorieForId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<option value="<?php echo $t->_vars['olisteCategorieFor']->categorieFor_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olisteCategorieFor']->categorieFor_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>

		  <div id="divForum">
          <p class="clearfix">
			<label>Parent : *</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="forum_parentId" id="forum_parentId">			
				<option value="0">Racine</option>
				<?php foreach($t->_vars['listeForum'] as $t->_vars['olisteForum']):?>
					<?php if($t->_vars['olisteForum']->forum_id==$t->_vars['forum']->forum_parentId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<?php $t->_vars['indent']="";?>
                    <?php for($t->_vars['i']=0; $t->_vars['i']<$t->_vars['olisteForum']->forum_level;$t->_vars['i']++):?>
						<?php $t->_vars['indent']=$t->_vars['indent'] . " - ";?>
                    <?php endfor;?>
					<option value="<?php echo $t->_vars['olisteForum']->forum_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['indent'];  echo $t->_vars['olisteForum']->forum_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>
          </div>

		  <p class="clearfix">
			<label>Path: *</label>
			<span class="champ"><input readonly="readonly" class="user_input1" type="text" id='forum_path' name='forum_path' tmt:filters="nohtml" value="<?php echo htmlspecialchars($t->_vars['forum']->forum_path); ?>" maxlength="100"></span>
		  </p>

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" name='forum_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['forum']->forum_libelle); ?>">
				ex : Appartements
			</span>
		  </p>
		  <p class="clearfix">
			<label>Description :</label>
			<span class="champ">
                <textarea style="width:608px;height:60px;" class="user_input_select1" id="forum_description" name="forum_description" rows="5" tmt:filters="" ><?php echo $t->_vars['forum']->forum_description; ?></textarea>
			</span>
		  </p>

		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'forum~forumBo_listeForums', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>