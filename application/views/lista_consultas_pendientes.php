<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Consultas Pendientes - <?=$consultorio['nombre']?></h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Inicio</a> </li>
            <li class="active">Consultas Pendientes</li>
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
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($consultas_pendientes)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre del Paciente</th>
      <th>Tipo de Servicio</th>
      <th>Estado de Servicio</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php          
      foreach ($consultas_pendientes as $consultas) {
        ?>
        <tr>          
          <td><?=$consultas['nombres']." ".$consultas['apellidos']?></td>
          <td><?=$consultas['nombre']?></td>
          <td><?=$consultas['estado']?></td>
          <td>
              <a href="<?=base_url()?>consulta/<?=$consultas['codigo_exp']?>/<?=$consultas['codigo_servimed']?>"><i class="fa fa-user-md"></i></a>
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