<?php
class AbsencesController extends AppController{
    var $name ="Absences";
    var $components = array('Email',"RequestHandler","Session");
	var $helpers = array('Html', 'Form','Cksource'); 
	var $paginate = array(
							'limit' => 10,
							'recursive'=>1,
							'fields'=>"Absence.id, Absence.created, Absence.status, Absence.satisfaction, Absence.envoyer, Absence.remarque, Absence.duree, Absence.date_debut, Absence.date_fin, Absence.nbr_jrs, Absence.commentaire, Absence.member_id, Absence.user_id, Absence.annee_id, Absence.deleted, Absence.decision, Annee.id, Annee.titre, Member.id, Member.nom, Member.prenom, User.id, User.nom, User.prenom, Member.grade, Member.division_id, Typeabsence.id, Typeabsence.slug, Typeabsence.title" ,
							'order' => "Absence.id desc" 
		);
	
	
	

	
//---------------------------------------------------------- Gestion Member ----------------------------------------------------------	


	function member_index() {
		$this->paginate['conditions']["Absence.member_id"] = $this->Session->read('Auth.Member.id')   ; 
		$this->paginate['conditions']["Absence.deleted"] = 0   ; 
		$this->paginate['limit'] = 30 ; 
		$this->paginate['order'] = 'Absence.id desc';
		$this->set('absences',$this->paginate('Absence') );
		$types = $this->Absence->Typeabsence->find('list',array('conditions'=>'Typeabsence.deleted = 0',
															'order'=>'Typeabsence.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Liste des demandes");
		$this->set('page_title','Gestion des absences');
		$this->render('member_index') ;
	}

	function member_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 30;
		$this->paginate['order'] = 'Absence.id desc';
		$this->paginate['conditions']["Absence.deleted"] =  0 ; 
		//$this->paginate['conditions']["Absence.statut"] =  1 ; 
		$this->paginate['conditions']["Absence.member_id"] =  $this->Session->read('Auth.Member.id')  ; 
		if( !empty($this->data) ) {
			if (!empty ($this->data['Absence']['query'])){
				$query = $this->data['Absence']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Absence.id like '%$query%'",
																"Typeabsence.title like '%$query%'",
																"Annee.titre = '$query'"
																));
			}
			if (!empty ($this->data['Absence']['type'])){	
				$type = $this->data['Absence']['type'] ;
				$this->paginate['conditions']["Absence.typeabsence_id"] =  $type;
			}
		}
		$this->set('absences',$this->paginate('Absence') ) ;
		$types = $this->Absence->Typeabsence->find('list',array('conditions'=>'Typeabsence.deleted = 0',
															'order'=>'Typeabsence.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('member_index') ; 
	}
	
	
	function member_afficher($id, $type_absence_slug = NULL) { 
		
		$site_name = Configure::read('site_name');

		// if( $this->data['Absence']['member_id'] == $this->Session->read('Auth.Member.id')) {

			$q = $this->Absence->findById ($id);

			$this->loadModel('Annee');		
			$this->loadModel('Typeabsence');		

			$type_absence_slug = $q['Typeabsence']["slug"];

			$absence_id = $this->Absence->find('first',array(
														'fields'=>"Absence.id,
																   Absence.created ,
																   Absence.duree,
																   Absence.date_debut,
																   Absence.date_fin,
																   Absence.nbr_jrs,
																   Absence.commentaire,
																   Absence.status,
																   Absence.envoyer,
																   Annee.titre,
																   Typeabsence.title,
																   Typeabsence.slug,
																   Absence.annee_id,
																   Absence.typeabsence_id",
														'conditions'=>array('Absence.id'=>$id,'Typeabsence.slug'=>$type_absence_slug))
											);	

			$this->set('absence',$q) ;

			$this->set('absence_id',$id) ; 

			$page_title = "Détail de la demande ".$q["Typeabsence"]["title"] ;

			$this->set('page_title', $page_title);

			$this->render('member_afficher') ;
		// }
	}

	function member_ajouter (){	//ajouter un Absence  
		
		if( !empty($this->data) ) {
			$member_id = $this->Session->read('Auth.Member.id');
			$this->data["Absence"]["member_id"] = $member_id;

			// 
			$starDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_debut"]);
			$endDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_fin"]);

			// Pour calculer le duree
			$start_date = date('d-m-Y',strtotime($starDate_str_replace));
			$end_date = date('d-m-Y',strtotime($endDate_str_replace));
			// Return difference
			$duree = round(($end_date - $start_date), 0);
			$this->data["Absence"]["duree"] = $duree;  

			// Pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD
						
			$date_debut_en = date('Y-m-d',strtotime($starDate_str_replace));
			$this->data["Absence"]["date_debut"] = $date_debut_en; 
 
			$date_fin_en = date('Y-m-d',strtotime($endDate_str_replace));
			$this->data["Absence"]["date_fin"] = $date_fin_en;


			// $this->data["Absence"]["date_fin"] = $this->changedatefrus($this->data["Absence"]["date_fin"]); 
	       	if( $this->Absence->save($this->data) ){
				
				$this->Session->setFlash("La nouvelle demande d'absence a bien été  ajoutée.","default",array('class'=>'valid_box'));

				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La nouvelle demande d'absence a bien été ajoutée.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

				$this->redirect('/member/absences/index') ;
			} else{ 
				unset($this->data['Absence']['date_debut']) ;
				unset($this->data['Absence']['date_fin']) ;
				$this->Session->setFlash("
				<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
					<span aria-hidden='true'>×</span>
				</button>
				<strong>ERREUR</strong> : Veuillez renseigner toutes les champs obligatoires.",
				"default",array('class'=>'alert alert-danger','role'=>'alert'));
			} 
		} ;

		$this->set('typeabsences', $this->Absence->Typeabsence->find('list',array('order'=>'Typeabsence.title asc'))) ; 
		
		$this->set('annees', $this->Absence->Annee->find('list',array(
																	'fields'=>"Annee.titre",
																	'order'=>'Annee.id desc'
																	)
												)) ; 
		 
	}
	  
	function member_modifier ($id){ 
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.Member.id')!= $this->data['Absence']['member_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Vous n'avez pas le droit de modifier cette demande.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect('/gestion-absences.html') ;
			}
			
			// 
			$starDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_debut"]);
			$endDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_fin"]);

			// Pour calculer le duree
			$start_date = date('d-m-Y',strtotime($starDate_str_replace));
			$end_date = date('d-m-Y',strtotime($endDate_str_replace));
			// Return difference
			$duree = round(($end_date - $start_date), 0);
			$this->data["Absence"]["duree"] = $duree;  

			// Pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD
						
			$date_debut_en = date('Y-m-d',strtotime($starDate_str_replace));
			$this->data["Absence"]["date_debut"] = $date_debut_en; 
 
			$date_fin_en = date('Y-m-d',strtotime($endDate_str_replace));
			$this->data["Absence"]["date_fin"] = $date_fin_en;

			$this->Absence->set('envoyer', 0) ;
			$this->Absence->set('satisfaction', 1) ;

			if($this->Absence->save($this->data) )  {
				// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD 
				$this->Absence->save($this->data);	 
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La demande d'absence a été modifiée avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				$this->redirect('/gestion-absences.html') ;
				}
		}  
		$this->data = $this->Absence->read(array(),$id) ;
		$q = $this->Absence->findById($id)  ;
		$this->set('absence', $q );

