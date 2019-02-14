<?php
class TypesController extends AppController{
        var $name ="Types";
		var $paginate = array(
							'limit' => 50
		);
		
	function getTypesByCategoryId ($category_id){
			$this->layout = $this->autoRender= false;
			$q = $this->Type->find('list', array('conditions'=>array('category_id '=>$category_id ),'order'=>'Type.nom asc' ) ) ; 
			echo json_encode($q) ;			
	}
		
        function admin_index(){
            $q = $this->paginate('Type');
			$this->set("types",$q) ;
		}
		
		function admin_ajouter(){
            if(isset($this->data)){
               $id=  $this->Type->save($this->data) ;
				if($id) {
				   $this->Session->setFlash("Le Type a été ajouté avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				   }
				
            }else{
				$this->set('categories',$this->Type->Category->find('list',array('order','Category.id desc') ) ) ; 
				$this->set('familles',$this->Type->Pfamille->find('list',array('order','Pfamille.id desc') ) ) ;
			}
		}	
		function admin_modifier($id){
            if(isset($this->data)){
               $id=  $this->Type->save($this->data) ;
				if($id) {
				   $this->Session->setFlash("Le Type a été modifié avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				   }
				
            }else {
				$this->data = $this->Type->read(array(),$id) ;
				$this->set('categories',$this->Type->Category->find('list',array('order','Category.id desc') ) ) ; 
				$this->set('familles',$this->Type->Pfamille->find('list',array('order','Pfamille.id desc') ) ) ; 
			}
		}	
		function admin_delete($id){
				if($this->Type->delete($id)) {
				   $this->Session->setFlash("Le Type a été supprimé avec succès","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				   }
				else {
				   $this->Session->setFlash("Une erreur est rencontrée lors de la suppression du Type","default",array('class'=>'error_box'));	
				   $this->redirect('index') ;
				   }
				
            }			
	
	
    }
?>