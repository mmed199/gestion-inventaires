// flash popup

$(function(){

    if($("#flashMessage").html() != null){

        $(".popup").fadeIn();

    }

});


function closepopup(){

    $(".popup").fadeOut();

}
$(document).ready(function() {
			$.featureList(
				$("#tabs li a"),
				$("#output li"), {
					start_item : 1
				}
			);
});
jQuery(function($){
	/* $('.bar2').mosaic({
		animation	:	'slide'
	}); */
});

                function today() { $("#datepicker").value='03/11/2010'; }

        		function tomorrow(){ $("#datepicker").value='04/11/2010';    }

				jQuery(function($){

					$.datepicker.regional['fr'] = {

						closeText: 'Fermer',

						prevText: '&#x3c;Préc',

						nextText: 'Suiv&#x3e;',

						currentText: 'Courant',

						monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',

						'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],

						monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',

						'Jul','Aoû','Sep','Oct','Nov','Déc'],

						dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],

						dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],

						dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],

						weekHeader: 'Sm',

						dateFormat: 'dd/mm/yy',

						firstDay: 1,

						isRTL: false,

						showMonthAfterYear: false,

						yearSuffix: ''};

					$.datepicker.setDefaults($.datepicker.regional['fr']);

				});



				function popup(mylink, windowname)

  				{

    				if (! window.focus)return true;

    				var href;

    				if (typeof(mylink) == 'string')

      					href=mylink;

    				else

       					href=mylink.href;

    				window.open(href, windowname, 'width=800,height=768,scrollbars=yes');

    				return false;

  				}

				function afficherdatetoday() {

					var date =document.getElementById('commanderForm').today.value;

					document.getElementById('commanderForm').datepicker.value=date;

				}

				function afficherdatetomorrow() {

					var date =document.getElementById('commanderForm').tomorrow.value;

					document.getElementById('commanderForm').datepicker.value=date; 

				}

				function clickEP(t) {

					if(document.getElementById('exPCH'+t).checked==true)

					{

						document.getElementById('exPCH'+t).checked=false;

					}

					else

					{

						document.getElementById('exPCH'+t).checked=true;

					}

				}

  function displaySelection(elm){

				  out = document.getElementsByName("data[Order][message]")[0];

				  out.value=elm.value;

				}

			  $(document).ready(function() {

				

					$("#pp").click(function () {$("#pm_cc").hide("blind", 400);});

					$("#pp").click(function () {$("#pm_ve").hide("blind", 400);});

					$("#pp").click(function () {$("#pm_pp").show("blind", 400);});

					$("#pp").click(function () {$("#pm_pl").show("blind", 400);});

					

					$("#pc").click(function () {$("#pm_cc").show("blind", 400);});

					$("#pc").click(function () {$("#pm_pl").show("blind", 400);});

					$("#pc").click(function () {$("#pm_pp").hide("blind", 400);});

					$("#pc").click(function () {$("#pm_ve").hide("blind", 400);});

					

					$("#pv").click(function () {$("#pm_ve").show("blind", 400);});

					$("#pv").click(function () {$("#pm_pl").show("blind", 400);});

					$("#pv").click(function () {$("#pm_pp").hide("blind", 400);});

					$("#pv").click(function () {$("#pm_cc").hide("blind", 400);});

					

			

			  });

			  

			$(document).ready(function() {

			           	$("#datepicker").datepicker();

						//$("a#image").fancybox();

						$("#tabs").tabs();

			});

// la page commander 

$(function(){ 

		//$("#commanderForm").formwizard(	);

		$("#commanderForm").bind("step_shown", function(event, data){

		           if(!(data.isBackNavigation)){

						if(!Validerd()) $("#commanderForm").formwizard("back");  

						else notifyDeliveryCities() ;

						}

	           });

   });


//search form 
$(document).ready(function(){
   $('#ProduitCategoryId').change(function(){
			//alert(this.value);
			var category_id = this.value ;
			$.ajax({
				url:'/types/getTypesByCategoryId/'+category_id,
				dataType: "json" ,
				success: function(data) {
							//alert('loader');
							$('#ProduitTypeId').html('<option value="" selected="selected">Choisir ...</option>');
							
							$.each(data,function(index, value) { 
									$('#ProduitTypeId').append('<option value="'+index+'" >'+value+'</option>');
								}) ;
							//alert('Load was performed.');
						}
			}) ;
			$.ajax({
				url:'/tailles/getTaillesByCategoryId/'+category_id,
				dataType: "json" ,
				success: function(data) {
							//$('.result').html(data);
							$('#ProduitTailleId').html('<option value="" selected="selected">Choisir ...</option>');
							
							$.each(data,function(index, value) { 
									$('#ProduitTailleId').append('<option value="'+index+'" >'+value+'</option>');
								}) ;
							//alert('Load was performed.');
						}
			}) ;
	});
}) ; 

function reformat_prix(str){
	var r = str.replace(',','.') ;
	if(isNaN(r))
		return 0 ;
	else
		return r;
} 