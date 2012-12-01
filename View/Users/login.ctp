<div class="container">

	<div class="row">

		<div class="span4 offset4">
			<h4 style="text-align:center">Por favor digite seu login e senha</h4>
			<hr/>
			<?php
				echo $this->Session->flash();
				echo $this->Session->flash('auth');
				echo $this->Form->create('User');
				echo $this->Form->input("username", array('label' => 'Login', 'class' => 'span4'));
				echo $this->Form->input("password", array('label' => 'Senha', 'class' => 'span4'));
			
				echo $this->Form->label(
					'remember_me', 
					$this->Form->checkbox("remember_me", array('default' => 1)).' Mantenha-me conectado ', 
					array(
						'class' => 'checkbox'
					)
				);
				echo $this->Html->tag('hr');

				$btns = "<br/>".$this->Form->button("Entrar", array("class" => "btn"))." &nbsp; &nbsp; "
				.$this->Html->link('Se inscrever', array('action' => 'register')). ' | '
					.$this->Html->link('Esqueceu sua senha?', array('action' => 'forgotten_password'));

				echo $btns.$this->Form->end();
		?>
		</div><!-- .span6 -->
	</div> <!-- .row -->
</div>