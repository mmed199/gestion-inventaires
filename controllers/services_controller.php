<?php
class DemandesController extends AppController{
    var $name ="Demandes";
    var $components = array("Img",'Email');
	var $helpers = array("Session",'Cksource') ;
	var $paginate = array(
							'limit' => 20,
							'recursive'=>1,
							'fields'=>"Demande.id,Demande.created,Demande.deleted,Demande.nom,Demande.slug,Demande.prix,Demande.image,Demande.descDemande,Dcategory.slug, Dcategory.nom" ,
							'order' => "Demande.id desc" 
		);
	
	function beforeFilter() {
		parent::beforeFilter();
	    if(isset($this->params['prefix']) && ( $this->params['prefix'] == 'admin' || $this->params['prefix'] == 'mod' ) ){
			$this->paginate['fields'] ="Demande.id,Demande.created,Demande.deleted,Demande.nom,Demande.slug,Demande.prix,Demande.image,Demande.descDemande,Dcategory.slug, Dcategory.nom" ;
			$this->paginate['order']  = "Demande.id desc" ;
		}else if( isset($this->params['prefix']) &&  $this->params['prefix'] == 'member'  ){
			$this->paginate['fields'] ="Demande.id,Demande.created,Demande.deleted,Demande.nom,Demande.slug,Demande.prix,Demande.image,Demande.descDemande,Dgategory.slug, Dcategory.nom" ;
			$this->paginate['order']  = "Demande.id desc" ;
		}
	} 
	
	
//-----------------------------------------------------  internes   -------------------------------------------------------		
	function getAttrsList(){
		$return = array() ;
		$return['categories'] = $this->Demande->Dgategory->find('list',array('order'=>'Dgategory.nom asc'));  		
		return $return; 
	}
	
	function home($no_index = false, $meta_canonical_url=""){
		if ($no_index){
			$this->set('meta_robots' ,"NOINDEX,FOLLOW");
			$this->set('meta_canonical_url', $meta_canonical_url);
		}else{
			echo $_SERVER['REQUEST_URI'];
			if ($_SERVER['REQUEST_URI'] != "/"  ){
				$this->set('meta_robots' ,"NOINDEX,FOLLOW");
				$this->set('meta_canonical_url', "http://www.services4all.ma/");
			}
			
		}
		//liste des marques à utiliser dans le formulaire de recherche (home)
		$search_categories = $this->Demande->Dcategory->find('all',array('fields'=>array('id','nom'),'conditions'=>'Dcategory.deleted = 0','order'=>'Dcategory.nom asc','recursive'=>-1));  
						
		$demandes['Nouveaux']  = $this->Demande->find('all',array(
														'fields'=>"Demande.id,Demande.nom,Demande.slug,Demande.prix,Demande.image,Demande.descDemande,Dtype.nom, Dtype.slug" ,
														'conditions'=>array('Demande.deleted=0 and Demande.statut = 1') ,//Demande non supprimés, validé et avec tag Home Page
														'recursive'=>1,
														'order'=>'Demande.created desc',
														'limit'=> 20
														)
												) ;
		
	    $this->set('demandes', $demandes) ;  
		$this->set('search_categories',$search_categories) ;
		$this->set('is_home_page',true) ; 
		$this->loadModel('Sliderimage');
		$sliders = $this->Sliderimage->find('all',array("conditions" => "Sliderimage.deleted=0 and Sliderimage.active = 1", "order"=>"ordre asc"));
		$this->set('sliders',$sliders) ;
		
		$this->set('page_title', 'Services4all ~  Divers services pour tous ~ services pour les entreprises, pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport');
		$this->set('page_description',"Vous avez un besoin? vous recherchez des clients? Services4all vous propose des divers services, services pour les entreprises, services pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport..");
		$this->set('page_keywords',"Services4all, services divers, services entreprises, services particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport");
		$this->render("home");		
		
	}
    function index(){
			
			$this->paginate = array(
									'limit' => 20
									) ; 
            $demandes = $this->Demande->find('all',array(
			"conditions" => "Demande.deleted = 0 and Demande.statut = 1 ",//Demande non supprimé et validé
			'limit' => 20,
				"order" => "Demande.created desc"
			));
            $this->set('demandes',$demandes);
    }
	
	
	
	function search(){
		if ($_SERVER['REQUEST_URI'] != "/search.html"){
			$this->set('meta_robots' ,"NOINDEX,FOLLOW");
			$this->set('meta_canonical_url', "/search.html");
		} 
			
		$this->paginate['order'] = "Demande.created desc" ;
		$this->paginate['recursive'] = 1 ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		
		$this->_reset_search_data ('search');
		//$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('page_title', 'Services4all ~  Divers services pour tous ~ services pour les entreprises, pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport');
		$this->set('page_description',"Vous avez un besoin? vous recherchez des clients? Services4all vous propose des divers services, services pour les entreprises, services pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport..");
		$this->set('page_keywords',"Services4all, services divers, services entreprises, services particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport");
	}
	
	
	function Demandes_personnalisables (){
		$this->paginate['order'] = "Demande.created desc" ;
		$this->paginate['recursive'] = 1 ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.is_personalizable"] =  1 ; 
		
		
		$this->_reset_search_data ('search');
		$this->set('demandes', $this->paginate('Demande')) ;   
		$this->set('page_title', 'Services4all ~  Divers services pour tous ~ services pour les entreprises, pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport');
		$this->set('page_description',"Vous avez un besoin? vous recherchez des clients? Services4all vous propose des divers services, services pour les entreprises, services pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport..");
		$this->set('page_keywords',"Services4all, services divers, services entreprises, services particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport");
		$this->render ('search');
	}
	
	
	
	function _affiner_recherche (){
		$this->paginate['limit'] = 20;
	    $this->paginate['order'] = 'Demande.created desc';
	    $this->paginate['conditions']["Demande.deleted"] =  0 ;
		$query = "";
	    if( !empty($this->data) ) {
	        if (!empty ($this->data['Demande']['query'])){
	            $query = $this->data['Demande']['query'] ;
	            $this->paginate['conditions']["and"] = array(
	                                                    'or'=>array(
	                                                        "Demande.nom like '%$query%'",
	                                                        "Demande.refDemandeClient like '%$query%'",
	                                                        "Demande.descDemande like '%$query%'",
	                                                        // "Demande.id = '$query'",
	                                                        ));
	            }
	    }
	    $q = $this->paginate('Demande') ;
	    $categories = $this->Demande->Dgategory->find('list',array('conditions'=>'Dgategory.deleted = 0',
	                                                        'order'=>'Dgategory.nom asc'));
	                                                          
	    $this->set('categories',$categories);
	    $this->set('demandes', $q ) ;
	
	}
	
	
	
	function search2(){
		$this->paginate['recursive'] = 1 ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ;
		
		//search de la home page est particulier : submit_search_home
		$id_page = "search2";
		if( empty($this->data) && $this->Session->check('Lquery')  ) $this->data = $this->Session->read('Lquery') ;		
		if( empty( $this->data ) ){  
			$this->data  = unserialize( $this->Session->read('Lquery') ) ;
			if (!empty ($this->data['Demande']['submit_search']) && $this->data['Demande']['submit_search'] == $id_page ) {
				$this->data['Demande']['submit_search'] = $id_page ;
			}else{
				//$this->data  = array();
				if (isset($this->data['Demande']['submit_search']))
					$this->data['Demande']['submit_search'] = $id_page ;
			}		
		}
		
		if(!empty($this->data['Demande']['q'] ) ) {
			$this->set('balise_h1', "Résultat de recherche : " . $this->data['Demande']['q'] );
			$this->set('page_title', "Résultat de recherche : " . $this->data['Demande']['q'] );
			$this->paginate['conditions']['or']["Demande.id like "] = $this->data['Demande']['q'] ; 
			$this->paginate['conditions']['or']["Demande.refDemandeClient like"] = $this->data['Demande']['q'] ; 
			$this->paginate['conditions']['or']["Dcategory.nom like"] = $this->data['Demande']['q'] ; 
			$this->paginate['conditions']['or']["Dcategory.nom like"] = '%'.$this->data['Demande']['q'].'%' ; 
		}
		/*
		if(empty($this->data) ){ 
				if( $this->Session->check('Query') )  $this->data = unserialize($this->Session->read('Query') ) ;
		}else  $this->Session->write('Query', serialize($this->data) ) ;
*/		
		//$this->_affiner_recherche ();

		$this->Session->write('Lquery', serialize( $this->data ) ) ;  

		$this->set('page_title', 'Services4all ~  Divers services pour tous ~ services pour les entreprises, pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport');
		$this->set('page_description',"Vous avez un besoin? vous recherchez des clients? Services4all vous propose des divers services, services pour les entreprises, services pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport..");
		$this->set('page_keywords',"Services4all, services divers, services entreprises, services particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport");
		$this->render('search') ;
	}
	
	function nouveautes_accueil(){
		    $q = $this->Demande->find('all',array(
				"conditions" => "Demande.deleted = 0",
				'recursive'=>1,
				'limit' => 20,
				'fields'=>$this->paginate['fields'] ,
				"order" => "Demande.created desc"
			));
            $this->set('Demandes',$q);
            $this->render("index");
    }    
		
	function selections(){
		if( ! empty( $this->data ) )  $this->Session->write('Lquery', serialize( $this->data ) ) ; 
			else  $this->data  = unserialize( $this->Session->read('Lquery') ) ;
		
		$q = $this->Demande->find('all',array(
			'fields'=>$this->paginate['fields'] ,
			"conditions" => "Demande.deleted = 0 and Demande.statut = 1",//Demandes non supprimés et validé
			'recursive'=>1,
			'limit' => 20,
			"order" => "Demande.id desc"
		));
		$this->set('Demandes',$this->_set_varietes_demandes ($q));
		$this->set('search','nouveautes');
		$this->render("index");
	}    
		
	function selections_accueil(){
		$q = $this->Demande->find('all',array(
			'fields'=>$this->paginate['fields'] ,
			"conditions" => "Demande.deleted = 0 and Demande.statut = 1 ",
			'recursive'=>1,
			'limit' => 20,
			"order" => "Demande.id desc"
		));
		$this->set('demandes',$q);
		$this->render("index");
	}    
		
	/*function baffaires(){
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.tag_bonplan"] = 1;//articles qui sont tagé bon plan
		$this->_reset_search_data ('baffaires');
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1','Bonnes affaires vêtements enfant');
		$this->set('page_title', 'Bonnes affaires de vêtements enfant de grandes marques pour femme, homme et bébé  sur  Services4all.com');// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des bonnes affaires de Vêtements femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout");
		$this->set('page_keywords',"bonnes affaires, été 2012, vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("baffaires");
			 
    }*/
	
	/*function proposition (){
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.tag_selection"] = 1;//articles qui sont tagé bon plan
		$this->_reset_search_data ('proposition');
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1',"Idées de cadeaux pour enfant pour l'année 2012");
		$this->set('page_title', 'Idées de cadeaux et bonnes affaires de vêtements enfant de grandes marques pour femme, homme et bébé  sur  Services4all.com');// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des bonnes affaires de Vêtements femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout");
		$this->set('page_keywords',"cadeau enfant, bonnes affaires, hiver 2012, vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("baffaires");

	
	}*/
	
	/*function bonsplan($type_slug= NULL) {
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.tag_bonplan"] = 1;//articles qui sont tagé bon plan
		$this->_reset_search_data ('bonsplan'.$type_slug);
		$type_nom = "";
		$categorie_nom = "";
		if($type_slug != NULL){
			$type = $this->Demande->Type->find('first',array('fields'=>array('Type.id','Type.category_id','Type.nom','Category.title'),'conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['Demande']['type_id'])){
				$this->data['Demande']['type_id']= $type['Type']['id'];
				$this->data['Demande']['type_id_list']= $type['Type']['id'];
			}
			if (empty ($this->data['Demande']['category_id'])){
				$this->data['Demande']['category_id']= $type['Type']['category_id'];
				$this->data['Demande']['category_id_list']= $type['Type']['category_id'];
			}
			$type_nom = strtolower($type['Type']['nom']);
			$categorie_nom = strtolower( $type['Category']['title']);
			//$this->paginate['conditions']["Type.slug"] =  $type_slug ; //
		}
		
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1',"Bonnes affaires $type_nom enfant");
		$this->set('page_title', "Bonnes affaires de $type_nom enfant de grandes marques pour femme, homme et bébé  sur  Services4all.com");// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des bonnes affaires de $categorie_nom ($type_nom) pour femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout");
		$this->set('page_keywords',"bonnes affaires,$type_nom,$categorie_nom,  hiver 2012, vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("baffaires");
	}*/
	
	/*function baffaires_marque($slug_m) {
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; 
		$this->paginate['conditions']["Demande.tag_bonplan"] = 1;
		$this->_reset_search_data ('baffaires_marque'.$slug_m);
		$nom_marque = "";
		if (empty ($this->data['Demande']['marque_id'])){
			$this->loadModel ('Marque');
			$marque = $this->Marque->find ('first',array('conditions'=>"Marque.slug = '$slug_m'"));
			$nom_marque	= $marque['Marque']['nom']; 
			$this->data['Demande']['marque_id'] = $marque['Marque']['id'];
			$this->data['Demande']['marque_id_list'] = $marque['Marque']['id'];
			$this->set ('balise_h1',"Bonnes affaires pour enfant de marque  " . $nom_marque );
			$this->set ('page_title',"Bonnes affaires vêtements " . $nom_marque . " enfant | Services4all");
			$this->set ('page_description',"Nous vous proposons des bonnes affaires de vêtements, accessoires et chaussures de marque " . $nom_marque. " pour enfant sur Services4all vendus par des Professionnels ou particuliers...");
			$this->set('page_keywords',"bonnes affaires, ". strtolower($nom_marque) ."  , vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 		
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		//bonnes-affaires-vetement-petit-bateau-enfant.html
		$this->set('search','baffaires_marque');
		$this->render("search");
	}*/
	
	
	/*function soldes($annee=2013){
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.prixSolde >"] = 1;//articles qui sont soldé
		$this->paginate['conditions']["and"] =array( " (Demande.prixSolde / Demande.prix )  > 0.4 ") ;//articles qui sont soldé
		$this->_reset_search_data ('soldes'.$annee);
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1','Nos articles de vêtements, chaussures et accessoires enfant soldés');
		$this->set('page_title', 'Solde vêtements, chassures et accessoires marque mode enfant '.$annee);// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des nos articles soldés de vêtements femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout les articles soldés : opération ".$annee);
		$this->set('page_keywords',"soldes, bonnes affaires, solde ".$annee . ", vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("soldes");
			 
    }*/
	
	
	
