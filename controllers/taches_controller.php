<?php
class TachesController extends AppController{
    var $name ="Taches";
    var $components = array('Email',"RequestHandler","Session");
	var $helpers = array('Html', 'Form','Cksource'); 
	var $paginate = array(
							'limit' => 10,
							'recursive'=>1,
							'fields'=>"Tache.id, 
									   Tache.titre, 
									   Tache.slug,  
									   Tache.created, 
									   Tache.date_debut, 
									   Tache.nbr_equipe, 
									   Tache.texte, 
									   Tache.status, 
									   Tache.deleted, 
									   Tache.projet_id, 
									   Tache.user_id, 
									   Projet.id, 
									   Projet.nom, 
									   Projet.prenom, 
									   User.id, 
									   User.nom, 
									   User.prenom" ,
							'order' => "Tache.id desc" 
		);
	
//----------------------------------------- Member ----------------------------------------------

function member_afficher($id){

		$q = $this->Tache->findById ($id);

		//on vérifie si l'utilisateur a le droit d'afficher cette tâche (donc une tâche qui lui appartienne)

		if ($this->Session->read('Auth.Member.tache_id')!= $id){
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit d'afficher cette tâche.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/member/projets/index') ;
		}

		$this->set('tache',$q) ;

		$this->set('tache_id',$id) ; 

		$page_title = "Détail de la tache N° ".$q["Tache"]["id"] ;

		$id_tache = $q['Tache']['id'];

		$this->set('page_title', $page_title);

		$this->render('member_afficher') ;		

    }

//----------------------------------------- Admin ----------------------------------------------	

	function admin_index(){ 
		$this->paginate['conditions']["Tache.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Tache.id desc';
		$this->set('taches',$this->paginate('Tache') );
		$this->set('balise_h5',"Liste des tâches");
		$this->render('admin_index') ;


	}
	
		
	function admin_ajouter($projet_id){
		$q = $this->Tache->findById ($projet_id);
		$this->set('tache',$q) ;

		if( !empty($this->data) ) {	

			if( $this->Tache->save($this->data) ){

				$user_id = $this->Session->read('Auth.User.id');
				$this->data["Tache"]["user_id"] = $user_id;

				$this->data["Tache"]["projet_id"] = $projet_id;

				$date_debutfr = date('Y/m/d',strtotime($this->data["Tache"]["date_debut"])); 			
				$this->data["Tache"]["date_debut"] = $date_debutfr; 

				$date_limitefr = date('Y/m/d',strtotime($this->data["Tache"]["date_limite"])); 			
				$this->data["Tache"]["date_limite"] = $date_limitefr; 

	       		$this->Tache->save($this->data);

				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La nouvelle tâche de projet a bien été  ajoutée.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

				$this->redirect('/admin/projets/afficher/'.$projet_id) ;

			} ;
		} ;

		$this->loadModel('Projet');
		
		$q =  $this->Projet->find('first',array('conditions'=>array('Projet.id = '.$projet_id)));

		$id_projet = $q['Projet']['id'];

		$nom_projet = $q['Projet']['nom'];

		$this->set('id_projet', $id_projet);

		$this->set('nom_projet', $nom_projet);
		
	} 


	function admin_afficher($id){

		$q = $this->Tache->findById ($id);

		$tache_id = $this->Tache->find('first',array('conditions'=>array('Tache.id'=>$id)));	

		$this->set('tache',$q) ;

		$this->set('tache_id',$id) ; 

		$page_title = "Détail de la tache N° ".$q["Tache"]["id"] ;

		$id_tache = $q['Tache']['id'];


		$equipes =  $this->Tache->Member->find('all',array('conditions'=>array('Member.tache_id = '.$id_tache) ,
													 'order'=>'Member.created asc'
													)
										);
		$this->set('id_tache', $id_tache);	
		$this->set('equipes', $equipes);

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;		

    }

	function admin_modifier ($id){ 
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.User.id')!= $this->data['Tache']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier cette demande.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$projet_id = $this->data['Tache']['projet_id'];
			$this->redirect('/admin/projets/afficher/'.$projet_id) ;
		}
		// 
		$starDate_str_replace = str_replace("/","-",$this->data["Tache"]["date_debut"]);
		$endDate_str_replace = str_replace("/","-",$this->data["Tache"]["date_limite"]);

		$date_debut_en = date('Y-m-d',strtotime($starDate_str_replace)); 
		$this->data["Tache"]["date_debut"] = $date_debut_en; 

		$date_limite_en = date('Y-m-d',strtotime($endDate_str_replace)); 
		$this->data["Tache"]["date_limite"] = $date_limite_en;
		// a refiare
		// mysql_query("update projets set nbr_equipe = nbr_equipe + 1 where id=$projet_id") ;

		if($this->Tache->save($this->data) )  {
			// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD 
			$this->Tache->save($this->data);	 
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La tâche a été modifiée avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			$projet_id = $this->data['Tache']['projet_id'];
			$this->redirect('/admin/projets/afficher/'.$projet_id) ;
			}
		} 
		$this->data = $this->Tache->read(array(),$id) ;
		$q = $this->Tache->findById($id)  ;
		$this->set('tache', $q );
		$this->set('id_tache', $id);		
		
	}
			
	function admin_supprimer() {
		if($id!=null){
		    $this->Tache->id = $id ;
            if($this->Tache->saveField('deleted',1) ) {
			   $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La tâche a été suprimée avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Une erreur a été rencontré lors de la suppression de la tâche.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}
	
	function admin_ajouter_equipe($id=null){

		$t = $this->Tache->findById($id);
		$this->set('tache',$t) ;
		$this->loadModel('Member');
		if(isset($this->data)){
			if( $this->Member->save($this->data) ){			
				$member = array();
				$member_id = $this->Member->id ;
				$member['Member']['id'] = $member_id ;
				$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id) )); 
				$tache_id = $q['Member']['tache_id'];
				//faire une sauvegarde des information
				$this->Member->saveAll($this->data);					
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le membre de l'équipe a été ajouté avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				
				mysql_query("update taches set nbr_equipe = nbr_equipe + 1 where id=$tache_id") ;

                $this->redirect($this->referer()) ;	 
			}else{
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Erreur lors de l'ajout de membre.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;	 
        		}			
        }
        $id_tache = $t['Tache']['id'];
        $id_projet = $t['Tache']['projet_id'];


        $members =  $this->Tache->Member->find('list',array(
        											'conditions'=>array('Member.tache_id =! '.$id_tache,
        																'Member.projet_id = '.$id_projet,
        																'Member.deleted = 0'),
													'fields'=>array("Member.nom"),
													'order'=>'Member.nom asc'
													)
										);

        $equipes =  $this->Tache->Member->find('all',array('conditions'=>array('Member.tache_id = '.$id_tache ,'Member.deleted = 0') ,
													 'recursive'=>1,
													 'order'=>'Member.id asc'
													)
										);
		
		

		$this->set('id_tache', $id_tache);


		
		$this->set('members', $members);

		$this->set('equipes', $equipes);		

		
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