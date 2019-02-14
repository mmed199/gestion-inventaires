<?php
class City extends AppModel{
    var $name = 'City';
    var $displayField = 'nom' ;
	
	var $validate = array(
							'nom' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => null,
										'message' => 'Le champ est vide.'
										)
									),
							'iso_code' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => null,
										'message' => 'Le champ est vide.'
											)
										)
						) ; 
	
}