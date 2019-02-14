<?php
class EvenementsController extends AppController{
    var $name="Evenements";
	var $components = array("Img") ;
	var $helpers = array('Html', 'Form', 'Javascript', 'Cksource'); 
    
	function evenementsList(){
         //  return $this->Evenement->find('all');
        return $this->Evenement->find('all',array(
												"conditions" => "Evenement.visible = 1",
												"order" => "Evenement.position ASC"
										));
	}
		
	function index(){ 
		$q = $this->Evenement->find('all',array(
											"conditions" => "Evenement.deleted = 0",
											"conditions" => "Evenement.visible = 1",
											"order" => "Evenement.id desc"
								)) ;
		$this->set('evenements',$q ) ;
	}
	
//---------------------------------------- Admin -------------------------------------- 
	function admin_index(){
		    $q = $this->Evenement->find('all',array(
												"conditions" => "Evenement.deleted = 0",
												"order" => "Evenement.id desc"
								)) ; 
			$this->set('evenements',$q ) ;
			
		  $this->set('page_title','Liste des événements');
		  $this->set('balise_h1','Liste des événements');
	}
	function admin_ajouter(){
		// Langues à éditer
		$locales = array_values(Configure::read('Config.languages'));
		$this->Evenement->locale = $locales;
		if(!empty($this->data)){
			//pr($this->data);
			$this->Evenement->save($this->data) ;
            if( $this->Evenement->save($this->data) ) {
    	             $this->Session->setFlash("L'evénement a été bien ajouté avec succès.","default",array('class'=>'valid_box'));	
				}
			$this->redirect("index");
				
         }
        
	}
		function admin_modifier($id){
				 // Langues à éditer
				$locales = array_values(Configure::read('Config.languages'));
				$this->Evenement->locale = $locales;
			  if(isset($this->data)){
                 if( $this->Evenement->save($this->data) ) {
    	                  $this->Session->setFlash("L'evénement a été modifié avec succès.","default",array('class'=>'valid_box'));	
						  }
				$this->redirect("index");
				
            }else{
				$this->Evenement->id = $id ;
				$this->data = $this->Evenement->read() ;
			}
		}
		
	function admin_afficher($id) {
		$q = $this->Evenement->findById($id);
        $this->set('evenement',$q);
	}
	
	function admin_publier($id){
			$this->Evenement->id = $id;
			if( $this->Evenement->saveField('visible', 1) ){
			       $this->Session->setFlash("L'evénement a été publié avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				 };
			$this->redirect("index")  ;

	    }
	function admin_depublier($id){
			$this->Evenement->id = $id;
			if( $this->Evenement->saveField('visible', 0) ){
			       $this->Session->setFlash("L'evénement a été dépublié avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				 };
			$this->redirect("index")  ;
	    }
		
    function admin_remonter ($id){
                 // on va 
				$this->Evenement->id = $id ; 
				$p = $this->Evenement->read(array('position'))  ; 
				// si la position est superieur a 1  -1
				if($p['Evenement']['position'] > 1 ) {
				             $new_position = $p['Evenement']['position'] - 1 ; 
		  		             $this->Evenement->saveField('position', $new_position) ; 
								// on ajoute 1 au produit qui suit  dans la mme categorie
							$q = $this->Evenement->find('first',array("conditions"=>array('position <'=>$new_position
																								 ) 
																						)
																	 ) ;
							if(!empty($q)) {
									 // on ajoute 1 
									 $this->Evenement->id = $q['Evenement']['id'] ;						 
									 $new_position = $p['Evenement']['position'] ; 
									 $this->Evenement->saveField('position', $new_position ) ; 
									 }			 
							 
							 
							 
				}
				

				$this->redirect($this->referer() ) ;
         }		 
	
	function admin_descendre ($id){
		                        
				$this->Evenement->id = $id ; 
				$p = $this->Evenement->read(array('position'))  ; 
				$new_position = $p['Evenement']['position'] + 1 ; 
			    $this->Evenement->saveField('position', $new_position) ; 
				 
				
				// on decremente 1 du produit qui suit  dans la mme cat
				$q = $this->Evenement->find('first',array("conditions"=>array('position <'=>$new_position  ) ) ) ;
										 
				if(!empty($q) && $q['Evenement']['id'] >1 ) {
				         // on  -1
						 $this->Evenement->id = $q['Evenement']['id'] ;						 
						 $new_position = $p['Evenement']['position']   ; 
						 $this->Evenement->saveField('position', $new_position ) ; 
						 } 
				$this->redirect($this->referer() ) ;
		
		}
    
	function admin_delete($id){
            if($id!=null){
			    $this->Evenement->id = $id ;
				// on supprime l'image
				$image= $this->Evenement->field('image') ;
				// on delete le produit de la base de données
                if($this->Evenement->saveField('deleted',1) ) {
				   $this->Session->setFlash("L'evénement a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
				 } ;
				// affichage
                $this->redirect("index") ;
            }
        }
	function _friendlyURL($string){	
		$string = preg_replace("`\[.*\]`U","",$string); 
		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
		$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
		return strtolower(trim($string, '-'));
    
	}
                
}