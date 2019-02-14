<?php
class UsersController extends AppController{
     var $name = 'Users';
	 var $components = array('Email') ;
	function recovercode(){
		$this->layout = "min"; 
		if ($this->Session->check('Auth.User') ) 
			$this->redirect('/');
		if (!empty($this->data))  {
		   $email = $this->data['User']['email']  ;
		   $c = $this->User->find('count', array(
					'conditions' => array('User.email'=>$email)
						   ));
		   if ( $c == 0 ) {  $this->Session->setFlash("Aucun compte associé à cet adresse mail.");  } 
		   else {
			 $user = $this->User->find('first', array(
													   'conditions' => array('User.email'=>$email)
														   )
											);
			  // genereting  recover code 
			  $recover_code  = $this->_code() ;
			  // saving recover code in db 
			  $this->User->id = $user['User']['id'] ;
			  $this->User->saveField('recover_code' , $recover_code) ;
			  // sending recover mail 
			  $this->_sendRecoverCodeMail($user['User']['id']) ;
			  $this->Session->setFlash("Un lien a été envoyé à votre boîte mail pour réinitialiser votre mot de passe.");
				$this->redirect('/') ;
			}
		} 		
    }	
	function vfRecoverLink($user_id , $recover_code ){
	       if( ! empty( $user_id ) && !empty($recover_code) ) {
		            $q = $this->User->findById( $user_id  );
					if( !empty($q) && $q['User']['recover_code'] == $recover_code ) {
								$this->redirect('/users/changerPass/'.$user_id.'/'.$recover_code) ; 
					}
			}  
		   $this->Session->setFlash("Le lien de récupération du mot de passe est incorrect." ) ;
		   $this->redirect('/') ; 
	}
	function cancelRecoverLink($user_id , $recover_code ){
	       if( ! empty( $user_id ) && !empty($recover_code) ) {
		            $q = $this->User->findById( $user_id  );
					if( !empty($q) && $q['User']['recover_code'] == $recover_code ) {
								$this->User->saveField('recover_code','') ;
								$this->Session->setFlash(" Merci,Le lien est annulé." ) ;
								$this->redirect('/') ; 
					}
			}  
			$this->Session->setFlash("Le lien d'annulation est incorect." ) ;
		   $this->redirect('/') ; 
	}
	
	
	function changerPass($user_id=null , $recover_code=null){
		//if(!$this->Session->check('Recover.recover_code')) $this->redirect('/') ;
		$user_id=($user_id==null)?$this->data['user_id']:$user_id ;
		$recover_code=($recover_code==null)?$this->data['recover_code']:$recover_code ;
		if(!empty($this->data)) {
			$q = $this->User->findById($user_id) ; 
			if( ! empty($q ) && $q['User']['recover_code'] == $recover_code  ) {
						$this->User->id = $q['User']['id'] ; 
						$this->User->saveField('password',$this->AppAuth->password($this->data['User']['password']) ) ;
						$this->User->saveField('recover_code','') ;
						$this->Session->setFlash(__("Le mot de passe a été modifié avec succès.<br/> Vous pouvez maintenant se connecter avec votre nouveau mot de passe.",true) ) ;
						$this->redirect('/users/login') ; 
						} else {
							$this->Session->setFlash(" Une erreur est survenue lors du changement du mot de passe, veuillez demander un nouveau lien de changement de mot de passe." ) ;
							$this->redirect('/users/recovercode') ; 
						}
		}
		$this->set('user_id',$user_id ) ; 
		$this->set('recover_code',$recover_code) ; 
	} 

	// Gestion activités
    function admin_activites() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);
				

	} 

	function admin_dossiers() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);
				

	}


