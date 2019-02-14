<?php
class ProjetsController extends AppController{
    var $name ="Projets";
    var $components = array('Email',"RequestHandler","Session");
	var $helpers = array('Html', 'Form','Cksource'); 
	var $paginate = array(
						'limit' => 10,
						'recursive'=>1,
						'fields'=>"Projet.id, 
								   Projet.nom, 
								   Projet.slug, 
								   Projet.description, 
								   Projet.created, 
								   Projet.date_limite, 
								   Projet.nbr_equipe, 
								   Projet.status, 
								   Projet.deleted, 
								   Projet.user_id, 
								   User.id, 
								   User.nom, 
								   User.prenom" ,
						'order' => "Projet.id desc" 
		);
	
//----------------------------------------- member ----------------------------------------------	

	function member_index(){ 
		$projet_id = $this->Session->read('Auth.Member.projet_id');
		$projets =  $this->Projet->find('all',array('conditions'=>array('Projet.deleted = 0',
																		'Projet.id ='.$projet_id ) ,
													 'order'=>'Projet.created asc'
													)
										);

		$this->set('projets',$projets) ;
		$this->set('balise_h5',"Liste des projéts");
		$this->render('member_index') ;
	}

	function member_afficher($id){

		$q = $this->Projet->findById ($id);

		//on vérifie si l'utilisateur a le droit d'afficher ce projet (donc un projet qui lui appartien)

		if ($this->Session->read('Auth.Member.projet_id')!= $id){
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span> 
					</button>
					Vous n'avez pas le droit d'afficher ce projet.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/member/projets/index') ;
		}

		$this->loadModel('Member');

		$tache_member = $this->Session->read('Auth.Member.tache_id');

		$taches =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.id = '.$tache_member,
																			  'Tache.projet_id = '.$id),
												  		  'order'=>'Tache.created asc'
												    	)
											);

		$page_title = "Détail de projet: ".$q["Projet"]["nom"] ;

		$this->set('taches',$taches) ;

		$this->set('projet_id',$id) ; 

		$this->set('projet',$q) ;

		$this->set('page_title', $page_title);

		$this->render('member_afficher') ;

    }



