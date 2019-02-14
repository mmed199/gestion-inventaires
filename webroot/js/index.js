
function dialogPanier(titre_fenetre) {
	   
		//$("#dialogPanier").html(strHtml);
	   $("#dialogPanier").dialog({ 
									autoOpen: false ,
									title: titre_fenetre,
									height: 300,
									width: 500,
									modal: true,
									buttons: {
										"Valider ma commande": function() {
											window.location = "/panier.html";
										},
										"Poursuivre mes achats": function() {
											$( this ).dialog( "close" );
										
										}
									},
									close: function() {
									}
							}) ;
	$("#dialogPanier").dialog('open');
}
	
	

function hideIndex()
{
	var Obj;
	Obj = document.getElementById('index');
	if(Obj){
		Obj.style.display = "none";
	}
}


