<?php
    class User extends AppModel{
            var $name = 'User';
			
			/* var $hasMany =array('Pmessage'=>array(
									'className' => 'Pmessage',
									'foreignKey' => 'user_id' */
    
	var $hasMany = array('Absence','Depense') ;

	var $actsAs = array(
						'MeioUpload' => array( 
								'logo' => array( 
									'dir' => 'uploads/users',
									'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
									'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif'),
									'default' => 'default.jpg',
									'max_size' => '8 Mb',
										)/*,
								'verified_file' => array( 
									'dir' => 'uploads/professionnels/verified_file',
									'allowedMime' => array('application/pdf', 'application/msword', 'application/vnd.ms-powerpoint', 
									'application/vnd.ms-excel','application/rtf', 'application/zip'),
									'allowedExt' => array('.pdf', '.doc', '.ppt', '.xls','.rtf', '.zip'),
									'default' => false,
						        		),*/
								)
								
					);

	var $belongsTo = array('City');

	var $validate = array(
					'nom' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'
								)
							),
					'prenom' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Le champ est vide.'
								    )
								),
					
					'email' => array(
							  'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'),
							  'Regle2' => array(
										'rule' => 'email',
										'required' => true,
										'on' => 'create',
										'message' => 'Format de l\'adresse email incorrect.'),
							  'Regle3' => array(
										'rule' => 'isUnique',
										'required' => true,
										'on' => 'create',
										'message' => 'L\'adresse email existe déjà.'),
								),
					'password' => array( 
							   'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'),
								'Regle2'=>array(
										'rule' => array('minLength', '4'),
										'required' => true,
										'on' => 'create',
										'message'=>'Le password doivent avoir au moins 4 caractères.'
										)
								  ),
					'repassword' => array( 
							   'Regle1' => array(
										'rule' => 'notEmpty',
										'required' => true,
										'on' => 'create',
										'message' => 'Le champ est vide.'),
								'Regle2'=>array(
										'rule' => array('minLength', '4'),
										'required' => true,
										'on' => 'create',
										'message'=>'Le password doivent avoir au moins 4 caractères.'
										  )
								),
							
					/*'tag_cgu' => array(
							'Regle1' => array(
								'rule' => 'notEmpty',
								'required' => true,
								'on' => 'create',
								'message' => 'Pour vous utilisez l\'espace membre, il faut accepter la condition générale d\'utilisation !'
								    )
								),*/
					 
						) ; 

	
    }
?>