<?php

// Routes for standard actions

Router::connect(
	'/login', 
	array(
		'plugin' 		=> 'mylogin', 
		'controller' 	=> 'users', 
		'action' 		=> 'login'
	)
);

Router::connect(
	'/logout',
	array(
		'plugin' 		=> 'mylogin', 
		'controller' 	=> 'users', 
		'action' 		=> 'logout'
	)
);

Router::connect(
	'/register',
	array(
		'plugin' 		=> 'mylogin', 
		'controller' 	=> 'users', 
		'action' 		=> 'register'
	)
);

Router::connect(
	'/forgotten_password',	
	array(
		'plugin' 		=> 'mylogin', 
		'controller' 	=> 'users', 
		'action' 		=> 'forgotten_password'
	)
);

