<!--LLAMAMOS EL ENCABEZADO-->
<?php
?>
<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>reportes/frm_compra_fecha" method="post">
          <div class="form-group">
          <label>Fecha Inicial</label>
          <input type="text" name="fecha_inicial" id="fecha_inicial" class="form-control">

          <label>Fecha Final</label>
          <input type="text" name="fecha_final" id="fecha_final" class="form-control">
          </div>
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Enviar</button>
          </div>   
        </form>
      </div>
    </div>    
  </div>
</div>



<script>
  $(document).ready(function(){

    //VALIDACION
    var nombre = new LiveValidation('nombre', { validMessage: "Gracias." });
    nombre.add( Validate.Presence, { failureMessage: "Por favor, ingrese el nombre del cargo." } );
    nombre.add(Validate.Format,{ pattern:/.[a-zA-Z]+$/, failureMessage: "No se permiten caracteres"})

  });
</script>