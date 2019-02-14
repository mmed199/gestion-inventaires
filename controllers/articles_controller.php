<?php
class ArticlesController extends AppController{
    var $name = "Articles";
	var $components = array('Email') ;
    var $helpers = array('Html', 'Form', 'Javascript', 'Cksource') ;
	var $paginate = array( 
						'limit' => 20,
						'order' => array(
						'Article.id' => 'desc'
						)
					);
					
	function index(){
		$this->paginate = array( 
						'conditions'=>"Article.deleted = 0" ,
						'limit' => 20,
						'order' => array(
						'Article.id' => 'desc'
						)
					);
		$q = $this->paginate('Article') ;
		$this->set('articles',$q) ; 
	}
	
	function afficher($id) {
		$q = $this->Article->findById($id) ; 
		$this->set('article',$q) ;  
	}
	
	function view($slug) {
		$q = $this->Article->find('first',array('conditions'=>array('Article.slug'=>$slug))); 
		$this->set('article',$q) ;  
	}
// ---------------------------------------------- Admin ------------------------------------
    function admin_index(){
		$this->paginate['conditions']["Article.deleted"] =  0 ; 
		$articles = $this->paginate('Article');
		// pr($articles);	
		$this->set('articles',$articles) ;
    }
    function admin_asection($asection_id){
		$this->paginate['conditions']["Article.deleted"] =  0 ; 
	     $this->set('articles' , $this->paginate('Article',array('Article.asection_id'=>$asection_id) ) ) ;
		 $this->render('admin_index'); 
    }	
	function admin_ajouter(){
			if( !empty($this->data) ) {
			       if( $this->Article->save($this->data) ){
						
						$this->Session->setFlash("La nouvelle article a bien été  ajouté.","default",array('class'=>'valid_box'));	
						$this->redirect('index') ;
				 }; 
		   	} ;
			$this->set('asections', $this->Article->Asection->find('list',array('conditions'=>'Asection.deleted = 0',
															'order'=>'Asection.title asc'))) ; 
	}
	function admin_modifier($id){
	   if(isset($this->data)){ 
	      // sauvegarde de la article
	       if( $this->Article->save($this->data ) ){   	  
		     	$this->Session->setFlash("Les modifications ont été bien enregistrées.","default",array('class'=>'valid_box'));	
				$this->redirect('index') ;
				}
		  }
	    else {
		  $this->data = $this->Article->read(array(),$id) ;
	    }
		$this->set('asections', $this->Article->Asection->find('list',array('conditions'=>'Asection.deleted = 0',
															'order'=>'Asection.title asc'))) ; 		
	 }
	 function admin_afficher($id) {
		$q= $this->Article->findById($id) ; 
		$this->set('article',$q)  ;
	}
	function admin_delete($id){
		if($id!=null){
			$this->Article->id = $id ;
			if($this->Article->saveField('deleted',1) ) {
			$this->Session->setFlash('La article avec l\'id: '.$id.' a été supprimé.',"default",array('class'=>'valid_box'));
			 $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression de l'article." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }           
		}
	}

}