	/*function categorie_decoration($categorie_slug = NULL) {
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->_reset_search_data ('categorie_decoration' .$categorie_slug);
		
		
		if($categorie_slug != NULL)  {
			$categorie = $this->Demande->Type->Category->find('first',array('fields'=>array('id','title'),'conditions'=>array('Category.slug'=>$categorie_slug) )) ; 
			//echo print_r( $categorie);
			$this->data['Demande']['category_id'] = $categorie['Category']['id'];
			$this->paginate['conditions']["Category.slug"] = $this->data['Category']['slug'] ; 
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande')) ) ;
		$this->set('page_title', 'Déco chambre - Services4all');
		$this->set('balise_h1', 'Déco chambre');
		$this->render('categorie');
	}*/
	
	//famille de Demande 
	/*function famille_demandes ($famille_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		
		$this->_reset_search_data ('famille_Demandes'. $famille_slug);
		
		if($famille_slug != NULL)  {
			$pfamille = $this->Demande->Type->Pfamille->find('first',array('fields'=>array('id','titre','meta_description','meta_keywords'),'conditions'=>array('Pfamille.slug'=>$famille_slug) )) ; 
			//echo print_r( $categorie);
			$types = $this->Demande->Type->find ('all', array('conditions'=>"Type.pfamille_id = " . $pfamille ['Pfamille']['id'] ));
			$var_types = array();
				foreach ($types as $t)
					$var_types  [] = $t['Type']['id'];
			
			$this->data['Demande']['type_id'] = $var_types ;
			$this->paginate['conditions']["Demande.type_id"] = $var_types  ;
			$this->set('page_description', $pfamille['Pfamille']['meta_keywords']);
			$this->set('page_keywords', $pfamille['Pfamille']['titre']);
			$this->set('page_title', $pfamille['Pfamille']['titre']. ' - Services4all');
			$this->set('balise_h1', $pfamille['Pfamille']['titre']);
		}
		$this->_affiner_recherche ();	
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande')) ) ;
			
		
		$this->render('search');
	
	}*/
	
	/* a refaire */
	/* function type($type_slug = NULL, $sexe_slug = NULL, $couleur_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->_reset_search_data ('type'.$type_slug . $sexe_slug . $couleur_slug );	
		
		$type_nom = "";
		$categorie_nom = "";
		if($type_slug != NULL){
			$type = $this->Demande->Type->find('first',array('conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['Demande']['type_id'])){
				$this->data['Demande']['type_id']= $type['Type']['id'];
				$this->data['Demande']['type_id_list']= $type['Type']['id'];
			}
			if (empty ($this->data['Demande']['category_id'])){
				$this->data['Demande']['category_id']= $type['Type']['category_id'];
				$this->data['Demande']['category_id_list']= $type['Type']['category_id'];
			}
			$type_nom = $type['Type']['nom'];
			$categorie_nom = $type['Category']['title'];
			$this->paginate['conditions']["Type.slug"] =  $type_slug ; //
		}
		
		$sexe_nom = "Enfant";
		if($sexe_slug != NULL)  {
			switch ($sexe_slug){
				case "enfant" :
					$sexe_nom = "enfant";
					break;
				case "bebe" :
					$sexe_nom = "bébé";
					$this->loadModel ("Variete");
					$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Demandes = array();
					foreach ($Demandes as $p)
						$var_Demandes  [] = $p['Variete']['demande_id'];
					$this->data['Demande']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Demande.id"] = $var_Demandes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 					
					$sexe_nom = "femme";
					break;				
			}			
		}
		$nom_couleur = "";
		if($couleur_slug != NULL)  {
			$this->loadModel ("Couleur");
			$couleur = $this->Couleur->find ('first',array('fiels'=>array('Couleur.id','Couleur.nom'),'conditions'=>"Couleur.slug = '$couleur_slug'"));
			$nom_couleur = $couleur['Couleur']['nom'];
			
			$this->loadModel ("Variete");
			$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "couleur_id"=> $couleur['Couleur']['id'])));
			$var_Demandes = array();
			foreach ($Demandes as $p)
				$var_Demandes  [] = $p['Variete']['demande_id'];
			if ( empty($this->data['Demande']['couleur_id_list'])){
				$this->data['Demande']['couleur_id_list'] = $couleur['Couleur']['id'];
				$this->data['Demande']['couleur_id'] = $couleur['Couleur']['id'];
			}
			$this->paginate['conditions']["Demande.id"] = $var_Demandes;
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande')) ) ;	

		
		$balise_h1 =  $type_nom . ' ' . strtolower($sexe_nom) .' '. strtolower($nom_couleur) ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all');
		$this->set('page_description', "Acheter un " .strtolower($type_nom) . " " .strtolower($nom_couleur) . "  d'occasion ou neuf pas cher sur KidsDressing pour $sexe_nom. Site officiel de cette marque de vêtements, chaussures et accessoires pour enfants, permettant de commander en ligne ses différents Demandes.");
		$this->set('page_keywords', "$type_nom," .strtolower($nom_couleur) . " , $sexe_nom,$categorie_nom, marque, enfant , pas cher");
		$this->render('search');	
    } */
	
	
	/* function collection($collection_slug = NULL,$type_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		//$this->_reset_search_data ('type'.$type_slug . $sexe_slug . $couleur_slug );	
		
		$type_nom = "";
		$categorie_nom = "";
		if($type_slug != NULL){
			$type = $this->Demande->Type->find('first',array('conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['Demande']['type_id'])){
				$this->data['Demande']['type_id']= $type['Type']['id'];
				$this->data['Demande']['type_id_list']= $type['Type']['id'];
			}
			if (empty ($this->data['Demande']['category_id'])){
				$this->data['Demande']['category_id']= $type['Type']['category_id'];
				$this->data['Demande']['category_id_list']= $type['Type']['category_id'];
			}
			$type_nom = $type['Type']['nom'];
			$categorie_nom = $type['Category']['title'];
			$this->paginate['conditions']["Type.slug"] =  $type_slug ; //
		}
		
		$sexe_nom = "";
		if($sexe_slug != NULL)  {
			switch ($sexe_slug){
				case "enfant" :
					$sexe_nom = "enfant";
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 					
					$sexe_nom = "femme";
					break;				
			}			
		}
		$nom_couleur = "";
		if($couleur_slug != NULL)  {
			$this->loadModel ("Couleur");
			$couleur = $this->Couleur->find ('first',array('fiels'=>array('Couleur.id','Couleur.nom'),'conditions'=>"Couleur.slug = '$couleur_slug'"));
			$nom_couleur = $couleur['Couleur']['nom'];
			
			$this->loadModel ("Variete");
			$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "couleur_id"=> $couleur['Couleur']['id'])));
			$var_Demandes = array();
			foreach ($Demandes as $p)
				$var_Demandes  [] = $p['Variete']['demande_id'];
			if ( empty($this->data['Demande']['couleur_id_list'])){
				$this->data['Demande']['couleur_id_list'] = $couleur['Couleur']['id'];
				$this->data['Demande']['couleur_id'] = $couleur['Couleur']['id'];
			}
			$this->paginate['conditions']["Demande.id"] = $var_Demandes;
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande')) ) ; 	

		
		$balise_h1 =  $type_nom . ' ' . strtolower($sexe_nom) .' '. strtolower($nom_couleur) ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . '- Services4all &amp; CO');
		$this->set('page_description', "Acheter un " .strtolower($type_nom) . " " .strtolower($nom_couleur) . "  bijoux pour $sexe_nom. Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
		$this->set('page_keywords', "$type_nom," .strtolower($nom_couleur) . " , $sexe_nom,$categorie_nom, marque, bijoux , pas cher");
		$this->render('search');	
    } */
	
	/*function collection($collection_slug = NULL, $type_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		//$this->paginate['conditions']["Demande.stock"] >=  1 ; 
		$this->_reset_search_data('collection'.$collection_slug);	
		
		$collection_nom = "";
		if($collection_slug != NULL){
			$collection = $this->Demande->Collection->find('first',array('conditions'=>array('Collection.slug'=>$collection_slug) )) ; 
			
			$collection_nom = $collection['Collection']['nom'];
			$collection_id =  $collection['Collection']['id'] ; //
			$this->paginate['joins'] = array( 
													array( 
														'table' => 'collections_Demandes', 
														'alias' => 'CollectionsDemande', 
														'type' => 'INNER',  
														'conditions'=>"CollectionsDemande.demande_id = Demande.id AND CollectionsDemande.collection_id= $collection_id "
													),
												) ;
		}	 
		 
		//$this->_affiner_recherche ();
		//$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->paginate('Demande') ) ;	

		
		$balise_h1 =  $collection_nom ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all &amp; CO');
		$this->set('page_description', "Acheter un " .strtolower($collection_nom) . " . Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
		$this->set('page_keywords', "".strtolower($collection_nom) ." - bijoux , pas cher");
		$this->render('search');	
    }*/
	/*function special() {
			// pas encore fini => a refaire il faux ajouter un fichier index avec un champ special pour les evenements 
			//Liste des Demandes bijoux special Saint-valentin
			$this->paginate['recursive'] = 1 ; 
			$this->paginate['conditions']["Demande.deleted"] =  0 ; 
			$this->paginate['conditions']["Demande.statut"] =  1 ; 
			
			$this->loadModel ("EvenementsDemande");			
			$Demandes = $this->EvenementsDemande->find ("all", array('fields'=>"demande_id", 'conditions'=>array('evenement_id'=>55))) ;	 //Saint-valentin
			$pdtevents = array();
				foreach ($Demandes as $p)
					$pdtevents [] = $p['EvenementsDemande']['demande_id'];
								
			$this->paginate['conditions']["Demande.id"] = $pdtevents  ;
			
			$this->set('balise_h1', "Bijoux spécial Saint-Valentin");
			$this->set('page_title',"Bijoux spécial Saint-Valentin- Services4all &amp; CO");
			$this->set('page_description', "Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
			$this->set('page_keywords', "Bijoux spécial Saint-Valentin , pas cher");
            $this->render('search');
	} 
	
	function promotions() {
			$this->paginate['order'] = "Demande.id desc" ;
			$this->paginate['conditions']["Demande.deleted"] =  0 ; 
			$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
			$this->paginate['conditions']["Demande.prixSolde >"] = 1;//articles qui sont soldé
			$this->paginate['conditions']["and"] =array( " (Demande.prixSolde / Demande.prix )  > 0.4 ") ;//articles qui sont soldé
			
			$this->set('Demandes',$this->paginate('Demande') ) ;
            $this->set('balise_h1', "Bijoux en promotion");
			$this->set('page_title',"Bijoux en promotion - Services4all &amp; CO");
			$this->set('page_description', "Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
			$this->set('page_keywords', "Bijoux en promotion, pas cher");
			
            $this->render('search');
	} */
	
