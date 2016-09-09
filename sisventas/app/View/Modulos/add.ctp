<div class="rols form">
<?php echo $this->Form->create('Modulo'); ?>
	<fieldset>
		<legend><?php echo __('Agregar Modulo'); ?></legend>
		<?php echo $this->Form->input('modulos', ['type'=>'text','class'=>'form-control']); ?>
        <?php echo $this->Form->input('url', ['class'=>'form-control']); ?>
        <?php echo $this->Form->input('modulo_id',['name'=>'data[Modulo][id_padre]','empty'=>'seleccione...','label'=>'Modulo Padre','class'=>'form-control']); ?>
		<?php echo $this->Form->hidden('estado',['value'=>'A'])?>
	</fieldset>
	<br>
	<?php echo $this->Form->button('Guardar', ['class'=>'btn btn-primary btn-a'])?>
	<?php echo $this->Html->link(__('Volver'), array('action' => 'index'), ['class'=>'btn btn-default']); ?>
<?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->script('app/modulos.js') ?>