<?php
class PersonnesController extends AppController{
    var $name ="Personnes";
    var $components = array("Img",'Email');
	var $helpers = array("Session",'Cksource') ;
	var $paginate = array(
							'limit' => 20,
							'recursive'=>1,
							'fields'=>"Personne.id,Personne.created,Personne.deleted,Personne.nom,Personne.slug,Personne.prix,Personne.image,Personne.descpersonne,Dcategory.slug, Dcategory.nom" ,
							'order' => "Personne.id desc" 
		);
	
	function beforeFilter() {
		parent::beforeFilter();
	    if(isset($this->params['prefix']) && ( $this->params['prefix'] == 'admin' || $this->params['prefix'] == 'mod' ) ){
			$this->paginate['fields'] ="Personne.id,Personne.created,Personne.deleted,Personne.nom,Personne.slug,Personne.prix,Personne.image,Personne.descpersonne,Dcategory.slug, Dcategory.nom" ;
			$this->paginate['order']  = "Personne.id desc" ;
		}else if( isset($this->params['prefix']) &&  $this->params['prefix'] == 'member'  ){
			$this->paginate['fields'] ="Personne.id,Personne.created,Personne.deleted,Personne.nom,Personne.slug,Personne.prix,Personne.image,Personne.descpersonne,Dgategory.slug, Dcategory.nom" ;
			$this->paginate['order']  = "Personne.id desc" ;
		}
	} 
	
	
//-----------------------------------------------------  internes   -------------------------------------------------------		
	function getAttrsList(){
		$return = array() ;
		$return['categories'] = $this->personne->Dgategory->find('list',array('order'=>'Dgategory.nom asc'));  		
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
		$search_categories = $this->personne->Dcategory->find('all',array('fields'=>array('id','nom'),'conditions'=>'Dcategory.deleted = 0','order'=>'Dcategory.nom asc','recursive'=>-1));  
						
		$Personnes['Nouveaux']  = $this->personne->find('all',array(
														'fields'=>"Personne.id,Personne.nom,Personne.slug,Personne.prix,Personne.image,Personne.descpersonne,Dtype.nom, Dtype.slug" ,
														'conditions'=>array('Personne.deleted=0 and Personne.statut = 1') ,//personne non supprimés, validé et avec tag Home Page
														'recursive'=>1,
														'order'=>'Personne.created desc',
														'limit'=> 20
														)
												) ;
		
	    $this->set('Personnes', $Personnes) ;  
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
            $Personnes = $this->personne->find('all',array(
			"conditions" => "Personne.deleted = 0 and Personne.statut = 1 ",//personne non supprimé et validé
			'limit' => 20,
				"order" => "Personne.created desc"
			));
            $this->set('Personnes',$Personnes);
    }
	
	
	
	function search(){
		if ($_SERVER['REQUEST_URI'] != "/search.html"){
			$this->set('meta_robots' ,"NOINDEX,FOLLOW");
			$this->set('meta_canonical_url', "/search.html");
		} 
			
		$this->paginate['order'] = "Personne.created desc" ;
		$this->paginate['recursive'] = 1 ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		
		$this->_reset_search_data ('search');
		//$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('page_title', 'Services4all ~  Divers services pour tous ~ services pour les entreprises, pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport');
		$this->set('page_description',"Vous avez un besoin? vous recherchez des clients? Services4all vous propose des divers services, services pour les entreprises, services pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport..");
		$this->set('page_keywords',"Services4all, services divers, services entreprises, services particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport");
	}
	
	
	function Personnes_personnalisables (){
		$this->paginate['order'] = "Personne.created desc" ;
		$this->paginate['recursive'] = 1 ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.is_personalizable"] =  1 ; 
		
		
		$this->_reset_search_data ('search');
		$this->set('Personnes', $this->paginate('personne')) ;   
		$this->set('page_title', 'Services4all ~  Divers services pour tous ~ services pour les entreprises, pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport');
		$this->set('page_description',"Vous avez un besoin? vous recherchez des clients? Services4all vous propose des divers services, services pour les entreprises, services pour les particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport..");
		$this->set('page_keywords',"Services4all, services divers, services entreprises, services particuliers, services sociaux, coaching et conseils, soins et beauté, informatiques, fêtes, transport");
		$this->render ('search');
	}
	
	
	
	function _affiner_recherche (){
		$this->paginate['limit'] = 20;
	    $this->paginate['order'] = 'Personne.created desc';
	    $this->paginate['conditions']["Personne.deleted"] =  0 ;
		$query = "";
	    if( !empty($this->data) ) {
	        if (!empty ($this->data['personne']['query'])){
	            $query = $this->data['personne']['query'] ;
	            $this->paginate['conditions']["and"] = array(
	                                                    'or'=>array(
	                                                        "Personne.nom like '%$query%'",
	                                                        "Personne.refpersonneClient like '%$query%'",
	                                                        "Personne.descpersonne like '%$query%'",
	                                                        // "Personne.id = '$query'",
	                                                        ));
	            }
	    }
	    $q = $this->paginate('personne') ;
	    $categories = $this->personne->Dgategory->find('list',array('conditions'=>'Dgategory.deleted = 0',
	                                                        'order'=>'Dgategory.nom asc'));
	                                                          
	    $this->set('categories',$categories);
	    $this->set('Personnes', $q ) ;
	
	}
	
	
	
