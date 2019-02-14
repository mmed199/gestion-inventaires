<?php 
 class Message extends AppModel{
            var $name = 'Message';
			/*
            var $belongsTo = array(
								'User' => array('counterCache' => true)
								);*/
								
			var $belongsTo = array('Sender'=>array('className'=>'Member' ,
											   'foreignKey'=>'sender_id',
											   ),
								   'Receiver'=>array('className'=>'Member',
												  'foreignKey'=>'receiver_id'
												)
							) ;
							
			 var $actsAs = array(
						'MeioUpload' => array( 
								'document' => array( 
									'uploadName' => null,
									'dir' => 'uploads/messages',
									'allowedMime' => array('application/pdf', 'application/msword', 'application/vnd.ms-powerpoint', 'application/vnd.ms-excel', 'application/rtf', 'application/zip'),
									'allowedExt' => array('.pdf', '.doc','.docx', '.ppt', '.xls', '.rtf', '.zip'),
									'default' => false,
										)
						        )		 
					);  
					
			var $validate = array(
								 'nom' => array(
									'rule' => 'notEmpty',
									'required' => true,
									'allowEmpty' => false,
									'message' => "Votre nom doit être renseigné."
								), 
								'objet' => array(
									'rule' => 'notEmpty',
									'required' => true,
									'allowEmpty' => false,
									'message' => "L'objet de message doit être renseigné."
								),
								'email' => array(
									'rule' => 'email',
									'required' => true,
									'allowEmpty' => false,
									'message' => "Vous devez saisir une adresse email valide."
								), 
								'message' => array(
									'rule' => 'notEmpty',
									'required' => true,
									'allowEmpty' => false,
									'message' => "Vous devez saisir un message."
								),
								'document' => array(
										'Empty' => array(
													'check' => true ,
													'message' => "Le fichier ne peut pas être vide."
													),
								)
							);
    } 