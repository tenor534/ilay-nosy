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
									{assign $tPost = array('affichage'=>'detail', 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'annonce~annonceFo_annonceResultList', $tPost}" class="formButton_detail{if $affichage == 'detail'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'abrege', 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'annonce~annonceFo_annonceResultList', $tPost}" class="formButton_abrege{if $affichage == 'abrege'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'photo', 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
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
                                                
                                                    <p style="clear: both;height:5px;"></p>
                                                    <div id="results">
                                                    <ul id="result_photo" class="img_photo">
                                                        {assign $i=0}
                                                        {assign $j=0}
                                                        {foreach $toAnnonce as $oAnnonce}
                                                        {assign $tPost = array('anid'=>$oAnnonce->annonce_id, 'affichage'=> $affichage, 'cid'=> $cid, 'rid'=> $rid, 'mot'=> $mot, 'crid'=> $crid, 'parution'=> $parution, 'province'=> $province, 'localite'=> $localite, 'prix1'=> $prix1, 'prix2'=> $prix2, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}                                                    
                                                    
                                                            <li class="result_img">            
                                                                <span class="extra_etiquette">{$oAnnonce->annonce_nbPhoto} photo{if $oAnnonce->annonce_nbPhoto > 1}s{/if}</span>
                                                                <a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">
                                                                <img alt="{$oAnnonce->annonce_titre}" src="{$j_basepath}resize/annonce/images/photo/{$oAnnonce->annonce_photo}">
                                                                </a>
                                                                <center></center>
                                                                <p>
                                                                <span class="titrePhoto"><a href="{jurl 'annonce~annonceFo_annonceDetail', $tPost}">{$oAnnonce->annonce_titre}</a></span><br>
                                                                <strong>Prix :</strong> {if $oAnnonce->annonce_prix}{$oAnnonce->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}&nbsp;{$oAnnonce->annonce_prixInfo}<br>
                                                                <strong>Ann&eacute; :</strong> {$oAnnonce->annonce_annee}<br>
                                                                <strong>Etat :</strong> {$oAnnonce->annonce_etat}<br>
                                                                <strong>Parue depuis : </strong>{if $oAnnonce->annonce_parution == 0}Aujourd'hui{else}{$oAnnonce->annonce_parution} jour{if $oAnnonce->annonce_parution > 1}s{/if}{/if}
                                                                </p>
                                                                
                                                            </li>        
                                                            {assign $j++}
                                                            
                                                            {if $j == 3}
                                                                <li class="pub-5"><div id="pub-5" style="display: none;"></div></li><div class="clearer"></div>        
                                                                {assign $j = 0}
                                                            {/if}           
                                                        {/foreach}
                                                    </ul>                                  
                                                    </div>
                                                    <p style="clear: both;height:5px;"></p>

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