//----------------------------------------- Admin ----------------------------------------------	

	function admin_index(){ 
		$this->paginate['conditions']["Projet.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Projet.id desc';
		$this->set('projets',$this->paginate('Projet') );
		$this->set('balise_h5',"Liste des projéts");
		$this->render('admin_index') ;
	}
	 
		
	function admin_ajouter(){

		if( !empty($this->data) ) {

			$this->data['Projet']['created']  = date('Y-m-d') ;

			$this->data['Projet']['user_id'] = $this->Session->read('Auth.User.id') ;

	       	if( $this->Projet->save($this->data) ){

				$projet_id = $this->Projet->getLastInsertId();	

	       		$this->Projet->save($this->data);

	       		mysql_query("update projet set nbr_benef = nbr_benef + 1 where id=$projet_id" ) ;// ajouter 1
				
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le nouveau projet a bien été  ajouté.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

				$this->redirect('/admin/projets/afficher/'.$projet_id) ;

			}; 

		} ;
		
	} 


	function admin_afficher($id){

		$q = $this->Projet->findById ($id);

		$taches =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.projet_id = '.$id) ,
													 'order'=>'Tache.created asc'
													)
										);

        $equipes =  $this->Projet->Member->find('all',array('conditions'=>array('Member.projet_id = '.$id ,'Member.deleted = 0') ,
													 'recursive'=>1,
													 'order'=>'Member.id asc'
													)
										);

		$page_title = "Détail de projet: ".$q["Projet"]["nom"] ;
		// Calendrier des tâches  - a refaire !!!!!!
		 
		// Lundi
		$taches_lundi =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.projet_id = '.$id,
																					) ,
																'order'=>'Tache.created asc'
																)
													);

		$this->set('taches_lundi',$taches_lundi) ;
		//
		// Mardi
		$taches_mardi =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.projet_id = '.$id,
																					) ,
																'order'=>'Tache.created asc'
																)
													);

		$this->set('taches_mardi',$taches_mardi) ;
		//
		// Mercredi
		$taches_mercredi =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.projet_id = '.$id,
																					) ,
																'order'=>'Tache.created asc'
																)
													);

		$this->set('taches_mercredi',$taches_mercredi) ;
		//
		// Jeudi
		$taches_jeudi =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.projet_id = '.$id,
																					) ,
																'order'=>'Tache.created asc'
																)
													);

		$this->set('taches_jeudi',$taches_jeudi) ;
		//
		// Vendredi
		$taches_vendredi =  $this->Projet->Tache->find('all',array('conditions'=>array('Tache.projet_id = '.$id,
																					) ,
																'order'=>'Tache.created asc'
																)
													);

		$this->set('taches_vendredi',$taches_vendredi) ;
		//

		// Fin Calendrier

		$this->set('taches',$taches) ;

		$this->set('projet',$q) ;

		$this->set('projet_id',$id) ; 

		$this->set('page_title', $page_title);

		$this->set('equipes', $equipes);

		$this->render('admin_afficher') ;	


    } 

	function admin_modifier ($id){ 
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.User.id')!= $this->data['Projet']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Vous n'avez pas le droit de modifier cette demande.",
				"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/admin/projets/index') ;
		}
		// print_r($this->data);
		$date_limite_en_str_replace = str_replace("/","-",$this->data["Projet"]["date_limite"]);	
		$date_limite_en = date('Y-m-d',strtotime($date_limite_en_str_replace)); 
		$this->data["Projet"]["date_limite"] = $date_limite_en;  

		if($this->Projet->save($this->data))  {
			$this->Projet->save($this->data);	 
			$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le projet a été modifié avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			$this->redirect('/admin/projets/afficher/'.$id) ;
			}
		}  
		$this->data = $this->Projet->read(array(),$id) ;

		$q = $this->Projet->findById($id)  ;
		$this->set('projet', $q );

	}

	function admin_rechercher() {
		$query = NULL ;
		// $this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Projet.created asc';
		$this->paginate['conditions']["Projet.deleted"] =  0 ; 
		//$this->paginate['conditions']["Projet.statut"] =  1 ;  
		if( !empty($this->data) ) {
			if (!empty ($this->data['Projet']['query'])){
				$query = $this->data['Projet']['query'] ;
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Projet.id like '%$query%'",
																"Projet.nom like '%$query%'"
																));

			}elseif ($this->data['Projet']['date_debut'] != 01/01/1970){	
				$date_debut_str_replace = str_replace("/","-",$this->data["Projet"]["date_debut"]);
				$date_debut_en = date('Y-m-d',strtotime($date_debut_str_replace)); 
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Projet.created > '$date_debut_en'",
																"Projet.created = '$date_debut_en'"
																));
			}elseif ($this->data['Projet']['date_fin'] != 01/01/1970){	
				$date_fin_str_replace = str_replace("/","-",$this->data["Projet"]["date_fin"]);
				$date_fin_en = date('Y-m-d',strtotime($date_fin_str_replace));
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Projet.created < '$date_fin_en'",
																"Projet.created = '$date_fin_en'"
																));
			}
		}
		/*$types = $this->Projet->find('list',array('conditions'=>'Typeabsence.deleted = 0',
															'order'=>'Typeabsence.title asc'));
		$this->set('types',$types);*/
		$this->set('projets',$this->paginate('Projet') ) ;
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
			
	function admin_supprimer($id) {  
		if($id!=null){
		    $this->Projet->id = $id ;
            if($this->Projet->saveField('deleted',1) ) {
			   $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le projet a été suprimé avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Une erreur a été rencontré lors de la suppression du projet.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	}
	
	
	function admin_ajouter_equipe($id=null){
		$p = $this->Projet->findById($id);
		$this->set('projet',$p) ;

		$this->loadModel('Member');
		if(isset($this->data)){
			if( $this->Member->save($this->data) ){			
				$member = array();
				$member_id = $this->Member->id ;
				$member['Member']['id'] = $member_id ;
				$q = $this->Member->find('first',array('conditions'=>array("Member.id"=> $member_id) )); 
				$projet_id = $q['Member']['projet_id'];
				//faire une sauvegarde des information
				$this->Member->saveAll($this->data);					
				$this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					Le membre de l'équipe a été ajouté avec succès.", 
				"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				
				mysql_query("update projets set nbr_equipe = nbr_equipe + 1 where id=$projet_id") ;

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
        $id_projet = $p['Projet']['id'];

        $members =  $this->Projet->Member->find('list',array(
        											'conditions'=>array('Member.projet_id =! '.$id_projet,'Member.deleted = 0'),
													'fields'=>array("Member.nom"),
													'order'=>'Member.nom asc'
													)
										);

        $equipes =  $this->Projet->Member->find('all',array('conditions'=>array('Member.projet_id = '.$id_projet ,'Member.deleted = 0') ,
													 'recursive'=>1,
													 'order'=>'Member.id asc'
													)
										);
		
		$nom_projet = $p['Projet']['nom'];

		$this->set('id_projet', $id_projet);

		$this->set('nom_projet', $nom_projet);
		
		$this->set('members', $members);

		$this->set('equipes', $equipes);	
	} 

	function admin_deletEquipe($id) {
		if($id!=null){
			$this->Member->id = $id;
			if($this->Member->saveField('active',0) ) {
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le member a été désactivé avec succès.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//
			 } ; 
			$this->redirect($this->referer()) ;
		}
	}

    function admin_terminer($id) { 
    	if($id!=null){
			$this->Projet->id = $id;
			if($this->Projet->saveField('status',1) ) { // Terminé
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Le projet a été terminé !",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				//
			 } ; 
			$this->redirect($this->referer()) ;
		}
	}
		
// -----------------------------------------------------------------------------------------------

	function _quelJour($date){
    
	    $reg = new RegExp("[/]+", "g");
	    $NomJour = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
	    $tabDate = $date.split($reg);
	    $dateUnix = date($tabDate[2], $tabDate[1]-1, $tabDate[0]);
	    $Jour = $NomJour[$dateUnix.getDay()];
	    return $Jour;
	}
		
	function _friendlyURL($string){
		$string = preg_replace("`\[.*\]`U","",$string);
		$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
		$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
		return strtolower(trim($string, '-'));
    }
	
/*----------------Fonctions locales -------------------------------------------------------------------------*/
		
	function _sendMailInfoProjet($Projet_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Projet->findById($Projet_id)  ;
		$this->Email->reset() ;
		$this->Email->to = $q['User']['email'] ;
		$nom_projet = $q['Projet']['nom'] ;
		$this->Email->subject = 'Projet: '.$nom_projet ;
		$this->set('projet', $q );
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'projets/mail_info_projet'; // note no '.ctp'
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
	$chemin = './uploads/projets/';
	
	
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