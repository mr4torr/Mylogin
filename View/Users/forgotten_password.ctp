<div class="container">

	<div class="row">
		<div class="span6 offset3">
			<center><h4>Esqueci a minha senha</h4></center>
			<hr/>
			<?php
				echo $this->Session->flash();

				echo $this->Form->create('User');
				echo '<div class="row">'; 
					
				echo $this->Form->input(
					'username',
					array(
						'class' => 'span5',
						'div'	=> 'span5',
						'label' => __('E-mail / Login'),
					)
				);

				echo '<div class="span1" style="padding-top:24px">'.$this->Form->button("Enviar", array("class" => "btn btn-success")).'</div>';

				echo '</div>';
				echo '<hr/>';
				
				echo $this->Html->link('Se inscrever', array('action' =>'register')). ' | ';
				echo $this->Html->link('Opa eu tenho login e senha.', array('action' => 'login'));

				echo $this->Form->end();
			?>
		</div>
	</div>
</div>
