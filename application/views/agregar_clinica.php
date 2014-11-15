<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Clínica</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>clinicas">Clínicas</a> </li>
            <li class="active">Agregar Clínica</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_clinica" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          </div>
          <div class="form-group">
          <label>Encargado</label>
          <input type="text" name="encargado" id="encargado" class="form-control">
          </div>
          <div class="form-group">
          <label>Dirección</label>
          <input type="text" name="direccion" id="direccion" class="form-control">
          </div>
          <div class="form-group">
          <label>Teléfono</label>
          <input type="text" name="telefono" id="telefono" class="form-control">
          </div>
          <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" id="email" class="form-control">
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre de la clínica." } );
    nombre.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

    var encargado = new LiveValidation('encargado', { validMessage: "Gracias." });
    encargado.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del encargado." } );
    encargado.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

    var direccion = new LiveValidation('direccion', { validMessage: "Gracias." });
    direccion.add( Validate.Presence, { failureMessage: "Por favor, ingrese la dirección de la clínica." } );

    var telefono = new LiveValidation('telefono', { validMessage: "Gracias." });
    telefono.add( Validate.Length, { maximum: 8, tooLongMessage:"El telefono debe contener un máximo de 8 caracteres." } );
    telefono.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

    var email = new LiveValidation('email', { validMessage: "Gracias." });
    email.add( Validate.Email, { failureMessage: "Por favor, ingrese un email válido." } );
    email.add( Validate.Email, {failureMessage:"Escriba un formato de correo correcto"});

  });
</script>