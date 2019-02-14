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

$(document).ready(function() {
	$('.jqzoom').jqzoom({
		zoomType: 'standard',
		lens:true,
		preloadImages: false,
		alwaysOn:false
	});
	
	$('#choix_1').click(function(){
		var val = $('#choix_1').attr('value');
		//alert (val);
		if ( val == 1 ){//selected
			$('#choix_1').attr('value',"0");
			$('#choix_1').removeClass('selected');
		}else{
			$('#choix_1').attr('value',"1");
			$('#choix_2').attr('value',"0");
			$('#choix_2').removeClass('selected');
			$('#choix_1').addClass('selected');
		}
	}); 
	
	$('#choix_2').click(function(){
		var val = $('#choix_2').attr('value');
		//alert (val);
		if ( val == 1 ){//selected
			$('#choix_2').attr('value',"0");
			$('#choix_2').removeClass('selected');
		}else{
			$('#choix_2').attr('value',"1");
			$('#choix_1').attr('value',"0");
			$('#choix_1').removeClass('selected');
			$('#choix_2').addClass('selected');
		}
	});
	
	
	//update_panier() ;  
	$(".btn-ajout").click(function() {
		var choix_option = 0;
		var mention_1 = "" ;
		var mention_2 = "" ;
		if ($("input[name=is_personalizable]").val() ){
			mention_1 = $('#OrderrowLigne1').val() ;
			mention_2 = $('#OrderrowLigne2').val() ;
			if ($('#choix_2').attr('value') == 1 )
				choix_option = 1;
			if ($('#choix_1').attr('value') == 1 )
				choix_option = 2;
			if (choix_option == 1 &&  mention_1 == ""){
				alert ("Veuillez saisir le nom à graver sur le bijou."); 
				return false;
			}
		}
		var taille_id = 0 ;
		var couleur_id = 0;
			
		var productIDValSplitter 	= (this.id).split("_");
		var productIDVal 			= productIDValSplitter[1];
		
		var productX 		= $("#productImageWrapID_" + productIDVal).offset().left;
		var productY 		= $("#productImageWrapID_" + productIDVal).offset().top;
		var basketX 		= $("#panier-top").offset().left;
		var basketY 		= $("#panier-top").offset().top;
		var gotoX 			= basketX - productX;
		var gotoY 			= basketY - productY;
		
		var newImageWidth 	= $("#productImageWrapID_" + productIDVal).width() / 3;
		var newImageHeight	= $("#productImageWrapID_" + productIDVal).height() / 3;
		
		$("#productImageWrapID_" + productIDVal)
		.clone()
		.prependTo("#productImageWrapID_" + productIDVal)
		.css({'position' : 'absolute'})
		.animate({opacity: 0.4}, 100 )
		.animate({opacity: 0.1, marginLeft: gotoX, marginTop: gotoY, width: newImageWidth, height: newImageHeight}, 1200, function() {
																																																																										  			$(this).remove();
		
		taille_id = $("input[name=tailleProd]:checked").val() ;
		couleur_id = $("#couleurProd").val() ;
		if (couleur_id == "")
			couleur_id = $('select[name=couleurProd]:selected').val(); 
		
		if (taille_id == "")
			taille_id = 0;
		if (couleur_id == "")
			couleur_id = 0;	
			
		
			qtte = $("input[name=quantite]").val() ;
			$("#notificationsLoader").html('<img src="/img/progress.gif">');
			
			$.ajax({  
				type: "POST",  
				url: "/paniers/add",  
				data: { 
						"data[Produit][id]": productIDVal,
						"data[Produit][taille_id]": taille_id,
						"data[Produit][couleur_id]": couleur_id,						
						"data[Produit][qtte]": qtte,
						"data[Produit][choix_option]":choix_option,
						"data[Produit][mention_1]":mention_1,
						"data[Produit][mention_2]":mention_2
						
					},  
				success: function(theResponse) {
					if (theResponse == "ok"){
						update_panier() ;
						$("#panier-popup-message").html ('<b><span style="font-size:12px;color: #E02466;font-weight: bold;">L\'article a été ajouté à votre panier</span>.</b><br/>');
					}else{
						if (theResponse == "1"){
							$("#panier-popup-message").html ('<b><span style="font-size:12px;color: red;font-weight: bold;">La quantité demandée n\'est pas disponible en stock.</span></b><br/>' );
							
						}else{
							$("#panier-popup-message").html ('<b><span style="font-size:12px;color: red;font-weight: bold;">Une erreur a été rencontrée lors de l\'ajout au panier.\n' + theResponse + '</span></b><br/>' );
						}
					}				
					if( $("#productID_" + productIDVal).length > 0){
						$("#productID_" + productIDVal).animate({ opacity: 0 }, 500);
						$("#productID_" + productIDVal).before(theResponse).remove();
						$("#productID_" + productIDVal).animate({ opacity: 0 }, 500);
						$("#productID_" + productIDVal).animate({ opacity: 1 }, 500);
						$("#notificationsLoader").empty();
						
						
					} else {
						$("#basketItemsWrap li:first").before(theResponse);
						$("#basketItemsWrap li:first").hide();
						$("#basketItemsWrap li:first").show("slow");  
						$("#notificationsLoader").empty();			
					}
					$('#modal').reveal({ // The item which will be opened with reveal
						animation: 'fade',                   // fade, fadeAndPop, none
						animationspeed: 600,                       // how fast animtions are
						closeonbackgroundclick: true,              // if you click background will modal close?
						dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
					});
				}  
			});  
		
		});
		return false;
	});
	
	
	
	$("#basketItemsWrap .produit_delete").live("click", function(event) { 
		var productIDValSplitter 	= (this.id).split("_");
		var productIDVal 			= productIDValSplitter[1];	

		$("#notificationsLoader").html('<img src="/img/loader.gif">');
	
		$.ajax({  
			type: "POST",  
			url: "/orders/dropFromBasket",  
			data: { "data[Produit][id]": productIDVal, action: "deleteFromBasket"},  
			success: function(theResponse) {
				
				$("#productID_" + productIDVal).hide("slow",  function() {$(this).remove();});
				$("#notificationsLoader").empty();
				if( $("#basketWrap li").size() == 2 ){
						$("#panierVide").show();
				        $("#validerMaCommande").hide();
				}
			
			}  
		});  
		
	});
}); 


