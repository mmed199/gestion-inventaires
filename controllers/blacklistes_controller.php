<?php
class BlacklistesController extends AppController{	
	var $name = "Blacklistes" ;
	var $paginate = array(
							'limit' => 20,
							'order' => array(
							'Blackliste.date' => 'desc')
						);
	var $helpers = array('Html', 'Form', 'Javascript', 'Cksource'); 
	
//------------------------------------- Admin -----------------------------
	function admin_index(){
		$q = $this->paginate('Blackliste');
		$this->set('blacklistes',$q) ;
	}
	function  admin_afficher($id) {
		$q= $this->Category->findById($id) ; 
		$this->set('blackliste',$q)  ; 
		$q = $this->paginate('Blackliste') ;
	}
	function admin_ajouter(){
		if(isset($this->data)){
			if( $this->Blackliste->save($this->data) ) {
				$this->Session->setFlash("Ajouté avec succès.","default",array('class'=>'valid_box'));	
				$this->redirect($this->referer()) ;
			}
        }
	}
		
	function admin_modifier($id){
		if(isset($this->data)){
			 if( $this->Blackliste->save($this->data) ) {
				$this->Session->setFlash("Modifié avec succès.","default",array('class'=>'valid_box'));	
			}
			$this->redirect("index");
				
        }else{
			$this->Blackliste->id = $id ;
			$this->data = $this->Blackliste->read() ;
				
		}
	
	}
	
	function admin_delete($id){
		if($this->Blackliste->delete($id)) {
		   $this->Session->setFlash("Supprimé avec succès","default",array('class'=>'valid_box'));	
		   $this->redirect('index') ;
		   }
		else {
		   $this->Session->setFlash("Une erreur est rencontrée lors de la suppression","default",array('class'=>'error_box'));	
		   $this->redirect('index') ;
		   }
		
	}
}