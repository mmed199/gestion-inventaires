<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
 /*produits*/
	// Router::connect('/', array('controller' => 'produits', 'action' => 'home'));

	Router::connect('/', array('controller' => 'members', 'action' => 'connexion'));
	
	
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	/*redirection des categories*/

					
	
Router::connect(
	'/admin',
	array('controller' => 'users', 'action' => 'home', 'prefix' => 'admin')
);
Router::connect(
	'/com',
	array('controller' => 'users', 'action' => 'home', 'prefix' => 'com')
);
Router::connect(
	'/client',
	array('controller' => 'clients', 'action' => 'index', 'prefix' => 'client')
);
Router::connect(
	'/member',
	array('controller' => 'members', 'action' => 'home', 'prefix' => 'member')
);



Router::connect(
	'/admin.html',
	array('controller' => 'users', 'action' => 'home', 'prefix' => 'admin')
);


// projet : Application CliAdministration 
// created : 07/03/2018 
// by : Lhiadi Redouane
// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ Gestion membres -----------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------

Router::connect('/accueil.html',	array('controller' => 'members', 'action' => 'home', 'prefix' => 'member'));

Router::connect('/inscription.html',	array('controller' => 'members', 'action' => 'inscription'));
Router::connect('/connexion.html',	array('controller' => 'members', 'action' => 'connexion'));
Router::connect('/mot-de-passe-oublie.html',	array('controller' => 'members', 'action' => 'recover'));
Router::connect('/compte.html',	array('controller' => 'members', 'action' => 'home', 'prefix' => 'member'));

// ---------------------------------------------------- end membre --------------------------------------------------------

// ------------------------------------------------ Gestion users -----------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------

Router::connect('/admin/accueil.html',	array('controller' => 'users', 'action' => 'home', 'prefix' => 'admin'));

Router::connect('/admin/inscription.html',	array('controller' => 'users', 'action' => 'inscription'));
Router::connect('/admin/connexion.html',	array('controller' => 'users', 'action' => 'connexion'));
Router::connect('/admin/mot-de-passe-oublie.html',	array('controller' => 'users', 'action' => 'recover'));
Router::connect('/admin/compte.html',	array('controller' => 'users', 'action' => 'home', 'prefix' => 'admin'));
Router::connect('/admin/mon-profil.html',	array('controller' => 'users', 'action' => 'index', 'prefix' => 'admin'));
Router::connect('/admin/deconnection.html',	array('controller' => 'users', 'action' => 'logout'));
Router::connect('/admin/mes-annonces.html',	array('controller' => 'users', 'action' => 'annonces', 'prefix' => 'admin'));

// ---------------------------------------------------- end membre --------------------------------------------------------


// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------ Gestion activités ---------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------

Router::connect('/gestion-activites.html',	array('controller' => 'members', 'action' => 'activites', 'prefix' => 'member'));
Router::connect('/admin/gestion-activites.html',	array('controller' => 'users', 'action' => 'activites', 'prefix' => 'admin'));
Router::connect('/gestion-dossiers.html',	array('controller' => 'members', 'action' => 'dossiers', 'prefix' => 'member'));
Router::connect('/gestion-taches.html',	array('controller' => 'members', 'action' => 'taches', 'prefix' => 'member'));
Router::connect('/gestion-temps.html',	array('controller' => 'members', 'action' => 'temps', 'prefix' => 'member'));
Router::connect('/planning.html',	array('controller' => 'members', 'action' => 'planning', 'prefix' => 'member'));


// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------    Gestion RH   -----------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------
//Membre
Router::connect('/gestion-rh.html',	array('controller' => 'members', 'action' => 'rh', 'prefix' => 'member'));
Router::connect('/gestion-absences.html',	array('controller' => 'absences', 'action' => 'index', 'prefix' => 'member'));
Router::connect('/gestion-profils',	array('controller' => 'profils', 'action' => 'profils', 'index' => 'member'));

//admin
Router::connect('/admin/gestion-rh.html',	array('controller' => 'users', 'action' => 'rh', 'prefix' => 'admin'));
Router::connect('/admin/gestion-absences.html',	array('controller' => 'absences', 'action' => 'index', 'prefix' => 'admin'));
Router::connect('/admin/gestion-profils',	array('controller' => 'profils', 'action' => 'index', 'prefix' => 'admin'));
Router::connect('/admin/gestion-indemnites.html',	array('controller' => 'indemnites', 'action' => 'index', 'prefix' => 'admin'));
 

// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------    Gestion stocks   -----------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------

