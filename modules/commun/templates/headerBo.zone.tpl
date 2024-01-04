<div id="mainPage">
	<div id="navLeft">
		<div id="navContent">
			<img src="{$j_basepath}design/back/images/admin.jpg" alt="Gamma" id="logo_menu">
			{literal}
			<script type="text/javascript">
				var menuactive ={/literal}{$menusActifs}{literal};
				document.write(createMenu ({/literal}{$menus}{literal}));
			</script>
			{/literal}
		</div>
	</div>
	<div id="mainContent">
		<div id="contentHeader">
			<a style="padding-left:5px;padding-top:12px; float:left;">&nbsp;Bonjour <b>{$prenom}&nbsp;{$nom}</b></a>
			<a href="{jurl 'jauth~login_out'}" id="deconnexion"><img src="{$j_basepath}design/back/images/btn_deconnexion.jpg" alt="d&eacute;connexion" /></a>
		</div>
	    <div id="contentOuter">
	    	<div id="contentInner">        
