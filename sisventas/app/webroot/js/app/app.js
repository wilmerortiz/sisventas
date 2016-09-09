var table = $('#Table').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": URL_BASE + controller + "/data_server"
    });

$('#Table').on('click','tr',function(){
    if($(this).hasClass('selected')){
        $(this).removeClass('selected');

    }else{
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    }
});
 $('div.dataTables_filter input').focus();

  $('#anular').click(function(){
    var id = $('#Table tbody tr.selected td:first').text();
    //alert(id);
    if(id){
        $.ajax({
            url: URL_BASE + controller + '/eliminar/'+id,
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function (data){
                alert(data);
                location.reload(true);
            }
        });
        
        
    }else{
        alert('Seleccione un registro');
    }
 });

 $('#editar').click(function(){
    var id = $('#Table tbody tr.selected td:first').text();
    //alert(id);
    if(id){
        $.ajax({
            url: URL_BASE + controller + '/return_data',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success : function (data){
                Formulario(data);
            }
        })
        
        
    }else{
        alert('Seleccione un registro');
    }
 });

