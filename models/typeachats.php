<?php

class Typeachat extends AppModel{

    var $name = 'Typeachat'; 

	//var $belongsTo = array('Fournisseur','Typeachat');
var $hasMany = array('Materiel') ; 
	var $displayField = 'nom' ;

	
}