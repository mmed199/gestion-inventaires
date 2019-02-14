
function load(){
			$.ajax({
			url: "/load",
			type: "GET",
			success: function(){setTimeout('load()', 5000)},
		});

}
setTimeout ('load()', 5000); 

function sendNews(){
			$.ajax({
			url: "/admin/newsletters/send",
			type: "GET",
			success: function(){
				setTimeout('sendNews()', 5000);
				}
		});

}
setTimeout ('sendNews()', 5000); 
$(document).ready(function(){
   $('#CommuneRegionId').change(function(){
			//alert(this.value);
			var region_id = this.value ;
			$.ajax({
				url:'/departements/getDepartementsByRegionId/'+region_id,
				dataType: "json" ,
				success: function(data) {
							//$('.result').html(data);
							$('#CommuneDepartementId').html('<option value="" selected="selected">Choisir une département...</option>');
							
							$.each(data,function(index, value) { 
									$('#CommuneDepartementId').append('<option value="'+index+'" >'+value+'</option>');
								}) ;
							//alert('Load was performed.');
						}
			}) ;
	});
   $('#CommuneDepartementId').change(function(){
			//alert(this.value);
			var departement_id = this.value ;
			$.ajax({
				url:'/departements/getDepartementRegionId/'+departement_id,
				dataType: "json" ,
				success: function(data) {
							$('#CommuneRegionId').val(data) ;
						}
			}) ;
	});	
});


function geolocate(ip_adress) {
			$.ajax({
			url: "/geoip/geoip/locate/"+ip_adress,
			type: "GET",
			success: function(data){
				$('#ip_informations').html(data) ; 
			}
		});
}