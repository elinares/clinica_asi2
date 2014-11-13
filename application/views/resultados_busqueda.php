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
		
		<?php
			if (empty($resultados_busqueda))
			{
				echo "No se encontraron registros";
			}else{
				?>
					<table class="table">
						<thead>
							<tr>
								<td>Nombre de Paciente</td>
							
							</tr>		
						</thead>
						<?php
							foreach ($resultados_busqueda as $resultados_busqueda) {
								?>
									<td><?=$resultados_busqueda['nombres']?>&nbsp;<?=$resultados_busqueda['apellidos']?></td>
									<td><a href="<?=base_url()?>asignacion_cita/<?=$resultados_busqueda['codigo_pac']?>">Asignar Cita</a>
									    
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