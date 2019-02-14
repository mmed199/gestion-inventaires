<?php

class AbonnementsController extends AppController{

	var $name = 'Abonnements';
	var $helpers = array('Ajax', 'Text');
	var $components = array('Email', 'RequestHandler'); 
	var $uses = array('User', 'UserTemp', 'Abonnement', 'AbonnementCode', 'Secteur', 'FranceVille', 'FranceDepartement', 'FranceRegion');


	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->Allow('*');

	}
	
	function beforeRender(){
		parent::beforeRender();
		$this->set('liste_villes', null);
	}

	function index(){
		$this->redirect(array('controller'=>'abonnements', 'action'=>'etape1'));
		/*
		$this->layout = 'homepage';
		$this->set('title_for_layout', 'Notre offre d\'abonnement SCE');
		
		if($this->Session->check('Auth.User.id')){
			$this->redirect(array('controller'=>'produits', 'action'=>'index'));
		}*/
	}	

	function etape1(){
		$this->set('title_for_layout', 'Abonnement - Mes identifiants');
		$this->set('etape1', true);
		$this->set("secteurs", $this->Secteur->find('list', array('fields' => array('Secteur.nom'))));
		
		if($this->Session->check('Auth.User.id')){
			$this->redirect(array('controller'=>'produits', 'action'=>'index'));
		}
		
		if(empty($this->data) == false){
			//on valide les infos 
			$this->Abonnement->set($this->data);
			if($this->Abonnement->validates()){
			
				//on met en session puis on passe à l'étape suivante
				$this->Session->write('User', $this->data['Abonnement']);
				$this->redirect(array('controller'=>'abonnements', 'action'=>'etape2'));
			}//else debug($this->Session->read('User'));
		}
	}
	
	function etape2(){
		$this->set('title_for_layout', 'Abonnement - Ma société');
		$this->set('etape2', true);
		if($this->Session->check('User') == false)
			$this->redirect(array('controller' => 'abonnements', 'action' => 'etape1'));
		
		if($this->Session->check('Auth.User.id'))
			$this->redirect(array('controller'=>'produits', 'action'=>'index'));
			
		//recherche les départements
		$dpt = $this->FranceDepartement->find('list', array('fields' => array('FranceDepartement.id', 'FranceDepartement.nom_departement'), 'order' => 'FranceDepartement.nom_departement ASC'));
		$this->set('dpt', $dpt);
			
		if(empty($this->data) == false){
			
			$this->data['Abonnement']['username'] = $this->Session->read('User.username');
			$this->data['Abonnement']['email'] = $this->Session->read('User.email');
			$this->data['Abonnement']['confirm_email'] = $this->Session->read('User.confirm_email');
			$this->data['Abonnement']['pass'] = $this->Session->read('User.pass');
			
			$this->Abonnement->set($this->data);
			if($this->Abonnement->validates()){
			
				//on met en session puis on passe à l'étape suivante
				$this->Session->write('User', $this->data['Abonnement']);
				$this->redirect(array('controller'=>'abonnements', 'action'=>'etape3'));
			}
		}
	}
	
	function etape3(){
		$this->set('title_for_layout', 'Abonnement - Choix paiement');
		$this->set('etape3', true);
		$this->layout = 'default';
		if($this->Session->check('User') == false)
			$this->redirect(array('controller' => 'abonnements', 'action' => 'etape1'));
		
		if($this->Session->check('Auth.User.id'))
			$this->redirect(array('controller'=>'produits', 'action'=>'index'));
		
	
	}

	function autocomplete() {
		// Chaînes partielles qui arriveront du champ auto-complété comme
		$recherche = utf8_decode($this->data['Abonnement']['ville']);
		$this->FranceVille->Behaviors->attach('Containable');
		$ville = $this->FranceVille->find('all', array(
		'fields' => array('FranceVille.cp', 'FranceVille.nom'),
		'conditions' => array('OR' => array('FranceVille.cp LIKE "'. $recherche.'%"', 'FranceVille.nom LIKE "'. $recherche.'%"')),
		'contain' => array(
			'FranceDepartement' => array('fields' => array('FranceDepartement.nom_departement'), 
				'FranceRegion' => array('fields' => 'FranceRegion.nom_region')
				)
			)
		));
		
		$this->set('ville', $ville);
		$this->set('recherche', $recherche);
		$this->layout = 'ajax';
    }
	
	
	function edit_ville() {
		// Chaînes partielles qui arriveront du champ auto-complété comme
		$recherche = utf8_decode($this->data['Abonnement']['dpt']);
		$villes = $this->FranceVille->find('list', array(
		'fields' => array('FranceVille.id', 'FranceVille.nom'),
		'conditions' => array('FranceVille.cp LIKE "'. $recherche.'%"'),
		));
		
		$this->set('villes', $villes);
		$this->layout = 'ajax';
    }
	
	function edit_cp() {
		// Chaînes partielles qui arriveront du champ auto-complété comme
		$recherche = utf8_decode($this->data['Abonnement']['ville']);
		$cp = $this->FranceVille->find('first', array(
		'fields' => array('FranceVille.id', 'FranceVille.cp'),
		'conditions' => array('FranceVille.nom LIKE "'. $recherche.'%"'),
		));
		
		$this->set('cp', $cp);
		$this->layout = 'ajax';
    }
	
	function abonnement_carte(){
		$this->set('title_for_layout', 'Abonnement SCE - Formulaire');
		$this->set("secteurs", $this->Secteur->find('list', array('fields' => array('Secteur.nom'))));
		
		//on vérifie le code d'abonnement
		if(empty($this->data) == false){
			$recherche = $this->AbonnementCode->find('first', array('conditions' => array('code' => $this->data['Abonnement']['code'], 'active' => true, 'used' => false)));
		
			if(empty($recherche)){
				$this->Session->setFlash('Le code d\'abonnement est incorrect', 'growl');
				$this->redirect(array('controller' => 'abonnements', 'action' => 'etape3'));
			}
			else{
				//code abonnement juste
				//groupe abonné
				$this->Session->write('User.group_id', '3');
				$this->Session->write('User.adress_ip', $_SERVER['REMOTE_ADDR']);
				$this->Session->write('User.image', 'nophoto.gif');
				$this->data['Abonnement'] = $this->Session->read('User');
				
				if($this->Abonnement->save($this->data)){
					
					//on désactive le numéro de carte
					$this->data['AbonnementCode']['id'] = $recherche['AbonnementCode']['id'];
					$this->data['AbonnementCode']['user_id'] = $this->Abonnement->id;
					$this->data['AbonnementCode']['used'] = 1;
					$this->AbonnementCode->save($this->data['AbonnementCode']);
					
					
					
					//envoi de mail
					$this->data['Abonnement']['password'] = $this->Auth->password($this->data['Abonnement']['pass']);
					
					$this->Email->charset  = 'UTF-8';
					$this->Email->to = $this->data['Abonnement']['email'];
					$this->Email->subject = 'Confirmation d\'abonnement au site Service-Conseil-Entreprise.fr';
					$this->Email->from = 'service-conseil-entreprise.fr <contact@service-conseil-entreprise.fr>';
					$this->Email->replyTo = '<contact@service-conseil-entreprise.fr>';
					$this->Email->template = 'abonnement';
					$this->Email->lineLength = 60;
					$this->Email->sendAs = 'html';
					$this->set('data', $this->data['Abonnement']);
					
					if($this->Email->send()){
						$this->Session->setFlash('Bienvenue sur SCE !, votre inscription a bien été enregistrée', 'growl');
						
						//connexion auto
						$this->data['User'] = $this->data['Abonnement'];
						$login = $this->Auth->login($this->data);
						if($login) $this->redirect(array('controller'=>'abonnements', 'action'=>'merci'));
						else $this->redirect(array('controller'=>'produits', 'action'=>'index'));
					}
				}else(debug($this->Abonnement));

			}
		}
		else $this->redirect(array('controller' => 'abonnements', 'action' => 'index'));
		
	}
	
	function carte_sce(){
		$this->set('title_for_layout', 'Abonnement - J\'ai une carte Abonnement');
		$this->set('etape3', true);
		
		//on vérifie le code d'abonnement
		if(empty($this->data) == false){
			$recherche = $this->AbonnementCode->find('first', array('conditions' => array('code' => $this->data['Abonnement']['code'], 'active' => true, 'used' => false)));
			if(empty($recherche)){
				$this->Session->setFlash('Le code d\'abonnement est incorrect', 'growl');
				//$this->redirect(array('controller' => 'abonnements', 'action' => 'etape3'));
			}
			else{
				//code abonnement juste
				//groupe abonné
				$this->Session->write('User.group_id', '3');
				$this->Session->write('User.adress_ip', $_SERVER['REMOTE_ADDR']);
				$this->Session->write('User.image', 'nophoto.gif');
				$this->data['Abonnement'] = $this->Session->read('User');
				$this->data['Abonnement']['password'] = $this->Auth->password($this->data['Abonnement']['pass']);
				if($this->Abonnement->save($this->data['Abonnement'])){
					
					//on désactive le numéro de carte
					$this->data['AbonnementCode']['id'] = $recherche['AbonnementCode']['id'];
					$this->data['AbonnementCode']['user_id'] = $this->Abonnement->id;
					$this->data['AbonnementCode']['used'] = 1;
					$this->AbonnementCode->save($this->data['AbonnementCode']);
					
					
					
					//envoi de mail
					$this->data['Abonnement']['password'] = $this->Auth->password($this->data['Abonnement']['pass']);
					
					$this->Email->charset  = 'UTF-8';
					$this->Email->to = $this->data['Abonnement']['email'];
					$this->Email->subject = 'Confirmation d\'abonnement au site Service-Conseil-Entreprise.fr';
					$this->Email->from = 'service-conseil-entreprise.fr <contact@service-conseil-entreprise.fr>';
					$this->Email->replyTo = '<contact@service-conseil-entreprise.fr>';
					$this->Email->template = 'abonnement';
					$this->Email->lineLength = 60;
					$this->Email->sendAs = 'html';
					$this->set('data', $this->data['Abonnement']);
					
					if($this->Email->send()){
						$this->Session->setFlash('Bienvenue sur SCE !, votre inscription a bien été enregistrée', 'growl');
						
						//connexion auto
						$this->data['User'] = $this->data['Abonnement'];
						$login = $this->Auth->login($this->data);
						if($login) $this->redirect(array('controller'=>'abonnements', 'action'=>'merci'));
						else $this->redirect(array('controller'=>'produits', 'action'=>'index'));
					}
				}else(debug($this->data['Abonnement']));

			}
		}
		//else $this->redirect(array('controller' => 'abonnements', 'action' => 'etape3'));
	}
	
	function paypal(){
		$this->set('etape3', true);
		$this->layout = 'default';
		
		if($this->Session->check('User') == false)
			$this->redirect(array('controller' => 'abonnements', 'action' => 'etape1'));
		
		if($this->Session->check('User.user_temp_id') == false){
			$this->data['UserTemp'] = $this->Session->read('User');
			$this->UserTemp->save($this->data['UserTemp']);
			$this->Session->write('User.user_temp_id', $this->UserTemp->id);
		}
			
		$this->set('title_for_layout', 'Abonnement SCE - Paiement en ligne via paypal');
	}
	
	function abonnement_paypal(){
		// lire le formulaire provenant du système PayPal et ajouter 'cmd'
		$req = 'cmd=_notify-validate';
		
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		
		// renvoyer au système PayPal pour validation
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
	

		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		$id_user = $_POST['custom'];
		$shipping = $_POST['shipping'];
		$quantity = $_POST['quantity'];
		
		$address = $_POST['address_street'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$country = $_POST['address_country'];
		$city = $_POST['address_city'];
		$zip = $_POST['address_zip'];
		
		//recherche id du vendeur
		//$info = $this->Produit->find('first', array('fields' => 'Produit.user_id', 'conditions' => array('Produit.id' => $item_number)));
		//$seller_id = $info['Produit']['user_id'];
		
		if (!$fp) {
		// ERREUR HTTP
		mail('geni@lmd-developpement.fr', 'test paypal : erreur http', 'erreur http');
		} else {
			fputs ($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				if (strcmp ($res, "VERIFIED") == 0) {
					
					$this->data['User'] = $this->User->find('first', array('conditions' => array('Produit.id' => $item_number)));
					$this->data['User']['id'] = '';
					//on sauvegarde
					
					
					if($this->User->save($this->data['User']) == true){
						//mail('geni@lmd-developpement.fr', 'enregistrement effectué', $_post);
						
						$this->Email->charset  = 'UTF-8';
						$this->Email->to = $this->data['User']['email'];
						$this->Email->subject = 'Confirmation d\'abonnement au site Service.Conseil.Entreprise';
						$this->Email->from = 'noreply@service-conseil-entreprise.fr <noreply@service-conseil-entreprise.fr>';
						$this->Email->replyTo = 'contact@service-conseil-entreprise.fr';
						$this->Email->template = 'abonnement';
						$this->Email->lineLength = 60;
						$this->Email->sendAs = 'html';
						$this->set('data', $this->data['User']);
						$this->Email->send();
					}
					else
						mail('geni@lmd-developpement.fr', 'enregistrement fail', 'fail !');
					
					
				}
				else if (strcmp ($res, "INVALID") == 0) {
					// Transaction invalide                
				}
			}
			fclose ($fp);
		}
		
		// vérifier que payment_status a la valeur Completed
        if($payment_status == "Completed") {
			// vérifier que txn_id n'a pas été précédemment traité: Créez une fonction qui va interroger votre base de données
		/*	if(VerifIXNID($txn_id) == 0){
				// vérifier que receiver_email est votre adresse email PayPal principale
				if($this->data['Commande']['receiver_email'] == $receiver_email){
					// vérifier que payment_amount et payment_currency sont corrects
					// traiter le paiement
				}
				else{
					// Mauvaise adresse email paypal
				}
			}
			else{
				// ID de transaction déjà utilisé
			}*/
			
			//si le paiement est complété on gère les stocks et on envoie un mail au vendeur pour qu'il fasse son travail
			
		}
		else{
				// Statut de paiement: Echec
		}



	
	
	}
	
	function abonnement_cmcic(){
				header("Pragma: no-cache");
		header("Content-type: text/plain");

		//TPE settings
		require_once $_SERVER['DOCUMENT_ROOT'].'/tpe/CMCIC_Config.php';

		// --- PHP implementation of RFC2104 hmac sha1 ---
		require_once $_SERVER['DOCUMENT_ROOT'].'/tpe/CMCIC_Tpe.inc.php';

		// Begin Main : Retrieve Variables posted by CMCIC Payment Server 
		$CMCIC_bruteVars = getMethode();

		// TPE init variables
		$oTpe = new CMCIC_Tpe();
		$oHmac = new CMCIC_Hmac($oTpe);

		// Message Authentication
		$cgi2_fields = sprintf(CMCIC_CGI2_FIELDS, $oTpe->sNumero,
							  $CMCIC_bruteVars["date"],
								  $CMCIC_bruteVars['montant'],
								  $CMCIC_bruteVars['reference'],
								  $CMCIC_bruteVars['texte-libre'],
								  $oTpe->sVersion,
								  $CMCIC_bruteVars['code-retour'],
								  $CMCIC_bruteVars['cvx'],
								  $CMCIC_bruteVars['vld'],
								  $CMCIC_bruteVars['brand'],
								  $CMCIC_bruteVars['status3ds'],
								  $CMCIC_bruteVars['numauto'],
								  $CMCIC_bruteVars['motifrefus'],
								  $CMCIC_bruteVars['originecb'],
								  $CMCIC_bruteVars['bincb'],
								  $CMCIC_bruteVars['hpancb'],
								  $CMCIC_bruteVars['ipclient'],
								  $CMCIC_bruteVars['originetr'],
								  $CMCIC_bruteVars['veres'],
								  $CMCIC_bruteVars['pares']
							);

		if ($oHmac->computeHmac($cgi2_fields) == strtolower($CMCIC_bruteVars['MAC']))
			{
			switch($CMCIC_bruteVars['code-retour']) {
				
				case "Annulation" :
					// Payment has been refused
					// put your code here (email sending / Database update)
					// Attention : an autorization may still be delivered for this payment

					break;

				case "payetest":
					// Payment has been accepeted on the test server
					// put your code here (email sending / Database update)
				
					break;

				case "paiement":
					// Payment has been accepted on the productive server
					// put your code here (email sending / Database update)

					break;

			}
			$receipt = CMCIC_CGI2_MACOK;

		}
		else
		{
			// your code if the HMAC doesn't match
			$receipt = CMCIC_CGI2_MACNOTOK.$cgi2_fields;

		}

		//-----------------------------------------------------------------------------
		// Send receipt to CMCIC server
		//-----------------------------------------------------------------------------

		printf (CMCIC_CGI2_RECEIPT, $receipt);

		// Copyright (c) 2009 Euro-Information ( mailto:centrecom@e-i.com )
		// All rights reserved. ---
	}
	
	function merci(){
		$this->set('title_for_layout', 'Abonnement confirmé');
	}
	
/*	
	function creer_code(){
	
		$tab = array();
		$sql = 'insert into abonnement_codes (id, code, created) values '; 
			
			for($j= 1;$j<=1000;$j++){
				$code = sha1(mt_rand());
				$debut = rand(0, 20);
				$fin = 10;
				$code = substr($code, $debut, $fin);
				$tab[] = '("'.$j.'", "'.$code.'", NOW())';			
				
			}

		$req = $sql.' '.implode(", ",$tab);

		if($this->AbonnementCode->query($req)){
			$this->Session->setFlash('Bienvenue sur sce', 'growl');
			$this->redirect(array('controller' => 'produits', 'action' => 'index'));
		}
	
	}
*/


}