<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Editar Clínica</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>clinicas">Clínicas</a> </li>
            <li class="active">Editar Clínica</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_clinica/<?=$info_cli['cod_clinica']?>" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" value="<?=$info_cli['nombre']?>" class="form-control">
          </div>
          <div class="form-group">
          <label>Encargado</label>
          <input type="text" name="encargado" id="encargado" value="<?=$info_cli['encargado']?>" class="form-control">
          </div>
          <div class="form-group">
          <label>Dirección</label>
          <input type="text" name="direccion" id="direccion" value="<?=$info_cli['direccion']?>" class="form-control">
          </div>
          <div class="form-group">
          <label>Teléfono</label>
          <input type="text" name="telefono" id="telefono" value="<?=$info_cli['telefono']?>" class="form-control">
          </div>
          <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" id="email" value="<?=$info_cli['email']?>" class="form-control">
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre de la clínica." } );

    var encargado = new LiveValidation('encargado', { validMessage: "Gracias." });
    encargado.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del encargado." } );

    var direccion = new LiveValidation('direccion', { validMessage: "Gracias." });
    direccion.add( Validate.Presence, { failureMessage: "Por favor, ingrese la dirección de la clínica." } );

    var telefono = new LiveValidation('telefono', { validMessage: "Gracias." });
    telefono.add( Validate.Numericality, { notANumberMessage: "El teléfono debe ser un número." } );

    var email = new LiveValidation('email', { validMessage: "Gracias." });
    email.add( Validate.Email, { failureMessage: "Por favor, ingrese un email válido." } );

  });
</script>