// Gestion RH
	function admin_rh() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);
				

	}

	function admin_absences() {
		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);
	}

	// Gestion des profils
	
	function admin_profils() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);

	}

	// Gestion des indemnités
	
	function admin_indemnites() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);

	}

	// Gestion de stocks
	
	function admin_stocks() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);

	}

	// Gestion inventaire
	
	function admin_inventaires() {

		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);

	}
	//----------------------------------------------------------------- Mod functions ----------------------------------------
	function com_logout(){
		$this->Session->destroy();
		$this->Session->setFlash("Vous êtes maintenant déconnecté.");
		$this->redirect($this->AppAuth->logout());
    }
	function com_login(){	
		$this->layout = "min" ;
		//echo $this->AppAuth->password('hotmail456') ;
		if(!empty($this->data)) {
			$this->AppAuth->login($this->data);
		}	
	}
	function com_home(){
	}
	function com_editMonCompte() {
		if(!empty($this->data) ) {
			unset($this->data['User']['password']) ;
			if( $this->User->save($this->data)  ) {
						$this->Session->setFlash("Les modifications ont été bien enregistrés avec succès.","default",array("class"=>"valid_box")) ;
						$this->redirect("moncompte") ;
			}
		}
		$this->User->id = $this->Session->read('Auth.User.id')  ;
		$this->data = $this->User->read();
	}
	function com_moncompte() {
		$this->User->id = $this->Session->read('Auth.User.id')  ;
		$this->set('user', $this->User->read() );
	}
	function com_modifierMotPasse() {
		if(!empty($this->data) ) {
			$this->data['User']['id'] = $this->User->id = $this->Session->read('Auth.User.id')  ;
			$user = $this->User->read();
			if( $this->AppAuth->password($this->data['User']['old_password'])  == $user['User']['password']  ) {
				$this->data['User']['password'] = $this->AppAuth->password($this->data['User']['password'])  ;
				if( $this->User->save($this->data)   ) {
							$this->Session->setFlash("Votre mot de passe a été bien mise-à-jour.","default",array("class"=>"valid_box")) ;
							$this->redirect("moncompte") ;
				}
			} 
			else{
				$this->Session->setFlash("l'ancien mot de passe est incorrect.","default",array("class"=>"error_box")) ;			
			}
		}
		$this->User->id = $this->Session->read('Auth.User.id')  ;
		$this->data = $this->User->read();	
		unset($this->data['User']['password'] ) ;
	}
