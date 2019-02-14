<?php



class Abonnement extends AppModel{



	var $name = "Abonnement";

	var $useTable = 'users';

	var $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
				'on' => 'create',
				'required' => true,
                'message' => 'Chiffres et lettres uniquement !'
                ),
            'between' => array(
                'rule' => array('between', 4, 25),
				'on' => 'create',
				'required' => true,
                'message' => 'Votre pseudo doit contenir 4 à 25 caractères'
            ),
			'isUnique' => array(
				'rule' => 'isUnique',
				'on' => 'create',
				'required' => true,
				'message' => 'Ce pseudo est déjà pris'
			)
        ),
		'pass' => array(
            'between' => array(
                'rule' => array('between', 4, 25),
				'on' => 'create',
				'required' => true,
                'message' => 'Votre mot de passe doit contenir au moins 4 caractères'
            )
        ),
        'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'on' => 'create',
				'message' => 'Veuillez indiquer une adresse email'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'on' => 'create',
				'required' => true,
				'message' => 'Cette adresse email est déjà prise'
			),
			'validEmails' => array(
				'rule'=> 'validEmails',
				'on' => 'create',
				'required' => true,
				'message' => 'Veuillez indiquer une adresse email valide'
			),
			'checkEmails' => array(
				'rule'=> 'checkEmails',
				'on' => 'create',
				'required' => true,
				'message' => 'Les adresses emails ne correspondent pas'
			)
		),
		'adresse' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				//'required' => true,
				//'on' => 'create',
				'message' => 'Veuillez indiquer une adresse'
			)
		),
		
		'code_postal' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				//'required' => true,
				//'on' => 'create',
				'message' => 'Veuillez indiquer votre code postal'
			)
		),
		
		'ville' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				//'required' => true,
				//'on' => 'create',
				'message' => 'Veuillez indiquer votre ville'
			)
		),
		'societe' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				//'required' => true,
				//'on' => 'create',
				'message' => 'Veuillez indiquer votre société'
			)
		)
    );
	
	function beforeSave() {

		if(empty($this->data[$this->name]['pass']) == false)

			$this->data[$this->name]['password'] = Security::hash($this->data[$this->name]['pass'],'SHA1',true);

        return true;

    }

	

	

	function checkEmails($data) {

        if ($this->data[$this->name]['email'] == $this->data[$this->name]['confirm_email']) {

            return true;

        }

        else {

            return false;

        }

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