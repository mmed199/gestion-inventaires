<?php

class Fournisseur extends AppModel{
   var $name = 'Fournisseur';

		var $displayField = 'name'; 

		var $hasMany = array('Materiel') ; 

		
	


}