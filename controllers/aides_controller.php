<?php 
class AidesController extends AppController{
	var $name = "Aides" ; 
	var $helpers  = array('Cksource') ;	
	function index(){
		$this->Aide->Caide->recursive = 2 ;
		$caides= $this->Aide->Caide->find('all') ; 
		$this->set('caides',$caides) ;
	}
	function admin_index(){
		$aides= $this->Aide->find('all') ; 
		$this->set('aides',$aides) ;
	}
	function admin_ajouter(){
		if(!empty($this->data)) {
			if($this->Aide->save($this->data) ) {
				$this->Session->setFlash("Question bien ajouté ") ;
				$this->redirect('index') ; 
			 }
			else $this->Session->setFlash("Erreur") ;
		}
		$this->set('caides',$this->Aide->Caide->find('list')) ;
			
	}
	function admin_edit($id){
		if(!empty($this->data)) {
			if($this->Aide->save($this->data) ) {
				$this->Session->setFlash("Les modifications sont bien enregistrés.") ;
				$this->redirect('index') ; 
			 }
			else $this->Session->setFlash("Erreur") ;
		}
		$this->set('caides',$this->Aide->Caide->find('list')) ;
		$this->Aide->id = $id ; 
		$this->data = $this->Aide->findById($id) ; 
			
	}
		
	function admin_delete($id) {
		if($id!=null) {
			if($this->Aide->delete($id) ) {
				$this->Session->setFlash("La question est bien supprimé.") ;
				$this->redirect('index') ; 
			 }
			else $this->Session->setFlash("Erreur") ;
		}	
	}	
}