		$this->set('typeabsences', $this->Absence->Typeabsence->find('list',array('order'=>'Typeabsence.title asc'))) ; 
		
		$this->set('annees', $this->Absence->Annee->find('list',array(
																	'fields'=>"Annee.titre",
																	'order'=>'Annee.id desc'
																	)
												)) ; 
	}
	
	function member_imprimer($id = null)  { 

        $id = intval($id); 
        $q = $this->Absence->findById($id) ;
		$this->set('absence',$q) ;
		$division_id = $q["Member"]["division_id"];
		$this->loadModel ('Division');
		$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
		$this->set('div',$div) ;

		if(!empty($q) && $q['Absence']['member_id'] == $this->Session->read('Auth.Member.id')  ) {
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->set('download',true) ;
			$this->render('demande_absence'); 
		}else{
			$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Erreur d'accès à la demande.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			$this->redirect('/member');
		}
    } 


	function member_supprimer ($id){
		if($id!=null){
		    $this->Absence->id = $id ;
            if($this->Absence->saveField('deleted',1) ) {
			   $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La demande d'absence a été suprimée avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Une erreur a été rencontré lors de la suppression de la demande.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
	
	}
	
	function member_annuler($id){
		$this->Absence->id = $id;
		if( $this->Absence->saveField('status', 1) ){
			   $this->Session->setFlash("La demande d'absence a été annulée avec succès.","default",array('class'=>'valid_box'));	
			   $this->redirect($this->referer()) ;	
			 };
		$this->redirect($this->referer()) ;	

	}

// ---------------------------------------- Public ----------------------------------------------

	// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD 
	
	/*function changedateusfr($dateus){
    $datefr=$dateus{8}.$dateus{9}."-".$dateus{5}.$dateus{6}."-".$dateus{0}.$dateus{1}.$dateus{2}.$dateus{3};
    return $datefr;
    }*/
 
	function changedatefrus($datefr) 
    {
        $dateus=$datefr{6}.$datefr{7}.$datefr{8}.$datefr{9}."-".$datefr{3}.$datefr{4}."-".$datefr{0}.$datefr{1};
        return $dateus;
    }



//----------------------------------------- Admin ----------------------------------------------	

	function admin_index(){ 
		$this->paginate['conditions']["Absence.deleted"] = 0   ; 
		$this->paginate['limit'] = 10 ; 
		$this->paginate['order'] = 'Absence.id desc';
		$this->set('absences',$this->paginate('Absence') );
		$types = $this->Absence->Typeabsence->find('list',array('conditions'=>'Typeabsence.deleted = 0',
															'order'=>'Typeabsence.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Liste des demandes");
		$this->render('admin_index') ;
	}
	
	function admin_afficher($id){
		$q = $this->Absence->findById ($id);
		$this->loadModel('Annee');		
		$this->loadModel('Typeabsence');		
		$absence_id = $this->Absence->find('first',array(
													'fields'=>"Absence.id,
															   Absence.created ,
															   Absence.duree,
															   Absence.date_debut,
															   Absence.date_fin,
															   Absence.nbr_jrs,
															   Absence.commentaire,
															   Absence.status,
															   Annee.titre,
															   Typeabsence.title,
															   Typeabsence.slug,
															   Absence.annee_id,
															   Absence.typeabsence_id",
													'conditions'=>array('Absence.id'=>$id))
										);	

		$this->set('absence',$q) ;

		$this->set('absence_id',$id) ; 

		$page_title = "Détail de la demande ".$q["Typeabsence"]["title"] ;

		$this->set('page_title', $page_title);

		$this->render('admin_afficher') ;					 
    }

		function admin_rechercher() {
		$query = NULL ;
		$this->paginate['limit'] = 10;
		$this->paginate['order'] = 'Absence.id desc';
		$this->paginate['conditions']["Absence.deleted"] =  0 ; 
		//$this->paginate['conditions']["Absence.statut"] =  1 ;  
		if( !empty($this->data) ) {
			if (!empty ($this->data['Absence']['query'])){
				$query = $this->data['Absence']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Absence.id like '%$query%'",
																"Typeabsence.title like '%$query%'",
																"Annee.titre = '$query'"
																));
			}
			if (!empty ($this->data['Absence']['type'])){	
				$type = $this->data['Absence']['type'] ;
				$this->paginate['conditions']["Absence.typeabsence_id"] =  $type;
			}
		}
		$this->set('absences',$this->paginate('Absence') ) ;
		$types = $this->Absence->Typeabsence->find('list',array('conditions'=>'Typeabsence.deleted = 0',
															'order'=>'Typeabsence.title asc'));
		$this->set('types',$types);
		$this->set('balise_h5',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('admin_index') ; 
	}
				
		function admin_supprimes() {
			$this->paginate = array(
								"conditions" => "Absence.deleted = 1",
								'recursive'=>2,
								'limit' => 20,
								"order" => "Absence.id desc"
								) ; 
			$marques = $this->Absence->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Absences',$this->paginate('Absence') );
			$this->set('page_title','Liste des articles supprimés');
			$this->set('balise_h1','Liste des articles supprimés');
			$this->render('admin_index');
		}
		
		function admin_imprimer($id = null)  { 

	        $id = intval($id); 
	        $q = $this->Absence->findById($id) ;
			$this->set('absence',$q) ;
			$division_id = $q["Member"]["division_id"];
			$this->loadModel ('Division');
			$div = $this->Division->find('first',array('conditions'=>array("Division.id"=> $division_id) ));
			$this->set('div',$div) ;

			if(!empty($q) && !empty($this->Session->read('Auth.User.id'))) {
				$this->layout = 'pdf'; //this will use the pdf.ctp layout 
				$this->set('download',true) ;
				$this->render('demande_absence'); 
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
			$this->Absence->id = $id;
			$this->Absence->findById( $id ) ;
			$this->Absence->set('decision', 1) ;
			if( $this->Absence->save() ){	
			    $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La demande d'absence a été \"Accordée\" avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
			
			};
			$this->redirect($this->referer())  ;
		}

		function admin_accordPartiel($id) {
			$this->Absence->id = $id;
			$this->Absence->findById( $id ) ;
			$this->Absence->set('decision', 2) ;
			if( $this->Absence->save() ){	
			    $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La demande d'absence a été \"Accordée partiellement\".", 
					"default",array('class'=>'alert alert-default bg-warning-300','role'=>'alert'));
			
			};
			$this->redirect($this->referer())  ;
		}

		function admin_refuser($id) {
			$this->Absence->id = $id;
			$this->Absence->findById( $id ) ;
			$this->Absence->set('decision', 3) ;
			if( $this->Absence->save() ){	
			    $this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La demande d'absence a été \"Refusée\".", 
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
			
			};
			$this->redirect($this->referer())  ;
		}
	    		
	    function admin_envoyer($id){
			$this->Absence->id = $id;
			$this->Absence->set('envoyer', 1) ;
			if( $this->Absence->save($this->data) ){
		        $this->Session->setFlash("
					<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
						<span aria-hidden='true'>×</span>
					</button>
					La décision a bien été envoyée avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
					//envoyer la décision via un mail au demandeur d'absence	
					$this->_sendMailDecisionAbsence($id) ;
				 };
			$this->redirect("index")  ;

	    }
		
        function admin_remonter ($id){
                 // on va 
				$this->Absence->id = $id ; 
				$p = $this->Absence->read(array('position','categorie_id'))  ; 
				// si la position est superieur a 1  -1
				if($p['Absence']['position'] > 1 ) {
				             $new_position = $p['Absence']['position'] - 1 ; 
		  		             $this->Absence->saveField('position', $new_position) ; 
								// on ajoute 1 au Absence qui suit  dans la mme categorie
							$q = $this->Absence->find('first',array("conditions"=>array(
																					'and'=>array('position <'=>$new_position,
																								 'categorie_id'=>$p['Absence']['categorie_id']
																								 ) 
																						)
																	) ) ;
							if(!empty($q)) {
									 // on ajoute 1 
									 $this->Absence->id = $q['Absence']['id'] ;						 
									 $new_position = $p['Absence']['position'] ; 
									 $this->Absence->saveField('position', $new_position ) ; 
									 }			 
							 
							 
							 
				}
				

				$this->redirect($this->referer() ) ;
         }		 
		function admin_descendre ($id){
		                        
				$this->Absence->id = $id ; 
				$p = $this->Absence->read(array('position','categorie_id'))  ; 
				$new_position = $p['Absence']['position'] + 1 ; 
			    $this->Absence->saveField('position', $new_position) ; 
				 
				
				// on decremente 1 du Absence qui suit  dans la mme cat
				$q = $this->Absence->find('first',array("conditions"=>array(
																		'and'=>array('position <'=>$new_position,
																	    'categorie_id'=>$p['Absence']['categorie_id']
																		 ) 
														             )
										 ) ) ;
				if(!empty($q) && $q['Absence']['id'] >1 ) {
				         // on  -1
						 $this->Absence->id = $q['Absence']['id'] ;						 
						 $new_position = $p['Absence']['position']   ; 
						 $this->Absence->saveField('position', $new_position ) ; 
						 } 
				$this->redirect($this->referer() ) ;
		
		}
		
		function admin_ajouter(){
			if( !empty($this->data) ) {
			$user_id = $this->Session->read('Auth.User.id');
			$this->data["Absence"]["user_id"] = $user_id;

			// 
			$starDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_debut"]);
			$endDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_fin"]);

			// Pour calculer le duree
			$start_date = date('d-m-Y',strtotime($starDate_str_replace));
			$end_date = date('d-m-Y',strtotime($endDate_str_replace));
			// Return difference
			$duree = round(($end_date - $start_date), 0);
			$this->data["Absence"]["duree"] = $duree;  

			// Pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD
						
			$date_debut_en = date('Y-m-d',strtotime($starDate_str_replace));
			$this->data["Absence"]["date_debut"] = $date_debut_en; 
 
			$date_fin_en = date('Y-m-d',strtotime($endDate_str_replace));
			$this->data["Absence"]["date_fin"] = $date_fin_en;

	       	if( $this->Absence->save($this->data) ){
				
				$this->Session->setFlash("La nouvelle demande d'absence a bien été  ajoutée.","default",array('class'=>'valid_box'));

				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La nouvelle demande d'absence a bien été ajoutée.",
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));

				$this->redirect('/admin/gestion-absences.html') ;
				}; 
			} ;

			$this->set('typeabsences', $this->Absence->Typeabsence->find('list',array('order'=>'Typeabsence.title asc'))) ; 
		
			$this->set('annees', $this->Absence->Annee->find('list',array(
																	'fields'=>"Annee.titre",
																	'order'=>'Annee.id desc'
																	)
												)) ;  
			
		} 

	function admin_modifier ($id){ 
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.User.id')!= $this->data['Absence']['user_id']){//on vérifie si l'utilisateur a le droit de modifier cette demande (donc une demande qui lui appartient)
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						Vous n'avez pas le droit de modifier cette demande.",
					"default",array('class'=>'alert alert-default bg-danger-300','role'=>'alert'));
				$this->redirect('/admin/gestion-absences.html') ;
			}
			
			// 
			$starDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_debut"]);
			$endDate_str_replace = str_replace("/","-",$this->data["Absence"]["date_fin"]);

			// Pour calculer le duree
			$start_date = date('d-m-Y',strtotime($starDate_str_replace));
			$end_date = date('d-m-Y',strtotime($endDate_str_replace));
			// Return difference
			$duree = round(($end_date - $start_date), 0);
			$this->data["Absence"]["duree"] = $duree;  

			// Pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD
						
			$date_debut_en = date('Y-m-d',strtotime($starDate_str_replace));
			$this->data["Absence"]["date_debut"] = $date_debut_en; 
 
			$date_fin_en = date('Y-m-d',strtotime($endDate_str_replace));
			$this->data["Absence"]["date_fin"] = $date_fin_en;

			mysql_query("update absences set envoyer = 0 where id=$id" ) ;
			mysql_query("update absences set decision = 0 where id=$id" ) ;
			if($this->Absence->save($this->data) )  {
				// La fonction "changedatefrus" pour convertir la date Francais en date Angalais afin d'insérer cette date à la BD 
				$this->Absence->save($this->data);	 
				$this->Session->setFlash("
						<button class='close' aria-label='Close' data-dismiss='alert' type='button'>
							<span aria-hidden='true'>×</span>
						</button>
						La demande d'absence a été modifiée avec succès.", 
					"default",array('class'=>'alert alert-default bg-success-300','role'=>'alert'));
				$this->redirect('/admin/gestion-absences.html') ;
				}
			}  
			$this->data = $this->Absence->read(array(),$id) ;

			$q = $this->Absence->findById($id)  ;
			$this->set('absence', $q );
			$this->set('typeabsences', $this->Absence->Typeabsence->find('list',array('order'=>'Typeabsence.title asc'))) ; 
		
			$this->set('annees', $this->Absence->Annee->find('list',array(
																	'fields'=>"Annee.titre",
																	'order'=>'Annee.id desc'
																	)
												)) ; 
	}
	
    function admin_delete($id){
        if($id!=null){
		    $this->Absence->id = $id ;
			$image1= $this->Absence->field('image') ;
			$image2= $this->Absence->field('image2Prod') ;
			$image3= $this->Absence->field('image3Prod') ;
            if($this->Absence->saveField('deleted',1) ) {
			   $this->Session->setFlash("Le Absence a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
			   $this->redirect($this->referer()) ;
			 }else{
				 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Absence." ,"default",array('class'=>'error_box'));
				$this->redirect($this->referer()) ;				 
			 }
			                
        }
    }
		
	
	function region($id){
		$data["Absence"]=$this->Absence->find("all",array(
			"conditions" => array("Absence.statut = 1 and Absence.region=$id"),
						"order" => "Absence.id DESC"
		));
		$this->set('Absences',$data["Absence"]);
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
												 "Absence.description LIKE" => "%".$rech."%",
												 "Absence.tags LIKE" => "%".$rech."%",
												 "Absence.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Absences',$this->paginate('Absence'));
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
			if (!empty ($this->data['Absence']['submit_search']) && $this->data['Absence']['submit_search'] == $id_page ) {
				$this->data['Absence']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Absence']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDecisionAbsence($absence_id) {
		$site_name = Configure::read('site_name');
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Absence->findById($absence_id)  ;
		$this->set('absence', $q );
		$this->Email->reset() ;
		$this->Email->to = $q['Member']['email'] ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Décision pour votre demande congé réf : '.$absence_id ;
		$this->Email->from = $site_name.' <ne-pas-repondre@clicadministration.gov.ma>';
		$this->Email->template = 'absences/mail_decision_absence'; // note no '.ctp'
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
	$chemin = './uploads/Absences/';
	
	
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