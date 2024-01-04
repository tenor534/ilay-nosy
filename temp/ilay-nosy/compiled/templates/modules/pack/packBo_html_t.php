<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_4da3155acd93fe8b76ff5f890ef8accf($t){

return $t->_meta;
}
function template_4da3155acd93fe8b76ff5f890ef8accf($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des packs</h1>

<?php if(isset($t->_vars['listePackBo'])):?>	
	<h2>Liste des packs</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">
		<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'pack~packBo_editionPack');?>">Nouveau pack </a>
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listePackBo']; ?>		
	</div>
<?php else:?>	  
	<h2>Edition d'un pack</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='packForm' name='packForm' action="<?php jtpl_function_html_jurl( $t,'pack~packBo_sauvegardePack', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="pack_id" name="pack_id" value="<?php echo $t->_vars['pack']->pack_id; ?>">

		  <input type="hidden" id="pack_photo" name="pack_photo" value="<?php if($t->_vars['pack']->pack_photo): echo $t->_vars['j_basepath']; ?>resize/pack/photos/<?php echo $t->_vars['pack']->pack_photo;  endif;?>">
		  <input type="hidden" id="auxvisuel" name="auxvisuel" value="">

		  <p class="clearfix">
			<label>Libellé* :</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:400px;" id='pack_libelle' name='pack_libelle' tmt:required="true" tmt:minlength="3" tmt:maxlength="100" value="<?php echo htmlspecialchars($t->_vars['pack']->pack_libelle); ?>">
				ex : Immobilier
			</span>
		  </p>
		  <p class="clearfix">
			<label>Code* :</label>
			<span class="champ">
				<input class="user_input5" type="text" style="width:50px;" id='pack_code' name='pack_code' tmt:required="true" tmt:minlength="2" tmt:maxlength="5" value="<?php echo htmlspecialchars($t->_vars['pack']->pack_code); ?>">
				ex : IMMO
			</span>
		  </p>

		  <p class="clearfix">
			<label>Photo: *</label>
			<span class="champ">
				<input class="user_input1" type="text" id="champsvisuel" name="champsvisuel" <?php if(!$t->_vars['pack']->pack_photo):?>tmt:required="true"<?php endif;?>  style="width:300px;" value="" readonly>
				&nbsp;&nbsp;&nbsp;
				<a class="bouton" id="photo" href="javascript:;">Browse ...</a>
			</span>
		  </p>
		  <div id="appercuPhoto" style="padding-left:5px;background-color:#AEE0F5;margin:0px 5px 3px; overflow:auto; width:98%;"><?php echo $t->_vars['visuel']; ?></div>

		
        <?php if($t->_vars['pack']->pack_fichier != ''):?>
        <p class="clearfix">
            <label>Actual File linked</label>
            <span class="champ">
                <input type="text" name="pack_fichier_view" id="pack_fichier_view" value="<?php if($t->_vars['pack']->pack_fichier): echo $t->_vars['pack']->pack_fichier;  endif;?>" style="width:240px;vertical-align:middle;top:auto;border:0px; "  readonly="readonly" />
            </span> 
        </p>
        <?php endif;?>			
        <p class="clearfix">
            <?php if($t->_vars['pack']->pack_fichier != ''):?>
            <label>Replace by*</label>
            <?php else:?>
            <label>File to link*</label>
            <?php endif;?>
            <span class="champ">
                <input type="hidden" name="pack_fichier" id="pack_fichier" value="<?php if($t->_vars['pack']->pack_fichier): echo $t->_vars['j_basepath']; ?>resize/pack/<?php echo $t->_vars['pack']->pack_fichier;  endif;?>" />
                <input class="user_input1" type="text" name="champs_fichier" id="champs_fichier" style="width:388px" value="" readonly  <?php if($t->_vars['pack']->pack_id==""):?> tmt:required="true"<?php endif;?> /> 
                &nbsp;&nbsp;&nbsp;<a class="bouton" id="fichier"  href="#">Parcourir ...</a>
            </span> 
        </p>			

		  
		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a class="bouton submit" href="#">Valider</a>
			<a class="bouton" href="<?php jtpl_function_html_jurl( $t,'pack~packBo_listePacks', array('page'=>$t->_vars['page']));?>">Annuler</a>
		  </p>
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>