<?php

class MyloginAppController extends AppController {


	function beforeFilter()
	{
		parent::beforeFilter();
		$this->auth = $this->Auth->user();
		
		$this->set('auth', $this->auth);
	}


	
}

