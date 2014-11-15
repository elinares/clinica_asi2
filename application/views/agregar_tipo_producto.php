<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Tipo Producto</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>tipo_productos">Tipo de Producto</a> </li>
            <li class="active">Agregar Tipo Producto</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_tipo_producto" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          </div>
          <div class="form-group">
          <label>Precio</label>
          <input type="text" name="precio" id="precio" class="form-control">
          </div>
           <div class="form-group">
          <label>Cantidad Minima</label>
          <input type="text" name="cantidad_minima" id="cantidad_minima" class="form-control">
          </div>
           <div class="form-group">
          <label>Cantidad Maxima</label>
          <input type="text" name="cantidad_maxima" id="cantidad_maxima" class="form-control">
          </div>
           <div class="form-group">
          <label>Existencia</label>
          <input type="text" name="existencia" id="existencia" class="form-control">
          </div>
          <div class="form-group">
          <label>Medicamento</label><br>
          Si  <input type="radio" name="medicamento" value="1" checked>
          No  <input type="radio" name="medicamento" value="0">
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del tipo de producto." } );
    nombre.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"});

  });
</script>