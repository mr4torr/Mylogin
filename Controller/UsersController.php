<?php
//App::uses('MyloginAppController', 'Mylogin.Controller');
/**
 * Users Controller
 *
 */
class UsersController extends MyloginAppController {

//	var $uses = array('Mylogin.User');
	var $components = array('Cookie', 'Session');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register', 'forgotten_password', 'change_password');
    }

	public function register(){

	 	if ($this->request->is('post')) 
		{
	            $this->User->create();
				$this->request->data['User']['token'] = String::uuid();

	            if ($this->User->save($this->request->data)) 
				{
					
					$this->request->data['User']['id'] = $this->User->id;

					$data = $this->request->data['User'];
					App::uses('CakeEmail', 'Network/Email');
					$email = new CakeEmail('smtp');
					$email->template('Mylogin.user_register', 'default')
					    ->emailFormat('text')
						->to($data['username'])
						->subject('Bem vindo ao '.Configure::read('Config.nome'))
						->viewVars(array('data' => $data))
					    ->send();

			        if ($this->Auth->login($this->request->data['User'])) 
					{
			            $this->Session->setFlash('Usuário criado com sucesso. Seja bem vindo ao '.Configure::read('Config.nome').'.', 'default', array('class' => 'alert alert-success'));
			            $this->redirect($this->Auth->redirect());
			        }

	            } else {
		            $this->Session->setFlash('<b>Opa!</b> Aconteceu algo errado verifique os dados abaixo.', 'default', array('class' => 'alert alert-error'));
	            }
        }
	} // END FUNCTION



	public function forgotten_password() {
		if ($this->request->is('post')) {
				$user = $this->User->findByUsername($this->request->data['User']['username']);
				if($user):
					if($user['User']['active'] == 1):
						$data = $user['User'];
						App::uses('CakeEmail', 'Network/Email');
						$email = new CakeEmail('smtp');
						$verfic_email = $email->template('Mylogin.forgotten_password', 'default')
//						    ->emailFormat('text')
							->to($data['username'])
							->subject('Esqueci a senha')
							->viewVars(array('data' => $data))
						    ->send();
						
							$this->Session->setFlash('Foi enviado um email com instruções para alterar sua senha.', 'default', array('class' => 'alert alert-success'));
					else:
	            		$this->Session->setFlash('Usuário inativo.', 'default', array('class' => 'alert alert-error'));
					endif;
				else:
	            	$this->Session->setFlash('O usuário não existe.', 'default', array('class' => 'alert alert-error'));
				endif;
				
		}
		
	} // END FUNCTION



	public function change_password() {

		if ($this->params['named']['password_reset']) {
				$this->User->recursive = -1;
				$user = $this->User->findByToken($this->params['named']['password_reset']);
				if($user):
					if($user['User']['active'] == 1):
						$this->User->id = $user['User']['id'];
						$this->User->saveField('token', String::uuid());
						$this->Session->setFlash('Esta chave é válida somente para um único acesso, altere sua senha.', 'default', array('class' => 'alert alert-success'));

						$this->Auth->login($user['User']);
						$this->redirect($this->Auth->redirect());
					else:
            			$this->Session->setFlash('Usuário inativo.', 'default', array('class' => 'alert alert-error'));
					endif;
				else:
					$this->Session->setFlash('Chave inválida. Verifique novamente seu e-mail.', 'default', array('class' => 'alert alert-error'));
				endif;
		}
		$this->redirect(array('action' => 'login'));
	} // END FUNCTION


	public function login() 
	{
		if ($this->request->is('post')) {
          	$this->Cookie->write('username', $this->request->data['User']['username'], true, '+2 weeks');

	        if ($this->Auth->login()) {

				if (empty($this->request->data['User']['remember_me']))
                {
                     $this->Cookie->delete('user');
                }
                else
                {
		
                    $cookie = $this->Auth->user();
                    $this->Cookie->write('user', $cookie, true, '+2 weeks');

                }

                unset($this->request->data['User']['remember_me']);
				
				if(isset($this->request->query['redir'])){
		            $this->redirect($this->request->query['redir']);
				}else{
		            $this->redirect($this->Auth->redirect());
				}
	        } else {
	            $this->Session->setFlash('<center>Usuário ou senha inválida.</center>', 'default', array('class' => 'alert'));
	        }
	    }else{

	        if($this->Cookie->read('username'))
			{
				$this->request->data['User']['username'] = $this->Cookie->read('username');
			}
		      if(!$this->Auth->user('id'))
		       {
				     // cookie autologin
		              $cookie = $this->Cookie->read('user');
		               if($cookie)
		               {
		                   $this->Auth->login($cookie);
			               $this->redirect($this->Auth->redirect());
		               }
		       }else{
	            	$this->redirect($this->Auth->redirect());
				}
		}	
	} // END FUNCTION


	
	public function logout() {
		$this->Session->destroy();
		$this->Cookie->destroy();
	    $this->redirect($this->Auth->logout());
	}
	
	
	
	
	
		public function edit($id = null) {
			
		 	if ($this->request->is('put')):
				if($this->User->save($this->request->data)):
					
	            	$this->Session->setFlash('Dados alterado com sucesso.', 'default', array('class' => 'alert alert-success'));

					if($this->request->data['User']['id'] == $this->Auth->user('id')){
						$u = $this->User->read();
						$this->Auth->login($u['User']);
					}
					$this->redirect(array('action' => 'edit', $id));
				endif;
			else:
				
				if($this->Auth->user('id') == $id OR in_array($this->Auth->user('role'), array('admin', 'manager'))){
					if(empty($id)) $id = $this->Auth->user('id');
					$this->User->id 		= $id;
					$this->User->recursive	= -1;
					$this->request->data	= $this->User->read();
					if(!$this->request->data) $this->redirect('/');
				}else{
					$this->redirect('/');
				}
			
			endif;

		}

		public function password($id = null) {

				
		 	if ($this->request->is('put')):
				if($this->User->save($this->request->data)):

		            $this->Session->setFlash('Senha alterada, no próximo acesso você deve utilizar esta nova senha.', 'default', array('class' => 'alert alert-success'));

					$this->redirect(array('action' => 'password'));

				endif;
			else:

				if($this->Auth->user('id') == $id OR in_array($this->Auth->user('role'), array('admin', 'manager'))){
					if(empty($id)) $id = $this->Auth->user('id');
					$this->User->id 		= $id;
					$this->User->recursive	= -1;
					$this->request->data	= $this->User->read();
					if(!$this->request->data) $this->redirect('/');
				}else{
					$this->redirect('/');
				}
				

			endif;


		}

		/* #-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#
		-#
		-#	M A N A G E R
		-#
		-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#- */
		public function index(){
			
				if(!in_array($this->Auth->user('role'), array('admin', 'manager'))) $this->redirect(array('action' => 'edit'));

				$conditions = array();
				$this->set('title_for_layout', 'Usuários');

				if(isset($_GET['pesquisa']) && $_GET['pesquisa'] == 'delete')
				{
					$this->Session->delete('Search.User');
				}

					
				if(isset($this->request->data['Search']))
				{

					if(!empty($this->request->data['Search']['name']))
					{
						$conditions = array_merge(
								$conditions, 
								array('User.name LIKE "%'.$this->request->data['Search']['name'].'%"')
							);
					}

					$this->Session->write('Search.User.conditions', $conditions);
					$this->Session->write('Search.User.data', $this->request->data['Search']);

				}else{
					if($this->Session->read('Search.User')){
						$conditions = $this->Session->read('Search.User.conditions');
						$this->request->data['Search'] = $this->Session->read('Search.User.data');
					}
				}
			

				$this->paginate = array('limit' => 10, 'conditions' => $conditions, 'recursive' => -1);
				$users 			=  $this->paginate('User');
				$this->set('users', $users);
							
		}


		/* -- O administrador cria o usuario e envia um e-mail com login e senha  -- */
		public function add(){
				if(!in_array($this->Auth->user('role'), array('admin', 'manager'))) $this->redirect(array('action' => 'edit'));
			
			 	if ($this->request->is('post')) 
				{
		            $this->User->create();
					$this->request->data['User']['token'] 				= String::uuid();
					$this->request->data['User']['active'] 				= 1;
					$this->request->data['User']['check_user'] 			= 1;

		            if ($this->User->save($this->request->data)) 
					{

			            $this->Session->setFlash('Usuário criado com sucesso.', 'default', array('class' => 'alert alert-success'));
						$this->redirect($this->referer());

		            } else {
			            $this->Session->setFlash('<b>Opa!</b> Aconteceu algo errado verifique os dados abaixo.', 'default', array('class' => 'alert alert-error'));
		            }
		        }			
		}
	
	
		function del($id){
			if(!in_array($this->Auth->user('role'), array('admin', 'manager'))) $this->redirect(array('action' => 'edit'));
		
			if($this->User->delete($id)){
				$this->Session->setFlash('Excluído com sucesso.');
				$this->redirect($this->referer());
			}
		
		}

		function active($id, $st){
			if(!in_array($this->Auth->user('role'), array('admin', 'manager'))) $this->redirect(array('action' => 'edit'));
		
			$this->User->id = $id;
			$this->User->saveField('active', $st);
			$this->redirect($this->referer());
		
		}	
	
	
}
