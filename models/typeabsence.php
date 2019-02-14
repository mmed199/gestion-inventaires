<?php
class Typeabsence extends AppModel{
    var $name = 'Typeabsence';
	var $hasMany = array('Absence') ;
	var $actsAs = array(
						'Sluggable' => array(
								'label' => 'title', 
								'translation' => 'utf-8',
								'overwrite' => true
								)							
					);
}