
//******************************************************************************
//  Cookie Functions - "Night of the Living Cookie" Version (25-Jul-96)
//  Written by:  Bill Dortch, hIdaho Design <bdortch@hidaho.com>

//  "Internal" function to return the decoded value of a cookie
function getCookieVal (offset) {
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1)
    endstr = document.cookie.length;
  return unescape(document.cookie.substring(offset, endstr));
}

 //  Function to return the value of the cookie specified by "name".
//    name -    String object containing the cookie name.
//    returns - String object containing the cookie value,
//              or null if the cookie does not exist.
//
function GetCookie (name) {
  var arg = name + "=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i = 0;
  while (i < clen) {
    var j = i + alen;
    if (document.cookie.substring(i, j) == arg)
      return getCookieVal (j);
	i = document.cookie.indexOf(" ", i) + 1;
    if (i == 0) break;
  }
  return null;
}

function DeleteCookie (name,path,domain) {
  if (GetCookie(name)) {
    document.cookie = name + "=" +
      ((path) ? "; path=" + path : "") +
      ((domain) ? "; domain=" + domain : "") +
      "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
}
//******************************************************************************

function setCookie(nom,valeur,path) {
	document.cookie = nom + "=" + escape(valeur) +
					 ((path) ? "; path=" + path : "") +
					 "; domain=" + document.domain;
}

function sel_arbo(id_rub)
{
	var tab;
	var val_cook = GetCookie("selart");

	if (val_cook != null && val_cook != "")
	{
		tab = val_cook.split("|");
		if (tab[0] == id_rub)
		{
			expandToItem('mytree2',tab[1]);
		}
	}
}
