<?php
class MarquesController extends AppController{
    var $name ="Marques";
	var $helpers = array('Cksource');
	var $paginate = array(
							'limit' => 50
							);
	function getList(){
		return $this->Marque->find('all',array('conditions'=>array('Marque.produit_count >'=> 20,
																   'Marque.deleted = 0'), 
												'order'=>"Marque.nom asc",
												)) ;
	}
	
	function getListMenu(){
		return $this->Marque->find('all',array('conditions'=>array('Marque.produit_count >'=> 20,"Marque.nom !="=>"Autre" ), 
												'order'=>"Marque.nom asc",
												'limit'=>40,
												'fields'=>"id,nom,produit_count,slug",
											    'recursive'=>-1
												)) ;
	}
	
	function index() {
		$q =  $this->Marque->find('all',array('conditions'=>array('Marque.is_createur  = '=> 0 ,'Marque.produit_count >'=> 1 ), 
												'order'=>"Marque.nom asc"
												)) ;
		$this->set("marques",$q) ;
	}
	
	function createurs() {
		$q =  $this->Marque->find('all',array('conditions'=>array('Marque.is_createur = '=> 1 ), 
												'order'=>"Marque.nom asc"
												)) ;
		$this->set("marques",$q) ;
	}
	
	
	
	
	
//--------------------------- Admin ----------------------------------------
    function admin_index(){
            $this->paginate['order'] = "Marque.nom asc" ;
			$this->paginate['recursive'] = 1 ;
			$this->paginate['limit'] = 50 ;			
			$q = $this->paginate('Marque');
			$this->set("marques",$q) ;
			$this->set('page_title','Liste des marques');
			$this->set('balise_h1','Liste des marques');
	}
	function  admin_afficher($id) {
		$q= $this->Marque->findById($id) ; 
		$this->set('marque',$q)  ; 
		$q = $this->paginate('Marque') ;
	}
	function admin_ajouter(){
           if(isset($this->data)){
				//pr($this->data);
				$this->data ['Marque']['image'] = NULL;
				if( $this->Marque->save($this->data)) {
					$marque_id = $this->Marque->getLastInsertId();
					$slug = $this->data['Marque']['slug'];
					$this->data['Marque']['id'] = $marque_id;
					if(!empty($this->data["Marque"]["image_grande"]["name"])){
						$file1 = $marque_id. '-' . $slug .".".$this->_extension($this->data["Marque"]["image_grande"]["name"]);					
						move_uploaded_file($this->data["Marque"]["image_grande"]["tmp_name"],"uploads/marques/".$file1);
						$this->data['Marque']['image'] = $file1 ;
					}
					if(!empty($this->data["Marque"]["image_logo"]["name"])){
						$file1 =  $marque_id. '-' . $slug .".".$this->_extension($this->data["Marque"]["image_logo"]["name"]);					
						move_uploaded_file($this->data["Marque"]["image_logo"]["tmp_name"],"uploads/marques/small/".$file1);
						$this->data['Marque']['image_small'] = $file1 ;
					}
					$this->Marque->save($this->data);					
				   $this->Session->setFlash("La marque a été ajouté avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				}else{
					$this->Session->setFlash("Une erreur a été rencontré lors de la création de la marque.","default",array('class'=>'error_box'));	
				 }
				
            }
		}	
		function admin_modifier($marque_id){
            if(isset($this->data)){
				if($this->Marque->save($this->data)) {
					$slug = $this->data['Marque']['slug'];
					if(!empty($this->data["Marque"]["image_grande"]["name"])){
						$file1 = $marque_id. '-' . $slug .".".$this->_extension($this->data["Marque"]["image_grande"]["name"]);					
						move_uploaded_file($this->data["Marque"]["image_grande"]["tmp_name"],"uploads/marques/".$file1);
						$this->data['Marque']['image'] = $file1 ;
					}
					if(!empty($this->data["Marque"]["image_logo"]["name"])){
						$file1 =  $marque_id. '-' . $slug .".".$this->_extension($this->data["Marque"]["image_logo"]["name"]);					
						move_uploaded_file($this->data["Marque"]["image_logo"]["tmp_name"],"uploads/marques/small/".$file1);
						$this->data['Marque']['image_small'] = $file1 ;
					}
					$this->Marque->save($this->data);
				   $this->Session->setFlash("La marque a été modifiée avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				}else
					$this->Session->setFlash("Une erreur a été rencontré lors de la modification de la marque.","default",array('class'=>'error_box'));	
				
				
            }else $this->data = $this->Marque->read(array(),$marque_id) ;
		}	
		function admin_delete($id){
				if($this->Marque->saveField('deleted',1) ) {
				   $this->Session->setFlash("La marque a été supprimée avec succès","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				   }
				else {
				   $this->Session->setFlash("Une erreur est rencontrée lors de la suppression de la marque","default",array('class'=>'error_box'));	
				   $this->redirect('index') ;
				   }
				
            }			
		/*---------------fonctions internes ----------------------------*/
		function _extension ($name){
			$extension = strrchr($name,'.');
			$extension = strtolower(substr($extension,1));
			return $extension;
		}
	
    }
?>