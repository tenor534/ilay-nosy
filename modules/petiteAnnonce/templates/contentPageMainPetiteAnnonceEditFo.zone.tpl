									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Edition d'une annonce</span> 
                                      	</p>          
   										<p style="clear: both;"></p>
									</div>

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='annonceForm' name='annonceForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="petiteAnnonce_id" name="petiteAnnonce_id" value="{$petiteAnnonce->petiteAnnonce_id}">
                                         	<input type="hidden" id="petiteAnnonce_reference" name="petiteAnnonce_reference" value="{$petiteAnnonce->petiteAnnonce_reference}">
                                         	<input type="hidden" id="petiteAnnonce_affichage" name="petiteAnnonce_affichage" value="0">
                                         	<input type="hidden" id="petiteAnnonce_publier" name="petiteAnnonce_publier" value="0">

                                            <div id="middleCol">
                                                <div class="box" id="box_annonce">
                                                    <div class="box_inner box_end box_annonce_top">

                                                        {*}
                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                            		{assign $categorieAn = ""}
                                                                    {foreach $toCategorieAns as $oCategorieAn}
                                                                        {if $oCategorieAn->categorieAn_id==$cid}
                                                                            {assign $categorieAn = $oCategorieAn->categorieAn_libelle}
                                                                        {/if}
                                                                    {/foreach}
                                                                <li><span>&gt;</span><a href="#">{$categorieAn}</a></li>
                                                            </ul>
                                                        </div>
                                                        {*}
														<ul class="split" style="margin-top:5px;">
                                                            <li class="last inline"><a href="{jurl 'petiteAnnonce~petiteAnnonceFo_petiteAnnonceList', array('page'=>$page, 'cid'=>$cid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                    
                                                        <div id="categ_rubrique">
                                                            <p style="clear: both;"></p>
                                                            <label for="forum_parue">S&eacute;lectionner une cat&eacute;gorie : </label><br>
                                                            <select class="user_input1 user_input_select input_middle" name="petiteAnnonce_categorieAnId" id="petiteAnnonce_categorieAnId"  tmt:invalidvalue="0" tmt:required="true">			
                                                                <option value="0">Cat&eacute;gorie:</option>
                                                                {foreach $toCategorieAns as $oCategorieAn}
                                                                    {if $oCategorieAn->categorieAn_id==$cid}
                                                                        {assign $selected="selected"}
                                                                    {else}
                                                                        {assign $selected=""}
                                                                    {/if}
                                                                    <option value="{$oCategorieAn->categorieAn_id}" {$selected}>{$oCategorieAn->categorieAn_libelle}</option>
                                                                {/foreach}
                                                            </select>

					   										<p style="clear: both;"></p>
                                                            <label for="petiteAnnonce_titre">Titre de l'annonce: *</label><br>
                                                            <input style="width:548px;" class="user_input1" type="text" id="petiteAnnonce_titre" name="petiteAnnonce_titre" value="{$petiteAnnonce->petiteAnnonce_titre}" tmt:required="true" tmt:filters="" maxlength="70">

					   										<p style="clear: both;"></p>
                                                            <label for="petiteAnnonce_contact">Contact&nbsp;: *(T&eacute;l., email, ou adresse )</label><br>
                                                            <input class="user_input1" type="text" id="petiteAnnonce_contact" name="petiteAnnonce_contact" value="{$petiteAnnonce->petiteAnnonce_contact}" tmt:required="true" tmt:filters="" maxlength="150" style="width:548px;">

					   										<p style="clear: both;"></p>
                                                        </div>
                                                
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_annonce_main_info">                                                    
                                                        
                                                        <div id="edit_price" class="float">
                                                            <div class="info_list">
                                                
                                                                <dl class="price">
																	<dt>Prix&nbsp;:</dt>                                                                     
                                                                    <dd>
                                                                    	<input class="user_input3" type="text" id="petiteAnnonce_prix" name="petiteAnnonce_prix" value="{$petiteAnnonce->petiteAnnonce_prix}" tmt:pattern="number" tmt:filters="" maxlength="50"> Ar 
                                                                    	<span>
	                                                                        <input class="user_input1" type="text" id="petiteAnnonce_prixInfo" name="petiteAnnonce_prixInfo" value="{$petiteAnnonce->petiteAnnonce_prixInfo}" tmt:filters="" maxlength="20">
                                                                        </span>
                                                                    </dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>    

                                                    <div class="clearer"></div>
                                            
                                    				<!-- Caractéristique Debut-->
                                                    {$caracteristique}	
                                    				<!-- Caractéristique Fin-->                                                    
                                    
                                                    <div id="edit_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>                                                        
														<textarea style="width:608px;height:150px;" class="user_input_select1" id="petiteAnnonce_description" name="petiteAnnonce_description" rows="10" tmt:required="true">{$petiteAnnonce->petiteAnnonce_description}</textarea>				
                                                        <br><br>
                                    
                                                    </div>                                        

                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_annonce_foot">
                                                        
														<ul class="split">
                                                            <li class="last inline"><a href="{jurl 'petiteAnnonce~petiteAnnonceFo_petiteAnnonceList', array('page'=>$page, 'cid'=>$cid, 'sortField'=>$sortField, 'sortDirection'=>$sortDirection)}">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>
                                          
                                            <a href="#" class="formButton_valid">Valider</a>                                    
                                            <p style="clear: both;height:5px;"></p>                                                                        
											<p class="errorMessage" id="errorMessage"></p>  
                                        </form>
                                    </div>

