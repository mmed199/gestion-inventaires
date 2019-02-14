<?php

class Depense extends AppModel{

	var $name = 'Depense';
	
	var $hasMany = array('Indemnite') ;

	var $belongsTo = array('Signataire','User');

	var $validate = array( 
					'objet' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'
								),
							'Regle2'=>array(
										'rule' => array('minLength', '4'),
										'required' => true,
										'on' => 'create',
										'message'=>'L\'objet doivent avoir au moins 4 caractères.'
										  )
								),
					'signataire_id' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'
								    )
								),					 
					'date_signature' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'
								    )
								),
					
					 
						) ; 


	
    }