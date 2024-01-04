<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Schweppes</title>
<link href="{$j_basepath}design/front/css/home.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$j_basepath}design/front/js/swfobject.js"></script>
</head>

<body>
<div align="center">
	<div id="Schweppes" style="background:none;">
		<div id="silHome">
		</div>
		<script type="text/javascript">
		// <![CDATA[		
		var so = new SWFObject("{$j_basepath}design/front/swf/homesilbrands.swf", "homesilbrands", "864", "428", "7", "#FFFFFF");
		so.addVariable("emailContact", "contact@dword-consulting.com") ;
		so.addVariable("subjectContact", "Forgot your password") ;
		so.addVariable("messageContact", "") ;
		so.write("silHome");	
		// ]]>
	</script>
	</div>
</div>

</body>
</html>