<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Editar Persona</h1>
            <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>empleados">Persona</a> </li>
            <li class="active">Editar Persona</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
      <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_persona/<?=$info_perso['codigo_per']?>" method="post">
      
           <div class="form-group">
         <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" value="<?=$info_perso['nombre']?>" class="form-control">
          </div>

            <div class="form-group">
               <label>Primer Apellido</label>
          <input type="text" name="primer_apellido" id="primer_apellido" value="<?=$info_perso['primer_apellido']?>" class="form-control">
          </div>

          <div class="form-group">
               <label>Segundo Apellido</label>
          <input type="text" name="segundo_apellido" id="segundo_apellido" value="<?=$info_perso['segundo_apellido']?>" class="form-control">
          </div>
         
          <div class="form-group">
           <label>Fecha Nacimiento</label>
          <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?=$info_perso['fecha_nacimiento']?>" class="form-control">
          </divinfo_perso
          <div class="form-group">
             <label>Estado civil</label>
          <input type="text" name="estado_civil" id="estado_civil" value="<?=$info_perso['estado_civil']?>" class="form-control">
          </div>

          <div class="form-group">
             <label>Genero</label>
          <input type="text" name="genero" id="genero" value="<?=$info_perso['genero']?>" class="form-control">
          </div>

          <div class="form-group">
          <label>DUI</label>
          <input type="text" name="dui" id="dui" value="<?=$info_perso['dui']?>" class="form-control">
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
            <button class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
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

  });
</script>