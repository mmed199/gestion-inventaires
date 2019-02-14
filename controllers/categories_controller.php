<?php
class CategoryController extends AppController{
    var $name ="Categories";
	var $helpers = array('Cksource');
	var $paginate = array(
							'limit' => 50
							);
		
//--------------------------- Admin ----------------------------------------
    function admin_index(){
            $this->paginate['order'] = "Category.nom asc" ;
			$this->paginate['recursive'] = 1 ;
			$this->paginate['limit'] = 50 ;			
			$q = $this->paginate('Category');
			$this->set("categories",$q) ;
			$this->set('page_title','Liste des catégories');
			$this->set('balise_h1','Liste des catégories');
	}
	function  admin_afficher($id) {
		$q= $this->Category->findById($id) ; 
		$this->set('categorie',$q)  ; 
		$q = $this->paginate('Category') ;
	}
	function admin_ajouter(){
           if(isset($this->data)){
				//pr($this->data);
				$this->data ['Category']['image'] = NULL;
				if( $this->Category->save($this->data)) {
					$Category_id = $this->Category->getLastInsertId();
					$slug = $this->data['Category']['slug'];
					$this->data['Category']['id'] = $Category_id;
					if(!empty($this->data["Category"]["image_grande"]["name"])){
						$file1 = $Category_id. '-' . $slug .".".$this->_extension($this->data["Category"]["image_grande"]["name"]);					
						move_uploaded_file($this->data["Category"]["image_grande"]["tmp_name"],"uploads/categories/".$file1);
						$this->data['Category']['image'] = $file1 ;
					}
					if(!empty($this->data["Category"]["image_logo"]["name"])){
						$file1 =  $Category_id. '-' . $slug .".".$this->_extension($this->data["Category"]["image_logo"]["name"]);					
						move_uploaded_file($this->data["Category"]["image_logo"]["tmp_name"],"uploads/categories/small/".$file1);
						$this->data['Category']['image_small'] = $file1 ;
					}
					$this->Category->save($this->data);					
				   $this->Session->setFlash("La Category a été ajouté avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				}else{
					$this->Session->setFlash("Une erreur a été rencontré lors de la création de la Category.","default",array('class'=>'error_box'));	
				 }
				
            }
		}	
		function admin_modifier($Category_id){
            if(isset($this->data)){
				if($this->Category->save($this->data)) {
					$slug = $this->data['Category']['slug'];
					if(!empty($this->data["Category"]["image_grande"]["name"])){
						$file1 = $Category_id. '-' . $slug .".".$this->_extension($this->data["Category"]["image_grande"]["name"]);					
						move_uploaded_file($this->data["Category"]["image_grande"]["tmp_name"],"uploads/Categorys/".$file1);
						$this->data['Category']['image'] = $file1 ;
					}
					if(!empty($this->data["Category"]["image_logo"]["name"])){
						$file1 =  $Category_id. '-' . $slug .".".$this->_extension($this->data["Category"]["image_logo"]["name"]);					
						move_uploaded_file($this->data["Category"]["image_logo"]["tmp_name"],"uploads/Categorys/small/".$file1);
						$this->data['Category']['image_small'] = $file1 ;
					}
					$this->Category->save($this->data);
				   $this->Session->setFlash("La Category a été modifiée avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				}else
					$this->Session->setFlash("Une erreur a été rencontré lors de la modification de la Category.","default",array('class'=>'error_box'));	
				
				
            }else $this->data = $this->Category->read(array(),$Category_id) ;
		}	
		function admin_delete($id){
				if($this->Category->saveField('deleted',1) ) {
				   $this->Session->setFlash("La Category a été supprimée avec succès","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				   }
				else {
				   $this->Session->setFlash("Une erreur est rencontrée lors de la suppression de la Category","default",array('class'=>'error_box'));	
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