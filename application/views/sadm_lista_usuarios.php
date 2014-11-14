<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('superadministrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Usuarios</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">Usuarios</li>
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
    <a href="<?=base_url()?>agregar_usuario" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Usuario</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($usuarios)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th colspan="2">Nombre</th>
      <th>Nombre Usuario</th>
      <th colspan="4"><center>Acciones</center></th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($usuarios as $usuario) {
        ?>
        <tr>
          <td><?=$usuario['nombres']?></td>
          <td><?=$usuario['apellidos']?></td>
          <td><?=$usuario['nombre']?></td>
          <td><a href="<?=base_url()?>editar_pass/<?=$usuario['codigo_user']?>">Cambiar Password</a></td>
          <td><a href="<?base_url()?>asignar_clinica/<?=$usuario['codigo_user']?>">Asignar Clinica</a></td>
          <td><a href="<?=base_url()?>editar_datos/<?=$usuario['codigo_user']?>">Editar</a></td>
          <td><a href="<?=base_url()?>eliminar/<?=$usuario['codigo_user']?>">Eliminar</a></td>
         
          
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