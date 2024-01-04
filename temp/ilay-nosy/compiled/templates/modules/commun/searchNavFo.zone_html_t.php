<?php 
 require_once('C:\Program Files (x86)\EasyPHP-5.3.8.1\www\projects\jelix\ilay-nosy\lib\jelix/plugins/tpl/html/function.jurl.php');
function template_meta_70e9e2207f237d4e877186603207b956($t){

return $t->_meta;
}
function template_70e9e2207f237d4e877186603207b956($t){
?>                    <div id="searchNav">
                        <form method="post" action="<?php jtpl_function_html_jurl( $t,'annonce~annonceFo_annonceResultList');?>" id="headerSearchForm" name="searchBox">
                            <input id="searchInput" name="searchInput" class="siteSearch" type="text" value="Rechercher" onmouseout="javascript:if(this.value == ''){this.value = 'Rechercher';}" onclick="javascript:if(this.value == 'Rechercher'){this.value = '';}" />
                            <input class="formButton_validSearch" type="image" alt="Rechercher" src="<?php echo $t->_vars['j_basepath']; ?>design/front/images/spacer.gif" />						
                        </form>
                    </div><!-- searchNav: [end] -->
<?php 
}
?>