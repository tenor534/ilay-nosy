$.fn.getElementIndex = function (elemParent, elemType) {
	var elemIndex = null;
	var toFound = $(this);
	//console.log(toFound);
	$(elemParent).find(elemType).each(function(i){
		if ( $(this).attr('id') == $(toFound).attr('id')) elemIndex = i;
	});
	return (elemIndex);
}

var lastPopup = null;

$.fn.openPopup = function () {
	//console.log ( this,"?=",lastPopup);
	if ( lastPopup )
		$(lastPopup).closePopup ();
	
	if ((lastPopup == null) || (lastPopup.attr("id") != $(this).attr("id"))) {
		$(this).fadeIn("slow");
		return this;
	}
}

$.fn.closePopup = function () {
	$(lastPopup).fadeOut("slow");
}

$(document).ready( function(){
	$("#link_recommend").click ( function () {
		lastPopup = $("#recommend").openPopup();
	});
	
	$("#link_login").click ( function () {
		lastPopup = $("#login").openPopup();
	});	
	
});