	/*function taille($category_slug = NULL, $sexe_slug = NULL, $taille_id = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		
		$this->_reset_search_data ('taille' . $category_slug . $sexe_slug . $taille_id);
		
		
		
		$type_nom = "";
		$categorie_nom = "";
		if($category_slug != NULL){
			$categorie = $this->Demande->Category->find('first',array('conditions'=>array('Category.slug'=>$category_slug) )) ; 
			if ( empty($this->data['Demande']['category_id'])){
				$this->data['Demande']['category_id']= $categorie['Category']['id'];
				$this->data['Demande']['category_id_list']= $categorie['Category']['id'];
			}
			$categorie_nom = $categorie['Category']['title'];
			$this->paginate['conditions']["Demande.category_id"] =  $categorie['Category']['id'] ; //
		}
		
		$sexe_nom = "Enfant";
		if($sexe_slug != NULL)  {
			switch ($sexe_slug){
				case "enfant" :
					$sexe_nom = "enfant";
					break;
				case "bebe" :
					$sexe_nom = "bébé";
					$this->loadModel ("Variete");
					$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Demandes = array();
					foreach ($Demandes as $p)
						$var_Demandes  [] = $p['Variete']['demande_id'];
					$this->data['Demande']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Demande.id"] = $var_Demandes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->data['Demande']['sexe_id_list'] = $sexe['Sexe']['id'];
					break;
				case "femme" :
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->data['Demande']['sexe_id_list'] = $sexe['Sexe']['id'];					
					$sexe_nom = "femme";
					break;				
			}			
		}
		$nom_taille = "";
		if($taille_id != NULL)  {
			$this->loadModel ("Taille");
			$taille = $this->Taille->find ('first',array('fiels'=>array('Taille.id','Taille.nom'),'conditions'=>"Taille.id = $taille_id"));
			$nom_taille = $taille['Taille']['nom'];
			
			$this->loadModel ("Variete");
			$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "taille_id"=> $taille_id)));
			$var_Demandes = array();
			foreach ($Demandes as $p)
				$var_Demandes  [] = $p['Variete']['demande_id'];
			if ( empty($this->data['Demande']['taille_id_list'])){
				$this->data['Demande']['taille_id_list'] = $taille_id;
				$this->data['Demande']['taille_id'] = $taille_id;
			}
			$this->paginate['conditions']["Demande.id"] = $var_Demandes;
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande') )) ;	

		
		$balise_h1 =  $categorie_nom  . ' ' . strtolower($sexe_nom) . ' de taille ' . $nom_taille ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all');
		$this->set('page_description', "Acheter un " .strtolower($type_nom) . " " .strtolower($nom_taille) . "  d'occasion ou neuf pas cher sur KidsDressing pour $sexe_nom. Site officiel de cette marque de vêtements, chaussures et accessoires pour enfants, permettant de commander en ligne ses différents Demandes.");
		$this->set('page_keywords', "$type_nom," .strtolower($nom_taille) . " , $sexe_nom,$categorie_nom, marque, enfant , pas cher");
		$this->render('search');	
    }
	*/
	
	
	function type($type_slug ){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés		
		
		$type_nom = "";
		if($type_slug != NULL){
			$type = $this->Demande->Type->find('first',array('conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['Demande']['type_id'])){
				$this->data['Demande']['type_id']= $type['Type']['id'];
				$this->data['Demande']['type_id']= $type['Type']['id'];
			}
			$type_nom = $type['Type']['nom'];
			$this->paginate['conditions']["Demande.type_id"] =  $type['Type']['id'] ; //
		}	
		//$this->_affiner_recherche ();
		//$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->paginate('Demande') ) ;	

		
		$balise_h1 =  $type_nom  ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all &amp; CO');
		$this->set('page_description', "Acheter un $type_nom  Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
		$this->set('page_keywords', "$type_nom, marque, bijoux , pas cher");
		$this->render('search');	
    }
	
	
	
	//liste des nouveautes
	function nouveautes($sexe_slug=NULL){
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1;
		$this->paginate['conditions']["Demande.tag_nouveaute"] =  1;
		$this->_reset_search_data ('nouveautes'.$sexe_slug);
		$sexe_nom = "enfant";
		if($sexe_slug != NULL)  {
			switch ($sexe_slug){
				case "enfant" :
					$sexe_nom = "enfant";
					break;
				case "bebe" :
					$sexe_nom = "bébé";
					$this->loadModel ("Variete");
					$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Demandes = array();
					foreach ($Demandes as $p)
						$var_Demandes  [] = $p['Variete']['demande_id'];
					$this->data['Demande']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Demande.id"] = $var_Demandes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 					
					$sexe_nom = "femme";
					break;
				
			}
			
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande')) ) ;	
		
		$this->set('search','nouveautes');
		$this->set('page_title', 'Les nouveautés Services4all ' .  strtolower ($sexe_nom) . ' - Services4all');
		$this->set('balise_h1', 'Les nouveautés Services4all ' .  strtolower ($sexe_nom) );
		$this->set('page_description',"Sélection de nouveauté de Bijoux " .  strtolower ($sexe_nom) . " de marque pas cher sur Services4all.");
		$this->set('page_keywords',"nouveaute, vetement," .  strtolower ($sexe_nom) . ",marque, femme, homme, enfant");
		$this->render("nouveautes");			
    }    
	
	function nouveautes_decoration ($sexe_slug=NULL){
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1;
		$this->paginate['conditions']["Demande.tag_nouveaute"] =  1;
		
		$this->_reset_search_data ('nouveautes_decoration'.$sexe_slug);
		if ( empty($this->data['Demande']['category_id'])){
			$categorie = $this->Demande->Category->find('first',array('conditions'=>array('Category.slug'=>'decoration') )) ; 
			$this->data['Demande']['category_id']= $categorie['Category']['id'];
			$this->data['Demande']['category_id_list']= $categorie['Category']['id'];
			$categorie_nom = $categorie['Category']['title'];
			$this->set('categorie_nom','categorie_nom');
			$this->paginate['conditions']["Demande.category_id"] =  $categorie['Category']['id'] ;
		}
		
		
		$sexe_nom = "enfant";
		if($sexe_slug != NULL)  {
			switch ($sexe_slug){
				case "enfant" :
					$sexe_nom = "enfant";
					break;
				case "bebe" :
					$sexe_nom = "bébé";
					$this->loadModel ("Variete");
					$Demandes = $this->Variete->find ("all", array('fields'=>"demande_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Demandes = array();
					foreach ($Demandes as $p)
						$var_Demandes  [] = $p['Variete']['demande_id'];
					$this->data['Demande']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Demande.id"] = $var_Demandes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->Demande->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['Demande']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 					
					$sexe_nom = "femme";
					break;				
			}			
		}
		
		$this->_affiner_recherche ();	
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande')) ) ;
		
		
		$this->set('search','nouveautes');
		$this->set('page_title', 'Les nouveautés décoration ' .  strtolower ($sexe_nom) . ' - Services4all');
		$this->set('balise_h1', 'Les nouveautés décoration ' .  strtolower ($sexe_nom) );
		$this->set('page_description',"Sélection de nouveauté de décoration " .  strtolower ($sexe_nom) . " de marque pas cher sur kidsdressing.");
		$this->set('page_keywords',"nouveaute, decoration chambre," .  strtolower ($sexe_nom) . ", enfant, marque, mode, femme, homme, bébé");
		$this->render("nouveautes");			
 	}
		
	
	function marque($marque_slug,$category_slug= NULL){
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ;
		$selection_modifiee = false;
		$this->_reset_search_data ('marque'.$marque_slug.$category_slug);
		
		$nom_marque = "";
		
		if (empty ($this->data['Demande']['marque_id'])){		
			$marque= $this->Demande->Marque->find('first',array('conditions'=>array('Marque.slug'=>$marque_slug) ) ) ;			
			$this->data['Demande']['marque_id'] = $marque_id = $marque['Marque']['id'] ;
			$this->data['Demande']["marque_id_list"] =  $marque_id ;
			//$this->paginate['conditions']["Demande.marque_id"] =  $marque_id ;
			$this->set('search','marques');
			$this->set('marque',$marque) ; 
			
		}else{
			$selection_modifiee = true;
		}
		
		
		if (empty ($this->data['Demande']['category_id'])){	
			if($category_slug != NULL)  {
				$categorie = $this->Demande->Type->Category->find('first',array('fields'=>array('id','title'),'conditions'=>array('Category.slug'=>$category_slug) )) ; 
				//echo print_r( $categorie);
				$this->data['Demande']['category_id'] = $categorie['Category']['id'];
				$this->data['Demande']['category_id_list'] = $categorie['Category']['id'];
				//$this->paginate['conditions']["Demande.category_id"] = $categorie['Category']['id'] ; 
				$this->set('categorie', $categorie ) ;
			}
		}
		
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes',$this->_set_varietes_Demandes ($this->paginate('Demande') )) ;
		$this->data['page'] = 'marque';
		if ($selection_modifiee)
			$this->render('search');
		else
			$this->render('marque');
	}
		
	
	function professionnel($member_id){
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.demandeur_id"] = $member_id;//demandes qui sont tagés bon plan
		$this->_reset_search_data ('professionnel'.$member_id);
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$member = $this->Demande->Demandeur->findById($member_id);
		if ($member){
			$this->set('balise_h1',$member['Demandeur']['pseudo'].' : Createur des services professionnels');
			$this->set('page_title',$member['Demandeur']['pseudo'].' : Createur des services | Professionnel ' . $member['Demandeur']['id']);
			$this->set('page_description',"Lancer vos services professionnels sur Services4all. ". $member['Demandeur']['pseudo'].'Fiche demandeur . '. $member['Demandeur']['id']);
			$this->set('page_keywords',$member['Demandeur']['pseudo']."Client, Entreprise, demandeur, professionnels,services en ligne");
			$this->set('member',$member);			
		}
		$this->render("professionnel");			 
    }
	
		
	
	function getDemandeClient($id){ //retourner les Demandes d'un createur services
		$q = $this->Demande->find('all',array(
				"conditions" => "Demande.deleted = 0 and Demande.id_client =$id ",
				'limit' => 20,
				'fields'=>$this->paginate['fields'] ,
				"order" => "Demande.id desc"
		));
		return $q;
	}  
		
	function getDemandeCategory($id){ //retourner les catégories des demandes d'un createur services
		$q = $this->Demande->find('all',array(
			"conditions" => "Demande.deleted = 0 and Demande.category_id =$id ",
			'limit' => 20,
			'fields'=>$this->paginate['fields'] ,
			"order" => "Demande.created desc"
		));
		return $q;
	}  
		 
	function view($id){
			$this->Demande->recursive=1;
			$q = $this->Demande->findById ($id);

			//print_r($q) ;
			$prix  = $q['Demande']['prix'];
			$categorie = $q['Dcategory']['nom'];
			$image =  $q['Demande']['image'];
		
			$demandes_simulaires = $this->Demande->find('all',array(								
														'conditions'=>array('Demande.deleted'=>0,'Demande.statut'=>1,'Demande.id !='=>$id,
																			'Demande.category_id'=>$q['Demande']['category_id'],
														'fields'=>"Demande.id,Demande.created,Demande.nom,Demande.slug,Demande.prix,Demande.prixGros,Demande.prixSolde,Demande.image,Type.id,Demande.descDemande,Type.nom,Type.slug,Marque.nom,Marque.image,Marque.image_small,Marque.slug,Sexe.nom,Category.slug,Matiere.nom,Matiere.slug" ,
														'order'=>'Demande.created asc',
														'limit'=>4
														)
												);
			
			
			
			if ($q['Demande']['deleted'] != 0){//si Demande supprimer indiquer au moteur de recherche ne pas indexer la page
				$this->set('meta_robots','noindex, follow') ;
				$this->set('meta_canonical','/services/'.$q['Dcategory']['slug'] . '/' ) ;
			}
					
			$url_Demande = "/services/".$q['Dcategory']['slug'] ."/$id-".$q['Demande']['slug'] .".html";
			
			$q['Demande']['titre_Demande'] = "Service " . strtolower($q['Dcategory']['nom'])  . " : " . $q['Demande']['nom'];

			$titre_Demande = $q['Dcategory']['nom'] . " : " . $q['Demande']['nom'];
			
			$page_title = $q['Demande']['titre_Demande']  ;
			
			$page_description = $q['Demande']['mdescription']; 
			
			$page_keywords = $q['Demande']['mkeywords']; 
		
			
			//print_r($Demandes_simulaires) ;
			
			
			$page_description .= "Demande mise en ligne le ". date("d/m/Y H\hi",strtotime($q['Demande']['created']))  ." - référence : ". $id.". ";
			//if ($q['Demande']['description'] != "" )
			//	$page_description .= strip_tags ($q['Demande']['description']  );
			
			
			$meta_og = '<meta property="og:description" content="' . $page_description  .'"/>
					<meta property="og:type" content="product" />
					<meta property="og:url" content="'.$url_Demande . '" />
					<meta property="og:title" content="'. $page_title .'" />
					<meta property="og:image" content="/uploads/demandes/' .$image . '" />
					<meta property="og:site_name" content="Services4all" />';
			
			
			// check if is in favoris 
			$favoris = $this->Cookie->read('Favoris') ;
			if( !empty( $favoris) && in_array(  $q['Demande']['id'] , $favoris ) )  $q['Demande']['in_favoris'] = true ; 
			else
				$q['Demande']['in_favoris'] = false ; 
			
			
			$this->set('meta_og',$meta_og);
			$this->set('Demande',$q);
			$this->set ('Demandes_simulaires',$Demandes_simulaires);
			$this->set('titre_Demande',$titre_Demande);
			$this->set('page_title',$page_title);
			$this->set('page_description',$page_description);
			$this->set('page_keywords',$page_keywords);
        }
	//fonction de mise à jour du fichier de Google Shopping Flux
/* function upcreatedGoogleShoppingFlux (){
	$this->layout = $this->autoRender= false;
	$this->loadModel('Variete');
	$this->loadModel('Couleur');
	$this->loadModel('Taille');
	$Demandes = $this->Demande->find('all',array(
	'recursive'=>1,
	'fields'=>"Demande.id,Demande.seller_id,Demande.created,Demande.prix,Demande.prixSolde,Demande.image,Demande.image2Prod,Demande.image3Prod,Demande.description, Type.id,Type.nom,Type.slug,Type.google_product_category, Marque.nom,Marque.image,Marque.image_small,Marque.slug,Marque.is_createur,Sexe.nom,Sexe.slug,Category.title,Category.slug, Matiere.nom" ,
	'conditions'=> array("Demande.deleted" =>  0,"Demande.statut" =>1,"Demande.description !=" =>'', "Demande.id IN (" . $this->_Demandes_stock () . ")" )));
				
	$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
 	//$xml = "<?xml version='1.0' encoding='UTF-8' standalone='yes'>\n";
	$xml .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">'."\n";
	$xml .= "<channel>\n";
	$xml .= "<title>Demandes Services4all</title>\n";
	$xml .= "<link>http://www.kidsdressing.com</link>\n";
	$xml .= "<description>Services4all</description>\n";
	$xml .= "<generator>AS Net</generator>\n";
	file_put_contents("xml/Demandes-google-shopping-kidsdressing.xml",$xml);
	$total = 0;
	foreach($Demandes as $p){
		echo "<br />".created('H:i:s')."<br />";
		flush();
		ob_flush();
		sleep(1); 
		$xml = "";
		$sexe_nom = $p['Sexe']['nom'];
		$sexe_slug = $p['Sexe']['slug'];
		$type_nom = $p['Type']['nom'];
		$matiere_nom = $p['Matiere']['nom'];
		$marque_nom = $p['Marque']['nom'];
		$refProd = $p['Demande']['id'];
		$Demande_prix = $p['Demande']['prix'];
		if ($p['Demande']['prixSolde'] > 0  && $p['Demande']['prixSolde'] != $p['Demande']['prix'] ){
			$prixBarre = $p['Demande']['prixSolde'];
			$mntRemise = $p['Demande']['prix'] - $p['Demande']['prixSolde'] ;
		}else{
			$prixBarre = 0;
			$mntRemise = 0;
		}
		$ref_client = $p['Demande']['seller_id'];
		
		$nom_Demande = $type_nom  . " " . strtolower ($sexe_nom) ;
		if (  $marque_nom != "autre")
			$nom_Demande .= " " . $marque_nom ;
		
		$description_court = $type_nom . " " . strtolower ($sexe_nom) ;
		$description = $p['Demande']['description'];
		$categorie_nom = $p['Category']['title'];
		
		
		$google_product_category = $p['Type']['google_product_category'];
		
		$etat_id = $p ['Demande']['etat_id'];
		if ( ($etat_id == 4) || ($etat_id == 5) )
			$etat_nom = "new";
		else
			$etat_nom = "used";
		//$nomCouleur = $p['nomCouleur'];
		//$nomTaille = $p['nomTaille'];
		
		$mots_clefs = strtolower($categorie_nom) ."," . strtolower($categorie_nom) . " marque ," . strtolower($type_nom).",".$sexe_slug.",".strtolower($marque_nom).", enfant, " .strtolower($matiere_nom); 
		$url_m = $p['Marque']['slug'];
		$url_t = $p['Type']['slug'];
		
		if ( $p['Marque']['is_createur'] == 1 )
			$url_marque = "/depot-vente-".$url_m.".html";
		else
			$url_marque = "/".$url_m."/vetement-enfant.html";
		
		$url_c = $p['Category']['slug'];
		//$url_categorie = "/".$url_c . "-enfant-".$nomSexe_a .".html";
		//$url_type = "/".$url_c . "-enfant-".$nomSexe_a ."-type-".$url_t.".html";
		$url_Demande = "http://www.kidsdressing.com/".$url_m."/".$url_c."s-enfant/".$refProd."-".$url_t."-".$sexe_slug.".html";
		
		$image = $p['Demande']['image'];
		$image2Prod = $p['Demande']['image2Prod'];
		$image3Prod = $p['Demande']['image3Prod'];
		$url_photo_1 = "";
		$url_photo_2 = "";
		$url_photo_3 = "";
		
		
			
		if (file_exists("uploads/Demandes/$image")){//si l'image du Demande existe
			
			//echo "photo n'existe pas <br>";
			//$total ++;
			//}
			$url_photo_1 = "http://www.kidsdressing.com/uploads/Demandes/$image";		
			if (file_exists("data/img/product/$image2Prod"))
				$url_photo_2 = "http://www.kidsdressing.com/uploads/Demandes/$image2Prod";
			
			if (file_exists("data/img/product/$image3Prod"))
				$url_photo_3 = "http://www.kidsdressing.com/uploads/Demandes/$image3Prod";
			
			
			$varietes = $this->Variete->find ("all",array('fields'=>array('DISTINCT Variete.taille_id'),
											'recursive'=>0,
											'conditions'=>array('Variete.demande_id'=>$refProd)));
			
			foreach($varietes as $v){
				$lbl_stock = "in stock";
				
				$taille_id = $v['Variete']['taille_id'];
				$taille = $this->Taille->find ('first',array('fields'=>'Taille.nom','conditions'=>"Taille.id = " . $taille_id ,'recursive'=>0));
				
				$taille_nom = $taille['Taille'] ['nom'];
				$liste_couleurs = "";
				//recherche la liste des couleurs des variantes du Demande
				$couleurs_Demande = $this->Variete->find ("all",array('fields'=>array('DISTINCT Variete.couleur_id'),
											'recursive'=>0,
											'conditions'=>array('Variete.demande_id'=>$refProd, "Variete.taille_id" => $taille_id)));
				foreach($couleurs_Demande as $cp){
					$couleur = $this->Couleur->find ('first',array('fields'=>'Couleur.nom','conditions'=>"Couleur.id = " . $cp['Variete']['couleur_id'] ,'recursive'=>0));
				
					$liste_couleurs .= $couleur['Couleur']['nom'] ."/";
				}
				$xml="<item>\n";
				$xml.="<g:id>".$refProd."</g:id>\n";
				$xml.="<reference-fournisseur>".$ref_client."</reference-fournisseur>\n";
				$xml.="<title><![CDATA[".$nom_Demande."]]></title>\n";
				$xml.="<description><![CDATA[".$description."]]></description>\n";
				$xml.="<mots-cles><![CDATA[".$mots_clefs."]]></mots-cles>\n";
				$xml.="<g:condition>".strtolower($etat_nom)."</g:condition>\n";
				$xml.="<g:availability>".$lbl_stock."</g:availability>\n";//disponible en stock ou non
				$xml.="<link><![CDATA[".$url_Demande ."]]></link>\n";
				$xml.="<g:image_link><![CDATA[".$url_photo_1."]]></g:image_link>\n";
				$xml.="<g:additional_image_link><![CDATA[".$url_photo_2."]]></g:additional_image_link>\n";
				$xml.="<g:additional_image_link><![CDATA[".$url_photo_3."]]></g:additional_image_link>\n";
				$xml.="<g:brand><![CDATA[".$marque_nom."]]></g:brand>\n";
				$xml.="<g:product_type><![CDATA[".$categorie_nom."]]></g:product_type>\n";//a revoir
				$xml.="<g:price>".$Demande_prix." EURO</g:price>\n";
				if ($prixBarre > 0 ) {
					$xml.="<g:sale_price>".$prixBarre." EURO</g:sale_price>\n";
					$xml.="<g:sale_price_effective_created></g:sale_price_effective_created>\n";
				}
				$xml.="<g:shipping>\n";
				$xml.="<g:country>FR</g:country>\n";
				$xml.="<g:service>Colissimo</g:service>\n";
				$xml.="<g:price>6.90 EURO</g:price>\n";
				$xml.="</g:shipping>\n";
				$xml.="<g:age_group>kids</g:age_group>\n";
				$xml.="<g:gender>".(strtolower($sexe_nom)== "homme"?"male":(strtolower($sexe_nom)== "femme"?"female":"unisex"))."</g:gender>\n";
				$xml.="<g:color><![CDATA[".$liste_couleurs."]]></g:color>\n";
				$xml.="<g:size>".$taille_nom."</g:size>\n";
				$xml.="<g:shipping_weight>500 g</g:shipping_weight>\n";	
				 //construire catégorie de google
				$xml.="<g:google_product_category><![CDATA[".$google_product_category."]]></g:google_product_category>\n";
				$xml.="<matiere>".$matiere_nom."</matiere>\n";
				 
				$xml.="<quantite>1</quantite>\n";
				 if( $categorie_nom == "Chaussures")
					$xml.="<pointure>".$taille_nom."</pointure>\n";
				 else
					$xml.="<pointure></pointure>\n";
					
				// $xml.="<dimension></dimension>\n";
				 
				 //$xml.="<g:url_categorie><![CDATA[".$url_categorie."]]></g:url_categorie>\n";
				 //$xml.="<g:url_sous-categorie><![CDATA[".$url_type."]]></g:url_sous-categorie>\n";
				 //$xml.="<g:url_sous-sous-categorie></url_sous-sous-categorie>\n";
				 //$xml.="<g:url_page_marque><![CDATA[".$url_marque."]]></url_page_marque>\n";
				  
				  $xml.="</item>\n";
				  file_put_contents("xml/Demandes-google-shopping-kidsdressing.xml",$xml,FILE_APPEND);
			
			}
			//LEFT OUTER JOIN couleur on (lpt.refProd = p.refProd)
			
		}

		
	} // while
	$xml .="</channel>\n";
	$xml .= "</rss>\n";
	//echo $total;
	file_put_contents("xml/Demandes-google-shopping-kidsdressing.xml",$xml,FILE_APPEND);
}
 */
 
 
	
	
	function save($demande_id) {
		//save annonce to favoris; 
		$q = $this->Demande->findById($demande_id ) ;
		if( !empty($q) ) {
			$favoris = $this->Cookie->read('Favoris') ; 
			if(empty($favoris) )  $favoris = array() ;
			if(! in_array($demande_id, $favoris ) )
				  array_push($favoris, $demande_id ) ;
			$this->Cookie->write('Favoris', $favoris) ;
			$this->Session->setFlash("Cette demande a bien été sauvegardée dans \"<a href='/services-preferes.html' >Vos services préférés</a>\" . ",'default',array('class'=>'valid_box') ) ;
			$this->redirect("/demandes/view/".$q['Demande']['id'] ) ; 
		}else die("Demande deleted") ;
	}
 	function deleteFromFavoris($demande_id) {
		$this->layout= $this->autoRender = false;
		//save annonce to favoris; 
		$q = $this->Demande->findById($demande_id ) ;
		if( !empty($q) ) {
			$favoris = $this->Cookie->read('Favoris') ; 
			if(empty($favoris) )  $favoris = array() ;
			foreach($favoris as $k=>$v) {
				  if($v == $demande_id ) unset($favoris[$k] ) ; 
			}
			$this->Cookie->write('Favoris', $favoris) ;
			$this->Session->setFlash("La demande a bien été supprimée de \"<a href='/services-preferes.html' >Vos services préférés</a>\" . ",'default',array('class'=>'valid_box') ) ;
			$this->redirect( $this->referer() ) ; 
		}else die("Error") ;
	}
	
	function preferes(){
		$favoris = $this->Cookie->read('Favoris') ;
		if(!empty($favoris  ) ) {
			$favoris_str = implode($favoris,',') ; 
			$this->paginate['conditions']=array() ;
			$this->paginate['limit'] = 30 ;
			$new = "Demande.id IN (".$favoris_str.")" ;
			array_push($this->paginate['conditions'], $new) ; 
			$this->paginate['order'] = "FIND_IN_SET(Demande.id, '".$favoris_str."')";
			$this->set('demandes',$this->paginate('Demande') ) ;
		}
		
	}
	
	function preferesList($prefere_id, $token) {
		$this->loadModel('Prefere') ; 
		$prefere = $this->Prefere->find('first',array('conditions'=>array(
															'Prefere.id'=>$prefere_id,
															'Prefere.token'=>$token
															))) ; 
		if(empty($prefere ) ){
			$this->Session->setFlash("Le lien est incorrect.",'default',array('class'=>'valid_box') ) ;
			$this->redirect('/') ; 
		}
		$favoris_str = $prefere['Prefere']['Demandes_list'] ;
		if(!empty( $favoris_str  ) ) {
			$this->paginate['conditions']=array() ;
			$this->paginate['limit'] = 30 ;
			$new = "Demande.id IN (".$favoris_str.")" ;
			array_push($this->paginate['conditions'], $new) ; 
			$this->paginate['order'] = "FIND_IN_SET(Demande.id, '".$favoris_str."')";
			$this->set('Demandes',$this->paginate('Demande') ) ;
		}
		$this->set('prefere',$prefere ) ; 
	}
	
//---------------------------------------------------------- Member ----------------------------------------------------------	
	function member_rechercher() {
		$this->paginate['limit'] = 30;
		$this->paginate['order'] = 'Demande.id desc';
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		//$this->paginate['conditions']["Demande.statut"] =  1 ; 
		$this->paginate['conditions']["Demande.seller_id"] =  $this->Session->read('Auth.Member.id')  ; 
		if( !empty($this->data) ) {
			if (!empty ($this->data['Demande']['query'])){
				$query = $this->data['Demande']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Type.nom like '%$query%'",
																"Sexe.nom like '%$query%'",
																"Demande.id = '$query'",
																"Demande.refDemandeClient ='$query'"
																));
			}
			if (!empty ($this->data['Demande']['marque'])){	
				$marque = $this->data['Demande']['marque'] ;
				$this->paginate['conditions']["Demande.marque_id"] =  $marque;
			}
		}
		$this->set('Demandes',$this->paginate('Demande') ) ;
		$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->set('balise_h1',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('member_Demandes') ;
	}
	
	function member_afficher($id) {
		$q = $this->Demande->findById($id);
				
		$this->loadModel('Variete'); 
		$varietes = $this->Variete->find('all',array(
				'fields'=>array('Variete.id','Variete.demande_id','Taille.nom','Couleur.nom','Variete.stock'),
				'conditions'=>array('Variete.demande_id'=>$id) ) ) ;
		$this->set('varietes',$varietes);
		
		
		$this->set('article',$q);
	}
	
	function member_ajouter (){	//ajouter un Demande
		if ( $this->Session->read('Auth.Member.type_compte') == 0 ) 
			$this->redirect ('/member/Demandes/part_ajouter');
		
		$inserted = false;
		if (! empty($this->data)){
			
			if (!empty($this->data['Demande']['sexe_id']) && !empty($this->data['Demande']['type_id']) && !empty($this->data['Demande']['etat_id']) 
				&& !empty($this->data['Demande']['marque_id']) && !empty($this->data['Demande']['matiere_id']) && !empty($this->data['Demande']['prix']) 
				&& !empty($this->data['Demande']['description']) ){
				
				if (empty($this->data['Demande']['prixSolde']) || $this->data['Demande']['prixSolde'] == "")
					$this->data['Demande']['prixSolde'] =0;
				//on vérifie que la photo principale a été renseigné
				if(!empty($this->data["Demande"]["imagePre"]["name"])){
					$this->data["Demande"]["image"] = "Indisponible.jpg ";
					$this->data["Demande"]["image2Prod"] = "Indisponible.jpg ";
					$this->data["Demande"]["image3Prod"] = "Indisponible.jpg ";
					$this->data["Demande"]["image4Prod"] = "Indisponible.jpg ";
					
					$this->data["Demande"]["seller_id"] = $this->Session->read('Auth.Member.id');
					//pr ($this->data);
					if( $this->Demande->save($this->data) ){
						$demande_id = $this->Demande->getLastInsertId();
						//pas de sauvegarde de la variante du Demande pour un compte pro
						
						
						//pour construire les noms des images des Demandes
						$q = $this->Demande->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["Demande"]["marque_id"])) ); 
						$marque = $q['Marque']['slug'];					
						$q = $this->Demande->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["Demande"]["sexe_id"]) )); 
						$sexe = $q['Sexe']['slug'];
						$q = $this->Demande->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["Demande"]["type_id"]) )); 
						$type = $q['Type']['slug'];
						$this->loadModel ('Matiere');
						$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["Demande"]["matiere_id"])) ); 
						$matiere = $q['Matiere']['slug'];
						
						$strRetour = "";						
						$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($matiere != 'autre'? '-'.$matiere : '') ;
						$file1 = 'Indisponible.jpg';
						$file2 = 'Indisponible.jpg';
						$file3 = 'Indisponible.jpg';
						$file4 = 'Indisponible.jpg';
						$file5 = '';
						//ensuite on enregistre les images
						if(!empty($this->data["Demande"]["imagePre"]["name"])){
							$file1 = $demande_id ."-1-". $slug_image .".".$this->_extension($this->data["Demande"]["imagePre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["imagePre"]["tmp_name"],"uploads/Demandes/".$file1);
						}
						if(!empty($this->data["Demande"]["image2ProdPre"]["name"])){
							$file2 = $demande_id ."-2-". $slug_image .".".$this->_extension($this->data["Demande"]["image2ProdPre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["image2ProdPre"]["tmp_name"],"uploads/Demandes/".$file2);
						}
						if(!empty($this->data["Demande"]["image3ProdPre"]["name"])){
							$file3 = $demande_id ."-3-". $slug_image .".".$this->_extension($this->data["Demande"]["image3ProdPre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["image3ProdPre"]["tmp_name"],"uploads/Demandes/".$file3);
						}
						if(!empty($this->data["Demande"]["image4ProdPre"]["name"])){
							$file4 = $demande_id ."-4-". $slug_image .".".$this->_extension($this->data["Demande"]["image4ProdPre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["image4ProdPre"]["tmp_name"],"uploads/Demandes/".$file4);
						}
						/*
						list($bRetour, $strRetour) = $this->_fctResize($this->data["Demande"]["imagePre"]["tmp_name"], $file1);
						if (!$bRetour) {
							$bTransfert = false;
							$file1 = 'Indisponible.jpg';
						}
						*/						
						
						//on met a jour les informations de les informations sur les 'images du Demande
						$Demande = array();					
						$Demande["Demande"]["id"] = $demande_id;
						$Demande["Demande"]["image"] = $file1;
						$Demande["Demande"]["image2Prod"] = $file2;
						$Demande["Demande"]["image3Prod"] = $file3;
						$Demande["Demande"]["image4Prod"] = $file4;						
						$this->Demande->save($Demande);	
						//pr($Demande);
						$inserted = true;
						//$this->_sendMailDemandeAjoute($demande_id) ;
						$this->_sendMailAdminDemandeAjoute($demande_id) ;
						$this->data ['Variete']['demande_id'] = $demande_id;
						$this->loadModel('Taille'); 
						$tailles = $this->Taille->find('list'); 
						$this->loadModel('Couleur'); 
						$couleurs = $this->Couleur->find('list');
						$this->set('couleurs',$couleurs);
						$this->set('tailles',$tailles);
						$this->Session->setFlash("<p>Votre annonce sera valid&eacute;e par notre &eacute;quipe &eacute;ditoriale et mise en ligne dans un d&eacute;lai de 24 heures maximum.</p><p>En cas de refus de votre annonce par l'&eacute;quipe &eacute;ditoriale, vous recevrez un email vous expliquant les motifs du refus.</p>","default",array('class'=>'valid_box'));

						$this->render('member_ajouter_ok') ;
					}else{
						$this->Session->setFlash("Une erreur a été rencontrée lors de l'insertion de l'article.","default",array('class'=>'error_box'));
					}
				
				}else{
					$this->Session->setFlash("La photo principale de l'article est obligatoire.","default",array('class'=>'error_box'));	
	
				}
				
			}else{
				$this->Session->setFlash("Veuillez renseigner tous les champs obligatoires.","default",array('class'=>'error_box'));	
			}
		}
		
		if (!$inserted){
			$this->_set_listes_form ();
			
		}
	}
	function _set_listes_form (){
		$sexes = $this->Demande->Sexe->find('list'); 
		$categories= $this->Demande->Type->Category->find('list',array('order'=>'Category.title asc')); 
		
		//$collections= $this->Demande->Type->Collection->find('list',array('order'=>'Collection.nom asc')); 
		$this->loadModel('Taille'); 
		$tailles = $this->Taille->find('list',array('order'=>'Taille.order asc')); 
		$this->loadModel('Couleur'); 
		$couleurs = $this->Couleur->find('list',array('order'=>'Couleur.nom asc')); 
		//$etats = $this->Demande->Etat->find('list'); 
		$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0','order'=>'Marque.nom asc'));  
		//$return['couleurs'] = $this->Demande->Couleur->find('list'); 
		/* $types = array ();
		if (! empty($this->data['Demande']['category_id'])){
			$types = $this->Demande->Type->find('list', array('conditions'=>array('category_id '=>$this->data['Demande']['category_id'] ),'order'=>'Type.nom asc' ) ) ; 
			//pr($types);
		} */
		$types = $this->Demande->Type->find('list', array('order'=>'Type.nom asc' ) ) ; 
		$matieres = $this->Demande->Matiere->find('list',array('order'=>'Matiere.nom asc')); 
		$figurines = $this->Demande->Figurine->find('list',array('order'=>'Figurine.nom asc')); 
		
		
		$this->set('sexes',$sexes);
		$this->set('categories',$categories);
		//$this->set('collections',$collections);
		//if ($types) 
		$this->set('types',$types);
		//$this->set('etats',$etats);
		$this->set('marques',$marques);
		$this->set('matieres',$matieres);
		$this->set('figurines',$figurines);
		$this->set('couleurs',$couleurs);
		$this->set('tailles',$tailles);
	}
	
	
	//page simple d'ajout d'un article (réservé pour les particuliers)
	function member_part_ajouter() {
		$inserted = false;
		if (! empty($this->data)){
			
			if (!empty($this->data['Demande']['sexe_id']) && !empty($this->data['Demande']['type_id']) && !empty($this->data['Demande']['etat_id']) 
				&& !empty($this->data['Demande']['marque_id']) && !empty($this->data['Demande']['matiere_id']) && !empty($this->data['Demande']['prix']) 
				&& !empty($this->data['Demande']['description']) && !empty($this->data['Demande']['couleur_id']) && !empty($this->data['Demande']['taille_id']) 
				&& !empty($this->data['Demande']['stock'])){
				
				if (empty($this->data['Demande']['prixSolde']) || $this->data['Demande']['prixSolde'] == "")
					$this->data['Demande']['prixSolde'] =0;
				
				//on vérifie que la photo principale a été renseigné
				if(!empty($this->data["Demande"]["imagePre"]["name"])){
					$this->data["Demande"]["image"] = "Indisponible.jpg ";
					$this->data["Demande"]["image2Prod"] = "Indisponible.jpg ";
					$this->data["Demande"]["image3Prod"] = "Indisponible.jpg ";
					$this->data["Demande"]["image4Prod"] = "Indisponible.jpg ";
					
					$this->data["Demande"]["seller_id"] = $this->Session->read('Auth.Member.id');
					//pr ($this->data);
					if( $this->Demande->save($this->data) ){
						$demande_id = $this->Demande->getLastInsertId();
						//sauvegarder la variante du Demande
						$variete = array();
						$variete ['Variete']['demande_id'] = $demande_id ;
						$variete ['Variete']['couleur_id'] = $this->data['Demande']['couleur_id'];
						$variete ['Variete']['taille_id'] = $this->data['Demande']['taille_id'];
						$variete ['Variete']['stock'] = $this->data['Demande']['stock'];
						$this->loadModel ('Variete');
						$this->Variete->save ($variete);
						
						//pour construire les noms des images des Demandes
						$q = $this->Demande->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["Demande"]["marque_id"])) ); 
						$marque = $q['Marque']['slug'];					
						$q = $this->Demande->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["Demande"]["sexe_id"]) )); 
						$sexe = $q['Sexe']['slug'];
						$q = $this->Demande->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["Demande"]["type_id"]) )); 
						$type = $q['Type']['slug'];
						$this->loadModel ('Couleur');
						$q = $this->Couleur->find('first',array('conditions'=>array("Couleur.id"=> $this->data["Demande"]["couleur_id"])) ); 
						$couleur = $q['Couleur']['slug'];
						
						$strRetour = "";						
						$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($couleur != 'autre'? '-'.$couleur : '') ;
						$file1 = 'Indisponible.jpg';
						$file2 = 'Indisponible.jpg';
						$file3 = 'Indisponible.jpg';
						$file4 = 'Indisponible.jpg';
						//ensuite on enregistre les images
						if(!empty($this->data["Demande"]["imagePre"]["name"])){
							$file1 = $demande_id ."-1-". $slug_image .".".$this->_extension($this->data["Demande"]["imagePre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["imagePre"]["tmp_name"],"uploads/Demandes/".$file1);
						}
						if(!empty($this->data["Demande"]["image2ProdPre"]["name"])){
							$file2 = $demande_id ."-2-". $slug_image .".".$this->_extension($this->data["Demande"]["image2ProdPre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["image2ProdPre"]["tmp_name"],"uploads/Demandes/".$file2);
						}
						if(!empty($this->data["Demande"]["image3ProdPre"]["name"])){
							$file3 = $demande_id ."-3-". $slug_image .".".$this->_extension($this->data["Demande"]["image3ProdPre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["image3ProdPre"]["tmp_name"],"uploads/Demandes/".$file3);
						}
						if(!empty($this->data["Demande"]["image4ProdPre"]["name"])){
							$file4 = $demande_id ."-4-". $slug_image .".".$this->_extension($this->data["Demande"]["image4ProdPre"]["name"]);					
							move_uploaded_file($this->data["Demande"]["image4ProdPre"]["tmp_name"],"uploads/Demandes/".$file4);
						}
						/*
						list($bRetour, $strRetour) = $this->_fctResize($this->data["Demande"]["imagePre"]["tmp_name"], $file1);
						if (!$bRetour) {
							$bTransfert = false;
							$file1 = 'Indisponible.jpg';
						}
						*/						
						
						//on met a jour les informations de les informations sur les 'images du Demande
						$Demande = array();					
						$Demande["Demande"]["id"] = $demande_id;
						$Demande["Demande"]["image"] = $file1;
						$Demande["Demande"]["image2Prod"] = $file2;
						$Demande["Demande"]["image3Prod"] = $file3;
						$Demande["Demande"]["image4Prod"] = $file4;						
						$this->Demande->save($Demande);	
						//pr($Demande);
						$inserted = true;
						$this->_sendMailDemandeAjoute($demande_id) ;
						$this->_sendMailAdminDemandeAjoute($demande_id) ;
						$this->render('member_part_ajouter_ok') ;
					}else{
						$this->Session->setFlash("Une erreur a été rencontrée lors de l'insertion de l'article.","default",array('class'=>'error_box'));
					}
				
				}else{
					$this->Session->setFlash("La photo principale de l'article est obligatoire.","default",array('class'=>'error_box'));	
	
				}
				
			}else
				$this->Session->setFlash("Veuillez renseigner tous les champs obligatoires.","default",array('class'=>'error_box'));	
		
		}
		
		if (!$inserted){
			$this->_set_listes_form ();
		}
		
	}
	
	
	
	function member_modifier ($demande_id){
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.Member.id')!= $this->data['Demande']['seller_id']){//on vérifie si l'utilisateur a le droit de modifier cet article (donc un article qui lui appartient)
				$this->Session->setFlash("Vous n'avez pas le droit de modifier cet article.","default",array('class'=>'error_box'));	
				$this->redirect("/member/Demandes/Demandes_en_vente") ;
			}
			
			if($this->Demande->save($this->data) )  {
				$Demande = array();
				$Demande['Demande']['id'] = $demande_id;
				//pour construire les noms des images des Demandes
				$q = $this->Demande->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["Demande"]["marque_id"])) ); 
				$marque = $q['Marque']['slug'];					
				$q = $this->Demande->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["Demande"]["sexe_id"]) )); 
				$sexe = $q['Sexe']['slug'];
				$q = $this->Demande->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["Demande"]["type_id"]) )); 
				$type = $q['Type']['slug'];
				$this->loadModel ('Matiere');
				$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["Demande"]["matiere_id"])) ); 
				$matiere = $q['Matiere']['slug'];
				
				$strRetour = "";						
				$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($matiere != 'autre'? '-'.$matiere : '') ;
				
				
				if(!empty($this->data["Demande"]["imagePre"]["name"])){
					$file1 = $demande_id ."-1-". $slug_image .".".$this->_extension($this->data["Demande"]["imagePre"]["name"]);					
					move_uploaded_file($this->data["Demande"]["imagePre"]["tmp_name"],"uploads/Demandes/".$file1);
					$Demande['Demande']['image'] = $file1;
				}
				if(!empty($this->data["Demande"]["image2ProdPre"]["name"])){
					$file2 = $demande_id ."-2-". $slug_image .".".$this->_extension($this->data["Demande"]["image2ProdPre"]["name"]);					
					move_uploaded_file($this->data["Demande"]["image2ProdPre"]["tmp_name"],"uploads/Demandes/".$file2);
					$Demande['Demande']['image2Prod'] = $file2;
				}
				if(!empty($this->data["Demande"]["image3ProdPre"]["name"])){
					$file3 = $demande_id ."-3-". $slug_image .".".$this->_extension($this->data["Demande"]["image3ProdPre"]["name"]);					
					move_uploaded_file($this->data["Demande"]["image3ProdPre"]["tmp_name"],"uploads/Demandes/".$file3);
					$Demande['Demande']['image3Prod'] = $file3;
				}
				if(!empty($this->data["Demande"]["image4ProdPre"]["name"])){
					$file4 = $demande_id ."-4-". $slug_image .".".$this->_extension($this->data["Demande"]["image4ProdPre"]["name"]);					
					move_uploaded_file($this->data["Demande"]["image4ProdPre"]["tmp_name"],"uploads/Demandes/".$file4);
					$Demande['Demande']['image4Prod'] = $file4;
				}
				//faire une sauvegarde des information du Demande
				$this->Demande->save($Demande);
				$this->Session->setFlash("L'article a été modifié avec succès.","default",array('class'=>'valid_box'));	
				$this->Demande->saveField('statut', 2);
				$this->redirect("/member/Demandes/Demandes_en_vente") ;
				}
		}
		$this->data = $this->Demande->findById($demande_id);
		if ($this->Session->read('Auth.Member.id')!= $this->data['Demande']['seller_id']){
			$this->Session->setFlash("Vous n'avez pas le droit de modifier cet article.","default",array('class'=>'error_box'));	
			$this->redirect("/member/Demandes/Demandes_en_vente") ;
		}else{
			$this->_set_listes_form ();
		}
	}
	
	
	/*ancien code 
	if($_FILES["file1"]["name"] != ''){
						$file1 = $refProd ."-1-". $pnom_photo .".".extension($_FILES["file1"]["name"]);					
						list($bRetour, $strRetour) = fctResize($_FILES["file1"], $file1);
						if (!$bRetour) {
							$bTransfert = false;
							showCreate4($strRetour);
						}
						if($_FILES["file2"]["name"] != ''){
							if($bTransfert){
									$file2 = $refProd ."-2-". $pnom_photo .".".extension($_FILES["file2"]["name"]);					
									list($bRetour, $strRetour) = fctResize($_FILES["file2"], $file2);
									if (!$bRetour){
										$bTransfert = false;
										showCreate4($strRetour);
									}
							}//fin bTransfert
						}
						if($_FILES["file3"]["name"] != ''){
								if($bTransfert){
									$file3 = $refProd ."-3-". $pnom_photo .".".extension($_FILES["file3"]["name"]);					
									list($bRetour, $strRetour) = fctResize($_FILES["file3"], $file3);
									if (!$bRetour) {
										$bTransfert = false;
										showCreate4($strRetour);
									}
								}//fin bTransfert
							}
						if($_FILES["file4"]["name"] != ''){
								if($bTransfert){
									$file4 = $refProd ."-4-". $pnom_photo .".".extension($_FILES["file4"]["name"]);					
									list($bRetour, $strRetour) = fctResize($_FILES["file4"], $file4);
									if (!$bRetour){
										$bTransfert = false;
										showCreate4($strRetour);
									}
								}//fin bTransfert
						}
						
						$file1 = ($file1 == 'Indisponible.jpg' || $file1 == '') ? 'Indisponible.jpg' : $file1 ;
						$file2 = ($file2 == 'Indisponible.jpg' || $file2 == '') ? 'Indisponible.jpg' : $file2 ;
						$file3 = ($file3 == 'Indisponible.jpg' || $file3 == '') ? 'Indisponible.jpg' : $file3 ;
						$file4 = ($file4 == 'Indisponible.jpg' || $file4 == '') ? 'Indisponible.jpg' : $file4 ;
						
						$strRequest = sprintf("UPcreated `Demande` SET `image`='%s', `image2Prod`='%s', `image3Prod`='%s', `image4Prod`='%s' WHERE `refProd`='%u'",
							mysql_real_escape_string($file1), 
							mysql_real_escape_string($file2), 
							mysql_real_escape_string($file3), 
							mysql_real_escape_string($file4),
							$refProd
						);
						$sqlResult = mysql_query($strRequest);
						
						if($sqlResult != false)
							showCreate6($refProd);
						else $contenu_body .= "Erreur est rencontrée lors de l'insertion des images.";
					
					}else{
						$contenu_body .= '<p class="error">Photo principale invalide.</p>';
					}
					
			*/
	
	
	function member_ajouter_etape2 (){//etape 2 d'ajout reservée pour les pro
		//si la premiere photo a été ajoutée => a terminer ou a refaire
		if (! empty($this->data)){
			$this->loadModel('Taille'); 
			$tailles = $this->Taille->find('list'); 
			$this->loadModel('Couleur'); 
			$couleurs = $this->Couleur->find('list');
			$this->set('couleurs',$couleurs);
			$this->set('tailles',$tailles);
			$this->render('member_ajouter_etape3') ;
		}else
			$this->redirect('member_ajouter') ;
	
	}
	
	function member_ajouter_etape3 (){
		//si la premiere photo a été ajoutée => a terminer ou a refaire
		
		
	
	}
	
	function member_modifier_statut($id) {
		if(isset($this->data) ) {
			$this->data['Demande']['seller_id'] = $this->Session->read('Auth.Member.id') ;
			if($this->Demande->save($this->data) )  {
				$this->Session->setFlash("Le statut de l'article a été modifié avec succès.","default",array('class'=>'valid_box'));	
				//$this->redirect("/member/members/commandes_clients") ;
				//$this->redirect($this->referer()) ;
				}
		}
		$this->Demande->id = $id ;
		$this->data = $this->Demande->read();
		
		$this->loadModel('Orderrowstatut');
		$statuts = $this->Orderrowstatut->find('list',array(
															'order','Orderrowstatut.titre asc',
															'conditions' => array('not'=>array(
																					'Orderrowstatut.id'=>4) )) ) ;
		$this->set('statuts',$statuts);
	}
	
	
	
	function member_variete_modifier($id) {
		$this->loadModel('Taille'); 
		$tailles = $this->Taille->find('list'); 
		$this->loadModel('Couleur'); 
		$couleurs = $this->Couleur->find('list'); 
		
		
		$this->set('couleurs',$couleurs);
		$this->set('tailles',$tailles);
				
		if(isset($this->data) ) {
			//$this->data['Demande']['seller_id'] = $this->Session->read('Auth.Member.id') ;
			$demande_id = $this->data['Variete']['demande_id'] ;
			//$demande_id = $this->data['Variete']['demande_id'] ;
			
			if($this->Demande->Variete->save($this->data) )  {
				$this->Session->setFlash("Le stock a été modifié avec succès.","default",array('class'=>'valid_box'));	
				$this->redirect("/member/Demandes/afficher/".$demande_id) ;
			}
		}else{
			//$this->Demande->Variete->id = $id ;
			$this->data = $this->Demande->Variete->findById($id);	
			//pr ($this->data);
		}
	}
	
	
	function member_variete_ajouter($demande_id = NULL) {
		//si soumession des données
		if(isset($this->data)){
			//on vérifie si ce type de variante n'existe pas déja
			//si non => sauvegarder
			$demande_id = $this->data['Variete']['demande_id'];
			$taille_id = $this->data['Variete']['taille_id'];
			$couleur_id = $this->data['Variete']['couleur_id'];				
			$this->loadModel('Variete');
			$variete = $this->Variete->find ('first',array('conditions'=>array('Variete.demande_id'=>$demande_id, 'Variete.couleur_id'=>$couleur_id,'Variete.taille_id'=>$taille_id)));
			if ($variete){//sortie en erreur
				$this->Session->setFlash("La variante est déjà définie. Veuillez vérifier la liste des variantes de l'article." ,"default",array('class'=>'error_box'));
				$this->redirect("/member/Demandes/afficher/".$demande_id) ;				
			}else{//si oui envoyer =>message erreur
				$this->Variete->save($this->data);
				$this->Session->setFlash("La variante a été ajoutée avec succès." ,"default",array('class'=>'valid_box'));
				$this->redirect("/member/Demandes/afficher/".$demande_id) ;
			}			
		}
		$this->data['Variete']['demande_id'] = $demande_id; 
		$this->loadModel('Taille'); 
		$tailles = $this->Taille->find('list'); 
		$this->loadModel('Couleur'); 
		$couleurs = $this->Couleur->find('list'); 
		$this->set('couleurs',$couleurs);
		$this->set('tailles',$tailles);
	}
	
	function member_variete_delete($variete_id) {
		//$this->data = $this->Demande->Variete->findById ($variete_id);
		if($this->Demande->Variete->delete($variete_id)) {
			$this->Session->setFlash("La variante a été supprimée avec succès.","default",array('class'=>'valid_box'));	
		}else
			$this->Session->setFlash("Une erreur a été rencontrée lors de la suppresion de la variante.","default",array('class'=>'valid_box'));	
		$this->redirect ($this->referer ());
		
	}
	
	
	function member_modifier_images($id) {
		if(!empty($this->data) ) {
			$this->data['Demande']['seller_id'] = $this->Session->read('Auth.Member.id');
			if($this->Demande->save($this->data) )  {
				$this->Session->setFlash("L'article a été modifié avec succès","default",array('class'=>'valid_box'));
				$this->redirect("/member/members/articles") ;
				}
		}else{
			$this->Demande->id = $id ;
			$this->data = $this->Demande->read();	
		}
	}
	function member_delete ($id){
		if($id!=null){
			    $this->Demande->id = $id ;
				$image1= $this->Demande->field('image') ;
				$image2= $this->Demande->field('image2Prod') ;
				$image3= $this->Demande->field('image3Prod') ;
                if($this->Demande->saveField('deleted',1) ) {
				   $this->Session->setFlash("Le Demande a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
				   $this->redirect($this->referer()) ;
				 }else{
					 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Demande." ,"default",array('class'=>'error_box'));
					$this->redirect($this->referer()) ;				 
				 }
				                
            }
	
	}
	
	
	function member_lot_ajouter (){
	
	
	}
	
	function member_lot_modifier (){
	
	
	}
	
	function member_lot_delete (){
	
	
	}
	
	/* function member_Demandes (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; //que les Demandes validés
		$this->paginate['conditions']["Demande.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$this->set ('page_title','Mes articles en ventes sur Services4all');
	} */
	
	function member_Demandes_en_vente (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; // articles validés
		$this->paginate['conditions']["Demande.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Demandes', $this->_set_varietes_Demandes ($this->paginate('Demande'))) ;  
		$this->set ('page_title','Articles validés | kidsdressing');
		$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->render("member_Demandes");
	}
	
	function member_Demandes_vendus (){ 
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] =  1 ; // articles validés
		$this->loadModel('Orderrow') ;		
		$this->paginate['conditions']["Demande.id"] = $this->data['Orderrow']['demande_id'] ;// Les articles qui se trouvent dans Orderrows
		$this->paginate['conditions']["Demande.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->loadModel('Variete'); 
		$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
		$this->set('varietes',$varietes);														
		$this->set('marques',$marques);
		$this->set('Demandes',$this->paginate('Demande') );
		$this->set ('page_title','Articles vendus | Services4all');
		$this->render("member_Demandes");
	}
	
	function member_Demandes_en_at_validation (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Demande.deleted"] =  0 ; 
		$this->paginate['conditions']["Demande.statut"] = array( 0 ,2); // articles en attente de validation
		$this->paginate['conditions']["Demande.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Demandes',$this->paginate('Demande') );
		$this->set ('page_title','Articles en attente de validation | Services4all');
		$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->render("member_Demandes");
	}
	
	function member_Demandes_supprimes (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Demande.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Demande.deleted"] = 1 ; // articles supprimés
		$this->paginate['conditions']["Demande.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Demandes',$this->paginate('Demande') );
		$this->set ('page_title','Articles supprimés | Services4all');
		$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->render("member_Demandes");
	}
	
	function member_publier($id){
		$this->Demande->id = $id;
		if( $this->Demande->saveField('publish', 1) ){
			   $this->Session->setFlash("L'article a été publié avec succès.","default",array('class'=>'valid_box'));	
			   $this->redirect($this->referer()) ;	
			 };
		$this->redirect($this->referer()) ;	

	}
	function member_depublier($id){
		$this->Demande->id = $id;
		if( $this->Demande->saveField('publish', 0) ){
			   $this->Session->setFlash("L'article a été dépublié avec succès.","default",array('class'=>'valid_box'));	
			   $this->redirect($this->referer()) ;	
		};
		$this->redirect($this->referer()) ;	
	}


//----------------------------------------- Admin ----------------------------------------------	
		function admin_index(){
			$this->paginate['conditions'] =  "Demande.deleted = 0 and Demande.statut = 1" ;
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Demandes',$this->paginate('Demande') );
			$this->set('page_title','Liste des articles en ligne');
			$this->set('balise_h1','Liste des articles en ligne');
			$this->render('admin_index') ;
		}
		function admin_rechercher() {
            $this->paginate['limit'] = 30;
            $this->paginate['order'] = 'Demande.id desc';
            $this->paginate['conditions']["Demande.deleted"] =  0 ;
			$query = "";
            if( !empty($this->data) ) {
                if (!empty ($this->data['Demande']['query'])){
                    $query = $this->data['Demande']['query'] ;
                    $this->paginate['conditions']["and"] = array(
                                                            'or'=>array(
                                                                "Type.nom like '%$query%'",
                                                                "Sexe.nom like '%$query%'",
                                                                "Figurine.nom like '%$query%'",
                                                                /* "Seller.nom like '%$query%'",
                                                                "Seller.prenom like '%$query%'",
                                                                "Seller.pseudo like '%$query%'",
                                                                "Seller.email like '%$query%'", */
                                                                "Demande.id = '$query'",
                                                                ));
                    }
                if (!empty ($this->data['Demande']['marque'])){   
                        $marque = $this->data['Demande']['marque'] ;
                        $this->paginate['conditions']["Demande.marque_id"] =  $marque;
                    }
            }
            $q = $this->paginate('Demande') ;
            $marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
                                                                'order'=>'Marque.nom asc'));
            /* $this->loadModel('Variete');
            $varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
            $this->set('varietes',$varietes);  */                                                      
            $this->set('marques',$marques);
            $this->set('Demandes', $q ) ;
            $this->set('balise_h1',"Résultat de la recherche : " . $query);
            $this->set('page_title','Résultat de la recherche');
            $this->render('admin_index') ;
        }
		
		function admin_non_valides(){
           	$this->paginate["conditions"] = "Demande.deleted = 0 and Demande.statut = 0" ;
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Demandes',$this->paginate('Demande') );
			$this->set('page_title','Liste de tous les nouveaux articles non validés');
			$this->set('balise_h1','Liste de tous les nouveaux articles non validés');
			$this->render('admin_index');
			
		}
		
		function admin_modifies_non_valides(){
			$this->paginate['conditions'] = "Demande.deleted = 0 and Demande.statut = 2" ;
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Demandes',$this->paginate('Demande') );
			$this->set('page_title','Liste de tous les articles modifiés non validés');
			$this->set('balise_h1','Liste de tous les articles modifiés non validés');
			$this->render('admin_index');
		}
		
		function admin_member() {//liste des commandes d'un membre

		}
		
		function _getVendus(){
			$this->loadModel('Order') ;	
			$vendus = $this->Order->find('all', array('conditions'=>array('Order.ostatut_id = 3 and Order.deleted =0'))) ;//validée
			return $vendus ;	
		}
		
		function _getEpuises(){
			$this->loadModel('Orderrow') ;	
			$epuises = $this->Orderrow->find('all') ;
			return $epuises ;	
		}
	
		function admin_vendus() {//liste des Demandes vendus sur le site donc ceux qui se retrouvent dans la ligne des commandes validées
			//a terminer 
			$vendus = $this->_getVendus($this->data['Demande']['id'] )  ;
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$vendus = $this->paginate('Demande') ;
			//echo $vendus;
			$this->set('Demandes',$vendus) ;
			
			$this->set('page_title','Liste de tous les articles vendus.');
			$this->set('balise_h1','Liste de tous les articles vendus');
			$this->render('admin_index');
		}
		
		function admin_epuises() {//liste des Demandes dont le stock est épuisé (pour voir si anomalie) et les désactiver
			//a terminer
			$epuises = $this->_getEpuises($this->data['Demande']['id'] )  ;
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$epuises = $this->paginate('Demande') ;
			//echo $epuises;
			$this->set('Demandes',$epuises) ;
			$this->set('page_title','Liste de tous les articles épuisés.');
			$this->set('balise_h1','Liste de tous les articles épuisés');
			
			$this->render('admin_index');
		}
		
		
		function admin_supprimes() {
			$this->paginate = array(
								"conditions" => "Demande.deleted = 1",
								'recursive'=>2,
								'limit' => 20,
								"order" => "Demande.id desc"
								) ; 
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Demandes',$this->paginate('Demande') );
			$this->set('page_title','Liste des articles supprimés');
			$this->set('balise_h1','Liste des articles supprimés');
			$this->render('admin_index');
		}
	
		function admin_tous() {//liste des Demandes marques comme supprimes
			$this->paginate = array(
								'recursive'=>2,
								'limit' => 20,"conditions"=>"Demande.deleted = 0",
								"order" => "Demande.id desc"
								) ; 
			$marques = $this->Demande->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Demandes',$this->paginate('Demande') );
			$this->set('page_title','Liste de tous les articles');
			$this->set('balise_h1','Liste de tous les articles');
			$this->render('admin_index');
		}
	
	
		function admin_afficher($id){
			$q = $this->Demande->findById($id);
           
			$this->loadModel('Variete'); 
			$varietes = $this->Variete->find('all',array(
				'fields'=>array('Variete.id','Taille.nom','Couleur.nom','Variete.stock'),
				'conditions'=>array('Variete.demande_id'=>$id) ) ) ;
			 $this->set('varietes',$varietes); 
			 
			 $this->set('Demande',$q);
			 
        }

		function admin_modifier_tags() {
			
			if(isset($this->data)){
				$this->Demande->id = $this->data['Demande']['id'];
				if ($this->Demande->saveField('tag_home', $this->data['Demande']['tag_home']) &&  $this->Demande->saveField('tag_nouveaute', $this->data['Demande']['tag_nouveaute']) && $this->Demande->saveField('tag_selection', $this->data['Demande']['tag_selection']) && $this->Demande->saveField('tag_coups_coeur', $this->data['Demande']['tag_coups_coeur']) && $this->Demande->saveField('tag_bonplan', $this->data['Demande']['tag_bonplan'])) {
					$this->Session->setFlash("Le paramétrage des tages a été enregistré avec succès.","default",array('class'=>'valid_box'));                   
				}else
					$this->Session->setFlash("Une erreur a été rencontrée lors du paramétrage des tages.","default",array('class'=>'valid_box'));	
                    
				$this->redirect($this->referer()) ;
			} else{
				$this->Demande->id = $this->data['Demande']['id'] ;
				$this->data = $this->Demande->read();
			}
		}
		
		function admin_valider($id) {
			$this->Demande->id = $id;
			$this->Demande->findById( $id ) ;
			$this->Demande->set('statut', 1) ;
			if( $this->Demande->save() ){
			    $this->Session->setFlash("L'article a été validé avec succès.","default",array('class'=>'valid_box'));	
				//envoyer un mail à l'annonceur que l'article a été validé
			
			};
			$this->redirect($this->referer())  ;
		}
	    
		function admin_refuser($id) {
			$this->Demande->id = $id;
			if( $this->Demande->saveField('statut', 3) ){
			    $this->Session->setFlash("L'article a été marqué en statut refusé avec succès.","default",array('class'=>'valid_box'));	
				//envoyer un mail à l'annonceur que l'article a été refusé
				
			};
			$this->redirect("index")  ;
		}
		
		
		
	    function admin_publier($id){
			$this->Demande->id = $id;
			if( $this->Demande->saveField('publish', 1) ){
			       $this->Session->setFlash("L'article a été publié avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				 };
			$this->redirect("index")  ;

	    }
		function admin_depublier($id){
			$this->Demande->id = $id;
			if( $this->Demande->saveField('publish', 0) ){
			       $this->Session->setFlash("L'article a été dépublié.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
			};
			$this->redirect("index")  ;
	    }
		
        function admin_remonter ($id){
                 // on va 
				$this->Demande->id = $id ; 
				$p = $this->Demande->read(array('position','categorie_id'))  ; 
				// si la position est superieur a 1  -1
				if($p['Demande']['position'] > 1 ) {
				             $new_position = $p['Demande']['position'] - 1 ; 
		  		             $this->Demande->saveField('position', $new_position) ; 
								// on ajoute 1 au Demande qui suit  dans la mme categorie
							$q = $this->Demande->find('first',array("conditions"=>array(
																					'and'=>array('position <'=>$new_position,
																								 'categorie_id'=>$p['Demande']['categorie_id']
																								 ) 
																						)
																	) ) ;
							if(!empty($q)) {
									 // on ajoute 1 
									 $this->Demande->id = $q['Demande']['id'] ;						 
									 $new_position = $p['Demande']['position'] ; 
									 $this->Demande->saveField('position', $new_position ) ; 
									 }			 
							 
							 
							 
				}
				

				$this->redirect($this->referer() ) ;
         }		 
		function admin_descendre ($id){
		                        
				$this->Demande->id = $id ; 
				$p = $this->Demande->read(array('position','categorie_id'))  ; 
				$new_position = $p['Demande']['position'] + 1 ; 
			    $this->Demande->saveField('position', $new_position) ; 
				 
				
				// on decremente 1 du Demande qui suit  dans la mme cat
				$q = $this->Demande->find('first',array("conditions"=>array(
																		'and'=>array('position <'=>$new_position,
																	    'categorie_id'=>$p['Demande']['categorie_id']
																		 ) 
														             )
										 ) ) ;
				if(!empty($q) && $q['Demande']['id'] >1 ) {
				         // on  -1
						 $this->Demande->id = $q['Demande']['id'] ;						 
						 $new_position = $p['Demande']['position']   ; 
						 $this->Demande->saveField('position', $new_position ) ; 
						 } 
				$this->redirect($this->referer() ) ;
		
		}
		
		function admin_ajouter(){
					    // Langues à éditer
				$locales = array_values(Configure::read('Config.languages'));
				$this->Demande->locale = $locales;
		    if(isset($this->data)){
				if (empty($this->data['Demande']['prixGros']))
					$this->data['Demande']['prixGros'] = 0;
				if (empty($this->data['Demande']['prixSolde']))
					$this->data['Demande']['prixSolde'] = 0;	
				if (empty($this->data['Demande']['prixAchat']))
					$this->data['Demande']['prixAchat'] = 0;
				if (empty($this->data['Demande']['refDemandeClient']))
					$this->data['Demande']['refDemandeClient'] = "";
				if (empty($this->data['Demande']['figurine_id']))
					$this->data['Demande']['figurine_id'] = 0;
				//pr ($this->data);
				if( $this->Demande->save($this->data) ){
					
					$Demande = array();
					$demande_id = $this->Demande->id ;
					$Demande['Demande']['id'] = $demande_id ;
					$Demande['Demande']['statut'] = 1 ;
					//pour construire les noms des images des Demandes
					$q = $this->Demande->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["Demande"]["sexe_id"]) )); 
					$sexe = $q['Sexe']['slug'];
					$q = $this->Demande->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["Demande"]["type_id"]) )); 
					$type = $q['Type']['slug'];
					$this->loadModel ('Matiere');
					$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["Demande"]["matiere_id"])) ); 
					$matiere = $q['Matiere']['slug'];
					
					$strRetour = "";						
					$slug_image = $type . '-' . ($sexe == 'mixte'? '': $sexe) . '-' . ($matiere != 'autre'? '-'.$matiere : '') ;
					
					
					if(!empty($this->data["Demande"]["imagePre"]["name"])){
						$file1 = $demande_id ."-1-". $slug_image .".".$this->_extension($this->data["Demande"]["imagePre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["imagePre"]["tmp_name"],"uploads/Demandes/".$file1);
						$Demande['Demande']['image'] = $file1;
					}
					if(!empty($this->data["Demande"]["image2ProdPre"]["name"])){
						$file2 = $demande_id ."-2-". $slug_image .".".$this->_extension($this->data["Demande"]["image2ProdPre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image2ProdPre"]["tmp_name"],"uploads/Demandes/".$file2);
						$Demande['Demande']['image2Prod'] = $file2;
					}
					if(!empty($this->data["Demande"]["image3ProdPre"]["name"])){
						$file3 = $demande_id ."-3-". $slug_image .".".$this->_extension($this->data["Demande"]["image3ProdPre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image3ProdPre"]["tmp_name"],"uploads/Demandes/".$file3);
						$Demande['Demande']['image3Prod'] = $file3;
					}
					if(!empty($this->data["Demande"]["image4ProdPre"]["name"])){
						$file4 = $demande_id ."-4-". $slug_image .".".$this->_extension($this->data["Demande"]["image4ProdPre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image4ProdPre"]["tmp_name"],"uploads/Demandes/".$file4);
						$Demande['Demande']['image4Prod'] = $file4;
					}
					if(!empty($this->data["Demande"]["image_demo_personnalisePre"]["name"])){
						$file5 = $demande_id ."-bijou-personnalise-". $slug_image .".".$this->_extension($this->data["Demande"]["image_demo_personnalisePre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image_demo_personnalisePre"]["tmp_name"],"uploads/Demandes/".$file5);
						$Demande['Demande']['image_demo_personnalise'] = $file5;
					}
					//faire une sauvegarde des information du Demande
					$this->Demande->save($Demande);
					
					$this->Session->setFlash("Le Demande a été ajouté avec succès.","default",array('class'=>'valid_box'));	
                    $this->redirect("index") ;
				}else{
						$this->Session->setFlash("Une erreur a été rencontrée lors de l'ajout du Demande.","default",array('class'=>'error_box'));	
                		
				}
            }
			//pr ($this->data);
			$this->_set_listes_form ();
			$this->set('evenements',$this->Demande->Evenement->find('list',array(
													"conditions" => array("Evenement.deleted = 0 and Evenement.visible = 1"),
													"order" => "Evenement.position DESC"
													)));
			$this->set('collections',$this->Demande->Collection->find('list',array(
													"conditions" => array("Collection.deleted = 0 and Collection.visible = 1"),
													"order" => "Collection.nom desc"
													)));
			$vendeurs = $this->Demande->Seller->find('all',array('order'=>'Seller.nom asc','fields'=>array('Seller.id','Seller.nom','Seller.prenom','Seller.pseudo')));
			$this->set('vendeurs',$vendeurs);
			
			$this->set('page_title',"Ajouter un Demande");
			
		} 
		function admin_modifier($demande_id){
		    		    // Langues à éditer
				$locales = array_values(Configure::read('Config.languages'));
				$this->Demande->locale = $locales;
			if(isset($this->data)){
                if($this->Demande->save($this->data) )  {
					$Demande = array();
					$Demande['Demande']['id'] = $demande_id;
					//pour construire les noms des images des Demandes
					$q = $this->Demande->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["Demande"]["marque_id"])) ); 
					$marque = $q['Marque']['slug'];					
					$q = $this->Demande->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["Demande"]["sexe_id"]) )); 
					$sexe = $q['Sexe']['slug'];
					$q = $this->Demande->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["Demande"]["type_id"]) )); 
					$type = $q['Type']['slug'];
					$this->loadModel ('Matiere');
					$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["Demande"]["matiere_id"])) ); 
					$matiere = $q['Matiere']['slug'];
					 
					$strRetour = "";						
					$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($matiere != 'autre'? '-'.$matiere : '') ;
					
					
					if(!empty($this->data["Demande"]["imagePre"]["name"])){
						$file1 = $demande_id ."-1-". $slug_image .".".$this->_extension($this->data["Demande"]["imagePre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["imagePre"]["tmp_name"],"uploads/Demandes/".$file1);
						$Demande['Demande']['image'] = $file1;
					}
					if(!empty($this->data["Demande"]["image2ProdPre"]["name"])){
						$file2 = $demande_id ."-2-". $slug_image .".".$this->_extension($this->data["Demande"]["image2ProdPre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image2ProdPre"]["tmp_name"],"uploads/Demandes/".$file2);
						$Demande['Demande']['image2Prod'] = $file2;
					}
					if(!empty($this->data["Demande"]["image3ProdPre"]["name"])){
						$file3 = $demande_id ."-3-". $slug_image .".".$this->_extension($this->data["Demande"]["image3ProdPre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image3ProdPre"]["tmp_name"],"uploads/Demandes/".$file3);
						$Demande['Demande']['image3Prod'] = $file3;
					}
					if(!empty($this->data["Demande"]["image4ProdPre"]["name"])){
						$file4 = $demande_id ."-4-". $slug_image .".".$this->_extension($this->data["Demande"]["image4ProdPre"]["name"]);					
						move_uploaded_file($this->data["Demande"]["image4ProdPre"]["tmp_name"],"uploads/Demandes/".$file4);
						$Demande['Demande']['image4Prod'] = $file4;
					}
					//faire une sauvegarde des information du Demande
					$this->Demande->save($Demande);
					
					$this->Session->setFlash("Le Demande a été modifié avec succès.","default",array('class'=>'valid_box'));	
                    $this->redirect("index") ;
				}
			} else{ 
				$this->data = $this->Demande->findById($demande_id);
				$this->_set_listes_form ();
			    $vendeurs = $this->Demande->Seller->find('all',array('order'=>'Seller.nom asc','fields'=>array('Seller.id','Seller.nom','Seller.prenom','Seller.pseudo')));
			    $this->set('vendeurs',$vendeurs);
				$this->set('evenements',$this->Demande->Evenement->find('list',array(
													"conditions" => array("Evenement.deleted = 0 and Evenement.visible = 1"),
													"order" => "Evenement.position DESC"
													)));
				$this->set('collections',$this->Demande->Collection->find('list',array(
													"conditions" => array("Collection.deleted = 0 and Collection.visible = 1"),
													"order" => "Collection.nom desc"
													)));
				$this->set('page_title',"Modifier l'article : " . $this->data['Demande']['id']);
			}
		}
        function admin_delete($id){
            if($id!=null){
			    $this->Demande->id = $id ;
				$image1= $this->Demande->field('image') ;
				$image2= $this->Demande->field('image2Prod') ;
				$image3= $this->Demande->field('image3Prod') ;
                if($this->Demande->saveField('deleted',1) ) {
				   $this->Session->setFlash("Le Demande a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
				   $this->redirect($this->referer()) ;
				 }else{
					 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Demande." ,"default",array('class'=>'error_box'));
					$this->redirect($this->referer()) ;				 
				 }
				                
            }
        }
		
		function admin_restore($id){// pour restaurer le Demande
            if($id!=null){
			    $this->Demande->id = $id ;
				$image1= $this->Demande->field('image') ;
				$image2= $this->Demande->field('image2Prod') ;
				$image3= $this->Demande->field('image3Prod') ;
                if($this->Demande->saveField('deleted',0) ) {
				   $this->Session->setFlash("Le Demande a été restauré avec succès." ,"default",array('class'=>'valid_box'));
				   $this->redirect($this->referer()) ;
				 }else{
					 $this->Session->setFlash("Une erreur a été rencontré lors de la restauration du Demande." ,"default",array('class'=>'error_box'));
					$this->redirect($this->referer()) ;				 
				 }
				                
            }
        }
		
        function admin_permanently_delete($id) {// pour suprimer définitivement le Demande
			if($id!=null) {
				if($this->Demande->delete($id) ) {
					$this->Session->setFlash("Le Demande a été suprimé définitivement.","default",array('class'=>'valid_box'));	
					$this->redirect($this->referer()) ;	
				 }
				else $this->Session->setFlash("Une erreur a été rencontré lors de la suppression","default",array('class'=>'valid_box'));	
				$this->redirect($this->referer()) ;	
			}	
		}	
        
		function admin_variete_ajouter ($demande_id =NULL){
			//si soumession des données
			if(isset($this->data)){
				//on vérifie si ce type de variante n'existe pas déja
				//si non => sauvegarder
				$demande_id = $this->data['Variete']['demande_id'];
				$taille_id = $this->data['Variete']['taille_id'];
				$couleur_id = $this->data['Variete']['couleur_id'];				
				$this->loadModel('Variete');
				$variete = $this->Variete->find ('first',array('conditions'=>array('Variete.demande_id'=>$demande_id, 'Variete.couleur_id'=>$couleur_id,'Variete.taille_id'=>$taille_id)));
				if ($variete){//sortie en erreur
					$this->Session->setFlash("La variante est déjà définie. Veuillez vérifier la liste des variantes de l'article." ,"default",array('class'=>'error_box'));
					$this->redirect("/admin/Demandes/afficher/".$demande_id) ;				
				}else{//si oui envoyer =>message erreur
					$this->Variete->save($this->data);
					$this->Session->setFlash("La variante a été ajoutée avec succès." ,"default",array('class'=>'valid_box'));
					$this->redirect("/admin/Demandes/afficher/".$demande_id) ;
				}			
			}
			$this->data['Variete']['demande_id'] = $demande_id; 
			$this->loadModel('Taille'); 
			$tailles = $this->Taille->find('list'); 
			$this->loadModel('Couleur'); 
			$couleurs = $this->Couleur->find('list'); 
			$this->set('couleurs',$couleurs);
			$this->set('tailles',$tailles);
			
		}
		
		function admin_variete_modifier ($variete_id){
			if(isset($this->data)){
				if($this->Demande->Variete->save($this->data) )  {
			       $demande_id = $this->data['Variete']['demande_id'];
				   $this->Session->setFlash("Le stock a été modifié avec succès.","default",array('class'=>'valid_box'));	
                    $this->redirect("/admin/Demandes/afficher/".$demande_id) ;
				}else
					$this->Session->setFlash("Une erreur a été rencontré lors de la modification du stock.","default",array('class'=>'error_box'));	
                  
			} 
			$this->Demande->Variete->id = $variete_id ;
			$this->data = $this->Demande->Variete->read();
		}
		
		function admin_variete_delete($variete_id) {
			if($this->Demande->Variete->delete($variete_id) )  {
			   $this->Session->setFlash("La variante a été supprimée avec succès.","default",array('class'=>'valid_box'));	
			}else
				$this->Session->setFlash("Une erreur a été rencontrée lors de la suppression de la variante.","default",array('class'=>'error_box'));	
			$this->redirect($this->referer()) ;
			
		}	
	
	
	function admin_tag($id=null) {
		if(isset($this->data)){
			$this->Demande->id = $id;
			//echo $this->data['Demande']['id'];
			if ($this->Demande->saveField('tag_home', $this->data['Demande']['tag_home']) &&  $this->Demande->saveField('tag_nouveaute', $this->data['Demande']['tag_nouveaute']) && $this->Demande->saveField('tag_selection', $this->data['Demande']['tag_selection']) && $this->Demande->saveField('tag_coups_coeur', $this->data['Demande']['tag_coups_coeur']) && $this->Demande->saveField('tag_bonplan', $this->data['Demande']['tag_bonplan'])) {
				$this->Session->setFlash("Le paramétrage des tages a été enregistré avec succès.","default",array('class'=>'valid_box'));                   
			}else
				$this->Session->setFlash("Une erreur a été rencontrée lors du paramétrage des tages.","default",array('class'=>'valid_box'));	
				
			$this->redirect("index")  ;
		}
		$this->Demande->id = $id ;
		$this->data = $this->Demande->read();
	}
	
	function region($id){
		$data["Demande"]=$this->Demande->find("all",array(
			"conditions" => array("Demande.statut = 1 and Demande.region=$id"),
						"order" => "Demande.id DESC"
		));
		$this->set('Demandes',$data["Demande"]);
		$this->render("index");
	}
	
	function rechercher(){
		$rech_req = "";
		if(isset($this->params['url']['query'] ) ) { 
					   $rech_req = $this->params['url']['query'] ;				
		}
		// on remplace les espace par % pour avoir bcps de resultas
		$rech = str_replace(' ','%' ,$rech_req ) ; // pour avoir tous les mots
		$conditions =     array ("or" => array  (
												 "Demande.description LIKE" => "%".$rech."%",
												 "Demande.tags LIKE" => "%".$rech."%",
												 "Demande.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Demandes',$this->paginate('Demande'));
		$this->set ('rech_req',$rech_req);
	}
	
	
	
	function modifier($id){
	  if (empty($this->data)) {
			$this->Demande->id = $id ;
			$this->data = $this->Demande->read();
			$this->set("Demande", $this->data['Demande']  ) ;
		} else {
			$image1 = "null"; $image2 = "null"; $image3 = "null";
			$this->data["Demande"]["image"] = "";
			$this->data["Demande"]["image2Prod"] = "";
			$this->data["Demande"]["image3Prod"] = "";
			//on sauvegarde l'Demande
			if (isset($_SESSION['Auth']['User']['id']) ) $this->data["Demande"]["user_id"] = $_SESSION['Auth']['User']['id'];
			else $this->data["Demande"]["user_id"] = null ;
			$this->Demande->save($this->data);
			//on recupere l'identifiant de l'Demande ajouté si nouvelle Demande
			//if ($id_Demande==null)
			$id_Demande =  $id;
			//ensuite on enregistre les images
			if(!empty($this->data["Demande"]["image"]["name"])){
				$image1 = "1";
				move_uploaded_file($this->data["Demande"]["image"]["tmp_name"],"uploads/trash/".$this->data["Demande"]["image"]["name"]);
				$as_saveFull = $this->Img->creerMin("uploads/trash/".$this->data["Demande"]["image"]["name"],"uploads/Demandes/".$id_Demande."/full/",$image1,300,200,false);
				$as_saveMin = $this->Img->creerMin("uploads/trash/".$this->data["Demande"]["image"]["name"],"uploads/Demandes/".$id_Demande."/min/",$image1,80,67,true);
				if ($as_saveFull == false and $as_saveMin ==  false)
					$image1 = "";
				else
					$image1 = "1.jpg";
			}
			if(!empty($this->data["Demande"]["image2Prod"]["name"])){
				$image2 = "2";
				move_uploaded_file($this->data["Demande"]["image2Prod"]["tmp_name"],"uploads/trash/".$this->data["Demande"]["image2Prod"]["name"]);
				$as_saveFull = $this->Img->creerMin("uploads/trash/".$this->data["Demande"]["image2Prod"]["name"],"uploads/Demandes/".$id_Demande."/full/",$image2,300,200,false);
				$as_saveMin = $this->Img->creerMin("uploads/trash/".$this->data["Demande"]["image2Prod"]["name"],"uploads/Demandes/".$id_Demande."/min/",$image2,80,67,true);
				if ($as_saveFull == false and $as_saveMin ==  false)
					$image2 = "";
				else
					$image2 = "2.jpg";
			}
			if(!empty($this->data["Demande"]["image3Prod"]["name"])){
				$image3 = "3";
				move_uploaded_file($this->data["Demande"]["image3Prod"]["tmp_name"],"uploads/trash/".$this->data["Demande"]["image3Prod"]["name"]);
				$as_saveFull = $this->Img->creerMin("uploads/trash/".$this->data["Demande"]["image3Prod"]["name"],"uploads/Demandes/".$id_Demande."/full/",$image3,300,200,false);
				$as_saveMin = $this->Img->creerMin("uploads/trash/".$this->data["Demande"]["image3Prod"]["name"],"uploads/Demandes/".$id_Demande."/min/",$image3,80,67,true);
				if ($as_saveFull == false and $as_saveMin ==  false)
					$image3 = "";
				else
					$image3 = "3.jpg";
			}
			//on met a jour les informations de l'Demandes
			$this->data["Demande"]["image"] = $id ;
			//$this->data["Demande"]["img1"] = "";
			//$this->data["Demande"]["img2"] = "";
			//$this->data["Demande"]["img3"] = "";
			// $this->Demande->save($this->data);
		
			
			if ($this->Demande->save($this->data['Demande'])) {
			  $this->Session->setFlash("Le Demande a été mise à jour.");
			  $this->redirect(array('controller'=>'Demandes', 'action'=>'mesDemandes')); 
			}
		 }
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
		
	function _reset_search_data ($id_page){
		if( empty( $this->data ) ){  
			$this->data  = unserialize( $this->Session->read('Lquery') ) ;
			if (!empty ($this->data['Demande']['submit_search']) && $this->data['Demande']['submit_search'] == $id_page ) {
				$this->data['Demande']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['Demande']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailDemandeAjoute($demande_id) {
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Demande->findById($demande_id)  ;
		$this->set('Demande', $q );
		$this->Email->reset() ;
		$this->Email->to = $this->Session->read('Auth.Member.email') ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Réf article : '.$demande_id.' - Votre annonce a été enregistrée' ;
		$this->Email->from = 'Services 4 All <ne-pas-repondre@services4all.ma>';
		$this->Email->template = 'Demandes/information_client_ajout'; // note no '.ctp'
			  //Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
			  //Set view variables as normal
			  //Do not pass any args to send()
		$this->Email->send();
	}
	function _sendMailAdminDemandeAjoute($demande_id) {
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->Demande->findById($demande_id)  ;
		$this->set('Demande', $q );
		$this->Email->reset() ;
		$this->Email->to = $site_contact ;
		$this->Email->subject = '[Services 4 All] Nouvelle demande service ajoutée sur le site : '.$demande_id;
		$this->Email->from = 'Services 4 All <ne-pas-repondre@services4all.ma>';
		$this->Email->template = 'demandes/information_admin_ajout'; // note no '.ctp'
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
	$chemin = './uploads/demandes/';
	
	
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