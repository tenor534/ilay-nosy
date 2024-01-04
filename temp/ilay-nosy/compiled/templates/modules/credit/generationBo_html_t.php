<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_a37193e54c2c6f2874c0e41404214881($t){

return $t->_meta;
}
function template_a37193e54c2c6f2874c0e41404214881($t){
?><?php echo $t->_vars['header']; ?>
<h1>Gestion des credits</h1>

<?php if(isset($t->_vars['listeCreditBo'])):?>	
	<h2>Liste des credits</h2>

	<p>&nbsp;</p>
	<p style="width:725px; text-align:right">
	    <p class="frmBouton" style="text-align:right; margin-right:7px;">		
        
	</p>
	</p>
	<p style="height:6px">&nbsp;</p>

	<div class="ajaxZone">
		<?php echo $t->_vars['listeCreditBo']; ?>		
	</div>
<?php else:?>	  
	<h2>G&eacute;n&eacute;ration de cr&eacute;dits</h2>
	<div class="ajaxZone">
		<form enctype="multipart/form-data" id='creditForm' name='creditForm' action="<?php jtpl_function_html_jurl( $t,'credit~creditBo_sauvegardeCredit', array('page'=>$t->_vars['page']));?>" method="POST" tmt:validate="true" tmt:callback="displayError">
		  <input type="hidden" id="credit_id" name="credit_id" value="<?php echo $t->_vars['credit']->credit_id; ?>">
		  <input type="hidden" id="credit_abonnementId" name="credit_abonnementId" value="<?php echo $t->_vars['credit']->credit_abonnementId; ?>">

		  <p class="clearfix">
			<label>Forfait :*</label>
			<span class="champ">
			<select class="user_input1 user_input_select input_middle" name="credit_forfaitId" id="credit_forfaitId"  tmt:invalidvalue="0" tmt:required="true">			
				<option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<?php foreach($t->_vars['listeForfait'] as $t->_vars['olisteForfait']):?>
					<?php if($t->_vars['olisteForfait']->forfait_id==$t->_vars['credit']->credit_forfaitId):?>
						<?php $t->_vars['selected']="selected";?>
					<?php else:?>
						<?php $t->_vars['selected']="";?>
					<?php endif;?>
					<option value="<?php echo $t->_vars['olisteForfait']->forfait_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['olisteForfait']->forfait_libelle; ?></option>
				<?php endforeach;?>
			</select>
			</span>
		  </p>

		  <p class="clearfix">
			<label>Option PLUS :*</label>
			<span class="champ">
				<input type="checkbox" id="credit_isPlus" name="credit_isPlus" style="width:5%" value="1" <?php if($t->_vars['credit']->credit_isPlus == 1):?>checked<?php endif;?>>
			</span>
		  </p>
		  <p class="clearfix">
			<label>Nombre de codes :*</label>
			<span class="champ">
				<input class="user_input1" type="text" style="width:50px;" id='credit_nbCode' name='credit_nbCode' tmt:required="true"  tmt:pattern="number" tmt:maxlength="5" value="10">
                &nbsp;par g&eacute;n&eacute;ration
			</span>
		  </p>

		  <p class="line_bottom clear">&nbsp;</p>
		  <p class="frmBouton">
			<a id="generation" class="bouton" href="#">G&eacute;n&eacute;rer</a>
		  </p>
		  <p class="line_bottom clear">&nbsp;</p>

		  <div id="automateCode">

            <table class="expanded" cellspacing="0"  id="tableListeCredit">
                <thead>
                    <tr>
                        <?php $t->_vars['i']=0;?>
                        <th class="color<?php echo $t->_vars['i']++%2+1; ?> _center">N&deg; s&eacute;rie</th>
                        <th class="color<?php echo $t->_vars['i']++%2+1; ?> _center">Code PIN</th>
                        <th class="color<?php echo $t->_vars['i']++%2+1; ?> _center">Password</th>
                        <th class="color<?php echo $t->_vars['i']++%2+1; ?> _center">Montant Ariary</th>
                    </tr>
                </thead>
            
                <tbody id="createdCode">
                 </tbody>
            </table>
          
          </div>			  
		  <p class="errorMessage" id="errorMessage"></p>  
		</form>
	</div>
<?php endif;?>	  
<?php echo $t->_vars['footer']; ?><?php 
}
?>