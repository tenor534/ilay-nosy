jQuery.fn.vjustify=function() {
    var maxHeight=0;
    this.each(function(){
        if (this.offsetHeight>maxHeight) {maxHeight=this.offsetHeight;}
    });
    this.each(function(){
        $(this).height(maxHeight + "px");
        if (this.offsetHeight>maxHeight) {
            $(this).height((maxHeight-(this.offsetHeight-maxHeight))+"px");
        }
    });
};


//Recuperation d'un nb aleatoire pour affichage d'une image
function alea(min, max) {
	var range = max - min + 1;
	return Math.floor(Math.random() * range) + min;
}
var un_a_cinq_a = alea(1,5);
var un_a_cinq_b = alea(1,5);
var un_a_cinq_c = alea(1,5);
var un_a_cinq_d = alea(1,5);

$(document).ready(
function(){

// justification
$(".vjustifie").vjustify();

// ombre des logos
$("img.ombres").wrap("<div class='wrap0'><div class='wrap1'><div class='wrap2'>" + "<div class='wrap3'><div class='wrap4'></div></div></div></div></div>");

			

});
