<?php
class Article extends AppModel{
        var $name = 'Article';
		/*
		var $actsAs = array(
						'Translate' => array(
							'title'       => 'Titles',
							'scontent' => 'Scontents',
							'content' => 'Contents',
								),
								
					);
		*/
		
		/* var $belongsTo = array(							
							'Member' => array(					
									'className' => 'Member',			
									'foreignKey' => 'member_id'					
								)); */
		
		var $validate = array(
							'title' => array(
											'rule' => array('minLength', 3),
											'message' => 'Le Titre de la page doit avoir au moins 3 caractères.'
											 )
							);
    }