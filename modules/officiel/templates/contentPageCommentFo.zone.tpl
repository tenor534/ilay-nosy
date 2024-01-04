                                   	<h3>Vos commentaires</h3>
                                    <form id='newsForm' name='newsForm' action="#" method="POST" tmt:validate="true" tmt:callback="displayError">                                    
                                    <table class="commTopic">
                                        <tbody id="tbodyComment">
                                        <tr>
                                            <td class="threadHead1"><h4 class="mast">Auteur</h4></td>
                                            <td class="threadHead2"><h4 class="mast">Message</h4></td>
                                        </tr>
                                        <input type="hidden" id="acid" name="acid" value="{$acid}" />
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
                                            <a name="{$oCommentaires->commentOff_id}"></a>
                                                <table>
                                                    <tbody><tr>
                                                        <td class="threadAvatar">
                                                        
                                                        <a href="#">
                                                        <img width="80" height="60" border="0" alt="{$oCommentaires->commentOff_userLogin}" src="{$j_basepath}resize/utilisateur/images/abrege/{$oCommentaires->commentOff_userPhoto}" name="{$oCommentaires->commentOff_id}">
                                                        </a>
                                                        
                                                        </td>
                                                        <td class="avatarRightWrap">
                                                            <p class="avatarRightFirst"><a href="#" class="crumbsBlue avatarRight">{$oCommentaires->commentOff_userLogin}</a></p>
                                                            {if $oCommentaires->commentOff_userNbPost > 0}
	                                                            <p class="regTextPale avatarRight">{$oCommentaires->commentOff_userNbPost} message{if $oCommentaires->commentOff_userNbPost > 1}s{/if}</p>
                                                            {/if}
                                                            <p class="commMember avatarRight">Membre depuis  {$oCommentaires->commentOff_userDateCreation|date_format:"%d/%m/%Y"}</p>
                                                            <p class="regTextPale avatarRight"></p>
                                                            <p class="regTextPale avatarRight">                                                            
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                            <td class="threadBody2">
                                            
                                                <p>{$oCommentaires->commentOff_texte}</p>
                                                
                                                <ul>
                                                    <p class="regTextPaleNormal borderNoneInline">Publié le: {$oCommentaires->commentOff_dateCreation|date_format:"%d/%m/%Y (%H:%M:%S)"}</p>
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
