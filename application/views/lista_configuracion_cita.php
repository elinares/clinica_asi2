<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Configuración Cita</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimiento</a> </li>
            <li class="active">Configuración Cita</li>
        </ul>

        </div>
        <div class="main-content">

        <?php
        if($this->session->userdata('mensaje')){
        ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
             <?php   
              echo $this->session->userdata('mensaje');             
             ?>
        </div>
        <?php
        }
        $this->session->unset_userdata('mensaje');
        ?>
            
<div class="btn-toolbar list-toolbar">
    <a href="<?=base_url()?>agregar_configuracion_cita" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Configuración Cita</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($configuracion_citas)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Hora Inicial</th>
      <th>Hora Final</th>
      <th>Cantidad Máxima</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($configuracion_citas as $configuracion_cita) {
        ?>
        <tr>
          <td><?=$configuracion_cita['hora_inicial']?></td>
          <td><?=$configuracion_cita['hora_final']?></td>
          <td><?=$configuracion_cita['cantidad_maxima']?></td>
          <td>
              <a href="<?=base_url()?>editar_configuracion_cita/<?=$configuracion_cita['codigo_confi']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_configuracion_cita/<?=$configuracion_cita['codigo_confi']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
          </td>
        </tr>
        <?php
      }
    ?>    
  </tbody>
</table>
<?php
}
?>
<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('administrador/pie');
?>