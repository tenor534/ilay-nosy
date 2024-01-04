									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste de vos actualites</span> 
                                      	</p>          

   										<p style="clear:both">
                                            {assign $nbForfaitActualite = 0}
                                            {foreach $listeAbonnement as $olisteAbonnement}
                                                {if $olisteAbonnement->abonnement_id==$aid}
                                                    {assign $nbForfaitActualite = $olisteAbonnement->forfait_nbActualite}
                                                {/if}
                                            {/foreach}
                                            {*}NB Actualite épuisé{*}
                                            {assign $nbUsedActualite = sizeof($toActualite)}
                                            {*}NB Actualite restant pour cet abonnement{*}
                                            {assign $nbFreeActualite = $nbForfaitActualite - $nbUsedActualite}
                                            <span class="viewTexte">Voici la liste de vos actualites selon l'abonnement que vous avez choisi.</span> 
                                                
                                            {if $nbFreeActualite > 0 }
                                                {if $nbForfaitActualite}
                                                   <span class="viewTexte">Vous pouvez encore ajouter {$nbFreeActualite} actualite(s) pour cet abonnement.</span>
                                                {/if}    
                                            {else}   
                                                {if $nbUsedActualite}
                                                   <span class="viewTexte red">Vous avez atteint votre limite ({$nbForfaitActualite}) d'ajout d'actualites pour cet abonnement.</span>
                                                {/if}    
                                             {/if}   
                                         </p>
									</div>
                                    
                                    <form id="actualiteForm" name="actualiteForm" action="#" method="post">
                                    	<input type="hidden" id="aid" name="aid" value="{$aid}" />
                                    	<input type="hidden" id="acid" name="acid" value="0" />
                                    	<input type="hidden" id="page" name="page" value="{$page}" />
                                        <div style="clear: both;" class="actualiteContent">                                        
                                            <!--p class="actualiteTitre">Recherche</p-->
                                            <div id="search_standard" class="actualiteCriteriaLine">
                                                <div class="actualiteCriteria">
                                                    <label for="forum_parue">S&eacute;lectionner un abonnement: </label><br>
                                                    <select style="width:600px;" class="user_input1 user_input_select input_middle" name="actualite_abonnementId" id="actualite_abonnementId"  tmt:invalidvalue="0" tmt:required="true" onchange="selectAbonnement(this);">			
                                                        <option value="0">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                        {foreach $listeAbonnement as $olisteAbonnement}
                                                            {if $olisteAbonnement->abonnement_id==$aid}
                                                                {assign $selected="selected"}
                                                            {else}
                                                                {assign $selected=""}
                                                            {/if}
                                                            <option value="{$olisteAbonnement->abonnement_id}" {$selected}>PACK : {$olisteAbonnement->pack_libelle} ({$olisteAbonnement->forfait_libelle}) - R&eacute;f. {$olisteAbonnement->abonnement_reference}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </form>
									<p style="clear: both;height:5px;"></p>
                                   {if $nbFreeActualite > 0 }                                   			
                                        <p style="clear: both;height:5px;"></p>                                                                        
                                        <a href="javascript:addActualite();" class="formButton_add">Ajouter</a>                                    
                                    {/if}    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
										<table class="commActualite expanded" cellspacing="0"  id="tableListeActualite" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
                                                {if sizeof($toActualite)==0}
                                                    <tr class="row1">
                                                        <td class="actualiteBody1" colspan="6">Aucune actualite enregistr&eacute;e</td>
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
                                                    {foreach $toActualite as $oActualite}
                                                    {assign $tPost= array('actualite_id'=> $oActualite->actualite_id, 'page'=>$page)}                                                    
                                                    {*assign $nbAffectActualite = $oActualite->actualite_nbCC + $oActualite->actualite_nbCA + $oActualite->actualite_nbAB + $oActualite->actualite_nbAN*}
                                                    <tr>
                                                        <td class="actualiteBody0">
                                                            <a href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$oActualite->actualite_id, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="{$oActualite->actualite_titre}" src="{$j_basepath}resize/actualite/images/abrege/{$oActualite->actualite_photo}" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="actualiteBody1">
                                                            <h5><a class="titre" href="{jurl 'actualite~actualiteFo_actualiteEdit', array('acid'=>$oActualite->actualite_id, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">{$oActualite->actualite_titre}</a></h5>
                                                            <ul class="split">
                                                                <li>Actualite ref. <a>{$oActualite->actualite_reference}</a></li>
                                                                <li class="last">{$oActualite->actualite_offre}</li>
                                                            </ul>
                                                        </td>
                                                        <td class="actualiteBody2">
                                                            <h5><span class="nowrap">{if $oActualite->actualite_prix}{$oActualite->actualite_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</span><span class="supp_info">{$oActualite->actualite_prixInfo}</span></h5>
                                                        </td>
                                                        <td class="actualiteBody3">
                                                            <h5>{$oActualite->actualite_annee} <span class="supp_info">{$oActualite->actualite_etat}</span></h5>
                                                        </td>
                                                        <td class="actualiteBody4">
															<p><input type="checkbox" name="actualitePublier_{$oActualite->actualite_id}" value="{$oActualite->actualite_publier}" {if $oActualite->actualite_publier == 1}checked{/if} onclick="return checkActualite(this);"></p>
                                                        </td>
                                                        <td class="actualiteBody5">
                                                            <p><span class="parution">{$oActualite->actualite_dateDebut|date_format:"%d/%m/%Y"}</span></p>
                                                        </td>                                                
                                                    </tr>    
                                                    {assign $j++}
                                                    {/foreach}
                                                    {*}
                                                    <p class="pagination">
                                                        PAGE :&nbsp;&nbsp;&nbsp;<a href="#" class="currentPage">1</a> - <a href="#">2</a> - <a href="#">3</a> - <a href="#">4</a> - <a href="#">5</a> - <a href="#">6</a> - <a href="#">7</a> - <a href="#">8</a> - <a href="#">9</a> - <a href="#">10</a> - <a href="#">11</a>&nbsp;&nbsp;<a href="#">&gt;&gt;</a>
                                                    </p>
                                                    {*}        
                                                    {if $nbPage > 1}                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {$iFinEnreg} sur {$iNbEnreg} actualite(s)</p>
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