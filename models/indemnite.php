<?php

class Indemnite extends AppModel{

	var $name = 'Indemnite';
	
	var $belongsTo = array('Depense','City');
	
    }  