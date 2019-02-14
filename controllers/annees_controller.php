<?php
class AnneesController extends AppController{
        var $name ="Annees";
		var $components = array('RequestHandler','Email');
		var $paginate = array(
							'limit' => 30,
							'order' => array(
							'Annee.id' => 'desc'
			)
		);
		
	function admin_index(){ 
		$this->paginate['conditions']["Annee.deleted"] =  0 ; 
		$q = $this->paginate('Annee') ;
		$this->set('Annees',$q) ;
    }
		
			
	function admin_rechercher() {
		if( !empty($this->data) ) {
			$query = $this->data['Annee']['query'] ;
			$this->paginate = array('conditions'=>array(
													'or'=>array(
															'Annee.title like '=>'%'.$query.'%',
															)
													), 
								 'limit' => 30,
								 'order' => 'Annee.id desc' 
								) ;
		}else  $this->paginate = array( 
								 'limit' => 30,
								 'order' => 'Annee.id desc' 
								) ;
		$q = $this->paginate('Annee') ; 
		$this->set('Annees', $q ) ;
		$this->render('admin_index') ; 
	}
	function admin_ajouter(){
		   // Langues à éditer
			$locales = array_values(Configure::read('Config.languages'));
			$this->Annee->locale = $locales;
			if( !empty($this->data) ) {
			       if( $this->Annee->save($this->data) ){
						
						$this->Session->setFlash("La nouvelle section a bien été  ajouté.","default",array('class'=>'valid_box'));	
						$this->redirect('index') ;
				 };
		   	} ;
	}
		
		function admin_modifier($id){
			if(!isset($this->data)){
			      $this->Annee->id = $id ;
			      $this->data = $this->Annee->read() ;
				  $this->set("Annee", $this->data['Annee']  ) ;
			}else{
                if( $this->Annee->save($this->data) ) 
					$this->Session->setFlash("L'abonné a été modifié avec succès.","default",array('class'=>'valid_box'));	
				else 
					$this->Session->setFlash("Erreur lors de la modification de l'abonné au newsletter.","default",array('class'=>'error_box'));	
				$this->redirect('index') ;
				
            }
	    }
	function admin_delete($id){
		if($id!=null){
			$this->Annee->id = $id ;
			if($this->Annee->saveField('deleted',1) ) {
			$this->Session->setFlash('La section a bien été supprimé',"default",array('class'=>'valid_box'));
			 $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression de la section." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }           
		}
	}
}