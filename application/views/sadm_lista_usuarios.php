<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('superadministrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Usuarios</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>superadmin">Inicio</a> </li>
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
      <th><center>Acciones</center></th>
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
          <td><?=$usuario['usuario']?></td>
          <td><a href="<?=base_url()?>editar_pass/<?=$usuario['codigo_user']?>">Cambiar Password</a></td>
         
          
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
$this->load->view('superadministrador/pie');
?>