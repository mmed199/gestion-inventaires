<?php
    class AbonnesController extends AppController{
        var $name ="Abonnes";
		var $components = array('RequestHandler','Email');
		var $paginate = array(
							'limit' => 30,
							'order' => array(
							'Abonne.date_inscription' => 'desc'
			)
		);
		
		function admin_index(){ 
		   $this->paginate['conditions']["Abonne.deleted"] =  0 ;
	       $q = $this->paginate('Abonne') ; 
		   $this->set('abonnes',$q) ;
        }
		
			
	function admin_rechercher() {
		if( !empty($this->data) ) {
			$query = $this->data['Abonne']['query'] ;
			$this->paginate = array('conditions'=>array(
													'or'=>array(
															'Abonne.nom like '=>'%'.$query.'%',
															'Abonne.prenom like '=>'%'.$query.'%',
															'Abonne.email like '=>'%'.$query.'%',
															'Abonne.ville like '=>'%'.$query.'%',
															'Abonne.id like '=>'%'.$query.'%'
															)
													), 
								 'limit' => 30,
								 'order' => 'Abonne.id desc' 
								) ;
		}else  $this->paginate = array( 
								 'limit' => 30,
								 'order' => 'Abonne.id desc' 
								) ;
		$q = $this->paginate('Abonne') ; 
		$this->set('abonnes', $q ) ;
		$this->set('balise_h1',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
	
    function inscriptionRapide(){
		 if($this->RequestHandler->isAjax()){
			   $this->layout = 'ajax';
			   Configure::write('debug',0);
			} 
		 if (!empty($this->data)) { 
			$this->data['Abonne']['activation_code'] = $this->_code() ;
			$this->data['Abonne']['ip'] = $_SERVER['REMOTE_ADDR'] ;
			 if($this->Abonne->save($this->data)  )  {
			 $new_abonne_id = $this->Abonne->getLastInsertId() ;
			 $this->_sendActivationMail($new_abonne_id) ;
			 $this->Session->setFlash("Nous avons bien reçu votre demande d’inscription à notre newsletter et nous vous en remercions.<br/>
										Un message a été envoyé à votre adresse e-mail.<br/>
										Votre inscription ne sera effective qu’après avoir cliqué sur le lien contenu dans cet e-mail.<br/>
										Merci et à bientôt !","default",array('class'=>'alert alert alert-success'));
			 
			 } else $this->Session->setFlash("Erreur : base de données","default",array('class'=>'alert alert-error')) ;
			 $this->redirect('/newsletter.html');
		}
		$this->render('inscription') ; 
    }

    function inscription(){
	     if($this->RequestHandler->isAjax()){
               $this->layout = 'ajax';
               Configure::write('debug',0);
            }
         if(isset($this->data)){
		    $this->data['Abonne']['activation_code'] = $this->_code() ;
			$this->data['Abonne']['ip'] = $_SERVER['REMOTE_ADDR'] ;
             if($this->Abonne->save($this->data)  )  {
			 $new_abonne_id = $this->Abonne->getLastInsertId() ;
			 $this->_sendActivationMail($new_abonne_id) ;
			 $this->Session->setFlash("Nous avons bien reçu votre demande d’inscription à notre newsletter et nous vous en remercions.<br/>
										Un message a été envoyé à votre adresse e-mail.<br/>
										Votre inscription ne sera effective qu’après avoir cliqué sur le lien contenu dans cet e-mail.<br/>
										Merci et à bientôt !","default",array('class'=>'alert alert alert-success'));
			 
			 } else $this->Session->setFlash("Erreur : base de données","default",array('class'=>'alert alert-error')) ;
			 $this->redirect($this->referer());
            }
    }
	

	function desinscription($id ,$activation_code){
		$this->data = $this->Abonne->findById($id) ;
		if( !empty($this->data) ) {
		   if( $this->data['Abonne']['activation_code'] == $activation_code  ) {
					$this->Abonne->id = $this->data['Abonne']['id'] ;
					$this->Abonne->saveField('statut', 0);
					$this->flash("Vous êtes bien désinscrit à la newsletters","/") ;
		   } else $this->flash("Le code  est incorecte.","/") ;
		} else $this->flash("Abonne non-trouvé. ","/") ;
	}
	
	function admin_inscrire($id){
		$this->Abonne->id = $id;
		if( $this->Abonne->saveField('statut', 1) ){
				
			   $this->Session->setFlash("L'abonnée a été bien inscrit à la newsletter.","default",array('class'=>'valid_box'));	
			   $this->redirect('index') ;
			 };
		$this->redirect("index")  ;

	}
	
	function admin_ajouter(){
		if( !empty($this->data) ) {
				$this->data['Abonne']['statut'] = 1;
			   if( $this->Abonne->save($this->data) ){
					
					$this->Session->setFlash("L'abonnée a été  ajouté.","default",array('class'=>'valid_box'));	
					$this->redirect('index') ;
			 };
		} ;
	}
		
	function admin_modifier($id){
		if(!isset($this->data)){
			  $this->Abonne->id = $id ;
			  $this->data = $this->Abonne->read() ;
			  $this->set("abonne", $this->data['Abonne']  ) ;
		}else{
			if( $this->Abonne->save($this->data) ) 
				$this->Session->setFlash("L'abonné a été modifié avec succès.","default",array('class'=>'valid_box'));	
			else 
				$this->Session->setFlash("Erreur lors de la modification de l'abonné au newsletter.","default",array('class'=>'error_box'));	
			$this->redirect('index') ;
			
		}
	}
	
	function admin_desinscrire($id){
		$this->Abonne->id = $id;
		//var $paginate = array('limit' => 30	);
		if( $this->Abonne->saveField('statut', 0) ){
			   $this->Session->setFlash("L'abonnée a été  désinscrit à la newsletter.","default",array('class'=>'valid_box'));	
			   $this->redirect('index') ;
			 };
		$this->redirect("index")  ;
	}
	
		
	function activer( $id , $activation_code ) {
		$this->data = $this->Abonne->findById($id) ;
		if( !empty($this->data) ) {
		   if( $this->data['Abonne']['statut'] == 0  ) {
				if( $this->data['Abonne']['activation_code'] == $activation_code  ) {
						$this->Abonne->id = $this->data['Abonne']['id'] ;
						$this->Abonne->saveField('statut', 1);
						$this->flash("Votre abonnement est activé","/") ;
				} else $this->flash("Le code d'activation est incorecte.","/") ;
			} else $this->flash("L'abonnement a déjà été activé.","/") ;
		} else $this->flash("Abonne non-trouvé. ","/") ;
	  }
	function admin_delete($id=null) {
    		if($this->Abonne->saveField('deleted',1) ) {
				   $this->Session->setFlash("L'abonné a été supprimé","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				   }
			else {
				   $this->Session->setFlash("Error to delete abonne, Maybe the abonne was already deleted","default",array('class'=>'error_box'));	
				   $this->redirect('index') ;
				   }
    }
	
	function _code(){
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
   function _sendActivationMail($id) {
   
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		
		$abonne = $this->Abonne->findById($id) ;
		$this->Email->to = $abonne['Abonne']['email'] ;
		$this->Email->subject = '['.$site_name.'] Validez votre inscription Newsletter'  ;
		$this->Email->replyTo = $site_contact ;
		$this->Email->from = $site_name.' <'.$site_contact.'>';
		$this->Email->template = 'abonnes/activation_mail'; // note no '.ctp'
			  //Send as 'html', 'text' or 'both' (default is 'text') 
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
			  //Set view variables as normal
		$this->set('abonne', $abonne);
			  //Do not pass any args to send()
		$this->Email->send();
	 }
	function _sendConfirmationMail($id) {
	
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		
		$abonne = $this->Abonne->findById($id) ;
		$this->Email->to = $abonne['Abonne']['email'] ;
		$this->Email->subject = '['.$site_name.'] Inscription à la newsletter '.$site_name ;
		$this->Email->replyTo = $site_contact ;
		$this->Email->from = $site_name.' <'.$site_contact.'>';
		$this->Email->template = 'abonnes/confirmation_inscription'; // note no '.ctp'
			  //Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
			  //Set view variables as normal
		$this->set('abonne', $abonne);
			  //Do not pass any args to send()
		$this->Email->send();
	 }
}
	
	
	
	
?>