<div class="container">

	<div class="row">
		<div class="span4 offset4">
			<center><h4>Crie uma nova conta</h4></center>
			<?php
				echo $this->Session->flash();
				echo $this->Form->create('User');
				echo $this->Form->input("name", array('label' => 'Nome do usuário', 'class' => 'span4'));
				echo $this->Form->input("username", array('label' => 'Email / Login', 'class' => 'span4'));
				echo $this->Form->input("password", array('label' => 'Senha', 'class' => 'span4'));
				echo $this->Form->input("password_confirm", array('label' => 'Confirme a Senha','type'	=> 'password', 'class' => 'span4'));
				$input_check 	= $this->Form->checkbox("check_user", array('label' => false, 'escape' => false));
				$link_check		= $this->Html->link('Termos e Condições', '/pages/termos_e_condicoes', array('target' => '_blank'));
				$text_check 	= ' Eu li e concordo com os '.$link_check;
				$text_check		.= $this->Form->error('check_user');
				echo $this->Form->label('check_user', $input_check.$text_check, array('class' => 'checkbox'));

				echo '<hr/>';
				echo $this->Form->button(" Registrar", array("class" => "btn btn-success"))." &nbsp;  &nbsp;  &nbsp;  &nbsp; ".$this->Html->link('Opa eu tenho login e senha.', array('action' => 'login'));

				echo $this->Form->end();

		?>

		</div>

		
	</div>



