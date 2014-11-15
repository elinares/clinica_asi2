<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Donación</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimiento</a> </li>
            <li class="active">Donaciones</li>
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
    <a href="<?=base_url()?>agregar_donacion" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Donación</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($donaciones)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>

      <th>Nombre</th>
      <th>Primer Apellido</th>
      <th>Segundo Apellido</th>
      <th>Dirección</th>
      <th>Teléfono</th>
      <th>Correo</th>
      <th>Tipo Documento</th>
      <th>N° Documento</th>
      <th>Monto</th>
      <th>Estado</th>
      <th>Fecha</th>
      <th>Clinica</th>
      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($donaciones as $donacion) {
        ?>
        <tr>
          <td><?=$donacion['nombres_donante']?></td>
          <td><?=$donacion['apellido1']?></td>
          <td><?=$donacion['apellido2']?></td>
          <td><?=$donacion['direccion']?></td>
          <td><?=$donacion['telefono']?></td>
          <td><?=$donacion['email']?></td>
          <td><?=$donacion['tipo_documento']?></td>
          <td><?=$donacion['numero_documento']?></td>
          <td><?=$donacion['monto']?></td>
          <td><?=$donacion['estado']?></td>
          <td><?=$donacion['fecha']?></td>
          <td><?=$donacion['clinica']?></td>

          <td>
              <a href="<?=base_url()?>editar_donacion/<?=$donacion['codigo_dona']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_donacion/<?=$donacion['codigo_dona']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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