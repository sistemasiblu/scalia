<?php
//print_r($protMantTarea);
//return;
?>
@extends('layouts.vista')








@section('content')
@include('alerts.request')
  {!!Html::script('/js/select2.min.js');!!}

{!!Html::script('js/dropzone.js'); !!}<!--Llamo al dropzone-->
{!!Html::style('assets/dropzone/dist/min/dropzone.min.css'); !!}

<script>

var protocolomantenimiento = '<?php echo (isset($protMantTarea) ? json_encode($protMantTarea) : "");?>';
  protocolomantenimiento = (protocolomantenimiento != '' ? JSON.parse(protocolomantenimiento) : '');
  console.log(protocolomantenimiento);


var valorprotocolo = [0,0,''];
$(document).ready(function()
{

  protocolo=new Atributos('protocolo','contenedor-protocolo','protocolo_');
  protocolo.campoid = 'idProtocoloMantenimientoTarea';
  protocolo.campoEliminacion = 'protocoloEliminar';
  protocolo.campos=['idProtocoloMantenimientoTarea', 'ProtocoloMantenimiento_idProtocoloMantenimiento', 'descripcionProtocoloMantenimientoTarea', 'minutosProtocoloMantenimientoTarea', 'FrecuenciaMedicion_idFrecuenciaMedicion', 'TipoServicio_idTipoServicio', 'requiereParoProtocoloMantenimientoTarea'];
  protocolo.etiqueta=['input','input','input','input','select','select','checkbox'];
  protocolo.tipo=['hidden','hidden','','','','','checkbox'];
  //movimiento.tipo=['','','','','','','','','','',''];
 //movimiento.value=['','','','','','','','','','','',];
  protocolo.estilo=['','','width:350px; height:35px;','width:100px;  height:35px;','width:200px; height:35px;','width:200px; height:35px;','width:97px; height:30px;display: inline-block;'];
  protocolo.clase=['','','','','','',''];
  protocolo.requerido=[false,false,true,true,true,true,false];

  var idFrecuencia = '<?php echo isset($idFrecuencia) ? $idFrecuencia : "";?>';
  var nombreFrecuencia = '<?php echo isset($nombreFrecuencia) ? $nombreFrecuencia : "";?>';
  var Frecuencia = [JSON.parse(idFrecuencia),JSON.parse(nombreFrecuencia)];
  var idTipoServicio = '<?php echo isset($idTipoServicio) ? $idTipoServicio : "";?>';
  var nombreTipoServicio = '<?php echo isset($nombreTipoServicio) ? $nombreTipoServicio : "";?>';
  var TipoServicio = [JSON.parse(idTipoServicio),JSON.parse(nombreTipoServicio)];
  protocolo.opciones=['','','','',Frecuencia,TipoServicio,''];
  protocolo.sololectura=[false,false,false,false,false,true,true];
  protocolo.completar=['off','off','off','off','off','off','off'];
  protocolo.obligatorio=[false,false,true,true,true,true,false];


 for(var j=0; j < protocolomantenimiento.length; j++)
  {
    protocolo.agregarCampos(JSON.stringify(protocolomantenimiento[j]),'L');
  }

});




</script>


  @if(isset($protocolomantenimiento))
    @if(isset($_GET['accion']) and $_GET['accion'] == 'eliminar')
      {!!Form::model($protocolomantenimiento,['route'=>['protocolomantenimiento.destroy',@$protocolomantenimiento->idProtocoloMantenimiento],'method'=>'DELETE'])!!}
    @else
      {!!Form::model($protocolomantenimiento,['route'=>['protocolomantenimiento.update',@$protocolomantenimiento->idProtocoloMantenimiento],'method'=>'PUT'])!!}
    @endif
  @else
    {!!Form::open(['route'=>'protocolomantenimiento.store','method'=>'POST'])!!}
  @endif

  <div class="container">
  <br><br><br><br>
{!!Form::hidden('idProtocoloMantenimiento', null, array('id' => 'idProtocoloMantenimiento'))!!}
{!!Form::hidden('protocoloEliminar', null, array('id' => 'protocoloEliminar'))!!}




    <div id='form-section' >
        <fieldset id="movimientoactivo-form-fieldset"> 
          <div class="form-group" id='test'>
            
            <input type="hidden" id="token" value="{{csrf_token()}}"/>
              <div class="col-sm-2">
                {!!Form::label('nombreProtocoloMantenimiento', 'Descripcion Mantto', array())!!}
              </div>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-barcode"></i>
                  </span>
                  {!!Form::text('nombreProtocoloMantenimiento',@$protocolomantenimiento->nombreProtocoloMantenimiento ,[ 'required'=>'required','class'=>'form-control','placeholder'=>'Ingresa la descripcion'])!!}
                </div>
              </div>
          

           

           <br><br>
              <div class="col-sm-2">
                {!!Form::label('TipoActivo_idTipoActivo', 'Tipo Activo', array())!!}
              </div>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  
                  {!!Form::select('TipoActivo_idTipoActivo',$tipoactivo, @$protocolomantenimiento->TipoActivo_idTipoActivo,["required"=>"required","class" => "chosen-select form-control",'placeholder'=>'Selecciona'])!!}

                  </div>
              </div>
           <br><br>
            <div class="col-sm-2">
                {!!Form::label('TipoAccion_idTipoAccion', 'Tipo Servicio', array())!!}
              </div>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  
                  {!!Form::select('TipoAccion_idTipoAccion',$tipoaccion, @$protocolomantenimiento->TipoAccion_idTipoAccion,["required"=>"required","class" => "chosen-select form-control",'placeholder'=>'Seleccione'])!!}

                  </div>
              </div>
           

        </div>
      </fieldset>
    </div>  

         
<br><br><br><br>

  <div class="form-group">
    <fieldset id='fieldset-documentos'>
      <div class="form-group"  id='test'>
        <div class="col-sm-12">
          <div class="row show-grid">
             
             <div class="col-md-1" style="width: 40px;height: 55px;"><span class="glyphicon glyphicon-plus" title="Adicionar" style='cursor:pointer;' onclick="protocolo.agregarCampos(valorprotocolo,'A')" ></span> 
              
            <span class="glyphicon glyphicon-trash" title="Elimar Todo" style='cursor:pointer;' onclick="protocolo.borrarTodosCampos()" ></span> </div>

            <div class="col-md-1" style="width: 350px;height: 55px;"><b>Tarea</b></div>
             <div class="col-md-1" style="width: 100px;height: 55px;"><b>Tiempo(Min)</b></div>
             <div class="col-md-1" style="width: 200px;height: 55px;"><b>Frecuencia</b></div>
             <div class="col-md-1" style="width: 200px;height: 55px;"><b>Especialidad</b></div>
             <div class="col-md-1" style="width: 90px;height: 55px;"><b>Req.Paro</b></div>
             <div  id="contenedor-protocolo"></div>
          </div>
      </div>
  </div>

    
  


</div>





@if(isset($protocolomantenimiento))
  @if(isset($_GET['accion']) and $_GET['accion'] == 'eliminar')
    {!!Form::submit('Eliminar',["class"=>"btn btn-primary"])!!}
  @else
    {!!Form::submit('Modificar',["class"=>"btn btn-primary"])!!}
  @endif
@else
   {!!Form::submit('Adicionar',["class"=>"btn btn-primary"])!!}
@endif
{!! Form::close() !!}

</body>
</html>
@stop









