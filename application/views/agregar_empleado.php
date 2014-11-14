<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Empleados</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>empleados">Empleados</a> </li>
            <li class="active">Agregar Empleado</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_empleado" method="post">
        

          <div class="form-group">
          <label>Persona</label>
          <?php
          foreach ($empleados as $empleado) {
          ?>
          <input type="hidden" value="<?=$empleado['codigo_per']?>" name="fk_codigo_per">
           <label>Nuevo Empleado: </label>&nbsp;<label><b><?php echo $empleado['nombres']; ?>&nbsp; <?php echo $empleado ['apellidos'];?></b></label> 
          <?php
         }
          ?>

          </div>

           <div class="form-group">
          <label>Usuario</label>
          <select name="fk_codigo_user" id="fk_codigo_user" class="form-control">
          <?php
          foreach ($usuarios as $usuario) {
          ?>
          <option value="<?=$usuario['codigo_user']?>"><?=$usuario['nombre']?></option>
          <?php
          }
          ?>
          </select>
          </div>

             <div class="form-group">
          <label>NIT</label>
          <input type="text" name="nit" id="nit" class="form-control">
          </div>

          <div class="form-group">
          <label>ISSS</label>
          <input type="text" name="isss" id="isss" class="form-control">
          </div>

          <div class="form-group">
          <label>NUP</label>
          <input type="text" name="nup" id="nup" class="form-control">
          </div>

          <div class="form-group">
          <label>JVPM</label>
          <input type="text" name="jvpm" id="jvpm" class="form-control">
          </div>

           <div class="form-group">
          <label>Cargo</label>
          <select name="fk_codigo_carg" id="fk_codigo_carg" class="form-control">
          <?php
          foreach ($cargos as $cargo) {
          ?>
          <option value="<?=$cargo['codigo_carg']?>"><?=$cargo['nombre']?></option>
          <?php
          }
          ?>
          </select>
          </div>

          <div class="form-group">
          <label>Especialidad</label>
          <select name="fk_codigo_esp" id="fk_codigo_esp" class="form-control">
          <?php
          foreach ($especialidades as $especialidad) {
          ?>
          <option value="<?=$especialidad['codigo_esp']?>"><?=$especialidad['nombre']?></option>
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del consultorio." } );

  });
</script>