<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Persona</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>personas">Persona</a> </li>
            <li class="active">Agregar Persona</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_persona" method="post">
          <div class="form-group">
          <label>Nombres</label>
          <input type="text" name="nombres" id="nombres" class="form-control">
          </div>

          <div class="form-group">
               <label>Apellidos</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control">
          </div>
         
          <div class="form-group">
           <label>Fecha Nacimiento</label>
          <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
          </div>

          <div class="form-group">
             <label>Estado civil</label>
       <!--LLAMAMOS EL PIE DE PAGINA <select type="text" name="estado_civil" id="estado_civil" class="form-control">-->
       <select type="text" name="estado_civil" id="estado_civil" class="form-control">
  <option value="">Seleccione</option>
  <option value="soltero/a">Soltero/a</option>
  <option value="casado/a">Casado/a</option>
  <option value="divorciado/a">Divorciado/a</option>
  <option value="vidudo/a">Vuido/a</option>
</select>
          </div>

          <div class="form-group">
             <label>Genero</label>
          
          <select type="text" name="genero" id="genero" class="form-control">
  <option value="">Seleccione</option>
  <option value="masculino">Masculino</option>
  <option value="femenino">femenino</option>
  <option value="omar">omar</option>
</select>
          </div>

          <div class="form-group">
          <label>DUI</label>
          <input type="text" name="dui" id="dui" class="form-control">
          </div>

        

          <div class="form-group">
            <label>Municipio</label>
          <select name="fk_codigo_muni" id="fk_codigo_muni" class="form-control">
          <?php
          foreach ($municipios as $municipio) {
          ?>
          <option value="<?=$municipio['codigo_muni']?>"><?=$municipio['nombre']?></option>
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

    //VALIDACION
    var nombre = new LiveValidation('nombre', { validMessage: "Gracias." });
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del Empleado." } );
    
    var primer_apellido = new LiveValidation('primer_apellido', { validMessage: "Gracias." }); 
    primer_apellido.add( Validate.Presence, { failureMessage: "Por favor, ingrese el Apellido del Empleado." } );

    var segundo_apellido = new LiveValidation('segundo_apellido', { validMessage: "Gracias." });
    segundo_apellido.add( Validate.Presence, { failureMessage: "Por favor, ingrese el Apellido del Empleado." } );

    var fecha_nacimiento = new LiveValidation('fecha_nacimiento', { validMessage: "Gracias." });
    fecha_nacimiento.add( Validate.Presence, { failureMessage: "Por favor, ingrese el Fecha de Nacimiento del Empleado." } );

    var estado_civil = new LiveValidation('estado_civil', { validMessage: "Gracias." });
    estado_civil.add( Validate.Presence, { failureMessage: "Por favor, ingrese el Estado civil del Empleado." } );

    var genero = new LiveValidation('genero', { validMessage: "Gracias." });
    genero.add( Validate.Presence, { failureMessage: "Por favor, ingrese el Genero del Empleado." } );

    var dui = new LiveValidation('dui', { validMessage: "Gracias." });
    dui.add( Validate.Presence, { failureMessage: "Por favor, ingrese el DUI del Empleado." } );

  });
</script>