	function search2(){
		$this->paginate['recursive'] = 1 ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ;
		
		//search de la home page est particulier : submit_search_home
		$id_page = "search2";
		if( empty($this->data) && $this->Session->check('Lquery')  ) $this->data = $this->Session->read('Lquery') ;		
		if( empty( $this->data ) ){  
			$this->data  = unserialize( $this->Session->read('Lquery') ) ;
			if (!empty ($this->data['personne']['submit_search']) && $this->data['personne']['submit_search'] == $id_page ) {
				$this->data['personne']['submit_search'] = $id_page ;
			}else{
				//$this->data  = array();
				if (isset($this->data['personne']['submit_search']))
					$this->data['personne']['submit_search'] = $id_page ;
			}		
		}
		
		if(!empty($this->data['personne']['q'] ) ) {
			$this->set('balise_h1', "Résultat de recherche : " . $this->data['personne']['q'] );
			$this->set('page_title', "Résultat de recherche : " . $this->data['personne']['q'] );
			$this->paginate['conditions']['or']["Personne.id like "] = $this->data['personne']['q'] ; 
			$this->paginate['conditions']['or']["Personne.refpersonneClient like"] = $this->data['personne']['q'] ; 
			$this->paginate['conditions']['or']["Dcategory.nom like"] = $this->data['personne']['q'] ; 
			$this->paginate['conditions']['or']["Dcategory.nom like"] = '%'.$this->data['personne']['q'].'%' ; 
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
		    $q = $this->personne->find('all',array(
				"conditions" => "Personne.deleted = 0",
				'recursive'=>1,
				'limit' => 20,
				'fields'=>$this->paginate['fields'] ,
				"order" => "Personne.created desc"
			));
            $this->set('Personnes',$q);
            $this->render("index");
    }    
		
	function selections(){
		if( ! empty( $this->data ) )  $this->Session->write('Lquery', serialize( $this->data ) ) ; 
			else  $this->data  = unserialize( $this->Session->read('Lquery') ) ;
		
		$q = $this->personne->find('all',array(
			'fields'=>$this->paginate['fields'] ,
			"conditions" => "Personne.deleted = 0 and Personne.statut = 1",//Personnes non supprimés et validé
			'recursive'=>1,
			'limit' => 20,
			"order" => "Personne.id desc"
		));
		$this->set('Personnes',$this->_set_varietes_Personnes ($q));
		$this->set('search','nouveautes');
		$this->render("index");
	}    
		
	function selections_accueil(){
		$q = $this->personne->find('all',array(
			'fields'=>$this->paginate['fields'] ,
			"conditions" => "Personne.deleted = 0 and Personne.statut = 1 ",
			'recursive'=>1,
			'limit' => 20,
			"order" => "Personne.id desc"
		));
		$this->set('Personnes',$q);
		$this->render("index");
	}    
		
	/*function baffaires(){
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.tag_bonplan"] = 1;//articles qui sont tagé bon plan
		$this->_reset_search_data ('baffaires');
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1','Bonnes affaires vêtements enfant');
		$this->set('page_title', 'Bonnes affaires de vêtements enfant de grandes marques pour femme, homme et bébé  sur  Services4all.com');// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des bonnes affaires de Vêtements femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout");
		$this->set('page_keywords',"bonnes affaires, été 2012, vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("baffaires");
			 
    }*/
	
	/*function proposition (){
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.tag_selection"] = 1;//articles qui sont tagé bon plan
		$this->_reset_search_data ('proposition');
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1',"Idées de cadeaux pour enfant pour l'année 2012");
		$this->set('page_title', 'Idées de cadeaux et bonnes affaires de vêtements enfant de grandes marques pour femme, homme et bébé  sur  Services4all.com');// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des bonnes affaires de Vêtements femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout");
		$this->set('page_keywords',"cadeau enfant, bonnes affaires, hiver 2012, vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("baffaires");

	
	}*/
	
	/*function bonsplan($type_slug= NULL) {
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.tag_bonplan"] = 1;//articles qui sont tagé bon plan
		$this->_reset_search_data ('bonsplan'.$type_slug);
		$type_nom = "";
		$categorie_nom = "";
		if($type_slug != NULL){
			$type = $this->personne->Type->find('first',array('fields'=>array('Type.id','Type.category_id','Type.nom','Category.title'),'conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['personne']['type_id'])){
				$this->data['personne']['type_id']= $type['Type']['id'];
				$this->data['personne']['type_id_list']= $type['Type']['id'];
			}
			if (empty ($this->data['personne']['category_id'])){
				$this->data['personne']['category_id']= $type['Type']['category_id'];
				$this->data['personne']['category_id_list']= $type['Type']['category_id'];
			}
			$type_nom = strtolower($type['Type']['nom']);
			$categorie_nom = strtolower( $type['Category']['title']);
			//$this->paginate['conditions']["Type.slug"] =  $type_slug ; //
		}
		
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1',"Bonnes affaires $type_nom enfant");
		$this->set('page_title', "Bonnes affaires de $type_nom enfant de grandes marques pour femme, homme et bébé  sur  Services4all.com");// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des bonnes affaires de $categorie_nom ($type_nom) pour femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout");
		$this->set('page_keywords',"bonnes affaires,$type_nom,$categorie_nom,  hiver 2012, vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("baffaires");
	}*/
	
	/*function baffaires_marque($slug_m) {
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; 
		$this->paginate['conditions']["Personne.tag_bonplan"] = 1;
		$this->_reset_search_data ('baffaires_marque'.$slug_m);
		$nom_marque = "";
		if (empty ($this->data['personne']['marque_id'])){
			$this->loadModel ('Marque');
			$marque = $this->Marque->find ('first',array('conditions'=>"Marque.slug = '$slug_m'"));
			$nom_marque	= $marque['Marque']['nom']; 
			$this->data['personne']['marque_id'] = $marque['Marque']['id'];
			$this->data['personne']['marque_id_list'] = $marque['Marque']['id'];
			$this->set ('balise_h1',"Bonnes affaires pour enfant de marque  " . $nom_marque );
			$this->set ('page_title',"Bonnes affaires vêtements " . $nom_marque . " enfant | Services4all");
			$this->set ('page_description',"Nous vous proposons des bonnes affaires de vêtements, accessoires et chaussures de marque " . $nom_marque. " pour enfant sur Services4all vendus par des Professionnels ou particuliers...");
			$this->set('page_keywords',"bonnes affaires, ". strtolower($nom_marque) ."  , vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 		
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		//bonnes-affaires-vetement-petit-bateau-enfant.html
		$this->set('search','baffaires_marque');
		$this->render("search");
	}*/
	
	
	/*function soldes($annee=2013){
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.prixSolde >"] = 1;//articles qui sont soldé
		$this->paginate['conditions']["and"] =array( " (Personne.prixSolde / Personne.prix )  > 0.4 ") ;//articles qui sont soldé
		$this->_reset_search_data ('soldes'.$annee);
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$this->set('search','baffaires');
		$this->set('balise_h1','Nos articles de vêtements, chaussures et accessoires enfant soldés');
		$this->set('page_title', 'Solde vêtements, chassures et accessoires marque mode enfant '.$annee);// 'Vente vêtement marque enfant – Vêtement enfant – Mode enfant' ;
		$this->set('page_description',"Retrouvez des nos articles soldés de vêtements femme, homme et bébé de Grandes Marques :  IKKS, Petit Bateau, Kenzo, Catimini, Levis, Timberland, Chipie ... Tout les articles soldés : opération ".$annee);
		$this->set('page_keywords',"soldes, bonnes affaires, solde ".$annee . ", vêtement, enfant, marque, mode, femme, homme, bébé, déstockage, vêtements, kids, dressing, boutique, en ligne");
		$this->render("soldes");
			 
    }*/
	
	
	
	/*function categorie_decoration($categorie_slug = NULL) {
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->_reset_search_data ('categorie_decoration' .$categorie_slug);
		
		
		if($categorie_slug != NULL)  {
			$categorie = $this->personne->Type->Category->find('first',array('fields'=>array('id','title'),'conditions'=>array('Category.slug'=>$categorie_slug) )) ; 
			//echo print_r( $categorie);
			$this->data['personne']['category_id'] = $categorie['Category']['id'];
			$this->paginate['conditions']["Category.slug"] = $this->data['Category']['slug'] ; 
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne')) ) ;
		$this->set('page_title', 'Déco chambre - Services4all');
		$this->set('balise_h1', 'Déco chambre');
		$this->render('categorie');
	}*/
	
	//famille de personne 
	/*function famille_Personnes ($famille_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		
		$this->_reset_search_data ('famille_Personnes'. $famille_slug);
		
		if($famille_slug != NULL)  {
			$pfamille = $this->personne->Type->Pfamille->find('first',array('fields'=>array('id','titre','meta_description','meta_keywords'),'conditions'=>array('Pfamille.slug'=>$famille_slug) )) ; 
			//echo print_r( $categorie);
			$types = $this->personne->Type->find ('all', array('conditions'=>"Type.pfamille_id = " . $pfamille ['Pfamille']['id'] ));
			$var_types = array();
				foreach ($types as $t)
					$var_types  [] = $t['Type']['id'];
			
			$this->data['personne']['type_id'] = $var_types ;
			$this->paginate['conditions']["Personne.type_id"] = $var_types  ;
			$this->set('page_description', $pfamille['Pfamille']['meta_keywords']);
			$this->set('page_keywords', $pfamille['Pfamille']['titre']);
			$this->set('page_title', $pfamille['Pfamille']['titre']. ' - Services4all');
			$this->set('balise_h1', $pfamille['Pfamille']['titre']);
		}
		$this->_affiner_recherche ();	
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne')) ) ;
			
		
		$this->render('search');
	
	}*/
	
	/* a refaire */
	/* function type($type_slug = NULL, $sexe_slug = NULL, $couleur_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->_reset_search_data ('type'.$type_slug . $sexe_slug . $couleur_slug );	
		
		$type_nom = "";
		$categorie_nom = "";
		if($type_slug != NULL){
			$type = $this->personne->Type->find('first',array('conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['personne']['type_id'])){
				$this->data['personne']['type_id']= $type['Type']['id'];
				$this->data['personne']['type_id_list']= $type['Type']['id'];
			}
			if (empty ($this->data['personne']['category_id'])){
				$this->data['personne']['category_id']= $type['Type']['category_id'];
				$this->data['personne']['category_id_list']= $type['Type']['category_id'];
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
					$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Personnes = array();
					foreach ($Personnes as $p)
						$var_Personnes  [] = $p['Variete']['personne_id'];
					$this->data['personne']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Personne.id"] = $var_Personnes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
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
			$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "couleur_id"=> $couleur['Couleur']['id'])));
			$var_Personnes = array();
			foreach ($Personnes as $p)
				$var_Personnes  [] = $p['Variete']['personne_id'];
			if ( empty($this->data['personne']['couleur_id_list'])){
				$this->data['personne']['couleur_id_list'] = $couleur['Couleur']['id'];
				$this->data['personne']['couleur_id'] = $couleur['Couleur']['id'];
			}
			$this->paginate['conditions']["Personne.id"] = $var_Personnes;
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne')) ) ;	

		
		$balise_h1 =  $type_nom . ' ' . strtolower($sexe_nom) .' '. strtolower($nom_couleur) ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all');
		$this->set('page_description', "Acheter un " .strtolower($type_nom) . " " .strtolower($nom_couleur) . "  d'occasion ou neuf pas cher sur KidsDressing pour $sexe_nom. Site officiel de cette marque de vêtements, chaussures et accessoires pour enfants, permettant de commander en ligne ses différents Personnes.");
		$this->set('page_keywords', "$type_nom," .strtolower($nom_couleur) . " , $sexe_nom,$categorie_nom, marque, enfant , pas cher");
		$this->render('search');	
    } */
	
	
	/* function collection($collection_slug = NULL,$type_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		//$this->_reset_search_data ('type'.$type_slug . $sexe_slug . $couleur_slug );	
		
		$type_nom = "";
		$categorie_nom = "";
		if($type_slug != NULL){
			$type = $this->personne->Type->find('first',array('conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['personne']['type_id'])){
				$this->data['personne']['type_id']= $type['Type']['id'];
				$this->data['personne']['type_id_list']= $type['Type']['id'];
			}
			if (empty ($this->data['personne']['category_id'])){
				$this->data['personne']['category_id']= $type['Type']['category_id'];
				$this->data['personne']['category_id_list']= $type['Type']['category_id'];
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
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
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
			$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "couleur_id"=> $couleur['Couleur']['id'])));
			$var_Personnes = array();
			foreach ($Personnes as $p)
				$var_Personnes  [] = $p['Variete']['personne_id'];
			if ( empty($this->data['personne']['couleur_id_list'])){
				$this->data['personne']['couleur_id_list'] = $couleur['Couleur']['id'];
				$this->data['personne']['couleur_id'] = $couleur['Couleur']['id'];
			}
			$this->paginate['conditions']["Personne.id"] = $var_Personnes;
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne')) ) ; 	

		
		$balise_h1 =  $type_nom . ' ' . strtolower($sexe_nom) .' '. strtolower($nom_couleur) ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . '- Services4all &amp; CO');
		$this->set('page_description', "Acheter un " .strtolower($type_nom) . " " .strtolower($nom_couleur) . "  bijoux pour $sexe_nom. Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
		$this->set('page_keywords', "$type_nom," .strtolower($nom_couleur) . " , $sexe_nom,$categorie_nom, marque, bijoux , pas cher");
		$this->render('search');	
    } */
	
	/*function collection($collection_slug = NULL, $type_slug = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		//$this->paginate['conditions']["Personne.stock"] >=  1 ; 
		$this->_reset_search_data('collection'.$collection_slug);	
		
		$collection_nom = "";
		if($collection_slug != NULL){
			$collection = $this->personne->Collection->find('first',array('conditions'=>array('Collection.slug'=>$collection_slug) )) ; 
			
			$collection_nom = $collection['Collection']['nom'];
			$collection_id =  $collection['Collection']['id'] ; //
			$this->paginate['joins'] = array( 
													array( 
														'table' => 'collections_Personnes', 
														'alias' => 'Collectionspersonne', 
														'type' => 'INNER',  
														'conditions'=>"CollectionsPersonne.personne_id = Personne.id AND CollectionsPersonne.collection_id= $collection_id "
													),
												) ;
		}	 
		 
		//$this->_affiner_recherche ();
		//$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->paginate('personne') ) ;	

		
		$balise_h1 =  $collection_nom ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all &amp; CO');
		$this->set('page_description', "Acheter un " .strtolower($collection_nom) . " . Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
		$this->set('page_keywords', "".strtolower($collection_nom) ." - bijoux , pas cher");
		$this->render('search');	
    }*/
	/*function special() {
			// pas encore fini => a refaire il faux ajouter un fichier index avec un champ special pour les evenements 
			//Liste des Personnes bijoux special Saint-valentin
			$this->paginate['recursive'] = 1 ; 
			$this->paginate['conditions']["Personne.deleted"] =  0 ; 
			$this->paginate['conditions']["Personne.statut"] =  1 ; 
			
			$this->loadModel ("Evenementspersonne");			
			$Personnes = $this->Evenementspersonne->find ("all", array('fields'=>"personne_id", 'conditions'=>array('evenement_id'=>55))) ;	 //Saint-valentin
			$pdtevents = array();
				foreach ($Personnes as $p)
					$pdtevents [] = $p['Evenementspersonne']['personne_id'];
								
			$this->paginate['conditions']["Personne.id"] = $pdtevents  ;
			
			$this->set('balise_h1', "Bijoux spécial Saint-Valentin");
			$this->set('page_title',"Bijoux spécial Saint-Valentin- Services4all &amp; CO");
			$this->set('page_description', "Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
			$this->set('page_keywords', "Bijoux spécial Saint-Valentin , pas cher");
            $this->render('search');
	} 
	
	function promotions() {
			$this->paginate['order'] = "Personne.id desc" ;
			$this->paginate['conditions']["Personne.deleted"] =  0 ; 
			$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
			$this->paginate['conditions']["Personne.prixSolde >"] = 1;//articles qui sont soldé
			$this->paginate['conditions']["and"] =array( " (Personne.prixSolde / Personne.prix )  > 0.4 ") ;//articles qui sont soldé
			
			$this->set('Personnes',$this->paginate('personne') ) ;
            $this->set('balise_h1', "Bijoux en promotion");
			$this->set('page_title',"Bijoux en promotion - Services4all &amp; CO");
			$this->set('page_description', "Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
			$this->set('page_keywords', "Bijoux en promotion, pas cher");
			
            $this->render('search');
	} */
	
	/*function taille($category_slug = NULL, $sexe_slug = NULL, $taille_id = NULL){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		
		$this->_reset_search_data ('taille' . $category_slug . $sexe_slug . $taille_id);
		
		
		
		$type_nom = "";
		$categorie_nom = "";
		if($category_slug != NULL){
			$categorie = $this->personne->Category->find('first',array('conditions'=>array('Category.slug'=>$category_slug) )) ; 
			if ( empty($this->data['personne']['category_id'])){
				$this->data['personne']['category_id']= $categorie['Category']['id'];
				$this->data['personne']['category_id_list']= $categorie['Category']['id'];
			}
			$categorie_nom = $categorie['Category']['title'];
			$this->paginate['conditions']["Personne.category_id"] =  $categorie['Category']['id'] ; //
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
					$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Personnes = array();
					foreach ($Personnes as $p)
						$var_Personnes  [] = $p['Variete']['personne_id'];
					$this->data['personne']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Personne.id"] = $var_Personnes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->data['personne']['sexe_id_list'] = $sexe['Sexe']['id'];
					break;
				case "femme" :
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->data['personne']['sexe_id_list'] = $sexe['Sexe']['id'];					
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
			$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "taille_id"=> $taille_id)));
			$var_Personnes = array();
			foreach ($Personnes as $p)
				$var_Personnes  [] = $p['Variete']['personne_id'];
			if ( empty($this->data['personne']['taille_id_list'])){
				$this->data['personne']['taille_id_list'] = $taille_id;
				$this->data['personne']['taille_id'] = $taille_id;
			}
			$this->paginate['conditions']["Personne.id"] = $var_Personnes;
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne') )) ;	

		
		$balise_h1 =  $categorie_nom  . ' ' . strtolower($sexe_nom) . ' de taille ' . $nom_taille ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all');
		$this->set('page_description', "Acheter un " .strtolower($type_nom) . " " .strtolower($nom_taille) . "  d'occasion ou neuf pas cher sur KidsDressing pour $sexe_nom. Site officiel de cette marque de vêtements, chaussures et accessoires pour enfants, permettant de commander en ligne ses différents Personnes.");
		$this->set('page_keywords', "$type_nom," .strtolower($nom_taille) . " , $sexe_nom,$categorie_nom, marque, enfant , pas cher");
		$this->render('search');	
    }
	*/
	
	
	function type($type_slug ){
		$this->paginate['recursive'] = 1 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés		
		
		$type_nom = "";
		if($type_slug != NULL){
			$type = $this->personne->Type->find('first',array('conditions'=>array('Type.slug'=>$type_slug) )) ; 
			if ( empty($this->data['personne']['type_id'])){
				$this->data['personne']['type_id']= $type['Type']['id'];
				$this->data['personne']['type_id']= $type['Type']['id'];
			}
			$type_nom = $type['Type']['nom'];
			$this->paginate['conditions']["Personne.type_id"] =  $type['Type']['id'] ; //
		}	
		//$this->_affiner_recherche ();
		//$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->paginate('personne') ) ;	

		
		$balise_h1 =  $type_nom  ;
		$this->set('balise_h1', $balise_h1);
		$this->set('page_title', $balise_h1 . ' - Services4all &amp; CO');
		$this->set('page_description', "Acheter un $type_nom  Services4all &amp; Co - Bijoux argent 925 - cuir ou pierres naturelles - bague, bracelet, collier, boucles - Paris  - Services4all &amp; CO");
		$this->set('page_keywords', "$type_nom, marque, bijoux , pas cher");
		$this->render('search');	
    }
	
	
	
	//liste des nouveautes
	function nouveautes($sexe_slug=NULL){
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1;
		$this->paginate['conditions']["Personne.tag_nouveaute"] =  1;
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
					$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Personnes = array();
					foreach ($Personnes as $p)
						$var_Personnes  [] = $p['Variete']['personne_id'];
					$this->data['personne']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Personne.id"] = $var_Personnes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 					
					$sexe_nom = "femme";
					break;
				
			}
			
			
		}
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne')) ) ;	
		
