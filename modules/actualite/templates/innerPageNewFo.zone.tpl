								<!-- Flash actualit&eacute;s -->
                                <div id="innerpageNew">
                                    <h4>Flash actualit&eacute;</h4>

                                    <ul class="secondaryNew">                                    
                                    {foreach $toActualites as $oActualites}
                                        {assign $tPost = array('cid'=> $oActualites->actualite_categorieActId, 'acid'=>$oActualites->actualite_id )}
                                        <li>
                                        	<span class="heure">&raquo; {$oActualites->actualite_datePublication|date_format:"%Hh %M"}</span> 
                                        	<span class="titre"><a href="{jurl 'actualite~actualiteFo_actualiteDetail', $tPost}">{$oActualites->actualite_titre}</a> </span>
                                        </li>
                                    {/foreach}   	                                        
                                    </ul>

                                    <div class="braftonFoot">
                                        <img src="{$j_basepath}design/front/images/v5/arrowMore.gif" style="display: inline;"/>
                                        <a rel="nofollow" title="Afficher d'autres articles" href="{jurl 'actualite~actualiteFo_actualiteCategorieList'}">Afficher d'autres articles</a>
                                    </div><!-- braftonFoot:[end]-->		
                                </div>
