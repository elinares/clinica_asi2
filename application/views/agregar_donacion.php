<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Donación</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>configuracion_citas">Donaciones</a> </li>
            <li class="active">Agregar Donación</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_donacion" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          </div>
          <div class="form-group">
          <label>Primer Apellido</label>
          <input type="text" name="apellido1" id="apellido1" class="form-control">
          </div>
          <div class="form-group">
          <label>Segundo Apellido</label>
          <input type="text" name="apellido2" id="apellido2" class="form-control">
          </div>
          <div class="form-group">
          <label>Dirección</label>
          <input type="text" name="direccion" id="direccion" class="form-control">
          </div>
          <div class="form-group">
          <label>Telefono</label>
          <input type="text" name="telefono" id="telefono" class="form-control">
          </div>
          <div class="form-group">
          <label>Correo</label>
          <input type="text" name="correo" id="correo" class="form-control">
          </div>
          <div class="form-group">
          <label>Tipo Documento</label>
      
      <select>
      <option value="" selected>Seleccione Tipo documento</option>  

  <option value="dui">DUI</option>
  <option value="nit">NIT</option>
  <option value="pasaporte">PASAPORTE</option>
        </select>


          </div>
          <div class="form-group">
          <label>N° de Documento</label>
          <input type="text" name="numero_doc" id="numero_doc" class="form-control">
          </div>
          <div class="form-group">
          <label>Monto</label>
          <input type="text" name="monto" id="monto" class="form-control">
          </div>
          <div class="form-group">
          <label>Estado</label>
          <input type="text" name="estado" id="estado" class="form-control">
          </div>
          <div class="form-group">
          <label>Fecha</label>
          <input type="date" name="fecha" id="fecha" class="form-control">
          </div>
          <div class="form-group">
          <label>Clinica</label>
          <select name="fk_codigo_cli" id="fk_codigo_cli" class="form-control">
          <?php
          foreach ($clinicas as $clinica) {
          ?>
          <option value="<?=$clinica['codigo_cli']?>"><?=$clinica['nombre']?></option>
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

var nombre = new LiveValidation('nombre', { validMessage: "Gracias." });
nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese su nombre." } );
nombre.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

var apellido1 = new LiveValidation('apellido1', { validMessage: "Gracias." });
apellido1.add( Validate.Presence, { failureMessage: "Por favor, ingrese su apellido." } );
apellido1.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})


var apellido2 = new LiveValidation('apellido2', { validMessage: "Gracias." });
apellido2.add( Validate.Presence, { failureMessage: "Por favor, ingrese su apellido." } );
apellido2.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

var direccion = new LiveValidation('direccion', { validMessage: "Gracias." });
direccion.add( Validate.Length, { minimum: 10, tooShortMessage:"El direccion debe contener un minimo de 10 caractere." } );

var telefono = new LiveValidation('telefono', { validMessage: "Gracias." });
telefono.add( Validate.Length, { maximum: 8, tooLongMessage:"El telefono debe contener un máximo de 8 caracteres." } );
telefono.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

var correo = new LiveValidation('correo', { validMessage: " Gracias. " });
correo.add( Validate.Email, {failureMessage:"Escriba un formato de correo correcto"});

var monto = new LiveValidation('monto', { validMessage: "Gracias." });
monto.add( Validate.Numericality, { minimum: 1, tooLowMessage:"El monto minimo es $ 1.00", maximum: 1000000000, tooHighMessage:"El monto maximo es $ 100,000000", notANumberMessage : "La cantidad debe ser un número." } );




  });
</script>