<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Superadministrador extends CI_Controller {
	
	public function inicio()
	{
		$data['user_info'] = $this->session->userdata('user_info');
		$data['titulo'] = 'Super Administrador - Clínicas Municipales';
		$this->load->view('sadm_dashboard', $data);
	}
	/*Mantenimiento Clinica*/
	public function sadm_clinicas()
	{
		$data['clinicas'] = $this->modelo_admin->obt_clinicas();
		$data['titulo'] = 'Administrador - Clínicas';

		$this->load->view('sadm_lista_clinicas', $data);
	}

	public function sadm_agregar_clinica()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$encargado = $this->input->post('encargado');
			$direccion = $this->input->post('direccion');
			$telefono = $this->input->post('telefono');
			$email = $this->input->post('email');

			$datos = array(
				'nombre' => $nombre,
				'encargado'=> $encargado,
				'direccion'=> $direccion,
				'telefono'=> $telefono,
				'email'=> $email
				);

			$result = $this->modelo_admin->guardar_item($datos, 'clinica');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('asignar_usuario');
			}
		}
		/*$data['municipio']*/
		$data['titulo'] = 'Administrador - Agregar Clínica';

		$this->load->view('sadm_agregar_clinica', $data);
	}


	/*editar clinica*/
	public function editar_clinica($id){

		$datos = $this->modelo_admin->obt_clinica($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$encargado = $this->input->post('encargado');
			$direccion = $this->input->post('direccion');
			$telefono = $this->input->post('telefono');
			$email = $this->input->post('email');

			$datos2 = array(
				'nombre' => $nombre,
				'encargado'=> $encargado,
				'direccion'=> $direccion,
				'telefono'=> $telefono,
				'email'=> $email
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_cli', 'clinica');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('clinicas');
			}
		}

		$data['info_cli'] = $datos;
		$data['titulo'] = 'Administrador - Editar Clínica';

		$this->load->view('sadm_editar_clinica', $data);
	}


	/*proceso de asignar usuario*/
	public function asignar_usuario()
	{
		if ($this->input->post()){
				/*obtengo el ultimo id de la clinica*/
			
			$data= $this->modelo_admin->obt_ultima_clinica();
			$id_clinica=$data['ultimo_id'];
			/*comienzo a insertar persona*/
			$nombre=$this->input->post('nombres');
			$apellido=$this->input->post('apellidos');
			$fecha_nacimiento=$this->input->post('fecha_nacimiento');
			$direccion=$this->input->post('direccion');
			$estado_civil=$this->input->post('estado_civil');
			$genero=$this->input->post('genero');
			$dui=$this->input->post('dui');
			$fk_codigo_muni=$this->input->post('fk_codigo_muni');
						/*armo arreglo para insertar persona*/
			$datos= array(
				'nombres'=>$nombre,
				'apellidos'=>$apellido,
				'fecha_nacimiento'=>$fecha_nacimiento,
				'direccion'=>$direccion,
				'estado_civil'=>$estado_civil,
				'genero'=>$genero,
				'dui'=>$dui,
				'fk_codigo_muni'=>$fk_codigo_muni
				);
			$result1=$this->modelo_admin->guardar_item($datos,'persona');
			if ($result1){
				$fk_codigo_per= $this->db->insert_id();
				/*inserto datos del usuario*/
			$nombre_usuario=$this->input->post('usuario');
				$password=$this->input->post('password');
				$estado=1;
				$perfil=2;
				$datos2=array( 
					'nombre'=>$nombre_usuario,
					'password'=>md5($password),
					'estado'=>$estado,
					'fk_codigo_perf'=>$perfil
					);
				$result2=$this->modelo_admin->guardar_item($datos2,'usuario');
				if ($result2){
					$fk_codigo_user=$this->db->insert_id();
					/*inserto datos del empleado*/
					$nit=$this->input->post('nit');
					$isss=$this->input->post('isss');
					$nup=$this->input->post('nup');
					$jvpm=$this->input->post('jvm');
					$fk_codigo_carg=$this->input->post('fk_codigo_carg');
					$fk_codigo_esp=$this->input->post('fk_codigo_esp');
					$datos3=array(
						'fk_codigo_per'=>$fk_codigo_per,
						'fk_codigo_user'=>$fk_codigo_user,
						'nit'=>$nit,
						'isss'=>$isss,
						'nup'=>$nup,
						'jvpm'=>$jvpm,
						'fk_codigo_carg'=>$fk_codigo_carg,
						'fk_codigo_esp'=>$fk_codigo_esp
						);
					$result3=$this->modelo_admin->guardar_item($datos3,'empleado');
					if ($result3){
							$fk_codigo_emp=$this->db->insert_id();
						$datos4=array(
							'fk_codigo_emp'=>$fk_codigo_emp,
							'fk_codigo_cli'=>$id_clinica
							);
						$result4=$this->modelo_admin->guardar_item($datos4,'empleado_clinica');
						if($result4){
					$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
					redirect('sadm_clinicas');
				}	
					}
				}
			}

			
		}
		$data['municipios']=$this->modelo_admin->obt_municipios();
		$data['cargos']=$this->modelo_admin->obt_cargos();
		$data['especialidades']=$this->modelo_admin->obt_especialidades();
		$data['titulo']='Agregar Usuario';
		$this->load->view('crear_usuario', $data);
	}

	/*mantenimiento cargos para superadmin*/
	public function sadm_cargos()
	{

		$data['cargos'] = $this->modelo_admin->obt_cargos();
		$data['titulo'] = 'Administrador - Cargos';

		$this->load->view('sadm_lista_cargos', $data);
	}
	public function sadm_agregar_cargo()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'cargo');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('sadm_cargos');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Cargo';

		$this->load->view('sadm_agregar_cargo', $data);
	}


	public function sadm_editar_cargo($id){

		$datos = $this->modelo_admin->obt_cargo($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_carg', 'cargo');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('sadm_cargos');
			}
		}

		$data['info_car'] = $datos;
		$data['titulo'] = 'Administrador - Editar Cargo';

		$this->load->view('sadm_editar_cargo', $data);
	}

	public function sadm_borrar_cargo($id){

		$this->db->where('codigo_carg', $id);
		$result = $this->db->delete('cargo'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('sadm_cargos');
		}
	}

	/*Mantenimiento Especialidades*/
	public function sadm_especialidad()
	{
		$data['especialidades'] = $this->modelo_admin->obt_especialidades();
		$data['titulo'] = 'Administrador - Especialidades';

		$this->load->view('sadm_lista_especialidades', $data);
	}

	/*Agregar especialidad*/
	public function sadm_agregar_especialidad()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'especialidad');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('sadm_especialidad');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Especialidad';

		$this->load->view('sadm_agregar_especialidad', $data);
	}
		public function sadm_editar_especialidad($id){

		$datos = $this->modelo_admin->obt_especialidad($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_esp', 'especialidad');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('sadm_especialidad');
			}
		}

		$data['info_esp'] = $datos;
		$data['titulo'] = 'Administrador - Editar Especialidad';

		$this->load->view('sadm_editar_especialidad', $data);
	}

	public function sadm_borrar_especialidad($id){

		$this->db->where('codigo_esp', $id);
		$result = $this->db->delete('especialidad'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('sadm_especialidad');
		}
	}

	/*mantenimiento usuarios*/
	public function sadm_usuarios()
	{
		$data['usuarios'] = $this->modelo_admin->obt_usuarios_superadmin();
		$data['titulo'] = 'Administrador - Usuarios';

		$this->load->view('sadm_lista_usuarios', $data);
	}
	public function editar_pass($id){
		$datos=$this->modelo_admin->obt_usuario($id);
		if($this->input->post()){	
			$password=$this->input->post['password'];
			
			$datos =array(
				'password' => md5($password) 
				);
			$result = $this->modelo_admin->act_item($datos, $id, 'codigo_user', 'usuario');
			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('sadm_usuarios');
			}

		}
		$data['info_usu'] = $datos;
		$data['titulo'] = 'Administrador - Cambiar Password';
		$this->load->view('editar_pass', $data);

	}
	public function asignar_clinica($id){
		
	}

		public function sadm_departamentos()
	{
		$data['departamentos'] = $this->modelo_admin->obt_departamentos();
		$data['titulo'] = 'Administrador - Departamentos';

		$this->load->view('sadm_lista_departamentos', $data);
	}

	public function sadm_agregar_departamento()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'departamento');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('departamentos');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Departamento';

		$this->load->view('sadm_agregar_departamento', $data);
	}

	public function sadm_editar_departamento($id){

		$datos = $this->modelo_admin->obt_departamento($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_dep', 'departamento');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('departamentos');
			}
		}

		$data['info_dep'] = $datos;
		$data['titulo'] = 'Administrador - Editar Departamento';

		$this->load->view('sadm_editar_departamento', $data);
	}

	public function sadm_borrar_departamento($id){

		$this->db->where('codigo_dep', $id);
		$result = $this->db->delete('departamento'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('departamentos');
		}
	}
	public function sadm_municipios()
	{
		$data['municipios'] = $this->modelo_admin->obt_municipios();
		$data['titulo'] = 'Administrador - Municipios';

		$this->load->view('sadm_listar_municipios', $data);
	}

	public function sadm_agregar_municipio()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$departamento = $this->input->post('departamento');

			$datos = array(
				'nombre' => $nombre,
				'fk_codigo_dep'=> $departamento
				);

			$result = $this->modelo_admin->guardar_item($datos, 'municipio');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('municipios');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Municipio';

		$data['departamentos'] = $this->modelo_admin->obt_departamentos();

		$this->load->view('sadm_agregar_municipio', $data);
	}

	public function editar_municipio($id){

		$datos = $this->modelo_admin->obt_municipio($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$departamento = $this->input->post('departamento');

			$datos2 = array(
				'nombre' => $nombre,
				'fk_codigo_dep'=> $departamento
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_muni', 'municipio');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('municipios');
			}
		}

		$data['info_mun'] = $datos;

		$data['departamentos'] = $this->modelo_admin->obt_departamentos();

		$data['titulo'] = 'Administrador - Editar Municipio';

		$this->load->view('editar_municipio', $data);
	}

	public function borrar_municipio($id){

		$this->db->where('codigo_muni', $id);
		$result = $this->db->delete('municipio'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('municipios');
		}
	}

}