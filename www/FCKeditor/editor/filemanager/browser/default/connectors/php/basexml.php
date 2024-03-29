<?php /*
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2004 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * File Name: basexml.php
 * 	This is the File Manager Connector for ASP.
 * 
 * Version:  2.0 RC2
 * Modified: 2004-12-10 17:49:19
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (fredck@fckeditor.net)
 */

function CreateXmlHeader( $command, $resourceType, $currentFolder )
{
	// Create the XML document header.
	echo '<?xml version="1.0" encoding="utf-8" ?>' ;

	// Create the main "Connector" node.
	if($resourceType=="medias"){
		echo '<Connector command="' . $command . '" resourceType="File">' ;	
		// Add the current folder node.
		echo '<CurrentFolder path="' . ConvertToXmlAttribute( $currentFolder ) . '" url="' . ConvertToXmlAttribute( GetUrlFromPath( $resourceType, $currentFolder ) ) . '" />' ;
	}
	else {
		echo '<Connector command="' . $command . '" resourceType="' . $resourceType . '">' ;	
		// Add the current folder node.
		echo '<CurrentFolder path="' . ConvertToXmlAttribute( $currentFolder ) . '" url="' . ConvertToXmlAttribute( GetUrlFromPath( $resourceType, $currentFolder ) ) . '" />' ;
	}
}

function CreateXmlFooter()
{
	echo '</Connector>' ;
}
?>