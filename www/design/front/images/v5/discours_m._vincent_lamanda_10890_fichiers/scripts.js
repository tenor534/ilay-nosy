/** Script d'impression **/
var NS = (navigator.appName == "Netscape");
var VERSION = parseInt(navigator.appVersion);

function printit()
  {
  if (VERSION > 3)
    {
    if (NS)
      {
      window.print(); // sur Netscape, c'est simple !
      }
    else
      {
      var WebBrowser='<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
      document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
      WebBrowser1.ExecWB(6,2); //Use a 1 vs. a 2 for a prompting dialog box
      WebBrowser1.outerHTML= ""; // mais pas sur IE...
      }
    }
  }

  // validite d'un e-mail

function valider_email(email)
{
	if (email.length == 0)
	{
		alert("Adresse de courrier électronique invalide");
		return false;
	}

	var exp1=new RegExp("^[a-zA-Z0-9]+([_\.-][a-zA-Z0-9]+)*@[a-zA-Z0-9]+([_\.-][a-zA-Z0-9]+)*\.[a-zA-Z0-9]+$");
	if (!exp1.test(email))
   	{
   		alert("Adresse de courrier électronique invalide");
   		return false;
   	}

	return true;
}
