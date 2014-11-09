<?php
	$data['titulo'] = $titulo;
	$this->load->view('administrador/encabezado');
?>
<div class="content">
	<div class="header">
		<h1 class="page-title">Buscar Paciente</h1>
			<ul class="breadcrumb">
				<li><a href="<?=base_url()?>Inicio">Mantenimientos</a></li>
				<li><a href="<?=base_url()?>Citas">Citas</a></li>
				<li class="active">Buscar Paciente</li>
			</ul>
	</div>
	<div class="main-content">
		<div class="col-md-4">
			<br>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active in" id="home">
					<form id="tab" action="<?=base_url()?>buscar_paciente" method="post">
						<div class="form-group">
							<label>Nombre Paciente</label>
							<input type="text" name="criterio" id="criterio" class="form-control">
						</div>
						<div class="btn-toolbar list-toolbar">
							<button class="btn btn-primary"><i class="fa fa-save"></i>Buscar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	$this->load->view('administrador/pie');
?>