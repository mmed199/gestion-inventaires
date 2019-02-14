<?php

class Tache extends AppModel{

	var $name = 'Tache';
	
	var $hasMany = array('Member') ;

	var $belongsTo = array('User');
	
    }  