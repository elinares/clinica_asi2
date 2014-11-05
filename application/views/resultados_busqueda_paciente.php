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
			if (empty($resultados_busqueda_paciente))
			{
				echo "No se encontraron registros";
			}else{
				?>
					<table class="table">
						<thead>
							<tr>
								<td>Nombre de persona que desea agregar a pacientes</td>

							<td>
							<p>Si la persona no esta registrada puede  agregarla a qui</p>
								<a href="<?=base_url()?>agregar_paciente_op1" class="btn btn-primary"><i class="fa fa-plus"></i>Nuevo registro Persona paciente</a>

							</td>	
							
							</tr>		
						</thead>
						<?php
							foreach ($resultados_busqueda_paciente as $resultados_busqueda_paciente) {
								?>
									<td><?=$resultados_busqueda_paciente['nombres']?>&nbsp;<?=$resultados_busqueda_paciente['apellidos']?></td>
									<td><a href="<?=base_url()?>agregar_paciente_op2/<?=$resultados_busqueda_paciente['codigo_per']?>">agaregar a pacientes</a>
									    
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