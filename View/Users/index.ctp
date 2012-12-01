<div class="container">
	<div class="row">
		
		
		<div class="span4">
			<h1>Usuários</h1>
		</div>
		<div class="span4">
			<br/>
			
			<?php
				echo  $this->Form->create('Search', array('class' => 'form-inline'));
				echo '<div class="clearfix">';
				echo $this->Form->text("name", array('placeholder' => 'Buscar'));
				echo ' '.$this->Form->button('<i class="icon-search icon-white"></i>', array("class" => "btn btn-info"));
				echo '</div>';
				echo $this->Form->end();
			?>
		</div>
		<div class="span4">
			<br/>
			<?= $this->Html->link('Novo', array('action' => 'add'), array('class' => 'pull-right btn'))?>
		</div>
	</div>
	<br/>
	<br/>
	
	<?php foreach($users as $user): 
		if($user['User']['active'] == 1): $n_st = 0; $btn_st = 'btn-success'; $st = '#8CC73E'; else:  $n_st = 1; $btn_st = 'btn-danger'; $st = '#DD4B39'; endif;
		?>
		<div class="row">
			<div class="span5">
				<b><?= $user['User']['name'] ?></b>
			</div>
			<div class="span4">
				<?= $user['User']['username'] ?>
			</div>
			<div class="span3">
				<?php if($user['User']['role'] != 'admin'): ?>
					<?= $this->Html->link('Status', array('action' => 'active', $user['User']['id'], $n_st), array('class' => 'btn btn-small '.$btn_st)) ?>

				<?= $this->Html->link('Editar', array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-small'))?>
				<?= $this->Html->link('Excluir', array('action' => 'del', $user['User']['id']), array('class' => 'btn btn-small'), 'Você realmente deseja excluir esta arquivo?') ?>
			<?php endif ?>
			</div>
		</div>
		<hr/>
	<?php endforeach; ?>

</div>
