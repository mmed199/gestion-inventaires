<?php
class MaterielsController extends AppController{
    var $name ="Materiels";
	var $components = array('Email') ;
    var $helpers = array('Html', 'Form', 'Javascript', 'Cksource','Cache') ;	
    var $paginate = array(
							'limit' => 10,
							'recursive'=>1,
							'fields'=>"Materiel.id, 
									   Materiel.nom, 
									   Materiel.date_achat, 
									   Materiel.created, 
									   Materiel.slug, 
									   Materiel.description, 
									   Materiel.prix,    
									   Materiel.user_id,  
									   Materiel.fournisseur_id,  
									   Materiel.emplacement_id,  
									   Materiel.typemateriel_id, 
									   Materiel.status, 
									   Materiel.typeachat_id,
									   Materiel.deleted,
									   Fournisseur.nom,
									   Typemateriel.title,
									   Emplacement.code" ,
							'order' => "Materiel.id desc" 
		);

	/*function getCriteresRecherche(){
		$return = array() ;
		$this->loadModel('Marque'); 
		$this->loadModel('Modele'); 
		$Materiel = $this->getParamsMateriel();
		$return['marques'] = $this->Marque->find('list',array('conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
		$return['modeles'] = array();
		if ($Materiel){
			if (isset($Materiel['Marque']['id'])){
				$return['modeles'] = $this->Modele->find('list',array('conditions'=>'Modele.marque_id =' .$Materiel['Marque']['id'], 'order'=>'Modele.title asc'));	
			
			}
		}	
		return $return; 
	}

	function getParamsMateriel(){
		$temp_Materiel = $this->Cookie->read('Materiel') ; 		
		if(empty($temp_Materiel) )  $Materiel = array() ;
		else {
			$Materiel = unserialize($temp_Materiel) ;
			if ( isset($Materiel['Marque']['id'])){				
				//rechercher la marque
				$this->loadModel("Marque");
				$marque = $this->Marque->findById ($Materiel['Marque']['id']);
				$Materiel['Marque']['name'] = $marque['Marque']['name'];
				
			}
			if ( isset($Materiel['Modele']['id'] )){
				//rechercher le modele
				$this->loadModel("Modele");
				$modele = $this->Modele->find ('first',array('conditions'=> 'Modele.id = ' . $Materiel['Modele']['id'] ,
														'fields'=>array('Modele.id','Modele.name')
				));
				$Materiel['Modele']['name'] = $modele['Modele']['name'];
			}
		}
		return $Materiel ;	
	}

	function getModeleByMarqueId($marque_id) {
		$this->loadModel('Modele');
		$return = "<option value=''  selected> Sélectionner.. </option>";
		$this->layout = $this->autoRender= false;
		$modeles = $this->Modele->find('all',array("fields"=>array('Modele.id','Modele.name' ),'conditions'=>"Modele.marque_id = $marque_id" ,'order'=>"Modele.id asc"));
		if ($modeles){
			foreach ($modeles as $m){
				$return .= "<option value=".$m['Modele']['id'] ." >".$m['Modele']['name'] . "</option>";				
			}
		} 
		echo $return;	
	}
	*/ 
//----------------------------------------- Admin ----------------------------------------------	

