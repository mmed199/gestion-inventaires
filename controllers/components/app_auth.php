<?php
App::import('Component', 'Auth');
 
class AppAuthComponent extends AuthComponent
{
	/**
	 * Configuration par défaut
	 *
	 * @var array
	 */
	var $defaults = array(
		'userModel'      => 'User',
		'userScope'      => null,
		'fields'         => null,
		'loginAction'    => null,
		'loginRedirect'  => null,
		'logoutRedirect' => null,
		'autoRedirect'   => true,
		'loginError'     => "Identifiant ou mot de passe incorrects.",
		'authError'      => "Veuillez se connecter afin d'accéder à cette page."
	);
 
	/**
	 * Configurations possibles en fonction du préfixe de la route
	 *
	 * @var array
	 */
	var $configs = array(
		'admin' => array(
			'userModel'      => 'User',
			'userScope'      => array('User.role'=>2),
			'fields'         => array('username' => 'email', 'password' => 'password'),
			'loginAction'    => array('controller' => 'users', 'action' => 'login', 'admin' => true),
			'loginRedirect'  => array('controller' => 'users', 'action' => 'home', 'admin' => true),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'admin' => true),
		),
		'com' => array(
			'userModel'      => 'User',
			'userScope'      => array('User.role'=>1),
			'fields'         => array('username' => 'email', 'password' => 'password'),
			'loginAction'    => array('controller' => 'users', 'action' => 'login', 'com' => true),
			'loginRedirect'  => array('controller' => 'users', 'action' => 'home', 'com' => true),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'com' => true),
		),
		'member' => array(
			'userModel'      => 'Member',
			'userScope'      => array('Member.disabled' => 0),
			'fields'         => array('username' => 'email', 'password' => 'password'),
			'loginAction'    => array('controller' => 'members', 'action' => 'connexion', 'member' => false),
			'loginRedirect'  => array('controller' => 'members', 'action' => 'home', 'member' => true),
			'logoutRedirect' => array('controller' => 'members', 'action' => 'connexion', 'member' => false),
		),
		'system' => array(
			'userModel'      => 'User',
			'userScope'      => array('User.role' =>3),
			'fields'         => array('username' => 'email', 'password' => 'password'),
			'loginAction'    => array('controller' => 'users', 'action' => 'login', 'system' => true),
			'loginRedirect'  => array('controller' => 'users', 'action' => 'index', 'system' => true),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'system' => true),
		),
	);
 
	/**
	 * Démarrage du composant.
	 * Autorisation si pas de préfixe dans la Route qui a conduit ici.
	 *
	 * @param object $controller Le contrôleur qui a appelé le composant.
	 */
	function startup(&$controller)
	{
		$prefix = null;
		if(empty($controller->params['prefix']))
		{
			$this->allow();
		}
		else
		{
			$prefix = $controller->params['prefix'];
			if($prefix == 'admin' && $this->Session->read('Auth.User.role') != 2  && $controller->params['action'] !='admin_login' ){
									header('location: /admin/users/login') ;
				}
		}
 
		// Cas spécial des actions de login et logout, pour lesquelles le préfixe n'existe pas
		if(in_array($controller->action, array('login', 'logout')))
		{
			switch($controller->name)
			{
				case 'Users':
					$prefix = 'admin';
					break;
				case 'Members':
					$prefix = 'membres';
					break;
			}
		}
 
		$this->_setup($prefix);
 
		parent::startup($controller);
	}
 
	/**
	 * Définition des variables de config en fonction d'un préfixe
	 *
	 * @param string $prefix
	 */
	function _setup($prefix)
	{
		$settings = $this->defaults;
 
		if(array_key_exists($prefix, $this->configs))
		{
			$settings = array_merge($settings, $this->configs[$prefix]);
		}
 
		$this->_set($settings);
	}
}
?>