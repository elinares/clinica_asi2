<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Municipios</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">Municipios</li>
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
    <a href="<?=base_url()?>agregar_municipio" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo Municipio</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($municipios)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Departamento</th>
      <th style="width: 3.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($municipios as $municipio) {
        ?>
        <tr>
          <td><?=$municipio['nombre']?></td>
          <td><?=$municipio['nombre_departamento']?></td>
          <td>
              <a href="<?=base_url()?>editar_municipio/<?=$municipio['cod_municipio']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_municipio/<?=$municipio['cod_municipio']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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