//----------------------------------------------------------------- Admin functions ----------------------------------------
   function admin_login(){	
		$this->layout = "min" ;
		if(!empty($this->data)) {
			$this->data['User']['d_d_con'] = date('Y-m-d H:i:s') ;
			$this->AppAuth->login($this->data);
		}	
	}

	function logout(){
		$this->Session->destroy();
		$this->AppAuth->logout();
		$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
										  Vous avez été déconnecté avec succès.",'default',array('class'=>'alert alert-success' ) ) ;
		$this->redirect('/admin/users/login');	
    }

    function inscription(){
		$site_name =Configure::read("site_name");
		$this->set ('page_title','Inscription ~ '.$site_name);
		if($this->Session->check('Auth.User.id') ) 
		   $this->redirect('/admin') ;  
		if(!empty($this->data) ) {
			// print_r($this->data) ;
			$this->data['User']['id'] = null ;
			$this->data['User']['password'] = $this->AppAuth->password($this->data['User']['password'] ) ;
			$this->data['User']['activation_code'] = $this->_code() ;
			$this->data['User']['created']  = date('Y-m-d H:i:s') ;
			if( $this->User->save($this->data)  ) {
				//if($this->data["User"]["tag_cgu"]==1) { //condition général d'utilisation
					$email_temp = $this->data['User']['email'] ;
					$pass_temp = $this->data['User']['password']  ;
					unset($this->data) ;
					//connection
					 $this->data['User']['email'] = $email_temp ;
					 $this->data['User']['password']  = $pass_temp ;
				     $this->AppAuth->login($this->data)  ;
					//send activation mail
					 $this->_sendActivationMail($this->User->getLastInsertId()) ;
					 $this->data['User']['email'] = $email_temp ;
					 $this->data['User']['password']  = $pass_temp ;
					 $this->AppAuth->login($this->data)  ;
					 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le compte Admin à bien été inscrit sur le site. L'activation de compte à été envoyée par mail à cet adresse : " .$this->data['User']['email'] ,
					"default",array('class'=>'alert alert-success','role'=>'alert'));
					 $this->redirect("/admin") ;
					} 
					else{ 
						unset($this->data['User']['password']) ;
						unset($this->data['User']['repassword']) ;
						$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						<strong>ERREUR</strong> : Veuillez renseigner toutes les champs obligatoires.",
						"default",array('class'=>'alert alert-danger','role'=>'alert'));
					} 
			}
	}

	function confirmer($user_id = null) {
	    $this->User->id = $user_id;
		if ($this->User->exists())
		{
			// Update the active flag in the database
			$this->User->saveField('confirmed', 1);

			// Let the User know they can now log in!
			$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Votre compte a été activé, vous pouvez maintenant vous connecter ci-dessous",
					"default",array('class'=>'alert alert-success','role'=>'alert'));
			$this->redirect("/admin") ;
		}

		// Activation failed, render '/views/members/confirmer.ctp' which should tell the user.
	}

	function admin_home(){
		$date_aujourdhui = date('Y-m-d');
		// Actualités demandes
		/*$this->loadModel ('Demande');
		$nouvelles_demandes = $this->Demande->find('count',array('conditions'=>array('Demande.created >='=>$date_aujourdhui,'Demande.deleted'=>0,'Demande.tag_offre'=> 0))) ; // 
		$demandes_en_attente_publication = $this->Demande->find('count',array('conditions'=>array('Demande.deleted' => 0,'Demande.publier'=> 0 , 'Demande.valide' => 1,'Demande.tag_offre'=> 0))) ; 
	    $demandes_validees = $this->Demande->find('count',array('conditions'=>array('Demande.deleted' => 0,'Demande.valide' => 1,'Demande.tag_offre'=> 0))) ;

		$this->set ('nouvelles_demandes',$nouvelles_demandes); 
		$this->set ('demandes_en_attente_publication',$demandes_en_attente_publication); 
		$this->set ('demandes_validees',$demandes_validees); 

		// Actualités offres
		$nouvelles_offres = $this->Demande->find('count',array('conditions'=>array('Demande.created >='=>$date_aujourdhui,'Demande.deleted'=>0,'Demande.tag_offre'=> 1))) ; // 
		$offres_en_attente_publication = $this->Demande->find('count',array('conditions'=>array('Demande.deleted' => 0,'Demande.publier'=> 0 , 'Demande.valide' => 1,'Demande.tag_offre'=> 1))) ; 
	    $offres_validees = $this->Demande->find('count',array('conditions'=>array('Demande.deleted' => 0,'Demande.valide' => 1,'Demande.tag_offre'=> 1))) ;

		$this->set ('nouvelles_offres',$nouvelles_offres); 
		$this->set ('offres_en_attente_publication',$offres_en_attente_publication); 
		$this->set ('offres_validees',$offres_validees); 
		
		

		// Actualités vacances
		$this->loadModel ('Vacance');
		$nouveaux_vacances = $this->Vacance->find('count',array('conditions'=>array('Vacance.created >='=>$date_aujourdhui,'Vacance.deleted'=>0))) ; // 
		$vacances_en_attente_publication = $this->Vacance->find('count',array('conditions'=>array('Vacance.deleted' => 0,'Vacance.publier'=> 0 , 'Vacance.valide' => 1))) ; 
	    $vacances_valides = $this->Vacance->find('count',array('conditions'=>array('Vacance.deleted' => 0,'Vacance.valide' => 1))) ;

		$this->set ('nouveaux_vacances',$nouveaux_vacances); 
		$this->set ('vacances_en_attente_publication',$vacances_en_attente_publication); 
		$this->set ('vacances_valides',$vacances_valides); 

		// Actualités Messages
		$this->loadModel ('Message');
		$nbr_messages_nouveau =  $this->Message->find('count',array('conditions'=>array('Message.lu = 0 and Message.deleted = 0'))) ; 
		$nbr_messages_no_repondu = $this->Message->find('count',array('conditions'=>array('Message.repondu = 0 and Message.deleted = 0'))) ; 
		
		$this->set ('nbr_messages_nouveau',$nbr_messages_nouveau); 
		$this->set ('nbr_messages_no_repondu',$nbr_messages_no_repondu);

		// Actualités newslettre
		$this->loadModel ('Abonne');		
		$abonnes_nouveaux =  $this->Abonne->find('count',array('conditions'=>array('Abonne.date_inscription >='=>$date_aujourdhui ))) ; 
		$this->set ('abonnes_nouveaux',$abonnes_nouveaux); */
		
		// Actualités Memebres
		/*$this->loadModel ('Member');
		$clients_new =  $this->Member->find('count',array('conditions'=>array('Member.created >='=>$date_aujourdhui, 'Member.type_compte'=>0 ))) ; 
		$pros_new =  $this->Member->find('count',array('conditions'=>array('Member.created >='=>$date_aujourdhui, 'Member.type_compte'=>1 ))) ; 
		
		$this->set ('clients_new',$clients_new); 
		$this->set ('pros_new',$pros_new); */
		
	}
	
	
	
	function _set_varietes_produits ($produits){
		$this->loadModel ("Produit");
		$this->loadModel ("Variete");
		foreach ($produits as $produit){			
			$produit['Produit']['couleurs'] = "";
			$produit['Produit']['tailles'] = "";
			$variete = $this->Variete->find ("all", array("conditions"=>array("Variete.produit_id" => $produit['Produit']['id'],
																				"Variete.stock >="=>1),
															"fields" => "DISTINCT Couleur.nom"));
			if ($variete){
				$count = count ($variete);
				switch ($count){
					case 1 :
						$produit['Produit']['couleurs'] = $variete[0]['Couleur']['nom'];
						break;
					case 2 :
						$produit['Produit']['couleurs'] = $variete[0]['Couleur']['nom'] . " ou " . $variete[1]['Couleur']['nom'];
						break;
					default:
						$produit['Produit']['couleurs'] = "plusieurs";
				
				}		
			}				
			$variete = $this->Variete->find ("all", array("conditions"=>array("Variete.produit_id" => $produit['Produit']['id'],
																				"Variete.stock >="=>1),
															"fields" => "DISTINCT Taille.nom", "order"=>"Taille.order asc"));
			if ($variete){
				$count = count ($variete);
				switch ($count){
					case 1 :
						$produit['Produit']['tailles'] = $variete[0]['Taille']['nom'];
						break;
					case 2 :
						$produit['Produit']['tailles'] = $variete[0]['Taille']['nom'] . " ou " . $variete[1]['Taille']['nom'];
						break;
					default:
						$produit['Produit']['tailles'] = "plusieurs";
				
				}		
			}
			$this->Produit->save( $produit);
		}
		
	}
	
	
	function admin_editProfil(){
		if(!empty($this->data) ) {
			$this->data['User']['id'] = $this->Session->read('Auth.User.id') ;
			if($this->User->save($this->data) )  {
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Vos informations a été modifiées avec succès.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));	
				$this->redirect("/admin/mon-profil.html") ;
				}
		}else{
			$this->User->id = $this->Session->read('Auth.User.id')  ;
			$this->data = $this->User->read();	
		}
		$villes = $this->User->City->find('list',array('order'=>'City.nom asc'));
		$this->set('villes',$villes);
	}

	function admin_edit_photo() {
		$q = $this->User->find('first',array('conditions'=>array("User.id"=> $this->Session->read('Auth.User.id'))));
		$this->set ('user',$q);
		if(!empty($this->data) ) {
			$this->data['User']['id'] = $this->Session->read('Auth.User.id') ;
			if($this->User->save($this->data) )  {
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					Votre logo a été modifié avec succès.","default",array('class'=>'alert alert-success'));	
				$this->redirect("/admin/mon-profil.html") ;
				}
		}else{
			$this->User->id = $this->Session->read('Auth.User.id')  ;
			$this->data = $this->User->read();	
		}
	}

	function admin_moncompte() {
		$this->User->id = $this->Session->read('Auth.User.id')  ;
		$this->set('user', $this->User->read() );
	}
	function admin_modifierMotPasse() {
		if(!empty($this->data) ) {
			$this->data['User']['id'] = $this->User->id = $this->Session->read('Auth.User.id')  ;
			$user = $this->User->read();
			if( $this->AppAuth->password($this->data['User']['old_password'])  == $user['User']['password']  ) {
				$this->data['User']['password'] = $this->AppAuth->password($this->data['User']['password'])  ;
				if( $this->User->save($this->data)   ) {
							$this->Session->setFlash("Votre mot de passe a été bien mise-à-jour.","default",array("class"=>"valid_box")) ;
							$this->redirect("moncompte") ;
				}
			} 
			else{
				$this->Session->setFlash("l'ancien mot de passe est incorrect.","default",array("class"=>"error_box")) ;			
			}
		}
		$this->User->id = $this->Session->read('Auth.User.id')  ;
		$this->data = $this->User->read();	
		unset($this->data['User']['password'] ) ;
	}

	
	function admin_index() {
		$user_id = $this->Session->read('Auth.User.id');

		$user = $this->User->find('first',array('conditions'=>array("User.id"=> $user_id)));
		$this->set ('user',$user);

		$this->loadModel ("Projet");
		$projets = $this->Projet->find ("all", array("conditions"=>array("Projet.user_id" => $user_id)));
		$nbr_projet = count($projets);
		$this->set ('nbr_projet',$nbr_projet);

		$this->loadModel ("Tache");
		$taches = $this->Tache->find ("all", array("conditions"=>array("Tache.user_id" => $user_id)));
		$nbr_tache = count($taches);
		$this->set ('nbr_tache',$nbr_tache);

	}
	
	function admin_view($id) {
		$q=$this->User->find("first",array(
                "conditions" => "User.id=$id",
				"recursive"=>2 
            ));
		$this->set('m', $q ) ;
	}
	
	function admin_add(){
		if(!empty($this->data) ) {
			$this->data['User']['id'] = null ;
			$this->data['User']['created_date']  = date('Y-m-d H:i:s') ;
			if( $this->User->save($this->data)  ) {
						$this->Session->setFlash("Le nouveau utilisateur a  bien été  ajouté avec succès.","default",array("class"=>"valid_box")) ;
						$this->redirect("index") ;
			}else{
				unset($this->data['User']['password']) ;
				unset($this->data['User']['repassword']) ;
			}
		}
	}
	
	function admin_edit($id){
		if(!empty($this->data) ) {
			//$this->data['User']['password'] = $this->AppAuth->password($this->data['User']['password'] ) ;
			if(empty($this->data['User']['password'] ) ) unset($this->data['User']['password']) ; 
			$this->data['User']['created_date']  = date('Y-m-d H:i:s') ;
			if( $this->User->save($this->data)  ) {
						$this->Session->setFlash("L'utilisateur a été modifié avec succès.","default",array("class"=>"valid_box")) ;
						$this->redirect("index") ;
			}else{
				unset($this->data['User']['password']) ;
				unset($this->data['User']['repassword']) ;
			}
		}
		$this->User->id = $id ;
		$this->data = $this->User->read();
		unset($this->data['User']['password']) ;
	}
	function admin_rechercher() {
		$this->paginate = array('limit'=>20 ) ;
		$conditions = array('or'=>array(
										'nom like'=>'%'.$this->data['User']['query'].'%',
										'prenom like'=>'%'.$this->data['User']['query'].'%',
										'email like'=>'%'.$this->data['User']['query'].'%',
										) ) ;
		$this->set('users', $this->paginate('User',$conditions))  ;
		$this->render('admin_index' ) ;
	}
	
	function admin_delete($id){
		$this->autoRender = false;
		if($this->User->delete($id)) {
				$this->Session->setFlash("L'utilisateur a été supprimé avec succès.","default",array('class'=>'valid_box')) ;
				$this->redirect("index"); 
				}
		else echo "error" ;
	}
