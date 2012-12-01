<p>Olá, <strong><?= $data['name'] ?></strong> <br/>
Seja bem vindo, você se cadastrou no site <?= Configure::read('Config.nome') ?> ( <?= Configure::read('Config.site') ?> ). 
</p>
<br/>
<p>Abaixo informações do seu cadastro: </p>

<p>=============================================== <br/>
 D A D O S <br/>
=============================================== 
</p>
<p>NOME: <?= $data['name'] ?> <br/>
E-MAIL/LOGIN: <?= $data['username'] ?> <br/>
SENHA: *********** 
</p> 
 