function cargarEstanteDependencia(idDependencia, numeroEstante, tipoInventario)
{
  var token = document.getElementById('token').value;

    $.ajax({
            headers: {'X-CSRF-TOKEN': token},
            dataType: "json",
            data: {'idDependencia': idDependencia, 'numeroEstante' : numeroEstante, 'tipoInventario': tipoInventario},
            url:   'http://'+location.host+'/cargarEstanteDependencia/',
            type:  'post',
            beforeSend: function(){
                //Lo que se hace antes de enviar el formulario
                },
            success: function(respuesta){
                $("#botones").html(respuesta['boton']);
                $("#contenidoEstante").html(respuesta['estructura']);
            },
            error:    function(xhr,err){ 
                alert("Error");
            }
        });
}

function llenarCampoEstante(estante)
{
    $("#estanteLocalizacion").val(estante);
}

function abrirUbicacion(idDependencia, idUbicacion, event, estado, localizacion)
{
    event.stopPropagation();
    $("#bodyUbicacion").html('<iframe style="width:100%; height:510px; " id="campos" name="campos" src="http://'+location.host+'/ubicaciondocumentomodal?idDependencia='+idDependencia+'&idUbicacion='+idUbicacion+'&estado='+estado+'&localizacion='+localizacion+'"></iframe>');
    $('#myModalUbicacion').modal('show');
}

function cerrarCaja(idDependenciaLocalizacion, event)
{
    event.stopPropagation();
    var actualizar = confirm("¿Realmente desea cambiar el estado de esta caja?");
    
    if (actualizar) 
    {
        var token = document.getElementById('token').value;

        $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                dataType: "json",
                data: {'idDependenciaLocalizacion': idDependenciaLocalizacion},
                url:   'http://'+location.host+'/cerrarCapacidadDependencia/',
                type:  'post',
                beforeSend: function(){
                    //Lo que se hace antes de enviar el formulario
                    },
                success: function(respuesta){
                    alert(respuesta);
                    window.location.reload();
                },
                error:    function(xhr,err){ 
                    alert("Error");
                }
            });
    }
}

function asignarPLRadicado(pl, event)
{
    event.stopPropagation();
    window.parent.document.getElementById("ubicacionEstanteRadicado").value = pl;
    window.parent.$("#myModalPL").modal("hide");
}
