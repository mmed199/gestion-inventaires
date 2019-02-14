<?php 
class CfaqsController extends AppController{
	var $name = "Cfaqs" ; 
	var $helpers  = array('Cksource') ;	
	var $paginate = array(
							'limit' => 20
							);
			
	function getList(){
		return $this->Cfaq->find('all') ;
	}
	
	//------------------------------------- Admin -----------------------------
	function admin_index(){
		$q = $this->paginate('Cfaq');
		$this->set('cfaqs',$q) ;
	}
	function  admin_afficher($id) {
		$q= $this->Cfaq->findById($id) ; 
		$this->set('cfaq',$q)  ; 
		$q = $this->paginate('Cfaq') ;
	}
	function admin_ajouter(){
		if(isset($this->data)){
			if( $this->Cfaq->save($this->data) ) {
				$this->Session->setFlash("La catégorie a été ajoutée avec succès.","default",array('class'=>'valid_box'));	
				$this->redirect($this->referer()) ;
				}
			else $this->Session->setFlash("Erreur") ;
		}
	}
		
	function admin_edit($id){
		if(isset($this->data)){
			 if( $this->Cfaq->save($this->data) ) {
				$this->Session->setFlash("La catégorie a été modifiée avec succès.","default",array('class'=>'valid_box'));	
			}
			$this->redirect("index");
				
        }else{
			$this->Cfaq->id = $id ;
			$this->data = $this->Cfaq->read() ;
				
		}
	
	}
	
	function admin_delete($id){
		if($this->Cfaq->delete($id)) {
		   $this->Session->setFlash("La catégorie a été supprimée avec succès","default",array('class'=>'valid_box'));	
		   $this->redirect('index') ;
		   }
		else {
		   $this->Session->setFlash("Une erreur est rencontrée lors de la suppression","default",array('class'=>'error_box'));	
		   $this->redirect('index') ;
		   }
		
	}
}