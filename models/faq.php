<?php
class Faq extends AppModel{

        var $name = 'Faq';
		
		var $displayField = 'titre' ;
		
		var $belongsTo = array('Cfaq' => array(
									'className' => 'Cfaq',
									'foreignKey' => 'cfaq_id'
									)
							);
														
		var $validate = array(
					'title_question' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.')),
					'reponse' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.')),
					'slug' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'))
				);
		
    }