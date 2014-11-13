<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Compras</h1>
                    <ul class="breadcrumb">            
                        <li class="active">Compras</li>
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
    <a href="<?=base_url()?>agregar_compra" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Compra</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($compras)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>No de Factura</th>
      <th>Fecha</th>
      <th>Total de Compra</th>
      <th style="width: 5.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($compras as $compra) {
        ?>
        <tr>
          <td><?=$compra['factura']?></td>
          <td><?=$compra['fecha']?></td>
          <td>$ <?=$compra['total']?></td>
          <td>
              <a href="<?=base_url()?>informacion_compra/<?=$compra['codigo_comp']?>"><i class="fa fa-info-circle"></i></a>
              <a href="<?=base_url()?>editar_compra/<?=$compra['codigo_comp']?>"><i class="fa fa-pencil"></i></a>
              <!--<a href="<?=base_url()?>borrar_compra/<?=$compra['codigo_comp']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>-->
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