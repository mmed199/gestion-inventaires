<?php
class MembersController extends AppController {
	var $name = 'Members';
	var $components = array('Email','Session') ;
	function crypte_________() {
		$q = mysql_query("Select id,password FROM members") ; 
		while(	$member = mysql_fetch_assoc($q) ) {
			echo $member['password'] ."<br/>" ; 
			$crypted_password = $this->AppAuth->password( $member['password'] ) ; 
			echo $crypted_password."<br/>" ; 
			$member_id = $member['id'] ; 
			if( mysql_query("update members set password='$crypted_password' where id='$member_id' ") ) echo "ok" ;
			else echo "error" ; 
		}if (!$member) { 
			echo "not found" ;
			}
	}
//-------------------------------------------------------------------- Gestion d'inscription ---------------------------------------------------------------
	
	function inscription(){
		$site_name =Configure::read("site_name");
		$this->set ('page_title','Inscription ~ '.$site_name);
		//$pays = $this->Member->Country->find('list',array('fields'=>array('Country.id','Country.nom'),'conditions'=>'Country.active=1','order'=>'Country.nom asc'));
		// $villes = $this->Member->City->find('list',array('order'=>'City.nom asc'));
		// $this->set('pays',$pays);
		// $this->set('villes',$villes); 
		if($this->Session->check('Auth.Member.id') ) 
		   $this->redirect('/member') ;  
		if(!empty($this->data) ) {
			// print_r($this->data) ;
			$this->data['Member']['id'] = null ;
			// $this->data['Member']['logo'] = "Indisponible_user.png" ;
			// $this->data['Member']['tag_cgu'] = 0 ;
			// $this->data['Member']['absence_id '] = 0 ;
			$this->data['Member']['password'] = $this->AppAuth->password($this->data['Member']['password'] ) ;
			$this->data['Member']['activation_code'] = $this->_code() ;
			$this->data['Member']['created']  = date('Y-m-d H:i:s') ;
			if( $this->Member->save($this->data)  ) {
				//if($this->data["Member"]["tag_cgu"]==1) { //condition général d'utilisation
					$email_temp = $this->data['Member']['email'] ;
					$pass_temp = $this->data['Member']['password']  ;
					unset($this->data) ;
					//connection
					 $this->data['Member']['email'] = $email_temp ;
					 $this->data['Member']['password']  = $pass_temp ;
				     $this->AppAuth->login($this->data)  ;
					//send activation mail
					 $this->_sendActivationMail($this->Member->getLastInsertId()) ;
					 $this->data['Member']['email'] = $email_temp ;
					 $this->data['Member']['password']  = $pass_temp ;
					 $this->AppAuth->login($this->data)  ;
					 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Vous êtes bien inscrit sur le site. Veuillez activer votre compte via le lien envoyé par mail à cet adresse : " .$this->data['Member']['email'] ,
					"default",array('class'=>'alert alert-success','role'=>'alert'));
					 $this->redirect("/connexion.html") ;
					} 
					else{ 
						unset($this->data['Member']['password']) ;
						unset($this->data['Member']['repassword']) ;
						$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						<strong>ERREUR</strong> : Veuillez renseigner toutes les champs obligatoires.",
						"default",array('class'=>'alert alert-danger','role'=>'alert'));
					} 
			}
	}
	
		
	function connexion(){
		if($this->Session->check('Auth.Member.id') ) $this->redirect('/member') ;
		if(!empty($this->data)) {
			// print_r($this->data) ;
			$this->data['Member']['password'] = $this->AppAuth->password($this->data['Member']['password']) ; 
			$q = $this->Member->find('first',array('conditions'=>array(
																	'AND'=>array('Member.email'=>$this->data['Member']['email'] ,
																				 'Member.password'=>$this->data['Member']['password'])
																		) 
													) 
									)  ; 
			/*$q = $this->Member->find('first',array('conditions'=>array(
																	'AND'=>array(
																			'OR'=>array(
																						'Member.email'=>$this->data['Member']['email'] ,
																						'Member.username'=>$this->data['Member']['email']  
																				),
																			'Member.password'=>$this->data['Member']['password'] 
																	) )) )  ; */
			if(! empty( $q )  ){
				$this->Session->write('Auth.Member',$q['Member'] ) ; 
				$this->Member->id = $this->Session->read('Auth.Member.id') ;
				$this->data['Member']['d_d_con']  = date('Y-m-d H:i:s') ;
				$this->Member->save($this->data)  ;
				$this->redirect('/accueil.html') ;
			}else{
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Identifiant ou mot de passe incorrects.",
					"default",array('class'=>'alert alert-danger','role'=>'alert'));
				unset($this->data['Member']['password'] ) ;
			}		
		}
	}
	
	
	function logout(){
		$this->Session->destroy();
		$this->AppAuth->logout();
		$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
										  Vous avez été déconnecté avec succès.",'default',array('class'=>'alert alert-success' ) ) ;
		$this->redirect('/connexion.html');	
		
	}
	
	
			
	function recover(){
		//$this->layout = false; 
		if ($this->Session->check('Auth.Member') ) 
			$this->redirect('/');
		if (!empty($this->data))  {
		   $email = $this->data['Member']['email']  ;
		   $c = $this->Member->find('count', array(
					'conditions' => array('Member.email'=>$email)
						   ));
		   if ( $c == 0 ) {  
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
										Aucun compte associé à cette adresse mail.","default",array("class"=>"alert alert-error")) ;
			} 
		   else {
				$member = $this->Member->find('first', array(
													   'conditions' => array('Member.email'=>$email)
														   )
											);
				  // genereting  recover code 
				  $recover_code  = $this->_code() ;
				  // saving recover code in db 
				  $this->Member->id = $member['Member']['id'] ;
				  $this->Member->saveField('recover_code' , $recover_code) ;
				  // sending recover mail 
				  $this->_sendRecoverCodeMail($member['Member']['id']) ;
				  $this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
				  							Un lien a été envoyé à votre boîte mail pour réinitialiser votre mot de passe.","default",array("class"=>"alert alert-success")) ;
				//$this->redirect('/') ;
			}
		} 		
    }	
	
	
	function vfRecoverLink($member_id , $recover_code ){
	       if( ! empty( $member_id ) && !empty($recover_code) ) {
		            $q = $this->Member->findById( $member_id  );
					if( !empty($q) && $q['Member']['recover_code'] == $recover_code ) {
								$this->redirect('/members/reset_mot_passe/'.$member_id.'/'.$recover_code) ; 
			}
			$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
									  Le lien de récupération du mot de passe est incorrect." ,"default",array("class"=>"alert alert-error")) ;
			$this->redirect('/connexion.html') ; 
		}
	}
	
	
	function cancelRecoverLink($member_id , $recover_code ){
	       if( ! empty( $member_id ) && !empty($recover_code) ) {
		            $q = $this->Member->findById( $member_id  );
					if( !empty($q) && $q['Member']['recover_code'] == $recover_code ) {
								$this->Member->saveField('recover_code','') ;
								$this->Session->setFlash(" Merci,Le lien est annulé." ) ;
								$this->redirect('/') ; 
					}
			}  
			$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
										Le lien d'annulation est incorect." ,"default",array("class"=>"alert alert-error")) ;
		   $this->redirect('/') ; 
	}
	
	
	function reset_mot_passe($member_id=null , $recover_code=null){
		//if(!$this->Session->check('Recover.recover_code')) $this->redirect('/') ;
		$member_id=($member_id==null)?$this->data['member_id']:$member_id ;
		$recover_code=($recover_code==null)?$this->data['recover_code']:$recover_code ;
		if(!empty($this->data)) {
			$password = $this->data['Member']['password']  ;
			$repassword = $this->data['Member']['repassword']  ;			
		   if ( $password != $repassword ) {  
		   		$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
										Erreur ! La confirmation du mot de passe ne correspond pas.","default",array("class"=>"alert alert-error")) ;
			} else {
				$q = $this->Member->findById($member_id) ; 
				if( ! empty($q ) && $q['Member']['recover_code'] == $recover_code  ) {
						$this->Member->id = $q['Member']['id'] ; 
						$this->Member->saveField('password',$this->AppAuth->password($this->data['Member']['password']) ) ;
						$this->Member->saveField('recover_code','') ;
						$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
													Le mot de passe a été modifié avec succès.<br/> Vous pouvez maintenant se connecter avec votre nouveau mot de passe." ,"default",array("class"=>"alert alert-success")) ;
						$this->redirect('/connexion.html') ; 
				} else {
							$this->Session->setFlash("Une erreur est survenue lors du changement du mot de passe. Veuillez demander un nouveau lien de changement de mot de passe." ,"default",array("class"=>"alert alert-error")) ;
							$this->redirect('/mot-de-passe-oublie.html') ; 
				}
			}
		}
		$this->set('member_id',$member_id ) ; 
		$this->set('recover_code',$recover_code) ;  
	} 



