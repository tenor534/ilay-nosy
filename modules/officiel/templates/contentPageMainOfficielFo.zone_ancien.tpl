									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">D&eacute;tail de l' actualit&eacute;</span> 
                                      	</p>                                                  
   										<p style="clear: both;">
	                                        {*}<img width="468" height="60" border="0" src="/design/front/images/banner/banniere2.jpg">{*}
                                        </p>
   										<p style="clear: both;"></p>
									</div>
                                    
									<p style="clear: both;height:5px;"></p>
                                    {*}
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
                                    {*}                                  

                                    <div class="ajaxZone">
                                        <form enctype="multipart/form-data" id='officielForm' name='officielForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                        
                                         	<input type="hidden" id="officiel_id" name="officiel_id" value="{$officiel->officiel_id}">

                                            <div id="middleCol">
                                                <div class="box" id="box_annonce">
                                                    <div class="box_inner box_end box_annonce_top">

                                                        <div id="cat_breadcrumbs">
                                                            <ul class="cat_breadcrumbs">
                                                                <li><a href="{jurl 'officiel~officielFo_officielResultList', array('cid'=>$categorieOff->categorieOff_id)}">{$categorieOff->categorieOff_libelle}</a></li>
                                                            </ul>
                                                        </div>                                                    
                                                        <div id="view_titre">
	                                                        <h1 class="txt_arrows">{$officiel->officiel_titre}</h1>
                                                        </div>
														<ul class="split">
                                                            {if $officiel->officiel_id != 0}
                                                                {if $iFirst}                                                
                                                                
                                                                    <li class="inline"><a class="link_d" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iFirst, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">D&eacute;but</a></li>                                                            
                                                                {/if}   
                                                                {if $iBack}                                                
                                                                    <li class="inline"><a class="link_p" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iBack, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Actualit&eacute; pr&eacute;c&eacute;dente</a></li>                                                            
                                                                {/if}   
                                                                {if $iNext}                                                
                                                                    <li class="inline"><a class="link_s" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iNext, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Actualit&eacute; suivante</a></li>                                                            
                                                                {/if}   
                                                                {if $iLast}                                                
                                                                    <li class="inline"><a class="link_f" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iLast, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Fin</a></li>                                                            
                                                                {/if}   
                                                            {/if}			
                                                            <li class="last inline"><a href="{jurl 'officiel~officielFo_officielResultList', array('affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        <div class="clearer"></div>
                                                    </div><!-- box_annonce_top end -->                                        
                                                    
                                                    <div class="box_inner box_end box_annonce_main_info">                                                    
                                                    
                                                        <div id="view_price" class="float">
                                                            <div class="info_list">                                                
                                                                <dl class="lieu">
                                                                    <dt>Parue le&nbsp;:</dt>
                                                                    <dd><div id="view_lieu"><span class="date">{$officiel->officiel_datePublication}</span></div></dd>
                                                                </dl>
                                                                <dl>
                                                                    <dt>Source&nbsp;:</dt>
                                                                    <dd><div id="view_annee">{$officiel->officiel_source}</div></dd>
                                                                </dl>                                                
                                                            </div>
                                                        </div>
                                                                                                        
                                                        <div id="view_offre" class="float_r">
                                                            <ul>
                                                                <li class="ref">Officiel r&eacute;f. {$officiel->officiel_reference}</li>
                                                                <li class="date">Vue : <strong>{$officiel->officiel_visite}</strong> fois</li>
                                                                <li class="date">Commentaire : <strong>{$officiel->officiel_nbComment}</strong></li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- box_officiel_main_info end -->

                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <!--h4>R&eacute;sum&eacute;</h4-->
														<div id="appercuPhoto" style=" text-align:center; margin:5px 0; background-color:#FDFCFB;overflow:auto; width:100%;">
                                                        	<img width="469" height="313" align="absmiddle" src="{$j_basepath}resize/officiel/photos/{$officiel->officiel_photo}">
                                                        </div>                                    
                                                    </div>                                        

                                                    <div class="clearer"></div>
                                                	
                                                    {if $officiel->officiel_id}
                                                    {if sizeof($toPhotos)}
                                                    <div class="box_inner box_end">
                                                        <h4>Autres photos</h4>
                                                        <table width="610" height="300" class="tableLP">
                                                            <tbody><tr class="trLPLeft">
                                                                <td class="tdLPLeft">
                                                                    <table class="tableLP">
                                                                        <tbody><tr class="trLP">
                                                                            <td width="360" height="290" class="tdLPBlackBorder">
                                                                            	<div id="profileimage" class="profileimage can_edit">
                                                                                    <img width="360" height="270" id="profile_pic" name="profile_pic" src="{$j_basepath}resize/officiel/images/popup/{$toPhotos[0]->photo_photo}">
																					<input type="hidden" id="picture_id" name="picture_id" value="{$toPhotos[0]->photo_id}">                                                                                
																					<input type="hidden" id="picture_photo" name="picture_photo" value="{$toPhotos[0]->photo_photo}">                                                                                
                                                                                    <a title="Changer de photo" id="edit_profilepicture" class="hidden_elem">
                                                                                        Changer de photo
                                                                                        <span id="edit_profilepicture_icon"></span>
                                                                                    </a>
                                                                                    <div id="profile_picture_flyout" class="flyout_menu hidden_elem flyout_menu_18 link_menu">
                                                                                        <div class="flyout_menu_header_shadow">
                                                                                            <div class="flyout_menu_header clearfix">
                                                                                                <div class="flyout_menu_mask"></div>
                                                                                                <div class="flyout_menu_title">Modifier</div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="flyout_menu_content_shadow">
                                                                                            <div class="menu_content">
                                                                                                <div class="wrapper">
                                                                                                    <a title="Charger une nouvelle photo" class="icon_link" id="profile_picture_upload" rel="dialog">Charger une photo</a>
                                                                                                    <a title="Si vous le souhaitez, supprimez cette photo" class="icon_link" id="profile_picture_remove" rel="dialog">Supprimer la photo</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>          
                                                                                </div>                                                                      
                                                                          	</td>
                                                                        </tr>
                                                                        <!--
                                                                        <tr class="trLP">
                                                                            <td class="tdLPCenter"><a href="javascript:afficheImage();" class="cmtt">Voir toutes les photos</a></td>
                                                                        </tr>
                                                                        -->
                                                                    </tbody></table>
                                                                </td>                                   
                                    					
                                                                <td class="tdLPRight">
                                                                
                                    
                                                                    <div class="divright">
                                                                        <table class="tableLP">
                                                                            <tbody>
                                                                            {assign $i=0}
                                                                            {foreach $toPhotos as $oPhotos}
                                                                            	{if $i == 0}
                                                                                <tr class="trLP">
                                                                                    <td class="tdLP">
                                                                                        <p class="img_thumb">
                                                                                 {/if}      {if $oPhotos->photo_photo != "noPhoto.jpg"} 
	                                                                                            <a id="linkthumb{$oPhotos->photo_id}" href="javascript:voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});"><img width="90" height="68" onMouseOver="voirImg('{$oPhotos->photo_photo}', {$oPhotos->photo_id});" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/officiel/images/abrege/{$oPhotos->photo_photo}"></a>
                                                                                            {else}
	                                                                                            <a id="linkthumb{$oPhotos->photo_id}"><img width="90" height="68" border="0" id="imgthumb{$oPhotos->photo_id}" name="imgthumb{$oPhotos->photo_id}" alt="{$oPhotos->photo_photo}" src="{$j_basepath}resize/officiel/images/abrege/{$oPhotos->photo_photo}"></a>
                                                                                            {/if}

                                                                            	{if $i == 1}
                                                                                        </p>
                                                                                    </td>
                                                                                </tr>
                                                                                {/if}
                                                                                {assign $i++}
                                                                                {if $i > 1 }
	                                                                                {assign $i=0}
                                                                                {/if}
                                                                            {/foreach}

                                                                        </tbody></table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>                                    
                                                        <div class="clearer"></div>
                                                    </div>
                                                    {/if}
                                                    {/if}
                                            
                                    				<!-- Caractéristique Debut-->                                                    	
                                    				<!-- Caractéristique Fin-->                                                    
                                    
                                                    <div id="view_resume" class="box_inner intro box_end">
                                                        <h4>R&eacute;sum&eacute;</h4>
                                                        {$officiel->officiel_resume}
                                                        <br><br>
                                    
                                                    </div>                                        
                                                    <div id="view_description" class="box_inner intro box_end">
                                                        <h4>Description g&eacute;n&eacute;rale</h4>
                                                        {$officiel->officiel_texte}
                                                        <br><br>
                                    
                                                    </div>                                        
                                                
                                                    <div id="pub-14"></div>
                                                    <div class="box_inner box_annonce_foot">
                                                        
														<ul class="split">
                                                            {if $officiel->officiel_id != 0}                                                        
                                                                {if $iFirst}                                                
                                                                    <li class="inline"><a class="link_d" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iFirst, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">D&eacute;but</a></li>                                                            
                                                                {/if}   
                                                                {if $iBack}                                                
                                                                    <li class="inline"><a class="link_p" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iBack, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Actualit&eacute; pr&eacute;c&eacute;dente</a></li>                                                            
                                                                {/if}   
                                                                {if $iNext}                                                
                                                                    <li class="inline"><a class="link_s" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iNext, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Actualit&eacute; suivante</a></li>                                                            
                                                                {/if}   
                                                                {if $iLast}                                                
                                                                    <li class="inline"><a class="link_f" href="{jurl 'officiel~officielFo_officielDetail', array('acid'=>$iLast, 'affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Fin</a></li>                                                            
                                                                {/if}   
                                                            {/if}
                                                            <li class="last inline"><a href="{jurl 'officiel~officielFo_officielResultList', array('affichage'=> $affichage, 'cid'=> $cid, 'mot'=> $mot, 'parution'=> $parution, 'page'=>$page, 'sortField'=> $sortField, 'sortDirection'=> $sortDirection)}">Retour &agrave; la liste</a></li>                                                            
                                                        </ul>
                                                        
                                                        <div class="clearer"></div>
                                                    </div><!-- box_officiel_top end -->
                                                
                                                    <div class="box_foot"></div>
                                                </div>
                                            </div>                                          
                                        </form>
                                    </div>
