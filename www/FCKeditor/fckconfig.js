/*
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2004 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * File Name: fckconfig.js
 * 	Editor configuration settings.
 * 
 * Version:  2.0 RC1
 * Modified: 2004-11-29 18:38:00
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (fredck@fckeditor.net)
 */

// Custom Configurations (leave blank to ignore)
FCKConfig.CustomConfigurationsPath = '' ;
FCKConfig.UseBROnCarriageReturn=true;

// Style File to be used in the editable area.
//FCKConfig.EditorAreaCSS = "../../../common/css/fck_css.css";
FCKConfig.EditorAreaCSS = FCKConfig.BasePath + "css/fck_css.css";

// Enables the debug window
FCKConfig.Debug = false ;

// Set the path for the skin files to use.
FCKConfig.SkinPath = FCKConfig.BasePath + 'skins/default/' ;

FCKConfig.PluginsPath = FCKConfig.BasePath + 'plugins/' ;

// Language settings
// FCKConfig.AutoDetectLanguage = true ;
FCKConfig.AutoDetectLanguage = false ;
FCKConfig.DefaultLanguage    = 'fr' ;

// Enable XHTML support
FCKConfig.EnableXHTML		= false ;
FCKConfig.EnableSourceXHTML	= false ;

// Tells Gecko browsers to use SPAN instead of <B>, <I> and <U>.
FCKConfig.GeckoUseSPAN = true ;

// Force the editor to get the focus on startup (page load).
FCKConfig.StartupFocus = true ;

// Cut and Paste options
FCKConfig.ForcePasteAsPlainText	= false ;

FCKConfig.ForceSimpleAmpersand = true ;

// Link: Target Windows
FCKConfig.LinkShowTargets = true ;
FCKConfig.LinkTargets = '_blank;_parent;_self;_top;_interne' ;
FCKConfig.LinkDefaultTarget = '' ;

FCKConfig.ToolbarStartExpanded	= true ;
FCKConfig.ToolbarCanCollapse	= true ;

//##
//## Toolbar Buttons Sets
//##

