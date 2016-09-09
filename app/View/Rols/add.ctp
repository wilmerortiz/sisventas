<div class="rols form">
<?php echo $this->Form->create('Rol'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Rol'); ?></legend>
		<?php echo $this->Form->input('descripcion', ['class'=>'form-control']); ?>
		<?php echo $this->Form->hidden('estado',['value'=>'A'])?>
	</fieldset>
	<br>
	<?php echo $this->Form->button('Guardar', ['class'=>'btn btn-primary btn-a'])?>
	<?php echo $this->Html->link(__('Volver'), array('action' => 'index'), ['class'=>'btn btn-default']); ?>
<?php echo $this->Form->end(); ?>
</div>

