<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            

            <h1 class="page-title">Bienvenido <b><?=$user_info['nombre_persona'].' '.$user_info['apellidos']?></b></h1>
            <ul class="breadcrumb">            
              <li class="active">Inicio</li>
            </ul>

        </div>
        <div class="main-content">
    

        <div class="row">
            <div class="col-sm-4 col-md-4 col-sm-offset-4">
                <img class="img-responsive" src="<?=base_url()?>img/logo.jpg">
            </div>    
        </div>

<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('administrador/pie');
?>