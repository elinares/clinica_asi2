<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Asignación de Permisos</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Inicio</a></li>            
            <li class="active">Asignación de Permisos</li>
        </ul>

        </div>
        <div class="main-content">

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>guardar_permisos/<?=$perfil?>" method="post">
          <div class="form-group">
          <label>Permisos</label>

            <table>
              <?php
              foreach ($permisos as $permiso) {                
                ?>
                <tr>
                  <td><input type="checkbox" value="<?=$permiso['codigo_permi']?>" name="permiso[]"></td>
                  <td>&nbsp;<?=$permiso['nombre']?></td>
                </tr>
                <?php
              }
              ?>              
            </table>         
          
          </div>
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>   
        </form>
      </div>
    </div>    
  </div>
</div>

<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('administrador/pie');
?>