// --------------------------------------------------------------------------------------- End gestion inscription ------------------------------------------------------------------------------------

	

//---------------------------------------------------------------------------------------------- Gestion Member --------------------------------------------------------------------------------------------
	
	function member_index() {
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
		// a refaire !!!
		$nbr_projet = count($member['Member']['projet_id']);
		$this->set ('nbr_projet',$nbr_projet);
		// a refaire !!!
		$nbr_tache = count($member['Member']['tache_id']);
		$this->set ('nbr_tache',$nbr_tache);
	}


// Gestion activités
    function member_activites() {

		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
				

	} 

	function member_dossiers() {

		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
				

	}


// Gestion RH
	function member_rh() {

		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
				

	}

	function member_absences() {
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
	}

	// Gestion des profils
	
	function member_profils() {

		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);

	}

	// Gestion des indemnités
	
	function member_indemnites() {

		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);

	}

	// Gestion de stocks
	
	function member_stocks() {

		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);

	}

	

	
	function member_home() {

		$site_name =Configure::read("site_name");
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
		
		
				
		$this->set ('page_title','Mon compte');
	}
	
		
	function member_profil (){
		$site_name =Configure::read("site_name");
		$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $this->Session->read('Auth.Member.id'))));
		/* $enfants = $this->_getMesEnfants($q['Member']['id'] )  ;
		$this->set('enfants' , $enfants) ; */
		$this->set ('member',$q);
		$this->set ('page_title','Mo profil');
	}
	
	function member_boutique (){//recuperer la boutique du membre
		$site_name =Configure::read("site_name");
		$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $this->Session->read('Auth.Member.id'))));
		$boutique = $this->_getMaBoutique($q['Member']['id'] )  ;
		$this->set('boutique' , $boutique) ;
		$this->set ('member',$q);
		$this->set ('page_title','Ma boutique | '.$site_name);	
	}
	
	function member_fermetures (){
		$site_name =Configure::read("site_name");
		$this->loadModel('Fermeture');
		$fermetures = $this->Fermeture->find('all',array('conditions'=>array("Fermeture.seller_id"=> $this->Session->read('Auth.Member.id'))));
		$this->set('fermetures' , $fermetures) ;
		$this->set ('page_title','Dates de fermeture de ma boutique | '.$site_name);		
	}
	
	
	
	function member_orders (){//recuperer la liste des commandes du membre
		$site_name =Configure::read("site_name");
		$this->loadModel('Order');
		$orders = $this->Order->find('all',array('conditions'=>array("Order.client_id"=> $this->Session->read('Auth.Member.id'))));
		$this->set('orders' , $orders) ;
		$this->set ('page_title','Mes commandes | '.$site_name);
	}
	
	function member_articles (){	//recuperer les articles du membre
		$site_name =Configure::read("site_name");
		$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $this->Session->read('Auth.Member.id'))));
		$articles = $this->_getMesArticles($q['Member']['id'] )  ;
		$this->set('articles' , $articles) ;
		$this->set ('member',$q);	
		$this->set ('page_title','Mes articles en ventes sur '.$site_name);
	}
	
	
	function member_bonsachats (){
		$site_name =Configure::read("site_name");
		$this->set ('page_title',"Mes bons d'achat | ".$site_name);		
		//recuperer la liste des bons d'achat
		
	}
	
	function member_bonachat_afficher ($id){
		$site_name =Configure::read("site_name");
		$this->set ('page_title',"Détail sur le bon d'achat | ".$site_name);
	
	}

	/*function member_annonces (){//listes de mes annonces
		$site_name =Configure::read("site_name");
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);
		// Demandes
		$this->loadModel ('Demande');
		$mes_demandes = $this->Demande->find('all',array('order'=>'Demande.created desc','conditions'=>array('Demande.demandeur_id'=>$member_id,'Demande.tag_offre' => 0 ,'Demande.deleted' => 0 ,'Demande.valide' => 1 ))) ; 
		$this->set ('mes_demandes',$mes_demandes); 
		// Offres
		$mes_offres = $this->Demande->find('all',array('order'=>'Demande.created desc','conditions'=>array('Demande.demandeur_id'=>$member_id,'Demande.tag_offre' => 1 ,'Demande.deleted' => 0,'Demande.valide' => 1))) ; 
		$this->set ('mes_offres',$mes_offres); 
			
		// Vacances
		$this->loadModel ('Vacance');
		$mes_vacances = $this->Vacance->find('all',array('order'=>'Vacance.created desc','conditions'=>array('Vacance.annonceur_id'=>$member_id,'Vacance.deleted' => 0,'Vacance.valide' => 1))) ; // mes dernieres emplois
		$this->set ('mes_vacances',$mes_vacances); 

		$this->set ('page_title','Mes annonces ~ '.$site_name);
	}*/

	function member_messages (){//listes de messages
		$site_name =Configure::read("site_name");
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);

		$this->loadModel ('Message');
		$messages_envoyes = $this->Message->find('all',array('order'=>'Message.date desc','conditions'=>array('Message.deleted'=>0,'Message.sender_id'=>$member_id))) ; 
		$this->set ('messages_envoyes',$messages_envoyes); 
		

		$this->set ('page_title','Messages ~ '.$site_name);
	}

	function member_favoris (){//listes de mes favoris
		$site_name =Configure::read("site_name");
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);

		$this->loadModel ('MemberFavori');
		$mes_favoris = $this->MemberFavori->find('all',array('order'=>'MemberFavori.created desc','conditions'=>array('MemberFavori.deleted'=>0,'MemberFavori.member_id'=>$member_id))) ; 
		$this->set ('mes_favoris',$mes_favoris); 
		

		$this->set ('page_title','Mes favoris ~ '.$site_name);
	}

	function member_parrainage (){
		$site_name =Configure::read("site_name");
		$member_id = $this->Session->read('Auth.Member.id');

		$member = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id)));
		$this->set ('member',$member);

		$this->loadModel ('Parrainage');
		$parrainages = $this->Parrainage->find('all',array('order'=>'Parrainage.date desc','conditions'=>array('Parrainage.member_id'=>$member_id))) ; 
		$this->set ('parrainages',$parrainages);

		$this->set ('page_title','Parrainage ~ '.$site_name);			
		
	}
	function member_editProfil(){
		if(!empty($this->data) ) {
			$this->data['Member']['id'] = $this->Session->read('Auth.Member.id') ;
			$date_naissance_En = date('Y/m/d',strtotime($this->data["Member"]["date_naissance"])); 
			$this->data["Member"]["date_naissance"] = $date_naissance_En;
			if($this->Member->save($this->data) )  {
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Vos informations a été modifiées avec succès.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));	
				$this->redirect("/mon-profil.html") ;
				}
		}else{
			$this->Member->id = $this->Session->read('Auth.Member.id')  ;
			$this->data = $this->Member->read();	
		}
		$villes = $this->Member->City->find('list',array('order'=>'City.nom asc'));
		$this->set('villes',$villes);
	}
	function member_edit_photo() {
		$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $this->Session->read('Auth.Member.id'))));
		$this->set ('member',$q);
		if(!empty($this->data) ) {
			$this->data['Member']['id'] = $this->Session->read('Auth.Member.id') ;
			if($this->Member->save($this->data) )  {
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					Votre logo a été modifié avec succès.","default",array('class'=>'alert alert-success'));	
				$this->redirect("/mon-profil.html") ;
				}
		}else{
			$this->Member->id = $this->Session->read('Auth.Member.id')  ;
			$this->data = $this->Member->read();	
		}
	}
	/*function verifier() {
		$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $this->Session->read('Auth.Member.id'))));
		$this->set ('member',$q);
		if(!empty($this->data) ) {
			$this->data['Member']['id'] = $this->Session->read('Auth.Member.id') ;
			if($this->Member->save($this->data) )  {
				$pro_id = $q['Member']['id'] ; 
				$this->__sendDemandeVerification($pro_id); 
				// verified = 2 : Pour signaler au Admin a vérifier la demande
				mysql_query("update members set verified = 2 where id=$pro_id" ) ;
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					Votre demande de vérification a bien été envoyée.","default",array('class'=>'alert alert-success'));	
				$this->redirect("/mon-profil.html") ;
				}
		}else{
			$this->Member->id = $this->Session->read('Auth.Member.id')  ;
			$this->data = $this->Member->read();	
		}
	}*/
	
	function member_modifier_mot_de_passe() {
		if(!empty($this->data)) {
			$this->Member->id = $this->Session->read('Auth.Member.id')  ;
			$q = $this->Member->read();
			if ( $this->AppAuth->password($this->data['Member']['old_password'] ) == $q['Member']['password']) { //si l'ancien mot de passe a été renseigné correctement
				$this->Member->id = $this->Session->read('Auth.Member.id')  ; 
				$this->Member->saveField('password',$this->AppAuth->password($this->data['Member']['password']) ) ;
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					Le mot de passe a été modifié avec succès." ,"default",array("class"=>"alert alert-success")) ;
				$this->redirect('/member/members/infos') ; 
			}else{			
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					L'ancien mot de passe est incorrect.","default",array("class"=>"alert alert-error")) ;
			}
		} 	
		
	}
	
	
	function member_ajouter_mot_username() {

	}
	
	
	function member_messages_recus (){
		$site_name =Configure::read("site_name");
		$this->loadModel('Message');
		$messages = $this->Message->find('all',array('conditions'=>array("Message.receiver_id"=> $this->Session->read('Auth.Member.id'))));
		$this->set('messages' , $messages) ;
		$this->set ('page_title','Mes messages : messages recus | '.$site_name);
	}
	
	function member_messages_envoyes() {
		$site_name =Configure::read("site_name");
		$this->loadModel('Message');
		$messages = $this->Message->find('all',array('conditions'=>array("Message.sender_id"=> $this->Session->read('Auth.Member.id'))));
		$this->set('messages' , $messages) ;
		$this->set ('page_title','Mes messages : messages envoyés | '.$site_name);
	}
	
