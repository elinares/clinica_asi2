<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('superadministrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Departamentos</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>superadmin">Inicio</a> </li>
            <li class="active">Departamentos</li>
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
            

<?php
if(empty($departamentos)){
  echo "No se encontraron registros.";
}else{  
?>
<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
    
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($departamentos as $departamento) {
        ?>
        <tr>
          <td><?=$departamento['nombre']?></td>
          
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