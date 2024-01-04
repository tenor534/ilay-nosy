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
                                                        <span class="value"><a href="{jurl 'actualite~actualiteFo_actualiteResultList', array('cid'=> $cid)}">{$zCid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $mot}
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value"><a href="{jurl 'actualite~actualiteFo_actualiteResultList', array('mot'=> $mot)}">{$zMot}</a></span>
                                                    </div>
                                                    {/if}        
                                                    {if $parution}
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value"><a href="{jurl 'actualite~actualiteFo_actualiteResultList', array('parution'=> $parution)}">depuis {$zParution}</a></span>
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
									{assign $tPost = array('affichage'=>'detail', 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'actualite~actualiteFo_actualiteResultList', $tPost}" class="formButton_detail{if $affichage == 'detail'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'abrege', 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'actualite~actualiteFo_actualiteResultList', $tPost}" class="formButton_abrege{if $affichage == 'abrege'}_hover{/if}">valid</a>
									{assign $tPost = array('affichage'=>'photo', 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>1, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}
                                    <a href="{jurl 'actualite~actualiteFo_actualiteResultList', $tPost}" class="formButton_photo{if $affichage == 'photo'}_hover{/if}">valid</a>
                                    
									<p class="resultReturn">
                                   		<a href="{jurl 'actualite~actualiteFo_actualiteCategorieList'}">Retour &agrave; la liste des cat&eacute;gories</a>                                    
                                    </p>                                    
                                    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">
                                        <div class="sortableListWithPagination">
										<table class="commActualite expanded" cellspacing="0"  id="tableListeActualite" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
                                            <tbody>
                                                {if sizeof($toActualite)==0}
                                                    <tr class="row1">
                                                        <td class="actualiteBody1" colspan="6" align="center">Aucune actualite pour votre recherche</td>
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
                                                        {foreach $toActualite as $oActualite}
                                                        {assign $tPost = array('acid'=>$oActualite->actualite_id, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}                                                    
                                                        {if $i==0}
                                                        	<li style="height:10px;"></li>                                                    
                                                        {/if}                                                            
                                                        <li class="result result_express">
                                                            <div class="result_title">
                                                                <h4><a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">{$oActualite->actualite_titre}</a> <span class="price">&nbsp;<span class="price_info">&nbsp;</span></span></h4>
                                                                <div>
                                                                    <p><span class="special">{$oActualite->categorieAct_libelle}</span></p>
                                                                    <ul class="split">
                                                                        <li class="last date">Parue le {$oActualite->actualite_datePublication}</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="clearer"></div>
                                                            </div>
                                                        
                                                            <div class="result_desc">
                                                                <div class="img_photo">
                                                                    <a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}"><img width="180" height="135" border="1" name="imgPrinc{$oActualite->actualite_id}" src="{$j_basepath}resize/actualite/images/photo/{$oActualite->actualite_photo}" alt="{$oActualite->actualite_titre}"></a>
                                                                    <div class="extra_etiquette">{$oActualite->actualite_nbPhoto} photo{if $oActualite->actualite_nbPhoto > 1}s{/if}</div>	    
                                                                </div>
                                                                <div class="desc_txt">
                                                                    <ul>
                                                                    	<li>Source&nbsp;: <strong>{$oActualite->actualite_source}</strong></li>
                                                                    	<li>Vue&nbsp;: <strong>{$oActualite->actualite_visite}</strong></li>
                                                                    	<li>Commentaire&nbsp;: <strong>{$oActualite->actualite_nbComment}</strong></li>
                                                                    </ul>
                                                                    <div class="intro">
                                                                        <p>{$oActualite->actualite_resume} <a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">(pour plus de détails)</a></p>
                                                                    </div>
                                                                    <h5>Caractéristiques</h5>
                                                                    <p>{$oActualite->actualite_texte}</p>
                                                                </div>
                                                            </div>    
                                                            <div class="result_foot">
                                                                <ul>
                                                                    <p class="regTextPaleNormal borderNoneInline">Référence: <strong>{$oActualite->actualite_reference}</strong></p>
                                                                    <li class="borderLeftInline">&nbsp;</li>
                                                                </ul>
                                                                <ul class="split float_r">
                                                                    <li class="last"><a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}" class="bt_add" onclick="">Voir l'actualite</a></li>
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
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {if $page == $nbPage}{$iNbEnreg}{else}{$iFinEnreg}{/if} sur {$iNbEnreg} actualite(s)</p>
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