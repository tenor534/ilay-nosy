<!--
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003 Frederico Caldeira Knabben
 *
 * Licensed under the terms of the GNU Lesser General Public License
 * (http://www.opensource.org/licenses/lgpl-license.php)
 *
 * For further information go to http://www.fredck.com/FCKeditor/ 
 * or contact fckeditor@fredck.com.
 *
 * fck_table.html: Table dialog box.
 *
 * Authors:
 *   Frederico Caldeira Knabben (fckeditor@fredck.com)
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
	<head>
		<title>Modèles de mise en page</title>
		<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<SCRIPT LANGUAGE="JavaScript">
		var oEditor = window.parent.InnerDialogLoaded() ;
		var FCK	= oEditor.FCK ;
		</SCRIPT>
	</head>

<?
	//Fonction qui retourne le contenu d'un fichier
	function readFileIntoBuffer( $filename )
	{
		@$fp = fopen( $filename, "r");
		if ( $fp )
		{
			$val = fread( $fp, filesize( $filename ));
			fclose ( $fp );
			return $val;
		}
		return false;
	}

	//Fonction qui retourne le nombre de fichier dans un repertoire
	function Compte_Fichiers($dossier, $ext)
	{
		$rep=opendir($dossier);		
		$long_ext=strlen($ext);
		$i=0;
		$cpt=0;
		while($fichier=readdir($rep))
		{
		  $long_file=strlen($fichier)-$long_ext;
		
		  if (($fichier!=".") and ($fichier!="..") and (substr
			  ($fichier,$long_file,$long_ext)==$ext))
			$cpt++;
		}
	  return "$cpt";
	}

	//Fonction qui crée un fichier avec le contenu 
	function CreateFile($filename, $contenu)
	{
		$fic = $filename;
		$fp = fopen ("$fic","a+");		
		$ligne = fputs($fp,$contenu);
		fclose($fp);
	}

	//Fonction qui crée le sript java pour l'affichage du modèle de mise en page
	function EchoTemplate($fichier) {
		$fp = fopen ("$fichier","r");
		$tmpText = "var TemplateText1   = '';\n";
		while (!feof($fp))
		{
			$ligne = fgets($fp,4096);
			$ligne=chop($ligne);
			if ($ligne == "" || ereg("^#",$ligne))
			{
			  continue;
			}
			else
			{		
				$tmpLine = str_replace('"',"'",$ligne);
				$tmpText .= "TemplateText1  += \"".$tmpLine."\";\n"; 
			}
		}

	  	return $tmpText;
	}
	

	//Variable pour les statut en cours
	$_LIST_FILE = 0;
	$_SAVE_FILE = 1;
	$_USE_FILE  = 2;
	$_ERASE_FILE = 3;
	
	$CurentStatus = 0;
	
	//Application d'un modèle de mise en page choisi / Créer un nouveau modèle de mise en page
	if ($_POST):
		if ($_POST["cmdOK"]==1):
			$CurentStatus = $_USE_FILE;
			$CurrFileSelected = $_POST["hidValue"];
			$CurrFileContent = "";
			$CurrTemplate = str_replace("../../templates/","", $CurrFileSelected);
			$CurrTemplate = str_replace(".html","", $CurrTemplate);
			
			if (trim($CurrTemplate) != ""):
				$CurrFileContent = EchoTemplate($CurrFileSelected);
			endif;	
		endif;
		if (($_POST["cmdOK"]==3) && strlen(trim($_POST["txtFichier"]))):
			$dossier = "../../templates";
			$ext = "html";
			
			$filename = $dossier . "/".$_POST["txtFichier"]."." . $ext;
			$contenu = $_POST["hidParentContent"];			
			CreateFile($filename, $contenu);
			$CurentStatus = $_SAVE_FILE;
		endif;
		if ($_POST["cmdOK"]==2):
			$CurentStatus = $_ERASE_FILE;
			$CurrFileSelected = $_POST["hidValue"];
			$isDeleted = 0;
			$CurrTemplate = str_replace("../../templates/","", $CurrFileSelected);
			$CurrTemplate = str_replace(".html","", $CurrTemplate);

			if (trim($CurrTemplate) != ""):
				if (file_exists($CurrFileSelected)):
					$isDeleted = unlink($CurrFileSelected);
				else:
					$isDeleted = 0;
				endif; 
			endif;	
		endif;
	else:
		//echo "Not yet";
		$CurentStatus = $_LIST_FILE;
	endif;

	//Affiche le contenu du repertoire dans la liste déroulante
	$dossier = "../../templates";
	$ext = "html";

	$cnt = Compte_Fichiers($dossier, $ext);
	$option = ""; 
	$counter = 1;
	if ($cnt > 0):
		//Affiche le nom des fichiers du repertoire
		$nomRepertoire = "../../templates";
		$dossier = opendir($nomRepertoire);
				
		echo '<script language="JavaScript" type="text/javascript">var tplTab = new Array('.$cnt.');';		
		while ($Fichier = readdir($dossier)) {
		  if ($Fichier != "." && $Fichier != ".."&& strlen(trim(str_replace(".$ext","",$Fichier))) != 0) {			
			$nomFichier = strtolower(str_replace(".$ext","",$Fichier));
			$selected = "";
			if($CurentStatus == $_USE_FILE):
				$selected = (strtolower($CurrTemplate) == strtolower($nomFichier))? "selected" : "" ; 
			endif;	
			$option .= '<option value="'.$counter.'" '.$selected.'>'.$nomFichier.'</option>';
			
			$content = $nomRepertoire . "/" . $Fichier;
			echo 'tplTab['.$counter.'] = "'.$content.'";';						
			$counter++;
		  }
		} 
		echo '</script>';						
		closedir($dossier);
	else:
		//La liste est vide
	endif;

?>
<script language="JavaScript" type="text/javascript">
function verif_Save(){
	if(document.MyForm2.txtFichier.value.replace(' ', '') == ''){
		alert('Veuillez saisir le nom de votre modèle de mise en page pour pouvoir l\'enregistrer !'); 
		return false;
	}else{
		document.MyForm2.cmdOK.value = 3;
		document.MyForm2.submit();
	}
	
}
function verif_Apply(){
	if(document.MyForm1.cmbTemplate.value == 0){
		alert('Veuillez choisir un modèle de mise en page !'); 
		return false;
	}else{
		document.MyForm1.cmdOK.value = 1;
		document.MyForm1.submit();
	}
}
function verif_Delete(){
	if(document.MyForm1.cmbTemplate.value == 0){
		alert('Veuillez choisir un modèle de mise en page !'); 
		return false;
	}else{
		if (confirm("Ce modèle de mise en page sera supprimé du repertoire sur le serveur, voulez-vous continuer?")){
			document.MyForm1.cmdOK.value = 2;
			document.MyForm1.submit();
		}else{
			return false;		
		}		 
	}
}

</script>
<body bottommargin="5" leftmargin="15" topmargin="5" rightmargin="5">
	
<table cellSpacing="0" cellPadding="0" width="400" border="0" height="200">
  <tr>
				
    <td valign="top"> 
	<? /*if (($CurentStatus == $_LIST_FILE)||($CurentStatus == $_USE_FILE)||($CurentStatus == $_ERASE_FILE)):*/ ?>	
	<? if (($CurentStatus == $_LIST_FILE)): ?>	
      <table cellSpacing="1" cellPadding="1" width="100%" border="0">
						<tr>
							<td width="54%" valign="top">
								<table width="306" border="0" cellPadding="0" cellSpacing="0">
              <form name="MyForm1" method="post" action="" target="_self">	
			  <input type="hidden" name="hidValue">	
			  <input type="hidden" name="cmdOK">	
              <tr> 
                <td colspan="3"><u>Appliquer ou supprimer un modèle de mise en page :</u> </td>
              </tr>
				<tr> 
                <td width="85"></td>
                <td width="90">&nbsp; </td>
                <td width="100"> </td>
              </tr>              <tr> 
                <td nowrap>Liste des modèles de mise en page :</td>
                  <td align="left">&nbsp;
                    <select class="SELECT" name="cmbTemplate"  onChange="document.MyForm1.hidValue.value = tplTab[this.value];">
					<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
					<?=$option;?>	
                    </select>
				  
				  </td>
                <td><input name="cmdOK1" type="button" style="WIDTH: 100px"  value="Appliquer" onClick="verif_Apply();"></td>
              </tr>
              <tr> 
                <td></td>
                <td>&nbsp; </td>
                <td><input name="cmdOK3" type="button" style="WIDTH: 100px"  value="Supprimer" onClick="verif_Delete();"> 
                </td>
              </tr>
<tr> 
                <td></td>
                <td>&nbsp; </td>
                <td></td>
              </tr>            
			  </form>
			  </table>
							</td>
						</tr>
						
					</table>
					
	<? endif; ?>
	<? if ($CurentStatus == $_LIST_FILE): ?>
					
      <table cellSpacing="0" cellPadding="0" width="100%" border="0" ID="Table1">
	  <form name="MyForm2" method="post" action="">	
	  <input type="hidden" name="hidParentContent">	
	  <input type="hidden" name="cmdOK">	
        <tr> 
          <td colspan="3" nowrap><u>Enregistrer le contenu 
            actuel sous forme de modèle de mise en page :</u></td>
        </tr>
        <tr> 
          <td colspan="3" nowrap>&nbsp;</td>
        </tr>
        <tr> 
          <td width="30%" nowrap>Nom du nouveau modèle de mise en page : </td>
          <td width="30%">&nbsp; 
            <input type="text" name="txtFichier" size="31" maxlength="31">
          </td>
          <td width="30%">&nbsp; </td>
        </tr>
        <tr> 
          <td nowrap>&nbsp; </td>
          <td align="right">
			<input name="cmdOK2" type="button" style="WIDTH: 100px" value="Enregistrer" fcklang="DlgBtnOK" onClick="verif_Save();">
          </td>
          <td>&nbsp; </td>
        </tr>
	  </form>
      </table>
	<? endif; ?>
	<? if (($CurentStatus == $_USE_FILE)&&($CurrFileContent != "")): ?>
	<script language="JavaScript" type="text/javascript">
		<?=$CurrFileContent?>
		//window.opener.objContent.DOM.body.innerHTML = TemplateText1;		 		
		FCK.SetHTML(TemplateText1, 1);
	</script>

      <table cellSpacing="0" cellPadding="0" width="100%" border="0" ID="Table1">
        <tr> 
          <td colspan="3" nowrap>
			<script language="JavaScript" type="text/javascript">
				window.close();		 		
		 		alert("Votre modèle de mise en page a été bien appliqué au contenu de votre webeditor");
			</script>
			Votre modèle de mise en page a été bien appliqué au contenu<br> de votre webeditor
            Template : <strong>
            <?			
			$t = str_replace("../../templates/","", $_POST["hidValue"]);
			$t = str_replace(".html","", $t);
			echo $t;
			?></strong>
            appliqué !<br>
		  </td>
        </tr>
      </table>
	<? elseif ($CurentStatus == $_SAVE_FILE): ?>
      <table cellSpacing="0" cellPadding="0" width="100%" border="0" ID="Table1">
        <tr> 
          <td colspan="3" nowrap>
			<script language="JavaScript" type="text/javascript">
				window.close();		 		
		 		alert("Votre modèle de mise en page a été bien bien enregistré, \n et déjà utilisable pour l\'application dans le webeditor !");
			</script>
            Template : <strong>
            <?			
			$t = str_replace("../../templates/","", $filename);
			$t = str_replace(".html","", $t);
			echo $t;
			?></strong>
            enregistré !<br>
		  </td>
        </tr>
      </table>
	<? elseif (($CurentStatus == $_ERASE_FILE)&&($isDeleted)): ?>
      <table cellSpacing="0" cellPadding="0" width="100%" border="0" ID="Table1">
        <tr> 
          <td colspan="3" nowrap>
			<script language="JavaScript" type="text/javascript">
				window.close();		 		
		 		alert("Votre modèle de mise en page a été supprimé du repertoire sur le serveur !");
			</script>
            Template : <strong>
            <?			
			$t = str_replace("../../templates/","", $_POST["hidValue"]);
			$t = str_replace(".html","", $t);
			echo $t;
			?></strong>
            supprimé !<br>
		  </td>
        </tr>
      </table>
	<? endif; ?>
				</td>
			</tr>
			<tr>
				
    <td align="center" valign="top"> &nbsp; 
      <table cellSpacing="0" cellPadding="0" width="100%" border="0" ID="Table12">
        <tr> 
          <td width="20%">&nbsp;&nbsp; </td>
          <td width="51%">
      		<input type="button" fckLang="DlgBtnCancel" value=" Fermer cette fenêtre " onMouseUp="window.close()">
		  </td>
          <td width="29%">&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
			</tr>
		</table>
	</body>
</html>
<? if ($CurentStatus == $_LIST_FILE): ?>
<script language="JavaScript" type="text/javascript">
	//document.MyForm2.hidParentContent.value = window.opener.objContent.DOM.body.innerHTML;
	document.MyForm2.hidParentContent.value = FCK.GetHTML();
</script>
<? endif; ?>
<? if ($CurentStatus != $_LIST_FILE): ?>
<script language="JavaScript" type="text/javascript">
	//document.MyForm1.hidValue.value = tplTab[document.MyForm1.cmbTemplate.value];
	window.close();
</script>
<? endif; ?>
