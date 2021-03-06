<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Storybox',
  'theme'=>'classic',

	// preloading 'log' component
	'preload'=>array(
	  'log',
	  'bootstrap'
	),
  'aliases' => array(
    // yiistrap configuration
    'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change if necessary
    // yiiwheels configuration
    'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), // change if necessary
  ),
  
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
	  'bootstrap.helpers.TbHtml',
	  'bootstrap.helpers.TbArray',
	  'bootstrap.behaviors.TbWidget',
		'application.components.*',
	  'application.modules.user.models.*',
	  'application.modules.user.components.*',
	  'application.modules.rights.*',
	  'application.modules.rights.components.*',
	  'application.helpers.*',
	   
	),

	'modules'=>array(
	  'cal'=>array('debug'=>true),
	  Yii::setPathOfAlias('efullcalendar', dirname(__FILE__) . '/../extensions/efullcalendar'),
	  
	  'rights'=>array(
	   // 'install'=>true,
	  ),
	   
	  'user'=>array(
	    # encrypting method (php hash function)
	    'hash' => 'md5',
	    # send activation email
	  'sendActivationMail' => false,
	    # allow access for non-activated users
	    'loginNotActiv' => false,
	    # activate user on registration (only sendActivationMail = false)
	    'activeAfterRegister' => true,
	  # automatically login from registration
	      'autoLogin' => true,
	      # registration path
	  'registrationUrl' => array('/user/registration'),
      # recovery password path
	  'recoveryUrl' => array('/user/recovery'),
	    # login form path
    'loginUrl' => array('/user/login'),
    # page after login
	    'returnUrl' => array('/user/profile'),
 
	    # page after logout
	  'returnLogoutUrl' => array('/user/login'),
	    ),
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array('bootstrap.gii'),
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('14.39.156.111','::1'),
		),
		
	),

	// application components
	'components'=>array(
	'image'=>array(
	  'class'=>'application.extensions.image.CImageComponent',
	  // GD or ImageMagick
	  'driver'=>'GD',
	  // ImageMagick setup path
	  'params'=>array('directory'=>'/usr/bin/convert'),
	),
		'user'=>array(
			// enable cookie-based authentication
//		  'class'=>'RWebUser',
    	'class' => 'WebUser',
    	'allowAutoLogin'=>true,
    	'loginUrl' => array('/user/login'),
		),
		'bootstrap' => array(
		  'class' => 'bootstrap.components.TbApi',
		),
		// yiiwheels configuration
		'yiiwheels' => array(
		  'class' => 'yiiwheels.YiiWheels',
		),
		'authManager'=>array(
		  'class'=>'RDbAuthManager',
		),
	/*	
 		'bootstrap' => array(
		  'class' => 'ext.yii-booster.components.Bootstrap',
		), 
*/

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
		//		'places/page/<page:\d+>'=>'places/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),
		),
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=storybox',
			'emulatePrepare' => true,
			'username' => 'lepl',
			'password' => 'lepl',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'therichu@gmail.com',
	),
);