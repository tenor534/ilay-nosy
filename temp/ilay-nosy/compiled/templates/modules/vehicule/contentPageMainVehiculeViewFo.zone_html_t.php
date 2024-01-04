<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/common/modifier.format_number.php');
function template_meta_8a33e03160ee9e028d1efc635e2c30a1($t){

return $t->_meta;
}
function template_8a33e03160ee9e028d1efc635e2c30a1($t){
?>													<div class="box_inner box_end box_annonce_carac">
                                                        <h4>Caract&eacute;ristiques</h4>
                                                        <div class="info_list">
                                                            <div class="info_list">
                                                                <div class="float">
                                                                    <dl>
                                                                        <dt>Marque&nbsp;:</dt>
                                                                        <dd><strong><?php echo strtoupper($t->_vars['vehicule']->vehicule_marque); ?></strong></dd>
                                                                    </dl>
                                                                    <dl>
                                                                        <dt>Origine&nbsp;:</dt>
                                                                        <dd><strong><?php echo $t->_vars['vehicule']->vehicule_origine; ?></strong></dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="float">
                                                                    <dl>
                                                                        <dt>Mod&egrave;le&nbsp;:</dt>
                                                                        <dd><strong><?php echo strtoupper($t->_vars['vehicule']->vehicule_modele); ?></strong></dd>
                                                                    </dl>
                                                                    <dl>
                                                                        <dt>Version&nbsp;:</dt>
                                                                        <dd><strong><?php echo $t->_vars['vehicule']->vehicule_version; ?></strong></dd>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                            <div class="clearer"></div>
                                                        </div>
                                                        <table class="tbl_results">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Type de v&eacute;hicules</th>
                                                                    <th scope="col">Transmission</th>
                                                                    <th scope="col">Nombre de cylindres</th>
                                                                    <th scope="col">Taille du moteur</th>
                                                                    <th class="last" scope="col">Motricit&eacute;</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="tbl_header_foot">
                                                                    <td></td>
                                                                    <td class="last" colspan="5"></td>
                                                                </tr>
                                                                <?php if($t->_vars['vehicule']->vehicule_nbCylindre == 0): $t->_vars['vehicule']->vehicule_nbCylindre = "S/O"; endif;?>
                                                                <tr>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_type; ?></td>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_transmission; ?></td>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_nbCylindre; ?></td>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_tailleMoteur; ?></td>
                                                                    <td class="last"><?php echo $t->_vars['vehicule']->vehicule_motricite; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="tbl_results">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Type de carburant</th>
                                                                    <th scope="col">Kilom&eacute;trage</th>
                                                                    <th scope="col">Nombre de portes</th>
                                                                    <th scope="col">Nombre de passagers</th>
                                                                    <th class="last" scope="col">Air climatis&eacute;</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="tbl_header_foot">
                                                                    <td></td>
                                                                    <td class="last" colspan="5"></td>
                                                                </tr>
                                                                <?php if($t->_vars['vehicule']->vehicule_nbPorte == 0): $t->_vars['vehicule']->vehicule_nbPorte = "S/O"; endif;?>
                                                                <?php if($t->_vars['vehicule']->vehicule_nbPassager == 0): $t->_vars['vehicule']->vehicule_nbPassager = "S/O"; endif;?>
                                                                <tr>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_carburant; ?></td>
                                                                    <td><?php if($t->_vars['vehicule']->vehicule_kilometrage != 0): echo jtpl_modifier_common_format_number($t->_vars['vehicule']->vehicule_kilometrage, 0, ",", ' ','Km');  else:?>S/O<?php endif;?></td>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_nbPorte; ?></td>
                                                                    <td><?php echo $t->_vars['vehicule']->vehicule_nbPassager; ?></td>
                                                                    <td class="last"><?php echo $t->_vars['vehicule']->vehicule_airClimatise; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="info_list more_info">
	                                                        <?php if(strlen($t->_vars['vehicule']->vehicule_premiereMain)):?>
                                                            <dl>
                                                                <dt>Premi&egrave;re main&nbsp;:</dt>
                                                                <dd><?php echo $t->_vars['vehicule']->vehicule_premiereMain; ?></dd>
                                                            </dl>
                                                            <?php endif;?>
	                                                        <?php if(strlen($t->_vars['vehicule']->vehicule_couleurExterne)):?>
                                                            <dl>
                                                                <dt>Couleur Ext&eacute;rieure&nbsp;:</dt>
                                                                <dd><?php echo $t->_vars['vehicule']->vehicule_couleurExterne; ?></dd>
                                                            </dl>
                                                            <?php endif;?>
	                                                        <?php if(strlen($t->_vars['vehicule']->vehicule_couleurInterne)):?>
                                                            <dl>
                                                                <dt>Couleur Int&eacute;rieure&nbsp;:</dt>
                                                                <dd><?php echo $t->_vars['vehicule']->vehicule_couleurInterne; ?></dd>
                                                            </dl>
                                                            <?php endif;?>
	                                                        <?php if(strlen($t->_vars['vehicule']->vehicule_option)):?>
                                                            <dl>
                                                                <dt>Options&nbsp;:</dt>
                                                                <dd><?php echo $t->_vars['vehicule']->vehicule_option; ?></dd>
                                                            </dl>
                                                            <?php endif;?>
	                                                        <?php if(strlen($t->_vars['vehicule']->vehicule_garantie)):?>
                                                            <dl>
                                                                <dt>Garantie du manufacturier&nbsp;:</dt>
                                                                <dd><?php echo $t->_vars['vehicule']->vehicule_garantie; ?></dd>
                                                            </dl>
                                                            <?php endif;?>
	                                                        <?php if(strlen($t->_vars['vehicule']->vehicule_financement)):?>
                                                            <dl>
                                                                <dt>Financement&nbsp;:</dt>
                                                                <dd><?php echo $t->_vars['vehicule']->vehicule_financement; ?></dd>
                                                          </dl>
                                                            <?php endif;?>
                                                        </div>
                                                    
                                                    </div><?php 
}
?>