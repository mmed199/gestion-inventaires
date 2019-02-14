<?php
    class Abonne extends AppModel{
        var $name = 'Abonne';
		
		var $validate = array(
						'nom' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'
								)
							),
						'email' => array(
							  'Regle1' => array(
								'rule' => 'isUnique',
								'required' => true,
								'on' => 'create',
								'message' => 'L\'adresse email existe déjà.'),
							  'Regle2' => array(
								'rule' => 'email',
								'required' => true,
								'on' => 'create',
								'message' => 'Format de l\'adresse email incorrect.'),
							  'Regle3' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.')
								),
						/* 'nom' => array(
							'rule' => array('custom', '/^[a-z]{3,}$/i'),
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Seulement des lettres et des entiers, minimum 3 caractères'
						)
						*/
					);
    }
?>