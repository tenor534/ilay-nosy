									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Liste des messages</span> 
                                      	</p>          
   										<p style="clear:both">
                                        	<span class="viewTexte">Liste des r&eacute;ponses du sujet : {$zCid} &raquo; {$zFid} &raquo; {$zSid}</span>
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
                                        <span style="border-right:1px solid #3366FF;margin-right:4px;"></span>
                                   		<a href="{jurl 'forum~forumFo_forumSujetList', array('fid'=>$fid)}">Retour &agrave; la liste des sujets</a>                                    
                                    </p>                                    
                                    
									<p style="clear: both;height:10px;"></p>
                                    <h3>Sujet : <span>{$zCid} &raquo; </span> <i>{$zFid}</i> &raquo; <i><u>{$zSid}</u></i></h3>

                                    <form id='forumForm' name='forumForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                    
                                    <table class="commTopic">
                                        <tbody id="tbodyComment">
                                        <tr>
                                            <td class="threadHead1"><h4 class="mast">Auteur</h4></td>
                                            <td class="threadHead2"><h4 class="mast">Message</h4></td>
                                        </tr>
                                        <input type="hidden" id="sid" name="sid" value="{$sid}" />
                                        {if sizeof($toUtilisateur)}
                                        <input type="hidden" id="userId" name="userId" value="{$toUtilisateur->utilisateur_id}" />
                                        <input type="hidden" id="userLogin" name="userLogin" value="{$toUtilisateur->utilisateur_login}" />
                                        <input type="hidden" id="userPhoto" name="userPhoto" value="{$toUtilisateur->utilisateur_photo}" />
                                        <input type="hidden" id="userDateCreation" name="userDateCreation" value='{$toUtilisateur->utilisateur_dateCreation|date_format:"%d/%m/%Y"}' />
                                        <input type="hidden" id="userNbComment" name="userNbComment" value="{$toUtilisateur->utilisateur_nbComment}" />
                                        {/if}
                                        
                                        {foreach $toCommentaires as $oCommentaires}
                                        <tr>
                                            <td class="threadBody1">
                                            <a name="{$oCommentaires->commentFor_id}"></a>
                                                <table>
                                                    <tbody><tr>
                                                        <td class="threadAvatar">
                                                        
                                                        <a href="#">
                                                        <img width="80" height="60" border="0" alt="{$oCommentaires->commentFor_userLogin}" src="{$j_basepath}resize/utilisateur/images/abrege/{$oCommentaires->commentFor_userPhoto}" name="{$oCommentaires->commentFor_id}">
                                                        </a>
                                                        
                                                        </td>
                                                        <td class="avatarRightWrap">
                                                            <p class="avatarRightFirst"><a href="#" class="crumbsBlue avatarRight">{$oCommentaires->commentFor_userLogin}</a></p>
                                                            {if $oCommentaires->commentFor_userNbPost > 0}
	                                                            <p class="regTextPale avatarRight">{$oCommentaires->commentFor_userNbPost} message{if $oCommentaires->commentFor_userNbPost > 1}s{/if}</p>
                                                            {/if}
                                                            <p class="commMember avatarRight">Membre depuis  {$oCommentaires->commentFor_userDateCreation|date_format:"%d/%m/%Y"}</p>
                                                            <p class="regTextPale avatarRight"></p>
                                                            <p class="regTextPale avatarRight">                                                            
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                            <td class="threadBody2">
                                            
                                                <p>{$oCommentaires->commentFor_texte}</p>
                                                
                                                <ul>
                                                    <p class="regTextPaleNormal borderNoneInline">Publi&eacute; le: {$oCommentaires->commentFor_dateCreation|date_format:"%d/%m/%Y (%H:%M:%S)"}</p>
                                                    <li class="borderLeftInline">
                                                        <a href="#" class="hotTopics">Signaler un abus</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        {/foreach}
                                    </tbody>
                                    </table>
                                    </form>

                                    <table class="lipLinerFoot">
                                        <tbody><tr class="threadFoot">
                                            <td class="footShowingWrap" colspan="1">
                                                <table>
                                                    <tbody><tr>
                                                        <td>
                                                        	<p class="regTextPale forumFoot">
															<p class="errorMessage" id="errorMessage"></p>  
                                                        	</p>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                            <td colspan="1" class="commFoot5">&nbsp;
	                                            {if sizeof($toUtilisateur)}
                                                <a id="formButton_add" class="formButton_add"></a>
                                                <a id="formButton_ok" class="formButton_ok" style="float:right;"></a>
                                                {/if}
                                            </td>
                                        </tr>
                                    </tbody></table>
