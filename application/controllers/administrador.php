<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrador extends CI_Controller {
	
	public function index()
	{
		$data['titulo'] = 'Administrador - Login';
		$this->load->view('login', $data);
	}

	public function login()
	{
		if($this->input->post()){
			$usuario = $this->input->post('usuario');
			$contrasena = $this->input->post('contrasena');

			if($usuario == 'grupo05' && $contrasena == 'grupo05'){
				redirect('inicio');
			}else{
				$this->session->set_userdata('mensaje', 'Usuario y/o contraseña incorrectos.');
				redirect('/');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Cargo';

		$this->load->view('agregar_cargo', $data);
	}

	public function inicio()
	{
		$data['titulo'] = 'Administrador - Clínicas Municipales';
		$this->load->view('dashboard', $data);
	}

	/*MANTENIMIENTO CARGOS*/

	public function cargos()
	{
		$data['cargos'] = $this->modelo_admin->obt_cargos();
		$data['titulo'] = 'Administrador - Cargos';

		$this->load->view('lista_cargos', $data);
	}

	public function agregar_cargo()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'cargo');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('cargos');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Cargo';

		$this->load->view('agregar_cargo', $data);
	}

	public function editar_cargo($id){

		$datos = $this->modelo_admin->obt_cargo($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_cargo', 'cargo');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('cargos');
			}
		}

		$data['info_car'] = $datos;
		$data['titulo'] = 'Administrador - Editar Cargo';

		$this->load->view('editar_cargo', $data);
	}

	public function borrar_cargo($id){

		$this->db->where('cod_cargo', $id);
		$result = $this->db->delete('cargo'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('cargos');
		}
	}

	/*MANTENIMIENTO CLINICAS*/

	public function clinicas()
	{
		$data['clinicas'] = $this->modelo_admin->obt_clinicas();
		$data['titulo'] = 'Administrador - Clínicas';

		$this->load->view('lista_clinicas', $data);
	}

	public function agregar_clinica()
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
				redirect('clinicas');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Clínica';

		$this->load->view('agregar_clinica', $data);
	}

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

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_clinica', 'clinica');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('clinicas');
			}
		}

		$data['info_cli'] = $datos;
		$data['titulo'] = 'Administrador - Editar Clínica';

		$this->load->view('editar_clinica', $data);
	}

	public function borrar_clinica($id){

		$this->db->where('cod_clinica', $id);
		$result = $this->db->delete('clinica'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('clinicas');
		}
	}

	/*MANTENIMIENTO CONSULTORIOS*/

	public function consultorios()
	{
		$data['consultorios'] = $this->modelo_admin->obt_consultorios();
		$data['titulo'] = 'Administrador - Consultorios';

		$this->load->view('lista_consultorios', $data);
	}

	public function agregar_consultorio()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$clinica = $this->input->post('clinica');

			$datos = array(
				'nombre' => $nombre,
				'cod_clinica'=> $clinica
				);

			$result = $this->modelo_admin->guardar_item($datos, 'consultorio');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('consultorios');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Consultorio';

		$data['clinicas'] = $this->modelo_admin->obt_clinicas();

		$this->load->view('agregar_consultorio', $data);
	}

	public function editar_consultorio($id){

		$datos = $this->modelo_admin->obt_consultorio($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$clinica = $this->input->post('clinica');

			$datos2 = array(
				'nombre' => $nombre,
				'cod_clinica'=> $clinica
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_consultorio', 'consultorio');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('consultorios');
			}
		}

		$data['info_con'] = $datos;

		$data['clinicas'] = $this->modelo_admin->obt_clinicas();

		$data['titulo'] = 'Administrador - Editar Consultorio';

		$this->load->view('editar_consultorio', $data);
	}

	public function borrar_consultorio($id){

		$this->db->where('cod_consultorio', $id);
		$result = $this->db->delete('consultorio'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('consultorios');
		}
	}

	/*MANTENIMIENTO DEPARTAMENTOS*/

	public function departamentos()
	{
		$data['departamentos'] = $this->modelo_admin->obt_departamentos();
		$data['titulo'] = 'Administrador - Departamentos';

		$this->load->view('lista_departamentos', $data);
	}

	public function agregar_departamento()
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

		$this->load->view('agregar_departamento', $data);
	}

	public function editar_departamento($id){

		$datos = $this->modelo_admin->obt_departamento($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_departamento', 'departamento');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('departamentos');
			}
		}

		$data['info_dep'] = $datos;
		$data['titulo'] = 'Administrador - Editar Departamento';

		$this->load->view('editar_departamento', $data);
	}

	public function borrar_departamento($id){

		$this->db->where('cod_departamento', $id);
		$result = $this->db->delete('departamento'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('departamentos');
		}
	}

	/*MANTENIMIENTO ESPECIALIDADES*/

	public function especialidades()
	{
		$data['especialidades'] = $this->modelo_admin->obt_especialidades();
		$data['titulo'] = 'Administrador - Especialidades';

		$this->load->view('lista_especialidades', $data);
	}

	public function agregar_especialidad()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'especialidad');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('especialidades');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Especialidad';

		$this->load->view('agregar_especialidad', $data);
	}

	public function editar_especialidad($id){

		$datos = $this->modelo_admin->obt_especialidad($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_especialidad', 'especialidad');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('especialidades');
			}
		}

		$data['info_esp'] = $datos;
		$data['titulo'] = 'Administrador - Editar Especialidad';

		$this->load->view('editar_especialidad', $data);
	}

	public function borrar_especialidad($id){

		$this->db->where('cod_especialidad', $id);
		$result = $this->db->delete('especialidad'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('especialidades');
		}
	}

	/*MANTENIMIENTO MUNICIPIOS*/

	public function municipios()
	{
		$data['municipios'] = $this->modelo_admin->obt_municipios();
		$data['titulo'] = 'Administrador - Municipios';

		$this->load->view('lista_municipios', $data);
	}

	public function agregar_municipio()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$departamento = $this->input->post('departamento');

			$datos = array(
				'nombre' => $nombre,
				'cod_departamento'=> $departamento
				);

			$result = $this->modelo_admin->guardar_item($datos, 'municipio');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('municipios');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Municipio';

		$data['departamentos'] = $this->modelo_admin->obt_departamentos();

		$this->load->view('agregar_municipio', $data);
	}

	public function editar_municipio($id){

		$datos = $this->modelo_admin->obt_municipio($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$departamento = $this->input->post('departamento');

			$datos2 = array(
				'nombre' => $nombre,
				'cod_departamento'=> $departamento
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_municipio', 'municipio');

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

		$this->db->where('cod_municipio', $id);
		$result = $this->db->delete('municipio'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('municipios');
		}
	}
}