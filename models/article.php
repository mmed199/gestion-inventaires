<?php
class Article extends AppModel{
	var $name = 'Article';
	// var $belongsTo = array('Asection'=>array('counterCache'=>true) ) ;
	var $actsAs = array(
						/*'Translate' => array(
							'title'       => 'Titles',
							/* 'slug'       => 'Slugs', */
							/*'content' => 'Contents',
							'scontent' => 'Scontents',
							'meta_title' => 'MetaTitles',
							'meta_description' => 'MetaDescriptions',
							'meta_keywords' => 'MetaKeywords',
							),*/
						'Sluggable' => array(
								'label' => 'title', 
								'translation' => 'utf-8',
								'overwrite' => true
								)							
					);
	var $validate = array(
						'title' => array(
							'rule' => array('minLength', 5)
							 )
						);
    }