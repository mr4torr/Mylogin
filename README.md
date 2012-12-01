#MYLOGIN é um plugin de autenticação simples para cakephp 2.0.x#

E isso é feito usando o novo cakephp 2.0.x AuthComponent

Versão Alpha

Mylogin é uma CakePHP 2.0 Sistema de Gerenciamento de usuários,
Autenticação e autorização

###INSTALAÇÃO###

* Baixe a versão mais recente ou utilizar git para manter o plugin atualizado

cd yourapp/app/Plugin
git clone git://github.com/mailontorres/Mylogin.git Mylogin


* Importação do banco (use sua ferramenta favorita sql para importar o banco)

yourapp/app/Plugin/Mylogin/config/Schema/dump.sql

* Configure o componente em sua classe AppController

Seu yourapp/app/Controller/AppController.php deve ficar assim:

    <?php
        classe AppController Controller extends {
		    public $components = array(
                'Session',
                'Auth' => array(
                    'loginAction' => array('plugin' => 'mylogin', 'controller' => 'users', 'action' => 'login'),
                    'logoutRedirect' => array('plugin' => 'mylogin', 'controller' => 'users', 'action' => 'login'),
                    'loginRedirect' => array('controller' => 'establishments', 'action' => 'index', 'plugin' =>false),
                    'authenticate' => array('Form' => array('userModel' => 'Mylogin.User', 'fields' => array('username' => 'username', 'password' => 'password')))
                )
            );
        
		...


* Ativar Plugin no bootstrap `yourapp/app/config/bootstrap.php` deve incluir no arquivo.

        <?php
        ...
        
		CakePlugin::loadall(array(
            'Mylogin' => array('router' => true),
        ));
        
        ...


* Ajustar a configuração do envio de e-mail no arquivo `yourapp/app/config/email.php`

* Criar um usuário no link http://localhost/seuapp/register


####Tudo pronto!####


##LINK DO ROUTER##

* yourapp/login ( fazer login )

* yourapp/register ( registrar )
Se for um sistema interno aonde só o administrador pode cadastrar retire "register" na function beforeFilter do arquivo `yourapp/app/Plugin/Mylogin/Controller/UsersController.php`
    
	$this->Auth->allow('login', 'logout', 'register', 'forgotten_password', 'change_password');

POR

    $this->Auth->allow('login', 'logout', 'forgotten_password', 'change_password');


* yourapp/logout ( sair do sistema )
Link para logout 
    
	echo $this->Html->link('Sair', array('controller' => 'users', 'action' => 'logout', 'plugin' => 'mylogin'));

OU

    echo $this->Html->link('Sair', '/logout');


* yourapp/forgotten_password ( esqueci a senha )

* yourapp/mylogin/users ( lista todos os usuário )
