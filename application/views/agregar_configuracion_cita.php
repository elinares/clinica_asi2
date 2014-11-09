<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Cita</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>configuracion_citas">Confguración Cita</a> </li>
            <li class="active">Agregar Cita</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_configuracion_cita" method="post">
          <div class="form-group">
          <label>Hora Inicial</label>
          <input type="text" name="hora_inicial" id="hora_inicial" class="form-control">
          </div>
          <div class="form-group">
          <label>Hora Final</label>
          <input type="text" name="hora_final" id="hora_final" class="form-control">
          </div>
          <div class="form-group">
          <label>Cantidad Maxima</label>
          <input type="text" name="catidad_maxima" id="catidad_maxima" class="form-control">
          </div>
          <div class="form-group">
          <label>Consultorio</label>
          <select name="consultorio" id="consultorio" class="form-control">
          <?php
          foreach ($consultorios as $consultorio) {
          ?>
          <option value="<?=$consultorio['codigo_con']?>"><?=$consultorio['nombre']?></option>
          <?php
          }
          ?>
          </select>
          </div>
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>   
        </form>
      </div>
    </div>    
  </div>
</div>

<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('administrador/pie');
?>

<script>
  $(document).ready(function(){

    //VALIDACION HORA INICIAL
    var hora_inicial = new LiveValidation('hora_inicial', { validMessage: "Gracias." });
    hora_inicial.add( Validate.Presence, { failureMessage: "Por favor, ingrese la Hora de Inicio." } );
    hora_inicial.add( Validate.Length, { minimum: 7, tooShortMessage: "La hora debe estar en este formato. Ej: 00:00(AM/PM)" } );
    //VALIDACION HORA FINAL
    var hora_final = new LiveValidation('hora_final', { validMessage: "Gracias." });
    hora_final.add( Validate.Presence, { failureMessage: "Por favor, ingrese la Hora de Final." } );
    hora_final.add( Validate.Length, { minimum: 7, tooShortMessage: "La hora debe estar en este formato. Ej: 00:00(AM/PM)" } );
    //VALIDACION DE CANTIDAD MAXIMA
    var cantidad_maxima = new LiveValidation('cantidad_maxima', { validMessage: "Gracias." });
    cantidad_maxima.add( Validate.Presence, { failureMessage: "Por favor, ingrese cantidad máxima." } );
    cantidad_maxima.add( Validate.Length, { minimum: 7, tooShortMessage: "Ingrese la Cantidad Máxima." } );

  });
</script>