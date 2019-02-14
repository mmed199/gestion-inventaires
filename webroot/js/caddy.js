var test = 'caddy_header';

function showForm(){
	test = 'caddy_header';
	var Obj;
	Obj = document.getElementById('caddy_form');
	if(Obj){
		with(Obj.style){
			display="block";
			left = "0px";
			top  = "0px";
			zIndex= 1000;
		}
		window.scroll(0,0);
	}
}

function hideForm()
{
	var Obj;
	Obj = document.getElementById('caddy_form');
	if(Obj){
		Obj.style.display = "none";
	}
}

function showItem()
{
	showForm();
	loadData('caddy', 'caddy_content', 'action=show');
	loadData('caddy', 'panier_count', 'action=count');	
}

function add( nom ) {
	document.getElementById( nom ).value ++;
}
function substract( nom ) {
	if (document.getElementById( nom ).value >1)
		document.getElementById( nom ).value --;
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

	return true;
}

function addItem(intId)
{
	inNbre = document.getElementById( 'quantite' ).value
	intCouleur = null;
	intTaille = null;
	for( var i=0; i<$('input[name=couleurProd]:radio').length; i++)
	{
	  if($('input[name=couleurProd]:radio')[i].checked){
		  intCouleur=$('input[name=couleurProd]:radio')[i].value;
		  break;
	  }
	  else 
		intCouleur = null;
	}
	if (intCouleur == null)
		intCouleur=getSelectValue('couleurProd');;
	
	for( i=0; i<=$('input[name=tailleProd]:radio').length; i++)
	{
	  if($('input[name=tailleProd]:radio')[i].checked){
		  intTaille=$('input[name=tailleProd]:radio')[i].value;
		  break;
	  }
	  else intTaille = null;
	}
	if(intCouleur != null && intTaille != null)
	{
		addItemCaddy('caddy', 'dialogPanier', 'action=add&id='+encodeURIComponent(intId)+'&couleur='+encodeURIComponent(intCouleur)+'&taille='+encodeURIComponent(intTaille)+'&quantity='+inNbre);
		loadData('caddy', 'panier_count', 'action=count');
		loadData('caddy', 'panier_amount', 'action=amount');
		dialogPanier("Mon Panier") ;
		//document.getElementById('item-added').innerHTML = "L'article a &eacute;t&eacute; ajout&eacute; &agrave; votre panier<br /><a href='/panier.html'>Mon panier</a>";
	}
	else
	{
		//alert ("test");
		document.getElementById('item-added').innerHTML = "Vous devez s&eacute;lectionner une couleur et une taille";
	}
}

/*
<script language="javascript">

function donneavis(val)
{
var i;
for (i=0;i<val;i++)
{
if ((document.forms[0].elements[i].checked==true)
{
return true;
}
}
alert('donner votre avis');
return false;
}

</script>
*/

function incItem(intId)
{
	loadData('caddy', 'caddy_content', 'action=inc&id='+encodeURIComponent(intId));
	loadData('caddy', 'panier_count', 'action=count');
	loadData('caddy', 'panier_amount', 'action=amount');
}

function decItem(intId)
{
	loadData('caddy', 'caddy_content', 'action=dec&id='+encodeURIComponent(intId));
	loadData('caddy', 'panier_count', 'action=count');
	loadData('caddy', 'panier_amount', 'action=amount');
}

function delItem(intId)
{
	loadData('caddy', 'caddy_content', 'action=del&id='+encodeURIComponent(intId));
	loadData('caddy', 'panier_count', 'action=count');
	loadData('caddy', 'panier_amount', 'action=amount');
}

function showNewsletterForm()
{
	var Obj;
	Obj = document.getElementById('newsletter_form');
	if(Obj){
		with(Obj.style){
			display="block";
			left = "0px";
			top  = "0px";
			zIndex= 10;
		}
		window.scroll(0,0);
	}
}
function hideNewsletterForm()
{
	var Obj;
	Obj = document.getElementById('newsletter_form');
	if(Obj){
		Obj.style.display = "none";
	}
}

/**Retourne la valeur du select selectId*/
function getSelectValue(selectId)
{
	/**On récupère l'élement html <select>*/
	var selectElmt = document.getElementById(selectId);
	/**
	selectElmt.options correspond au tableau des balises <option> du select
	selectElmt.selectedIndex correspond à l'index du tableau options qui est actuellement sélectionné
	*/
	return selectElmt.options[selectElmt.selectedIndex].value;
}