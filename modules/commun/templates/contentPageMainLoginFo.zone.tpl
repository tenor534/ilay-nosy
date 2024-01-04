							<div class="row" id="mainLogin">
	                            <div class="header">
                                	<h3>Ouverture d' une session Ilay NOSY</h3>
                                </div><!-- header:[end] -->
                                <div class="singleColumnBig">
                                   	<h2>Bienvenue sur Ilay NOSY</h2>
                                   	<h3>D&eacute;couvrez Madagascar &agrave; travers Ilay NOSY</h3>
                                    
                                    <ul class="loginList">
                                        <li><span class="puce">&raquo; </span><span class="titre">Restez en contact avec <strong>Ilay NOSY!Actualit&eacute;s</strong> et <strong>Informations</strong> au quotidien.</span></li>
                                      	<li><span class="puce">&raquo; </span><span class="titre">Partagez vos connaissances et vos exp&eacute;riences sur <strong>Ilay NOSY!Forum</strong></span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Donnez vos avis en envoyant vos propres commentaires sur les diff&eacute;rentes actualit&eacute;s</span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Recherchez et trouvez des produits, des biens en contultant <strong>Ilay NOSY!Petites annonces</strong></span></li>
                                        <li><span class="puce">&raquo; </span><span class="titre">Faites des rencontres gratuitement avec <strong>Ilay NOSY!Rencontre</strong></span></li>
                                    </ul>
									
                                   	<h3>Un seul compte pour acc&eacute;der &agrave; tout sur Ilay NOSY</h3>
									<p class="loginList">
                                    	Votre compte <strong>Ilay NOSY</strong>, c'est l'acc&egrave;s &agrave; des outils de communication, et d'information vous 
                                        permetant de rester en contact d' &eacute;changer avec des personnes qui vous entourent. C'est totalement <b>gratuit</b>.                                        
                                    </p>
	                                
                                   	<h3>Ouvrez une session sur Ilay NOSY</h3>
									<div class="ajaxZone">
									<form id="loginForm" name="loginForm" method="POST" tmt:validate="true" tmt:callback="displayError">
                                        <div class="loginContent">                                        
	                                        <p class="loginTitre">Vous disposez d&eacute;j&agrave; d'un compte Ilay NOSY! ?</p>
                                            <label for="user_email">Identifiant ( votre adresse email ):</label><br>
                                            <input class="user_input2" type="text" id="user_email" value="" name="user_email" tmt:required="true" tmt:pattern="email" tmt:filters="nohtml" maxlength="50" ><br>
                                            <label for="user_password">Mot de passe:</label><br>
                                            <input class="user_input2" type="password" id="user_password" value="" name="user_password" tmt:required="true" tmt:filters="nohtml" maxlength="50" ><br>
                                        	<br>
                                            <a class="formButton_login">valid</a>
                                            <br><br>
                                            <p></p>
                                            {*}
                                            <br><br>
                                            <p><a href="{jurl 'commun~communFo_lostPassword'}">Mot de passe oubli&eacute;?</a></p>
                                            {*}
                                        </div>
								 		<p class="errorMessage" id="errorMessage"></p>                                          
                                        <div class="articleSeparator"></div> 
                                        <div class="loginContent">
                                            <p class="loginTitre">Nouveau sur Ilay NOSY?</p>
                                            <p>
                                            	Cr&eacute;er un compte est facile et gratuit.
	                                        	<br>
    	                                        <a href="{jurl 'commun~communFo_register'}" class="formButton_register">valid</a>
	                                        	<br>
	                                        	<br>
                                            </p>    
                                        </div>
                                    </form>   
                                    </div><!-- :ajaxZone[end] -->                                                                                                                             
                                </div><!-- :[end] -->                        		
                            </div>