									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">R&eacute;sultats de votre recherche</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">Liste des sujets du forum : {$zCid} &raquo; {$zFid}</span>
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
                                                    {if $fid}
                                                    <div class="criteria">
                                                        <span class="item">Forum:</span>
                                                        <span class="value"><a href="{jurl 'forum~forumFo_forumSujetList', array('fid'=> $fid)}">{$zFid}</a></span>
                                                    </div>
                                                    {/if}
                                                    {if $mot}
                                                    <div class="criteria">
                                                        <span class="item">Mot:</span>
                                                        <span class="value">{$zMot}</span>
                                                    </div>
                                                    {/if}        
                                                    {if $parution}
                                                    <div class="criteria">
                                                        <span class="item">Parution:</span>
                                                        <span class="value">depuis {$zParution}</span>
                                                    </div>
                                                    {/if}
                                                    {if $precision}
                                                    <div class="criteria">
                                                        <span class="item">Pr&eacute;cision:</span>
                                                        <span class="value">{$zPrecision}</span>
                                                    </div>
                                                    {/if}
	                                         	</div>
	                                        </div>                                     
                                        </div>                                     
                                    	<div class="footPan">
                                        	<span class="viewTitre">{$iNbEnreg} sujet{if $iNbEnreg > 1}s{/if} trouv&eacute;{if $iNbEnreg > 1}s{/if}</span> 
                                        </div>                                     
                                    </div>                                    
                                    
									<p style="clear: both;height:5px;"></p>
                                    
									<p class="resultReturn">
                                   		<a href="{jurl 'forum~forumFo_forumCategorieList'}">Retour &agrave; la liste des forums</a>                                    
                                    </p>                                    
                                    
									<p style="clear: both;height:10px;"></p>
                                    <h3>Consulter les sujets du forum : <span>{$zCid} &raquo; </span> <i>{$zFid}</i></h3>
                                    
                                    {if sizeof($toUtilisateur)}
                                        <p style="clear: both;height:0px;">
	                                        <p class="errorMessage" id="errorMessage" style="float:left;margin-left:200px;"></p>
                                            <a id="formButton_add" class="formButton_add" style="float:right;"{*} onclick="addSujet();"{*}></a>
                                            <a id="formButton_ok" class="formButton_ok" style="float:right;"{*} onclick="validSujet();"{*}></a>
                                        </p>
                                        <p style="clear: both;height:5px;"></p>
                                    {/if}
                                    
                                    <div class="ajaxZone">                                    
                                        <div class="sortableListWithPagination">
									<form id='newsForm' name='newsForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                    
                                        <input type="hidden" id="fid" name="fid" value="{$fid}" />
                                        {if sizeof($toUtilisateur)}
                                        <input type="hidden" id="userId" name="userId" value="{$toUtilisateur->utilisateur_id}" />
                                        <input type="hidden" id="userLogin" name="userLogin" value="{$toUtilisateur->utilisateur_login}" />
                                        <input type="hidden" id="userPhoto" name="userPhoto" value="{$toUtilisateur->utilisateur_photo}" />
                                        <input type="hidden" id="userDateCreation" name="userDateCreation" value='{$toUtilisateur->utilisateur_dateCreation|date_format:"%d/%m/%Y"}' />
                                        <input type="hidden" id="userNbComment" name="userNbComment" value="{$toUtilisateur->utilisateur_nbComment}" />
                                        {/if}
									<table class="commForum expanded" cellspacing="0"  id="tableListeSujet" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">

                                        <thead>
                                        <tr>
                                            <td class="forumHead0">
                                                <h4 class="mast">
                                                    Sujets
                                                </h4>
                                            </td>
                                            <td class="forumHead2">
                                                <h4 class="mast">
                                                    R&eacute;ponses
                                                </h4>
                                            </td>
                                            <td class="forumHead4">
                                                <h4 class="mast">
                                                    Auteurs
                                                </h4>
                                            </td>
                                            <td class="forumHead3">
                                                <h4 class="mast">
                                                    Derni&egrave;re r&eacute;ponse
                                                </h4>
                                            </td>
                                        </tr>
                                        </thead>                                       
                                        
                                        <tbody id="tbodyComment">
                                        
                                        	{foreach $toSujet as $oSujet}
                                                {assign $tPost = array('fid'=>$oSujet->sujet_forumId, 'sid'=> $oSujet->sujet_id)}
                                                <tr>
                                                    <td class="forumBody0">
                                                        <a class="blueHead" href="{jurl 'forum~forumFo_forumMessageList', $tPost}">{$oSujet->sujet_titre}</a>
                                                        <p class="regTextPale">{$oSujet->sujet_datePublication|date_format:"%d/%m/%Y (%H:%M:%S)"}</p>
                                                    </td>
                                                    <td class="forumBody2">
                                                        <p>{$oSujet->sujet_nbReponse}</p>
                                                    </td>
                                                    <td class="forumBody4">
                                                        <a class="lastPost" href="#">{$oSujet->sujet_auteur}</a>
                                                    </td>
                                                    <td class="forumBody3">
                                                    	<p><a class="lastPost" href="#">{$oSujet->sujet_commentlastDate|date_format:"%d/%m/%Y (%H:%M:%S)"}</a></p>
	                                                    <a class="lastPost" href="">{$oSujet->sujet_commentlastUser}</a>
                                                        {if $oSujet->sujet_commentlastId}
	                                                        <a class="reviewPost" href="{jurl 'forum~forumFo_forumMessageList', array('fid'=>$oSujet->sujet_forumId, 'sid'=>$oSujet->sujet_commentlastId)}"> ... lire</a>
                                                        {/if}
                                                    </td>
                                                </tr>
											{/foreach}
                                            {if $nbPage > 1}                                        
                                            <tr>
                                                <td colspan="4">
                                                    <div class="commFoot">
                                                        <div class="static">                                                                
                                                            <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {if $page == $nbPage}{$iNbEnreg}{else}{$iFinEnreg}{/if} sur {$iNbEnreg} sujet(s)</p>
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
                                        </tbody>
                                	</table>
                                     {*}                                           
										<table class="commSujet expanded" cellspacing="0"  id="tableListeSujet" currentSortField="{$sortField}" currentSortDirection="{$sortDirection}" currentPage="{$page}" nbPage="{$nbPage}" src="{jurl 'commun~communBo_getZone', $tParams}">
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
                                                {if sizeof($toSujet)==0}
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
                                                    {foreach $toSujet as $oSujet}
                                                    {assign $tPost = array('acid'=>$oSujet->sujet_id, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'nbPagination'=> $nbPagination, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}                                                    
                                                    <tr>
                                                        <td class="annonceBody0">
                                                            <a href="{jurl 'sujet~sujetFo_sujetDetail', $tPost}" class="blueHead">
                                                            <img width="98" height="74" border="0" alt="{$oSujet->sujet_titre}" src="{$j_basepath}resize/sujet/images/abrege/{$oSujet->sujet_photo}" name="imgPrinc">
                                                            </a>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5>{$oSujet->categorieAct_libelle}</h5>
                                                        </td>
                                                        <td class="annonceBody1">
                                                            <h5><a class="titre" href="{jurl 'sujet~sujetFo_sujetDetail', $tPost}">{$oSujet->sujet_titre}</a></h5>
                                                            <ul class="split">
                                                                <li class="last">R&eacute;f. <a>{$oSujet->sujet_reference}</a></li>
                                                            </ul>                                                            
                                                            <p>
                                                                <span class="parution">Source : <a>{$oSujet->sujet_source}</a></span>
                                                            </p>
                                                            <p>
                                                                <span class="parution">Vue : <a>{$oSujet->sujet_visite}</a></span>
                                                            </p>
                                                            <p>
                                                                <span class="parution">Commentaire : <a>{$oSujet->sujet_nbComment}</a></span>
                                                            </p>
                                                        </td>
                                                        <td class="annonceBody5">
                                                            <p><span class="parution">{$oSujet->sujet_datePublication}</span></p>
                                                        </td>                                                
                                                    </tr>    
                                                    {assign $j++}
                                                    {/foreach}

                                                    {if $nbPage > 1}                                        
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="commFoot">
                                                                <div class="static">                                                                
                                                                    <p class="regTextPale forumFoot">Affiche {$iDebutEnreg} -&gt; {if $page == $nbPage}{$iNbEnreg}{else}{$iFinEnreg}{/if} sur {$iNbEnreg} sujet(s)</p>
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
                                        {*}
                                        <p class="pagination">&nbsp;</p>
                                        </div>
                                    </div>
                                    {*literal}
                                    <script language="javascript">
                                    	//Desactive button : Ajouter
										$('#formButton_ok').addClass("hidden_elem");		
										$('#errorMessage').removeAttr("style");
										$('#errorMessage').attr("style", 'float:left;margin-left:300px;');		
										$('#errorMessage').addClass("hidden_elem");		

                                    </script>
                                    {/literal*}