<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Lotes de medicamento próximos a vencer</h1>
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
      <th>Cantidad de Producto</th>
      <th>Fecha de Vencimiento</th>      
      <th>Faltan</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($medicamentos as $medicamento) {
        if($medicamento['dias']<0){
          $medicamento['dias']=0;
        }
        ?>
        <tr>
          <td><?=$medicamento['nombre']?></td>          
          <td><?=$medicamento['cantidad']?></td>
          <td style="color:orange; font-weight:bold;"><?=$medicamento['fecha_vencimiento']?></td>
          <td style="color:orange; font-weight:bold;"><?=$medicamento['dias']?> días</td>
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