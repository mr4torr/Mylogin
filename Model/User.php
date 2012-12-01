<?php
//App::uses('MyloginAppModel', 'Mylogin.Model');

class User extends MyloginAppModel {
//	public $name = 'User';
	
		var $validate = array(
			'name' => array(
				'rule'=>'notEmpty',
				'message'=>'Preencha seu nome de exibição.'
			),
			'username' => array(
				'username'	 	=>	  array('rule'=>'email','message'=>'Preencha com um endereço eletrônico válido.'),
				'isUnique' => array('rule' => 'isUnique','message'=>'Esse nome de usuário já está em uso, tente outro.'),
			),
			'password' => array(
				'comparaSenhaVazio' => array(
								'rule' 		=> 'comparaSenhaVazio',
								'message'	=>'Este campo não pode ser deixado em branco.'
							),
				'comparison' => array(
								'rule' 		=> 'comparaSenha',
								'message'	=>'Por favor use uma senha mais segura. diferente de: 123456, 654321, etc...'
							),
				'validatePassword' => array(
								'rule' 		=> 'validatePassword',
								'message'	=>'Sua senha não combina com a da confirmação!'
							),
				'minLength' => array(
								'rule' => array('between', 8, 20),
//								'rule' 		=> array('minLength', 6),
								'message'	=> 'No minimo 8 caracteres'
				)
			),
			'check_user' => array(
		               'rule' => array('comparison', '!=', 0),
		               'required' => true,
		               'message' => 'Você deve concordar com os termos de uso',
		               'on' => 'create'
		      )
			
		);



		function beforeSave() {

		    if (isset($this->data[$this->name]['password'])) 
		    {
		        $this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);
		    }
			return true;
		}

		function comparaSenhaVazio()
		{
			if($this->data[$this->name]['password'] != ''){
				return true;
			}else{
				return false;
			}
		}


		function comparaSenha(){

			$senhaBasicas = array(
								'123', 
								'456', 
								'789', 
								'321', 
								'654', 
								'987', 
								'123456', 
								'123456789', 
								'987654321', 
								'654321', 
								'456789', 
								'987654', 
								'159357', 
								'159753', 
								'abc123', 
								'123abc', 
								'abcdef',
								'fedcba',
								'zxcvbn',
								'asdfgh',
								'qwerty',
			);

			$array = in_array($this->data[$this->name]['password'], $senhaBasicas);

			if($array){
				return false;
			}else{
				return true;
			}
		}


		function validatePassword(){
			$passed=true;
			if(isset($this->data[$this->name]['password_confirm']))
			{
				if($this->data[$this->name]['password'] != $this->data[$this->name]['password_confirm'])
				{
					$this->invalidate('checkpassword');
					$passed = false;
				}else{
					unset($this->data[$this->name]['password_confirm']);
				}
			}
			return $passed;
		}

}

