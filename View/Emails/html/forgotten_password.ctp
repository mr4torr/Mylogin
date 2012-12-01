<p>Olá <strong><?php echo $data['name']; ?></strong>,</p>

<p>Alguém (provavelmente você) solicitou uma redefinição de senha em sua conta. Para redefinir sua senha, clique no link abaixo:</p>

<p><?php echo Router::url(array('action' => 'change_password', 'password_reset' => $data['token']), true) ?></p>


<p>Se você tem alguma duvida, por favor envie um e-mail para <?= Configure::read('Config.email') ?> e nós faremos nosso melhor para ajudá-lo.</p> 


