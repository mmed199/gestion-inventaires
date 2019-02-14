<?php

class Category extends AppModel{

        var $name = 'Category';

		var $displayField = 'name'; 

		var $hasMany = array('Vehicule') ; 

		var $validate = array(
							'name' => array(
											'rule' => array('minLength', 2)
											 )
							);
		
}