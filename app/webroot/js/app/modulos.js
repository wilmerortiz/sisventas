function Formulario(data){
    $('#id').val(data[0].Modulo.id);
    $('#modulos').val(data[0].Modulo.modulos);
    $('#url').val(data[0].Modulo.url);

    ModuloPadre(data[0].Modulo.id_padre);

    $('#modal-editar').modal('show');
}

function ModuloPadre(id_padre)
{
    $.ajax({
        url: URL_BASE + 'Modulos/getModulosPadres',
        type: 'POST',
        dataType: 'json',
        success: function (data){
            var html = '<option value="0">Seleccione..</option>';
            for (var i = 0; i < data.length; i++) {
                if(id_padre == data[i].Modulo.id)
                    html += '<option value="'+data[i].Modulo.id+'" selected>'+data[i].Modulo.modulos+'</option>';
                else
                    html += '<option value="'+data[i].Modulo.id+'">'+data[i].Modulo.modulos+'</option>';
            }
            $('#id_padre').html(html);
        }
    })
    
}