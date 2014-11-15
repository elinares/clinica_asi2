<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Toma de Signos Vitales</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Inicio</a> </li>
            <li class="active">Toma de Signos Vitales</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>signos_vitales/<?=$expediente?>" method="post">
          <div class="col-md-4">
          <div class="form-group">
          <label>Sintomas</label>
          <input type="text" name="sintoma" id="sintoma" class="form-control">
          </div>
          <div class="form-group">
          <label>Altura</label>
          <input type="text" name="altura" id="altura" class="form-control">
          </div>
          <div class="form-group">
          <label>Peso</label>
          <input type="text" name="peso" id="peso" class="form-control">
          </div>
          <div class="form-group">
          <label>Presión Arterial</label>
          <input type="text" name="presion" id="presion" class="form-control">
          </div>
          <div class="form-group">
          <label>Temperatura</label>
          <input type="text" name="temperatura" id="temperatura" class="form-control">
          </div>
          </div>
          
          <div class="col-md-4">
          <div class="form-group">
          <label>Consultorio</label>
          <select name="consultorio" id="consultorio" class="form-control">
          <option value="">Seleccionar...</option>
          <?php
          foreach ($consultorios as $consultorio) {
          ?>
          <option value="<?=$consultorio['codigo_con']?>"><?=$consultorio['nombre']?></option>
          <?php
          }
          ?>
          </select>
          </div>
          <div class="form-group">
          <label>Tipo de Servicio</label>
          <select name="tipo_servicio" id="tipo_servicio" class="form-control">
          <option value="">Seleccionar...</option>
          <?php
          foreach ($tipos_servicios as $servicio) {
          ?>
          <option value="<?=$servicio['codigo_tipser']?>"><?=$servicio['nombre']?></option>
          <?php
          }
          ?>
          </select>
          </div>
          </div>

          <div style="clear:both;"></div>

          <div class="col-md-8">
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Agregar a Consulta</button>
          </div>   
          </div>
        </form>
      </div>
    </div>    
  
</div>

<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('administrador/pie');
?>

<script>
  $(document).ready(function(){

     //VALIDACION
    var sintoma = new LiveValidation('sintoma', { validMessage: "Gracias." });
    sintoma.add( Validate.Presence, { failureMessage: "Por favor, ingrese el sintoma del paciente." } );

    var altura = new LiveValidation('altura', { validMessage: "Gracias." });
    altura.add( Validate.Presence, { failureMessage: "Por favor, ingrese la altura del paciente." } );

    var peso = new LiveValidation('peso', { validMessage: "Gracias." });
    peso.add( Validate.Presence, { failureMessage: "Por favor, ingrese el peso del paciente." } );

    var presion = new LiveValidation('presion', { validMessage: "Gracias." });
    presion.add( Validate.Presence, { failureMessage: "Por favor, ingrese la presión arterial del paciente." } );

    var temperatura = new LiveValidation('temperatura', { validMessage: "Gracias." });
    temperatura.add( Validate.Presence, { failureMessage: "Por favor, ingrese la temperatura del paciente." } );

    var consultorio = new LiveValidation('consultorio', { validMessage: "Gracias." });
    consultorio.add( Validate.Presence, { failureMessage: "Por favor, ingrese el consultorio para la consulta." } );

    var tipo_servicio = new LiveValidation('tipo_servicio', { validMessage: "Gracias." });
    tipo_servicio.add( Validate.Presence, { failureMessage: "Por favor, ingrese el tipo de servicio que requiere el paciente." } );


  });
</script>