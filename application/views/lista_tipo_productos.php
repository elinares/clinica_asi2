<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Tipo de Productos</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">Tipo de productos</li>
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
    <a href="<?=base_url()?>agregar_tipo_producto" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo tipo de producto</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($tipo_productos)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Cantidad minima</th>
      <th>Cantidad maxima</th>
      <th>Existencia</th>
      <th>Tipo</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($tipo_productos as $tipo_producto) {
        if($tipo_producto['medicamento'] == 1){
          $tipo = 'Medicamento';
        }else{
          $tipo = 'Insumo/Equipo';
        }
        ?>
        <tr>
          <td><?=$tipo_producto['nombre']?></td>
          <td>$ <?=$tipo_producto['precio']?></td>
          <td><?=$tipo_producto['cantidad_minima']?></td>
          <td><?=$tipo_producto['cantidad_maxima']?></td>
          <td><?=$tipo_producto['existencia']?></td>
          <td><?=$tipo?></td>
          <td>
              <a href="<?=base_url()?>editar_tipo_producto/<?=$tipo_producto['codigo_tipoprod']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_tipo_producto/<?=$tipo_producto['codigo_tipoprod']?>" onclick="var result = confirm('¿Seguro que desea borrar este tipo de producto?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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