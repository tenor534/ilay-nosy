									<div class="viewResult">
                                    	<p>
	                                        <span class="viewTitre">Nous contacter</span> 
                                      	</p>          

   										<p style="clear:both">
                                            <span class="viewTexte">Contactez-nous d&egrave;s aujourd'hui en remplissant le formulaire ci-dessous, ou directement par email &agrave; l'adresse : <a href="mailto:contact@ilay-nosy.com>">contact@ilay-nosy.com</a>.</span> 
                                         </p>
									</div>
									<p style="clear: both;height:5px;"></p>
                                    <div class="singleColumnBig">
                                    <div class="ajaxZone">   
                                        <form id="registerForm" name="registerForm" method="POST" tmt:validate="true" tmt:callback="displayError">
                                            <div class="registerContent">                                       
                                                <label for="user_civilite">Civilit&eacute;: *</label>
                                                <select class="user_input3 user_input_select input_middle" id="user_civilite" name="user_civilite">
                                                    <option value="0">Monsieur</option>
                                                    <option value="1">Madame</option>
                                                    <option value="1">Mademoiselle</option>
                                                </select><br>
                                                <label for="user_nom">Nom: *</label>
                                                <input class="user_input1" type="text" id="user_nom" name="user_nom" value="" tmt:required="true" tmt:filters="" maxlength="50"><br>
                                                <label for="user_prenom">Pr&eacute;nom: *</label>
                                                <input class="user_input1" type="text" id="user_prenom" name="user_prenom" value="" tmt:required="true" tmt:filters="" maxlength="50" ><br>
    
                                                <label for="user_societe">Soci&eacute;t&eacute;: *</label>
                                                <input class="user_input1" type="text" id="user_societe" name="user_societe" value="" tmt:required="true" tmt:filters="" maxlength="50" ><br>
    
                                                <label for="user_pays">Pays de r&eacute;sidence: *</label>
                                                <select class="user_input4 user_input_select input_middle" id="user_pays" name="user_pays">
                                                    {for $i=0; $i<sizeof($toPays);$i++}                                                      
                                                        <option value="{$toPays[$i]->pays_id}" {if $toPays[$i]->pays_id == '128'}selected{/if}>{$toPays[$i]->pays_libelle}</option>
                                                    {/for}
                                                </select><br>                                            
                                                
                                                <label for="user_cp">Code postal: *</label>
                                                <input class="user_input5" type="text" id="user_cp" name="user_cp" value="" tmt:required="true"  tmt:pattern="number" tmt:filters="" maxlength="8" ><br>
                                                
                                                <label for="user_email">Email: *</label>
                                                <input class="user_input2" type="text" id="user_email" value="" name="user_email" tmt:required="true" tmt:pattern="email" tmt:filters="" maxlength="50" ><br>
    
                                                <label for="user_message">Message: *</label>
                                                <textarea class="user_input_select1" id="user_message" name="user_message" rows="10" tmt:required="true" tmt:filters="" ></textarea>				
                                                <br>
                                                <a class="formButton_valid">valid</a>
                                                <br><br>                                            
                                            </div>
                                            <p class="errorMessage" id="errorMessage"></p>                                          
                                        </form>          
                                        </div>
                                        </div>                       
										<table class="commAnnonce expanded" cellspacing="0"  id="tableListeAnnonce">
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="commFoot">
                                                            <div class="static">
                                                                <p class="regTextPale cultureFoot">&nbsp;</p>
                                                            </div>
                                                            <div class="commFoot3">
                                                            </div>
                                                        </div>                                                                                                                                              
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
								