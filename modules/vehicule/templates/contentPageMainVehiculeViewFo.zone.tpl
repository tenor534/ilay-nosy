													<div class="box_inner box_end box_annonce_carac">
                                                        <h4>Caract&eacute;ristiques</h4>
                                                        <div class="info_list">
                                                            <div class="info_list">
                                                                <div class="float">
                                                                    <dl>
                                                                        <dt>Marque&nbsp;:</dt>
                                                                        <dd><strong>{$vehicule->vehicule_marque|upper}</strong></dd>
                                                                    </dl>
                                                                    <dl>
                                                                        <dt>Origine&nbsp;:</dt>
                                                                        <dd><strong>{$vehicule->vehicule_origine}</strong></dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="float">
                                                                    <dl>
                                                                        <dt>Mod&egrave;le&nbsp;:</dt>
                                                                        <dd><strong>{$vehicule->vehicule_modele|upper}</strong></dd>
                                                                    </dl>
                                                                    <dl>
                                                                        <dt>Version&nbsp;:</dt>
                                                                        <dd><strong>{$vehicule->vehicule_version}</strong></dd>
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
                                                                {if $vehicule->vehicule_nbCylindre == 0}{assign $vehicule->vehicule_nbCylindre = "S/O"}{/if}
                                                                <tr>
                                                                    <td>{$vehicule->vehicule_type}</td>
                                                                    <td>{$vehicule->vehicule_transmission}</td>
                                                                    <td>{$vehicule->vehicule_nbCylindre}</td>
                                                                    <td>{$vehicule->vehicule_tailleMoteur}</td>
                                                                    <td class="last">{$vehicule->vehicule_motricite}</td>
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
                                                                {if $vehicule->vehicule_nbPorte == 0}{assign $vehicule->vehicule_nbPorte = "S/O"}{/if}
                                                                {if $vehicule->vehicule_nbPassager == 0}{assign $vehicule->vehicule_nbPassager = "S/O"}{/if}
                                                                <tr>
                                                                    <td>{$vehicule->vehicule_carburant}</td>
                                                                    <td>{if $vehicule->vehicule_kilometrage != 0}{$vehicule->vehicule_kilometrage|format_number: 0, ",", ' ','Km'}{else}S/O{/if}</td>
                                                                    <td>{$vehicule->vehicule_nbPorte}</td>
                                                                    <td>{$vehicule->vehicule_nbPassager}</td>
                                                                    <td class="last">{$vehicule->vehicule_airClimatise}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="info_list more_info">
	                                                        {if strlen($vehicule->vehicule_premiereMain)}
                                                            <dl>
                                                                <dt>Premi&egrave;re main&nbsp;:</dt>
                                                                <dd>{$vehicule->vehicule_premiereMain}</dd>
                                                            </dl>
                                                            {/if}
	                                                        {if strlen($vehicule->vehicule_couleurExterne)}
                                                            <dl>
                                                                <dt>Couleur Ext&eacute;rieure&nbsp;:</dt>
                                                                <dd>{$vehicule->vehicule_couleurExterne}</dd>
                                                            </dl>
                                                            {/if}
	                                                        {if strlen($vehicule->vehicule_couleurInterne)}
                                                            <dl>
                                                                <dt>Couleur Int&eacute;rieure&nbsp;:</dt>
                                                                <dd>{$vehicule->vehicule_couleurInterne}</dd>
                                                            </dl>
                                                            {/if}
	                                                        {if strlen($vehicule->vehicule_option)}
                                                            <dl>
                                                                <dt>Options&nbsp;:</dt>
                                                                <dd>{$vehicule->vehicule_option}</dd>
                                                            </dl>
                                                            {/if}
	                                                        {if strlen($vehicule->vehicule_garantie)}
                                                            <dl>
                                                                <dt>Garantie du manufacturier&nbsp;:</dt>
                                                                <dd>{$vehicule->vehicule_garantie}</dd>
                                                            </dl>
                                                            {/if}
	                                                        {if strlen($vehicule->vehicule_financement)}
                                                            <dl>
                                                                <dt>Financement&nbsp;:</dt>
                                                                <dd>{$vehicule->vehicule_financement}</dd>
                                                          </dl>
                                                            {/if}
                                                        </div>
                                                    
                                                    </div>