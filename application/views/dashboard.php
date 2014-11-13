<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            <!--ALERTAS-->
            <div class="stats">
            <?php
            $cant_min = count($this->modelo_admin->minima_existencia());
            $cant_max = count($this->modelo_admin->maxima_existencia());
            $cant_ven = count($this->modelo_admin->lista_vencimientos($user_info['codigo_cli']));

            if($cant_max!=0){
            ?>
            <p class="stat"><a href="<?=base_url()?>maxima_existencia"><span class="label label-info"><?php echo $cant_max?></span></a> Máximo de existencia</p>
            <?php
            }
            if($cant_min!=0){
            ?>
            <p class="stat"><a href="<?=base_url()?>minima_existencia"><span class="label label-warning"><?php echo $cant_min?></span></a> Mínimo de existencia</p>
            <?php
            }
            if($cant_ven!=0){
            ?>
            <p class="stat"><a href="<?=base_url()?>lista_vencimientos"><span class="label label-danger"><?php echo $cant_ven?></span></a> Medicamentos a vencer</p>
            <?php
            }
            ?> 
            </div>
            

            <h1 class="page-title">Bienvenido <b><?=$user_info['nombre_persona'].' '.$user_info['apellidos_persona'] ?></b></h1>
            <h3>Has iniciado como empleado de la clinica : <?=$user_info['nombre_clinica']?></h3>
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