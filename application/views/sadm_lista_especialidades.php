<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('superadministrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Especialidades</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>superadmin">Inicio</a> </li>
            <li class="active">Especialidades</li>
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
    <a href="<?=base_url()?>sadm_agregar_especialidad" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Especialidad</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($especialidades)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($especialidades as $especialidad) {
        ?>
        <tr>
          <td><?=$especialidad['nombre']?></td>
          <td>
              <a href="<?=base_url()?>sadm_editar_especialidad/<?=$especialidad['codigo_esp']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>sadm_borrar_especialidad/<?=$especialidad['codigo_esp']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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
$this->load->view('superadministrador/pie');
?>