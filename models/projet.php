<?php

class Projet extends AppModel{

	var $name = 'Projet';
	
	var $hasMany = array('Tache','Member') ;

	var $belongsTo = array('User');
	var $validate = array(
					'nom' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le nom est vide.'
								),
							'Regle2'=>array(
										'rule' => array('minLength', '4'),
										'required' => true,
										'on' => 'create',
										'message'=>'Le nom est vide.'
										  )
								),
					'description' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'La description est vide.'
								    )
								),					 
					'date_limite' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'La date_limite est vide.'
								    )
								),
					
					 
						) ; 
	
    }
