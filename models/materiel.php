<?php

class Materiel extends AppModel{

    var $name = 'Materiel'; 

	var $belongsTo = array('Fournisseur','Typemateriel','Typeachat','Emplacement');

	var $displayField = 'name' ;

	var $validate = array(
							'typemateriel_id' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'type materiel est vide.'
										)
									),
							'nom' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le nom est vide'
										    )
										),
							'typeachat_id' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'type achat est vide.'
										    )
										),
							'prix' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le prix est vide.'
										    )
										),
							'fournisseur_id' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'
										    )
										),/*
							'date_achat' => array(
									'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'
										    )*/
										
					 
						) ; 

	
}