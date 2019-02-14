<?php
class EquipesController extends AppController{
    var $name ="Equipes";
    var $components = array('Email',"RequestHandler","Session");
	var $helpers = array('Html', 'Form','Cksource'); 
	var $paginate = array(
							'limit' => 10,
							'recursive'=>1,
							'fields'=>"Depense.id, 
									   Depense.objet, 
									   Depense.slug, 
									   Depense.montant_net, 
									   Depense.created, 
									   Depense.date_signature, 
									   Depense.telecharge, 
									   Depense.nbr_benef, 
									   Depense.deleted, 
									   Depense.signataire_id, 
									   Signataire.id, 
									   Signataire.nom, 
									   Signataire.prenom, 
									   User.id, 
									   User.nom, 
									   User.prenom" ,
							'order' => "Depense.id desc" 
		);
	
//----------------------------------------- Admin ----------------------------------------------	

	function admin_index(){ 
		$this->paginate['conditions']["Depense.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Depense.id desc';
		$this->set('depenses',$this->paginate('Depense') );
		$this->set('balise_h5',"Liste des dépenses indemnité");
		$this->render('admin_index') ;
	}
	
		
	function admin_ajouter(){

		if( !empty($this->data) ) {	


			$date_signaturefr = date('Y/m/d',strtotime($this->data["Depense"]["date_signature"])); 
			
			$this->data["Depense"]["date_signature"] = $date_signaturefr; 
		
	       	if( $this->Depense->save($this->data) ){

				$depense_id = $this->Depense->getLastInsertId();	

	       		$this->Depense->save($this->data);

	       		// mysql_query("update absences set nbr_benef = nbr_benef + 1 where id=$depense_id" ) ;// ajouter 1
				
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La nouvelle liste des indemnités a bien été  ajoutée.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

				$this->redirect('/admin/depenses/afficher/'.$depense_id) ;

			}; 

		} ;

		$signataires = $this->Depense->Signataire->find('list',array('fields'=>array('Signataire.id','Signataire.nom'),'order'=>'Signataire.nom asc'));

	   	$this->set('signataires',$signataires);
		
	} 


	function admin_afficher($id){

		$q = $this->Depense->findById ($id);

		$depense_id = $this->Depense->find('first',array('conditions'=>array('Depense.id'=>$id)));	

		$this->set('depense',$q) ;

		$this->set('depense_id',$id) ; 

		$page_title = "Détail du dépense indemnité N° ".$q["Depense"]["id"] ;

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;					 
    }

	function admin_modifier ($id){ 
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.User.id')!= $this->data['Indemnite']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier cette demande.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/admin/gestion-Indemnites.html') ;
		}
		
		// 
		$starDate_str_replace = str_replace("/","-",$this->data["Indemnite"]["date_debut"]);
		$endDate_str_replace = str_replace("/","-",$this->data["Indemnite"]["date_fin"]);

		// 
		$start_date = date('d-m-Y',strtotime($starDate_str_replace));
		$end_date = date('d-m-Y',strtotime($endDate_str_replace));
		// Return difference
		$duree = round(($end_date - $start_date), 0);
		$this->data["Indemnite"]["duree"] = $duree;  
		// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD
		
		$date_debut_fr = date('Y/m/d',strtotime($this->data["Indemnite"]["date_debut"])); 
		$this->data["Indemnite"]["date_debut"] = $date_debut_fr; 

		$date_fin_fr = date('Y/m/d',strtotime($this->data["Indemnite"]["date_fin"])); 
		$this->data["Indemnite"]["date_fin"] = $date_fin_fr;

