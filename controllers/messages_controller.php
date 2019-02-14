<?php 
class MessagesController extends AppController {
    var $name ="Messages";
	var $components = array('Email',"RequestHandler","Session");
	var $helpers = array('Html', 'Form','Cksource'); 
	var $paginate = array(
						'limit' => 20,
						'order' => array(
							'Message.date' => 'desc'
							)
					);
							
//----------------------------------------------------- Member -----------------------------------------------	
	
	function member_creer() {
		if (!empty($this->data)) {
			$this->data['Message']['sender_id'] = $this->Session->read('Auth.Member.id') ; //'lhiadi.redouane@gmail.com'; 
			if ($this->Message->save($this->data)) {
				if ($this->data['Message']['sender_id']){}
					$this->_sendMessageMember( $this->Message->getLastInsertId() ) ; 
					$this->Session->setFlash("Votre message a été envoyé avec succès.","default",array('class'=>'valid_box'));	
					$this->redirect("/member/members/messages_recus" ) ;
			}
		}
	}
	
	function member_afficher_recu($id) {
		$q = $this->Message->findById($id) ;
		$this->set('message',$q);
	}
	
	function member_afficher_envoye($id) {
		$q = $this->Message->findById($id) ;
		$this->set('message',$q);
	}
	
	function member_delete() {
		if($this->Message->delete($id)) {
			   $this->Session->setFlash("Le message a été supprimé avec succès.","default",array('class'=>'valid_box'));	
 	    }
		else {
			  $this->Session->setFlash("Erreur lors de la suppression du message.","default",array('class'=>'error_box'));	
		}
		$this->redirect('/member') ;
	}
	
	function _sendMessageMember($message_id){
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Message->findById($message_id) ;
		$this->Email->to = $q['Receiver']['email'] ; //'lhiadi.redouane@gmail.com' ;
		$this->Email->subject = $q['Message']['objet'];
		$this->Email->from = "Services4all.ma <$site_contact>";
		$this->Email->template = 'messages/message_member'; 
		$this->Email->sendAs = 'html';
		$this->set('message', $q) ;				  
		$this->Email->send();
	}
//----------------------------------------------------------------------------------------------------		
	function contact() {
        if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$site_contact_cc = Configure::read('site_contact_cc');
			$this->Email->from =  'services4all.ma <ne-pas-repondre@services4all.ma>'; // $this->data['Message']['email'];
			//$this->Email->replyTo = $this->data['Message']['email'] ;
			$this->Email->to      = "lhiadi.redouane@gmail.com";//$site_contact ; 
			$this->Email->cci      = $site_contact_cc;
			$this->Email->subject = "[Services4all] Message depuis le formulaire contact : ".$this->data['Message']['objet'] ;
			$this->Email->template = 'messages/contact';
			$this->Email->sendAs = 'html' ;
			$this->set('message', $this->data ) ;
			if ($this->Message->save($this->data)) {
				//$this->render("message_envoye");	
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					 						    <strong>Message envoyé</strong><br> Votre message a été transmis à notre équipe, nous donnerons suite à votre demande dans les plus brefs délais","default",array("class"=>"alert alert-success")) ;		
				$this->Email->send();
				$this->redirect('/contact.html') ;	
			}else{
				$this->Session->setFlash("<button type='button' class='close' data-dismiss='alert'>&times;</button>
					 					ERREUR : Veuillez renseigner toutes les champs obligatoires.","default",array("class"=>"alert alert-error")) ;
			}
		}
    }
	
	function joindre() {
        if (!empty($this->data)) {
			$this->data['Message']['objet'] = "[ Services4all ] Nous rejoindre" ;
		     if ($this->Message->save($this->data)) {
					$site_contact = Configure::read('site_contact');
					$site_contact_cc = Configure::read('site_contact_cc');
					$this->data=  $this->Message->findById($this->Message->getLastInsertId() ) ;
					  //$this->data['Message']['user_id'] = 7 ;
					  $this->Email->from =  'services4all.ma <ne-pas-repondre@services4all.ma>';  //<$this->data['Message']['email'];
					  //$this->Email->replyTo = $this->data['Message']['email'] ;
					  //$this->Email->to      = 'lhiadi.redouane@gmail.com';
					  $this->Email->to      = $site_contact ; 
					  $this->Email->cci      = $site_contact_cc;
					  $this->Email->subject = "[ Services4all ] Nous rejoindre" ;
					  $this->Email->template = '/messages/demande_joindre';
					  $this->Email->sendAs = 'html' ; 
					  if(!empty($this->data['Message']['document'] )) 
							$this->Email->attachments = array(APP. '/webroot/uploads/messages/'.$this->data['Message']['document']);
					  $this->set('message', $this->data['Message']) ;
					  //$this->Email->send();
				
					$langCode = Configure::read('Config.langCode');	
					if ($langCode == "fr"){
						$this->Session->setFlash('Nous avons bien reçu votre message. Notre équipe prendra contact avec vous très rapidement.','default',array('class'=>'valid_box'));	
						$this->Email->send();
					}else{
						$this->Session->setFlash('We have received your message. Our team will contact you shortly.','default',array('class'=>'valid_box'));	
						$this->Email->send();
					}
					$this->render("joindre") ;

			}
        }
    }
// ------------------------------------------  Mod -------------------------------------------
	function mod_index(){
	    $this->paginate = array(
						'conditions'=>array('type'=>0) , // 0 les message recu
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
			       );
		$q = $this->paginate('Message') ;
		$this->set('messages',$q);
	}
	function mod_recus(){
	    $this->paginate = array(
						'conditions'=>array('type'=>0) , // 0 les message recu
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
			       );
		$q = $this->paginate('Message') ;
		$this->set('messages',$q);
	}
		
