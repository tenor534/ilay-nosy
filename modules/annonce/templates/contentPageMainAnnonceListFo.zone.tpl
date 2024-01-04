									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste de vos annonces</span> 
                                      	</p>          

   										<p style="clear:both">
                                            {assign $nbForfaitAnnonce = 0}
                                            {foreach $listeAbonnement as $olisteAbonnement}
                                                {if $olisteAbonnement->abonnement_id==$aid}
                                                    {assign $nbForfaitAnnonce = $olisteAbonnement->forfait_nbAnnonce}
                                                {/if}
                                            {/foreach}
                                            {*}NB Annonce épuisé{*}
                                            {*assign $nbUsedAnnonce = sizeof($toAnnonce)*}
                                            {assign $nbUsedAnnonce = $iNbEnreg}
                                            
                                            {*}NB Annonce restant pour cet abonnement{*}
                                            {assign $nbFreeAnnonce = $nbForfaitAnnonce - $nbUsedAnnonce}
                                            <span class="viewTexte">Voici la liste de vos annonces selon l'abonnement que vous avez choisi.</span> 
                                                
                                            {if $nbFreeAnnonce > 0 }
                                                {if $nbForfaitAnnonce}
                                                   <span class="viewTexte">Vous pouvez encore ajouter {$nbFreeAnnonce} annonce(s) pour cet abonnement.</span>
                                                {/if}    
                                            {else}   
                                                {if $nbUsedAnnonce}
                                                   <span class="viewTexte red">Vous avez atteint votre limite ({$nbForfaitAnnonce}) d'ajout d'annonces pour cet abonnement.</span>
                                                {/if}    
                                             {/if}   
                                         </p>
									</div>
                                    
                                    <form id="annonceForm" name="annonceForm" action="#" method="post">
                                    	<input type="hidden" id="aid" name="aid" value="{$aid}" />
                                    	<input type="hidden" id="anid" name="anid" value="0" />
                                    	<input type="hidden" id="page" name="page" value="{$page}" />
                                        <div style="clear: both;" class="annonceContent">                                        
                                            <!--p class="annonceTitre">Recherche</p-->
                                            <div id="search_standard" class="annonceCriteriaLine">
                                                <div class="annonceCriteria">
                                                    <label for="forum_parue">S&eacute;lectionner un abonnement: </label><br>
                                                    <select style="width:600px;" class="user_input1 user_input_select input_middle" name="annonce_abonnementId" id="annonce_abonnementId"  tmt:invalidvalue="0" tmt:required="true" onchange="selectAbonnement(this);">			
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
                                   {if $nbFreeAnnonce > 0 }                                   			
                                        <p style="clear: both;height:5px;"></p>                                                                        
                                        <a href="javascript:addAnnonce();" class="formButton_add">Ajouter</a>                                    
                                    {/if}    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
										<table class="commAnnonce expanded" cellspacing="0"  id="tableListeAnnonce" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
                                                {if sizeof($toAnnonce)==0}
                                                    <tr class="row1">
                                                        <td class="annonceBody1" colspan="6">Aucune annonce enregistr&eacute;e</td>
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
                                                    {foreach $toAnnonce as $oAnnonce}
                                                    {assign $tPost= array('annonce_id'=> $oAnnonce->annonce_id, 'page'=>$page)}                                                    
                                                    {*assign $nbAffectAnnonce = $oAnnonce->annonce_nbCC + $oAnnonce->annonce_nbCA + $oAnnonce->annonce_nbAB + $oAnnonce->annonce_nbAN*}
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a href="{jurl 'annonce~annonceFo_annonceEdit', array('anid'=>$oAnnonce->annonce_id, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="{$oAnnonce->annonce_titre}" src="{$j_basepath}resize/annonce/images/abrege/{$oAnnonce->annonce_photo}" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5><a class="titre" href="{jurl 'annonce~annonceFo_annonceEdit', array('anid'=>$oAnnonce->annonce_id, 'page'=>$page, 'aid'=>$aid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">{$oAnnonce->annonce_titre}</a></h5>
                                                            <ul class="split">
                                                                <li>Annonce ref. <a>{$oAnnonce->annonce_reference}</a></li>
                                                                <li class="last">{$oAnnonce->annonce_offre}</li>
                                                            </ul>
                                                        </td>
                                                        <td class="annonceBody2">
                                                            <h5><span class="nowrap">{if $oAnnonce->annonce_prix}{$oAnnonce->annonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</span><span class="supp_info">{$oAnnonce->annonce_prixInfo}</span></h5>
                                                        </td>
                                                        <td class="annonceBody3">
                                                            <h5>{$oAnnonce->annonce_annee} <span class="supp_info">{$oAnnonce->annonce_etat}</span></h5>
                                                        </td>
                                                        <td class="annonceBody4">
															<p><input type="checkbox" name="annoncePublier_{$oAnnonce->annonce_id}" value="{$oAnnonce->annonce_publier}" {if $oAnnonce->annonce_publier == 1}checked{/if} onclick="return checkAnnonce(this);"></p>
                                                        </td>
                                                        <td class="annonceBody5">
                                                            <p><span class="parution">{$oAnnonce->annonce_dateDebut|date_format:"%d/%m/%Y"}</span></p>
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
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {$iFinEnreg} sur {$iNbEnreg} annonce(s)</p>
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