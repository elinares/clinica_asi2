<?php 
	$data['titulo']=$titulo;
	$this->load->view('administrador/encabezado',$data);
?>
<div class="content">
	<div class="header">
		<h1 class="page-title">Resultado de Busqueda</h1>
			<ul class="breadcrumb">
				<li><a href="<?=base_url()?>inicio">Inicio</a></li>
				<li class="active">Personas </li>
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

				?>
						<p>Si la persona no esta registrada puede  agregarla aquí</p>
						<a href="<?=base_url()?>agregar_paciente_op1" class="btn btn-primary"><i class="fa fa-plus"></i>Nuevo registro Persona paciente</a>


			<?php

			}else{
				?>
					Si la persona no esta registrada puede  agregarla aquí  <a href="<?=base_url()?>agregar_paciente_op1" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo registro Persona paciente</a>

					<br><br>
					<table class="table">
						<thead>
							<tr>
								<td>Nombre de la persona</td>
								<td>DUI</td>
								<td>Fecha de Nacimiento</td>
							<td colspan="2">							

							</td>	
							
							</tr>		
						
							</thead>


						<?php							
							foreach ($resultados_busqueda_paciente as $resultados_busqueda_paciente) {
								?>
								<tr>
									<td><?=$resultados_busqueda_paciente['nombres']?>&nbsp;<?=$resultados_busqueda_paciente['apellidos']?></td>
									<td><?=$resultados_busqueda_paciente['dui']?></td>
									<td><?=$resultados_busqueda_paciente['fecha_nacimiento']?></td>
									<td>
										<a href="<?=base_url()?>agregar_paciente_op2/<?=$resultados_busqueda_paciente['codigo_per']?>">Agregar a pacientes</a>
									</td>
									<td>
										<a href="<?=base_url()?>signos_vitales/<?=$resultados_busqueda_paciente['codigo_exp']?>" class="btn btn-primary"><i class="fa fa-stethoscope"></i> Toma de Signos Vitales</a>
									</td>
									   
								</tr> 
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