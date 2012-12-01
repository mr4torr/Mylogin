<div class="container">
	<div class="row">
		<div class="span6">
			<h1 id="alterar_senha">Alterar Senha</h1>
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
				echo $this->Form->input('password',array('label' => __('Senha'),'value'	=> ''));
				echo $this->Form->input('password_confirm',array('label' => __('Confirme a Senha'),'value'	=> '','type' => 'password'));
				echo $this->Form->button("Salvar", array("class" => "btn btn-success"));
				echo $this->Form->end();
			?>	
		</div>
		<div class="span3">
			<br/><br/>
			
			<center>
				<p>Se deseja seu dados clique no botão a baixo.</p> 
				<?= $this->Html->link('Editar dados', array('action' => 'edit'), array('class' => 'btn')); ?>
			</center>
		</div>
		
	</div>
	
</div>

