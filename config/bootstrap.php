<?php
// Gestion des langues
include_once(dirname(__FILE__).'/langues.php');

// MySQL : une recherche en langage naturel.====>'natural' ou 'patternMatching'
Configure::write('Search.mode', 'patternMatching');

/*CakePHP's default inflection rules think that Taches is the plural form of Tach.
You'll need to use the Inflector class to add a custom inflection*/
Inflector::rules('plural', array('irregular' => array('tache' => 'taches')));

/*Configure::write('Search.mode', 'patternMatching');

Configure::write('Search.withQueryExpansion', false);*/

/*Configure::write('Search.allowedChars', array(' '));*/
?>