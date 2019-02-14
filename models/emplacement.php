<?php

class Emplacement extends AppModel{

    var $name = 'Emplacement'; 

	var $displayField = 'nom' ;
	var $hasMany = array('Materiel') ; 

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
