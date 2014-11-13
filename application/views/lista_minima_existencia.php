<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Medicamentos con el mínimo de existencia</h1>
                    <ul class="breadcrumb">            
            <li class="active">Alertas</li>
        </ul>

        </div>
        <div class="main-content">
<?php
if(empty($medicamentos)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Precio</th>
      <th>Cantidad Mínima</th>
      <th>Cantidad Máxima</th>
      <th>Existencia</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($medicamentos as $medicamento) {
        ?>
        <tr>
          <td><?=$medicamento['nombre']?></td>          
          <td>$ <?=$medicamento['precio']?></td>
          <td style="color:orange; font-weight:bold;"><?=$medicamento['cantidad_minima']?></td>
          <td><?=$medicamento['cantidad_maxima']?></td>
          <td style="color:orange; font-weight:bold;"><?=$medicamento['existencia']?></td>
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