<div class="container">
	<div class="row">
		<div class="span6">
			<h1 id="alterar_senha">Alterar Dados</h1>
			
		</div>
		<div class="span6"><br/>
			<?php if(in_array($auth['role'], array('admin', 'manager'))): ?>
			<?= $this->Html->link('<i class="icon-chevron-left"></i> <span>Voltar</span>', array('action' => 'index'), array('escape' => false, 'class' => 'btn pull-right', 'title' => 'Voltar')) ?>
			<?php endif ?>
		</div>
	</div>
	
	<div class="row">
		<div class="span4 offset3">

<?php
	echo $this->Form->create('User');
	echo $this->Form->hidden('id');
	echo $this->Form->input('name', array('label' => __('Nome do usuário')));
	echo $this->Form->input('username', array('label' => __('Email / Login')));

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

	echo $this->Form->button('Salvar', array('class' => 'btn btn-success'));
	echo $this->Form->end();
	
	
?>
		</div>
		<div class="span3">
			<br/><br/><br/><br/>
			
			<center>
				<p>Se deseja alterar a senha clique no botão a baixo.</p> 
				<?= $this->Html->link('Trocar a senha', array('action' => 'password'), array('class' => 'btn')); ?>
			</center>
		</div>
		
	</div>
</div>

