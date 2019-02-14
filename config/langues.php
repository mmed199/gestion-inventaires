<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

// Encodage
// --------
Configure::write('App.encoding', 'utf-8');
 
// Langues
// -------
 
// Langues acceptées
$languages = array(
	'fr' => 'fre',
	'en' => 'eng'
);
 

/*
 modifier par @LHIADI pour sauvegarder le code de langue dans une session 
 pour eviter certin probleme lié a la traduction
 */ 

//echo $_SERVER['HTTP_HOST'] ; 
App::import('Component', 'Session');
$session = new SessionComponent();
if( ( !$session->check('langCode')  && !$session->check('language') ) || $_SERVER['HTTP_HOST']=="services4all.ma" ) {
// Français par défaut
$langCode = 'fr';
$language = 'fre';
}
if( $_SERVER['SERVER_NAME'] =="www.services4all.ma/en" || $_SERVER['SERVER_NAME']=="services4all.ma/en" ) {
	$langCode = 'en';
	$language = 'eng';
}

// Analyse de l'URL
if(!empty($_GET['url']))
{
	if(strpos($_GET['url'], '/') !== false)
	{
		$langFromUrl = substr($_GET['url'], 0, strpos($_GET['url'], '/'));
	}
	else
	{
		$langFromUrl = $_GET['url'];
	}
 
	// Code langue accepté ?
	if(isset($languages[$langFromUrl]))
	{
		$langCode = $langFromUrl;
		$language = $languages[$langCode];
 
		// On enlève le code langue et le slash au début de l'URL
		// avant qu'elle ne soit transmise au Router
		if(strlen($_GET['url']) > strlen($langFromUrl))
		{
			$_GET['url'] = substr($_GET['url'], strlen($langFromUrl));
		}
		else
		{
			$_GET['url'] = '/';
		}
	}
}
/*$session->write('langCode', $langCode ) ; 
$session->write('language' ,$language );
Configure::write('Config.languages', $languages);
Configure::write('Config.language',  $language);
Configure::write('Config.langCode',  $langCode);*/
?>