function dialogPanier(titre_fenetre,afficher_btn) {
	       
		    //$("#dialogPanier").html(strHtml);
		  
		if (afficher_btn){
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
		}else{
			$("#dialogPanier").dialog({ 
					autoOpen: false ,
					title: titre_fenetre,
					height: 200,
					width: 500,
					modal: true,
					buttons: {},
					close: function() {
					}
			}) ;
		
		}
								
		$("#dialogPanier").dialog('open');
}

	
function update_panier(){
	/*
		session = $("#session").val() ;
		$("#notificationsLoader").html('<img src="/img/progress.gif">');
		$.ajax({  
				url: "http://www.kidsdressing.com/paniers/update/" + session,   
				dataType: 'text',
				xhrFields: {
					  withCredentials: true
				},
				success: function(data) {
						$("#panier").empty();
						$('#panier').html(data) ;
						//$('#panier_count').html(data.nbr_articles) ;
						//$('#panier_amount').html(data.montant) ;
						$("#notificationsLoader").empty();
						$("#test").html(session);
						
				}
		}) ;
	*/
	$("#notificationsLoader").html('<img src="/img/progress.gif">');
	$('#panier_count').html(parseFloat($('#panier_count').text()) + parseFloat($("input[name=quantite]").val()) ) ;
	$('#panier_amount').html(parseFloat($('#panier_amount').text()) + parseFloat($('#prix').text()) ) ;
	
	$("#notificationsLoader").empty();
}
