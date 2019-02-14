<?php

class Vehicule extends AppModel{

    var $name = 'Vehicule'; 

	var $belongsTo = array('Category','Marque','Modele','Type','Couleur','Annee','User');

	var $displayField = 'name' ;

	/*var $actsAs = array(
						'MeioUpload' => array( 
								'photo' => array( 
									'dir' => 'uploads/vehicules',
									'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
									'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif'),
									'default' => 'default.jpg',
									'max_size' => '8 Mb',
										)
								)
								
					);*/
}