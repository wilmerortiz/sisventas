<style>
    .btns {
        padding: 0px 15px;
        margin-top:-2px;
    }
</style>

<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--<div class="box box-default ">
                            <div class="box-header with-border">
                                <h3 class="box-title">Expandable</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                The body of the box
                            </div>
                        </div>-->
                        <?php echo $this->Element('permisos') ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Form->create('Rol',['url'=>['controller'=>'Rols','action'=>'edit']]); ?>
<div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Editar Rol</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $this->Form->hidden('id',['id'=>'id']) ?>
                        <?php echo $this->Form->input('descripcion', ['class'=>'form-control','id'=>'descripcion']); ?>
                        <?php echo $this->Form->hidden('estado',['value'=>'A'])?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
                <button type="submit" class="btn btn-primary">GUARDAR CAMBIOS</button>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>

<div class="acciones">
	<a href="<?php echo Router::url('/') ?>Rols/add" class="btn btn-primary"><i class="ion-android-add-circle ion-2"> </i> Nuevo</a>
    <button type="button" id="editar" class="btn btn-info"> <i class="ion-edit ion-2" ></i> Editar</button>
	<button type="button" id="anular" class="btn btn-danger"> <i class="ion-android-delete ion-2"></i> Eliminar</button>
    
	<br><br>
</div>
<div class="rols index">
	<table id="Table" class="table table-bordered table-striped table-hover" width="100%">
		<thead>
			<tr>
				<th class="col-md-1 col-sm-1 text-center"><?php echo 'ID'; ?></th>
				<th class="text-center"><?php echo 'descripcion'; ?></th>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>
</div>
<?php echo $this->Html->script('app/rol.js') ?>