									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Les petites annonces</span> 
                                      	</p>          

   										<p style="clear:both">
                                            {*assign $nbUsedPetiteAnnonce = sizeof($toPetiteAnnonce)*}
                                            {assign $nbUsedPetiteAnnonce = $iNbEnreg}
                                            
                                            <span class="viewTexte">Choisissez une cat&eacute;gorie pour visualiser la liste des petites annonces correspondantes.</span> 
                                             <br>   
                                            {if $nbUsedPetiteAnnonce > 0 }
                                             	<span class="viewTexte">{$nbUsedPetiteAnnonce} annonce(s) pour cette cat&eacute;gorie.</span>
                                            {else}   
                                                 <span class="viewTexte red">Aucune annonce trouv&eacute;e.</span>
                                             {/if}   
                                         </p>
									</div>
                                    
                                    <form id="annonceForm" name="annonceForm" action="#" method="post">
                                    	<input type="hidden" id="cid" name="cid" value="{$cid}" />
                                    	<input type="hidden" id="anid" name="anid" value="0" />
                                    	<input type="hidden" id="page" name="page" value="{$page}" />
                                        <div style="clear: both;" class="annonceContent">                                        
                                            <!--p class="annonceTitre">Recherche</p-->
                                            <div id="search_standard" class="annonceCriteriaLine">
                                                <div class="annonceCriteria">
                                                    <label for="forum_parue">S&eacute;lectionner une cat&eacute;gorie d'annonce: </label><br>
                                                    <select style="width:600px;" class="user_input1 user_input_select input_middle" name="petiteAnnonce_categorieAnId" id="petiteAnnonce_categorieAnId"  tmt:invalidvalue="0" tmt:required="true" onchange="selectCategorieAn(this);">			
                                                        <option value="0">Cat&eacute;gories d'annonces</option>
                                                        {foreach $listeCategorieAn as $olisteCategorieAn}
                                                            {if $olisteCategorieAn->categorieAn_id==$cid}
                                                                {assign $selected="selected"}
                                                            {else}
                                                                {assign $selected=""}
                                                            {/if}
                                                            <option value="{$olisteCategorieAn->categorieAn_id}" {$selected}>{$olisteCategorieAn->categorieAn_libelle}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </form>
									<p style="clear: both;height:5px;"></p>
                                   {*if $nbFreePetiteAnnonce > 0 }                                   			
                                        <p style="clear: both;height:5px;"></p>                                                                        
                                        <a href="javascript:addPetiteAnnonce();" class="formButton_add">Ajouter</a>                                    
                                    {/if*}    
									<p style="clear: both;height:10px;"></p>
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
										<table class="commPetiteAnnonce expanded" cellspacing="0"  id="tableListePetiteAnnonce" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
                                                {if sizeof($toPetiteAnnonce)==0}
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
                                                    {foreach $toPetiteAnnonce as $oPetiteAnnonce}
                                                    {assign $tPost= array('petiteAnnonce_id'=> $oPetiteAnnonce->petiteAnnonce_id, 'page'=>$page)}                                                    
                                                    {*assign $nbAffectPetiteAnnonce = $oPetiteAnnonce->petiteAnnonce_nbCC + $oPetiteAnnonce->petiteAnnonce_nbCA + $oPetiteAnnonce->petiteAnnonce_nbAB + $oPetiteAnnonce->petiteAnnonce_nbAN*}
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a class="parution">
                                                            {$oPetiteAnnonce->petiteAnnonce_reference}
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                        	{if $cid == 0}
	                                                        <span class="announceCategorie">
					                                            {$oPetiteAnnonce->categorieAn_libelle}                                            
                                                            </span>
                                                            {/if}
                                                            <span class="announceDescription">
	                                                            {$oPetiteAnnonce->petiteAnnonce_description}
                                                            </span>
                                                        </td>
                                                        <td class="annonceBody2">
                                                            <h5><span class="nowrap">{if $oPetiteAnnonce->petiteAnnonce_prix}{$oPetiteAnnonce->petiteAnnonce_prix|format_number: 0, ",", ' ','Ar'}{else}N/D{/if}</span><span class="supp_info">{$oPetiteAnnonce->petiteAnnonce_prixInfo}</span></h5>
                                                            {*}
                                                            <ul class="split">
                                                                <li>PetiteAnnonce ref. <a>{$oPetiteAnnonce->petiteAnnonce_reference}</a></li>
                                                                <li class="last">{$oPetiteAnnonce->petiteAnnonce_offre}</li>
                                                            </ul>
                                                            {*}
                                                        </td>
                                                        <td class="annonceBody3">
                                                            {$oPetiteAnnonce->petiteAnnonce_contact}
                                                        </td>
                                                        <td class="annonceBody5">
                                                            <p><span class="parution">{$oPetiteAnnonce->petiteAnnonce_dateCreation|date_format:"%d/%m/%Y (%H:%M:%S)"}</span></p>
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