// ------------------------------------------------------------------------------------------ Admin ---------------------------------------------------------------------------------------------------
	function admin_index (){
		$this->paginate = array(
								"conditions" => "Member.deleted = 0",
								/*'recursive'=>2,*/
								'limit' => 50,
								"order" => "Member.id desc"
								) ; 
		$this->set('members',$this->paginate('Member') );
		$this->set('balise_h1','Gestion des membres');
		$this->set('page_title','Gestion des membres');
	}
	
	/*function admin_afficher ($id){
		$q = $this->Member->findById($id);
		$this->set('member',$q );
		$this->set('balise_h1','Informations sur le membre');
		$this->set('page_title','Informations sur le membre');
		$this->loadModel('Demande') ;
		
		$this->paginate = array('limit' => 50,
								'conditions'=>'Demande.deleted = 0 and Demande.demandeur_id = ' .$q['Member']['id']
									) ;
	
		$q =  $this->paginate('Demande') ;
		$this->set ('demandes',$q);
	}*/

	function admin_ajouter(){
		if(isset($this->data)){
			$this->data['Member']['id'] = $this->Member->id ;	
			$this->data['Member']['tag_cgu'] = 1 ;
			$this->data['Member']['password'] = "0000" ;
			$this->data['Member']['repassword'] = "0000"  ;
			$this->data['Member']['confirmed'] = 1 ;
			$this->data['Member']['created']  = date('Y-m-d H:i:s') ;
			if( $this->Member->save($this->data) ){
				//pr($this->data);
				$this->Session->setFlash("Le membre a été ajouté avec succès.","default",array('class'=>'valid_box'));	
                $this->redirect("index") ;
			}else{
				//pr ($this->data);
					$this->Session->setFlash("Une erreur a été rencontrée lors de l'ajout du membre.","default",array('class'=>'error_box'));	                		
			}
        }
		$this->set('villes',$this->Member->City->find('list',array('order'=>'City.nom asc')));
	}

	function admin_modifier($id){
		$q= $this->Member->findById($id) ; 
		$this->set('member',$q)  ;	
		if(isset($this->data)){
			$member_id =  $this->Member->save($this->data) ;
			$this->data['Member']['logo'] = null;	
			if($member_id) {
			   $this->Session->setFlash("Le member a été modifié avec succès.","default",array('class'=>'valid_box'));	
			   // $this->redirect('index') ;
			   $this->redirect($this->referer()) ;
			   }
			
		}else $this->data = $this->Member->read(array(),$id) ;
			  $this->set('villes',$this->Member->City->find('list',array('order'=>'City.nom asc')));
	}	
	function admin_delete($id){
		if($this->Member->delete($id)) {
		   $this->Session->setFlash("Le member a été supprimé avec succès","default",array('class'=>'valid_box'));	
			$this->redirect($this->referer());
		}
		else {
		   $this->Session->setFlash("Une erreur est rencontrée lors de la suppression de member","default",array('class'=>'error_box'));	
		   $this->redirect($this->referer()) ;
		   }
		}
	
	function admin_rechercher() {
		if( !empty($this->data) ) {
			$query = $this->data['Member']['query'] ;
			$this->paginate = array('conditions'=>array('or'=>array(
																'Member.nom like '=>'%'.$query.'%',
																'Member.prenom like '=>'%'.$query.'%',
																'Member.username like '=>'%'.$query.'%',
																'Member.type_compte like '=>'%'.$query.'%',
																'Member.ville like '=>'%'.$query.'%',
																'Member.email like '=>'%'.$query.'%',
																'Member.id like '=>'%'.$query.'%'
																)
														),
									 'limit' => 30,
									 'order' => 'Member.id desc' 
									) ;
		}
		$q = $this->paginate('Member') ; 
		$this->set('members', $q ) ; 
		$this->set('balise_h1',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ;
		
	}

	function admin_activer($id){ 
		if($id!=null){
		    $this->Member->id = $id ;
            if($this->Member->saveField('active',1) ) {
			   $this->Session->setFlash("Le member a été activé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de l'activation du membre." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}

    
	function admin_desactiver($id) {
		if($id!=null){
			$this->Member->id = $id;
			if($this->Member->saveField('active',0) ) {
				$this->Session->setFlash("Le member a été désactivé avec succès." ,"default",array('class'=>'valid_box'));
				//
			 } ; 
			$this->redirect($this->referer()) ;
		}
	}


	function admin_verifier($id){ 
		if($id!=null){
		    $this->Member->id = $id ;
            if($this->Member->saveField('verified',1) ) {
			   $this->Session->setFlash("Le professionnel a été publié maintenant avec la signe 'Vérifié'." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Erreur!" ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}

	function admin_non_verifier($id){ 
		if($id!=null){
		    $this->Member->id = $id ;
            if($this->Member->saveField('verified',0) ) {
			   $this->Session->setFlash("Le professionnel a été publié maintenant sans la signe 'Vérifié'." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Erreur!" ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}


	

	
// ------------------------------------------------------------------------------------------------------- Local ---------------------------------------------------------------------------------------

	function confirmer($member_id = null) {
	    $this->Member->id = $member_id;
		if ($this->Member->exists())
		{
			// Update the active flag in the database
			$this->Member->saveField('confirmed', 1);

			// Let the Member know they can now log in!
			$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Votre compte a été activé, vous pouvez maintenant vous connecter ci-dessous",
					"default",array('class'=>'alert alert-success','role'=>'alert'));
			$this->redirect("/connexion.html") ;
		}

		// Activation failed, render '/views/members/confirmer.ctp' which should tell the user.
	}

	/*function __sendDemande($devis_id){
		if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$this->loadModel('Devi') ; 
			$demande_devis = $this->Devi->findById( $devis_id ) ;
			$pro_id = $this->Member->id ;
			$pro = $this->Member->find ('first',array('conditions'=>"Member.id = ".$pro_id));
			$email_demandeur_devi = $demande_devis['Devi']['email'];
			$pro_name = $pro['Member']['nom'] ;
			//Création de l'email
			//pr($pro_name);
			$this->Email->charset  = 'UTF-8';
			$this->Email->to = $pro['Member']['email'];
			$this->Email->subject = "[ Services4all ] Demande de devis";			
			$this->Email->from = 'Services4all <noreply@services4all.ma>';
			$this->Email->replyTo = $site_contact ; 
			$this->Email->template = 'professionnels/demande_devis'; 
			//$this->Email->lineLength = 60;
			$this->Email->sendAs = 'html';
			$this->set('demande_devis', $demande_devis );
			$this->set('pro', $pro );
			$this->set('email_demandeur_devi', $email_demandeur_devi );
			$this->set('pro_name', $pro_name );
			$this->Email->send() ;	
		}
	}
	function __sendDemandeVerification($pro_id){
		if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$site_contact_cc = Configure::read('site_contact_cc');
			$member = $this->Member->findById($pro_id) ;
			//Création de l'email
			//pr($member);
			$this->Email->charset  = 'UTF-8';
			$this->Email->to = $site_contact_cc; //site_contact
			//$this->Email->replyTo = $site_contact_cc ; 
			$this->Email->subject = "[ Services4all ] Demande de vérification de la société";			
			$this->Email->from = $member['Member']['email'];
			$this->Email->template = 'professionnels/verifier'; 
			//$this->Email->lineLength = 60;
			$this->Email->sendAs = 'html';
			$this->set('member', $member );
			$this->Email->send() ;	
		}
	}
*/

	function _sendRecoverCodeMail($id){
		$site_url_courte = Configure::read("site_url_courte");
		$site_name =Configure::read("site_name");

		$m = $this->Member->findById($id) ;
		$this->Email->reset();
		$this->Email->to = $m['Member']['email'];
		$this->Email->subject = "Votre mot de passe ".$site_name ;
		$this->Email->from = $site_url_courte.' <ne-pas-repondre@'.$site_url_courte.'>';
        $this->Email->template = 'members/recover_mail';
        $this->Email->sendAs = 'html'; 
        $this->set('member', $m);
        $this->Email->send();
	}
	function _sendActivationMail($id){
		$site_url_courte = Configure::read("site_url_courte");
		$site_name =Configure::read("site_name");
		
		$m = $this->Member->findById($id) ;
		$this->Email->reset();
		$this->Email->to = $m['Member']['email'];
		$this->Email->subject = "Activation de votre compte ".$site_name ;
		$this->Email->from = $site_url_courte.' <ne-pas-repondre@'.$site_url_courte.'>';
        $this->Email->template = 'members/activation_mail';
        $this->Email->sendAs = 'html'; 
        $this->set('member', $m);
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