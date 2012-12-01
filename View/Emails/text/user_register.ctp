Olá, <?= $data['name'] ?>
Seja bem vindo, você se cadastrou no site <?= Configure::read('Config.nome') ?> ( <?= Configure::read('Config.site') ?> ). 


Abaixo informações do seu cadastro: 

=============================================== 
 D A D O S 
=============================================== 

NOME: <?= $data['name'] ?> 
E-MAIL/LOGIN: <?= $data['username'] ?> 
SENHA: *********** 
