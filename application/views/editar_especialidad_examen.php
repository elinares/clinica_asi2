<!--LLAMAMOS EL ENCABEZADO-->
<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Especialidad Examen</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>especialidad_examenes">Especialidad Examen</a> </li>
            <li class="active">Agregar Especialidad Examen</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>editar_especialidad_examen/<?=$info_espe['codigo_espe']?>" method="post">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" id="nombre" value="<?=$info_espe['nombre']?>" class="form-control">
          </div>
          <div class="form-group">
          <label>Tipo Examen</label>
          <select name="tipo" id="tipo" class="form-control">
          <?php
          foreach ($tipo_examenes as $tipo_examen) {
            if($info_tipoex['codigo_tipex'] == $tipo_examen['codigo_tipex']){
            ?>
            <option value="<?=$tipo_examen['codigo_tipex']?>" selected><?=$tipo['tipo']?></option>
            <?php
            }else{
            ?>
            <option value="<?=$tipo_examen['codigo_tipex']?>"><?=$tipo_examen['tipo']?></option>
            <?php
            }          
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
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del consultorio." } );

  });
</script>