<div class="container">
	<div class="row">

		<div class="span6">
			<h1>Cadastrar usuario</h1>
		</div>
		<div class="span6">
			<br/>
			<?= $this->Html->link('<i class="icon-chevron-left"></i> <span>Voltar</span>', array('action' => 'index'), array('escape' => false, 'class' => 'btn pull-right', 'title' => 'Voltar')) ?>
		</div>
	</div>
	<hr/>
	
	<div class="row">
		<div class="span4 offset4">
			<?php
				echo $this->Form->create('User');
				echo $this->Form->input('name', array('label' => __('Nome do usuário')));
				echo $this->Form->input('username', array('label' => __('Email / Login')));
				echo $this->Form->input('password', array('label' => __('Senha')));
				echo $this->Form->input('password_confirm', array('label' => __('Confirme a Senha'), 'type' => 'password'));

				if(in_array($auth['role'], array('admin', 'manager'))):
					echo $this->Form->input('role',
						array(
							'label' => __('Nivel'),
							'options' => array(
								'visitor' 	=> 'Visitante', 
								'publisher' => 'Editor', 
								'manager' 	=> 'Gerente', 
				//				'admin' 	=> 'Administrador'
							),
							'default' => 'publisher'
						)
					);
				endif;

				echo $this->Form->button('Cadastrar', array('class' => 'btn btn-success'));
				echo $this->Form->end() 

			?>
		</div>
	</div>
	

</div>
</div> <!-- #painel_manager --> 
