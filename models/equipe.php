<?php

class Equipe extends AppModel{

	var $name = 'Equipe';
	
	var $hasMany = array('Member') ;

	var $belongsTo = array('Projet');
	
    }