<?php

class Division extends AppModel{

	var $name = 'Division';

	var $displayField = 'nom';
	
	var $hasMany = array('Member') ;
	
    }