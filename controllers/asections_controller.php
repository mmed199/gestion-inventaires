<?php
class AsectionsController extends AppController{
        var $name ="Asections";
		var $components = array('RequestHandler','Email');
		var $paginate = array(
							'limit' => 30,
							'order' => array(
							'Asection.created_date' => 'desc'
			)
		);
		
	function admin_index(){ 
		$this->paginate['conditions']["Asection.deleted"] =  0 ; 
		$q = $this->paginate('Asection') ;
		$this->set('asections',$q) ;
    }
		
			
	function admin_rechercher() {
		if( !empty($this->data) ) {
			$query = $this->data['Asection']['query'] ;
			$this->paginate = array('conditions'=>array(
													'or'=>array(
															'Asection.title like '=>'%'.$query.'%',
															)
													), 
								 'limit' => 30,
								 'order' => 'Asection.id desc' 
								) ;
		}else  $this->paginate = array( 
								 'limit' => 30,
								 'order' => 'Asection.id desc' 
								) ;
		$q = $this->paginate('Asection') ; 
		$this->set('asections', $q ) ;
		$this->render('admin_index') ; 
	}
	function admin_ajouter(){
		   // Langues à éditer
			$locales = array_values(Configure::read('Config.languages'));
			$this->Asection->locale = $locales;
			if( !empty($this->data) ) {
			       if( $this->Asection->save($this->data) ){
						
						$this->Session->setFlash("La nouvelle section a bien été  ajouté.","default",array('class'=>'valid_box'));	
						$this->redirect('index') ;
				 };
		   	} ;
	}
		
		function admin_modifier($id){
			if(!isset($this->data)){
			      $this->Asection->id = $id ;
			      $this->data = $this->Asection->read() ;
				  $this->set("asection", $this->data['Asection']  ) ;
			}else{
                if( $this->Asection->save($this->data) ) 
					$this->Session->setFlash("L'abonné a été modifié avec succès.","default",array('class'=>'valid_box'));	
				else 
					$this->Session->setFlash("Erreur lors de la modification de l'abonné au newsletter.","default",array('class'=>'error_box'));	
				$this->redirect('index') ;
				
            }
	    }
	function admin_delete($id){
		if($id!=null){
			$this->Asection->id = $id ;
			if($this->Asection->saveField('deleted',1) ) {
			$this->Session->setFlash('La section a bien été supprimé',"default",array('class'=>'valid_box'));
			 $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression de la section." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }           
		}
	}
}