<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Personas</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li class="active">Personas</li>
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
    <a href="<?=base_url()?>agregar_persona" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Persona</a>
  <div class="btn-group">
  </div>
</div>
<?php
if(empty($personas)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre<s/th>
      <th>Apellidos</th>
      <th>F. Nacimiento</th>
      <th>Direccion</th>
      <th>Estado Civil</th>
      <th>Genero</th>
      <th>DUI</th>

      <th>Municipio</th>

      <th style="width: 4.5em;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($personas as $persona) {
        ?>
        <tr>
          <td><?=$persona['nombres']?></td>
          <td><?=$persona['apellidos']?></td>
          <td><?=$persona['fecha_nacimiento']?></td>
          <td><?=$persona['direccion']?></td>
          <td><?=$persona['estado_civil']?></td>
          <td><?=$persona['genero']?></td>
          <td><?=$persona['dui']?></td>

          <td><?=$persona['nombre_municipio']?></td>


          <td>
              <a href="<?=base_url()?>editar_persona/<?=$persona['codigo_per']?>"><i class="fa fa-pencil"></i></a>
              <a href="<?=base_url()?>borrar_persona/<?=$persona['codigo_per']?>" onclick="var result = confirm('¿Seguro que desea borrar este registro?\nEsto no se podrá revertir.'); if (result==true) { return true; } return false;"><i class="fa fa-trash-o"></i></a>
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