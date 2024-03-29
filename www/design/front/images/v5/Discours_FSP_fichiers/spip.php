/*
 * jQuery 1.1 - New Wave Javascript
 *
 * Copyright (c) 2007 John Resig (jquery.com)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * + form.js (plugins @ jQuery.com)
 * + ajaxCallback.js (www.spip.net)
 */
/* JavaScriptCompressor 0.8 [www.devpro.it], thanks to Dean Edwards for idea [dean.edwards.name] */
if(typeof window.jQuery==
"undefined"
){
window.undefined=window.undefined;var jQuery=function(a,c){
if (window==this)
return new jQuery(a,c);
a=a||document;
if (jQuery.isFunction(a))
return new jQuery(document)[ jQuery.fn.ready?
"ready"
:
"load"
](a);
if (typeof a==
"string"
){
var m=
/^[^<]*(<(.|\s)+>)[^>]*$/.exec(a);if (m)
a=jQuery.clean([ m[1] ]);
else
return new jQuery(c).find(a);}
return this.setArray(
a.constructor==Array&&a||
(a.jquery||a.length&&a !=window&&!a.nodeType&&a[0] !=undefined&&a[0].nodeType)&&jQuery.makeArray(a)||
[ a ]);};
if (typeof $ !=
"undefined"
)
jQuery._$=$;
var $=jQuery;jQuery.fn=jQuery.prototype={jquery:
"1.1.1"
,size:function(){return this.length;},length:0,get:function(num){return num==undefined?
jQuery.makeArray(this):
this[num];},pushStack:function(a){var ret=jQuery(a);ret.prevObject=this;return ret;},setArray:function(a){this.length=0;[].push.apply(this,a);return this;},each:function(fn,args){return jQuery.each(this,fn,args);},index:function(obj){var pos=-1;this.each(function(i){if (this==obj) pos=i;});return pos;},attr:function(key,value,type){var obj=key;
if (key.constructor==String)
if (value==undefined)
return this.length&&jQuery[ type||
"attr"
](this[0],key)||undefined;else {obj={};obj[ key ]=value;}
return this.each(function(index){
for (var prop in obj)
jQuery.attr(type?this.style:this,prop,jQuery.prop(this,obj[prop],type,index,prop));});},css:function(key,value){return this.attr(key,value,
"curCSS"
);},text:function(e){if (typeof e==
"string"
)
return this.empty().append(document.createTextNode(e));var t=
""
;jQuery.each(e||this,function(){jQuery.each(this.childNodes,function(){if (this.nodeType !=8)
t+=this.nodeType !=1?this.nodeValue:jQuery.fn.text([ this ]);});});return t;},wrap:function(){
var a=jQuery.clean(arguments);
return this.each(function(){
var b=a[0].cloneNode(true);
this.parentNode.insertBefore(b,this);
while (b.firstChild)
b=b.firstChild;
b.appendChild(this);});},append:function(){return this.domManip(arguments,true,1,function(a){this.appendChild(a);});},prepend:function(){return this.domManip(arguments,true,-1,function(a){this.insertBefore(a,this.firstChild);});},before:function(){return this.domManip(arguments,false,1,function(a){this.parentNode.insertBefore(a,this);});},after:function(){return this.domManip(arguments,false,-1,function(a){this.parentNode.insertBefore(a,this.nextSibling);});},end:function(){return this.prevObject||jQuery([]);},find:function(t){return this.pushStack(jQuery.map(this,function(a){return jQuery.find(t,a);}),t);},clone:function(deep){return this.pushStack(jQuery.map(this,function(a){return a.cloneNode(deep !=undefined?deep:true);}));},filter:function(t){return this.pushStack(jQuery.isFunction(t)&&jQuery.grep(this,function(el,index){return t.apply(el,[index])})||jQuery.multiFilter(t,this));},not:function(t){return this.pushStack(t.constructor==String&&jQuery.multiFilter(t,this,true)||jQuery.grep(this,function(a){return (t.constructor==Array||t.jquery)?jQuery.inArray(a,t)<0:a !=t;}));},add:function(t){return this.pushStack(jQuery.merge(this.get(),t.constructor==String?jQuery(t).get():t.length !=undefined&&(!t.nodeName||t.nodeName==
"FORM"
)?t:[t]));},is:function(expr){return expr?jQuery.filter(expr,this).r.length>0:false;},val:function(val){return val==undefined?(this.length?this[0].value:null):this.attr(
"value"
,val);},html:function(val){return val==undefined?(this.length?this[0].innerHTML:null):this.empty().append(val);},domManip:function(args,table,dir,fn){var clone=this.length>1;var a=jQuery.clean(args);if (dir<0)
a.reverse();return this.each(function(){var obj=this;if (table&&jQuery.nodeName(this,
"table"
)&&jQuery.nodeName(a[0],
"tr"
))
obj=this.getElementsByTagName(
"tbody"
)[0]||this.appendChild(document.createElement(
"tbody"
));jQuery.each(a,function(){fn.apply(obj,[ clone?this.cloneNode(true):this ]);});});}};jQuery.extend=jQuery.fn.extend=function(){
var target=arguments[0],a=1;
if (arguments.length==1){target=this;a=0;}
var prop;while (prop=arguments[a++])
for (var i in prop) target[i]=prop[i];
return target;};jQuery.extend({noConflict:function(){if (jQuery._$)
$=jQuery._$;return jQuery;},
isFunction:function(fn){return !!fn&&typeof fn !=
"string"
&&typeof fn[0]==
"undefined"
&&
/function/i.test(fn+
""
);},nodeName:function(elem,name){return elem.nodeName&&elem.nodeName.toUpperCase()==name.toUpperCase();},
each:function(obj,fn,args){if (obj.length==undefined)
for (var i in obj)
fn.apply(obj[i],args||[i,obj[i]]);else
for (var i=0,ol=obj.length;i<ol;i++)
if (fn.apply(obj[i],args||[i,obj[i]])===false) break;return obj;},prop:function(elem,value,type,index,prop){
if (jQuery.isFunction(value))
return value.call(elem,[index]);
var exclude=
/z-?index|font-?weight|opacity|zoom|line-?height/i;
return value&&value.constructor==Number&&type==
"curCSS"
&&!exclude.test(prop)?value+
"px"
:value;},className:{
add:function(elem,c){jQuery.each(c.split(
/\s+/),function(i,cur){if (!jQuery.className.has(elem.className,cur))
elem.className+=(elem.className?
" "
:
""
)+cur;});},
remove:function(elem,c){elem.className=c?jQuery.grep(elem.className.split(
/\s+/),function(cur){return !jQuery.className.has(c,cur);}).join(
" "
):
""
;},
has:function(t,c){t=t.className||t;return t&&new RegExp(
"(^|\\s)"
+c+
"(\\s|$)"
).test(t);}},swap:function(e,o,f){for (var i in o){e.style[
"old"
+i]=e.style[i];e.style[i]=o[i];}
f.apply(e,[]);for (var i in o)
e.style[i]=e.style[
"old"
+i];},css:function(e,p){if (p==
"height"
||p==
"width"
){var old={},oHeight,oWidth,d=[
"Top"
,
"Bottom"
,
"Right"
,
"Left"
];jQuery.each(d,function(){old[
"padding"
+this]=0;old[
"border"
+this+
"Width"
]=0;});jQuery.swap(e,old,function(){if (jQuery.css(e,
"display"
) !=
"none"
){oHeight=e.offsetHeight;oWidth=e.offsetWidth;} else {e=jQuery(e.cloneNode(true))
.find(
":radio"
).removeAttr(
"checked"
).end()
.css({visibility:
"hidden"
,position:
"absolute"
,display:
"block"
,right:
"0"
,left:
"0"
}).appendTo(e.parentNode)[0];var parPos=jQuery.css(e.parentNode,
"position"
);if (parPos==
""
||parPos==
"static"
)
e.parentNode.style.position=
"relative"
;oHeight=e.clientHeight;oWidth=e.clientWidth;if (parPos==
""
||parPos==
"static"
)
e.parentNode.style.position=
"static"
;e.parentNode.removeChild(e);}});return p==
"height"
?oHeight:oWidth;}
return jQuery.curCSS(e,p);},curCSS:function(elem,prop,force){var ret;if (prop==
"opacity"
&&jQuery.browser.msie)
return jQuery.attr(elem.style,
"opacity"
);if (prop==
"float"
||prop==
"cssFloat"
)
prop=jQuery.browser.msie?
"styleFloat"
:
"cssFloat"
;if (!force&&elem.style[prop])
ret=elem.style[prop];else if (document.defaultView&&document.defaultView.getComputedStyle){if (prop==
"cssFloat"
||prop==
"styleFloat"
)
prop=
"float"
;prop=prop.replace(
/([A-Z])/g,
"-$1"
).toLowerCase();var cur=document.defaultView.getComputedStyle(elem,null);if (cur)
ret=cur.getPropertyValue(prop);else if (prop==
"display"
)
ret=
"none"
;else
jQuery.swap(elem,{display:
"block"
},function(){var c=document.defaultView.getComputedStyle(this,
""
);ret=c&&c.getPropertyValue(prop)||
""
;});} else if (elem.currentStyle){var newProp=prop.replace(
/\-(\w)/g,function(m,c){return c.toUpperCase();});ret=elem.currentStyle[prop]||elem.currentStyle[newProp];}
return ret;},clean:function(a){var r=[];jQuery.each(a,function(i,arg){if (!arg) return;if (arg.constructor==Number)
arg=arg.toString();
if (typeof arg==
"string"
){
var s=jQuery.trim(arg),div=document.createElement(
"div"
),tb=[];var wrap=
!s.indexOf(
"<opt"
)&&[1,
"<select>"
,
"</select>"
]||(!s.indexOf(
"<thead"
)||!s.indexOf(
"<tbody"
)||!s.indexOf(
"<tfoot"
))&&[1,
"<table>"
,
"</table>"
]||!s.indexOf(
"<tr"
)&&[2,
"<table><tbody>"
,
"</tbody></table>"
]||
(!s.indexOf(
"<td"
)||!s.indexOf(
"<th"
))&&[3,
"<table><tbody><tr>"
,
"</tr></tbody></table>"
]||[0,
""
,
""
];
div.innerHTML=wrap[1]+s+wrap[2];
while (wrap[0]--)
div=div.firstChild;
if (jQuery.browser.msie){
if (!s.indexOf(
"<table"
)&&s.indexOf(
"<tbody"
)<0)
 tb=div.firstChild&&div.firstChild.childNodes;
else if (wrap[1]==
"<table>"
&&s.indexOf(
"<tbody"
)<0)
tb=div.childNodes;for (var n=tb.length-1;n>=0;--n)
if (jQuery.nodeName(tb[n],
"tbody"
)&&!tb[n].childNodes.length)
tb[n].parentNode.removeChild(tb[n]);}
arg=div.childNodes;}
if (arg.length===0)
return;if (arg[0]==undefined)
r.push(arg);else
r=jQuery.merge(r,arg);});return r;},attr:function(elem,name,value){var fix={
"for"
:
"htmlFor"
,
"class"
:
"className"
,
"float"
:jQuery.browser.msie?
"styleFloat"
:
"cssFloat"
,cssFloat:jQuery.browser.msie?
"styleFloat"
:
"cssFloat"
,innerHTML:
"innerHTML"
,className:
"className"
,value:
"value"
,disabled:
"disabled"
,checked:
"checked"
,readonly:
"readOnly"
,selected:
"selected"
};
if (name==
"opacity"
&&jQuery.browser.msie&&value !=undefined){
elem.zoom=1;
return elem.filter=elem.filter.replace(
/alpha\([^\)]*\)/gi,
""
)+(value==1?
""
:
"alpha(opacity="
+value * 100+
")"
);} else if (name==
"opacity"
&&jQuery.browser.msie)
return elem.filter?parseFloat(elem.filter.match(
/alpha\(opacity=(.*)\)/)[1]) / 100:1;
if (name==
"opacity"
&&jQuery.browser.mozilla&&value==1)
value=0.9999;
if (fix[name]){if (value !=undefined) elem[fix[name]]=value;return elem[fix[name]];} else if (value==undefined&&jQuery.browser.msie&&jQuery.nodeName(elem,
"form"
)&&(name==
"action"
||name==
"method"
))
return elem.getAttributeNode(name).nodeValue;
else if (elem.tagName){if (value !=undefined) elem.setAttribute(name,value);return elem.getAttribute(name);} else {name=name.replace(
/-([a-z])/ig,function(z,b){return b.toUpperCase();});if (value !=undefined) elem[name]=value;return elem[name];}},trim:function(t){return t.replace(
/^\s+|\s+$/g,
""
);},makeArray:function(a){var r=[];if (a.constructor !=Array)
for (var i=0,al=a.length;i<al;i++)
r.push(a[i]);else
r=a.slice(0);return r;},inArray:function(b,a){for (var i=0,al=a.length;i<al;i++)
if (a[i]==b)
return i;return-1;},merge:function(first,second){var r=[].slice.call(first,0);
for (var i=0,sl=second.length;i<sl;i++)
if (jQuery.inArray(second[i],r)==-1)
first.push(second[i]);return first;},grep:function(elems,fn,inv){
if (typeof fn==
"string"
)
fn=new Function(
"a"
,
"i"
,
"return "
+fn);var result=[];
for (var i=0,el=elems.length;i<el;i++)
if (!inv&&fn(elems[i],i)||inv&&!fn(elems[i],i))
result.push(elems[i]);return result;},map:function(elems,fn){
if (typeof fn==
"string"
)
fn=new Function(
"a"
,
"return "
+fn);var result=[],r=[];
for (var i=0,el=elems.length;i<el;i++){var val=fn(elems[i],i);if (val !==null&&val !=undefined){if (val.constructor !=Array) val=[val];result=result.concat(val);}}
var r=result.length?[ result[0] ]:[];check:for (var i=1,rl=result.length;i<rl;i++){for (var j=0;j<i;j++)
if (result[i]==r[j])
continue check;r.push(result[i]);}
return r;}});
new function(){var b=navigator.userAgent.toLowerCase();
jQuery.browser={safari:
/webkit/.test(b),opera:
/opera/.test(b),msie:
/msie/.test(b)&&!
/opera/.test(b),mozilla:
/mozilla/.test(b)&&!
/(compatible|webkit)/.test(b)};
jQuery.boxModel=!jQuery.browser.msie||document.compatMode==
"CSS1Compat"
;};jQuery.each({parent:
"a.parentNode"
,parents:
"jQuery.parents(a)"
,next:
"jQuery.nth(a,2,'nextSibling')"
,prev:
"jQuery.nth(a,2,'previousSibling')"
,siblings:
"jQuery.sibling(a.parentNode.firstChild,a)"
,children:
"jQuery.sibling(a.firstChild)"
},function(i,n){jQuery.fn[ i ]=function(a){var ret=jQuery.map(this,n);if (a&&typeof a==
"string"
)
ret=jQuery.multiFilter(a,ret);return this.pushStack(ret);};});jQuery.each({appendTo:
"append"
,prependTo:
"prepend"
,insertBefore:
"before"
,insertAfter:
"after"
},function(i,n){jQuery.fn[ i ]=function(){var a=arguments;return this.each(function(){for (var j=0,al=a.length;j<al;j++)
jQuery(a[j])[n](this);});};});jQuery.each({removeAttr:function(key){jQuery.attr(this,key,
""
);this.removeAttribute(key);},addClass:function(c){jQuery.className.add(this,c);},removeClass:function(c){jQuery.className.remove(this,c);},toggleClass:function(c){jQuery.className[ jQuery.className.has(this,c)?
"remove"
:
"add"
](this,c);},remove:function(a){if (!a||jQuery.filter(a,[this]).r.length)
this.parentNode.removeChild(this);},empty:function(){while (this.firstChild)
this.removeChild(this.firstChild);}},function(i,n){jQuery.fn[ i ]=function(){return this.each(n,arguments);};});jQuery.each([
"eq"
,
"lt"
,
"gt"
,
"contains"
],function(i,n){jQuery.fn[ n ]=function(num,fn){return this.filter(
":"
+n+
"("
+num+
")"
,fn);};});jQuery.each([
"height"
,
"width"
],function(i,n){jQuery.fn[ n ]=function(h){return h==undefined?(this.length?jQuery.css(this[0],n):null):this.css(n,h.constructor==String?h:h+
"px"
);};});jQuery.extend({expr:{
""
:
"m[2]=='*'||jQuery.nodeName(a,m[2])"
,
"#"
:
"a.getAttribute('id')==m[2]"
,
":"
:{
lt:
"i<m[3]-0"
,gt:
"i>m[3]-0"
,nth:
"m[3]-0==i"
,eq:
"m[3]-0==i"
,first:
"i==0"
,last:
"i==r.length-1"
,even:
"i%2==0"
,odd:
"i%2"
,
"nth-child"
:
"jQuery.nth(a.parentNode.firstChild,m[3],'nextSibling',a)==a"
,
"first-child"
:
"jQuery.nth(a.parentNode.firstChild,1,'nextSibling')==a"
,
"last-child"
:
"jQuery.nth(a.parentNode.lastChild,1,'previousSibling')==a"
,
"only-child"
:
"jQuery.sibling(a.parentNode.firstChild).length==1"
,
parent:
"a.firstChild"
,empty:
"!a.firstChild"
,
contains:
"jQuery.fn.text.apply([a]).indexOf(m[3])>=0"
,
visible:
'a.type!="hidden"&&jQuery.css(a,"display")!="none"&&jQuery.css(a,"visibility")!="hidden"'
,hidden:
'a.type=="hidden"||jQuery.css(a,"display")=="none"||jQuery.css(a,"visibility")=="hidden"'
,
enabled:
"!a.disabled"
,disabled:
"a.disabled"
,checked:
"a.checked"
,selected:
"a.selected||jQuery.attr(a,'selected')"
,
text:
"a.type=='text'"
,radio:
"a.type=='radio'"
,checkbox:
"a.type=='checkbox'"
,file:
"a.type=='file'"
,password:
"a.type=='password'"
,submit:
"a.type=='submit'"
,image:
"a.type=='image'"
,reset:
"a.type=='reset'"
,button:
'a.type=="button"||jQuery.nodeName(a,"button")'
,input:
"/input|select|textarea|button/i.test(a.nodeName)"
},
"."
:
"jQuery.className.has(a,m[2])"
,
"@"
:{
"="
:
"z==m[4]"
,
"!="
:
"z!=m[4]"
,
"^="
:
"z&&!z.indexOf(m[4])"
,
"$="
:
"z&&z.substr(z.length - m[4].length,m[4].length)==m[4]"
,
"*="
:
"z&&z.indexOf(m[4])>=0"
,
""
:
"z"
,_resort:function(m){return [
""
,m[1],m[3],m[2],m[5]];},_prefix:
"z=a[m[3]]||jQuery.attr(a,m[3]);"
},
"["
:
"jQuery.find(m[2],a).length"
},
parse:[
/^\[ *(@)([a-z0-9_-]*) *([!*$^=]*) *('?"?)(.*?)\4 *\]/i,
/^(\[)\s*(.*?(\[.*?\])?[^[]*?)\s*\]/,
/^(:)([a-z0-9_-]*)\("?'?(.*?(\(.*?\))?[^(]*?)"?'?\)/i,
/^([:.#]*)([a-z0-9_*-]*)/i
],token:[
/^(\/?\.\.)/,
"a.parentNode"
,
/^(>|\/)/,
"jQuery.sibling(a.firstChild)"
,
/^(\+)/,
"jQuery.nth(a,2,'nextSibling')"
,
/^(~)/,function(a){var s=jQuery.sibling(a.parentNode.firstChild);return s.slice(0,jQuery.inArray(a,s));}
],multiFilter:function(expr,elems,not){var old,cur=[];while (expr&&expr !=old){old=expr;var f=jQuery.filter(expr,elems,not);expr=f.t.replace(
/^\s*,\s*/,
""
);cur=not?elems=f.r:jQuery.merge(cur,f.r);}
return cur;},find:function(t,context){
if (typeof t !=
"string"
)
return [ t ];
if (context&&!context.nodeType)
context=null;
context=context||document;
if (!t.indexOf(
"//"
)){context=context.documentElement;t=t.substr(2,t.length);
} else if (!t.indexOf(
"/"
)){context=context.documentElement;t=t.substr(1,t.length);if (t.indexOf(
"/"
)>=1)
t=t.substr(t.indexOf(
"/"
),t.length);}
var ret=[context],done=[],last=null;
while (t&&last !=t){var r=[];last=t;t=jQuery.trim(t).replace(
/^\/\//i,
""
);var foundToken=false;
var re=
/^[\/>]\s*([a-z0-9*-]+)/i;var m=re.exec(t);if (m){
jQuery.each(ret,function(){for (var c=this.firstChild;c;c=c.nextSibling)
if (c.nodeType==1&&(jQuery.nodeName(c,m[1])||m[1]==
"*"
))
r.push(c);});ret=r;t=t.replace(re,
""
);if (t.indexOf(
" "
)==0) continue;foundToken=true;} else {
for (var i=0;i<jQuery.token.length;i+=2){
var re=jQuery.token[i];var m=re.exec(t);
if (m){
r=ret=jQuery.map(ret,jQuery.isFunction(jQuery.token[i+1])?jQuery.token[i+1]:function(a){return eval(jQuery.token[i+1]);});
t=jQuery.trim(t.replace(re,
""
));foundToken=true;break;}}}
if (t&&!foundToken){
if (!t.indexOf(
","
)){
if (ret[0]==context) ret.shift();
jQuery.merge(done,ret);
r=ret=[context];
t=
" "
+t.substr(1,t.length);} else {
var re2=
/^([a-z0-9_-]+)(#)([a-z0-9\\*_-]*)/i;var m=re2.exec(t);
if (m){m=[ 0,m[2],m[3],m[1] ];} else {
re2=
/^([#.]?)([a-z0-9\\*_-]*)/i;m=re2.exec(t);}
if (m[1]==
"#"
&&ret[ret.length-1].getElementById){
var oid=ret[ret.length-1].getElementById(m[2]);
ret=r=oid&&(!m[3]||jQuery.nodeName(oid,m[3]))?[oid]:[];} else {
if (m[1]==
"."
)
var rec=new RegExp(
"(^|\\s)"
+m[2]+
"(\\s|$)"
);
jQuery.each(ret,function(){
var tag=m[1] !=
""
||m[0]==
""
?
"*"
:m[2];
if (jQuery.nodeName(this,
"object"
)&&tag==
"*"
)
tag=
"param"
;jQuery.merge(r,m[1] !=
""
&&ret.length !=1?jQuery.getAll(this,[],m[1],m[2],rec):this.getElementsByTagName(tag));});
if (m[1]==
"."
&&ret.length==1)
r=jQuery.grep(r,function(e){return rec.test(e.className);});
if (m[1]==
"#"
&&ret.length==1){
var tmp=r;r=[];
jQuery.each(tmp,function(){if (this.getAttribute(
"id"
)==m[2]){r=[ this ];return false;}});}
ret=r;}
t=t.replace(re2,
""
);}}
if (t){
var val=jQuery.filter(t,r);ret=r=val.r;t=jQuery.trim(val.t);}}
if (ret&&ret[0]==context) ret.shift();
jQuery.merge(done,ret);return done;},filter:function(t,r,not){
while (t&&
/^[a-z[({<*:.#]/i.test(t)){var p=jQuery.parse,m;jQuery.each(p,function(i,re){
m=re.exec(t);if (m){
t=t.substring(m[0].length);
if (jQuery.expr[ m[1] ]._resort)
m=jQuery.expr[ m[1] ]._resort(m);return false;}});
if (m[1]==
":"
&&m[2]==
"not"
)
r=jQuery.filter(m[3],r,true).r;
else if (m[1]==
"."
){var re=new RegExp(
"(^|\\s)"
+m[2]+
"(\\s|$)"
);r=jQuery.grep(r,function(e){return re.test(e.className||
""
);},not);
} else {var f=jQuery.expr[m[1]];if (typeof f !=
"string"
)
f=jQuery.expr[m[1]][m[2]];
eval(
"f = function(a,i){"
+(jQuery.expr[ m[1] ]._prefix||
""
)+
"return "
+f+
"}"
);
r=jQuery.grep(r,f,not);}}
return {r:r,t:t};},getAll:function(o,r,token,name,re){for (var s=o.firstChild;s;s=s.nextSibling)
if (s.nodeType==1){var add=true;if (token==
"."
)
add=s.className&&re.test(s.className);else if (token==
"#"
)
add=s.getAttribute(
"id"
)==name;if (add)
r.push(s);if (token==
"#"
&&r.length) break;if (s.firstChild)
jQuery.getAll(s,r,token,name,re);}
return r;},parents:function(elem){var matched=[];var cur=elem.parentNode;while (cur&&cur !=document){matched.push(cur);cur=cur.parentNode;}
return matched;},nth:function(cur,result,dir,elem){result=result||1;var num=0;for (;cur;cur=cur[dir]){if (cur.nodeType==1) num++;if (num==result||result==
"even"
&&num%2==0&&num>1&&cur==elem||result==
"odd"
&&num%2==1&&cur==elem) return cur;}},sibling:function(n,elem){var r=[];for (;n;n=n.nextSibling){if (n.nodeType==1&&(!elem||n !=elem))
r.push(n);}
return r;}});
jQuery.event={
add:function(element,type,handler,data){
if (jQuery.browser.msie&&element.setInterval !=undefined)
element=window;
if(data)
 handler.data=data;
if (!handler.guid)
handler.guid=this.guid++;
if (!element.events)
element.events={};
var handlers=element.events[type];
if (!handlers){
handlers=element.events[type]={};
if (element[
"on"
+type])
handlers[0]=element[
"on"
+type];}
handlers[handler.guid]=handler;
element[
"on"
+type]=this.handle;
if (!this.global[type])
this.global[type]=[];this.global[type].push(element);},guid:1,global:{},
remove:function(element,type,handler){if (element.events)
if (type&&type.type)
delete element.events[ type.type ][ type.handler.guid ];else if (type&&element.events[type])
if (handler)
delete element.events[type][handler.guid];else
for (var i in element.events[type])
delete element.events[type][i];else
for (var j in element.events)
this.remove(element,j);},trigger:function(type,data,element){
data=jQuery.makeArray(data||[]);
if (!element)
jQuery.each(this.global[type]||[],function(){jQuery.event.trigger(type,data,this);});
else {var handler=element[
"on"
+type ],val,fn=jQuery.isFunction(element[ type ]);if (handler){
data.unshift(this.fix({type:type,target:element}));
if ((val=handler.apply(element,data)) !==false)
this.triggered=true;}
if (fn&&val !==false)
element[ type ]();this.triggered=false;}},handle:function(event){
if (typeof jQuery==
"undefined"
||jQuery.event.triggered) return;
event=jQuery.event.fix(event||window.event||{});
var returnValue;var c=this.events[event.type];var args=[].slice.call(arguments,1);args.unshift(event);for (var j in c){
args[0].handler=c[j];args[0].data=c[j].data;if (c[j].apply(this,args)===false){event.preventDefault();event.stopPropagation();returnValue=false;}}
if (jQuery.browser.msie) event.target=event.preventDefault=event.stopPropagation=event.handler=event.data=null;return returnValue;},fix:function(event){
if (!event.target&&event.srcElement)
event.target=event.srcElement;
if (event.pageX==undefined&&event.clientX !=undefined){var e=document.documentElement,b=document.body;event.pageX=event.clientX+(e.scrollLeft||b.scrollLeft);event.pageY=event.clientY+(e.scrollTop||b.scrollTop);}
if (jQuery.browser.safari&&event.target.nodeType==3){
var originalEvent=event;event=jQuery.extend({},originalEvent);
event.target=originalEvent.target.parentNode;
event.preventDefault=function(){return originalEvent.preventDefault();};event.stopPropagation=function(){return originalEvent.stopPropagation();};}
if (!event.preventDefault)
event.preventDefault=function(){this.returnValue=false;};if (!event.stopPropagation)
event.stopPropagation=function(){this.cancelBubble=true;};return event;}};jQuery.fn.extend({bind:function(type,data,fn){return this.each(function(){jQuery.event.add(this,type,fn||data,data);});},one:function(type,data,fn){return this.each(function(){jQuery.event.add(this,type,function(event){jQuery(this).unbind(event);return (fn||data).apply(this,arguments);},data);});},unbind:function(type,fn){return this.each(function(){jQuery.event.remove(this,type,fn);});},trigger:function(type,data){return this.each(function(){jQuery.event.trigger(type,data,this);});},toggle:function(){
var a=arguments;return this.click(function(e){
this.lastToggle=this.lastToggle==0?1:0;
e.preventDefault();
return a[this.lastToggle].apply(this,[e])||false;});},hover:function(f,g){
function handleHover(e){
var p=(e.type==
"mouseover"
?e.fromElement:e.toElement)||e.relatedTarget;
while (p&&p !=this) try {p=p.parentNode} catch(e){p=this;};
if (p==this) return false;
return (e.type==
"mouseover"
?f:g).apply(this,[e]);}
return this.mouseover(handleHover).mouseout(handleHover);},ready:function(f){
if (jQuery.isReady)
f.apply(document,[jQuery]);
else {
jQuery.readyList.push(function(){return f.apply(this,[jQuery])});}
return this;}});jQuery.extend({
isReady:false,readyList:[],
ready:function(){
if (!jQuery.isReady){
jQuery.isReady=true;
if (jQuery.readyList){
jQuery.each(jQuery.readyList,function(){this.apply(document);});
jQuery.readyList=null;}
if (jQuery.browser.mozilla||jQuery.browser.opera)
document.removeEventListener(
"DOMContentLoaded"
,jQuery.ready,false);}}});new function(){jQuery.each((
"blur,focus,load,resize,scroll,unload,click,dblclick,"
+
"mousedown,mouseup,mousemove,mouseover,mouseout,change,select,"
+
"submit,keydown,keypress,keyup,error"
).split(
","
),function(i,o){
jQuery.fn[o]=function(f){return f?this.bind(o,f):this.trigger(o);};});
if (jQuery.browser.mozilla||jQuery.browser.opera)
document.addEventListener(
"DOMContentLoaded"
,jQuery.ready,false);
else if (jQuery.browser.msie){
document.write(
"<scr"
+
"ipt id=__ie_init defer=true "
+
"src=//:><\/script>"
);
var script=document.getElementById(
"__ie_init"
);
if (script)
 script.onreadystatechange=function(){if (this.readyState !=
"complete"
) return;this.parentNode.removeChild(this);jQuery.ready();};
script=null;
} else if (jQuery.browser.safari)
jQuery.safariTimer=setInterval(function(){
if (document.readyState==
"loaded"
||document.readyState==
"complete"
){
clearInterval(jQuery.safariTimer);jQuery.safariTimer=null;
jQuery.ready();}},10);
jQuery.event.add(window,
"load"
,jQuery.ready);};
if (jQuery.browser.msie)
jQuery(window).one(
"unload"
,function(){var global=jQuery.event.global;for (var type in global){var els=global[type],i=els.length;if (i&&type !=
'unload'
)
do
jQuery.event.remove(els[i-1],type);while (--i);}});jQuery.fn.extend({show:function(speed,callback){var hidden=this.filter(
":hidden"
);speed?hidden.animate({height:
"show"
,width:
"show"
,opacity:
"show"
},speed,callback):hidden.each(function(){this.style.display=this.oldblock?this.oldblock:
""
;if (jQuery.css(this,
"display"
)==
"none"
)
this.style.display=
"block"
;});return this;},hide:function(speed,callback){var visible=this.filter(
":visible"
);speed?visible.animate({height:
"hide"
,width:
"hide"
,opacity:
"hide"
},speed,callback):visible.each(function(){this.oldblock=this.oldblock||jQuery.css(this,
"display"
);if (this.oldblock==
"none"
)
this.oldblock=
"block"
;this.style.display=
"none"
;});return this;},
_toggle:jQuery.fn.toggle,toggle:function(fn,fn2){var args=arguments;return jQuery.isFunction(fn)&&jQuery.isFunction(fn2)?this._toggle(fn,fn2):this.each(function(){jQuery(this)[ jQuery(this).is(
":hidden"
)?
"show"
:
"hide"
]
.apply(jQuery(this),args);});},slideDown:function(speed,callback){return this.animate({height:
"show"
},speed,callback);},slideUp:function(speed,callback){return this.animate({height:
"hide"
},speed,callback);},slideToggle:function(speed,callback){return this.each(function(){var state=jQuery(this).is(
":hidden"
)?
"show"
:
"hide"
;jQuery(this).animate({height:state},speed,callback);});},fadeIn:function(speed,callback){return this.animate({opacity:
"show"
},speed,callback);},fadeOut:function(speed,callback){return this.animate({opacity:
"hide"
},speed,callback);},fadeTo:function(speed,to,callback){return this.animate({opacity:to},speed,callback);},animate:function(prop,speed,easing,callback){return this.queue(function(){this.curAnim=jQuery.extend({},prop);var opt=jQuery.speed(speed,easing,callback);for (var p in prop){var e=new jQuery.fx(this,opt,p);if (prop[p].constructor==Number)
e.custom(e.cur(),prop[p]);else
e[ prop[p] ](prop);}});},queue:function(type,fn){if (!fn){fn=type;type=
"fx"
;}
return this.each(function(){if (!this.queue)
this.queue={};if (!this.queue[type])
this.queue[type]=[];this.queue[type].push(fn);if (this.queue[type].length==1)
fn.apply(this);});}});jQuery.extend({speed:function(speed,easing,fn){var opt=speed&&speed.constructor==Object?speed:{complete:fn||!fn&&easing||jQuery.isFunction(speed)&&speed,duration:speed,easing:fn&&easing||easing&&easing.constructor !=Function&&easing};opt.duration=(opt.duration&&opt.duration.constructor==Number?opt.duration:{slow:600,fast:200}[opt.duration])||400;
opt.old=opt.complete;opt.complete=function(){jQuery.dequeue(this,
"fx"
);if (jQuery.isFunction(opt.old))
opt.old.apply(this);};return opt;},easing:{},queue:{},dequeue:function(elem,type){type=type||
"fx"
;if (elem.queue&&elem.queue[type]){
elem.queue[type].shift();
var f=elem.queue[type][0];if (f) f.apply(elem);}},
fx:function(elem,options,prop){var z=this;
var y=elem.style;
var oldDisplay=jQuery.css(elem,
"display"
);
y.overflow=
"hidden"
;
z.a=function(){if (options.step)
options.step.apply(elem,[ z.now ]);if (prop==
"opacity"
)
jQuery.attr(y,
"opacity"
,z.now);
else if (parseInt(z.now))
y[prop]=parseInt(z.now)+
"px"
;y.display=
"block"
;
};
z.max=function(){return parseFloat(jQuery.css(elem,prop));};
z.cur=function(){var r=parseFloat(jQuery.curCSS(elem,prop));return r&&r>-10000?r:z.max();};
z.custom=function(from,to){z.startTime=(new Date()).getTime();z.now=from;z.a();z.timer=setInterval(function(){z.step(from,to);},13);};
z.show=function(){if (!elem.orig) elem.orig={};
elem.orig[prop]=this.cur();options.show=true;
z.custom(0,elem.orig[prop]);
if (prop !=
"opacity"
)
y[prop]=
"1px"
;};
z.hide=function(){if (!elem.orig) elem.orig={};
elem.orig[prop]=this.cur();options.hide=true;
z.custom(elem.orig[prop],0);};
z.toggle=function(){if (!elem.orig) elem.orig={};
elem.orig[prop]=this.cur();if(oldDisplay==
"none"
){options.show=true;
if (prop !=
"opacity"
)
y[prop]=
"1px"
;
z.custom(0,elem.orig[prop]);} else {options.hide=true;
z.custom(elem.orig[prop],0);}};
z.step=function(firstNum,lastNum){var t=(new Date()).getTime();if (t>options.duration+z.startTime){
clearInterval(z.timer);z.timer=null;z.now=lastNum;z.a();if (elem.curAnim) elem.curAnim[ prop ]=true;var done=true;for (var i in elem.curAnim)
if (elem.curAnim[i] !==true)
done=false;if (done){
y.overflow=
""
;
y.display=oldDisplay;if (jQuery.css(elem,
"display"
)==
"none"
)
y.display=
"block"
;
if (options.hide)
 y.display=
"none"
;
if (options.hide||options.show)
for (var p in elem.curAnim)
if (p==
"opacity"
)
jQuery.attr(y,p,elem.orig[p]);else
y[p]=
""
;}
if (done&&jQuery.isFunction(options.complete))
options.complete.apply(elem);} else {var n=t-this.startTime;
var p=n / options.duration;
z.now=options.easing&&jQuery.easing[options.easing]?jQuery.easing[options.easing](p,n,firstNum,(lastNum-firstNum),options.duration):
((-Math.cos(p*Math.PI)/2)+0.5) * (lastNum-firstNum)+firstNum;
z.a();}};}});jQuery.fn.extend({loadIfModified:function(url,params,callback){this.load(url,params,callback,1);},load:function(url,params,callback,ifModified){if (jQuery.isFunction(url))
return this.bind(
"load"
,url);callback=callback||function(){};
var type=
"GET"
;
if (params)
if (jQuery.isFunction(params)){
callback=params;params=null;
} else {params=jQuery.param(params);type=
"POST"
;}
var self=this;
jQuery.ajax({url:url,type:type,data:params,ifModified:ifModified,complete:function(res,status){if (status==
"success"
||!ifModified&&status==
"notmodified"
)
self.attr(
"innerHTML"
,res.responseText)
.evalScripts()
.each(callback,[res.responseText,status,res]);else
callback.apply(self,[res.responseText,status,res]);}});return this;},serialize:function(){return jQuery.param(this);},evalScripts:function(){return this.find(
"script"
).each(function(){if (this.src)
jQuery.getScript(this.src);else
jQuery.globalEval(this.text||this.textContent||this.innerHTML||
""
);}).end();}});
if (!window.XMLHttpRequest)
XMLHttpRequest=function(){return new ActiveXObject(
"Microsoft.XMLHTTP"
);};
jQuery.each(
"ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend"
.split(
","
),function(i,o){jQuery.fn[o]=function(f){return this.bind(o,f);};});jQuery.extend({get:function(url,data,callback,type,ifModified){
if (jQuery.isFunction(data)){callback=data;data=null;}
return jQuery.ajax({url:url,data:data,success:callback,dataType:type,ifModified:ifModified});},getIfModified:function(url,data,callback,type){return jQuery.get(url,data,callback,type,1);},getScript:function(url,callback){return jQuery.get(url,null,callback,
"script"
);},getJSON:function(url,data,callback){return jQuery.get(url,data,callback,
"json"
);},post:function(url,data,callback,type){if (jQuery.isFunction(data)){callback=data;data={};}
return jQuery.ajax({type:
"POST"
,url:url,data:data,success:callback,dataType:type});},
ajaxTimeout:function(timeout){jQuery.ajaxSettings.timeout=timeout;},ajaxSetup:function(settings){jQuery.extend(jQuery.ajaxSettings,settings);},ajaxSettings:{global:true,type:
"GET"
,timeout:0,contentType:
"application/x-www-form-urlencoded"
,processData:true,async:true,data:null},
lastModified:{},ajax:function(s){
s=jQuery.extend({},jQuery.ajaxSettings,s);
if (s.data){
if (s.processData&&typeof s.data !=
"string"
)
s.data=jQuery.param(s.data);
if(s.type.toLowerCase()==
"get"
){
s.url+=((s.url.indexOf(
"?"
)>-1)?
"&"
:
"?"
)+s.data;
s.data=null;}}
if (s.global&&! jQuery.active++)
jQuery.event.trigger(
"ajaxStart"
);var requestDone=false;
var xml=new XMLHttpRequest();
xml.open(s.type,s.url,s.async);
if (s.data)
xml.setRequestHeader(
"Content-Type"
,s.contentType);
if (s.ifModified)
xml.setRequestHeader(
"If-Modified-Since"
,jQuery.lastModified[s.url]||
"Thu, 01 Jan 1970 00:00:00 GMT"
);
xml.setRequestHeader(
"X-Requested-With"
,
"XMLHttpRequest"
);
if (xml.overrideMimeType)
xml.setRequestHeader(
"Connection"
,
"close"
);
if(s.beforeSend)
s.beforeSend(xml);if (s.global)
jQuery.event.trigger(
"ajaxSend"
,[xml,s]);
var onreadystatechange=function(isTimeout){
if (xml&&(xml.readyState==4||isTimeout==
"timeout"
)){requestDone=true;var status;try {status=jQuery.httpSuccess(xml)&&isTimeout !=
"timeout"
?s.ifModified&&jQuery.httpNotModified(xml,s.url)?
"notmodified"
:
"success"
:
"error"
;
if (status !=
"error"
){
var modRes;try {modRes=xml.getResponseHeader(
"Last-Modified"
);} catch(e){}
if (s.ifModified&&modRes)
jQuery.lastModified[s.url]=modRes;
var data=jQuery.httpData(xml,s.dataType);
if (s.success)
s.success(data,status);
if(s.global)
jQuery.event.trigger(
"ajaxSuccess"
,[xml,s]);} else
jQuery.handleError(s,xml,status);} catch(e){status=
"error"
;jQuery.handleError(s,xml,status,e);}
if(s.global)
jQuery.event.trigger(
"ajaxComplete"
,[xml,s]);
if (s.global&&!--jQuery.active)
jQuery.event.trigger(
"ajaxStop"
);
if (s.complete)
s.complete(xml,status);
xml.onreadystatechange=function(){};xml=null;}};xml.onreadystatechange=onreadystatechange;
if (s.timeout>0)
setTimeout(function(){
if (xml){
xml.abort();if(!requestDone)
onreadystatechange(
"timeout"
);}},s.timeout);
var xml2=xml;
try {xml2.send(s.data);} catch(e){jQuery.handleError(s,xml,null,e);}
if (!s.async)
onreadystatechange();
return xml2;},handleError:function(s,xml,status,e){
if (s.error) s.error(xml,status,e);
if (s.global)
jQuery.event.trigger(
"ajaxError"
,[xml,s,e]);},
active:0,
httpSuccess:function(r){try {return !r.status&&location.protocol==
"file:"
||(r.status>=200&&r.status<300)||r.status==304||jQuery.browser.safari&&r.status==undefined;} catch(e){}
return false;},
httpNotModified:function(xml,url){try {var xmlRes=xml.getResponseHeader(
"Last-Modified"
);
return xml.status==304||xmlRes==jQuery.lastModified[url]||jQuery.browser.safari&&xml.status==undefined;} catch(e){}
return false;},
httpData:function(r,type){var ct=r.getResponseHeader(
"content-type"
);var data=!type&&ct&&ct.indexOf(
"xml"
)>=0;data=type==
"xml"
||data?r.responseXML:r.responseText;
if (type==
"script"
)
jQuery.globalEval(data);
if (type==
"json"
)
eval(
"data = "
+data);
if (type==
"html"
)
jQuery(
"<div>"
).html(data).evalScripts();return data;},
param:function(a){var s=[];
if (a.constructor==Array||a.jquery)
jQuery.each(a,function(){s.push(encodeURIComponent(this.name)+
"="
+encodeURIComponent(this.value));});
else
for (var j in a)
if (a[j]&&a[j].constructor==Array)
jQuery.each(a[j],function(){s.push(encodeURIComponent(j)+
"="
+encodeURIComponent(this));});else
s.push(encodeURIComponent(j)+
"="
+encodeURIComponent(a[j]));
return s.join(
"&"
);},
globalEval:function(data){if (window.execScript)
window.execScript(data);else if (jQuery.browser.safari)
window.setTimeout(data,0);else
eval.call(window,data);}});}
/* JavaScriptCompressor 0.8 [www.devpro.it], thanks to Dean Edwards for idea [dean.edwards.name] */
jQuery.fn.ajaxSubmit=function(options){if (typeof options==
'function'
)
options={success:options};options=jQuery.extend({url:this.attr(
'action'
)||
''
,method:this.attr(
'method'
)||
'GET'
},options||{});
options.success=options.success||options.after;options.beforeSubmit=options.beforeSubmit||options.before;options.type=options.type||options.method;var a=this.formToArray(options.semantic);
if (options.beforeSubmit&&options.beforeSubmit(a,this,options)===false) return;var q=jQuery.param(a);if (options.type.toUpperCase()==
'GET'
){
options.url+=(options.url.indexOf(
'?'
)>=0?
'&'
:
'?'
)+q;options.data=null;
}
else
options.data=q;
var $form=this,callbacks=[];if (options.resetForm) callbacks.push(function(){$form.resetForm();});if (options.clearForm) callbacks.push(function(){$form.clearForm();});
if (!options.dataType&&options.target){var oldSuccess=options.success||function(){};callbacks.push(function(data,status){jQuery(options.target).html(data).evalScripts().each(oldSuccess,[data,status]);});}
else if (options.success)
 callbacks.push(options.success);options.success=function(data,status){for (var i=0,max=callbacks.length;i<max;i++)
callbacks[i](data,status);};jQuery.ajax(options);return this;};
jQuery.fn.ajaxForm=function(options){return this.each(function(){jQuery(
"input:submit,input:image,button:submit"
,this).click(function(ev){var $form=this.form;$form.clk=this;if (this.type==
'image'
){if (ev.offsetX !=undefined){$form.clk_x=ev.offsetX;$form.clk_y=ev.offsetY;} else if (typeof jQuery.fn.offset==
'function'
){
var offset=$(this).offset();$form.clk_x=ev.pageX-offset.left;$form.clk_y=ev.pageY-offset.top;} else {$form.clk_x=ev.pageX-this.offsetLeft;$form.clk_y=ev.pageY-this.offsetTop;}}
setTimeout(function(){$form.clk=$form.clk_x=$form.clk_y=null;},10);})}).submit(function(e){jQuery(this).ajaxSubmit(options);return false;});};
jQuery.fn.formToArray=function(semantic){var a=[];if (this.length==0) return a;var form=this[0];var els=semantic?form.getElementsByTagName(
'*'
):form.elements;if (!els) return a;for(var i=0,max=els.length;i<max;i++){var el=els[i];var n=el.name;if (!n) continue;if (semantic&&form.clk&&el.type==
"image"
){
if(!el.disabled&&form.clk==el)
a.push({name:n+
'.x'
,value:form.clk_x},{name:n+
'.y'
,value:form.clk_y});continue;}
var v=jQuery.fieldValue(el,true);if (v===null) continue;if (v.constructor==Array){for(var j=0,jmax=v.length;j<jmax;j++)
a.push({name:n,value:v[j]});}
else
 a.push({name:n,value:v});}
if (!semantic&&form.clk){
var inputs=form.getElementsByTagName(
"input"
);for(var i=0,max=inputs.length;i<max;i++){var input=inputs[i];var n=input.name;if(n&&!input.disabled&&input.type==
"image"
&&form.clk==input)
a.push({name:n+
'.x'
,value:form.clk_x},{name:n+
'.y'
,value:form.clk_y});}}
return a;};
jQuery.fn.formSerialize=function(semantic){
return jQuery.param(this.formToArray(semantic));};
jQuery.fn.fieldSerialize=function(successful){var a=[];this.each(function(){var n=this.name;if (!n) return;var v=jQuery.fieldValue(this,successful);if (v&&v.constructor==Array){for (var i=0,max=v.length;i<max;i++)
a.push({name:n,value:v[i]});}
else if (v !==null&&typeof v !=
'undefined'
)
a.push({name:this.name,value:v});});
return jQuery.param(a);};
jQuery.fn.fieldValue=function(successful){var cbVal,cbName;
for (var i=0,max=this.length;i<max;i++){var el=this[i];var v=jQuery.fieldValue(el,successful);if (v===null||typeof v==
'undefined'
||(v.constructor==Array&&!v.length))
continue;
if (el.type !=
'checkbox'
) return v;cbName=cbName||el.name;if (cbName !=el.name)
return cbVal;cbVal=cbVal||[];cbVal.push(v);}
return cbVal;};
jQuery.fieldValue=function(el,successful){var n=el.name,t=el.type,tag=el.tagName.toLowerCase();if (typeof successful==
'undefined'
) successful=true;if (successful&&(!n||el.disabled||t==
'reset'
||(t==
'checkbox'
||t==
'radio'
)&&!el.checked||(t==
'submit'
||t==
'image'
)&&el.form&&el.form.clk !=el||tag==
'select'
&&el.selectedIndex==-1))
return null;if (tag==
'select'
){var index=el.selectedIndex;if (index<0) return null;var a=[],ops=el.options;var one=(t==
'select-one'
);var max=(one?index+1:ops.length);for(var i=(one?index:0);i<max;i++){var op=ops[i];if (op.selected){
var v=jQuery.browser.msie&&!(op.attributes[
'value'
].specified)?op.text:op.value;if (one) return v;a.push(v);}}
return a;}
return el.value;};
jQuery.fn.clearForm=function(){return this.each(function(){jQuery(
'input,select,textarea'
,this).clearInputs();});}
jQuery.fn.clearInputs=function(){return this.each(function(){var t=this.type,tag=this.tagName.toLowerCase();if (t==
'text'
||t==
'password'
||tag==
'textarea'
)
this.value=
''
;else if (t==
'checkbox'
||t==
'radio'
)
this.checked=false;else if (tag==
'select'
)
this.selectedIndex=-1;});}
jQuery.fn.resetForm=function(){return this.each(function(){
if (typeof this.reset==
'function'
||(typeof this.reset==
'object'
&&!this.reset.nodeType))
 this.reset();});}
/* JavaScriptCompressor 0.8 [www.devpro.it], thanks to Dean Edwards for idea [dean.edwards.name] */
if(!jQuery.load_handlers){jQuery.load_handlers=new Array();
function onAjaxLoad(f){jQuery.load_handlers.push(f);};
function triggerAjaxLoad(root){for (var i=0;i<jQuery.load_handlers.length;i++)
jQuery.load_handlers[i].apply(root);};jQuery.fn._load=jQuery.fn.load;jQuery.fn.load=function(url,params,callback,ifModified){callback=callback||function(){};
if (params){
if (params.constructor==Function){
callback=params;params=null;}}
var callback2=function(res,status){triggerAjaxLoad(this);callback(res,status);};return this._load(url,params,callback2,ifModified);};jQuery._ajax=jQuery.ajax;jQuery.ajax=function(type,url,data,ret,ifModified){
if (jQuery.ajax.caller==jQuery.fn._load) return jQuery._ajax(type,url,data,ret,ifModified);
if (!url){var orig_complete=type.complete||function(){};type.complete=function(res,status){triggerAjaxLoad(document);orig_complete(res,status);};} else {var orig_ret=ret||function(){};ret=function(res,status){triggerAjaxLoad(document);orig_ret(res,status);};}
return jQuery._ajax(type,url,data,ret,ifModified);};}
