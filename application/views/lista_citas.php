<?php
$data['titulo']=$titulo;
$this->load->view('administrador/encabezado',$data);
?>
<div class="content">
	<div class="header">
		<h1 class="page-title">Citas</h1>
			<ul class="breadcrumb">
				<li><a href="<?=base_url()?>Inicio">Inicio</a></li>
				<li class="active">Citas</li>
			</ul>
	</div>
	<div class="maint-content">
		<?php
			if ($this->session->userdata('mensaje'))
			{
				?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">x</button>
						<?php
							echo $this->session->userdata('mensaje');
						?>
					</div>
				<?php
			}
			$this->session->unset_userdata('mensaje');
		?>
		<div class="btn-toolbar list-toolbar">
			<a href="<?=base_url()?>buscar_paciente" class="btn btn-primary"><i class="fa fa-pluss"></i>Nueva Cita</a>
			<div class="btn-group">
			</div>
		</div>
		<?php
			if (empty($citas))
			{
				echo "No se encontraron registros";
			}else{
				?>
					<table class="table">
						<thead>
							<tr>
								<td>Nombre de Paciente</td>
								<td>Fecha</td>
							</tr>		
						</thead>
						<?php
							foreach ($citas as $cita) {
								?>
									<td><?=$cita['nombre']?>&nbsp;<?=$cita['primer_apellido']?>&nbsp;<?=$cita['segundo_apellido']?></td>
									<td><?=$cita['fecha']?></td>
								<?php
							}
						?>
							
					</table>
				<?php
			}
		?>
	</div>
</div>
<?php
$this->load->view('administrador/pie');
?>