// Placez le nombre de flocons de neige (plus de 30 - 40 non recommandés)
var snowmax=35;
// Placez les couleurs pour la neige. Ajoutez autant de couleurs comme vous voudrez
var snowcolor=new Array("#fff","#ddddFF","#ccccDD");
// Placez les polices, celle créent les flocons de neige. Ajoutez autant de polices comme vous voudrez
var snowtype=new Array("Arial Black","Arial Narrow","Times","Comic Sans MS");
// Placez la lettre qui crée votre flocon de neige (recommandé: *)
var snowletter="*";
// Placez la vitesse de la descente (gamme recommandée de valeurs de 0,3 à 2)
var sinkspeed=2;
// Placez la maximal-taille de vos snowflaxes
var snowmaxsize=30;
// Placez la minimal-taille de vos snowflaxes
var snowminsize=10;
// Placez la neiger-zone
// Placez 1 pour tout-au-dessus-neiger, placez 2 pour la gauche-côté-chute de neige
// L'ensemble 3 pour centre-neiger, a placé 4 pour la droit-côté-chute de neige
var snowingzone=1;
///////////////////////////////////////////////////////////////////////////
// LA CONFIGURATION FINIT ICI
///////////////////////////////////////////////////////////////////////////
// N'éditez pas au-dessous de cette ligne
var snow=new Array();
var marginbottom;
var marginright;
var timer;
var i_snow=0;
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent;
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/);
var ns6=document.getElementById&&!document.all;
var opera=browserinfos.match(/Opera/) ;
var browserok=ie5||ns6||opera;
function randommaker(range) {
rand=Math.floor(range*Math.random());
return rand;
}
function initsnow() {
if (ie5 || opera) {
marginbottom = document.body.clientHeight;
marginright = document.body.clientWidth;
}
else if (ns6) {
marginbottom = window.innerHeight;
marginright = window.innerWidth;
}
var snowsizerange=snowmaxsize-snowminsize
for (i=0;i<=snowmax;i++) {
crds[i] = 0;
lftrght[i] = Math.random()*15;
x_mv[i] = 0.03 + Math.random()/10;
snow[i]=document.getElementById("s"+i);
snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)];
snow[i].size=randommaker(snowsizerange)+snowminsize;
snow[i].style.fontSize=snow[i].size;
snow[i].style.color=snowcolor[randommaker(snowcolor.length)];
snow[i].sink=sinkspeed*snow[i].size/5;
if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size);}
if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size);}
if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4;}
if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2;}
snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size);
snow[i].style.left=snow[i].posx;
snow[i].style.top=snow[i].posy;
}
movesnow();
}
function movesnow() {
var i=0;
for (i=0;i<=snowmax;i++) {
crds[i] += x_mv[i];
snow[i].posy+=snow[i].sink;
snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+'px';
snow[i].style.top=snow[i].posy+'px';
if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size);}
if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size);}
if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4;}
if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2;}
snow[i].posy=0;
}
}
var timer=setTimeout("movesnow()",50);
}
for (i=0;i<=snowmax;i++) {
document.write("<span id='s"+i+"' style='position:absolute;top:-"+snowmaxsize+"'>"+snowletter+"</span>");
}
if (browserok) {
window.onload=initsnow;
}
