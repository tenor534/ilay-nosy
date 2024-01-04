	  <form name="frmLogin" id="frmLogin" action="{jurl 'accueil~accueilFo_connexionUtilisateur'}" method="post">
        <p>
          <label for="nom">NOM D'UTILISATEUR</label>
          <input class="rechercher" type="text" name="login" {if $errconnexion}style="background:red;" value=""{/if}/>
        </p>
        <p>
          <label for="mot">MOT DE PASSE</label>
          <input class="rechercher" type="password" name="password" {if $errconnexion}style="background:red;" value=""{/if}/>
          <input class="validbt2" type="submit" value="OK"/>
        </p>
	<p>
	{if $errconnexion}
		<font style="color:red; font-size:9px;">Erreur.</font>&nbsp;
	{/if}
	<a href="#" id="mdp_oublie" >Mot de passe oubli&eacute; ?</a>
	</p>
	</form>
