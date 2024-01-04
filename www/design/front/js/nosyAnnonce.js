// JavaScript Document

$(document).ready(function(){
    $("#catgr").change(function() {
        rechargepage();
    });
$("#R11_de").change(function()
{
ajoute_item(document.recherche.R11,document.recherche.R11_de,document.recherche.R11_a);
})
.change();

$("#no_region_de").change(function()
{
ajoute_item(document.recherche.no_region,document.recherche.no_region_de,document.recherche.no_region_a);
})
.change();

$("#R19_de").change(function()
{
ajoute_item(document.recherche.R19,document.recherche.R19_de,document.recherche.R19_a);
})
.change();

    /* AutoComplete */
    function findValueCallback(event, data, formatted) {
	$("#ville_rech_text").val(data[0]);
	document.cookie = "ville_rech_text=" + data[0];

    $tmpData = data[1];
    $tmpData = $tmpData.split("_");
    $tmpReg = $tmpData[1];
    $tmpVil = $tmpData[0];

	$("#ville_rech_id").val($tmpVil);
	document.cookie = "ville_rech_id=" + $tmpVil;
	$("#num_reg_ori").val($tmpReg);
	document.cookie = "num_reg_ori=" + $tmpReg;
    }

    $("#ville_rech_text").result(findValueCallback).next().click(function() {
	$(this).prev().search();
    });

    $("#ville_rech_text").autocomplete('/search_ville.ajax.php', {
	width: 200,
	minChars: 3,
	max:50,
	matchContains:true
    });
    /* Fin AutoComplete */

});


var etatRecherche = 0;
var jsparindex = 2;
var imopen = 0;
var isDHTML = 0;
var isID = 0;
var isAll = 0;
var isLayers = 0;
var continuer=true;

if (document.getElementById) {isID = 1; isDHTML = 1;}
else {
if (document.all) {isAll = 1; isDHTML = 1;}
else {
browserVersion = parseInt(navigator.appVersion);
if ((navigator.appName.indexOf('Netscape') != -1) && (browserVersion == 4)) {isLayers = 1; isDHTML = 1;}
}}

function findDOM(objectID) {
	if (isID) { return (document.getElementById(objectID).style) ; }
	if (isAll) { return (document.all[objectID].style); }
	if (isLayers) { return (document.layers[objectID]); }
}


function showDetail(divId) {
    elem = document.getElementById(divId);
    elem.style.visibility = 'visible';
}

function hideDetail(divId) {
    elem = document.getElementById(divId);
    elem.style.visibility = 'hidden';
}

function doAnswer(name) {
	var recentDOM = findDOM(name,1);

    if (recentDOM.visibility == 'hidden') {
		recentDOM.visibility = 'visible';
		recentDOM.position = 'static';
		imopen=1;
	} else {
        /*if (name == "search_advanced") {
            tmpDOM = findDOM('plusoptions',1);
            tmpDOM.visibility = 'hidden';
            tmpDOM.position = 'absolute';
        }*/
        recentDOM.visibility = 'hidden';
		recentDOM.position = 'absolute';
		imopen=0;
    }
}

function changerZone() {
    var doc=document.recherche;

	doc.page.value='1';
	doc.nbrpages.value='';
	doc.total.value='';

	doc.action = "/zone.php";
	envoyerForm();
}

function afficheDetailRech(no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"RK_"+no+";";
    doc.action='/detail.php';
    envoyerForm();
}

function afficheDetailRechAnchor(no, res_no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"RK_"+no+";";
    doc.action='/detail.php';
    doc.res_no.value = res_no;
    envoyerForm();
}

function afficheDetailRechAnchor(no, res_no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"RK_"+no+";";
    doc.action='/detail.php';
    doc.res_no.value = res_no;
    envoyerForm();
}

function afficheDetailRechWV(site){
    var doc=document.wv;
    doc.redirURL.value=site;
	//alert(site);
    envoyerForm();
	//window.open(site, 'webVoyage', 'height=800, width=950, resizable=yes, scrollbars=yes')
}

function afficheDetailRegion(no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"RC_"+no+";";
    doc.action='/detail.php';
    envoyerForm();
}

function afficheDetailVisite(no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"LC_"+no+";";
    doc.action='/detail.php';
    envoyerForm();
}

function afficheDetailVisiPlus(no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"VC_"+no+";";
    doc.action='/detail.php';
    envoyerForm();
}

function afficheDetail(no){
    var doc=document.recherche;
    doc.a.value=no;
	doc.infst.value=doc.infst.value+"RK_"+no+";";
    doc.action='/detail.php';
    envoyerForm();
}
function new_window_afficheDetail(no){

    var adresse = 'http://www.lespac.com/detail.php?a=' + no ;
		window.open(adresse);
}
function setDateVisite(dateVisite){
    var doc=document.recherche;

	doc.page.value='1';
	doc.visite_recherche.value=dateVisite;
	doc.nbrpages.value='';

	doc.total.value='';
    envoyerForm();
}

