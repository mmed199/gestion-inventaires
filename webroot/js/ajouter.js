var temp = 0 ;

// code postal 
function updateType(categorie){
	$.ajax({
		url:'/types/getTypesCategorie/'+categorie,
		dataType:'json',
		success: function(data) {
			    //$('.result').html(data);	
				$('#ProduitTypeId').children().remove();
				$('#ProduitTypeId').append('<option value="" selected="selected" >Choisir</option>');
					for(index in data ) { 
						//if( i == 0 ) 
						 
						//else 					
							$('#ProduitTypeId').append('<option value="'+index+'" >'+data[index]+'</option>');
					} ;
			   // alert('Load was performed.');
	    	}
	}) ;    
}

$(document).ready(function(){
	$('#ProduitCategoryId').keyup(function (){
		categorie = $(this).val() ;
		alert (categorie);
		if( categorie.length > 3 ) {
			updateType( categorie ) ;
		}
	}); 
}) ;

