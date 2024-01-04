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
                                                        <span class="value"><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=> $cid)}">{$zCid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $mot}
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value"><a href="{jurl 'officiel~officielFo_officielResultList', array('mot'=> $mot)}">{$zMot}</a></span>
                                                    </div>
                                                    {/if}        
                                                    {if $parution}
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value"><a href="{jurl 'officiel~officielFo_officielResultList', array('parution'=> $parution)}">depuis {$zParution}</a></span>
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
                                        	<span class="viewTitre">{$iNbEnreg} actualit&eacute;{if $iNbEnreg > 1}s{/if} trouv&eacute;e{if $iNbEnreg > 1}s{/if}</span> 
                                        </div>                                     
                                    </div>                                    
                                    
									<p style="clear: both;height:5px;"></p>
                                    <span class="view">Affichage :</span>                                    
									{assign $tPost = array('affichage'=>'detail', 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'officiel~officielFo_officielResultList', $tPost}" class="formButton_detail{if $affichage == 'detail'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'abrege', 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'officiel~officielFo_officielResultList', $tPost}" class="formButton_abrege{if $affichage == 'abrege'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'photo', 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'officiel~officielFo_officielResultList', $tPost}" class="formButton_photo{if $affichage == 'photo'}_hover{/if}">valid</a>
                                    
									<p class="resultReturn">
                                   		<a href="{jurl 'officiel~officielFo_officielCategorieList'}">Retour &agrave; la liste des cat&eacute;gories</a>                                    
                                    </p>                                    
                                    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
										<table class="commOfficiel expanded" cellspacing="0"  id="tableListeOfficiel" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
                                            <thead>
                                                <tr>
                                                    {assign $i=0}
                                                    {foreach $tHead as $headFields}
                                                        {if $headFields['sortField']!=''}
                                                            <th class="{$headFields['class']}" sortField="{$headFields['sortField']}">
                                                            	<h4 class="mast">
                                                            	{$headFields['libelle']}
                                                                </h4>
                                                            </th>
                                                        {/if}
                                                    {/foreach}
                                                </tr>
                                        	</thead>
                                            <tbody>	
                                                {if sizeof($toOfficiel)==0}
                                                    <tr class="row1">
                                                        <td class="annonceBody1" colspan="6">Aucune actualit&eacute; pour votre recherche</td>
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
                                                    {assign $i=0}
                                                    {assign $j=0}
                                                    {foreach $toOfficiel as $oOfficiel}
                                                    {assign $tPost = array('acid'=>$oOfficiel->officiel_id, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}                                                    
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a href="{jurl 'officiel~officielFo_officielDetail', $tPost}" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="{$oOfficiel->officiel_titre}" src="{$j_basepath}resize/officiel/images/abrege/{$oOfficiel->officiel_photo}" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5>{$oOfficiel->categorieOff_libelle}</h5>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5><a class="titre" href="{jurl 'officiel~officielFo_officielDetail', $tPost}">{$oOfficiel->officiel_titre}</a></h5>
                                                            <ul class="split">
                                                                <li class="last">R&eacute;f. <a>{$oOfficiel->officiel_reference}</a></li>
                                                            </ul>                                                            
                                                            <p>
                                                                <span class="parution">Source : <a>{$oOfficiel->officiel_source}</a></span>
                                                            </p>
                                                            <p>
                                                                <span class="parution">Vue : <a>{$oOfficiel->officiel_visite}</a></span>
                                                            </p>
                                                            <p>
                                                                <span class="parution">Commentaire : <a>{$oOfficiel->officiel_nbComment}</a></span>
                                                            </p>
                                                        </td>
                                                        {*}
                                                        <td class="annonceBody2">
                                                            <h5><span class="nowrap">{$oOfficiel->officiel_resume}</span><span class="supp_info"></span></h5>
                                                        </td>
                                                        {*}
                                                        <td class="annonceBody5">
                                                            <p><span class="parution">{$oOfficiel->officiel_datePublication}</span></p>
                                                        </td>                                                
                                                    </tr>    
                                                    {assign $j++}
                                                    {/foreach}

                                                    {if $nbPage > 1}                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">                                                                
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {if $page == $nbPage}{$iNbEnreg}{else}{$iFinEnreg}{/if} sur {$iNbEnreg} officiel(s)</p>
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
                                        <p class="pagination">&nbsp;</p>
                                        </div>
                                    </div>