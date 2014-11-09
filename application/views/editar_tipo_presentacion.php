<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Tipo Presentación</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>tipo_presentaciones">Tipos de Presentación</a> </li>
            <li class="active">Agregar Tipo Presentación</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_tipo_presentacion/<?=$info_tipre['codigo_tipre']?>" method="post">
          <div class="form-group">
          <label>Tipo de Presentación</label>
          <input type="text" name="tipo" id="tipo" value="<?=$info_tipre['tipo']?>" class="form-control">
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
    var tipo = new LiveValidation('tipo', { validMessage: "Gracias." });
    tipo.add( Validate.Presence, { failureMessage: "Por favor, ingrese el tipo de presentación." } );

  });
</script>