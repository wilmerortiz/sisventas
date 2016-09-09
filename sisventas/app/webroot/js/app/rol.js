function Formulario(data){
    $('#id').val(data[0].Rol.id);
    $('#descripcion').val(data[0].Rol.descripcion);

    $('#modal-editar').modal('show');
}