	function mod_envoyes(){
		$this->paginate = array(
						'conditions'=>array('type'=>1) , // 1 les message envoyé
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
	       );
		$q = $this->paginate('Message') ;
	    $this->set('messages',$q);
	}
		
	function mod_afficher($id){
		$q = $this->Message->findById($id) ;
        $this->set('message',$q); 
		if($q['Message']['lu'] == 0 ) $this->Message->saveField('lu',1) ; 
		if($q['Message']['type'] == 1 ) $this->render('mod_afficherEnvoye') ; 
    }
	function mod_nouveau() {
        if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$site_contact_cc = Configure::read('site_contact_cc');
			$this->Email->from = "services4all.ma <$site_contact>";
			$this->Email->replyTo = 'lhiadi.redouane@gmail.com' ;
			$this->Email->to      = $this->data['Receiver']['email'];
			$this->Email->subject = $this->data['Message']['objet'];
			$this->Email->template = 'messages/mod_nouveau';
			$this->Email->sendAs = 'html' ;
            $this->set('message', $this->data) ;			  
			$this->Email->send();   
			$this->data['Message']['type'] = 1 ; //type  envoyé
			$this->data['Message']['user_id'] = 55 ;
            if ($this->Message->save($this->data)) {
                    $this->Session->setFlash("<h1>Message envoyé</h1>Votre message a été envoyé.");
					$this->redirect('envoyes') ;
            }
        }
    }
		
	function mod_repondre($id) {
		$q = $this->Message->findById($id) ;
		$this->set('message',$q); 
	}
		
	function mod_repondre_valider (){
		if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$site_contact_cc = Configure::read('site_contact_cc');
			$this->Email->from = "services4all.ma <$site_contact>'";
			//$this->Email->replyTo = 'lhiadi.redouane@gmail.com' ;
			$this->Email->to      = $this->data['Receiver']['email'];
			$this->Email->subject = $this->data['Message']['objet'];
			$this->Email->template = 'messages/mod_simple';
			$this->Email->sendAs = 'html' ;
			$this->set('message', $this->data) ;
			$this->Email->send();   
			$this->data['Message']['type'] = 1 ; //type  envoyé
			$this->data['Message']['user_id'] = 55 ;
            if ($this->Message->save($this->data))
					$this->Session->setFlash("Votre message a été envoyé avec succès.","default",array('class'=>'valid_box'));
			else
					$this->Session->setFlash("Erreur lors de la suppression du témoignage du client.","default",array('class'=>'error_box'));	
			$this->redirect('envoyes') ;
        }
	}

	function mod_delete($id=null) {
   		if($this->Message->delete($id)) {
			   $this->Session->setFlash("Le message a été supprimé avec succès.","default",array('class'=>'valid_box'));	
 	    }
		else {
			  $this->Session->setFlash("Erreur lors de la suppression du message.","default",array('class'=>'error_box'));	
		}
		$this->redirect($this->referer()) ;
    }
	
	function mod_delete_envoye($id=null) {
    	if($this->Message->delete($id)) {
			$this->Session->setFlash("Le message a été supprimé avec succès.","default",array('class'=>'valid_box'));	
			$this->redirect('envoyes') ;
		}
		else {
			$this->Session->setFlash("Erreur lors de la suppression du message.","default",array('class'=>'error_box'));	
			$this->redirect('envoyes') ;
	   }
    }
	
