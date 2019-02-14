<?php

class Modele extends AppModel{

        var $name = 'Modele';

		var $displayField = 'name'; 

		var $hasMany = array('Vehicule') ; 

		var $belongsTo = array('Marque') ;

		var $validate = array(
							'name' => array(
											'rule' => array('minLength', 2)
											 )
							);
		
}