<div class="">
<table class="expanded" cellspacing="0"  id="tableListeAccueil">
	<thead>
		<tr>
			{assign $i=0}
			<th width="40%" class="color3">Sections</th>
			<th width="60%" class="color3">Menus</th>
		</tr>
	</thead>
	<tbody id="navContentInterne">
		<tr class="row{$i++%2+1}"> 
			<td class="color2"><b>GESTION DES ANNONCES</b></td>							  
			<td class="color1">
				<ul>
					<li>
						<b><a href="#">Profil</a></b>
					</li>
					<li>
						<b>Param&egrave;tres</b>
						<ul>
							<li><a href="{jurl 'utilisateur~utilisateurBo_listeUtilisateur'}">Utilisateurs</a></li>												
							<li><a href="{jurl 'pays~paysBo_listePayss'}">Pays</a></li>
						</ul>
					</li>
					
				</ul>
			</td>
		 </tr>

	 </tbody>
</table>
<p class="pagination">&nbsp;</p>
</div>