//------------------------------- local ----------------------------- 
	function _sendRecoverCodeMail($id){
		$site_url_courte = Configure::read("site_url_courte");
		$site_name =Configure::read("site_name");

		$u = $this->User->findById($id) ;
		$this->Email->reset();
		$this->Email->to = $u['User']['email'];
        $this->Email->subject = 'Votre mot de passe'.$site_name ;
        $this->Email->from =  $site_url_courte.' <ne-pas-repondre@'.$site_url_courte.'>';
        $this->Email->template = 'users/recover_mail';
        $this->Email->sendAs = 'html'; 
        $this->set('user', $u);
        $this->Email->send();
	}

	function _sendActivationMail($id){
		$site_url_courte = Configure::read("site_url_courte");
		$site_name =Configure::read("site_name");
		
		$u = $this->User->findById($id) ;
		$this->Email->reset();
		$this->Email->to = $u['User']['email'];
		$this->Email->subject = "Activation de votre compte ".$site_name ;
		$this->Email->from = $site_url_courte.' <ne-pas-repondre@'.$site_url_courte.'>';
        $this->Email->template = 'users/activation_mail';
        $this->Email->sendAs = 'html'; 
        $this->set('user', $u);
        $this->Email->send();
	}

	function  _code(){
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$code = '' ;
			while ($i < 10) {
					$num = rand() % 33;
					$tmp = substr($chars, $num, 1);
					$code = $code . $tmp;
					$i++;
			}
			return $code ;
	}
}