		$this->set('search','nouveautes');
		$this->set('page_title', 'Les nouveautés Services4all ' .  strtolower ($sexe_nom) . ' - Services4all');
		$this->set('balise_h1', 'Les nouveautés Services4all ' .  strtolower ($sexe_nom) );
		$this->set('page_description',"Sélection de nouveauté de Bijoux " .  strtolower ($sexe_nom) . " de marque pas cher sur Services4all.");
		$this->set('page_keywords',"nouveaute, vetement," .  strtolower ($sexe_nom) . ",marque, femme, homme, enfant");
		$this->render("nouveautes");			
    }    
	
	function nouveautes_decoration ($sexe_slug=NULL){
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1;
		$this->paginate['conditions']["Personne.tag_nouveaute"] =  1;
		
		$this->_reset_search_data ('nouveautes_decoration'.$sexe_slug);
		if ( empty($this->data['personne']['category_id'])){
			$categorie = $this->personne->Category->find('first',array('conditions'=>array('Category.slug'=>'decoration') )) ; 
			$this->data['personne']['category_id']= $categorie['Category']['id'];
			$this->data['personne']['category_id_list']= $categorie['Category']['id'];
			$categorie_nom = $categorie['Category']['title'];
			$this->set('categorie_nom','categorie_nom');
			$this->paginate['conditions']["Personne.category_id"] =  $categorie['Category']['id'] ;
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
					$Personnes = $this->Variete->find ("all", array('fields'=>"personne_id", "conditions"=>array("stock >"=>0, "taille_id"=>array(70, 18, 26, 27, 28, 29, 30, 31, 32, 33, 34, 1, 2, 3, 4,5, 6,73))));
					$var_Personnes = array();
					foreach ($Personnes as $p)
						$var_Personnes  [] = $p['Variete']['personne_id'];
					$this->data['personne']['taille_id_list'] = "70,18,26,27,28,29,30,31,32,33,34,1,2,3,4,5,6,73";
					$this->paginate['conditions']["Personne.id"] = $var_Personnes;
					break;
				case "homme" :
					$sexe_nom = "homme";
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),
												'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 
					break;
				case "femme" :
					$sexe = $this->personne->Sexe->find('first',array('fields'=>array('id','nom'),'conditions'=>array('Sexe.slug'=>$sexe_slug) )) ; 
					$this->data['personne']['sexe_id'] = $sexe['Sexe']['id'];
					$this->paginate['conditions']["Sexe.slug"] = $sexe_slug; 					
					$sexe_nom = "femme";
					break;				
			}			
		}
		
		$this->_affiner_recherche ();	
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne')) ) ;
		
		
		$this->set('search','nouveautes');
		$this->set('page_title', 'Les nouveautés décoration ' .  strtolower ($sexe_nom) . ' - Services4all');
		$this->set('balise_h1', 'Les nouveautés décoration ' .  strtolower ($sexe_nom) );
		$this->set('page_description',"Sélection de nouveauté de décoration " .  strtolower ($sexe_nom) . " de marque pas cher sur kidsdressing.");
		$this->set('page_keywords',"nouveaute, decoration chambre," .  strtolower ($sexe_nom) . ", enfant, marque, mode, femme, homme, bébé");
		$this->render("nouveautes");			
 	}
		
	
	function marque($marque_slug,$category_slug= NULL){
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ;
		$selection_modifiee = false;
		$this->_reset_search_data ('marque'.$marque_slug.$category_slug);
		
		$nom_marque = "";
		
		if (empty ($this->data['personne']['marque_id'])){		
			$marque= $this->personne->Marque->find('first',array('conditions'=>array('Marque.slug'=>$marque_slug) ) ) ;			
			$this->data['personne']['marque_id'] = $marque_id = $marque['Marque']['id'] ;
			$this->data['personne']["marque_id_list"] =  $marque_id ;
			//$this->paginate['conditions']["Personne.marque_id"] =  $marque_id ;
			$this->set('search','marques');
			$this->set('marque',$marque) ; 
			
		}else{
			$selection_modifiee = true;
		}
		
		
		if (empty ($this->data['personne']['category_id'])){	
			if($category_slug != NULL)  {
				$categorie = $this->personne->Type->Category->find('first',array('fields'=>array('id','title'),'conditions'=>array('Category.slug'=>$category_slug) )) ; 
				//echo print_r( $categorie);
				$this->data['personne']['category_id'] = $categorie['Category']['id'];
				$this->data['personne']['category_id_list'] = $categorie['Category']['id'];
				//$this->paginate['conditions']["Personne.category_id"] = $categorie['Category']['id'] ; 
				$this->set('categorie', $categorie ) ;
			}
		}
		
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes',$this->_set_varietes_Personnes ($this->paginate('personne') )) ;
		$this->data['page'] = 'marque';
		if ($selection_modifiee)
			$this->render('search');
		else
			$this->render('marque');
	}
		
	
	function professionnel($member_id){
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.personneur_id"] = $member_id;//Personnes qui sont tagés bon plan
		$this->_reset_search_data ('professionnel'.$member_id);
		$this->_affiner_recherche ();
		$this->Session->write('Lquery', serialize( $this->data ) ) ; 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$member = $this->personne->personneur->findById($member_id);
		if ($member){
			$this->set('balise_h1',$member['personneur']['pseudo'].' : Createur des services professionnels');
			$this->set('page_title',$member['personneur']['pseudo'].' : Createur des services | Professionnel ' . $member['personneur']['id']);
			$this->set('page_description',"Lancer vos services professionnels sur Services4all. ". $member['personneur']['pseudo'].'Fiche personneur . '. $member['personneur']['id']);
			$this->set('page_keywords',$member['personneur']['pseudo']."Client, Entreprise, personneur, professionnels,services en ligne");
			$this->set('member',$member);			
		}
		$this->render("professionnel");			 
    }
	
		
	
	function getpersonneClient($id){ //retourner les Personnes d'un createur services
		$q = $this->personne->find('all',array(
				"conditions" => "Personne.deleted = 0 and Personne.id_client =$id ",
				'limit' => 20,
				'fields'=>$this->paginate['fields'] ,
				"order" => "Personne.id desc"
		));
		return $q;
	}  
		
	function getpersonneCategory($id){ //retourner les catégories des Personnes d'un createur services
		$q = $this->personne->find('all',array(
			"conditions" => "Personne.deleted = 0 and Personne.category_id =$id ",
			'limit' => 20,
			'fields'=>$this->paginate['fields'] ,
			"order" => "Personne.created desc"
		));
		return $q;
	}  
		 
	/*function view($id){
			$this->personne->recursive=1;
			$q = $this->personne->findById ($id);

			//print_r($q) ;
			$prix  = $q['personne']['prix'];
			$categorie = $q['Dcategory']['nom'];
			$image =  $q['personne']['image'];
		
			$Personnes_simulaires = $this->personne->find('all',array(								
														'conditions'=>array('Personne.deleted'=>0,'Personne.statut'=>1,'Personne.id !='=>$id,
																			'Personne.category_id'=>$q['personne']['category_id'],
														'fields'=>"Personne.id,Personne.created,Personne.nom,Personne.slug,Personne.prix,Personne.prixGros,Personne.prixSolde,Personne.image,Type.id,Personne.descpersonne,Type.nom,Type.slug,Marque.nom,Marque.image,Marque.image_small,Marque.slug,Sexe.nom,Category.slug,Matiere.nom,Matiere.slug" ,
														'order'=>'Personne.created asc',
														'limit'=>4
														)
												);
			
			
			
			if ($q['personne']['deleted'] != 0){//si personne supprimer indiquer au moteur de recherche ne pas indexer la page
				$this->set('meta_robots','noindex, follow') ;
				$this->set('meta_canonical','/services/'.$q['Dcategory']['slug'] . '/' ) ;
			}
					
			$url_personne = "/services/".$q['Dcategory']['slug'] ."/$id-".$q['personne']['slug'] .".html";
			
			$q['personne']['titre_personne'] = "Service " . strtolower($q['Dcategory']['nom'])  . " : " . $q['personne']['nom'];

			$titre_personne = $q['Dcategory']['nom'] . " : " . $q['personne']['nom'];
			
			$page_title = $q['personne']['titre_personne']  ;
			
			$page_description = $q['personne']['mdescription']; 
			
			$page_keywords = $q['personne']['mkeywords']; 
		
			
			//print_r($Personnes_simulaires) ;
			
			
			$page_description .= "personne mise en ligne le ". date("d/m/Y H\hi",strtotime($q['personne']['created']))  ." - référence : ". $id.". ";
			//if ($q['personne']['description'] != "" )
			//	$page_description .= strip_tags ($q['personne']['description']  );
			
			
			$meta_og = '<meta property="og:description" content="' . $page_description  .'"/>
					<meta property="og:type" content="product" />
					<meta property="og:url" content="'.$url_personne . '" />
					<meta property="og:title" content="'. $page_title .'" />
					<meta property="og:image" content="/uploads/Personnes/' .$image . '" />
					<meta property="og:site_name" content="Services4all" />';
			
			
			// check if is in favoris 
			$favoris = $this->Cookie->read('Favoris') ;
			if( !empty( $favoris) && in_array(  $q['personne']['id'] , $favoris ) )  $q['personne']['in_favoris'] = true ; 
			else
				$q['personne']['in_favoris'] = false ; 
			
			
			$this->set('meta_og',$meta_og);
			$this->set('personne',$q);
			$this->set ('Personnes_simulaires',$Personnes_simulaires);
			$this->set('titre_personne',$titre_personne);
			$this->set('page_title',$page_title);
			$this->set('page_description',$page_description);
			$this->set('page_keywords',$page_keywords);
        }*/
	
 
 
	
	
	function save($personne_id) {
		//save annonce to favoris; 
		$q = $this->personne->findById($personne_id ) ;
		if( !empty($q) ) {
			$favoris = $this->Cookie->read('Favoris') ; 
			if(empty($favoris) )  $favoris = array() ;
			if(! in_array($personne_id, $favoris ) )
				  array_push($favoris, $personne_id ) ;
			$this->Cookie->write('Favoris', $favoris) ;
			$this->Session->setFlash("Cette personne a bien été sauvegardée dans \"<a href='/services-preferes.html' >Vos services préférés</a>\" . ",'default',array('class'=>'valid_box') ) ;
			$this->redirect("/Personnes/view/".$q['personne']['id'] ) ; 
		}else die("personne deleted") ;
	}
 	function deleteFromFavoris($personne_id) {
		$this->layout= $this->autoRender = false;
		//save annonce to favoris; 
		$q = $this->personne->findById($personne_id ) ;
		if( !empty($q) ) {
			$favoris = $this->Cookie->read('Favoris') ; 
			if(empty($favoris) )  $favoris = array() ;
			foreach($favoris as $k=>$v) {
				  if($v == $personne_id ) unset($favoris[$k] ) ; 
			}
			$this->Cookie->write('Favoris', $favoris) ;
			$this->Session->setFlash("La personne a bien été supprimée de \"<a href='/services-preferes.html' >Vos services préférés</a>\" . ",'default',array('class'=>'valid_box') ) ;
			$this->redirect( $this->referer() ) ; 
		}else die("Error") ;
	}
	
	function preferes(){
		$favoris = $this->Cookie->read('Favoris') ;
		if(!empty($favoris  ) ) {
			$favoris_str = implode($favoris,',') ; 
			$this->paginate['conditions']=array() ;
			$this->paginate['limit'] = 30 ;
			$new = "Personne.id IN (".$favoris_str.")" ;
			array_push($this->paginate['conditions'], $new) ; 
			$this->paginate['order'] = "FIND_IN_SET(Personne.id, '".$favoris_str."')";
			$this->set('Personnes',$this->paginate('personne') ) ;
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
		$favoris_str = $prefere['Prefere']['Personnes_list'] ;
		if(!empty( $favoris_str  ) ) {
			$this->paginate['conditions']=array() ;
			$this->paginate['limit'] = 30 ;
			$new = "Personne.id IN (".$favoris_str.")" ;
			array_push($this->paginate['conditions'], $new) ; 
			$this->paginate['order'] = "FIND_IN_SET(Personne.id, '".$favoris_str."')";
			$this->set('Personnes',$this->paginate('personne') ) ;
		}
		$this->set('prefere',$prefere ) ; 
	}
	
//---------------------------------------------------------- Member ----------------------------------------------------------	
	function member_rechercher() {
		$this->paginate['limit'] = 30;
		$this->paginate['order'] = 'Personne.id desc';
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		//$this->paginate['conditions']["Personne.statut"] =  1 ; 
		$this->paginate['conditions']["Personne.seller_id"] =  $this->Session->read('Auth.Member.id')  ; 
		if( !empty($this->data) ) {
			if (!empty ($this->data['personne']['query'])){
				$query = $this->data['personne']['query'] ;
				//echo $query;
				
				$this->paginate['conditions']["and"] = array(
															'or'=>array(
																"Type.nom like '%$query%'",
																"Sexe.nom like '%$query%'",
																"Personne.id = '$query'",
																"Personne.refpersonneClient ='$query'"
																));
			}
			if (!empty ($this->data['personne']['marque'])){	
				$marque = $this->data['personne']['marque'] ;
				$this->paginate['conditions']["Personne.marque_id"] =  $marque;
			}
		}
		$this->set('Personnes',$this->paginate('personne') ) ;
		$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->set('balise_h1',"Résultat de la recherche : " . $query);
		$this->set('page_title','Résultat de la recherche');
		$this->render('member_Personnes') ;
	}
	
	function member_afficher($id) {
		$q = $this->personne->findById($id);
				
		$this->loadModel('Variete'); 
		$varietes = $this->Variete->find('all',array(
				'fields'=>array('Variete.id','Variete.personne_id','Taille.nom','Couleur.nom','Variete.stock'),
				'conditions'=>array('Variete.personne_id'=>$id) ) ) ;
		$this->set('varietes',$varietes);
		
		
		$this->set('article',$q);
	}


















	function member_ajouter (){	//ajouter un personne
		
		if (! empty($this->data)){
			
			// ----- 
			// 
			if (!empty($this->data['personne']['cin']) && !empty($this->data['personne']['nom']) && !empty($this->data['personne']['prenom'])
				&& !empty($this->data['personne']['Date_naissance']) && !empty($this->data['personne']['Tel']) && !empty($this->data['personne']['Adresse'])
				&& !empty($this->data['personne']['grade'])&& !empty($this->data['personne']['civilite']))
			{
					//pr ($this->data);
					if( $this->personne->save($this->data) ){
						$cin= $this->personne->getLastInsertcin();
						//sauvegarder la variante du personne
						$variete = array();
						$variete ['Variete']['nom'] = $this->data['personne']['nom'];;
						$variete ['Variete']['prenom'] = $this->data['persone']['prenom'];
						$variete ['Variete']['tel'] = $this->data['persone']['tel'];
						$this->loadModel ('Variete');
						$this->Variete->save ($variete);
						
						
					}else{
						$this->Session->setFlash("Une erreur a été rencontrée lors de l'insertion de l'article.","default",array('class'=>'error_box'));
					}
				
				}else{
					$this->Session->setFlash("La photo principale de l'article est obligatoire.","default",array('class'=>'error_box'));	
	
				}
				
			}
		}
	
	







/*Pouur l ajout de conges

if (! empty($this->data)){
			
			// ----- 
			// 
			if (!empty($this->data['conges']['datedebu']) && !empty($this->data['conges']['datefin']) && !empty($this->data['conges']['id_tconges']))
			{
					//pr ($this->data);
					if( $this->conges->save($this->data) ){
						$cin= $this->personne->getLastInsertcin();
						//sauvegarder la variante du personne
						$variete = array();
						$variete ['Variete']['datedebu'] = $this->data['conges']['datedebu'];;
						$variete ['Variete']['datefin'] = $this->data['conges']['datefin'];
						$variete ['Variete']['id_tconges'] = $this->data['conges']['id_tconges'];
						$this->loadModel ('Variete');
						$this->Variete->save ($variete);
						
						
					}else{
						$this->Session->setFlash("Une erreur a été rencontrée lors de l'insertion de l'article.","default",array('class'=>'error_box'));
					}
				
				}else{
					$this->Session->setFlash("La photo principale de l'article est obligatoire.","default",array('class'=>'error_box'));	
	
				}
				
			}
 */



	
	//page simple d'ajout d'un article (réservé pour les particuliers)
	function member_part_ajouter() {
		$inserted = false;
		if (! empty($this->data)){
			
			if (!empty($this->data['personne']['sexe_id']) && !empty($this->data['personne']['type_id']) && !empty($this->data['personne']['etat_id']) 
				&& !empty($this->data['personne']['marque_id']) && !empty($this->data['personne']['matiere_id']) && !empty($this->data['personne']['prix']) 
				&& !empty($this->data['personne']['description']) && !empty($this->data['personne']['couleur_id']) && !empty($this->data['personne']['taille_id']) 
				&& !empty($this->data['personne']['stock'])){
				
				if (empty($this->data['personne']['prixSolde']) || $this->data['personne']['prixSolde'] == "")
					$this->data['personne']['prixSolde'] =0;
				
				//on vérifie que la photo principale a été renseigné
				if(!empty($this->data["personne"]["imagePre"]["name"])){
					$this->data["personne"]["image"] = "Indisponible.jpg ";
					$this->data["personne"]["image2Prod"] = "Indisponible.jpg ";
					$this->data["personne"]["image3Prod"] = "Indisponible.jpg ";
					$this->data["personne"]["image4Prod"] = "Indisponible.jpg ";
					
					$this->data["personne"]["seller_id"] = $this->Session->read('Auth.Member.id');
					//pr ($this->data);
					if( $this->personne->save($this->data) ){
						$personne_id = $this->personne->getLastInsertId();
						//sauvegarder la variante du personne
						$variete = array();
						$variete ['Variete']['personne_id'] = $personne_id ;
						$variete ['Variete']['couleur_id'] = $this->data['personne']['couleur_id'];
						$variete ['Variete']['taille_id'] = $this->data['personne']['taille_id'];
						$variete ['Variete']['stock'] = $this->data['personne']['stock'];
						$this->loadModel ('Variete');
						$this->Variete->save ($variete);
						
						//pour construire les noms des images des Personnes
						$q = $this->personne->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["personne"]["marque_id"])) ); 
						$marque = $q['Marque']['slug'];					
						$q = $this->personne->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["personne"]["sexe_id"]) )); 
						$sexe = $q['Sexe']['slug'];
						$q = $this->personne->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["personne"]["type_id"]) )); 
						$type = $q['Type']['slug'];
						$this->loadModel ('Couleur');
						$q = $this->Couleur->find('first',array('conditions'=>array("Couleur.id"=> $this->data["personne"]["couleur_id"])) ); 
						$couleur = $q['Couleur']['slug'];
						
						$strRetour = "";						
						$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($couleur != 'autre'? '-'.$couleur : '') ;
						$file1 = 'Indisponible.jpg';
						$file2 = 'Indisponible.jpg';
						$file3 = 'Indisponible.jpg';
						$file4 = 'Indisponible.jpg';
						//ensuite on enregistre les images
						if(!empty($this->data["personne"]["imagePre"]["name"])){
							$file1 = $personne_id ."-1-". $slug_image .".".$this->_extension($this->data["personne"]["imagePre"]["name"]);					
							move_uploaded_file($this->data["personne"]["imagePre"]["tmp_name"],"uploads/Personnes/".$file1);
						}
						if(!empty($this->data["personne"]["image2ProdPre"]["name"])){
							$file2 = $personne_id ."-2-". $slug_image .".".$this->_extension($this->data["personne"]["image2ProdPre"]["name"]);					
							move_uploaded_file($this->data["personne"]["image2ProdPre"]["tmp_name"],"uploads/Personnes/".$file2);
						}
						if(!empty($this->data["personne"]["image3ProdPre"]["name"])){
							$file3 = $personne_id ."-3-". $slug_image .".".$this->_extension($this->data["personne"]["image3ProdPre"]["name"]);					
							move_uploaded_file($this->data["personne"]["image3ProdPre"]["tmp_name"],"uploads/Personnes/".$file3);
						}
						if(!empty($this->data["personne"]["image4ProdPre"]["name"])){
							$file4 = $personne_id ."-4-". $slug_image .".".$this->_extension($this->data["personne"]["image4ProdPre"]["name"]);					
							move_uploaded_file($this->data["personne"]["image4ProdPre"]["tmp_name"],"uploads/Personnes/".$file4);
						}
						/*
						list($bRetour, $strRetour) = $this->_fctResize($this->data["personne"]["imagePre"]["tmp_name"], $file1);
						if (!$bRetour) {
							$bTransfert = false;
							$file1 = 'Indisponible.jpg';
						}
						*/						
						
						//on met a jour les informations de les informations sur les 'images du personne
						$personne = array();					
						$personne["personne"]["id"] = $personne_id;
						$personne["personne"]["image"] = $file1;
						$personne["personne"]["image2Prod"] = $file2;
						$personne["personne"]["image3Prod"] = $file3;
						$personne["personne"]["image4Prod"] = $file4;						
						$this->personne->save($personne);	
						//pr($personne);
						$inserted = true;
						$this->_sendMailpersonneAjoute($personne_id) ;
						$this->_sendMailAdminpersonneAjoute($personne_id) ;
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
	
	
	
	function member_modifier ($personne_id){
		if(isset($this->data) ) {
			if ($this->Session->read('Auth.Member.id')!= $this->data['personne']['seller_id']){//on vérifie si l'utilisateur a le droit de modifier cet article (donc un article qui lui appartient)
				$this->Session->setFlash("Vous n'avez pas le droit de modifier cet article.","default",array('class'=>'error_box'));	
				$this->redirect("/member/Personnes/Personnes_en_vente") ;
			}
			
			if($this->personne->save($this->data) )  {
				$personne = array();
				$personne['personne']['id'] = $personne_id;
				//pour construire les noms des images des Personnes
				$q = $this->personne->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["personne"]["marque_id"])) ); 
				$marque = $q['Marque']['slug'];					
				$q = $this->personne->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["personne"]["sexe_id"]) )); 
				$sexe = $q['Sexe']['slug'];
				$q = $this->personne->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["personne"]["type_id"]) )); 
				$type = $q['Type']['slug'];
				$this->loadModel ('Matiere');
				$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["personne"]["matiere_id"])) ); 
				$matiere = $q['Matiere']['slug'];
				
				$strRetour = "";						
				$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($matiere != 'autre'? '-'.$matiere : '') ;
				
				
				if(!empty($this->data["personne"]["imagePre"]["name"])){
					$file1 = $personne_id ."-1-". $slug_image .".".$this->_extension($this->data["personne"]["imagePre"]["name"]);					
					move_uploaded_file($this->data["personne"]["imagePre"]["tmp_name"],"uploads/Personnes/".$file1);
					$personne['personne']['image'] = $file1;
				}
				if(!empty($this->data["personne"]["image2ProdPre"]["name"])){
					$file2 = $personne_id ."-2-". $slug_image .".".$this->_extension($this->data["personne"]["image2ProdPre"]["name"]);					
					move_uploaded_file($this->data["personne"]["image2ProdPre"]["tmp_name"],"uploads/Personnes/".$file2);
					$personne['personne']['image2Prod'] = $file2;
				}
				if(!empty($this->data["personne"]["image3ProdPre"]["name"])){
					$file3 = $personne_id ."-3-". $slug_image .".".$this->_extension($this->data["personne"]["image3ProdPre"]["name"]);					
					move_uploaded_file($this->data["personne"]["image3ProdPre"]["tmp_name"],"uploads/Personnes/".$file3);
					$personne['personne']['image3Prod'] = $file3;
				}
				if(!empty($this->data["personne"]["image4ProdPre"]["name"])){
					$file4 = $personne_id ."-4-". $slug_image .".".$this->_extension($this->data["personne"]["image4ProdPre"]["name"]);					
					move_uploaded_file($this->data["personne"]["image4ProdPre"]["tmp_name"],"uploads/Personnes/".$file4);
					$personne['personne']['image4Prod'] = $file4;
				}
				//faire une sauvegarde des information du personne
				$this->personne->save($personne);
				$this->Session->setFlash("L'article a été modifié avec succès.","default",array('class'=>'valid_box'));	
				$this->personne->saveField('statut', 2);
				$this->redirect("/member/Personnes/Personnes_en_vente") ;
				}
		}
		$this->data = $this->personne->findById($personne_id);
		if ($this->Session->read('Auth.Member.id')!= $this->data['personne']['seller_id']){
			$this->Session->setFlash("Vous n'avez pas le droit de modifier cet article.","default",array('class'=>'error_box'));	
			$this->redirect("/member/Personnes/Personnes_en_vente") ;
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
						
						$strRequest = sprintf("UPcreated `personne` SET `image`='%s', `image2Prod`='%s', `image3Prod`='%s', `image4Prod`='%s' WHERE `refProd`='%u'",
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
			$this->data['personne']['seller_id'] = $this->Session->read('Auth.Member.id') ;
			if($this->personne->save($this->data) )  {
				$this->Session->setFlash("Le statut de l'article a été modifié avec succès.","default",array('class'=>'valid_box'));	
				//$this->redirect("/member/members/commandes_clients") ;
				//$this->redirect($this->referer()) ;
				}
		}
		$this->personne->id = $id ;
		$this->data = $this->personne->read();
		
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
			//$this->data['personne']['seller_id'] = $this->Session->read('Auth.Member.id') ;
			$personne_id = $this->data['Variete']['personne_id'] ;
			//$personne_id = $this->data['Variete']['personne_id'] ;
			
			if($this->personne->Variete->save($this->data) )  {
				$this->Session->setFlash("Le stock a été modifié avec succès.","default",array('class'=>'valid_box'));	
				$this->redirect("/member/Personnes/afficher/".$personne_id) ;
			}
		}else{
			//$this->personne->Variete->id = $id ;
			$this->data = $this->personne->Variete->findById($id);	
			//pr ($this->data);
		}
	}
	
	
	function member_variete_ajouter($personne_id = NULL) {
		//si soumession des données
		if(isset($this->data)){
			//on vérifie si ce type de variante n'existe pas déja
			//si non => sauvegarder
			$personne_id = $this->data['Variete']['personne_id'];
			$taille_id = $this->data['Variete']['taille_id'];
			$couleur_id = $this->data['Variete']['couleur_id'];				
			$this->loadModel('Variete');
			$variete = $this->Variete->find ('first',array('conditions'=>array('Variete.personne_id'=>$personne_id, 'Variete.couleur_id'=>$couleur_id,'Variete.taille_id'=>$taille_id)));
			if ($variete){//sortie en erreur
				$this->Session->setFlash("La variante est déjà définie. Veuillez vérifier la liste des variantes de l'article." ,"default",array('class'=>'error_box'));
				$this->redirect("/member/Personnes/afficher/".$personne_id) ;				
			}else{//si oui envoyer =>message erreur
				$this->Variete->save($this->data);
				$this->Session->setFlash("La variante a été ajoutée avec succès." ,"default",array('class'=>'valid_box'));
				$this->redirect("/member/Personnes/afficher/".$personne_id) ;
			}			
		}
		$this->data['Variete']['personne_id'] = $personne_id; 
		$this->loadModel('Taille'); 
		$tailles = $this->Taille->find('list'); 
		$this->loadModel('Couleur'); 
		$couleurs = $this->Couleur->find('list'); 
		$this->set('couleurs',$couleurs);
		$this->set('tailles',$tailles);
	}
	
	function member_variete_delete($variete_id) {
		//$this->data = $this->personne->Variete->findById ($variete_id);
		if($this->personne->Variete->delete($variete_id)) {
			$this->Session->setFlash("La variante a été supprimée avec succès.","default",array('class'=>'valid_box'));	
		}else
			$this->Session->setFlash("Une erreur a été rencontrée lors de la suppresion de la variante.","default",array('class'=>'valid_box'));	
		$this->redirect ($this->referer ());
		
	}
	
	
	function member_modifier_images($id) {
		if(!empty($this->data) ) {
			$this->data['personne']['seller_id'] = $this->Session->read('Auth.Member.id');
			if($this->personne->save($this->data) )  {
				$this->Session->setFlash("L'article a été modifié avec succès","default",array('class'=>'valid_box'));
				$this->redirect("/member/members/articles") ;
				}
		}else{
			$this->personne->id = $id ;
			$this->data = $this->personne->read();	
		}
	}
	function member_delete ($id){
		if($id!=null){
			    $this->personne->id = $id ;
				$image1= $this->personne->field('image') ;
				$image2= $this->personne->field('image2Prod') ;
				$image3= $this->personne->field('image3Prod') ;
                if($this->personne->saveField('deleted',1) ) {
				   $this->Session->setFlash("Le personne a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
				   $this->redirect($this->referer()) ;
				 }else{
					 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Personne." ,"default",array('class'=>'error_box'));
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
	
	/* function member_Personnes (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; //que les Personnes validés
		$this->paginate['conditions']["Personne.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$this->set ('page_title','Mes articles en ventes sur Services4all');
	} */
	
	function member_Personnes_en_vente (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; // articles validés
		$this->paginate['conditions']["Personne.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Personnes', $this->_set_varietes_Personnes ($this->paginate('personne'))) ;  
		$this->set ('page_title','Articles validés | kidsdressing');
		$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->render("member_Personnes");
	}
	
	function member_Personnes_vendus (){ 
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] =  1 ; // articles validés
		$this->loadModel('Orderrow') ;		
		$this->paginate['conditions']["Personne.id"] = $this->data['Orderrow']['personne_id'] ;// Les articles qui se trouvent dans Orderrows
		$this->paginate['conditions']["Personne.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->loadModel('Variete'); 
		$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
		$this->set('varietes',$varietes);														
		$this->set('marques',$marques);
		$this->set('Personnes',$this->paginate('personne') );
		$this->set ('page_title','Articles vendus | Services4all');
		$this->render("member_Personnes");
	}
	
	function member_Personnes_en_at_validation (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Personne.deleted"] =  0 ; 
		$this->paginate['conditions']["Personne.statut"] = array( 0 ,2); // articles en attente de validation
		$this->paginate['conditions']["Personne.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Personnes',$this->paginate('personne') );
		$this->set ('page_title','Articles en attente de validation | Services4all');
		$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->render("member_Personnes");
	}
	
	function member_Personnes_supprimes (){
		$this->paginate['limit'] = 20 ;
		$this->paginate['order'] = "Personne.id desc" ;
		$this->paginate['recursive'] = 2 ; 
		$this->paginate['conditions']["Personne.deleted"] = 1 ; // articles supprimés
		$this->paginate['conditions']["Personne.seller_id"] = $this->Session->read('Auth.Member.id'); 
		$this->set('Personnes',$this->paginate('personne') );
		$this->set ('page_title','Articles supprimés | Services4all');
		$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc'));
		$this->set('marques',$marques);
		$this->render("member_Personnes");
	}
	
	function member_publier($id){
		$this->personne->id = $id;
		if( $this->personne->saveField('publish', 1) ){
			   $this->Session->setFlash("L'article a été publié avec succès.","default",array('class'=>'valid_box'));	
			   $this->redirect($this->referer()) ;	
			 };
		$this->redirect($this->referer()) ;	

	}
	function member_depublier($id){
		$this->personne->id = $id;
		if( $this->personne->saveField('publish', 0) ){
			   $this->Session->setFlash("L'article a été dépublié avec succès.","default",array('class'=>'valid_box'));	
			   $this->redirect($this->referer()) ;	
		};
		$this->redirect($this->referer()) ;	
	}


//----------------------------------------- Admin ----------------------------------------------	
		function admin_index(){
			$this->paginate['conditions'] =  "Personne.deleted = 0 and Personne.statut = 1" ;
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Personnes',$this->paginate('personne') );
			$this->set('page_title','Liste des articles en ligne');
			$this->set('balise_h1','Liste des articles en ligne');
			$this->render('admin_index') ;
		}
		function admin_rechercher() {
            $this->paginate['limit'] = 30;
            $this->paginate['order'] = 'Personne.id desc';
            $this->paginate['conditions']["Personne.deleted"] =  0 ;
			$query = "";
            if( !empty($this->data) ) {
                if (!empty ($this->data['personne']['query'])){
                    $query = $this->data['personne']['query'] ;
                    $this->paginate['conditions']["and"] = array(
                                                            'or'=>array(
                                                                "Type.nom like '%$query%'",
                                                                "Sexe.nom like '%$query%'",
                                                                "Figurine.nom like '%$query%'",
                                                                /* "Seller.nom like '%$query%'",
                                                                "Seller.prenom like '%$query%'",
                                                                "Seller.pseudo like '%$query%'",
                                                                "Seller.email like '%$query%'", */
                                                                "Personne.id = '$query'",
                                                                ));
                    }
                if (!empty ($this->data['personne']['marque'])){   
                        $marque = $this->data['personne']['marque'] ;
                        $this->paginate['conditions']["Personne.marque_id"] =  $marque;
                    }
            }
            $q = $this->paginate('personne') ;
            $marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
                                                                'order'=>'Marque.nom asc'));
            /* $this->loadModel('Variete');
            $varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
            $this->set('varietes',$varietes);  */                                                      
            $this->set('marques',$marques);
            $this->set('Personnes', $q ) ;
            $this->set('balise_h1',"Résultat de la recherche : " . $query);
            $this->set('page_title','Résultat de la recherche');
            $this->render('admin_index') ;
        }
		
		function admin_non_valides(){
           	$this->paginate["conditions"] = "Personne.deleted = 0 and Personne.statut = 0" ;
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Personnes',$this->paginate('personne') );
			$this->set('page_title','Liste de tous les nouveaux articles non validés');
			$this->set('balise_h1','Liste de tous les nouveaux articles non validés');
			$this->render('admin_index');
			
		}
		
		function admin_modifies_non_valides(){
			$this->paginate['conditions'] = "Personne.deleted = 0 and Personne.statut = 2" ;
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Personnes',$this->paginate('personne') );
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
	
		function admin_vendus() {//liste des Personnes vendus sur le site donc ceux qui se retrouvent dans la ligne des commandes validées
			//a terminer 
			$vendus = $this->_getVendus($this->data['personne']['id'] )  ;
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$vendus = $this->paginate('personne') ;
			//echo $vendus;
			$this->set('Personnes',$vendus) ;
			
			$this->set('page_title','Liste de tous les articles vendus.');
			$this->set('balise_h1','Liste de tous les articles vendus');
			$this->render('admin_index');
		}
		
		function admin_epuises() {//liste des Personnes dont le stock est épuisé (pour voir si anomalie) et les désactiver
			//a terminer
			$epuises = $this->_getEpuises($this->data['personne']['id'] )  ;
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$epuises = $this->paginate('personne') ;
			//echo $epuises;
			$this->set('Personnes',$epuises) ;
			$this->set('page_title','Liste de tous les articles épuisés.');
			$this->set('balise_h1','Liste de tous les articles épuisés');
			
			$this->render('admin_index');
		}
		
		
		function admin_supprimes() {
			$this->paginate = array(
								"conditions" => "Personne.deleted = 1",
								'recursive'=>2,
								'limit' => 20,
								"order" => "Personne.id desc"
								) ; 
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Personnes',$this->paginate('personne') );
			$this->set('page_title','Liste des articles supprimés');
			$this->set('balise_h1','Liste des articles supprimés');
			$this->render('admin_index');
		}
	
		function admin_tous() {//liste des Personnes marques comme supprimes
			$this->paginate = array(
								'recursive'=>2,
								'limit' => 20,"conditions"=>"Personne.deleted = 0",
								"order" => "Personne.id desc"
								) ; 
			$marques = $this->personne->Marque->find('list',array('conditions'=>'Marque.deleted = 0',
															'order'=>'Marque.nom asc')); 
			/* $this->loadModel('Variete'); 
			$varietes = $this->Variete->find('first',array('fields'=>array('Variete.stock')));
			$this->set('varietes',$varietes); */
			$this->set('marques',$marques);
			$this->set('Personnes',$this->paginate('personne') );
			$this->set('page_title','Liste de tous les articles');
			$this->set('balise_h1','Liste de tous les articles');
			$this->render('admin_index');
		}
	
	
		function admin_afficher($id){
			$q = $this->personne->findById($id);
           
			$this->loadModel('Variete'); 
			$varietes = $this->Variete->find('all',array(
				'fields'=>array('Variete.id','Taille.nom','Couleur.nom','Variete.stock'),
				'conditions'=>array('Variete.personne_id'=>$id) ) ) ;
			 $this->set('varietes',$varietes); 
			 
			 $this->set('personne',$q);
			 
        }

		function admin_modifier_tags() {
			
			if(isset($this->data)){
				$this->personne->id = $this->data['personne']['id'];
				if ($this->personne->saveField('tag_home', $this->data['personne']['tag_home']) &&  $this->personne->saveField('tag_nouveaute', $this->data['personne']['tag_nouveaute']) && $this->personne->saveField('tag_selection', $this->data['personne']['tag_selection']) && $this->personne->saveField('tag_coups_coeur', $this->data['personne']['tag_coups_coeur']) && $this->personne->saveField('tag_bonplan', $this->data['personne']['tag_bonplan'])) {
					$this->Session->setFlash("Le paramétrage des tages a été enregistré avec succès.","default",array('class'=>'valid_box'));                   
				}else
					$this->Session->setFlash("Une erreur a été rencontrée lors du paramétrage des tages.","default",array('class'=>'valid_box'));	
                    
				$this->redirect($this->referer()) ;
			} else{
				$this->personne->id = $this->data['personne']['id'] ;
				$this->data = $this->personne->read();
			}
		}
		
		function admin_valider($id) {
			$this->personne->id = $id;
			$this->personne->findById( $id ) ;
			$this->personne->set('statut', 1) ;
			if( $this->personne->save() ){
			    $this->Session->setFlash("L'article a été validé avec succès.","default",array('class'=>'valid_box'));	
				//envoyer un mail à l'annonceur que l'article a été validé
			
			};
			$this->redirect($this->referer())  ;
		}
	    
		function admin_refuser($id) {
			$this->personne->id = $id;
			if( $this->personne->saveField('statut', 3) ){
			    $this->Session->setFlash("L'article a été marqué en statut refusé avec succès.","default",array('class'=>'valid_box'));	
				//envoyer un mail à l'annonceur que l'article a été refusé
				
			};
			$this->redirect("index")  ;
		}
		
		
		
	    function admin_publier($id){
			$this->personne->id = $id;
			if( $this->personne->saveField('publish', 1) ){
			       $this->Session->setFlash("L'article a été publié avec succès.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
				 };
			$this->redirect("index")  ;

	    }
		function admin_depublier($id){
			$this->personne->id = $id;
			if( $this->personne->saveField('publish', 0) ){
			       $this->Session->setFlash("L'article a été dépublié.","default",array('class'=>'valid_box'));	
				   $this->redirect('index') ;
			};
			$this->redirect("index")  ;
	    }
		
        function admin_remonter ($id){
                 // on va 
				$this->personne->id = $id ; 
				$p = $this->personne->read(array('position','categorie_id'))  ; 
				// si la position est superieur a 1  -1
				if($p['personne']['position'] > 1 ) {
				             $new_position = $p['personne']['position'] - 1 ; 
		  		             $this->personne->saveField('position', $new_position) ; 
								// on ajoute 1 au personne qui suit  dans la mme categorie
							$q = $this->personne->find('first',array("conditions"=>array(
																					'and'=>array('position <'=>$new_position,
																								 'categorie_id'=>$p['personne']['categorie_id']
																								 ) 
																						)
																	) ) ;
							if(!empty($q)) {
									 // on ajoute 1 
									 $this->personne->id = $q['personne']['id'] ;						 
									 $new_position = $p['personne']['position'] ; 
									 $this->personne->saveField('position', $new_position ) ; 
									 }			 
							 
							 
							 
				}
				

				$this->redirect($this->referer() ) ;
         }		 
		function admin_descendre ($id){
		                        
				$this->personne->id = $id ; 
				$p = $this->personne->read(array('position','categorie_id'))  ; 
				$new_position = $p['personne']['position'] + 1 ; 
			    $this->personne->saveField('position', $new_position) ; 
				 
				
				// on decremente 1 du personne qui suit  dans la mme cat
				$q = $this->personne->find('first',array("conditions"=>array(
																		'and'=>array('position <'=>$new_position,
																	    'categorie_id'=>$p['personne']['categorie_id']
																		 ) 
														             )
										 ) ) ;
				if(!empty($q) && $q['personne']['id'] >1 ) {
				         // on  -1
						 $this->personne->id = $q['personne']['id'] ;						 
						 $new_position = $p['personne']['position']   ; 
						 $this->personne->saveField('position', $new_position ) ; 
						 } 
				$this->redirect($this->referer() ) ;
		
		}
		
		function admin_ajouter(){
					    // Langues à éditer
				$locales = array_values(Configure::read('Config.languages'));
				$this->personne->locale = $locales;
		    if(isset($this->data)){
				if (empty($this->data['personne']['prixGros']))
					$this->data['personne']['prixGros'] = 0;
				if (empty($this->data['personne']['prixSolde']))
					$this->data['personne']['prixSolde'] = 0;	
				if (empty($this->data['personne']['prixAchat']))
					$this->data['personne']['prixAchat'] = 0;
				if (empty($this->data['personne']['refpersonneClient']))
					$this->data['personne']['refpersonneClient'] = "";
				if (empty($this->data['personne']['figurine_id']))
					$this->data['personne']['figurine_id'] = 0;
				//pr ($this->data);
				if( $this->personne->save($this->data) ){
					
					$personne = array();
					$personne_id = $this->personne->id ;
					$personne['personne']['id'] = $personne_id ;
					$personne['personne']['statut'] = 1 ;
					//pour construire les noms des images des Personnes
					$q = $this->personne->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["personne"]["sexe_id"]) )); 
					$sexe = $q['Sexe']['slug'];
					$q = $this->personne->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["personne"]["type_id"]) )); 
					$type = $q['Type']['slug'];
					$this->loadModel ('Matiere');
					$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["personne"]["matiere_id"])) ); 
					$matiere = $q['Matiere']['slug'];
					
					$strRetour = "";						
					$slug_image = $type . '-' . ($sexe == 'mixte'? '': $sexe) . '-' . ($matiere != 'autre'? '-'.$matiere : '') ;
					
					
					if(!empty($this->data["personne"]["imagePre"]["name"])){
						$file1 = $personne_id ."-1-". $slug_image .".".$this->_extension($this->data["personne"]["imagePre"]["name"]);					
						move_uploaded_file($this->data["personne"]["imagePre"]["tmp_name"],"uploads/Personnes/".$file1);
						$personne['personne']['image'] = $file1;
					}
					if(!empty($this->data["personne"]["image2ProdPre"]["name"])){
						$file2 = $personne_id ."-2-". $slug_image .".".$this->_extension($this->data["personne"]["image2ProdPre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image2ProdPre"]["tmp_name"],"uploads/Personnes/".$file2);
						$personne['personne']['image2Prod'] = $file2;
					}
					if(!empty($this->data["personne"]["image3ProdPre"]["name"])){
						$file3 = $personne_id ."-3-". $slug_image .".".$this->_extension($this->data["personne"]["image3ProdPre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image3ProdPre"]["tmp_name"],"uploads/Personnes/".$file3);
						$personne['personne']['image3Prod'] = $file3;
					}
					if(!empty($this->data["personne"]["image4ProdPre"]["name"])){
						$file4 = $personne_id ."-4-". $slug_image .".".$this->_extension($this->data["personne"]["image4ProdPre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image4ProdPre"]["tmp_name"],"uploads/Personnes/".$file4);
						$personne['personne']['image4Prod'] = $file4;
					}
					if(!empty($this->data["personne"]["image_demo_personnalisePre"]["name"])){
						$file5 = $personne_id ."-bijou-personnalise-". $slug_image .".".$this->_extension($this->data["personne"]["image_demo_personnalisePre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image_demo_personnalisePre"]["tmp_name"],"uploads/Personnes/".$file5);
						$personne['personne']['image_demo_personnalise'] = $file5;
					}
					//faire une sauvegarde des information du personne
					$this->personne->save($personne);
					
					$this->Session->setFlash("Le personne a été ajouté avec succès.","default",array('class'=>'valid_box'));	
                    $this->redirect("index") ;
				}else{
						$this->Session->setFlash("Une erreur a été rencontrée lors de l'ajout du Personne.","default",array('class'=>'error_box'));	
                		
				}
            }
			//pr ($this->data);
			$this->_set_listes_form ();
			$this->set('evenements',$this->personne->Evenement->find('list',array(
													"conditions" => array("Evenement.deleted = 0 and Evenement.visible = 1"),
													"order" => "Evenement.position DESC"
													)));
			$this->set('collections',$this->personne->Collection->find('list',array(
													"conditions" => array("Collection.deleted = 0 and Collection.visible = 1"),
													"order" => "Collection.nom desc"
													)));
			$vendeurs = $this->personne->Seller->find('all',array('order'=>'Seller.nom asc','fields'=>array('Seller.id','Seller.nom','Seller.prenom','Seller.pseudo')));
			$this->set('vendeurs',$vendeurs);
			
			$this->set('page_title',"Ajouter un personne");
			
		} 
		function admin_modifier($personne_id){
		    		    // Langues à éditer
				$locales = array_values(Configure::read('Config.languages'));
				$this->personne->locale = $locales;
			if(isset($this->data)){
                if($this->personne->save($this->data) )  {
					$personne = array();
					$personne['personne']['id'] = $personne_id;
					//pour construire les noms des images des Personnes
					$q = $this->personne->Marque->find('first',array('conditions'=>array("Marque.id"=> $this->data["personne"]["marque_id"])) ); 
					$marque = $q['Marque']['slug'];					
					$q = $this->personne->Sexe->find('first',array('conditions'=>array("Sexe.id"=> $this->data["personne"]["sexe_id"]) )); 
					$sexe = $q['Sexe']['slug'];
					$q = $this->personne->Type->find('first',array('conditions'=>array("Type.id"=> $this->data["personne"]["type_id"]) )); 
					$type = $q['Type']['slug'];
					$this->loadModel ('Matiere');
					$q = $this->Matiere->find('first',array('conditions'=>array("Matiere.id"=> $this->data["personne"]["matiere_id"])) ); 
					$matiere = $q['Matiere']['slug'];
					 
					$strRetour = "";						
					$slug_image = $type . '-' . ($sexe == 'mixte'? 'enfant': $sexe) . ($marque != 'autre'? '-'.$marque : '') . ($matiere != 'autre'? '-'.$matiere : '') ;
					
					
					if(!empty($this->data["personne"]["imagePre"]["name"])){
						$file1 = $personne_id ."-1-". $slug_image .".".$this->_extension($this->data["personne"]["imagePre"]["name"]);					
						move_uploaded_file($this->data["personne"]["imagePre"]["tmp_name"],"uploads/Personnes/".$file1);
						$personne['personne']['image'] = $file1;
					}
					if(!empty($this->data["personne"]["image2ProdPre"]["name"])){
						$file2 = $personne_id ."-2-". $slug_image .".".$this->_extension($this->data["personne"]["image2ProdPre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image2ProdPre"]["tmp_name"],"uploads/Personnes/".$file2);
						$personne['personne']['image2Prod'] = $file2;
					}
					if(!empty($this->data["personne"]["image3ProdPre"]["name"])){
						$file3 = $personne_id ."-3-". $slug_image .".".$this->_extension($this->data["personne"]["image3ProdPre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image3ProdPre"]["tmp_name"],"uploads/Personnes/".$file3);
						$personne['personne']['image3Prod'] = $file3;
					}
					if(!empty($this->data["personne"]["image4ProdPre"]["name"])){
						$file4 = $personne_id ."-4-". $slug_image .".".$this->_extension($this->data["personne"]["image4ProdPre"]["name"]);					
						move_uploaded_file($this->data["personne"]["image4ProdPre"]["tmp_name"],"uploads/Personnes/".$file4);
						$personne['personne']['image4Prod'] = $file4;
					}
					//faire une sauvegarde des information du personne
					$this->personne->save($personne);
					
					$this->Session->setFlash("Le personne a été modifié avec succès.","default",array('class'=>'valid_box'));	
                    $this->redirect("index") ;
				}
			} else{ 
				$this->data = $this->personne->findById($personne_id);
				$this->_set_listes_form ();
			    $vendeurs = $this->personne->Seller->find('all',array('order'=>'Seller.nom asc','fields'=>array('Seller.id','Seller.nom','Seller.prenom','Seller.pseudo')));
			    $this->set('vendeurs',$vendeurs);
				$this->set('evenements',$this->personne->Evenement->find('list',array(
													"conditions" => array("Evenement.deleted = 0 and Evenement.visible = 1"),
													"order" => "Evenement.position DESC"
													)));
				$this->set('collections',$this->personne->Collection->find('list',array(
													"conditions" => array("Collection.deleted = 0 and Collection.visible = 1"),
													"order" => "Collection.nom desc"
													)));
				$this->set('page_title',"Modifier l'article : " . $this->data['personne']['id']);
			}
		}
        function admin_delete($id){
            if($id!=null){
			    $this->personne->id = $id ;
				$image1= $this->personne->field('image') ;
				$image2= $this->personne->field('image2Prod') ;
				$image3= $this->personne->field('image3Prod') ;
                if($this->personne->saveField('deleted',1) ) {
				   $this->Session->setFlash("Le personne a été suprimé avec succès." ,"default",array('class'=>'valid_box'));
				   $this->redirect($this->referer()) ;
				 }else{
					 $this->Session->setFlash("Une erreur a été rencontré lors de la suppression du Personne." ,"default",array('class'=>'error_box'));
					$this->redirect($this->referer()) ;				 
				 }
				                
            }
        }
		
		function admin_restore($id){// pour restaurer le personne
            if($id!=null){
			    $this->personne->id = $id ;
				$image1= $this->personne->field('image') ;
				$image2= $this->personne->field('image2Prod') ;
				$image3= $this->personne->field('image3Prod') ;
                if($this->personne->saveField('deleted',0) ) {
				   $this->Session->setFlash("Le personne a été restauré avec succès." ,"default",array('class'=>'valid_box'));
				   $this->redirect($this->referer()) ;
				 }else{
					 $this->Session->setFlash("Une erreur a été rencontré lors de la restauration du Personne." ,"default",array('class'=>'error_box'));
					$this->redirect($this->referer()) ;				 
				 }
				                
            }
        }
		
        function admin_permanently_delete($id) {// pour suprimer définitivement le personne
			if($id!=null) {
				if($this->personne->delete($id) ) {
					$this->Session->setFlash("Le personne a été suprimé définitivement.","default",array('class'=>'valid_box'));	
					$this->redirect($this->referer()) ;	
				 }
				else $this->Session->setFlash("Une erreur a été rencontré lors de la suppression","default",array('class'=>'valid_box'));	
				$this->redirect($this->referer()) ;	
			}	
		}	
        
		function admin_variete_ajouter ($personne_id =NULL){
			//si soumession des données
			if(isset($this->data)){
				//on vérifie si ce type de variante n'existe pas déja
				//si non => sauvegarder
				$personne_id = $this->data['Variete']['personne_id'];
				$taille_id = $this->data['Variete']['taille_id'];
				$couleur_id = $this->data['Variete']['couleur_id'];				
				$this->loadModel('Variete');
				$variete = $this->Variete->find ('first',array('conditions'=>array('Variete.personne_id'=>$personne_id, 'Variete.couleur_id'=>$couleur_id,'Variete.taille_id'=>$taille_id)));
				if ($variete){//sortie en erreur
					$this->Session->setFlash("La variante est déjà définie. Veuillez vérifier la liste des variantes de l'article." ,"default",array('class'=>'error_box'));
					$this->redirect("/admin/Personnes/afficher/".$personne_id) ;				
				}else{//si oui envoyer =>message erreur
					$this->Variete->save($this->data);
					$this->Session->setFlash("La variante a été ajoutée avec succès." ,"default",array('class'=>'valid_box'));
					$this->redirect("/admin/Personnes/afficher/".$personne_id) ;
				}			
			}
			$this->data['Variete']['personne_id'] = $personne_id; 
			$this->loadModel('Taille'); 
			$tailles = $this->Taille->find('list'); 
			$this->loadModel('Couleur'); 
			$couleurs = $this->Couleur->find('list'); 
			$this->set('couleurs',$couleurs);
			$this->set('tailles',$tailles);
			
		}
		
		function admin_variete_modifier ($variete_id){
			if(isset($this->data)){
				if($this->personne->Variete->save($this->data) )  {
			       $personne_id = $this->data['Variete']['personne_id'];
				   $this->Session->setFlash("Le stock a été modifié avec succès.","default",array('class'=>'valid_box'));	
                    $this->redirect("/admin/Personnes/afficher/".$personne_id) ;
				}else
					$this->Session->setFlash("Une erreur a été rencontré lors de la modification du stock.","default",array('class'=>'error_box'));	
                  
			} 
			$this->personne->Variete->id = $variete_id ;
			$this->data = $this->personne->Variete->read();
		}
		
		function admin_variete_delete($variete_id) {
			if($this->personne->Variete->delete($variete_id) )  {
			   $this->Session->setFlash("La variante a été supprimée avec succès.","default",array('class'=>'valid_box'));	
			}else
				$this->Session->setFlash("Une erreur a été rencontrée lors de la suppression de la variante.","default",array('class'=>'error_box'));	
			$this->redirect($this->referer()) ;
			
		}	
	
	
	function admin_tag($id=null) {
		if(isset($this->data)){
			$this->personne->id = $id;
			//echo $this->data['personne']['id'];
			if ($this->personne->saveField('tag_home', $this->data['personne']['tag_home']) &&  $this->personne->saveField('tag_nouveaute', $this->data['personne']['tag_nouveaute']) && $this->personne->saveField('tag_selection', $this->data['personne']['tag_selection']) && $this->personne->saveField('tag_coups_coeur', $this->data['personne']['tag_coups_coeur']) && $this->personne->saveField('tag_bonplan', $this->data['personne']['tag_bonplan'])) {
				$this->Session->setFlash("Le paramétrage des tages a été enregistré avec succès.","default",array('class'=>'valid_box'));                   
			}else
				$this->Session->setFlash("Une erreur a été rencontrée lors du paramétrage des tages.","default",array('class'=>'valid_box'));	
				
			$this->redirect("index")  ;
		}
		$this->personne->id = $id ;
		$this->data = $this->personne->read();
	}
	
	function region($id){
		$data["personne"]=$this->personne->find("all",array(
			"conditions" => array("Personne.statut = 1 and Personne.region=$id"),
						"order" => "Personne.id DESC"
		));
		$this->set('Personnes',$data["personne"]);
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
												 "Personne.description LIKE" => "%".$rech."%",
												 "Personne.tags LIKE" => "%".$rech."%",
												 "Personne.nom LIKE" => "%".$rech."%"  
												)								
								  ) ;
			

	   $this->paginate = array('conditions' =>  $conditions ,
								"limit"=>10                      
						);
		$this->set('Personnes',$this->paginate('personne'));
		$this->set ('rech_req',$rech_req);
	}
	
	
	
	function modifier($id){
	  if (empty($this->data)) {
			$this->personne->id = $id ;
			$this->data = $this->personne->read();
			$this->set("personne", $this->data['personne']  ) ;
		} else {
			$image1 = "null"; $image2 = "null"; $image3 = "null";
			$this->data["personne"]["image"] = "";
			$this->data["personne"]["image2Prod"] = "";
			$this->data["personne"]["image3Prod"] = "";
			//on sauvegarde l'personne
			if (isset($_SESSION['Auth']['User']['id']) ) $this->data["personne"]["user_id"] = $_SESSION['Auth']['User']['id'];
			else $this->data["personne"]["user_id"] = null ;
			$this->personne->save($this->data);
			//on recupere l'identifiant de l'personne ajouté si nouvelle personne
			//if ($id_personne==null)
			$id_personne =  $id;
			//ensuite on enregistre les images
			if(!empty($this->data["personne"]["image"]["name"])){
				$image1 = "1";
				move_uploaded_file($this->data["personne"]["image"]["tmp_name"],"uploads/trash/".$this->data["personne"]["image"]["name"]);
				$as_saveFull = $this->Img->creerMin("uploads/trash/".$this->data["personne"]["image"]["name"],"uploads/Personnes/".$id_Personne."/full/",$image1,300,200,false);
				$as_saveMin = $this->Img->creerMin("uploads/trash/".$this->data["personne"]["image"]["name"],"uploads/Personnes/".$id_Personne."/min/",$image1,80,67,true);
				if ($as_saveFull == false and $as_saveMin ==  false)
					$image1 = "";
				else
					$image1 = "1.jpg";
			}
			if(!empty($this->data["personne"]["image2Prod"]["name"])){
				$image2 = "2";
				move_uploaded_file($this->data["personne"]["image2Prod"]["tmp_name"],"uploads/trash/".$this->data["personne"]["image2Prod"]["name"]);
				$as_saveFull = $this->Img->creerMin("uploads/trash/".$this->data["personne"]["image2Prod"]["name"],"uploads/Personnes/".$id_Personne."/full/",$image2,300,200,false);
				$as_saveMin = $this->Img->creerMin("uploads/trash/".$this->data["personne"]["image2Prod"]["name"],"uploads/Personnes/".$id_Personne."/min/",$image2,80,67,true);
				if ($as_saveFull == false and $as_saveMin ==  false)
					$image2 = "";
				else
					$image2 = "2.jpg";
			}
			if(!empty($this->data["personne"]["image3Prod"]["name"])){
				$image3 = "3";
				move_uploaded_file($this->data["personne"]["image3Prod"]["tmp_name"],"uploads/trash/".$this->data["personne"]["image3Prod"]["name"]);
				$as_saveFull = $this->Img->creerMin("uploads/trash/".$this->data["personne"]["image3Prod"]["name"],"uploads/Personnes/".$id_Personne."/full/",$image3,300,200,false);
				$as_saveMin = $this->Img->creerMin("uploads/trash/".$this->data["personne"]["image3Prod"]["name"],"uploads/Personnes/".$id_Personne."/min/",$image3,80,67,true);
				if ($as_saveFull == false and $as_saveMin ==  false)
					$image3 = "";
				else
					$image3 = "3.jpg";
			}
			//on met a jour les informations de l'Personnes
			$this->data["personne"]["image"] = $id ;
			//$this->data["personne"]["img1"] = "";
			//$this->data["personne"]["img2"] = "";
			//$this->data["personne"]["img3"] = "";
			// $this->personne->save($this->data);
		
			
			if ($this->personne->save($this->data['personne'])) {
			  $this->Session->setFlash("Le personne a été mise à jour.");
			  $this->redirect(array('controller'=>'Personnes', 'action'=>'mesPersonnes')); 
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
			if (!empty ($this->data['personne']['submit_search']) && $this->data['personne']['submit_search'] == $id_page ) {
				$this->data['personne']['submit_search'] = $id_page ;
			}else{
				$this->data  = array();
				$this->data['personne']['submit_search'] = $id_page ;
			}		
		}
	}
	
	function _sendMailpersonneAjoute($personne_id) {
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->personne->findById($personne_id)  ;
		$this->set('personne', $q );
		$this->Email->reset() ;
		$this->Email->to = $this->Session->read('Auth.Member.email') ;
		//$this->Email->cci = $site_contact_cc ; 
		$this->Email->subject = 'Réf article : '.$personne_id.' - Votre annonce a été enregistrée' ;
		$this->Email->from = 'Services 4 All <ne-pas-repondre@services4all.ma>';
		$this->Email->template = 'Personnes/information_client_ajout'; // note no '.ctp'
			  //Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs = 'html'; // because we like to send pretty mail
			  //Set view variables as normal
			  //Do not pass any args to send()
		$this->Email->send();
	}
	function _sendMailAdminpersonneAjoute($personne_id) {
		$site_contact = Configure::read('site_contact');
		$site_contact_cc = Configure::read('site_contact_cc');
		$q = $this->personne->findById($personne_id)  ;
		$this->set('personne', $q );
		$this->Email->reset() ;
		$this->Email->to = $site_contact ;
		$this->Email->subject = '[Services 4 All] Nouvelle personne service ajoutée sur le site : '.$personne_id;
		$this->Email->from = 'Services 4 All <ne-pas-repondre@services4all.ma>';
		$this->Email->template = 'Personnes/information_admin_ajout'; // note no '.ctp'
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
	$chemin = './uploads/Personnes/';
	
	
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