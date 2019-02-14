$(document).ready(function() {
	$('#OrderAdresseLivraisonId').change(function (){
		adresse_id = $(this).val() ;
		$.ajax({
			url:'/member/adresses/getAdresse/'+adresse_id, 
			success:function(data){
					$('#adresseLivraison').html(data) ; 
			   }, 
		}) ;
	}) ;
	$('#OrderAdresseFacturationId').change(function (){
		adresse_id = $(this).val() ;
		$.ajax({
			url:'/member/adresses/getAdresse/'+adresse_id, 
			success:function(data){
					$('#adresseFacturation').html(data) ; 
			   }, 
		}) ;
	}) ;
}) ; 