<!--LLAMAMOS EL ENCABEZADO-->
<?php
$data['titulo'] = $titulo;
$this->load->view('administrador/encabezado', $data);
?>
<div class="content">
        <div class="header">
            
            <h1 class="page-title">Agregar Compra</h1>
                    <ul class="breadcrumb">            
                        <li><a href="<?=base_url()?>compras">Compras</a> </li>
                        <li class="active">Agregar Compra</li>
                    </ul>

        </div>
        <div class="main-content">

<div class="row">
  
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form id="tab" action="<?=base_url()?>agregar_compra" method="post">
          <div class="col-md-4">
            <div class="form-group">
              <label>No de Factura</label>
              <input type="text" name="factura" id="factura" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Fecha de Compra</label>
              <input type="text" name="fecha" id="fecha" class="form-control">
            </div>
          </div>

          <div style="clear:both;"></div>

          <div class="col-md-8">
            <div class="btn-toolbar list-toolbar">
              <a href="#myModal" data-toggle="modal" class="btn btn-primary" id="add-prd-modal"><i class="fa fa-plus-square-o"></i> Agregar Producto</a>
            </div>   
          </div>
          <div class="col-sm-6 col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading no-collapse">Detalle de Productos<span class="label label-warning">$ <span id="total">0</span></span></div>
              <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Presentación</th>
                  <th>Cantidad</th>
                  <th>Costo</th>
                  <th>Fecha de Vencimiento</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
            </div>
          </div>
          <div class="col-md-8">
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary" id="submit"><i class="fa fa-save"></i> Guardar</button>
          </div>   
          </div>
        </form>
      </div>
    </div>    

    <!--MODAL-->
    <div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">            
            <h3 id="myModalLabel">Agregar Producto</h3>
          </div>
          <div class="modal-body">
            
            <div class="col-md-12">
              <div class="form-group">
                <label>Producto</label>
                <select name="producto" id="producto" class="form-control">
                  <option value="">Seleccionar...</option>
                  <?php
                  foreach ($tipos_productos as $prod) {
                  ?>
                  <option value="<?=$prod['codigo_tipoprod']?>"><?=$prod['nombre']?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Tipo de Preentación</label>
                <select name="presentacion" id="presentacion" class="form-control">
                  <option value="">Seleccionar...</option>
                  <?php
                  foreach ($tipos_presentaciones as $tpres) {
                  ?>
                  <option value="<?=$tpres['codigo_tipre']?>"><?=$tpres['tipo']?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Cantidad</label>
                <input type="text" name="cantidad" id="cantidad" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Costo</label>
                <input type="text" name="costo" id="costo" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Fecha de Vencimiento</label>
                <input type="text" name="fecha_venc" id="fecha_venc" class="form-control">
              </div>
            </div>
            
          </div>
          <div class="modal-footer" style="border: none;">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-primary" data-dismiss="modal" id="add-prd">Agregar</button>
          </div>
        </div>
      </div>
    </div>
  
</div>

<!--LLAMAMOS EL PIE DE PAGINA-->
<?php
$this->load->view('administrador/pie');
?>

<script>
  $(document).ready(function(){

    $(function() {
      $( "#fecha" ).datepicker({ 
        dateFormat: "yy-mm-dd",
        maxDate: "0" });

      $( "#fecha_venc" ).datepicker({ 
        dateFormat: "yy-mm-dd",
        minDate: "0", 
        maxDate: "+5Y" });
    });

    $("#add-prd").on("click", function(){ 

      if($("#producto").val() == ""){
        alert('Por favor, seleccione el producto a ingresar.');
        $("#producto").focus();
        return false;
      }
      if($("#presentacion").val() == ""){
        alert('Por favor, seleccione el tipo de presentación del producto a ingresar.');
        $("#presentacion").focus();
        return false;
      }
      if($("#cantidad").val() == ""){
        alert('Por favor, digite la cantidad de productos.');
        $("#cantidad").focus();
        return false;
      }
      if($("#costo").val() == ""){
        alert('Por favor, digite el costo unitario del producto.');
        $("#costo").focus();
        return false;
      }     
      if($("#fecha_venc").val() == ""){
        alert('Por favor, seleccione la fecha de vencimiento del producto.');
        $("#fecha_venc").focus();
        return false;
      }

      var producto = $("#producto option:selected").val();
      var presentacion = $("#presentacion option:selected").val();
      var producto_txt = $("#producto option:selected").text();
      var presentacion_txt = $("#presentacion option:selected").text();
      var cantidad = parseFloat($("#cantidad").val());
      var costo = parseFloat($("#costo").val());
      var fecha_venc = $("#fecha_venc").val();

      $(".panel table tbody").append("\
        <tr class=\"detalle_prd\">\
          <input type=\"hidden\" name=\"codigo_producto[]\" value=\""+producto+"\">\
          <input type=\"hidden\" name=\"presentacion_producto[]\" value=\""+presentacion+"\">\
          <input type=\"hidden\" name=\"costo_producto[]\" value=\""+costo+"\">\
          <input type=\"hidden\" name=\"cantidad_producto[]\" value=\""+cantidad+"\">\
          <input type=\"hidden\" name=\"fvenc_producto[]\" value=\""+fecha_venc+"\">\
          <td>"+producto_txt+"</td>\
          <td>"+presentacion_txt+"</td>\
          <td>"+cantidad+"</td>\
          <td>$ "+costo+"</td>\
          <td>"+fecha_venc+"</td>\
          <td><a type=\"button\" class=\"close\" aria-hidden=\"true\">x</a></td>\
        </tr>\
        ");

      var total = (costo*cantidad) + parseFloat($("#total").text());
      $("#total").html(total);

      //Reinicio de campos en modal
      $('#producto').prop('selectedIndex',0);
      $("#cantidad").val('');
      $("#costo").val('');
      $("#fecha_venc").val('');

      //Eliminar detalle
      $(".close").on("click", function(){
        $(this).parent().parent().remove();
      });

    });    

    /*$('#add-prd-modal').on('click', function() {
      //Validacion modal
      var cantidad = new LiveValidation('cantidad', { validMessage: "Gracias." });      
    });*/

    $('#submit').on('click', function() {
      if($(".detalle_prd").length == 0){
        alert("Por favor, agregue al menos un producto para la compra.")
      }
    });

    //VALIDACION
    var factura = new LiveValidation('factura', { validMessage: "Gracias." });
    factura.add( Validate.Presence, { failureMessage: "Por favor, ingrese el número de la factura." } );

    var fecha = new LiveValidation('fecha', { validMessage: "Gracias." });
    fecha.add( Validate.Presence, { failureMessage: "Por favor, ingrese la fecha de realización de la compra." } );

  });
</script>