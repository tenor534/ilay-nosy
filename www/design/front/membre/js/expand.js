function ShowHide(divId) {
	var id = document.getElementById(divId);
	if (id.style.display == "none") {
		eval("id.style.display = 'block'");
	}
	else {
		eval("id.style.display = 'none'");
	}
}


function ShowHideEcoshop(divId,aId) {
	var id = document.getElementById(divId);
	var oId = document.getElementById(aId);
	if (id.style.display == "none") {
		eval("id.style.display = 'block'");
		oId.setAttribute("class","expanded");
		oId.setAttribute("className","expanded");
	}
	else {
		eval("id.style.display = 'none'");
		oId.setAttribute("class","notexpanded");
		oId.setAttribute("className","notexpanded");

	}
}


function cleanUserAndPass(divIdUser,diIdPass){
	var userElement = document.getElementById(divIdUser);
	var passElement = document.getElementById(diIdPass);
	
	userElement.value='';
	passElement.style.backgroundImage='none';
}
