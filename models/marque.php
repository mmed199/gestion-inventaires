<?php
 
class Marque extends AppModel{

    var $name = 'Marque';

	var $displayField = 'name' ;
	
	var $hasMany = array('Vehicule') ; 

	var $validate = array(
							'name' => array(
											'rule' => array('minLength', 2)
											 )
							);
		
	var $actsAs = array(
				
					'Sluggable' => array(
									'label' => 'name', 
									'translation' => 'utf-8',
									'overwrite' => true
									),
				
				
					'MeioUpload' => array( 
							'logo' => array( 
								'uploadName' => 'slug',
								'dir' => 'uploads/marques',
								'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
								'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif'),
								'default' => 'default.jpg',
								'max_size' => '8 Mb',
							)
						)
						
					);
				
}