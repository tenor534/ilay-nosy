var clicktracker_url="/func/clicktracker.php";var clicktracker_domains=Array("","totalbeauty.com","www.totalbeauty.com","private.totalbeauty.com","zdev.totalbeauty.com","dev.totalbeauty.com","zstaging.totalbeauty.com","staging.totalbeauty.com");function clicktracker_domain(url)
{var reg=new RegExp("^\\w+://((-|\\w)+(\\.(-|\\w)+)*)");var match=reg.exec(url);return match?match[1]:"";}
function clicktracker_inarray(arr,val)
{for(var i in arr){if(arr[i]==val)return true;}
return false;}
function clicktracker_track(url,title,referer)
{var img=new Image();img.src=clicktracker_url+"?url="+url+"&title="+title+"&referer="+referer;}
function clicktracker(e)
{var ie=navigator.appName=="Microsoft Internet Explorer";var src=ie?window.event.srcElement:e.target;var tag='';if(src.tagName=="A"){tag=src;}else if((src.parentNode)&&(src.parentNode.tagName=="A")){tag=src.parentNode;}
if(!tag||tag.tagName!="A")return;domain=clicktracker_domain(tag.href);var inHostDomains=clicktracker_inarray(clicktracker_domains,domain);if(inHostDomains)return;thispage=escape(location.href.substr(0,150));url=escape(tag.href.substr(0,150));if(src.tagName=="A"){title=(src.title)?src.title:src.text;}else if(src.tagName=="IMG"){title=(src.alt)?'[image]'+src.alt:"Image";}
title=escape(title.substr(0,150));setTimeout("clicktracker_track('"+url+"', '"+title+"', '"+thispage+"')",100);return;}
if(navigator.appName=="Microsoft Internet Explorer"){document.attachEvent('onclick',clicktracker);document.attachEvent('onclick',ecomerceTracker);}
else{document.addEventListener('click',clicktracker,false);document.addEventListener('click',ecomerceTracker,false);}
function ecomerceTracker(e)
{var ie=navigator.appName=="Microsoft Internet Explorer";var src=ie?window.event.srcElement:e.target;var anchor='';if(src.tagName=="A"){anchor=src;}else if((src.parentNode)&&(src.parentNode.tagName=="A")){anchor=src.parentNode;}
if(!anchor||anchor.tagName!="A")return;domain=clicktracker_domain(anchor.href);var inHostDomains=clicktracker_inarray(clicktracker_domains,domain);if(inHostDomains)return;xmlRequest=getXmlRequestObject();if(xmlRequest==null){return;}
var url="/func/clickTracker2.php";var encString='';encString+='&'+encodeURIComponent('frPage')+"="+encodeURIComponent(location.href);encString+='&'+encodeURIComponent('toPage')+"="+encodeURIComponent(anchor.href);encString+='&'+encodeURIComponent('msg')+"="+((src.tagName=='A')?encodeURIComponent(anchor.text):encodeURIComponent('[image]'+anchor.title));encString+='&'+encodeURIComponent('alt')+"="+((anchor.alt)?encodeURIComponent(anchor.alt):'');encString+='&'+encodeURIComponent('title')+"="+((anchor.title)?encodeURIComponent(anchor.title):'');encString+='&'+encodeURIComponent('name')+"="+((anchor.name)?encodeURIComponent(anchor.name):'');encString+='&'+encodeURIComponent('id')+"="+((anchor.id)?encodeURIComponent(anchor.id):'');encString+='&'+encodeURIComponent('class')+"="+((anchor.className)?encodeURIComponent(anchor.className):'');xmlRequest.open("POST",url,true);try{xmlRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");xmlRequest.setRequestHeader("Content-length",encString.length);}catch(e){}
xmlRequest.send(encString);}
function getXmlRequestObject()
{var xmlRequest=null;try{xmlRequest=new XMLHttpRequest();}catch(e){try{xmlRequest=new ActiveXObject("Msxml2.XMLHTTP");}catch(e){xmlRequest=new ActiveXObject("Microsoft.XMLHTTP");}}
return xmlRequest;}