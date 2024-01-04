<?php 
function template_meta_742ea0bf76ac91baa0716e3c0f28c7e2($t){

return $t->_meta;
}
function template_742ea0bf76ac91baa0716e3c0f28c7e2($t){
?><input type="hidden" id="vehicule_id" name="vehicule_id" value="<?php echo $t->_vars['vehicule']->vehicule_id; ?>">
<input type="hidden" id="vehicule_annonceId" name="vehicule_annonceId" value="<?php echo $t->_vars['vehicule']->vehicule_annonceId; ?>">

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
                            <?php foreach($t->_vars['toMarques'] as $t->_vars['oMarques']):?>
                                <?php if($t->_vars['oMarques']->marque_id==$t->_vars['vehicule']->vehicule_marqueId):?>
                                    <?php $t->_vars['selected']="selected";?>
                                <?php else:?>
                                    <?php $t->_vars['selected']="";?>
                                <?php endif;?>
                                <option value="<?php echo $t->_vars['oMarques']->marque_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo strtoupper($t->_vars['oMarques']->marque_libelle); ?></option>
                            <?php endforeach;?>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Mod&egrave;le&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_modeleId" id="vehicule_modeleId"  tmt:invalidvalue="-1">			
                            <option value="0">Mod&egrave;le:</option>    
                            <?php foreach($t->_vars['toModeles'] as $t->_vars['oModeles']):?>
                                <?php if($t->_vars['oModeles']->modele_id==$t->_vars['vehicule']->vehicule_modeleId):?>
                                    <?php $t->_vars['selected']="selected";?>
                                <?php else:?>
                                    <?php $t->_vars['selected']="";?>
                                <?php endif;?>
                                <option value="<?php echo $t->_vars['oModeles']->modele_id; ?>" <?php echo $t->_vars['selected']; ?>><?php echo $t->_vars['oModeles']->modele_libelle; ?></option>
                            <?php endforeach;?>
                        </select>
                    </dd>
                </dl>
            </div>
            <div class="float">
                <dl>
                    <dt>Origine&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_origine" name="vehicule_origine" value="<?php echo $t->_vars['vehicule']->vehicule_origine; ?>" tmt:filters="" maxlength="50">                                                                        
                    </dd>
                </dl>
                <dl>
                    <dt>Version&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_version" name="vehicule_version" value="<?php echo $t->_vars['vehicule']->vehicule_version; ?>" tmt:filters="" maxlength="50">                                                                        
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
                            <option value="1" <?php if($t->_vars['vehicule']->vehicule_type == 1):?>selected<?php endif;?>>Berline : citadine</option>
                            <option value="2" <?php if($t->_vars['vehicule']->vehicule_type == 2):?>selected<?php endif;?>>Berline : moyenne</option>
                            <option value="3" <?php if($t->_vars['vehicule']->vehicule_type == 3):?>selected<?php endif;?>>Berline : grande</option>
                            <option value="4" <?php if($t->_vars['vehicule']->vehicule_type == 4):?>selected<?php endif;?>>Break</option>
                            <option value="5" <?php if($t->_vars['vehicule']->vehicule_type == 5):?>selected<?php endif;?>>Monospace</option>
                            <option value="6" <?php if($t->_vars['vehicule']->vehicule_type == 6):?>selected<?php endif;?>>Coup&eacute; &amp; Cabriolet</option>
                            <option value="7" <?php if($t->_vars['vehicule']->vehicule_type == 7):?>selected<?php endif;?>>SUV, 4x4 &amp; Crossovers</option>
                            <option value="8" <?php if($t->_vars['vehicule']->vehicule_type == 8):?>selected<?php endif;?>>Voiture sans permis</option>
                            <option value="9" <?php if($t->_vars['vehicule']->vehicule_type == 9):?>selected<?php endif;?>>V&eacute;hicule ancien</option>
                            <option value="10" <?php if($t->_vars['vehicule']->vehicule_type == 10):?>selected<?php endif;?>>V&eacute;hicule utilitaire</option>
                            <option value="11" <?php if($t->_vars['vehicule']->vehicule_type == 11):?>selected<?php endif;?>>V&eacute;hicule poid lourd</option>
                            <option value="12" <?php if($t->_vars['vehicule']->vehicule_type == 12):?>selected<?php endif;?>>BUS/MINI BUS</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Transmission&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_transmission" id="vehicule_transmission"  tmt:invalidvalue="-1">			
                            <option value="0">Bo&icirc;te de vitesses:</option>
                            <option value="1" <?php if($t->_vars['vehicule']->vehicule_transmission == 1):?>selected<?php endif;?>>Automatique</option>
                            <option value="2" <?php if($t->_vars['vehicule']->vehicule_transmission == 2):?>selected<?php endif;?>>M&eacute;canique</option>
                            <option value="3" <?php if($t->_vars['vehicule']->vehicule_transmission == 3):?>selected<?php endif;?>>Semi-automatique</option>
                        </select>
                    </dd>
                </dl>
            </div>
            <div class="float">
                <dl>
                    <dt>Nb. cylindres&nbsp;:</dt>
                    <dd>
                        <input style="width:20px;" class="user_input1" type="text" id="vehicule_nbCylindre" name="vehicule_nbCylindre" value="<?php echo $t->_vars['vehicule']->vehicule_nbCylindre; ?>" tmt:pattern="number" tmt:filters="" maxlength="2">
                    </dd>
                </dl>
                
                <dl>
                    <dt>Taille du moteur&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_tailleMoteur" name="vehicule_tailleMoteur" value="<?php echo $t->_vars['vehicule']->vehicule_tailleMoteur; ?>" tmt:filters="" maxlength="20">
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
                            <option value="1" <?php if($t->_vars['vehicule']->vehicule_motricite == 1):?>selected<?php endif;?>>Roues motrices avant</option>
                            <option value="2" <?php if($t->_vars['vehicule']->vehicule_motricite == 2):?>selected<?php endif;?>>Roues motrices arri&egrave;re</option>
                            <option value="3" <?php if($t->_vars['vehicule']->vehicule_motricite == 3):?>selected<?php endif;?>>4 roues motrices</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Carburant&nbsp;:</dt>
                    <dd>
                        <select style="width:191px;" class="user_input1 user_input_select input_middle" name="vehicule_carburant" id="vehicule_carburant"  tmt:invalidvalue="-1">			
                            <option value="0">Carburant:</option>    
                            <option value="1" <?php if($t->_vars['vehicule']->vehicule_carburant == 1):?>selected<?php endif;?>>Essence</option>
                            <option value="2" <?php if($t->_vars['vehicule']->vehicule_carburant == 2):?>selected<?php endif;?>>Diesel</option>
                            <option value="3" <?php if($t->_vars['vehicule']->vehicule_carburant == 3):?>selected<?php endif;?>>Bicarburation essence / gpl</option>
                            <option value="4" <?php if($t->_vars['vehicule']->vehicule_carburant == 4):?>selected<?php endif;?>>Hybrides / Electrique</option>
                            <option value="5" <?php if($t->_vars['vehicule']->vehicule_carburant == 5):?>selected<?php endif;?>>Autres énergies alternatives</option>
                        </select>
                    </dd>
                </dl>
            </div>
            <div class="float">
                <dl>
                    <dt>Kilom&eacute;trage&nbsp;:</dt>
                    <dd>
                        <input style="width:188px;" class="user_input1" type="text" id="vehicule_kilometrage" name="vehicule_kilometrage" value="<?php echo $t->_vars['vehicule']->vehicule_kilometrage; ?>" tmt:pattern="number" tmt:filters="" maxlength="20">
                    </dd>
                </dl>
                <dl>
                    <dt>Nb. portes&nbsp;:</dt>
                    <dd>
                        <input style="width:20px;" class="user_input1" type="text" id="vehicule_nbPorte" name="vehicule_nbPorte" value="<?php echo $t->_vars['vehicule']->vehicule_nbPorte; ?>" tmt:pattern="number" tmt:filters="" maxlength="2">
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
                            <option value="1" <?php if($t->_vars['vehicule']->vehicule_airClimatise == 1):?>selected<?php endif;?>>OUI</option>
                            <option value="2" <?php if($t->_vars['vehicule']->vehicule_airClimatise == 2):?>selected<?php endif;?>>NON</option>
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt>Premi&egrave;re main&nbsp;:</dt>
                    <dd>
                        <select style="width:100px;" class="user_input1 user_input_select input_middle" name="vehicule_premiereMain" id="vehicule_premiereMain"  tmt:invalidvalue="-1">			
                            <option value="0">Premi&egrave;re main:</option>    
                            <option value="1" <?php if($t->_vars['vehicule']->vehicule_premiereMain == 1):?>selected<?php endif;?>>OUI</option>
                            <option value="2" <?php if($t->_vars['vehicule']->vehicule_premiereMain == 2):?>selected<?php endif;?>>NON</option>
                        </select>
                    </dd>
                </dl>
                
            </div>
            <div class="float">
                <dl>
                    <dt>Nb. passager&nbsp;:</dt>
                    <dd>
                        <input style="width:20px;" class="user_input1" type="text" id="vehicule_nbPassager" name="vehicule_nbPassager" value="<?php echo $t->_vars['vehicule']->vehicule_nbPorte; ?>" tmt:pattern="number" tmt:filters="" maxlength="2">
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
                <input style="width:188px;" class="user_input1" type="text" id="vehicule_couleurExterne" name="vehicule_couleurExterne" value="<?php echo $t->_vars['vehicule']->vehicule_couleurExterne; ?>" tmt:filters="" maxlength="50">                                                                                                                                        
            </dd>
        </dl>
        <dl>
            <dt>Couleur Int&eacute;rieure&nbsp;:</dt>
            <dd>
                <input style="width:188px;" class="user_input1" type="text" id="vehicule_couleurInterne" name="vehicule_couleurInterne" value="<?php echo $t->_vars['vehicule']->vehicule_couleurInterne; ?>" tmt:filters="" maxlength="50">                                                                                                                                        
            </dd>
        </dl>
        <dl>
            <dt>Options&nbsp;:</dt>
            <dd>
                <textarea style="width:448px;height:60px;" class="user_input_select1" id="vehicule_option" name="vehicule_option" rows="5" tmt:filters="" ><?php echo $t->_vars['vehicule']->vehicule_option; ?></textarea>				
            </dd>
        </dl>
        <dl>
            <dt>Garantie du manufacturier&nbsp;:</dt>
            <dd>
                <input style="width:448px;" class="user_input1" type="text" id="vehicule_garantie" name="vehicule_garantie" value="<?php echo $t->_vars['vehicule']->vehicule_garantie; ?>" tmt:filters="" maxlength="250">                                                                                                                                        
            </dd>
        </dl>
        <dl>
            <dt>Financement&nbsp;:</dt>
            <dd>
                <input style="width:448px;" class="user_input1" type="text" id="vehicule_financement" name="vehicule_financement" value="<?php echo $t->_vars['vehicule']->vehicule_financement; ?>" tmt:filters="" maxlength="250">
            </dd>
      </dl>
    </div>

</div><?php 
}
?>