<?php 
class SettingsController extends AppController{
	var $name="Settings" ;
	var $uses = array() ;
//--------------------------------------------- Admin -----------------------------------------/
	function admin_index(){
		$this->set('settings', $this->Setting->find('first'))  ; 
	}
	function admin_update(){
		if(!empty($this->data)){
            if($this->Setting->save($this->data) )  {
			    $this->Session->setFlash("Les modifications ont été bien enregistrées.","default",array('class'=>'valid_box'));	
                $this->redirect("index") ;
			}
		}  
		$this->data = $this->Setting->find('first') ; 
	}
	function admin_viderLeCache(){
		clearCache() ;  
		$css_files = glob(APP.'/webroot/ccss/*'); // get all file names
		foreach($css_files as $file){ // iterate files
		  if(is_file($file))
			unlink($file); // delete file
		}
		$js_files = glob(APP.'/webroot/cjs/*'); // get all file names
		foreach($js_files as $file){ // iterate files
		  if(is_file($file))
			unlink($file); // delete file
		}
		$this->Session->setFlash("Le cache a été supprimé avec succès.","default",array('class'=>'valid_box'));
		$this->redirect($this->referer()) ;
	}
}