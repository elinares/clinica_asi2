<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Editar Usuario</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>usuarios">Usuarios</a> </li>
            <li class="active">Editar Usuario</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_usuario/<?=$info_usu['codigo_user']?>" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" value="<?=$info_usu['nombre']?>" class="form-control">
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
            if($info_usu['codigo_perf'] == $perfil['codigo_perf']){
            ?>
            <option value="<?=$perfil['codigo_perf']?>" selected><?=$perfil['nombre']?></option>
            <?php
            }else{
            ?>
            <option value="<?=$perfil['codigo_perf']?>"><?=$perfil['nombre']?></option>
            <?php
            }          
          }
          ?>
          </select>
          </div>
          <div class="form-group">
          <label>Estado</label>
          <div style="display:block;">
          <?php
            if($info_usu['estado'] == 1){
              ?>
              Activo <input type="radio" name="estado" value="1" checked>
              Inactivo <input type="radio" name="estado" value="0" >
              <?php
            }else{
              ?>
              Activo <input type="radio" name="estado" value="1" >
              Inactivo <input type="radio" name="estado" value="0" checked>
              <?php
            }
          ?>
          </div>
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del usuario." } );
    nombre.add( Validate.Length, { minimum: 4, tooShortMessage: "El nombre de usuario debe ser de al menos 4 caracteres." } );

  });
</script>