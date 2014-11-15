<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">New Empleados</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">New Empleados</li>
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
    <a href="<?=base_url()?>agregar_new_empleado" class="btn btn-primary"><i class="fa fa-plus"></i> New Empleado</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($new_empleados)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Cumpleaños</th>
      <th>Estado Civil</th>
      <th>Genero</th>
      <th>DUI</th>
      <th>Codigo Persona</th>
      <th>NIT</th>
      <th>ISSS</th>
      <th>NUP</th>
      <th>JVPM</th>


      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($new_empleados as $empleado) {
        ?>
        <tr>
          
          <td><?=$empleado['nombres_empleado']?></td>
          <td><?=$empleado['apellidos_empleado']?></td>
          <td><?=$empleado['cumpleaños']?></td>
          <td><?=$empleado['estado_civil']?></td>
          <td><?=$empleado['genero']?></td>
          <td><?=$empleado['dui']?></td>
          <td><?=$empleado['fk_codigo_per']?></td>
          <td><?=$empleado['nit']?></td>
          <td><?=$empleado['isss']?></td>
          <td><?=$empleado['nup']?></td>
          <td><?=$empleado['jvpm']?></td>




          <td>
              <a href="<?=base_url()?>editar_persona/<?=$persona['codigo_per']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_persona/<?=$persona['codigo_per']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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