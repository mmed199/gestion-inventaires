<?php

class EmplacementsController extends AppController{
    var $name ="Emplacements";
	var $components = array('Email') ;
    var $helpers = array('Html', 'Form', 'Javascript', 'Cksource','Cache') ;	
    var $paginate = array(
							'limit' => 10,
							'recursive'=>1,
							'fields'=>"Emplacement.id, 
									   Emplacement.code,
									   Emplacement.commentaire, 
									   Emplacement.deleted" ,
							'order' => "Emplacement.id desc" 
		);

	/*function getCriteresRecherche(){
		$return = array() ;
		$this->loadModel('Marque'); 
		$this->loadModel('Modele'); 
		$Emplacement = $this->getParamsEmplacement();
		$return['marques'] = $this->Marque->find('list',array('conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
		$return['modeles'] = array();
		if ($Emplacement){
			if (isset($Emplacement['Marque']['id'])){
				$return['modeles'] = $this->Modele->find('list',array('conditions'=>'Modele.marque_id =' .$Emplacement['Marque']['id'], 'order'=>'Modele.title asc'));	
			
			}
		}	
		return $return; 
	}

	function getParamsEmplacement(){
		$temp_Emplacement = $this->Cookie->read('Emplacement') ; 		
		if(empty($temp_Emplacement) )  $Emplacement = array() ;
		else {
			$Emplacement = unserialize($temp_Emplacement) ;
			if ( isset($Emplacement['Marque']['id'])){				
				//rechercher la marque
				$this->loadModel("Marque");
				$marque = $this->Marque->findById ($Emplacement['Marque']['id']);
				$Emplacement['Marque']['name'] = $marque['Marque']['name'];
				
			}
			if ( isset($Emplacement['Modele']['id'] )){
				//rechercher le modele
				$this->loadModel("Modele");
				$modele = $this->Modele->find ('first',array('conditions'=> 'Modele.id = ' . $Emplacement['Modele']['id'] ,
														'fields'=>array('Modele.id','Modele.name')
				));
				$Emplacement['Modele']['name'] = $modele['Modele']['name'];
			}
		}
		return $Emplacement ;	
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
		$this->paginate['conditions']["Emplacement.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Emplacement.id desc';
		$this->set('emplacements',$this->paginate('Emplacement') );
		$this->set('balise_h5',"Liste des emplacements");
		$this->render('admin_index') ;
	}
	
		
	function admin_ajouter(){				
		if(isset($this->data)) {
	       	if( $this->Emplacement->save($this->data) ){
				$this->data['Emplacement']['user_id'] = $this->Session->read('Auth.User.id') ;	

				// reformuler la date Francais ==> Anglais
				
			/*	$date_achat_str_replace = str_replace("/","-",$this->data["Emplacement"]["date_achat"]);
				$date_achat_En = date('Y-m-d',strtotime($date_achat_str_replace));
				$this->data["Emplacement"]["date_achat"] = $date_achat_En;*/

				// print_r($this->data);
				//faire une sauvegarde des information 
				
