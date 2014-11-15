<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Consulta</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Inicio</a> </li>
            <li class="active">Agregar Consulta</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>consulta/<?=$expediente?>/<?=$servicio_medico?>" method="post">
          <div class="form-group">
          <label>Diagnostigo</label>          
          <textarea rows="5" name="diagnostico" class="form-control"></textarea>
          </div>
          <div class="form-group">
          <label>Examen Físico</label>          
          <textarea rows="5" name="examen_fisico" class="form-control"></textarea>
          </div>
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar Consulta</button>
          </div>   
        </form>
      </div>
    </div>    
  </div>
  <div class="col-md-8">
    <div class="panel panel-default">
            <div class="panel-heading no-collapse">Expediente</div>
            <div style="padding: 8px; border-bottom: 1px solid #ddd">
              <table style="width:100%;">
                <tr>
                  <td>Nombre: </td><td><?php echo $paciente['nombres'].' '.$paciente['apellidos']?></td>
                  <td>Fecha de Nacimiento: </td><td><?php echo $paciente['fecha_nacimiento']?></td>
                </tr>
                <tr>
                  <td>Alergia: </td><td><?php echo $paciente['alergia']?></td>
                  <td>Padecimiento: </td><td><?php echo $paciente['enfermedad_padecida']?></td>
                </tr>
                <tr>
                  <td>Antecedente: </td><td><?php echo $paciente['antecedente']?></td>
                  <td></td>
                </tr>
              </table>
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Sintoma</th>
                  <th>Presión</th>
                  <th>Temperatura</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if(empty($historico)){
                  ?>
                  <tr>
                    <td colspan="4">No se encontraron registros.</td>
                  </tr>
                  <?php
                }else{
                  foreach ($historico as $value) {
                    ?>
                    <tr>
                      <td><?=$value['fecha_consulta']?></td>
                      <td><?=$value['sintoma']?></td>
                      <td><?=$value['presion_arterial']?></td>
                      <td><?=$value['temperatura']?> ºC</td>
                    </tr>
                    <?php
                  }
                }                
                ?>                               
              </tbody>
            </table>
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
    var diagnostico = new LiveValidation('diagnostico', { validMessage: "Gracias." });
    diagnostico.add( Validate.Presence, { failureMessage: "Por favor, ingrese el diagnostico del paciente." } );

    //VALIDACION
    var examen_fisico = new LiveValidation('examen_fisico', { validMessage: "Gracias." });
    examen_fisico.add( Validate.Presence, { failureMessage: "Por favor, ingrese el resultado del examen físico del paciente." } );

  });
</script>