<?php
class Member extends AppModel{

    var $name = 'Member';
	
	var $displayField = 'nom' ;
	
	var $actsAs = array(
						'MeioUpload' => array( 
								'logo' => array( 
									'dir' => 'uploads/members',
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
	
	var $hasMany = array('Absence') ; 

	var $belongsTo = array('Division','Projet','Indemnite','City');
	
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
function afterFind($results,$primaire){

		if( !$primaire ) {

			if(isset($results['Member']['nom']) && isset($results['Member']['prenom'] ) ) {

				$results['Member']['link'] = $this->getLink($results)  ;

			}			

		}

		else {

			foreach($results as $k => $v ){

				if(isset($v[$this->name]['created'])){

					$results[$k][$this->name]['created'] = utf8_encode(strftime("%d/%m/%Y", strtotime($results[$k][$this->name]['created'])));

				}

				if(isset($results[$k]['Member']['nom']) && isset($results[$k]['Member']['prenom'] ) ) {

						$results[$k]['Member']['link'] = $this->getLink($v)  ;

				}

			}

		}

		return $results;

	}

	

	function getLink($j){

		$j['Member']['nom'] =trim($j['Member']['nom']) ;

		$j['Member']['prenom'] =trim($j['Member']['prenom']) ;

		$link = "/members/" ;

		if( !empty($j['Member']['nom'] ) )

			$link .= strtolower( Inflector::slug($j['Member']['nom'],'-').'-');

		if( !empty($j['Member']['prenom'] ) )

			$link .= ".".strtolower( Inflector::slug($j['Member']['nom'],'-').'-');

		return $link ; 

	}	

	function validEmails($data) {

		if(empty($this->data[$this->name]['email']) == false){

			if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $this->data[$this->name]['email']))

				return true;

			else 

				return false;

		}

        else 

            return false;

    }



}