<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Cita</h1>
                    <ul class="breadcrumb">
            <li><a href="<?=base_url()?>inicio">Mantenimientos</a> </li>
            <li><a href="<?=base_url()?>citas">Citas</a> </li>
            <li class="active">Asignando Citas</li>
        </ul>

        </div>
        <div class="main-content">


<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>ingresar_cita" method="post">
          <div class="form-group">
           <?php foreach ($paciente as $paciente) {
          ?>
          <input type="hidden" value="<?=$paciente['codigo_pac']?>" name="codigo_paciente">
           <label>Nombre Paciente: </label>&nbsp;<label><b><?php echo $paciente['nombres']; ?>&nbsp; <?php echo $paciente ['apellidos'];?></b></label> 
          <?php
         }
          ?>
          <br>
          <label>Fecha</label>
          <input type="date" name="fecha" id="fecha" class="form-control">
         
          </div>

          <div class="form-group">
          <label>Hora</label>
          <select name="hora" id="hora" class="form-control">
          <?php
          foreach ($configuracion as $configura) {
          ?>
          <option value="<?=$configura['codigo_confi']?>"><?=$configura['hora_inicial']?></option>
          <?php
          }
          ?>
          </select>
          </div>
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>   
        </form>
      </div>
    </div>    
  </div>
</div>

<?php
$this->load->view('administrador/pie');
?>