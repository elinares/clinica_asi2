<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Empleados</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">Empleados</li>
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
    <a href="<?=base_url()?>buscar_empleado" class="btn btn-primary"><i class="fa fa-plus"></i>Nuevo Empleado</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($empleados)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Nit</th>
      <th>Especialidad</th>
      <th>Cargo</th>
      
    

      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($empleados as $empleado) {
        ?>
        <tr>
          <td><?=$empleado['nombres']?></td>
          <td><?=$empleado['apellidos']?></td>
          <td><?=$empleado['especialidad']?></td>
          <td><?=$empleado['nit']?></td>
          <td><?=$empleado['cargo']?></td>


          <td>
              <a href="<?=base_url()?>editar_empleado/<?=$empleado['codigo_emp']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_empleado/<?=$empleado['codigo_emp']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (empleado==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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