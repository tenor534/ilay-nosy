<input type="hidden" id="vehicule_id" name="vehicule_id" value="{$vehicule->vehicule_id}">
<input type="hidden" id="vehicule_annonceId" name="vehicule_annonceId" value="{$vehicule->vehicule_annonceId}">

<div class="box_inner box_end box_annonce_carac">
    <h4>Caract&eacute;ristiques</h4>
    <div class="info_list box_end">
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Marque&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_marqueId" id="vehicule_marqueId"  tmt:invalidvalue="-1">			
                            <option value="0">Marque:</option>    
                            {foreach $toMarques as $oMarques}
                                {if $oMarques->marque_id==$vehicule->vehicule_marqueId}
                                    {assign $selected="selected"}
                                {else}
                                    {assign $selected=""}
                                {/if}
                                <option value="{$oMarques->marque_id}" {$selected}>{$oMarques->marque_libelle|upper}</option>
                            {/foreach}
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Mod&egrave;le&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_modeleId" id="vehicule_modeleId"  tmt:invalidvalue="-1">			
                            <option value="0">Mod&egrave;le:</option>    
                            {foreach $toModeles as $oModeles}
                                {if $oModeles->modele_id==$vehicule->vehicule_modeleId}
                                    {assign $selected="selected"}
                                {else}
                                    {assign $selected=""}
                                {/if}
                                <option value="{$oModeles->modele_id}" {$selected}>{$oModeles->modele_libelle}</option>
                            {/foreach}
                        </select>
                    </dd>
                </dl>
            </div>
            <div class="float">
                <dl>
                    <dt>Origine&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_origine" name="vehicule_origine" value="{$vehicule->vehicule_origine}" tmt:filters="" maxlength="50">                                                                        
                    </dd>
                </dl>
                <dl>
                    <dt>Version&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_version" name="vehicule_version" value="{$vehicule->vehicule_version}" tmt:filters="" maxlength="50">                                                                        
                    </dd>
                </dl>
            </div>
        </div>
        <div class="clearer"></div>
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Type&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_type" id="vehicule_type"  tmt:invalidvalue="-1">			
                            <option value="0">Type:</option>
                            <option value="1" {if $vehicule->vehicule_type == 1}selected{/if}>Berline : citadine</option>
                            <option value="2" {if $vehicule->vehicule_type == 2}selected{/if}>Berline : moyenne</option>
                            <option value="3" {if $vehicule->vehicule_type == 3}selected{/if}>Berline : grande</option>
                            <option value="4" {if $vehicule->vehicule_type == 4}selected{/if}>Break</option>
                            <option value="5" {if $vehicule->vehicule_type == 5}selected{/if}>Monospace</option>
                            <option value="6" {if $vehicule->vehicule_type == 6}selected{/if}>Coup&eacute; &amp; Cabriolet</option>
                            <option value="7" {if $vehicule->vehicule_type == 7}selected{/if}>SUV, 4x4 &amp; Crossovers</option>
                            <option value="8" {if $vehicule->vehicule_type == 8}selected{/if}>Voiture sans permis</option>
                            <option value="9" {if $vehicule->vehicule_type == 9}selected{/if}>V&eacute;hicule ancien</option>
                            <option value="10" {if $vehicule->vehicule_type == 10}selected{/if}>V&eacute;hicule utilitaire</option>
                            <option value="11" {if $vehicule->vehicule_type == 11}selected{/if}>V&eacute;hicule poid lourd</option>
                            <option value="12" {if $vehicule->vehicule_type == 12}selected{/if}>BUS/MINI BUS</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Transmission&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_transmission" id="vehicule_transmission"  tmt:invalidvalue="-1">			
                            <option value="0">Bo&icirc;te de vitesses:</option>
                            <option value="1" {if $vehicule->vehicule_transmission == 1}selected{/if}>Automatique</option>
                            <option value="2" {if $vehicule->vehicule_transmission == 2}selected{/if}>M&eacute;canique</option>
                            <option value="3" {if $vehicule->vehicule_transmission == 3}selected{/if}>Semi-automatique</option>
                        </select>
                    </dd>
                </dl>
            </div>
            <div class="float">
                <dl>
                    <dt>Nb. cylindres&nbsp;:</dt>
                    <dd>
                        <input style="width:20px;" class="user_input1" type="text" id="vehicule_nbCylindre" name="vehicule_nbCylindre" value="{$vehicule->vehicule_nbCylindre}" tmt:pattern="number" tmt:filters="" maxlength="2">
                    </dd>
                </dl>
                
                <dl>
                    <dt>Taille du moteur&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_tailleMoteur" name="vehicule_tailleMoteur" value="{$vehicule->vehicule_tailleMoteur}" tmt:filters="" maxlength="20">
                    </dd>
                </dl>
            </div>
        </div>
        <div class="clearer"></div>                                                            
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Motricit&eacute;&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_motricite" id="vehicule_motricite"  tmt:invalidvalue="-1">			
                            <option value="0">Motricit&eacute;:</option>    
                            <option value="1" {if $vehicule->vehicule_motricite == 1}selected{/if}>Roues motrices avant</option>
                            <option value="2" {if $vehicule->vehicule_motricite == 2}selected{/if}>Roues motrices arri&egrave;re</option>
                            <option value="3" {if $vehicule->vehicule_motricite == 3}selected{/if}>4 roues motrices</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Carburant&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_carburant" id="vehicule_carburant"  tmt:invalidvalue="-1">			
                            <option value="0">Carburant:</option>    
                            <option value="1" {if $vehicule->vehicule_carburant == 1}selected{/if}>Essence</option>
                            <option value="2" {if $vehicule->vehicule_carburant == 2}selected{/if}>Diesel</option>
                            <option value="3" {if $vehicule->vehicule_carburant == 3}selected{/if}>Bicarburation essence / gpl</option>
                            <option value="4" {if $vehicule->vehicule_carburant == 4}selected{/if}>Hybrides / Electrique</option>
                            <option value="5" {if $vehicule->vehicule_carburant == 5}selected{/if}>Autres énergies alternatives</option>
                        </select>
                    </dd>
                </dl>
            </div>
            <div class="float">
                <dl>
                    <dt>Kilom&eacute;trage&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_kilometrage" name="vehicule_kilometrage" value="{$vehicule->vehicule_kilometrage}" tmt:pattern="number" tmt:filters="" maxlength="20">
                    </dd>
                </dl>
                <dl>
                    <dt>Nb. portes&nbsp;:</dt>
                    <dd>
                        <input style="width:20px;" class="user_input1" type="text" id="vehicule_nbPorte" name="vehicule_nbPorte" value="{$vehicule->vehicule_nbPorte}" tmt:pattern="number" tmt:filters="" maxlength="2">
                    </dd>
                </dl>
            </div>
        </div>
        <div class="clearer"></div>
        <div class="info_list">
            <div class="float">
                <dl>
                    <dt>Air climatis&eacute;&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="vehicule_airClimatise" id="vehicule_airClimatise"  tmt:invalidvalue="-1">			
                            <option value="0">Climatisation:</option>    
                            <option value="1" {if $vehicule->vehicule_airClimatise == 1}selected{/if}>OUI</option>
                            <option value="2" {if $vehicule->vehicule_airClimatise == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Premi&egrave;re main&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="vehicule_premiereMain" id="vehicule_premiereMain"  tmt:invalidvalue="-1">			
                            <option value="0">Premi&egrave;re main:</option>    
                            <option value="1" {if $vehicule->vehicule_premiereMain == 1}selected{/if}>OUI</option>
                            <option value="2" {if $vehicule->vehicule_premiereMain == 2}selected{/if}>NON</option>
                        </select>
                    </dd>
                </dl>
                
            </div>
            <div class="float">
                <dl>
                    <dt>Nb. passager&nbsp;:</dt>
                    <dd>
                        <input style="width:20px;" class="user_input1" type="text" id="vehicule_nbPassager" name="vehicule_nbPassager" value="{$vehicule->vehicule_nbPorte}" tmt:pattern="number" tmt:filters="" maxlength="2">
                    </dd>
                </dl>
            </div>
        </div>
        <div class="clearer" style="height:10px;"></div>
    </div>

    <div class="info_list more_info">
        <dl>
            <dt>Couleur Ext&eacute;rieure&nbsp;:</dt>
            <dd>
                <input style="width:188px;" class="user_input1" type="text" id="vehicule_couleurExterne" name="vehicule_couleurExterne" value="{$vehicule->vehicule_couleurExterne}" tmt:filters="" maxlength="50">                                                                                                                                        
            </dd>
        </dl>
        <dl>
            <dt>Couleur Int&eacute;rieure&nbsp;:</dt>
            <dd>
                <input style="width:188px;" class="user_input1" type="text" id="vehicule_couleurInterne" name="vehicule_couleurInterne" value="{$vehicule->vehicule_couleurInterne}" tmt:filters="" maxlength="50">                                                                                                                                        
            </dd>
        </dl>
        <dl>
            <dt>Options&nbsp;:</dt>
            <dd>
                <textarea style="width:448px;height:60px;" class="user_input_select1" id="vehicule_option" name="vehicule_option" rows="5" tmt:filters="" >{$vehicule->vehicule_option}</textarea>				
            </dd>
        </dl>
        <dl>
            <dt>Garantie du manufacturier&nbsp;:</dt>
            <dd>
                <input style="width:448px;" class="user_input1" type="text" id="vehicule_garantie" name="vehicule_garantie" value="{$vehicule->vehicule_garantie}" tmt:filters="" maxlength="250">                                                                                                                                        
            </dd>
        </dl>
        <dl>
            <dt>Financement&nbsp;:</dt>
            <dd>
                <input style="width:448px;" class="user_input1" type="text" id="vehicule_financement" name="vehicule_financement" value="{$vehicule->vehicule_financement}" tmt:filters="" maxlength="250">
            </dd>
      </dl>
    </div>

</div>