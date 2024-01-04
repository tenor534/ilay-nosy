									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">R&eacute;sultats de votre recherche</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">&nbsp;</span>
										</p>
									</div>

									<p style="clear: both;height:5px;"></p>
									<div id="viewCriteria">
                                    	<div class="headPan">
                                        	<span class="viewTitre">R&eacute;capitulatif de vos crit&egrave;res</span> 
                                        </div> 
                                    	<div class="middlePan">
	                                        <div class="blank">
		                                        <div class="content">
                                                    {if $cid}
                                                    <div class="criteria">
                                                        <span class="item">Cat&eacute;gorie:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('cid'=> $cid)}">{$zCid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $rid}
                                                    <div class="criteria">
                                                        <span class="item">Rubrique:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('rid'=> $rid)}">{$zRid}</a></span>
                                                    </div>
                                                    {/if}
                                            
                                                    {if $mot}
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('mot'=> $mot)}">{$zMot}</a></span>
                                                    </div>
                                                    {/if}        
                                                    {if $crid}
                                                    <div class="criteria">
                                                        <span class="item">Rubrique:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('crid'=> $crid)}">{$zCrid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $parution}
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('parution'=> $parution)}">depuis {$zParution}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $localite}
                                                    <div class="criteria">
                                                        <span class="item">Localit&eacute;:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('localite'=> $localite)}">{$zLocalite}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $province}
                                                    <div class="criteria">
                                                        <span class="item">Province:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('province'=> $province)}">{$zProvince}</a></span>
                                                    </div>
                                                    {/if}
                                            
                                                    {if $prix2}
                                                    <div class="criteria">
                                                        <span class="item">Prix entre:</span>
                                                        <span class="value"><a href="{jurl 'annonce~annonceFo_annonceResultList', array('prix1'=> $prix1, 'prix2'=> $prix2)}">{$zPrix1} et {$zPrix2} Ar</a></span>
                                                    </div>
                                                    {/if}
                                            
                                                    {if $affichage}
                                                    <div class="criteria">
                                                        <span class="item">Affichage:</span>
                                                        <span class="value">{$zAffichage}</span>
                                                    </div>
                                                    {/if}
	                                         	</div>       
	                                        </div>                                     
                                        </div>                                     
                                    	<div class="footPan">
                                        	<span class="viewTitre">{$iNbEnreg} annonce{if $iNbEnreg > 1}s{/if} trouv&eacute;e{if $iNbEnreg > 1}s{/if}</span> 
                                        </div>                                     
                                    </div>                                    
                                    
									<p style="clear: both;height:5px;"></p>
                                    <span class="view">Affichage :</span>                                    
									{assign $tPost = array('affichage'=>'detail', 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'annonce~annonceFo_annonceResultList', $tPost}" class="formButton_detail{if $affichage == 'detail'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'abrege', 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'annonce~annonceFo_annonceResultList', $tPost}" class="formButton_abrege{if $affichage == 'abrege'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'photo', 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'annonce~annonceFo_annonceResultList', $tPost}" class="formButton_photo{if $affichage == 'photo'}_hover{/if}">valid</a>
                                    
									<p class="resultReturn">
                                   		<a href="{jurl 'annonce~annonceFo_annonceCategorieList'}">Retour &agrave; la liste des cat&eacute;gories</a>                                    
                                    </p>                                    
                                    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">
                                        <div class="sortableListWithPagination">
										<table class="commAnnonce expanded" cellspacing="0"  id="tableListeAnnonce" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
                                            <tbody>
                                                {if sizeof($toAnnonce)==0}
                                                    <tr class="row1">
                                                        <td class="annonceBody1" colspan="6" align="center">Aucune annonce pour votre recherche</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">&nbsp;</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                {else}
													<div id="results">
									                <ul>
                                                    
                                                        {assign $i=0}
                                                        {assign $j=0}
                                                        {foreach $toAnnonce as $oAnnonce}
                                                        {assign $tPost = array('anid'=>$oAnnonce->annonce_id, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}                                                    
                                                        {if $i==0}
                                                        	<li style="height:10px;"></li>                                                    
                                                        {/if}                                                            
                                                        <li class="result result_express">
                                                            <div class="result_title">
                                                                <h4><a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">{$oAnnonce->annonce_titre}</a> <span class="price">{if $oAnnonce->annonce_prix}{$oAnnonce->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}<span class="price_info"> {$oAnnonce->annonce_prixInfo}</span></span></h4>
                                                                <div>
                                                                    <p><span class="special">Forfait {$oAnnonce->annonce_pack}</span></p>
                                                                    <ul class="split">
                                                                        <li><span>{$oAnnonce->annonce_province} ({$oAnnonce->annonce_localite})</span></li>
                                                                        <li class="last date">Parue le {$oAnnonce->annonce_dateDebut|date_format:"%d/%m/%Y"}</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="clearer"></div>
                                                            </div>
                                                        
                                                            <div class="result_desc">
                                                                <div class="img_photo">
                                                                    <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}"><img width="180" height="135" border="1" name="imgPrinc{$oAnnonce->annonce_id}" src="{$j_basepath}resize/annonce/images/photo/{$oAnnonce->annonce_photo}" alt="{$oAnnonce->annonce_titre}"></a>
                                                                    <div class="extra_etiquette">{$oAnnonce->annonce_nbPhoto} photo{if $oAnnonce->annonce_nbPhoto > 1}s{/if}</div>	    
                                                                </div>
                                                                <div class="desc_txt">
                                                                    <ul><li>Année&nbsp;: <strong>{$oAnnonce->annonce_annee}</strong></li><li>État&nbsp;: <strong>{$oAnnonce->annonce_etat}</strong></li></ul>
                                                                    <div class="intro">
                                                                        <p>{$oAnnonce->annonce_resume} <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">(pour plus de détails)</a></p>
                                                                    </div>
                                                                    <h5>Caractéristiques</h5>
                                                                    <p>{$oAnnonce->annonce_description}</p>
                                                                </div>
                                                            </div>    
                                                            <div class="result_foot">
                                                                <ul>
                                                                    <p class="regTextPaleNormal borderNoneInline">Référence: <strong>{$oAnnonce->annonce_reference}</strong></p>
                                                                    <li class="borderLeftInline">
                                                                        <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}" class="hotTopics">Offre de {$oAnnonce->annonce_offre}</a>
                                                                    </li>
                                                                </ul>
                                                                <ul class="split float_r">
                                                                    <li class="last"><a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}" class="bt_add" onclick="">Voir l'annonce</a></li>
                                                                    {*}<li class="last"><a href="" onclick="" class="bt_taf" title="Envoyer à un ami">Envoyer à un ami</a></li>{*}
                                                                </ul>
                                                            </div>
                                                        </li><!-- result end -->
                                                        {assign $i++}
 														{/foreach}
															
                                                        <!-- result end -->
                                                    </ul>
                                                    </div>

                                                    {if $nbPage > 1}                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {if $page == $nbPage}{$iNbEnreg}{else}{$iFinEnreg}{/if} sur {$iNbEnreg} annonce(s)</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                    <ul class="pageNumbers">
                                                                    
                                                                        <li class="firstButton"><a class="pageFirst" alt="First page" href="#">First</a></li>
                                                                        <li class="prevButton"><a class="pagePrevious" alt="Previous page" href="#">Previous</a></li>
                                                                        
                                                                        <li class="noButton"><a href="#">1</a></li>
                                                                        <li class="noButton">2</li>
                                                                        <li class="noButton"><a href="#">3</a></li>
                                                                        <li class="noButton"><a href="#">4</a></li>
                                                                        <li class="noButton"><a href="#">5</a></li>
                                                                        <li class="noButton"><a href="#">6</a></li>
                                                                        <li class="lastPage"><a href="#">7</a></li>                                            
                                                                        
                                                                        <li class="nextButton"><a class="pageNext" alt="Next page" href="#">Next</a></li>
                                                                        <li class="lastButton"><a class="pageLast" alt="Last page" href="#">Last</a></li>
                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                    {else}
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">&nbsp;</p>
                                                                </div>
                                                                <div class="commFoot3">
                                                                </div>
                                                            </div>                                                                                                                                              
                                                        </td>
                                                    </tr>
                                                    {/if}
                                                    
                                                {/if}
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>