// ------------------------------------------  Admin -------------------------------------------
	function admin_index(){
	    $this->paginate = array(
						'conditions'=>array('type'=>0) , // 0 les message recu
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
			       );
		$q = $this->paginate('Message') ;
		$this->set('messages',$q);
		$this->set ('balise_h1','Liste des messages');
		$this->set ('page_title','Liste des messages');
		
	}
	function admin_recus(){
	    $this->paginate = array(
						'conditions'=>array('type'=>0) , // 0 les message recu
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
			       );
		$q = $this->paginate('Message') ;
		$this->set('messages',$q);
		$this->set ('balise_h1','Messages reçus (Contact)');
		$this->set ('page_title','Messages reçus (Contact)');
		$this->render ('admin_index');
	}
		
	function admin_envoyes(){
		$this->paginate = array(
						'conditions'=>array('type'=>1) , // 1 les message envoyé
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
	       );
		$q = $this->paginate('Message') ;
	    $this->set('messages',$q);
		$this->set ('page_title','Liste des message envoyés');
		$this->set ('balise_h1','Liste des message envoyés');
		$this->render ('admin_index');
	}
	
	function admin_non_lus() {
		$this->paginate = array(
						'conditions'=>array('type'=>0,'Message.lu'=>0) , // 0 les message recu
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
			       );
		$q = $this->paginate('Message') ;
		$this->set('messages',$q);
		$this->set ('page_title','Liste des message reçus non lus');
		$this->set ('balise_h1','Liste des message reçus non lus');
		$this->render ('admin_index');
	}
	
	
	function admin_non_repondus() {
		$this->paginate = array(
						'conditions'=>array('type'=>0,'Message.repondu'=>0) , // 0 les message recu
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'
						)
			       );
		$q = $this->paginate('Message') ;
		$this->set('messages',$q);
		$this->set ('page_title','Liste des message non répondus');
		$this->set ('balise_h1','Liste des message non répondus');
		$this->render ('admin_index');
	}
	
	
	
	function admin_afficher($id){
		$q = $this->Message->findById($id) ;
        $this->set('message',$q); 
		if($q['Message']['lu'] == 0 ) $this->Message->saveField('lu',1) ; 
		if($q['Message']['type'] == 1 ) $this->render('admin_afficherEnvoye') ; 
		$this->set ('page_title','Détail du message');
    }
	function admin_nouveau() {
        if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$site_contact_cc = Configure::read('site_contact_cc');
			$this->Email->from = "services4all.ma <$site_contact>'";
			//$this->Email->replyTo = 'lhiadi.redouane@gmail.com' ;
			$this->Email->to      = $this->data['Message']['email'];
			$this->Email->subject = $this->data['Message']['objet'];
			$this->Email->template = 'messages/admin_nouveau';
			$this->Email->sendAs = 'html' ;
            $this->set('message', $this->data) ;			  
			$this->Email->send();   
			$this->data['Message']['type'] = 1 ; //type  envoyé
			$this->data['Message']['user_id'] = 55 ;
            if ($this->Message->save($this->data)) {
                    $this->Session->setFlash("Votre message a été envoyé.","default",array('class'=>'valid_box'));
					$this->redirect('envoyes') ;
            }
        }
		$this->set ('page_title','Envoyer un message');
    }
		
	function admin_repondre($id) {
		$q = $this->Message->findById($id) ;
		$this->set('message',$q); 
		$this->set ('page_title','Répondre au message');
	}
		
	function admin_repondre_valider (){
		if (!empty($this->data)) {
			$site_contact = Configure::read('site_contact');
			$site_contact_cc = Configure::read('site_contact_cc');
			$this->Email->from = "services4all.ma <$site_contact>'";
			//$this->Email->replyTo = 'lhiadi.redouane@gmail.com' ;
			$this->Email->to      = $this->data['Message']['email'];
			$this->Email->subject = $this->data['Message']['objet'];
			$this->Email->template = 'messages/admin_simple';
			$this->Email->sendAs = 'html' ;
			$this->set('message', $this->data) ;
			$this->Email->send();   
			$this->data['Message']['type'] = 1 ; //type  envoyé
			$this->data['Message']['user_id'] = 55 ;
            if ($this->Message->save($this->data))
					$this->Session->setFlash("Votre message a été envoyé avec succès.","default",array('class'=>'valid_box'));
			else
					$this->Session->setFlash("Erreur lors de la suppression du témoignage du client.","default",array('class'=>'error_box'));	
			$this->redirect('envoyes') ;
        }
	}

	function admin_delete($id=null) {
   		if($this->Message->delete($id)) {
			$this->Session->setFlash("Le message a été supprimé avec succès.","default",array('class'=>'valid_box'));
			$this->redirect($this->referer()) ;	
		}else {
			$this->Session->setFlash("Erreur lors de la suppression du message.","default",array('class'=>'error_box'));	
			$this->redirect($this->referer()) ;	
		}		
    }
	
	function admin_delete_envoye($id=null) {
    	if($this->Message->delete($id)) {
			$this->Session->setFlash("Le message a été supprimé avec succès.","default",array('class'=>'valid_box'));	
			$this->redirect('envoyes') ;
		}
		else {
			$this->Session->setFlash("Erreur lors de la suppression du message.","default",array('class'=>'error_box'));	
			$this->redirect('envoyes') ;
	   }
    }
	function admin_member_recus($member_id) {
		$member = $this->Message->findById($member_id) ;
		$this->paginate = array(
						'conditions'=>array('Message.seller'=>$member_id,
											'type'=>0) , // 0 les messages reçus
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'));
		$this->set('messages',$this->paginate('Message')) ;
		$this->render('admin_index');
	}
	function admin_member_envoyes($member_id) {
		$member = $this->Message->findById($member_id) ;
		$this->paginate = array(
						'conditions'=>array('Message.seller'=>$member_id,
											'type'=>1) , // 1 les messages envoyés
						'limit' => 20,
						'order' => array(
						'Message.date' => 'desc'));
		$this->set('messages',$this->paginate('Message')) ;
		$this->render('admin_index');
	}

}