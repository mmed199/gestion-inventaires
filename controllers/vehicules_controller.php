<?php
class VehiculesController extends AppController{
    var $name ="Vehicules";
	var $components = array('Email') ;
	var $allowedExts = array('png','jpg','jpeg','gif','PNG','JPG','JPEG','GIF') ;
    var $helpers = array('Html', 'Form', 'Javascript', 'Cksource','Cache') ;	
    var $paginate = array(
							'limit' => 10,
							'recursive'=>1,
							'fields'=>"Vehicule.id, 
									   Vehicule.num_matricule, 
									   Vehicule.name, 
									   Vehicule.puissance_fiscale, 
									   Vehicule.nbr_place, 
									   Vehicule.mise_en_circulation, 
									   Vehicule.created, 
									   Vehicule.slug, 
									   Vehicule.description, 
									   Vehicule.image,   
									   Vehicule.category_id,   
									   Vehicule.annee_id,  
									   Vehicule.marque_id,   
									   Vehicule.modele_id,   
									   Vehicule.type_id,   
									   Vehicule.couleur_id,  
									   Vehicule.en_reparation,  
									   Vehicule.en_mission,  
									   Vehicule.deleted" ,
							'order' => "Vehicule.id desc" 
		); 

	function getCriteresRecherche(){
		$return = array() ;
		$this->loadModel('Marque'); 
		$this->loadModel('Modele'); 
		$vehicule = $this->getParamsVehicule();
		$return['marques'] = $this->Marque->find('list',array('conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
		$return['modeles'] = array();
		if ($vehicule){
			if (isset($vehicule['Marque']['id'])){
				$return['modeles'] = $this->Modele->find('list',array('conditions'=>'Modele.marque_id =' .$vehicule['Marque']['id'], 'order'=>'Modele.title asc'));	
			
			}
		}	
		return $return; 
	}

	function getParamsVehicule(){
		$temp_vehicule = $this->Cookie->read('Vehicule') ; 		
		if(empty($temp_vehicule) )  $vehicule = array() ;
		else {
			$vehicule = unserialize($temp_vehicule) ;
			if ( isset($vehicule['Marque']['id'])){				
				//rechercher la marque
				$this->loadModel("Marque");
				$marque = $this->Marque->findById ($vehicule['Marque']['id']);
				$vehicule['Marque']['name'] = $marque['Marque']['name'];
				
			}
			if ( isset($vehicule['Modele']['id'] )){
				//rechercher le modele
				$this->loadModel("Modele");
				$modele = $this->Modele->find ('first',array('conditions'=> 'Modele.id = ' . $vehicule['Modele']['id'] ,
														'fields'=>array('Modele.id','Modele.name')
				));
				$vehicule['Modele']['name'] = $modele['Modele']['name'];
			}
		}
		return $vehicule ;	
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
	
//----------------------------------------- Admin ----------------------------------------------	

	function admin_index(){ 
		$this->paginate['conditions']["Vehicule.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Vehicule.id desc';
		$this->set('vehicules',$this->paginate('Vehicule') );
		$this->set('balise_h5',"Liste des véhicules");
		$this->render('admin_index') ;
	}
	
		
	function admin_ajouter(){				
		if(isset($this->data)) {
	       	if( $this->Vehicule->save($this->data) ){
	       		$vehicule_id = $this->Vehicule->getLastInsertId();	
				$this->data['Vehicule']['id'] = $vehicule_id ;
				$this->data['Vehicule']['user_id'] = $this->Session->read('Auth.User.id') ;	
				// reformuler la date Francais ==> Anglais
				$mise_en_circulation_str_replace = str_replace("/","-",$this->data["Vehicule"]["mise_en_circulation"]);
				$mise_en_circulation_En = date('Y-m-d',strtotime($mise_en_circulation_str_replace));
				$this->data["Vehicule"]["mise_en_circulation"] = $mise_en_circulation_En;
	       		$this->loadModel('Marque');
				$this->loadModel('Modele');
				$this->loadModel('Type');
				$this->loadModel('Annee');
				$q = $this->Vehicule->find('first',array('conditions'=>array("Vehicule.id"=> $vehicule_id) ));
				$id_marque = $q["Vehicule"]["marque_id"];
				$id_modele = $q["Vehicule"]["modele_id"];
				$id_type = $q["Vehicule"]["type_id"];
				$vehicule_name = $q['Marque']['name'].' '.$q['Modele']['name'].' '.$q['Type']['name'].' '.$q['Annee']['titre'];	
				$vehicule_slug = $q['Marque']['slug'];	
				$this->data['Vehicule']['name'] = $vehicule_name;		
				$slug_image = $vehicule_id."-".$vehicule_slug ;	
				if(!empty($this->data["Vehicule"]["imagePre"]["name"])){
					$fileImg = $slug_image .".".$this->_extension($this->data["Vehicule"]["imagePre"]["name"]);					
					move_uploaded_file($this->data["Vehicule"]["imagePre"]["tmp_name"],"uploads/vehicules/".$fileImg);
					$this->data['Vehicule']['image'] = $fileImg;
				}
				//faire une sauvegarde des information du véhicule
				$this->Vehicule->save($this->data);	
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le nouveau véhicule a bien été ajouté.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				$this->redirect('/admin/vehicules/index') ;
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
	   	$categories = $this->Vehicule->Category->find('list',array('fields'=>array('Category.id','Category.name'),'order'=>'Category.name asc'));
	   	$this->set('categories',$categories);
	   	$marques = $this->Vehicule->Marque->find('list',array('fields'=>array('Marque.id','Marque.name'),'conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
	   	$this->set('marques',$marques);
	   	$modeles = $this->Vehicule->Modele->find('list',array('fields'=>array('Modele.id','Modele.name'),'order'=>'Modele.name asc'));
	   	$this->set('modeles',$modeles);
		$types = $this->Vehicule->Type->find('list',array('fields'=>array('Type.id','Type.name'),'order'=>'Type.name asc'));
	   	$this->set('types',$types);
	   	$annees = $this->Vehicule->Annee->find('list',array('fields'=>array('Annee.id','Annee.titre'),'order'=>'Annee.titre asc'));
	   	$this->set('annees',$annees);
	   	$couleurs = $this->Vehicule->Couleur->find('list',array('fields'=>array('Couleur.id','Couleur.name'),'order'=>'Couleur.name asc'));
	   	$this->set('couleurs',$couleurs);		
	} 

	function admin_modifier ($id){ 

		if(isset($this->data) ) {

			if ($this->Session->read('Auth.User.id')!= $this->data['Vehicule']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier ce véhicule.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect('/admin/vehicules/index') ;
			}
		
			$mise_en_circulation_str_replace = str_replace("/","-",$this->data["Vehicule"]["mise_en_circulation"]);

			$mise_en_circulation_En = date('Y-m-d',strtotime($mise_en_circulation_str_replace));

			$this->data["Vehicule"]["mise_en_circulation"] = $mise_en_circulation_En;

       	if( $this->Vehicule->save($this->data) ){
 
			$q = $this->Vehicule->findById($id)  ;

       		$this->loadModel('Marque');
			$this->loadModel('Modele');
			$this->loadModel('Type');
			$this->loadModel('Annee');

			$id_marque = $q["Vehicule"]["marque_id"];
			$id_modele = $q["Vehicule"]["modele_id"];
			$id_type = $q["Vehicule"]["type_id"];

			$vehicule_name = $q['Marque']['name'].' '.$q['Modele']['name'].' '.$q['Annee']['titre'];	
			$vehicule_slug = $q['Marque']['slug'];	

			$this->data['Vehicule']['name'] = $vehicule_name;		
			$slug_image = $id."-".$vehicule_slug ;	

			if(!empty($this->data["Vehicule"]["imagePre"]["name"])){
				$fileImg = $slug_image .".".$this->_extension($this->data["Vehicule"]["imagePre"]["name"]);					
				move_uploaded_file($this->data["Vehicule"]["imagePre"]["tmp_name"],"uploads/vehicules/".$fileImg);
				$this->data['Vehicule']['photo'] = $fileImg; 
			}
			//faire une sauvegarde des information du véhicule
			
			$this->Vehicule->saveAll($this->data);					

			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le véhicule a été modifié avec succès.",
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

			$this->redirect('/admin/vehicules/index') ;
			}; 
		} ;

		$this->data = $this->Vehicule->read(array(),$id) ;

		$q = $this->Vehicule->findById($id)  ;
		$this->set('vehicule', $q );
 		
		$categories = $this->Vehicule->Category->find('list',array('fields'=>array('Category.id','Category.name'),'order'=>'Category.name asc'));
	   	$this->set('categories',$categories);

	   	$marques = $this->Vehicule->Marque->find('list',array('fields'=>array('Marque.id','Marque.name'),'conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
	   	$this->set('marques',$marques);

	   	$modeles = $this->Vehicule->Modele->find('list',array('fields'=>array('Modele.id','Modele.name'),'order'=>'Modele.name asc'));
	   	$this->set('modeles',$modeles);

		$types = $this->Vehicule->Type->find('list',array('fields'=>array('Type.id','Type.name'),'order'=>'Type.name asc'));
	   	$this->set('types',$types);

	   	$annees = $this->Vehicule->Annee->find('list',array('fields'=>array('Annee.id','Annee.titre'),'order'=>'Annee.titre asc'));
	   	$this->set('annees',$annees);

	   	$couleurs = $this->Vehicule->Couleur->find('list',array('fields'=>array('Couleur.id','Couleur.name'),'order'=>'Couleur.name asc'));
	   	$this->set('couleurs',$couleurs);
	}

	function admin_afficher($id){

		$q = $this->Vehicule->findById ($id);

		$vehicule_id = $this->Vehicule->find('first',array('conditions'=>array('Vehicule.id'=>$id)));	

		$this->set('vehicule',$q) ;

		$this->set('vehicule_id',$id) ; 

		$page_title = "Détail de Véhicule ".$q["Vehicule"]["name"] ;

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;					 
    }

	function admin_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Vehicule.id desc';
		$this->paginate['conditions']["Vehicule.deleted"] =  0 ; 
		//$this->paginate['conditions']["Vehicule.statut"] =  1 ;  
		if( !empty($this->data) ) {
			if (!empty ($this->data['Vehicule']['query'])){
				$query = $this->data['Vehicule']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Vehicule.id like '%$query%'",
																"TypeVehicule.title like '%$query%'",
																"Annee.titre = '$query'"
																));
			}
			if (!empty ($this->data['Vehicule']['type'])){	
				$type = $this->data['Vehicule']['type'] ;
				$this->paginate['conditions']["Vehicule.typeVehicule_id"] =  $type;
			}
		}
		$this->set('Vehicules',$this->paginate('Vehicule') ) ;
		$types = $this->Vehicule->TypeVehicule->find('list',array('conditions'=>'TypeVehicule.deleted = 0',
															'order'=>'TypeVehicule.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
			
	function admin_supprimer($id) {  
		if($id!=null){
		    $this->Vehicule->id = $id ;
            if($this->Vehicule->saveField('deleted',1) ) {
			   $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le véhicule a été suprimé avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Une erreur a été rencontré lors de la suppression du véhicule.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}
	
	function admin_imprimer($id = null)  { 

        $id = intval($id); 
        $q = $this->Vehicule->findById($id) ;
		$this->set('Vehicule',$q) ;
		$division_id = $q["Member"]["division_id"];
		$this->loadModel ('Division');
		$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
		$this->set('div',$div) ;

		if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->set('download',true) ;
			$this->render('demande_Vehicule'); 
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
		$this->Vehicule->id = $id;
		$this->Vehicule->findById( $id ) ;
		$this->Vehicule->set('decision', 1) ;
		if( $this->Vehicule->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Vehicule a été \"Accordée\" avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_accordPartiel($id) {
		$this->Vehicule->id = $id;
		$this->Vehicule->findById( $id ) ;
		$this->Vehicule->set('decision', 2) ;
		if( $this->Vehicule->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Vehicule a été \"Accordée partiellement\".", 
				"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_refuser($id) {
		$this->Vehicule->id = $id;
		$this->Vehicule->findById( $id ) ;
		$this->Vehicule->set('decision', 3) ;
		if( $this->Vehicule->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Vehicule a été \"Refusée\".", 
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}
    		
    function admin_envoyer($id){
		$this->Vehicule->id = $id;
		$this->Vehicule->set('envoyer', 1) ;
		if( $this->Vehicule->save($this->data) ){
	        $this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				La décision a bien été envoyée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//envoyer la décision via un mail au demandeur d'Vehicule	
				$this->_sendMailDecisionVehicule($id) ;
			 };
		$this->redirect("index")  ;

    }
	
    function admin_remonter ($id){
             // on va 
			$this->Vehicule->id = $id ; 
			$p = $this->Vehicule->read(array('position','categorie_id'))  ; 
			// si la position est superieur a 1  -1
			if($p['Vehicule']['position'] > 1 ) {
			             $new_position = $p['Vehicule']['position'] - 1 ; 
	  		             $this->Vehicule->saveField('position', $new_position) ; 
							// on ajoute 1 au Vehicule qui suit  dans la mme categorie
						$q = $this->Vehicule->find('first',array("conditions"=>array(
																				'and'=>array('position <'=>$new_position,
																							 'categorie_id'=>$p['Vehicule']['categorie_id']
																							 ) 
																					)
																) ) ;
						if(!empty($q)) {
								 // on ajoute 1 
								 $this->Vehicule->id = $q['Vehicule']['id'] ;						 
								 $new_position = $p['Vehicule']['position'] ; 
								 $this->Vehicule->saveField('position', $new_position ) ; 
								 }			 
						 
						 
						 
			}
			

			$this->redirect($this->referer() ) ;
     }		 
	function admin_descendre ($id){
	                        
			$this->Vehicule->id = $id ; 
			$p = $this->Vehicule->read(array('position','categorie_id'))  ; 
			$new_position = $p['Vehicule']['position'] + 1 ; 
		    $this->Vehicule->saveField('position', $new_position) ; 
			 
			
			// on decremente 1 du Vehicule qui suit  dans la mme cat
			$q = $this->Vehicule->find('first',array("conditions"=>array(
																	'and'=>array('position <'=>$new_position,
																    'categorie_id'=>$p['Vehicule']['categorie_id']
																	 ) 
													             )
									 ) ) ;
			if(!empty($q) && $q['Vehicule']['id'] >1 ) {
			         // on  -1
					 $this->Vehicule->id = $q['Vehicule']['id'] ;						 
					 $new_position = $p['Vehicule']['position']   ; 
					 $this->Vehicule->saveField('position', $new_position ) ; 
					 } 
			$this->redirect($this->referer() ) ;
	
	}

    function admin_delete($id){
        if($id!=null){
		    $this->Vehicule->id = $id ;
			$image1= $this->Vehicule->field('image') ;
			$image2= $this->Vehicule->field('image2Prod') ;
			$image3= $this->Vehicule->field('image3Prod') ;
            if($this->Vehicule->saveField('deleted',1) ) {
			   $this->Session->setFlash("Le Vehicule a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Vehicule." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
    }
		
	
	function region($id){
		$data["Vehicule"]=$this->Vehicule->find("all",array(
			"conditions" => array("Vehicule.statut = 1 and Vehicule.region=$id"),
						"order" => "Vehicule.id DESC"
		));
		$this->set('Vehicules',$data["Vehicule"]);
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
												 "Vehicule.description LIKE" => "%".$rech."%",
												 "Vehicule.tags LIKE" => "%".$rech."%",
												 "Vehicule.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Vehicules',$this->paginate('Vehicule'));
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
			if (!empty ($this->data['Vehicule']['submit_search']) && $this->data['Vehicule']['submit_search'] == $id_page ) {
				$this->data['Vehicule']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Vehicule']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDecisionVehicule($Vehicule_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Vehicule->findById($Vehicule_id)  ;
		$this->set('Vehicule', $q );
		$this->Email->reset() ;
		$this->Email->to = $q['Member']['email'] ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Décision pour votre demande congé réf : '.$Vehicule_id ;
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'Vehicules/mail_decision_Vehicule'; // note no '.ctp'
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
	$chemin = './uploads/vehicules/';
	
	
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