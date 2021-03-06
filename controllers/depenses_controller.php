<?php
class DepensesController extends AppController{
    var $name ="Depenses";
    var $components = array('Email',"RequestHandler","Session");
	var $helpers = array('Html', 'Form','Cksource','Phpexcel'); 
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

			}else{ 
				unset($this->data['Depense']['date_signature']) ;
			 $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Erreur..", 
				"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));

		}

		} 
		

		$signataires = $this->Depense->Signataire->find('list',array('fields'=>array('Signataire.id','Signataire.nom'),'order'=>'Signataire.nom asc'));

	   	$this->set('signataires',$signataires);
		
	} 


	function admin_afficher($id){

		$q = $this->Depense->findById ($id);

				
		$this->set('depense',$q) ;

		$this->set('depense_id',$id) ; 

		$page_title = "Détail du dépense indemnité N° ".$q["Depense"]["id"] ;

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;					 
    }

	function admin_modifier ($id){ 
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.User.id')!= $this->data['Depense']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier cette demande.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/admin/gestion-depenses.html') ;
		}
		
		
		// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD
		
		$date_signature_fr = date('Y/m/d',strtotime($this->data["Depense"]["date_signature"])); 
		$this->data["Depense"]["date_signature"] = $date_signature_fr; 

		
		if($this->Depense->save($this->data) )  {
			// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD 
			$this->Depense->save($this->data);	 
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le depense a été modifié avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			$this->redirect('/admin/depenses/afficher/'.$id) ;
			}
		}  
		$this->data = $this->Depense->read(array(),$id) ;

		$q = $this->Depense->findById($id)  ;
		$this->set('depense', $q ); 
	}

	function admin_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Depense.id desc';
		$this->paginate['conditions']["Depense.deleted"] =  0 ; 
		//$this->paginate['conditions']["Depense.statut"] =  1 ;  
		if( !empty($this->data) ) {
			if (!empty ($this->data['Depense']['query']) || !empty ($this->data['Depense']['date_debut']) || !empty ($this->data['Depense']['date_fin'])){
				$query = $this->data['Depense']['query'] ;
				$date_debut = $this->data['Depense']['date_debut'] ;
				$date_fin = $this->data['Depense']['date_fin*'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Depense.id like '%$query%'",
																"Depense.objet like '%$query%'",
																"Depense.created >= ".$date_debut,
																"Depense.created <= ".$date_fin,
																"Depense.objet like '%$query%'"
																));
			}
		}
		$this->set('Depenses',$this->paginate('Depense') ) ;
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
			
	function admin_supprimes() {
		$this->paginate = array(
							"conditions" => "Depense.deleted = 1",
							'recursive'=>2,
							'limit' => 20,
							"order" => "Depense.id desc"
							) ; 
		$marques = $this->Depense->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
														'order'=>'Marque.nom asc')); 
		/* $this->loadModel('Variete'); 
		$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
		$this->set('varietes',$varietes); */
		$this->set('marques',$marques);
		$this->set('Depenses',$this->paginate('Depense') );
		$this->set('page_title','Liste des articles supprimés');
		$this->set('balise_h1','Liste des articles supprimés');
		$this->render('admin_index');
	}
	
	function admin_imprimer($id = null)  { 

        $id = intval($id);  
        $q = $this->Depense->findById($id) ;
		$this->set('Depense',$q) ;
		$division_id = $q["Member"]["division_id"];
		$this->loadModel ('Division');
		$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
		$this->set('div',$div) ;

		if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->set('download',true) ;
			$this->render('demande_Depense'); 
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

    function admin_telecharger($id = null)  { 

        $id = intval($id); 
        $q = $this->Depense->findById($id) ;
		$this->set('depense',$q) ;
		

		if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
			$this->layout = null;
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

    /*function admin_telecharger($id) {
    	$Depenses =  $this->Depense->Depense->find('all',array('conditions'=>array('Depense.depense_id = '.$id) ,
													 'order'=>'Depense.created asc'
													)
										);

		$this->set('Depenses',$Depenses) ;
	    $this->layout = null;
	    $this->autoLayout = false;
	}*/
	
	// Décision : Refusée = 3 / Accord Partiel = 2  / Accordée = 1 / En cours de traitement = 0 par default
	function admin_accorder($id) {
		$this->Depense->id = $id;
		$this->Depense->findById( $id ) ;
		$this->Depense->set('decision', 1) ;
		if( $this->Depense->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Depense a été \"Accordée\" avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_accordPartiel($id) {
		$this->Depense->id = $id;
		$this->Depense->findById( $id ) ;
		$this->Depense->set('decision', 2) ;
		if( $this->Depense->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Depense a été \"Accordée partiellement\".", 
				"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}

	function admin_refuser($id) {
		$this->Depense->id = $id;
		$this->Depense->findById( $id ) ;
		$this->Depense->set('decision', 3) ;
		if( $this->Depense->save() ){	
		    $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La demande d'Depense a été \"Refusée\".", 
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
		
		};
		$this->redirect($this->referer())  ;
	}
    		
    function admin_envoyer($id){
		$this->Depense->id = $id;
		$this->Depense->set('envoyer', 1) ;
		if( $this->Depense->save($this->data) ){
	        $this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				La décision a bien été envoyée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//envoyer la décision via un mail au demandeur d'Depense	
				$this->_sendMailDecisionDepense($id) ;
			 };
		$this->redirect("index")  ;

    }
	
    function admin_remonter ($id){
             // on va 
			$this->Depense->id = $id ; 
			$p = $this->Depense->read(array('position','categorie_id'))  ; 
			// si la position est superieur a 1  -1
			if($p['Depense']['position'] > 1 ) {
			             $new_position = $p['Depense']['position'] - 1 ; 
	  		             $this->Depense->saveField('position', $new_position) ; 
							// on ajoute 1 au Depense qui suit  dans la mme categorie
						$q = $this->Depense->find('first',array("conditions"=>array(
																				'and'=>array('position <'=>$new_position,
																							 'categorie_id'=>$p['Depense']['categorie_id']
																							 ) 
																					)
																) ) ;
						if(!empty($q)) {
								 // on ajoute 1 
								 $this->Depense->id = $q['Depense']['id'] ;						 
								 $new_position = $p['Depense']['position'] ; 
								 $this->Depense->saveField('position', $new_position ) ; 
								 }			 
						 
						 
						 
			}
			

			$this->redirect($this->referer() ) ;
     }		 
	function admin_descendre ($id){
	                        
			$this->Depense->id = $id ; 
			$p = $this->Depense->read(array('position','categorie_id'))  ; 
			$new_position = $p['Depense']['position'] + 1 ; 
		    $this->Depense->saveField('position', $new_position) ; 
			 
			
			// on decremente 1 du Depense qui suit  dans la mme cat
			$q = $this->Depense->find('first',array("conditions"=>array(
																	'and'=>array('position <'=>$new_position,
																    'categorie_id'=>$p['Depense']['categorie_id']
																	 ) 
													             )
									 ) ) ;
			if(!empty($q) && $q['Depense']['id'] >1 ) {
			         // on  -1
					 $this->Depense->id = $q['Depense']['id'] ;						 
					 $new_position = $p['Depense']['position']   ; 
					 $this->Depense->saveField('position', $new_position ) ; 
					 } 
			$this->redirect($this->referer() ) ;
	
	}

    function admin_delete($id){
        if($id!=null){
		    $this->Depense->id = $id ;
			$image1= $this->Depense->field('image') ;
			$image2= $this->Depense->field('image2Prod') ;
			$image3= $this->Depense->field('image3Prod') ;
            if($this->Depense->saveField('deleted',1) ) {
			   $this->Session->setFlash("Le Depense a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Depense." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
    }
		
	
	function region($id){
		$data["Depense"]=$this->Depense->find("all",array(
			"conditions" => array("Depense.statut = 1 and Depense.region=$id"),
						"order" => "Depense.id DESC"
		));
		$this->set('Depenses',$data["Depense"]);
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
												 "Depense.description LIKE" => "%".$rech."%",
												 "Depense.tags LIKE" => "%".$rech."%",
												 "Depense.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Depenses',$this->paginate('Depense'));
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
			if (!empty ($this->data['Depense']['submit_search']) && $this->data['Depense']['submit_search'] == $id_page ) {
				$this->data['Depense']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Depense']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDecisionDepense($Depense_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Depense->findById($Depense_id)  ;
		$this->set('Depense', $q );
		$this->Email->reset() ;
		$this->Email->to = $q['Member']['email'] ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Décision pour votre demande congé réf : '.$Depense_id ;
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'Depenses/mail_decision_Depense'; // note no '.ctp'
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
	$chemin = './uploads/Depenses/';
	
	
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