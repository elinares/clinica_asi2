<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Clínicas</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">Clínicas</li>
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
    <a href="<?=base_url()?>agregar_clinica" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Clínica</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($clinicas)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Encargado</th>
      <th>Dirección</th>
      <th>Teléfono</th>
      <th>Email</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($clinicas as $clinica) {
        ?>
        <tr>
          <td><?=$clinica['nombre']?></td>
          <td><?=$clinica['encargado']?></td>
          <td><?=$clinica['direccion']?></td>
          <td><?=$clinica['telefono']?></td>
          <td><?=$clinica['email']?></td>
          <td>
              <a href="<?=base_url()?>editar_clinica/<?=$clinica['cod_clinica']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_clinica/<?=$clinica['cod_clinica']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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