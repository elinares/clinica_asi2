<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
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
      <th>Nombre</th>
      <th>Cargo</th>
      <th>Estado</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($usuarios as $usuario) {
        ($usuario['estado'] == 0) ? $estado = 'Inactivo' : $estado = 'Activo';
        ?>
        <tr>
          <td><?=$usuario['nombre']?></td>
          <td><?=$usuario['nombre_perfil']?></td>
          <td><?=$estado?></td>
          <td>
              <a href="<?=base_url()?>editar_usuario/<?=$usuario['codigo_user']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_usuario/<?=$usuario['codigo_user']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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