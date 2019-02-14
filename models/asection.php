<?php
class Asection extends AppModel{
    var $name = 'Asection';
	var $hasMany = array('Article') ;
	var $actsAs = array(
						'Translate' => array(
							'title'       => 'Titles',
							), 
						'Sluggable' => array(
								'label' => 'title', 
								'translation' => 'utf-8',
								'overwrite' => true
								)							
					);
}