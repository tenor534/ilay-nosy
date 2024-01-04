<?php

require_once ("../../../../../../application.init.php") ;

function computeAbsoluteServerPath ($_zInstallDir, $_zRelativeServerPath)
{
	$zRes = "" ;
	$zInstallDir = $_zInstallDir ;
	if (substr ($zInstallDir, -1) == "/")
	{
		$zInstallDir = substr ($zInstallDir, 0, strlen ($zInstallDir) - 1) ;
	}
	$zRelativeServerPath = $_zRelativeServerPath ;
	if (substr ($zRelativeServerPath , 0, 1) == "/")
	{
		$zRelativeServerPath = substr ($zRelativeServerPath, 1) ;
	}
	$zToken1 = "+" ;
	$zToken2 = "-" ;
	$iIndex = 0 ;
	while (($zToken1 != $zToken2) && ($zInstallDir != "") && ($zRelativeServerPath != ""))
	{
		if ($iIndex == 0)
		{
			$zToken1 = "" ;
			$zToken2 = "" ;
		}
		$iIndex++ ;
		$zToken1 = substr ($zInstallDir, -1) . $zToken1 ;
		$zToken2 .= substr ($zRelativeServerPath, 0, 1) ;
		$zInstallDir = substr ($zInstallDir, 0, strlen ($zInstallDir) - 1) ;
		$zRelativeServerPath = substr ($zRelativeServerPath, 1 - strlen ($zRelativeServerPath)) ;
	}
	if ($zInstallDir == "" || $zRelativeServerPath == "")
	{
		$zInstallDir = $_zInstallDir ;
		$zRelativeServerPath = $_zRelativeServerPath ;
		if (substr ($zInstallDir, -1) == "/")
		{
			$zInstallDir = substr ($zInstallDir, 0, strlen ($zInstallDir) - 1) ;
		}
		if (substr ($zRelativeServerPath , 0, 1) == "/")
		{
			$zRelativeServerPath = substr ($zRelativeServerPath, 1) ;
		}
		$zRes = $zInstallDir . "/" . $zRelativeServerPath ;
	}
	else
	{
		if (substr ($zInstallDir, -1) == "/")
		{
			$zInstallDir = substr ($zInstallDir, 0, strlen ($zInstallDir) - 1) ;
		}
		if (substr ($zRelativeServerPath , 0, 1) == "/")
		{
			$zRelativeServerPath = substr ($zRelativeServerPath, 1) ;
		}
		$zRes = $zInstallDir . "/" . $zToken1 . "/" . $zRelativeServerPath ;
	}
	return $zRes ;
}

$zAbsServerPath = computeAbsoluteServerPath (JELIX_APP_WWW_PATH, $_GET["zSp"]) ;

$zCurrentFolder = "" ;

switch($_GET["action"]){
	case 'S' :		
		$repertoire = substr($_GET["rep"], 1, strlen($_GET["rep"]));
		$rep_file = substr($repertoire, -1);
		if($rep_file == '/'){
			$repertoire = substr ($repertoire, 0, strlen ($repertoire) - 1) ;
			if (substr ($repertoire, 0, 1) == "/")
			{
				$repertoire = substr ($repertoire, 1) ;
			}
			rmdir ($zAbsServerPath . "/" . $repertoire) ;
			
			// --- Récupération du chemin en cours
			$tzPathInfos = pathinfo ($repertoire) ;
			$zCurrentFolder = "/" . $tzPathInfos["dirname"] ;

		}
		else{	
			$tzPathInfos = pathinfo ($_GET["rep"]) ;
			$zAbsServerPath = computeAbsoluteServerPath (JELIX_APP_WWW_PATH, $tzPathInfos["dirname"]) ;
			unlink ($zAbsServerPath . "/" . $tzPathInfos["basename"]) ;

			// --- Récupération du chemin en cours
			$zCurrentFolder = substr ($tzPathInfos["dirname"], strlen ($_GET["zSp"])) ;
			if ($zCurrentFolder == "")
			{
				$zCurrentFolder = "/" ;
			}

		}	
		break;
	case 'M' :		
		$newName = $_GET["newfic"];
		$oldName = $_GET["oldfic"];
		$rep_file = substr($oldName, -1);
		if($rep_file=="/"){
			$oldName = substr ($oldName, 0, strlen ($oldName) - 1) ;
			if (substr ($oldName, 0, 1) == "/")
			{
				$oldName = substr ($oldName, 1) ;
			}
			$tzPathInfos = pathinfo ($oldName) ;
			passthru("mv " . $zAbsServerPath . "/" . $oldName . " " . $zAbsServerPath . "/" . $tzPathInfos["dirname"] . "/" . $newName) ;

			// --- Récupération du chemin en cours
			
			$tzPathInfos = pathinfo ($oldName) ;
			$zCurrentFolder = "/" . $tzPathInfos["dirname"] ;

		}
		else{
			$tzPathInfos = pathinfo ($oldName) ;
			$zAbsServerPath = computeAbsoluteServerPath (JELIX_APP_WWW_PATH, $tzPathInfos["dirname"]) ;
			rename ($zAbsServerPath . "/" . $tzPathInfos["basename"], $zAbsServerPath . "/" . $newName) ;

			// --- Récupération du chemin en cours

			$zCurrentFolder = substr ($tzPathInfos["dirname"], strlen ($_GET["zSp"])) ;
			if ($zCurrentFolder == "")
			{
				$zCurrentFolder = "/" ;
			}

		}
		break;
}
echo ('<SCRIPT LANGUAGE="JavaScript" src="../../../../../../js/common.js"></SCRIPT>') ;
echo ('<script type="text/javascript" src="js/common.js"></script>') ;
echo ('<SCRIPT LANGUAGE="JavaScript">') ;
echo ('var zLocationStr = new String (window.top.location.href) ;') ;
if ($zCurrentFolder != "/") 
{
	$zCurrentFolder .= "/" ;
}
echo ('var zLocationStr2 = zLocationStr.replace(/CurrentFolder=([^&]+)/g, "CurrentFolder=' . $zCurrentFolder . '") ;') ;
echo ('window.top.location.href = zLocationStr2 ;') ;
echo ('</SCRIPT>') ;
?>