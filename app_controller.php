<?php
class AppController extends Controller{
    var $components = array('Session','AppAuth','RequestHandler','Cookie');
	var $helpers = array ('Html', 'Form', 'Javascript','Session','Asset'); 
    function beforeFilter(){
        if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin'){
            $this->layout = 'admin';
			Configure::write('Config.language',  "fre");
			Configure::write('Config.langCode',  "fr");
			}
		else if(isset($this->params['prefix']) && $this->params['prefix'] == 'com'){
            $this->layout = 'com';
			Configure::write('Config.language',  "fre");
			Configure::write('Config.langCode',  "fr");
		}
		else if(isset($this->params['prefix']) && $this->params['prefix'] == 'member'){
            $this->layout = 'member';
		}
        else  if(isset($this->params['prefix']) && $this->params['prefix'] == 'client'){
            $this->layout = 'default';
	    }
		if ($this->RequestHandler->isAjax() ) {
          // Executes if the client accepts any of the above: XML, RSS or Atom
		  $this->layout = false ;
        }
		if (Configure::read('debug') == 0){ 
                        @ob_start ('ob_gzhandler'); 
                        header('Content-type: text/html; charset: UTF-8'); 
                        header('Cache-Control: must-revalidate'); 
                        $offset = -1; 
                        $ExpStr = "Expires: " .gmdate('D, d M Y H:i:s',time() + $offset) . ' GMT'; 
                        header($ExpStr); 
                } 
    } 
	
	function beforeRender() { 
		$locale = Configure::read('Config.language');
		if ($locale && file_exists(VIEWS . $locale . DS . $this->viewPath)) {
			// e.g. use /app/View/fre/Pages/tos.ctp instead of /app/View/Pages/tos.ctp
			$this->viewPath = $locale . DS . $this->viewPath;
		}
		//echo $this->viewPath ; 
		ob_start(); 
	}

	/**
	 * Construit l'index des données existantes d'un modèle
	 */
	function admin_build_search_index()
	{
		$this->autoRender = false;
	 
		$model =& $this->{$this->modelClass};
	 
		if(!isset($model->Behaviors->Searchable))
		{
			echo "Erreur : le modèle {$model->alias} n'est pas lié au SearchableBehavior.";
			exit;
		}
	 
		$data = $model->find('all');
	 
		foreach($data as $row)
		{
			$model->set($row);
	 
			$model->Behaviors->Searchable->Search->saveIndex(
				$model->alias,
				$model->id,
				$model->buildIndex()
			);
		}
	 
		echo "L'index des données du modèle {$model->alias} a été créé.";
	}
	 
	/**
	 *  Supprime l'index des données d'un modèle
	 */
	function admin_delete_search_index()
	{
		$this->autoRender = false;
	 
		$model =& $this->{$this->modelClass};
	 
		if(!isset($model->Behaviors->Searchable))
		{
			echo "Erreur : le modèle {$model->alias} n'est pas lié au SearchableBehavior.";
			exit;
		}
	 
		$model->Behaviors->Searchable->Search->deleteAll(array(
			'model' => $model->alias
		));
	 
		echo "L'index des données du modèle {$model->alias} a été supprimé.";
	}
	 
	/**
	 * Reconstruit l'index des données existantes d'un modèle
	 */
	function admin_rebuild_search_index()
	{
		$this->admin_delete_search_index();
		$this->admin_build_search_index();
	}


}