				$this->Emplacement->save($this->data);		
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le nouveau emplacement a bien été ajouté.",
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
		/*$this->loadModel('Emplacement');
		$this->loadModel('Fournisseur');
		$this->loadModel('TypeEmplacement');		

	   	$categories = $this->Emplacement->Emplacement->find('list',array('fields'=>array('Category.id','Category.name'),'order'=>'Category.name asc'));
	   	$this->set('categories',$categories);
	   	$marques = $this->Emplacement->Fournisseur->find('list',array('fields'=>array('Marque.id','Marque.name'),'conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
	   	$this->set('marques',$marques);
	   	$modeles = $this->Emplacement->TypeEmplacement->find('list',array('fields'=>array('Modele.id','Modele.name'),'order'=>'Modele.name asc'));
	   	$this->set('modeles',$modeles);	*/
	} 

	function admin_modifier ($id){ 

		if(isset($this->data) ) {

			if ($this->Session->read('Auth.User.id')!= $this->data['Emplacement']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier ce véhicule.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect('/admin/Emplacements/index') ;
			}
		
			$mise_en_circulation_str_replace = str_replace("/","-",$this->data["Emplacement"]["mise_en_circulation"]);

			$mise_en_circulation_En = date('Y-m-d',strtotime($mise_en_circulation_str_replace));

			$this->data["Emplacement"]["mise_en_circulation"] = $mise_en_circulation_En;

       	if( $this->Emplacement->save($this->data) ){
 
			$q = $this->Emplacement->findById($id)  ;

       		$this->loadModel('Marque');
			$this->loadModel('Modele');
			$this->loadModel('Type');
			$this->loadModel('Annee');

			$id_marque = $q["Emplacement"]["marque_id"];
			$id_modele = $q["Emplacement"]["modele_id"];
			$id_type = $q["Emplacement"]["type_id"];

			$Emplacement_name = $q['Marque']['name'].' '.$q['Modele']['name'].' '.$q['Annee']['titre'];	
			$Emplacement_slug = $q['Marque']['slug'];	

			$this->data['Emplacement']['name'] = $Emplacement_name;		
			$slug_image = $id."-".$Emplacement_slug ;	

			if(!empty($this->data["Emplacement"]["imagePre"]["name"])){
				$fileImg = $slug_image .".".$this->_extension($this->data["Emplacement"]["imagePre"]["name"]);					
				move_uploaded_file($this->data["Emplacement"]["imagePre"]["tmp_name"],"uploads/Emplacements/".$fileImg);
				$this->data['Emplacement']['photo'] = $fileImg; 
			}
			//faire une sauvegarde des information du véhicule
			
			$this->Emplacement->saveAll($this->data);					

			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le véhicule a été modifié avec succès.",
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

			$this->redirect('/admin/Emplacements/index') ;
			}; 
		} ;

		$this->data = $this->Emplacement->read(array(),$id) ;

		$q = $this->Emplacement->findById($id)  ;
		$this->set('Emplacement', $q );
 		
		$categories = $this->Emplacement->Category->find('list',array('fields'=>array('Category.id','Category.name'),'order'=>'Category.name asc'));
	   	$this->set('categories',$categories);

	   	$marques = $this->Emplacement->Marque->find('list',array('fields'=>array('Marque.id','Marque.name'),'conditions'=>'Marque.deleted = 0','order'=>'Marque.name asc'));
	   	$this->set('marques',$marques);

	   	$modeles = $this->Emplacement->Modele->find('list',array('fields'=>array('Modele.id','Modele.name'),'order'=>'Modele.name asc'));
	   	$this->set('modeles',$modeles);

		$types = $this->Emplacement->Type->find('list',array('fields'=>array('Type.id','Type.name'),'order'=>'Type.name asc'));
	   	$this->set('types',$types);

	   	$annees = $this->Emplacement->Annee->find('list',array('fields'=>array('Annee.id','Annee.titre'),'order'=>'Annee.titre asc'));
	   	$this->set('annees',$annees);

	   	$couleurs = $this->Emplacement->Couleur->find('list',array('fields'=>array('Couleur.id','Couleur.name'),'order'=>'Couleur.name asc'));
	   	$this->set('couleurs',$couleurs);
	}

	function admin_afficher($id){
		$q = $this->Emplacement->findById ($id);
		$this->loadModel('Annee');		
		$this->loadModel('TypeEmplacement');		
		$Emplacement_id = $this->Emplacement->find('first',array('conditions'=>array('Emplacement.id'=>$id)));	

		$this->set('Emplacement',$q) ;

		$this->set('Emplacement_id',$id) ; 

		$page_title = "Détail de l'indemnité N° ".$q["Emplacement"]["id"] ;

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;					 
    }

	function admin_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Emplacement.id desc';
		$this->paginate['conditions']["Emplacement.deleted"] =  0 ; 
		//$this->paginate['conditions']["Emplacement.statut"] =  1 ;  
		if( !empty($this->data) ) {
			if (!empty ($this->data['Emplacement']['query'])){
				$query = $this->data['Emplacement']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Emplacement.id like '%$query%'",
																"TypeEmplacement.title like '%$query%'",
																"Annee.titre = '$query'"
																));
			}
			if (!empty ($this->data['Emplacement']['type'])){	
				$type = $this->data['Emplacement']['type'] ;
				$this->paginate['conditions']["Emplacement.typeEmplacement_id"] =  $type;
			}
		}
		$this->set('Emplacements',$this->paginate('Emplacement') ) ;
		$types = $this->Emplacement->TypeEmplacement->find('list',array('conditions'=>'TypeEmplacement.deleted = 0',
															'order'=>'TypeEmplacement.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
			
	function admin_supprimes() {
		$this->paginate = array(
							"conditions" => "Emplacement.deleted = 1",
							'recursive'=>2,
							'limit' => 20,
							"order" => "Emplacement.id desc"
							) ; 
		$marques = $this->Emplacement->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
														'order'=>'Marque.nom asc')); 
		/* $this->loadModel('Variete'); 
		$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
		$this->set('varietes',$varietes); */
		$this->set('marques',$marques);
		$this->set('Emplacements',$this->paginate('Emplacement') );
		$this->set('page_title','Liste des articles supprimés');
		$this->set('balise_h1','Liste des articles supprimés');
		$this->render('admin_index');
	}
	
	function admin_imprimer($id = null)  { 

        $id = intval($id); 
        $q = $this->Emplacement->findById($id) ;
		$this->set('Emplacement',$q) ;
		$division_id = $q["Member"]["division_id"];
		$this->loadModel ('Division');
		$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
		$this->set('div',$div) ;

		if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->set('download',true) ;
			$this->render('demande_Emplacement'); 
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
		$this->Emplacement->id = $id;
		$this->Emplacement->findById( $id ) ;
		$this->Emplacement->set('decision', 1) ;
		if( $this->Emplacement->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Emplacement a été \"Accordée\" avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_accordPartiel($id) {
		$this->Emplacement->id = $id;
		$this->Emplacement->findById( $id ) ;
		$this->Emplacement->set('decision', 2) ;
		if( $this->Emplacement->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Emplacement a été \"Accordée partiellement\".", 
				"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_refuser($id) {
		$this->Emplacement->id = $id;
		$this->Emplacement->findById( $id ) ;
		$this->Emplacement->set('decision', 3) ;
		if( $this->Emplacement->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Emplacement a été \"Refusée\".", 
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}
    		
    function admin_envoyer($id){
		$this->Emplacement->id = $id;
		$this->Emplacement->set('envoyer', 1) ;
		if( $this->Emplacement->save($this->data) ){
	        $this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				La décision a bien été envoyée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//envoyer la décision via un mail au demandeur d'Emplacement	
				$this->_sendMailDecisionEmplacement($id) ;
			 };
		$this->redirect("index")  ;

    }
	
    function admin_remonter ($id){
             // on va 
			$this->Emplacement->id = $id ; 
			$p = $this->Emplacement->read(array('position','categorie_id'))  ; 
			// si la position est superieur a 1  -1
			if($p['Emplacement']['position'] > 1 ) {
			             $new_position = $p['Emplacement']['position'] - 1 ; 
	  		             $this->Emplacement->saveField('position', $new_position) ; 
							// on ajoute 1 au Emplacement qui suit  dans la mme categorie
						$q = $this->Emplacement->find('first',array("conditions"=>array(
																				'and'=>array('position <'=>$new_position,
																							 'categorie_id'=>$p['Emplacement']['categorie_id']
																							 ) 
																					)
																) ) ;
						if(!empty($q)) {
								 // on ajoute 1 
								 $this->Emplacement->id = $q['Emplacement']['id'] ;						 
								 $new_position = $p['Emplacement']['position'] ; 
								 $this->Emplacement->saveField('position', $new_position ) ; 
								 }			 
						 
						 
						 
			}
			

			$this->redirect($this->referer() ) ;
     }		 
	function admin_descendre ($id){
	                        
			$this->Emplacement->id = $id ; 
			$p = $this->Emplacement->read(array('position','categorie_id'))  ; 
			$new_position = $p['Emplacement']['position'] + 1 ; 
		    $this->Emplacement->saveField('position', $new_position) ; 
			 
			
			// on decremente 1 du Emplacement qui suit  dans la mme cat
			$q = $this->Emplacement->find('first',array("conditions"=>array(
																	'and'=>array('position <'=>$new_position,
																    'categorie_id'=>$p['Emplacement']['categorie_id']
																	 ) 
													             )
									 ) ) ;
			if(!empty($q) && $q['Emplacement']['id'] >1 ) {
			         // on  -1
					 $this->Emplacement->id = $q['Emplacement']['id'] ;						 
					 $new_position = $p['Emplacement']['position']   ; 
					 $this->Emplacement->saveField('position', $new_position ) ; 
					 } 
			$this->redirect($this->referer() ) ;
	
	}

    function admin_delete($id){
        if($id!=null){
		    $this->Emplacement->id = $id ;
			$image1= $this->Emplacement->field('image') ;
			$image2= $this->Emplacement->field('image2Prod') ;
			$image3= $this->Emplacement->field('image3Prod') ;
            if($this->Emplacement->saveField('deleted',1) ) {
			   $this->Session->setFlash("Le Emplacement a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Emplacement." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
    }
		
	
	function region($id){
		$data["Emplacement"]=$this->Emplacement->find("all",array(
			"conditions" => array("Emplacement.statut = 1 and Emplacement.region=$id"),
						"order" => "Emplacement.id DESC"
		));
		$this->set('Emplacements',$data["Emplacement"]);
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
												 "Emplacement.description LIKE" => "%".$rech."%",
												 "Emplacement.tags LIKE" => "%".$rech."%",
												 "Emplacement.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Emplacements',$this->paginate('Emplacement'));
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
			if (!empty ($this->data['Emplacement']['submit_search']) && $this->data['Emplacement']['submit_search'] == $id_page ) {
				$this->data['Emplacement']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Emplacement']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDecisionEmplacement($Emplacement_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Emplacement->findById($Emplacement_id)  ;
		$this->set('Emplacement', $q );
		$this->Email->reset() ;
		$this->Email->to = $q['Member']['email'] ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Décision pour votre demande congé réf : '.$Emplacement_id ;
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'Emplacements/mail_decision_Emplacement'; // note no '.ctp'
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
	$chemin = './uploads/Emplacements/';
	
	
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