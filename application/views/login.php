<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('login/encabezado', $data);
?>

<?php
if($this->session->userdata('mensaje')){
?>
<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php   
    echo $this->session->userdata('mensaje');             
    ?>
</div>
<?php
}
$this->session->unset_userdata('mensaje');
?>

<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Login</p>
        <div class="panel-body">
            <form action="<?=base_url()?>administrador/login" method="post">
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control span12" name="usuario" id="usuario">
                </div>
                <div class="form-group">
                <label>Contraseña</label>
                    <input type="password" class="form-control span12" name="contrasena" id="contrasena">
                </div>
                <button class="btn btn-primary pull-right">Ingresar</button>                
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>

<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('login/pie');
?>

<script>
  $(document).ready(function(){

    //VALIDACION
    var usuario = new LiveValidation('usuario', { validMessage: "Gracias." });
    usuario.add( Validate.Presence, { failureMessage: "Por favor, ingrese su usuario." } );

    var contrasena = new LiveValidation('contrasena', { validMessage: "Gracias." });
    contrasena.add( Validate.Presence, { failureMessage: "Por favor, ingrese su contraseña." } );

  });
</script>