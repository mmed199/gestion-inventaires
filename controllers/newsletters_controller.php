<?php
class NewslettersController extends AppController{
    var $name = "Newsletters";
	var $components = array('Email') ;
    var $helpers = array('Html', 'Form', 'Javascript', 'Cksource'); 
	var $paginate = array( 
						'limit' => 10,
						'order' => array(
						'Newsletter.id' => 'desc'
						));
					
	/* function inscription() {
		$this->set ("page_title", "Avantages pour abonnés newsletter Kidsdressing");		
	} */
	
	
	function admin_send(){
		$q = $this->Newsletter->find('first',array(
										'conditions'=>array('Newsletter.statut = 1'),
										'order'=>'last_sent_time asc'
							)) ;
			if(!empty($q) ) {
				$this->_send($q['Newsletter']['id']) ;
				echo 1 ;
			}else echo 0 ;
		$this->layout = $this->autoRender = false ;
	}
    function admin_index(){
	     $this->set('newsletters' , $this->paginate('Newsletter') ) ;
    }
	function admin_new(){
		if(isset($this->data)){
	      // sauvegarde de la newsletter
	      if( $this->Newsletter->save($this->data ) ) 
		  		     	$this->Session->setFlash("La newsletter a été crée avec succès.","default",array('class'=>'valid_box'));		
				$this->redirect('index') ;
		}
	 }
	 
	function admin_modifier($id){
	   if(isset($this->data)){
	      // sauvegarde de la newsletter
			$this->data['Newsletter']['statut'] = 0;
	       if( $this->Newsletter->save($this->data ) ){   	  
		     	$this->Session->setFlash("La newsletter a été modifiée avec succès.","default",array('class'=>'valid_box'));	
				$this->redirect('index') ;
				}
		  }
	    else {
		  $this->data = $this->Newsletter->read(array(),$id) ; 
	    }
	 }
	
	function admin_envoyer_admin ($id){
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		
		$this->_sendToAdmin ($id,$site_contact,$site_contact_cc);
		  
	}
	
	
	 
	function admin_play($id) {
		$this->Newsletter->id = $id; 
		if($this->Newsletter->saveField('statut',1)){
				$this->Session->setFlash("L'envoi de la newsletter est activé","default",array('class'=>'valid_box'));	
				$this->redirect('index') ;  
		}
	}
	function admin_pause($id) {
		$this->Newsletter->id = $id; 
		if($this->Newsletter->saveField('statut',0)){
				$this->Session->setFlash("L'envoi de la newsletter est désactivé","default",array('class'=>'valid_box'));	
				$this->redirect('index') ;  
		}
	}
	function admin_delete($id=null){
            if($id!=null){
                $this->Newsletter->delete($id);
                $this->Session->setFlash("La newsletter a été supprimée avec succès.","default",array('class'=>'valid_box'));
                $this->redirect('index');
			}
    }
//----------------------------------  Local -----------------------------------------
	function _send($id){
	    // sauvegarde de la newsletter
		$this->Newsletter->id =$id ;
	    $this->data = $this->Newsletter->read()  ; 
		// l'envoie de la newsletter 
		$this->loadModel("Abonne") ;
		$q =  mysql_query("SELECT abonne_id FROM abonnes_newsletters where newsletter_id=$id order by abonne_id desc limit 1 ") ;
		$r = mysql_fetch_assoc($q) ;
		if(!empty($r) ) $last_id = $r['abonne_id'] ;
		else $last_id = 0 ;
		if( $this->data['Newsletter']['pour'] == 0 ){
		$abonne = $this->Abonne->find('first',array('conditions'=>array('Abonne.id >'=>$last_id,
																		'Abonne.deleted'=>0),
													'order'=>'Abonne.id asc'
													) ) ; 
		}else {
		$abonne = $this->Abonne->find('first',array('conditions'=>array('Abonne.id >'=>$last_id,
																		'Abonne.sexe'=> $this->data['Newsletter']['pour'],
																		'Abonne.deleted'=>0),
													'order'=>'Abonne.id asc'
													) ) ; 		
		}
		if(!empty( $abonne ) ) {
			$site_name = Configure::read('site_name');
			$site_contact = Configure::read('site_contact');

			$abonne_id= $abonne['Abonne']['id'] ;
			$this->Email->reset() ;
			$this->Email->to = $abonne['Abonne']['email'] ;
			$this->Email->subject = $this->data['Newsletter']['title'] ;
			$this->Email->from = $site_name.' <'.$site_contact.'>';
			$this->Email->template = 'newsletters/new';
			//$this->Email->layout = "newsletter";
			$this->Email->sendAs = 'html';
			$this->set('abonne', $abonne);
			$this->set('newsletter', $this->data);
			if( $this->Email->send() ) {
				$this->Newsletter->saveField('envoyes',$this->data['Newsletter']['envoyes']+1 ) ;
				mysql_query("insert into abonnes_newsletters(abonne_id,newsletter_id,statut) values ( $abonne_id,$id, 1) " ) ;
			}	
			else {
				$this->Newsletter->saveField('fails',$this->data['Newsletter']['fails']+1 ) ;
				mysql_query("insert into abonnes_newsletters(abonne_id,newsletter_id,statut) values ( $abonne_id,$id, 0) " ) ;
			}
			echo mysql_error(); 
		}else {
			$this->Newsletter->id = $id; 
			$this->Newsletter->saveField('statut',3) ; // l'envoie  est terminé
		}
		$newsletter['Newsletter']['id'] = $id; 
		$newsletter['Newsletter']['last_sent_time'] = date('Y-m-d H:i:s') ;
		$this->Newsletter->save($newsletter) ;
		
		$this->autoRender = $this->layout = false;
	}
	
	function _sendToAdmin($id,$site_contact,$site_contact_cc){
		$site_name = Configure::read('site_name');
	    // sauvegarde de la newsletter
		$this->Newsletter->id =$id ;
	    $this->data = $this->Newsletter->read()  ; 
		// l'envoie de la newsletter 
		$this->Email->reset() ;
		$this->Email->to = $site_contact ;//"lhiadi.redouane@gmail.com";
		$this->Email->cc = $site_contact_cc ;
		$this->Email->subject = $this->data['Newsletter']['title'] ;
		$this->Email->from = $site_name.' <'.$site_contact.'>';
		$this->Email->template = 'newsletters/new';
		$this->Email->sendAs = 'html';
		//$this->Email->layout = "newsletter";
		$this->set('newsletter', $this->data);
		if( $this->Email->send() ) {
			$this->Session->setFlash("La newsletter a été envoyée à l'adrese email suivante : " . $site_contact,"default",array('class'=>'valid_box'));	
		
		}else{
			$this->Session->setFlash("Une erreur a été rencontrée lors de l'envoie de la newsletter à l'adresse email : " . $site_contact,"default",array('class'=>'valid_box'));	
		
		}
		$this->redirect('index') ;
		
	}
}