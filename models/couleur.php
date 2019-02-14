<?php
class Couleur extends AppModel{

    var $name = 'Couleur';

    var $displayField = 'name' ;

    var $hasMany = array('Vehicule') ;

}