	function admin_index(){ 
		$this->paginate['conditions']["Materiel.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Materiel.id desc';
		$this->set('materiels',$this->paginate('Materiel'));
		$types = $this->Materiel->Typemateriel->find('list',array('conditions'=>'Typemateriel.deleted = 0',
															'order'=>'Typemateriel.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Liste des matériels");
		$this->render('admin_index') ;

	}
	
		
	function admin_ajouter(){				
		if(isset($this->data)) {
	       	if( $this->Materiel->save($this->data) ){
				$this->data['Materiel']['user_id'] = $this->Session->read('Auth.User.id') ;	

				// reformuler la date Francais ==> Anglais
				
				$date_achat_str_replace = str_replace("/","-",$this->data["Materiel"]["date_achat"]);
				$date_achat_En = date('Y-m-d',strtotime($date_achat_str_replace));
				$this->data["Materiel"]["date_achat"] = $date_achat_En;
				// $test = $this->data["Materiel"]["emplacement_id"] ;

				/*if(isset($test)){
					$this->data["Materiel"]["status"] = 1;

				}else{
					$this->data["Materiel"]["status"] = 0;


				}*/
				
					
				

				// print_r($this->data);
				//faire une sauvegarde des information 
				
				$this->Materiel->save($this->data);		
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le nouveau matériel a bien été ajouté.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				$this->redirect('/admin/materiels/index') ;
			}else{
				$this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				Erreur lors de l'ajout !",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;	
    		}	
		}  
		$fournisseurs = $this->Materiel->Fournisseur->find('list',array('fields'=>array('Fournisseur.nom'),'conditions'=>'Fournisseur.deleted = 0' ,'order'=>'Fournisseur.nom asc'));
	   	$this->set('fournisseurs',$fournisseurs);

	   	$emplacements = $this->Materiel->Emplacement->find('list',array('fields'=>array('Emplacement.code'),'conditions'=>'Emplacement.deleted = 0' ,'order'=>'Emplacement.code asc'));
	   	$this->set('emplacements',$emplacements);

	   	$typemateriels = $this->Materiel->Typemateriel->find('list',array('fields'=>array('Typemateriel.title'),'conditions'=>'Typemateriel.deleted = 0' , 'order'=>'Typemateriel.title asc'));
	   	$this->set('typemateriels',$typemateriels);

	   	$typeachats = $this->Materiel->Typeachat->find('list',array('fields'=>array('Typeachat.title'),'conditions'=>'Typeachat.deleted = 0' ,'order'=>'Typeachat.title asc'));
	   	$this->set('typeachats',$typeachats);

		/*$this->loadModel('Emplacement');
		$this->loadModel('Fournisseur');
		$this->loadModel('Typemateriel');		

	   	$categories = $this->Materiel->Emplacement->find('list',array('fields'=>array('Category.id','Category.name'),'order'=>'Category.name asc'));
	   	$this->set('categories',$categories);
	   	$marques = $this->Materiel->Fournisseur->find('list',array('fields'=>array('Marque.id','Marque.name'),'conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
	   	$this->set('marques',$marques);
	   	$modeles = $this->Materiel->Typemateriel->find('list',array('fields'=>array('Modele.id','Modele.name'),'order'=>'Modele.name asc'));
	   	$this->set('modeles',$modeles);	*/
	} 

	function admin_modifier ($id){ 

			
			if(isset($this->data) ) {
			if ($this->Session->read('Auth.User.id')!= $this->data['Materiel']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier cette demande.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/admin/materiels/index') ;
		}
		// print_r($this->data);
		//$date_limite_en_str_replace = str_replace("/","-",$this->data["Projet"]["date_limite"]);	
		//$date_limite_en = date('Y-m-d',strtotime($date_limite_en_str_replace)); 
		//$this->data["Projet"]["date_limite"] = $date_limite_en;  

		if($this->Materiel->save($this->data))  {
			$this->Materiel->save($this->data);	 
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le projet a été modifié avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			$this->redirect('/admin/materiels/afficher/'.$id) ;
			}
		}  
		$this->data = $this->Materiel->read(array(),$id) ;

		$q = $this->Materiel->findById($id)  ;
		$this->set('materiel', $q );


	}

	
		function admin_afficher($id){
		$q = $this->Materiel->findById ($id);
	//$this->loadModel('Annee');		
	//	$this->loadModel('TypeMateriel');		
		$Materiel_id = $this->Materiel->find('first',array('conditions'=>array('Materiel.id'=>$id)));	

		$this->set('materiel',$q) ;

		$this->set('materiel_id',$id) ; 

		$page_title = "Détail de materiel N° ".$q["Materiel"]["id"] ;

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;					 
    				 
    }

	function admin_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Materiel.id desc';
		$this->paginate['conditions']["Materiel.deleted"] =  0 ; 
		//$this->paginate['conditions']["Absence.statut"] =  1 ;  
		//$this->paginate['conditions']["Materiel.member_id"] =  $this->Session->read('Auth.Member.id')  ; 
		if( !empty($this->data) ) {
			if (!empty ($this->data['Materiel']['query'])){
				$query = $this->data['Materiel']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Materiel.id like '%$query%'",
																"Typemateriel.title like '%$query%'",
																"Materiel.nom = '$query'"
																));
			}
			if (!empty ($this->data['Materiel']['type'])){	
				$type = $this->data['Materiel']['type'] ;
				$this->paginate['conditions']["Materiel.typemateriel_id"] =  $type;
			}
		}
		$this->set('materiels',$this->paginate('Materiel') ) ;
		$types = $this->Materiel->Typemateriel->find('list',array('conditions'=>'Typemateriel.deleted = 0',
															'order'=>'Typemateriel.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
			
	function admin_supprimer($id) {
		if($id!=null){
		    $this->Materiel->id = $id ;
            if($this->Materiel->saveField('deleted',1) ) {
			   $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le Fournisseur a été suprimé avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			   $this->redirect('/admin/materiels/index') ;
			 }else{
				 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Une erreur a été rencontré lors de la suppression du Fournisseur.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}
	
	function admin_imprimer($id = null)  { 

        $id = intval($id); 
        $q = $this->Materiel->findById($id) ;
		$this->set('Materiel',$q) ;
		$division_id = $q["Member"]["division_id"];
		$this->loadModel ('Division');
		$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
		$this->set('div',$div) ;

		if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->set('download',true) ;
			$this->render('demande_Materiel'); 
		}else{
			$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Erreur d'accès à la demande.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/admin');
		}
    } 
	
	// Décision : Refusée = 3 / Accord Partiel = 2  / Accordée = 1 / En cours de traitement = 0 par default
	function admin_accorder($id) {
		$this->Materiel->id = $id;
		$this->Materiel->findById( $id ) ;
		$this->Materiel->set('decision', 1) ;
		if( $this->Materiel->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Materiel a été \"Accordée\" avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_accordPartiel($id) {
		$this->Materiel->id = $id;
		$this->Materiel->findById( $id ) ;
		$this->Materiel->set('decision', 2) ;
		if( $this->Materiel->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Materiel a été \"Accordée partiellement\".", 
				"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_refuser($id) {
		$this->Materiel->id = $id;
		$this->Materiel->findById( $id ) ;
		$this->Materiel->set('decision', 3) ;
		if( $this->Materiel->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Materiel a été \"Refusée\".", 
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}
    		
    function admin_envoyer($id){
		$this->Materiel->id = $id;
		$this->Materiel->set('envoyer', 1) ;
		if( $this->Materiel->save($this->data) ){
	        $this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				La décision a bien été envoyée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//envoyer la décision via un mail au demandeur d'Materiel	
				$this->_sendMailDecisionMateriel($id) ;
			 };
		$this->redirect("index")  ;

    }
	
    function admin_remonter ($id){
             // on va 
			$this->Materiel->id = $id ; 
			$p = $this->Materiel->read(array('position','categorie_id'))  ; 
			// si la position est superieur a 1  -1
			if($p['Materiel']['position'] > 1 ) {
			             $new_position = $p['Materiel']['position'] - 1 ; 
	  		             $this->Materiel->saveField('position', $new_position) ; 
							// on ajoute 1 au Materiel qui suit  dans la mme categorie
						$q = $this->Materiel->find('first',array("conditions"=>array(
																				'and'=>array('position <'=>$new_position,
																							 'categorie_id'=>$p['Materiel']['categorie_id']
																							 ) 
																					)
																) ) ;
						if(!empty($q)) {
								 // on ajoute 1 
								 $this->Materiel->id = $q['Materiel']['id'] ;						 
								 $new_position = $p['Materiel']['position'] ; 
								 $this->Materiel->saveField('position', $new_position ) ; 
								 }			 
						 
						 
						 
			}
			

			$this->redirect($this->referer() ) ;
     }		 
	function admin_descendre ($id){
	                        
			$this->Materiel->id = $id ; 
			$p = $this->Materiel->read(array('position','categorie_id'))  ; 
			$new_position = $p['Materiel']['position'] + 1 ; 
		    $this->Materiel->saveField('position', $new_position) ; 
			 
			
			// on decremente 1 du Materiel qui suit  dans la mme cat
			$q = $this->Materiel->find('first',array("conditions"=>array(
																	'and'=>array('position <'=>$new_position,
																    'categorie_id'=>$p['Materiel']['categorie_id']
																	 ) 
													             )
									 ) ) ;
			if(!empty($q) && $q['Materiel']['id'] >1 ) {
			         // on  -1
					 $this->Materiel->id = $q['Materiel']['id'] ;						 
					 $new_position = $p['Materiel']['position']   ; 
					 $this->Materiel->saveField('position', $new_position ) ; 
					 } 
			$this->redirect($this->referer() ) ;
	
	}

    function admin_delete($id){
        if($id!=null){
		    $this->Materiel->id = $id ;
			$image1= $this->Materiel->field('image') ;
			$image2= $this->Materiel->field('image2Prod') ;
			$image3= $this->Materiel->field('image3Prod') ;
            if($this->Materiel->saveField('deleted',1) ) {
			   $this->Session->setFlash("Le Materiel a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Materiel." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
    }
		
	
	function region($id){
		$data["Materiel"]=$this->Materiel->find("all",array(
			"conditions" => array("Materiel.statut = 1 and Materiel.region=$id"),
						"order" => "Materiel.id DESC"
		));
		$this->set('Materiels',$data["Materiel"]);
		$this->render("index");
	}
	
	/*function rechercher(){
		$rech_req = "";
		if(isset($this->params['url']['query'] ) ) { 
					   $rech_req = $this->params['url']['query'] ;				
		}
		// on remplace les espace par % pour avoir bcps de resultas
		$rech = str_replace(' ','%' ,$rech_req ) ; // pour avoir tous les mots
		$conditions =     array ("or" => array  (
												 "Materiel.description LIKE" => "%".$rech."%",
												 "Materiel.tags LIKE" => "%".$rech."%",
												 "Materiel.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Materiels',$this->paginate('Materiel'));
		$this->set ('rech_req',$rech_req);
	}
	*/
	
	
	
	function _friendlyURL($string){
		$string = preg_replace("`\[.*\]`U","",$string);
		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
		$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
		return strtolower(trim($string, '-'));
    }
	
/*----------------Fonctions locales -------------------------------------------------------------------------*/
		
	function _reset_search_data ($id_page){
		if( empty( $this->data ) ){  
			$this->data  = unserialize( $this->Session->read('Lquery') ) ;
			if (!empty ($this->data['Materiel']['submit_search']) && $this->data['Materiel']['submit_search'] == $id_page ) {
				$this->data['Materiel']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Materiel']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDecisionMateriel($Materiel_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Materiel->findById($Materiel_id)  ;
		$this->set('Materiel', $q );
		$this->Email->reset() ;
		$this->Email->to = $q['Member']['email'] ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Décision pour votre demande congé réf : '.$Materiel_id ;
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'Materiels/mail_decision_Materiel'; // note no '.ctp'
			  //Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
			  //Set view variables as normal
			  //Do not pass any args to send()
		$this->Email->send();
	}
	
	
	
	function _extension ($name){
		$extension = strrchr($name,'.');
		$extension = strtolower(substr($extension,1));
		return $extension;
	}
	
	// ************* fonction resize
	function _fctResize($file,$nom_photo){
	//parametre
	$qualite = 70; // 0=faible 100=maxi
	$chemin = './uploads/Materiels/';
	
	
	$image_depart = $file["tmp_name"];
	$size = intval($file["size"]);
	
	//test extention avant traitement
	$extension = $this->_extension($file["name"]);
	
	//$chemin_photo = $chemin.$refProd.'_'.$file["name"];
	$chemin_photo = $chemin.$nom_photo;
	$fichier = $extension;
	if($extension == 'jpg' OR $extension == 'jpeg' OR $extension == 'JPG' OR $extension == 'JPEG' OR $extension == 'gif' OR $extension == 'GIF' OR $extension == 'png' OR $extension == 'PNG'){
	
		//taille de l'image
		list($sourceWidth, $sourceHeight) = getimagesize($image_depart); 
		
		/* equivalent a 
		$tailleImageSource = getimagesize($image); 
		$sourceWidth = $tailleImageSource[0]; 
		$sourceHeight = $tailleImageSource[1];
		*/
		
		//test si width image inferieur a 450
		if ($sourceWidth < 800) {
			move_uploaded_file($image_depart, $chemin_photo);
		} else {
			//test de l'image
			if($extension == 'jpg' OR $extension == 'jpeg' OR $extension == 'JPG' OR $extension == 'JPEG') {
				$image_new = imagecreatefromjpeg($image_depart);
			} elseif($extension == 'gif' OR $extension == 'GIF') {
				$image_new = imagecreatefromgif($image_depart);
			} elseif($extension == 'png' OR $extension == 'PNG') {
				$image_new = imagecreatefrompng($image_depart);
			}
			//@$image_new = imagecreatefromstring($image_depart);
			
			if($image_new == NULL){
				$tabRetour = array(false, '<p>Photo corrompue !</p>');
				return $tabRetour;
			} else {
				// taille image selon taille origine 
				$newWidth = 800; 
				$newHeight = round(($newWidth / $sourceWidth) * $sourceHeight); 
				
				//entete deja envoyé
				//Header("Content-type: image/jpeg");
				
				//creation image vide
				$image_final = imagecreatetruecolor($newWidth,$newHeight); 
				
				//creation de la nouvelle image
				imagecopyresampled($image_final,$image_new,0,0,0,0,$newWidth,$newHeight,$sourceWidth,$sourceHeight); 
				
				//envoie de l'image
				imagejpeg($image_final,$chemin_photo,$qualite);
				
				//liberation de la memoire
				imagedestroy($image_new);
				imagedestroy($image_final);
			}//fin if
		}//fin else width
		$tabRetour = array(true, NULL);
		return $tabRetour;
		
	}else{
		$message = "<p>Format de l'image non valide ! Fichier : '.$fichier.'</p>";
		$tabRetour = array(false, $message);
		return $tabRetour;
	}//fin extention
	}
	
	
	
}
?>