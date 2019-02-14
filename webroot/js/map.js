jQuery(function($){
	$('.map').append('<div class="overlay">').append('<div class="nom_region"></div>');
	$('.map .nom_region').hide();
	var regions = [
		{name: 'Ile de France', slug: 'ile-de-france'},
		{name: 'Bretagne', slug: 'bretagne'},
		{name: 'Basse Normandie', slug: 'basse-normandie'},
		{name: 'Haute Normandie', slug: 'haute-normandie'},
		{name: 'Picardie', slug: 'picardie'},
		{name: 'Nord pas de Calais', slug: 'nord-pas-calais'},
		{name: 'Champagne Ardenne', slug: 'champagne-ardenne'},
		{name: 'Lorraine', slug: 'lorraine'},
		{name: 'Alsace', slug: 'alsace'},
		{name: 'Pays de la Loire', slug: 'pays-de-la-loire'},
		{name: 'Centre', slug: 'centre'},
		{name: 'Bourgogne', slug: 'bourgogne'},
		{name: 'Franche Comté', slug: 'franche-comte'},
		{name: 'Poitou Charente', slug: 'poitou-charente'},
		{name: 'Limousin', slug: 'limousin'},
		{name: 'Auvergne', slug: 'auvergne'},
		{name: 'Rhone Alpes', slug: 'rhone-alpes'},
		{name: 'PACA', slug: 'provence-alpes-cote-d-azur'},
		{name: 'Languedoc Roussillon', slug: 'languedoc-roussillon'},
		{name: 'Aquitaine', slug: 'aquitaine'},
		{name: 'Midi Pyrénées', slug: 'midi-pyrenees'},
		{name: 'Corse', slug: 'corse'}
		
	]
	
	//div nom_region qui suit la souris
	$(document).mousemove(function(e){
		$('.map .nom_region').css({
			top:e.clientY-$('.map .nom_region').height(),
			left:e.clientX+10
		});
	});
	
	//on passe sur une région
	$('.map area').mouseover(function(){
		var index = $(this).index();
		var left = -index*650 - 650;
		$('.map .nom_region').html(regions[index].name).stop().fadeTo(600,2);
		
		$('.map .overlay').css({
			backgroundPosition: left+"px 0px"
		});
	});
	
	//on sort de la map
	$('.map').mouseout(function(){
		$('.map .overlay').css({
			backgroundPosition: "650px 0px"
		});
		$('.map .nom_region').stop().fadeTo(600, 0);
	});
		//alert(index);
});