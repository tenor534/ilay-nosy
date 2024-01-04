// JavaScript Document

function voirImg (imgSrc, id){
	$("#profile_pic").attr("src",""+j_basepath+"resize/actualite/images/popup/" + imgSrc);
	$("#picture_id").val(id);
	$("#photo_id").val(id);
	$("#picture_photo").val(imgSrc);
}

jQuery(document).ready(function() {
	
});