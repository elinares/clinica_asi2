<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Editar Departamento</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>departamentos">Departamentos</a> </li>
            <li class="active">Editar Departamento</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_departamento/<?=$info_dep['codigo_dep']?>" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" value="<?=$info_dep['nombre']?>" class="form-control">
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del departamento." } );

  });
</script>