<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Persona a Pacienes</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>buscar_persona_paciente">Busqueda Paciente</a> </li>
            <li class="active">Agregar Paciente</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_paciente_op2" method="post">
          <div class="form-group">
         
           
         
          <input type="hidden" value="<?=$persona['codigo_per']?>" name="codigo_paciente">

           <label>Nombre Persona: </label>&nbsp;<label><b><?php echo $persona['nombres']; ?>&nbsp; <?php echo $persona['apellidos'];?></b></label> 
       
          <br>
          </div>

          <div class="form-group">
               <label>ocupacion</label>
          <input type="text" name="apellidos" id="apellidos" class="form-control">
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