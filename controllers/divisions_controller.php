<?php
class DivisionsController extends AppController{
        var $name ="Divisions";
		var $components = array('RequestHandler','Email');
		var $paginate = array(
							'limit' => 30,
							'order' => array(
							'Division.id' => 'desc'
			)
		);
		
	function admin_index(){ 
		$this->paginate['conditions']["Division.deleted"] =  0 ; 
		$q = $this->paginate('Division') ;
		$this->set('divisions',$q) ;
    }
		
			
	function admin_rechercher() {
		if( !empty($this->data) ) {
			$query = $this->data['Division']['query'] ;
			$this->paginate = array('conditions'=>array(
													'or'=>array(
															'Division.title like '=>'%'.$query.'%',
															)
													), 
								 'limit' => 30,
								 'order' => 'Division.id desc' 
								) ;
		}else  $this->paginate = array( 
								 'limit' => 30,
								 'order' => 'Division.id desc' 
								) ;
		$q = $this->paginate('Division') ; 
		$this->set('Divisions', $q ) ;
		$this->render('admin_index') ; 
	}
	function admin_ajouter(){
		   // Langues à éditer
			$locales = array_values(Configure::read('Config.languages'));
			$this->Division->locale = $locales;
			if( !empty($this->data) ) {
			       if( $this->Division->save($this->data) ){
						
						$this->Session->setFlash("La nouvelle section a bien été  ajouté.","default",array('class'=>'valid_box'));	
						$this->redirect('index') ;
				 };
		   	} ;
	}
		
		function admin_modifier($id){
			if(!isset($this->data)){
			      $this->Division->id = $id ;
			      $this->data = $this->Division->read() ;
				  $this->set("Division", $this->data['Division']  ) ;
			}else{
                if( $this->Division->save($this->data) ) 
					$this->Session->setFlash("L'abonné a été modifié avec succès.","default",array('class'=>'valid_box'));	
				else 
					$this->Session->setFlash("Erreur lors de la modification de l'abonné au newsletter.","default",array('class'=>'error_box'));	
				$this->redirect('index') ;
				
            }
	    }
	function admin_delete($id){
		if($id!=null){
			$this->Division->id = $id ;
			if($this->Division->saveField('deleted',1) ) {
			$this->Session->setFlash('La section a bien été supprimé',"default",array('class'=>'valid_box'));
			 $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression de la section." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }           
		}
	}
}