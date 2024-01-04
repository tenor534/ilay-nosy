<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_98565c0e7b7fc314bc30be647626a760($t){

return $t->_meta;
}
function template_98565c0e7b7fc314bc30be647626a760($t){
?>                    <div id="mainNavWrap">
                         <ul class="mainNav mainNav-example-animate current-about">
                             <li class="home"><a href="<?php jtpl_function_html_jurl( $t,'accueil~accueilFo_abord');?>" title="Accueil">Accueil</a></li>
                             <li class="forum"><a href="<?php jtpl_function_html_jurl( $t,'forum~forumFo_forumCategorieList');?>" title="Liste des forums">Liste des forums</a></li>
                             <li class="news"><a href="<?php jtpl_function_html_jurl( $t,'actualite~actualiteFo_actualiteCategorieList');?>" title="Actualit&eacute;s">Actualit&eacute;s</a></li>
                             <li class="services"><a href="<?php jtpl_function_html_jurl( $t,'petiteAnnonce~petiteAnnonceFo_petiteAnnonceList');?>" title="Petites annonces">Petites annonces</a></li>
                             <li class="announces"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceCategorieList');?>" title="Annonces class&eacute;es">Annonces class&eacute;es</a></li>
                             <li class="progonline"><a href="<?php jtpl_function_html_jurl( $t,'membre~membreFo_tableBord');?>" title="Espace Membre">Prog Online</a></li>
                             
                             <li class="culture"><a href="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceTarifList');?>" title="Nos tarifs">Nos tarifs</a></li>
                          </ul>
                    </div><!-- searchNav: [end] -->
<?php 
}
?>