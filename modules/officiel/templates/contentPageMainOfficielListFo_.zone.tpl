									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste de vos officiels</span> 
                                      	</p>          

   										<p style="clear:both">
                                            {assign $nbForfaitOfficiel = 0}
                                            {foreach $listeAbonnement as $olisteAbonnement}
                                                {if $olisteAbonnement->abonnement_id==$aid}
                                                    {assign $nbForfaitOfficiel = $olisteAbonnement->forfait_nbOfficiel}
                                                {/if}
                                            {/foreach}
                                            {*}NB Officiel épuisé{*}
                                            {assign $nbUsedOfficiel = sizeof($toOfficiel)}
                                            {*}NB Officiel restant pour cet abonnement{*}
                                            {assign $nbFreeOfficiel = $nbForfaitOfficiel - $nbUsedOfficiel}
                                            <span class="viewTexte">Voici la liste de vos officiels selon l'abonnement que vous avez choisi.</span> 
                                                
                                            {if $nbFreeOfficiel > 0 }
                                                {if $nbForfaitOfficiel}
                                                   <span class="viewTexte">Vous pouvez encore ajouter {$nbFreeOfficiel} officiel(s) pour cet abonnement.</span>
                                                {/if}    
                                            {else}   
                                                {if $nbUsedOfficiel}
                                                   <span class="viewTexte red">Vous avez atteint votre limite ({$nbForfaitOfficiel}) d'ajout d'officiels pour cet abonnement.</span>
                                                {/if}    
                                             {/if}   
                                         </p>
									</div>
                                    
                                    <form id="officielForm" name="officielForm" action="#" method="post">
                                    	<input type="hidden" id="aid" name="aid" value="{$aid}" />
                                    	<input type="hidden" id="acid" name="acid" value="0" />
                                    	<input type="hidden" id="page" name="page" value="{$page}" />
                                        <div style="clear: both;" class="officielContent">                                        
                                            <!--p class="officielTitre">Recherche</p-->
                                            <div id="search_standard" class="officielCriteriaLine">
                                                <div class="officielCriteria">
                                                    <label for="forum_parue">S&eacute;lectionner un abonnement: </label><br>
                                                    <select style="width:600px;" class="user_input1 user_input_select input_middle" name="officiel_abonnementId" id="officiel_abonnementId"  tmt:invalidvalue="0" tmt:required="true" onchange="selectAbonnement(this);">			
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
                                   {if $nbFreeOfficiel > 0 }                                   			
                                        <p style="clear: both;height:5px;"></p>                                                                        
                                        <a href="javascript:addOfficiel();" class="formButton_add">Ajouter</a>                                    
                                    {/if}    
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
                                                        <td class="officielBody1" colspan="6">Aucune officiel enregistr&eacute;e</td>
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
                                                    {assign $tPost= array('officiel_id'=> $oOfficiel->officiel_id, 'page'=>$page)}                                                    
                                                    {*assign $nbAffectOfficiel = $oOfficiel->officiel_nbCC + $oOfficiel->officiel_nbCA + $oOfficiel->officiel_nbAB + $oOfficiel->officiel_nbAN*}
                                                    <tr>
                                                        <td class="officielBody0">
                                                            <a href="{jurl 'officiel~officielFo_officielEdit', array('acid'=>$oOfficiel->officiel_id, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="{$oOfficiel->officiel_titre}" src="{$j_basepath}resize/officiel/images/abrege/{$oOfficiel->officiel_photo}" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="officielBody1">
                                                            <h5><a class="titre" href="{jurl 'officiel~officielFo_officielEdit', array('acid'=>$oOfficiel->officiel_id, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">{$oOfficiel->officiel_titre}</a></h5>
                                                            <ul class="split">
                                                                <li>Officiel ref. <a>{$oOfficiel->officiel_reference}</a></li>
                                                                <li class="last">{$oOfficiel->officiel_offre}</li>
                                                            </ul>
                                                        </td>
                                                        <td class="officielBody2">
                                                            <h5><span class="nowrap">{if $oOfficiel->officiel_prix}{$oOfficiel->officiel_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</span><span class="supp_info">{$oOfficiel->officiel_prixInfo}</span></h5>
                                                        </td>
                                                        <td class="officielBody3">
                                                            <h5>{$oOfficiel->officiel_annee} <span class="supp_info">{$oOfficiel->officiel_etat}</span></h5>
                                                        </td>
                                                        <td class="officielBody4">
															<p><input type="checkbox" name="officielPublier_{$oOfficiel->officiel_id}" value="{$oOfficiel->officiel_publier}" {if $oOfficiel->officiel_publier == 1}checked{/if} onclick="return checkOfficiel(this);"></p>
                                                        </td>
                                                        <td class="officielBody5">
                                                            <p><span class="parution">{$oOfficiel->officiel_dateDebut|date_format:"%d/%m/%Y"}</span></p>
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
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {$iFinEnreg} sur {$iNbEnreg} officiel(s)</p>
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