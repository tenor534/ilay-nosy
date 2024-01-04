									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Plan du site</span> 
                                      	</p>          

   										<p style="clear:both">
                                            <span class="viewTexte"></span> 
                                         </p>
									</div>
									<p style="clear: both;height:5px;"></p>
                                    <div class="ajaxZone">                                    
                                        <div class="">
                                            <ul class="registerList">
                                                <li><span class="titre"><a href="{jurl 'accueil~accueilFo_abord'}">Accueil</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'static~staticFo_staticPage', array('stat'=>1)}">Pr&eacute;sentation de ilay NOSY</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'forum~forumFo_forumList'}">Forum</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'actualite~actualiteFo_actualiteList'}">Actualit&eacute;s</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'pratique~pratiqueFo_pratiqueList'}">Services et Pratiques</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'annonce~annonceFo_annonceCategorieList'}">Annonces class&eacute;es</a></span>
                                                    <ul>
                                                        <li><span class="puceBleue">&raquo; </span><span><a href="{jurl 'annonce~annonceFo_annonceCategorieList'}">Les cat&eacute;gories</a></span>
                                                            <ul>
                                                            {foreach $toCategories as $oCategories}
                                                                <li><span class="puceVert">&raquo; </span><span><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=>$oCategories->categorieAn_id)}">{$oCategories->categorieAn_libelle}</a> ({$toCategorieAnNBs[$oCategories->categorieAn_id]})</span></li>
                                                            {/foreach}                                                                
                                                            </ul>                                                        
                                                        </li>
                                                        <li><span class="puce">&raquo; </span><span>Les r&eacute;sultats de votre recherche</span></li>
                                                        <li><span class="puce">&raquo; </span><span>Le d&eacute;tail de l'annonce</span></li>
                                                    </ul>                
                                                </li>
                                                <li><span class="titre"><a href="{jurl 'membre~membreFo_tableBord'}">Espace Membre</a></span>
                                                    <ul>
                                                    	{if $idUtilisateurId == 0}
                                                            <li><span class="puce">&raquo; </span><span>Tableau de bord</span></li>
                                                            <li><span class="puce">&raquo; </span><span>Votre profil</span></li>
                                                            <li><span class="puce">&raquo; </span><span>Vos annonces</span></li>
                                                            <li><span class="puce">&raquo; </span><span>Vos abonnements</span></li>
                                                        {else}
                                                            <li><span class="puceBleue">&raquo; </span><span><a href="{jurl 'membre~membreFo_tableBord'}">Tableau de bord</a></span></li>
                                                            <li><span class="puceBleue">&raquo; </span><span><a href="{jurl 'membre~membreFo_profilDetail'}">Votre profil</a></span></li>
                                                            <li><span class="puceBleue">&raquo; </span><span><a href="{jurl 'annonce~annonceFo_annonceList'}">Vos annonces</a></span></li>
                                                            <li><span class="puceBleue">&raquo; </span><span><a href="{jurl 'abonnement~abonnementFo_abonnementList'}">Vos abonnements</a></span></li>
                                                        {/if}
                                                    </ul>                
                                                </li>
                                                <li><span class="titre"><a href="{jurl 'culture~cultureFo_cultureList'}">Culture</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'static~staticFo_staticPage', array('stat'=>2)}">Liens utiles</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'contact~contactFo_contactDemande'}">Nous contacter</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'static~staticFo_staticPage', array('stat'=>5)}">Plan du site</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'static~staticFo_staticPage', array('stat'=>4)}">Conditions d'utilisation</a></span></li>
                                                <li><span class="titre"><a href="{jurl 'static~staticFo_staticPage', array('stat'=>3)}">FAQ</a></span></li>
                                            </ul>

                                            <table class="commAnnonce expanded" cellspacing="0"  id="tableListeAnnonce">
                                                <tbody>	
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale cultureFoot">&nbsp;</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
									</div>