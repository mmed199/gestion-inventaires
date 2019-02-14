<?php 
class FaqsController extends AppController{
	var $name = "Faqs" ; 
	var $helpers  = array('Cksource') ;	
	var $paginate = array(
							'limit' => 20
							);
	
	function index(){
		$q = $this->Faq->find('first');
		$this->Faq->Cfaq->recursive = 2 ;
		$cfaqs= $this->Faq->Cfaq->find('all') ; 
		$page_title = $q['Faq']['page_title'] ;
		$page_description = $q['Faq']['page_description'] ;
		$this->set('cfaqs',$cfaqs) ;
		$this->set('page_title',$page_title);
		$this->set('page_description',$page_description);
	}
	function categorie($cfaq_slug){ 
		$cat = $this->Faq->Cfaq->find('first',array('conditions'=>array('Cfaq.slug'=>$cfaq_slug))) ;
		$this->data['Faq']['cfaq_id'] = $cfaq_id = $cat['Cfaq']['id'] ;
		$faqs = $this->Faq->find('all',array("conditions" => "Faq.cfaq_id=$cfaq_id")) ; 
		$cfaqs= $this->Faq->Cfaq->find('all') ;
		$q = $this->Faq->find('first',array("conditions" => "Faq.cfaq_id=$cfaq_id")) ; 
		$page_title = $q['Faq']['page_title'] ;
		$page_description = $q['Faq']['page_description'] ;
		$this->set('page_title',$page_title);
		$this->set('page_description',$page_description);
		$this->set('cat',$cat) ;
		$this->set('faqs',$faqs) ;		
		$this->set('cfaqs',$cfaqs) ;		
	}
	function admin_index(){
		$q = $this->paginate('Faq');
		$this->set("faqs",$q) ;
		$this->set('cfaqs',$this->Faq->Cfaq->find('all',array('fields' => array('titre')) ) ) ; 
	}
	function admin_ajouter(){
		if(!empty($this->data)) {
			if($this->Faq->save($this->data) ) {
				$this->Session->setFlash("Question bien ajouté ","default",array('class'=>'valid_box'));	
				$this->redirect('index') ; 
			 }
			else $this->Session->setFlash("Erreur") ;
		}
		$cfaqs = $this->Faq->Cfaq->find('list');
		$this->set('cfaqs',$cfaqs);
			
	}
	function admin_edit($id){
		if(!empty($this->data)) {
			if($this->Faq->save($this->data) ) {
				$cfaq_id = $this->Faq->getLastInsertId() ;
				mysql_query("update faqs set cfaq_id=$cfaq_id" ) ;
				$this->Session->setFlash("Les modifications sont bien enregistrés.","default",array('class'=>'valid_box'));	
				$this->redirect('index') ; 
			 }
			else $this->Session->setFlash("Erreur","default",array('class'=>'valid_box'));	
		}
		$this->Faq->id = $id ; 
		$this->data = $this->Faq->findById($id) ; 
		$cfaqs = $this->Faq->Cfaq->find('list');
		$this->set('cfaqs',$cfaqs);
			
	}
	
	function  admin_afficher($id) {
		$q= $this->Faq->findById($id) ; 
		$this->set('faq',$q)  ; 
		$q = $this->paginate('Faq') ;
		$this->set('cfaqs',$this->Faq->Cfaq->find('all',array('fields' => array('titre')) ) ) ; 
	}
	
	function admin_delete($id) {
		if($id!=null) {
			if($this->Faq->delete($id) ) {
				$this->Session->setFlash("La question est bien supprimé.","default",array('class'=>'valid_box'));	
				$this->redirect('index') ; 
			 }
			else $this->Session->setFlash("Erreur","default",array('class'=>'valid_box'));	
		}	
	}	
}
