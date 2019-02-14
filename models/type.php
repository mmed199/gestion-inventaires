<?php

class Type extends AppModel{

        var $name = 'Type';

		var $displayField = 'name'; 

		var $hasMany = array('Vehicule') ; 

		var $belongsTo = array('Modele') ;

		var $validate = array(
							'name' => array(
											'rule' => array('minLength', 2)
											 )
							);

}