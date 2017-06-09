
@extends('layouts.grid')
@section('titulo')<h3 id="titulo"><center>FRECUENCIA MEDICION</center></h3>@stop

@section('content')

<style>




tfoot input 
{
    width: 100%;
    padding: 3px;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>
<div id="nat" class="container">
    <div class="row">
        <div class="container">
            <br>
            <div class="btn-group" style="margin-left: 94%;margin-bottom:4px" title="Columns">
                <button type="button" class="btn btn-default dropdown-toggle"data-toggle="dropdown">
                    <i class="glyphicon glyphicon-th icon-th"></i> 
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    <li><a class="toggle-vis" data-column="0"><label> Iconos</label></a></li>
                    <li><a class="toggle-vis" data-column="1"><label> ID</label></a></li>
                    <li><a class="toggle-vis" data-column="2"><label> Código</label></a></li>
                    <li><a class="toggle-vis" data-column="3"><label> Nombre</label></a></li>
                </ul>
            </div>
            <div id="div1">
            <table id="tfrecuenciamedicion" name="tfrecuenciamedicion" class="display table-bordered" width="100%">
                <thead>
                    <tr class="btn-primary active">
                        <th style="width:40px;padding: 1px 8px;" data-orderable="false">
                           <a href="frecuenciamedicion/create"><span class="glyphicon glyphicon-plus"></span></a>
                           <a href="#"><span onclick="recargaPage()" class="glyphicon glyphicon-refresh"></span></a>
                       </th>
                       <th><b>ID</b></th>
                       <th><b>Código</b></th>
                       <th><b>Nombre</b></th>
                       <th><b>Valor Frecuencia</b></th>
                       <th><b>Unidad Frecuencia</b></th>
                       
                   </tr>
               </thead>
               <tfoot>
                <tr class="btn-default active">
                    <th style="width:40px;padding: 1px 8px;">
                        &nbsp;</th>
                    <th>ID</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Valor Frecuencia</th>
                    <th>Unidad Frecuencia</th>
                </tr>
            </tfoot>        
        </table>
        </div>
    </div>
  </div>
</div>


<script type="text/javascript">

 

function recargaPage() 
{
  location.reload();
}

$(document).ready( function () 
{
   
   
    

var lastIdx = null;
var modificar = '<?php echo (isset($datos[0]) ? $dato["modificarRolOpcion"] : 0);?>';
var eliminar = '<?php echo (isset($datos[0]) ? $dato["eliminarRolOpcion"] : 0);?>';
var table = $('#tfrecuenciamedicion').DataTable( 
{
    "order": [[ 2, "desc" ]],
            "aProcessing": true,
            "aServerSide": true,
            "stateSave":true,
             dom: 'Bfrtip',
            buttons: [
        'excel', 'print'
    ],
    "ajax": "{!! URL::to ('/datosFrecuenciaMedicion')!!}",
    "language": 
    {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ning&uacute;n dato disponible en esta tabla",
        "sInfo":           "Registros del _START_ al _END_ de un total de _TOTAL_ ",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": 
        {
            "sFirst":    "Primero",
            "sLast":     "&Uacute;ltimo",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": 
        {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});



$('a.toggle-vis').on( 'click', function (e) 
{
    e.preventDefault();
    
    // Get the column API object
    var column = table.column( $(this).attr('data-column') );
    
    // Toggle the visibility
    column.visible( ! column.visible() );
});

$('#tfrecuenciamedicion tbody')
.on( 'mouseover', 'td', function () 
{
    var colIdx = table.cell(this).index().column;
    
    if ( colIdx !== lastIdx ) 
    {
        $( table.cells().nodes() ).removeClass( 'highlight' );
        $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
    }
} )
.on( 'mouseleave', function () 
{
    $( table.cells().nodes() ).removeClass( 'highlight' );
} );

// Setup - add a text input to each footer cell
$('#tfrecuenciamedicion tfoot th').each( function () 
{
    if($(this).index()>0)
    {
        var title = $('#tfrecuenciamedicion thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Buscar por '+title+'" />' );
    }
});

// DataTable
var table = $('#tfrecuenciamedicion').DataTable();

// Apply the search
table.columns().every( function ()
{
var that = this;

$( 'input', this.footer() ).on( 'blur change', function ()
  {
    if ( that.search() !== this.value ) 
    {
        that
        .search( this.value )
        .draw();
    }
  });
})


});

</script>
@stop