function changePage(no){
	var doc=document.recherche;
	doc.page.value=no;
	envoyerForm();
}
/*function changerLieu(){
	var doc=document.recherche;
	doc.action='/location/location1.php';
	envoyerForm();
}*/


function ajoute_item(champ,champ_de,champ_a) {
	for (var i = 1; i < champ_de.options.length; i++) {
		if (champ_de.options[i].selected) {
			if(champ_a.value == '') {
				champ_a.value = champ_de.options[i].text;
				champ.value = champ_de.options[i].value;
			} else {
                // ici on devrait comparer si la valeur est deja presente dans "champ.value"
				$tmpActVal = ","+champ.value+",";
                $tmpNewVal = ","+champ_de.options[i].value+",";

                if ($tmpActVal.indexOf($tmpNewVal) == -1) {
                    champ_a.value = champ_a.value + ',' + champ_de.options[i].text;
                    champ.value = champ.value + ',' + champ_de.options[i].value;
                }
            }
		}
	}

}

function enleve_item(champ,champ_a,champ_e) {
	champ_a.value = '';
	champ.value = '';
	if (champ_e != undefined) champ_e.options[0].selected = true;
}


function changeCritere(objCritere, val){
	var doc=document.recherche;
	doc.nbrpages.value='';
	doc.page.value='';
	doc.total.value='';

	
    objCritere.value = val;
	if (objCritere.name == 'majalerte') {
		document.getElementById("majAlerteSource").value = "cloche";
	}
	envoyerForm();
}

function verifier(){
	continuer=true;
	var doc=document.recherche;

	


	if (continuer){
		return true;
	} else {
		return false;
	}
}

function supprimerZone(){
	var doc=document.recherche;
	doc.nbrpages.value='';
	doc.page.value='1';
	doc.total.value='';
	doc.no_region.value='';
	doc.liste_ville.value='';
	envoyerForm();
}

function supprimerVisite(){
	var doc=document.recherche;
	doc.visite_recherche.value='';
	doc.nbrpages.value='';
	doc.page.value='';
	doc.total.value='';
	envoyerForm();
}

function addFavoris(noFav){
	var doc=document.recherche;
	doc.gofav.value = noFav;
    envoyerForm();
}

function addFavorisNonMembre(noFav){
	var doc=document.recherche;
        doc.action='/favoris.php';
	doc.gofav.value = noFav;
    envoyerForm();
}

function envoyerAmi(noAnn){
    var doc=document.recherche;
	doc.a.value = noAnn;
    doc.action='/envoi_ami.php';
    envoyerForm();
}

function rechargepage(){
    var doc=document.recherche;
    grcat = doc.catgr.options[doc.catgr.selectedIndex].value;
    if (grcat.indexOf("g") == 0) {
        doc.cp.value = "0";
        doc.gr.value = grcat.substring(1,4);
    }else{
        postiret = grcat.indexOf("-");
        doc.cp.value = grcat.substring(1,postiret);
        doc.gr.value = grcat.substring(postiret+1,10);
    }
    doc.R11_de.value = '';
    doc.R11_a.value = '';
    doc.prix_de.value = '';
    doc.prix_a.value = '';
    doc.annee_de.value = '';
    doc.annee_a.value = '';
    doc.no_region_de.value = '';
    doc.no_region_a.value = '';
    doc.R19_de.value = '';
    doc.R19_a.value = '';
    doc.R12.value = '';
    doc.R13_de.value = '';
    doc.R13_a.value = '';
    doc.R16.value = '';
    doc.R14.value = '';
    doc.R15_de.value = '';
    doc.R15_a.value = '';
    doc.R18.value = '';
    doc.R07_de.value = '';
    doc.R07_a.value = '';
    doc.R06.value = '';
    doc.R17.value = '';
    doc.R04.value = '';
    doc.R05.value = '';
    doc.photo.value = '';
    doc.type.value = '';
    doc.etat.value = '';
    doc.nbrpages.value='';
    doc.page.value='';
    doc.total.value='';

    envoyerForm();
}

function changeEtat(objField) {
    changeColor(objField);
    if (etatRecherche == 0) {
        objField.value = "";
        etatRecherche = 1;
    }
}

function changeColor(objField) {
    objField.style.color='#000';
}

function envoyerForm() {
    var doc=document.recherche;
    if (etatRecherche == 0) {
        doc.mots.value = '';
    }
    doc.submit();
}

function ajout(){
	var message="";
	var doc=document.recherche;
	if (message=="" && doc.titre_alerte.value <= "  ") { message= message + "La saisie du nom de l'alerte est obligatoire"; }
	if (message=="") {
		doc.majalerte.value = "O";
		return true;
	} else {
		alert(message);
		return false;
	}
}