		mysql_query("update Indemnites set envoyer = 0 where id=$id" ) ;
		mysql_query("update Indemnites set decision = 0 where id=$id" ) ;
		if($this->Indemnite->save($this->data) )  {
			// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD 
			$this->Indemnite->save($this->data);	 
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Indemnite a été modifiée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			$this->redirect('/admin/gestion-Indemnites.html') ;
			}
		}  
		$this->data = $this->Indemnite->read(array(),$id) ;

		$q = $this->Indemnite->findById($id)  ;
		$this->set('Indemnite', $q );
		$this->set('typeIndemnites', $this->Indemnite->TypeIndemnite->find('list',array('order'=>'TypeIndemnite.title asc'))) ; 
	
		$this->set('annees', $this->Indemnite->Annee->find('list',array(
																'fields'=>"Annee.titre",
																'order'=>'Annee.id desc'
																)
											)) ; 
	}

	function admin_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Indemnite.id desc';
		$this->paginate['conditions']["Indemnite.deleted"] =  0 ; 
		//$this->paginate['conditions']["Indemnite.statut"] =  1 ;  
		if( !empty($this->data) ) {
			if (!empty ($this->data['Indemnite']['query'])){
				$query = $this->data['Indemnite']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Indemnite.id like '%$query%'",
																"TypeIndemnite.title like '%$query%'",
																"Annee.titre = '$query'"
																));
			}
			if (!empty ($this->data['Indemnite']['type'])){	
				$type = $this->data['Indemnite']['type'] ;
				$this->paginate['conditions']["Indemnite.typeIndemnite_id"] =  $type;
			}
		}
		$this->set('Indemnites',$this->paginate('Indemnite') ) ;
		$types = $this->Indemnite->TypeIndemnite->find('list',array('conditions'=>'TypeIndemnite.deleted = 0',
															'order'=>'TypeIndemnite.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
			
	function admin_supprimes() {
		$this->paginate = array(
							"conditions" => "Indemnite.deleted = 1",
							'recursive'=>2,
							'limit' => 20,
							"order" => "Indemnite.id desc"
							) ; 
		$marques = $this->Indemnite->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
														'order'=>'Marque.nom asc')); 
		/* $this->loadModel('Variete'); 
		$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
		$this->set('varietes',$varietes); */
		$this->set('marques',$marques);
		$this->set('Indemnites',$this->paginate('Indemnite') );
		$this->set('page_title','Liste des articles supprimés');
		$this->set('balise_h1','Liste des articles supprimés');
		$this->render('admin_index');
	}
	
	function admin_imprimer($id = null)  { 

        $id = intval($id); 
        $q = $this->Indemnite->findById($id) ;
		$this->set('Indemnite',$q) ;
		$division_id = $q["Member"]["division_id"];
		$this->loadModel ('Division');
		$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
		$this->set('div',$div) ;

		if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->set('download',true) ;
			$this->render('demande_Indemnite'); 
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
		$this->Indemnite->id = $id;
		$this->Indemnite->findById( $id ) ;
		$this->Indemnite->set('decision', 1) ;
		if( $this->Indemnite->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Indemnite a été \"Accordée\" avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_accordPartiel($id) {
		$this->Indemnite->id = $id;
		$this->Indemnite->findById( $id ) ;
		$this->Indemnite->set('decision', 2) ;
		if( $this->Indemnite->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Indemnite a été \"Accordée partiellement\".", 
				"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_refuser($id) {
		$this->Indemnite->id = $id;
		$this->Indemnite->findById( $id ) ;
		$this->Indemnite->set('decision', 3) ;
		if( $this->Indemnite->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Indemnite a été \"Refusée\".", 
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}
    		
    function admin_envoyer($id){
		$this->Indemnite->id = $id;
		$this->Indemnite->set('envoyer', 1) ;
		if( $this->Indemnite->save($this->data) ){
	        $this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				La décision a bien été envoyée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//envoyer la décision via un mail au demandeur d'Indemnite	
				$this->_sendMailDecisionIndemnite($id) ;
			 };
		$this->redirect("index")  ;

    }
	
    function admin_remonter ($id){
             // on va 
			$this->Indemnite->id = $id ; 
			$p = $this->Indemnite->read(array('position','categorie_id'))  ; 
			// si la position est superieur a 1  -1
			if($p['Indemnite']['position'] > 1 ) {
			             $new_position = $p['Indemnite']['position'] - 1 ; 
	  		             $this->Indemnite->saveField('position', $new_position) ; 
							// on ajoute 1 au Indemnite qui suit  dans la mme categorie
						$q = $this->Indemnite->find('first',array("conditions"=>array(
																				'and'=>array('position <'=>$new_position,
																							 'categorie_id'=>$p['Indemnite']['categorie_id']
																							 ) 
																					)
																) ) ;
						if(!empty($q)) {
								 // on ajoute 1 
								 $this->Indemnite->id = $q['Indemnite']['id'] ;						 
								 $new_position = $p['Indemnite']['position'] ; 
								 $this->Indemnite->saveField('position', $new_position ) ; 
								 }			 
						 
						 
						 
			}
			

			$this->redirect($this->referer() ) ;
     }		 
	function admin_descendre ($id){
	                        
			$this->Indemnite->id = $id ; 
			$p = $this->Indemnite->read(array('position','categorie_id'))  ; 
			$new_position = $p['Indemnite']['position'] + 1 ; 
		    $this->Indemnite->saveField('position', $new_position) ; 
			 
			
			// on decremente 1 du Indemnite qui suit  dans la mme cat
			$q = $this->Indemnite->find('first',array("conditions"=>array(
																	'and'=>array('position <'=>$new_position,
																    'categorie_id'=>$p['Indemnite']['categorie_id']
																	 ) 
													             )
									 ) ) ;
			if(!empty($q) && $q['Indemnite']['id'] >1 ) {
			         // on  -1
					 $this->Indemnite->id = $q['Indemnite']['id'] ;						 
					 $new_position = $p['Indemnite']['position']   ; 
					 $this->Indemnite->saveField('position', $new_position ) ; 
					 } 
			$this->redirect($this->referer() ) ;
	
	}

    function admin_delete($id){
        if($id!=null){
		    $this->Indemnite->id = $id ;
			$image1= $this->Indemnite->field('image') ;
			$image2= $this->Indemnite->field('image2Prod') ;
			$image3= $this->Indemnite->field('image3Prod') ;
            if($this->Indemnite->saveField('deleted',1) ) {
			   $this->Session->setFlash("Le Indemnite a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Indemnite." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
    }
		
	
	function region($id){
		$data["Indemnite"]=$this->Indemnite->find("all",array(
			"conditions" => array("Indemnite.statut = 1 and Indemnite.region=$id"),
						"order" => "Indemnite.id DESC"
		));
		$this->set('Indemnites',$data["Indemnite"]);
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
												 "Indemnite.description LIKE" => "%".$rech."%",
												 "Indemnite.tags LIKE" => "%".$rech."%",
												 "Indemnite.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Indemnites',$this->paginate('Indemnite'));
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
			if (!empty ($this->data['Indemnite']['submit_search']) && $this->data['Indemnite']['submit_search'] == $id_page ) {
				$this->data['Indemnite']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Indemnite']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDecisionIndemnite($Indemnite_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Indemnite->findById($Indemnite_id)  ;
		$this->set('Indemnite', $q );
		$this->Email->reset() ;
		$this->Email->to = $q['Member']['email'] ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Décision pour votre demande congé réf : '.$Indemnite_id ;
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'Indemnites/mail_decision_Indemnite'; // note no '.ctp'
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
	$chemin = './uploads/Indemnites/';
	
	
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