Router::connect('/gestion-stocks.html',	array('controller' => 'members', 'action' => 'stocks', 'prefix' => 'member'));
Router::connect('/admin/gestion-stocks.html',	array('controller' => 'users', 'action' => 'stocks', 'prefix' => 'admin'));





// -----------------------------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------    Gestion inventaires   -----------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------

Router::connect('/gestion-inventaires.html',	array('controller' => 'members', 'action' => 'inventaires', 'prefix' => 'member'));
Router::connect('/admin/gestion-inventaires.html',	array('controller' => 'users', 'action' => 'inventaires', 'prefix' => 'admin'));





// -----------------------------------------------------------------------------------------------------------------------

 
// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------    Gestion des absences   -------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------
//   
// Table personnes
// 

Router::connect('/add-absences.html',	array('controller' => 'absences', 'action' => 'ajouter', 'prefix' => 'member'));

Router::connect('/member/absences/rechercher',	array('controller' => 'absences', 'action' => 'rechercher', 'prefix' => 'member'));
// Router::connect('/mes-absences/edit-absences/:id.html',	
// 													array('controller' => 'absences', 'action' => 'modifier', 'prefix' => 'member'),
// 													array('pass' => 
// 																	array('id')),	 
// 																	array('id'=>'[0-9]+')
// 				);

Router::connect('/absences/:type_absence_slug-:id.html',	
														array('controller' => 'absences', 'action' => 'afficher', 'prefix' => 'member'),
														array('pass' => 
																		array('id','type_absence_slug')),	 
																		array('id'=>'[0-9]+',
																			  'type_absence_slug'=>'[a-zA-Z0-9=&\_\-]+'
																			  )
			);



 

// ----------------------------------------------------------------------------------------------------------------------
 
// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------    Gestion des indemnités -------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------
// 
// Table indemnités
// 







// -----------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------    Gestion des personnels -------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------
// 
// Table indemnités
// 

Router::connect('/add-personnels.html',	array('controller' => 'personnes', 'action' => 'ajouter', 'prefix' => 'member'));



// -----------------------------------------------------------------------------------------------------------------------


Router::connect('/mon-profil.html',	array('controller' => 'members', 'action' => 'index', 'prefix' => 'member'));
Router::connect('/deconnection.html',	array('controller' => 'members', 'action' => 'logout'));
Router::connect('/mes-annonces.html',	array('controller' => 'members', 'action' => 'annonces', 'prefix' => 'member'));
/*Router::connect('/mes-annonces/modifier_demande/:id.html',	array('controller' => 'demandes', 
															  'action' => 'modifier_demande', 
															  'prefix' => 'member'),
															array('pass' => array('id')),
															array('id'=>'[0-9]+')
				); */ 

			
Router::connect('/messages.html',	array('controller' => 'members', 'action' => 'messages', 'prefix' => 'member'));
Router::connect('/mes-favoris.html',	array('controller' => 'members', 'action' => 'favoris', 'prefix' => 'member'));

Router::connect('/parrainage.html',	array('controller' =>  'parrainages', 'action' => 'envoyer','prefix' => 'member'));

//pages statiques
Router::connect('/plan-du-site.html',	array('controller' => 'pages', 'action' => 'display','plan-du-site'));
Router::connect('/error404',	array('controller' => 'pages', 'action' => 'display','error404'));

Router::connect('/cgu',	array('controller' => 'articles', 'action' => 'afficher',35));
Router::connect('/mentions-legales.html',	array('controller' => 'articles', 'action' => 'afficher',36));
Router::connect('/nos-magasins.html',	array('controller' => 'articles', 'action' => 'afficher',41));
Router::connect('/emplois.html',	array('controller' => 'articles', 'action' => 'afficher',42));
Router::connect('/partenaires.html',	array('controller' => 'articles', 'action' => 'afficher',44));
Router::connect('/offre-service.html',	array('controller' => 'articles', 'action' => 'afficher',45));
Router::connect('/demande-service.html',	array('controller' => 'articles', 'action' => 'afficher',46));
Router::connect('/:slug.html',
					array('controller' => 'articles','action'=>'view'),
					array( 
							'pass' => array(  
								'slug' 
							) 
						) ,
					 array(
						'slug'=>'[a-zA-Z0-9\-]+',
						)
				);
 
//redirection des pages des FAQs
/*Router::connect('/faq.html',	array('controller' => 'faqs', 'action' => 'index'));
Router::connect('/faq/:slug.html',
					array('controller' => 'faqs','action'=>'categorie'),
					array( 
							'pass' => array(  
								'slug' 
							) 
						) ,
					 array(
						'cfaq_slug'=>'[a-zA-Z0-9\-]+',
						)
				); 	*/
