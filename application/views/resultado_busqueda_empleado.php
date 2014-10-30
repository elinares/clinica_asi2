<?php 
	$data['titulo']=$titulo;
	$this->load->view('administrador/encabezado',$data);
?>
<div class="content">
	<div class="header">
		<h1 class="page-title">Empleados</h1>
			<ul class="breadcrumb">
				<li><a href="<?=base_url()?>Inicio">Inicio</a></li>
				<li class="active">Empleados</li>
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
		
		<?php
			if (empty($resultado_busqueda_empleado))
			{
				echo "No se encontraron registros";
			}else{
				?>
					<table class="table">
						<thead>
							<tr>
								<td>Nombre de Empleado</td>
							
							</tr>		
						</thead>
						<?php
							foreach ($resultado_busqueda_empleado as $resultado_busqueda_empleado) {
								?>
									<td><?=$resultado_busqueda_empleado['nombres']?>&nbsp;<?=$resultado_busqueda_empleado['apellidos']?></td>
									<td><a href="<?=base_url()?>asignacion_empleado/<?=$resultado_busqueda_empleado['codigo_per']?>">Agregar Empleado</a></td>
									    
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