FCKConfig.ToolbarSets["Default"] = [
	['Source'],
	['Cut','Copy','Paste','PasteText','PasteWord'],
	['Find','Replace','-','SelectAll','RemoveFormat'],
	['Bold','Italic','Underline'],
	['OrderedList','UnorderedList','-','Outdent','Indent'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink'],
	['Image','Table','Rule'],
	['Style'],
	['TextColor','BGColor']
] ;

FCKConfig.ToolbarSets["__Default"] = [
	['Source'],
	['Cut','Copy','Paste','PasteText','PasteWord'],
	['Find','Replace','-','SelectAll','RemoveFormat'],
	['Bold','Italic','Underline'],
	['OrderedList','UnorderedList','-','Outdent','Indent'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink'],
	['Image','Table','Rule'],
	['Style','FontName','FontSize'],
	['TextColor','BGColor']
] ;

FCKConfig.ToolbarSets["Limitee"] = [
	['Source'],
	['Cut','Copy','Paste','PasteText','PasteWord'],
	['Undo','Redo','-','Find','Replace','-','SelectAll'],
	['RemoveFormat','Bold','Italic','Underline','StrikeThrough'],
	['Link','Unlink'],
	['Image','Table','Rule'],
	['Style'],
	['Template']
] ;

FCKConfig.ToolbarSets["xxxxx"] = [
	['Source'],
	['Cut','Copy','Paste','PasteText','PasteWord'],
	['Undo','Redo','-','Find','Replace','-','SelectAll'],
	['RemoveFormat','Bold','Italic','Underline','StrikeThrough'],
	['Link','Unlink'],
	['Image','Table','Rule'],
	['Style'],
	['Template']
] ;
//	['TextColor','BGColor'],

FCKConfig.ToolbarSets["NewsLetter"] = [
	['Source','-','Save','NewPage','Preview'],
	['Cut','Copy','Paste','PasteText','PasteWord','-','Print'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink'],
	['Image','Table','Rule','SpecialChar','Smiley'],
	['FontSize'],
	['TextColor','BGColor'],
	['Template']
] ;

FCKConfig.ToolbarSets["Template"] = [
	['Source','-','Save','NewPage','Preview'],
	['Cut','Copy','Paste','PasteText','PasteWord','-','Print'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink'],
	['Image','Table','Rule','SpecialChar','Smiley'],
	['FontSize'],
	['TextColor','BGColor'],
	['Template']
] ;

FCKConfig.ToolbarSets["Basic"] = [
	['Cut','Copy','Paste','PasteText','PasteWord'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Bold','Italic','Underline','StrikeThrough'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['SpecialChar'],
	['TextColor','BGColor'],
	['FontSize']
] ;

FCKConfig.ToolbarSets["MarqueSilbrands"] = [
	['Bold','Italic','Underline']
] ;
FCKConfig.ToolbarSets["ElementSilbrands"] = [
	['Bold','Italic','Underline']
] ;
FCKConfig.ToolbarSets["ConfigFCKCorporate"] = [
	['Bold','Italic','Underline']
] ;


// Font Colors
FCKConfig.FontColors = '000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,808080,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF' ;

// Font Combos
FCKConfig.FontNames		= 'Arial;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana' ;
FCKConfig.FontSizes		= '1/xx-small;2/x-small;3/small;4/medium;5/large;6/x-large;7/xx-large' ;
FCKConfig.FontFormats	= 'p;pre;address;h1;h2;h3;h4;h5;h6' ;


FCKConfig.StylesXmlPath	= FCKConfig.BasePath + '../fckstyles.xml' ;


// Path par d�faut pour l'upload
var zMediaPath = "/jelix/ilay-nosy/www/medias" ;

// Link Browsing

FCKConfig.LinkBrowser = true ;

//FCKConfig.LinkBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?Connector=connectors/asp/connector.asp" ;
//FCKConfig.LinkBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?Connector=connectors/asp/connector.asp&ServerPath=/CustomFiles/" ;
//FCKConfig.LinkBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?Connector=connectors/aspx/connector.aspx" ;

//FCKConfig.LinkBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?ServerPath=" + zMediaPath + "&CurrentFolder=/&Connector=connectors/php/connector.php" ;
FCKConfig.LinkBrowserWindowWidth	= screen.width * 0.7 ;	// 70%
FCKConfig.LinkBrowserWindowHeight	= screen.height * 0.7 ;	// 70%

// Link Upload
FCKConfig.LinkUpload = false ;
FCKConfig.LinkUploadURL = FCKConfig.BasePath + "filemanager/upload/aspx/upload.aspx" ;
FCKConfig.LinkUploadWindowWidth		= 300 ;
FCKConfig.LinkUploadWindowHeight	= 150 ;
FCKConfig.LinkUploadAllowedExtensions	= "*" ;		// * or empty for all
FCKConfig.LinkUploadDeniedExtensions	= ".exe .asp .php .aspx .js .cfm .dll .jsp" ;	// empty for none

// Image Browsing
FCKConfig.ImageBrowser = true ;

//FCKConfig.ImageBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?Type=Image&Connector=connectors/asp/connector.asp" ;
//FCKConfig.ImageBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?Type=Image&Connector=connectors/aspx/connector.aspx" ;

FCKConfig.ImageBrowserURL = FCKConfig.BasePath + "filemanager/browser/default/browser.html?externe=no&champs=&ServerPath=" + zMediaPath + "&CurrentFolder=/&Type=&Connector=connectors/php/connector.php" ;
FCKConfig.ImageBrowserWindowWidth  = screen.width * 0.7 ;	// 70% ;
FCKConfig.ImageBrowserWindowHeight = screen.height * 0.7 ;	// 70% ;

// Smiley Dialog
FCKConfig.SmileyPath	= FCKConfig.BasePath + "images/smiley/msn/" ;
FCKConfig.SmileyImages	= ["regular_smile.gif","sad_smile.gif","wink_smile.gif","teeth_smile.gif","confused_smile.gif","tounge_smile.gif","embaressed_smile.gif","omg_smile.gif","whatchutalkingabout_smile.gif","angry_smile.gif","angel_smile.gif","shades_smile.gif","devil_smile.gif","cry_smile.gif","lightbulb.gif","thumbs_down.gif","thumbs_up.gif","heart.gif","broken_heart.gif","kiss.gif","envelope.gif"] ;
FCKConfig.SmileyColumns = 8 ;
FCKConfig.SmileyWindowWidth		= 320 ;
FCKConfig.SmileyWindowHeight	= 240 ;