<?php

class Absence extends AppModel{

	var $name = 'Absence';
	
	var $belongsTo = array('Member','User','Typeabsence','Annee');
  
	var $validate = array(
							'typeabsence_id' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'
										)
									),
							'annee_id' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'
										    )
										),
							'date_debut' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'
										    )
										),
							'date_fin' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'
										    )
										)
					 
						) ; 
	
    }