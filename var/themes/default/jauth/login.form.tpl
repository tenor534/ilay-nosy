{meta_html css $j_basepath.'design/back/css/common.css'}
<div id="login">
	<img src="{$j_basepath}design/back/images/login.jpg" class="logo" alt="logo"/>
	<form action="{jurl 'jauth~login_in'}" method="post">
       	<input type="hidden" name="auth_url_return" value="{$auth_url_return}">
	  	<p><label>Identifiant</label><input type="text" value="{$login}" name="login" /></p>
	    <p><label>Mot de passe</label><input type="password" value="" name="password" /></p>
	    {*}
        <p><label>Service</label>
			<select name="service" id="service"  tmt:invalidvalue="0" tmt:required="true">			
			<option value="0">Select</option>
				{foreach $listeService as $olisteService}
					{if $olisteService['service_id']==$service}
						{assign $selected="selected"}
					{else}
						{assign $selected=""}
					{/if}
					<option value="{$olisteService['service_id']}" {$selected}>{$olisteService['service_libelle']}</option>
				{/foreach}
			</select>
		</p>
        {*}
		<p class="align_right"><input type="image" src="{$j_basepath}design/back/images/btn_se_connecter.gif" class="btn_image" /> </p>
	</form>
	{if $failed}
		<p class="message">Login ou mot de passe incorrect</p>
	{/if}
</div>