<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>





<div class="content">
        <div class="header">
            
            <h1 class="page-title">Editar Pacientes</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
             <li><a href="<?=base_url()?>listar_pacientes"> Paciente</a> </li>
            <li class="active">Edita Persona a Pacientes</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_paciente/<?=$paciente['codigo_pac']?>" method="post">
          <div class="form-group">
          <label>Nombres</label>
          <input type="text" name="nombres" id="nombres" value="<?=$persona['nombres']?>" class="form-control">
          </div>

          <div class="form-group">
               <label>Apellidos</label>
          <input type="text" name="apellidos" id="apellidos" value="<?=$persona['apellidos']?>"  class="form-control">
          </div>
         
          <div class="form-group">
           <label>Fecha Nacimiento</label>
          <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?=$persona['fecha_nacimiento']?>" class="form-control">
          </div>

          <div class="form-group">
             <label>Estado civil</label>
       <!--LLAMAMOS EL PIE DE PAGINA <select type="text" name="estado_civil" id="estado_civil" class="form-control">-->
       <select type="text" name="estado_civil" id="estado_civil" class="form-control">

  
  <option value="" >Seleccione</option>
  <option value="soltero/a" <? if($persona['estado_civil']=="soltero/a") echo"selected";?> >Soltero/a</option>
  <option value="casado/a" <? if($persona['estado_civil']=="casado/a") echo"selected";?> >Casado/a</option>
  <option value="divorciado/a" <? if($persona['estado_civil']=="divorciado/a") echo"selected";?> >Divorciado/a</option>
  <option value="vidudo/a" <? if($persona['estado_civil']=="vidudo/a") echo"selected";?> >Vuido/a</option>
</select>
          </div>

          <div class="form-group">
             <label>Genero</label>
          
          <select type="text" name="genero" id="genero" class="form-control">
  <option value="">Seleccione</option>
  <option value="masculino" <? if($persona['genero']=="masculino") echo"selected";?>>Masculino</option>
  <option value="femenino" <? if($persona['genero']=="femenino") echo"selected";?>>femenino</option>
  
</select>
          </div>
   
           <div class="form-group">
          <label>Direcion</label>
          <input type="text" name="direccion" id="direccion" value="<?=$persona['direccion']?>" class="form-control">
          </div>


          <div class="form-group">
          <label>DUI</label>
          <input type="text" name="dui" id="dui"value="<?=$persona['dui']?>" class="form-control">
          </div>

          <div class="form-group">
          <label>Ocupacion</label>
          <input type="text" name="ocupacion" id="ocupacion" value="<?=$paciente['ocupacion']?>" class="form-control">
          </div>
          <div class="form-group">
            <label>Departamento</label>

<select name="departamento" id="departamento" class="form-control">

  <option value="">Selecciona tu departamento</option>
        <?php 
        foreach($departamento as $fila)
        {
        ?>

          <?php
            if ($fila -> codigo_dep==$departamento2) {
              
              ?>
              <option value="<?=$fila -> codigo_dep ?>" selected><?=$fila -> nombre ?></option>

             <?php 
            }

           ?>


            <option value="<?=$fila -> codigo_dep ?>"><?=$fila -> nombre ?></option>
        <?php
        }
        ?>        
    </select>
  </div>

     <div class="form-group">
      <label>Municipio</label>
    
    <select name="fk_codigo_muni" id="fk_codigo_muni" class="form-control">
            <option value="">Selecciona tu municipio</option>
    </select>

          </div>

<HR width=100% align="left">

<h3>Expediente de Paciente</h3>
 
<br/>


           <div class="form-group">
          <label>Codigo Fisico</label>
          <input type="text" name="codigo_fisico" id="codigo_fisico" value="<?=$expediente['codigo_fisico']?>" class="form-control">
          </div>

           <div class="form-group">
          <label>Padece alguna alergia</label>
          <input type="text" name="alergia" id="alergia" value="<?=$expediente['alergia']?>" class="form-control">
          </div>

           <div class="form-group">
          <label>Enfermedad padeciada</label>
          <input type="text" name="enfermedad" id="enfermedad" value="<?=$expediente['enfermedad_padecida']?>" class="form-control">
          </div>

            <div class="form-group">
          <label>Antecedente</label>
          <input type="text" name="antecedente" id="antecedente" value="<?=$expediente['antecedente']?>" class="form-control">
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
    var nombre = new LiveValidation('nombres', { validMessage: "Gracias." });
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del Empleado." } );
    
    var primer_apellido = new LiveValidation('apellidos', { validMessage: "Gracias." }); 
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