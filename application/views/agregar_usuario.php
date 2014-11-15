<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Usuario</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>usuarios">Usuarios</a> </li>
            <li class="active">Agregar Usuario</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_usuario" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          </div>
          <div class="form-group">
          <label>Contraseña</label>
          <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
          <label>Perfil</label>
          <select name="perfil" id="perfil" class="form-control">
          <?php
          foreach ($perfiles as $perfil) {
          ?>
          <option value="<?=$perfil['codigo_perf']?>"><?=$perfil['nombre']?></option>
          <?php
          }
          ?>
          </select>
          </div>
          <div class="form-group">
          <label>Estado</label>
          <div style="display:block;">
            Activo <input type="radio" name="estado" value="1" checked>
            Inactivo <input type="radio" name="estado" value="0" >
          </div>
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del usuario." } );
    nombre.add( Validate.Length, { minimum: 4, tooShortMessage: "El nombre de usuario debe ser de al menos 4 caracteres." } );

    var password = new LiveValidation('password', { validMessage: "Gracias." });
    password.add( Validate.Presence, { failureMessage: "Por favor, ingrese el password del usuario." } );

  });
</script>