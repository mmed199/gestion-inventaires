<?php

class Typemateriel extends AppModel{

    var $name = 'Typemateriel'; 

	//var $belongsTo = array('Fournisseur','Typemateriel');
	var $hasMany = array('Materiel') ; 

	var $displayField = 'title' ;

	
}