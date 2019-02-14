<?php
class Annee extends AppModel{
	
    var $name = 'Annee';

	var $hasMany = array('Absence','Vehicule') ;

	var $displayField = 'titre' ;
}