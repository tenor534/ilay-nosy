								<!-- Flash actualit&eacute;s -->
                                <div id="innerpageNew">
                                    <h4>Flash actualit&eacute;</h4>

                                    <ul class="secondaryNew">                                    
                                    {foreach $toOfficiels as $oOfficiels}
                                        {assign $tPost = array('cid'=> $oOfficiels->officiel_categorieOffId, 'acid'=>$oOfficiels->officiel_id )}
                                        <li>
                                        	<span class="heure">&raquo; {$oOfficiels->officiel_datePublication|date_format:"%Hh %M"}</span> 
                                        	<span class="titre"><a href="{jurl 'officiel~officielFo_officielDetail', $tPost}">{$oOfficiels->officiel_titre}</a> </span>
                                        </li>
                                    {/foreach}   	                                        
                                    </ul>

                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Afficher d'autres articles" href="{jurl 'officiel~officielFo_officielCategorieList'}">Afficher d'autres articles</a>
                                    </div><!-- braftonFoot:[end]-->		
                                </div>
