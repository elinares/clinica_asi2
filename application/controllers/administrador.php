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

			$result = $this->modelo_admin->login($usuario, $contrasena);

			if($result){
				if($result['estado'] == 0){
					$this->session->set_userdata('mensaje', 'Usuario inactivo.');
					redirect('/');
				}else{
					$this->session->set_userdata( 'user_info', $result );
					redirect('inicio');
				}				
			}else{
				$this->session->set_userdata('mensaje', 'Usuario y/o contraseña incorrectos.');
				redirect('/');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Cargo';

		$this->load->view('agregar_cargo', $data);
	}

	public function logout()
	{	
		$this->session->unset_userdata('user_info');
		redirect('/');
	}

	public function inicio()
	{
		$data['user_info'] = $this->session->userdata('user_info');
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
				'fk_codigo_cli'=> $clinica
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
				'fk_codigo_cli'=> $clinica
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_con', 'consultorio');

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

		$this->db->where('codigo_con', $id);
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

	/*MANTENIMIENTO PERFILES*/

	public function perfiles()
	{
		$data['perfiles'] = $this->modelo_admin->obt_perfiles();
		$data['titulo'] = 'Administrador - Perfiles';

		$this->load->view('lista_perfiles', $data);
	}

	public function agregar_perfil()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'perfil');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('perfiles');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Perfil';

		$this->load->view('agregar_perfil', $data);
	}

	public function editar_perfil($id){

		$datos = $this->modelo_admin->obt_perfil($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_perfil', 'perfil');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('perfiles');
			}
		}

		$data['info_per'] = $datos;
		$data['titulo'] = 'Administrador - Editar Perfil';

		$this->load->view('editar_perfil', $data);
	}

	public function borrar_perfil($id){

		$this->db->where('cod_perfil', $id);
		$result = $this->db->delete('perfil'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('perfiles');
		}
	}

	/*MANTENIMIENTO USUARIOS*/

	public function usuarios()
	{
		$data['usuarios'] = $this->modelo_admin->obt_usuarios();
		$data['titulo'] = 'Administrador - Usuarios';

		$this->load->view('lista_usuarios', $data);
	}

	public function agregar_usuario()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$password = md5($this->input->post('password'));
			$estado = $this->input->post('estado');
			$perfil = $this->input->post('perfil');

			$datos = array(
				'nombre' => $nombre,
				'password' => $password,
				'estado' => $estado,
				'cod_perfil'=> $perfil
				);

			$result = $this->modelo_admin->guardar_item($datos, 'usuario');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('usuarios');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Usuario';

		$data['perfiles'] = $this->modelo_admin->obt_perfiles();

		$this->load->view('agregar_usuario', $data);
	}

	public function editar_usuario($id){

		$datos = $this->modelo_admin->obt_usuario($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$password = $this->input->post('password');
			$estado = $this->input->post('estado');
			$perfil = $this->input->post('perfil');

			(trim($password) == '') ? $password = $datos['password'] : $password = md5($password);

			$datos2 = array(
				'nombre' => $nombre,
				'password' => $password,
				'estado' => $estado,
				'cod_perfil'=> $perfil
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_usuario', 'usuario');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('usuarios');
			}
		}

		$data['info_usu'] = $datos;

		$data['perfiles'] = $this->modelo_admin->obt_perfiles();

		$data['titulo'] = 'Administrador - Editar Usuario';

		$this->load->view('editar_usuario', $data);
	}

	public function borrar_usuario($id){

		$this->db->where('cod_usuario', $id);
		$result = $this->db->delete('usuario'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('usuarios');
		}
	}
	
	/*MANTENIMIENTO TIPO EXAMEN*/
		public function tipoexamenes()
	{
		$data['tipoexamenes'] = $this->modelo_admin->obt_tipoexamenes();
		$data['titulo'] = 'Administrador - Tipo Examen';

		$this->load->view('lista_tipo_examenes', $data);
	}

	/*AGREGANDO TIPO EXAMEN*/
	public function agregar_tipo_examen()
	{
		if($this->input->post()){
			$nombre = $this->input->post('tipo');

			$datos = array(
				'tipo' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'tipo_examen');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('tipoexamenes');
			}
		}

	
	$data['titulo'] = 'Administrador - Agregar Tipo Examen';

		$this->load->view('agregar_tipo_examen', $data);
	}
	/*BORRAR TIPO EXAMEN*/
	public function borrar_tipo_examen($id){

		$this->db->where('cod_tipoExm', $id);
		$result = $this->db->delete('tipo_examen'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('tipoexamenes');
		}
	}
	/*EDITAR TIPO EXAMEN*/
	public function editar_tipo_examen($id){

		$datos = $this->modelo_admin->obt_tipoexamen($id);

		if($this->input->post()){		
			$tipo = $this->input->post('tipo');

			$datos2 = array(
				'tipo' => $tipo
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_tipoExm', 'tipo_examen');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('tipoexamenes');
			}
		}

		$data['info_tex'] = $datos;
		$data['titulo'] = 'Administrador - Editar Tipo Examen';

		$this->load->view('editar_tipo_examen', $data);
	}
	/*MANTENIMIENTO ESPECIALIDAD EXAMEN*/
		public function especialidadexamenes()
	{
		$data['especialidadexamenes'] = $this->modelo_admin->obt_especialidadexamenes();
		$data['titulo'] = 'Administrador - Especialidad Examen';

		$this->load->view('lista_especialidad_examen', $data);
	}

	/*AGREGANDO ESPECIALIDAD EXAMEN*/
	public function agregar_especialidad_examen()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$datos = array(
				'nombre' => $nombre
				);

			$result = $this->modelo_admin->guardar_item($datos, 'especialidad_examen');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('especialidadexamenes');
			}
		}

	
	$data['titulo'] = 'Administrador - Agregar Tipo Examen';

		$this->load->view('agregar_especialidad_examen', $data);
	}

	/*BORRAR ESPECIALIDAD EXAMEN*/
	public function borrar_especialidad_examen($id){

		$this->db->where('cod_especialidad', $id);
		$result = $this->db->delete('especialidad_examen'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('especialidadexamenes');
		}
	}

	/*EDITAR ESPECIALIDAD EXAMEN*/
	public function editar_especialidad_examen($id){

		$datos = $this->modelo_admin->obt_especialidadexamen($id);

		if($this->input->post()){		
			$tipo = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $tipo
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'cod_especialidad', 'especialidad_examen');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('especialidadexamenes');
			}
		}

		$data['info_esp'] = $datos;
		$data['titulo'] = 'Administrador - Editar Especialidad Examen';

		$this->load->view('editar_especialidad_examen', $data);
	}
	
	/*MANTENIMIENTO EMPLEADOS*/
	public function empleados()
	{
		$data['empleados']=$this->modelo_admin->obt_empleados();
		$data['titulo']='Administrador-Empleados';
		$this->load->view('lista_empleados',$data);
	
	}
	/*CITAS*/
	public function citas()
	{
		$data['citas'] = $this->modelo_admin->obt_citas();
		$data['titulo'] = 'Administrador - Citas';

		$this->load->view('lista_citas', $data);
	}
	/*buscar paciente*/
	public function buscar_paciente()
	{
		
		if ($this->input->post()){
			$criterio=$this->input->post('criterio');
			
			$data['resultados_busqueda']=$this->modelo_admin->busqueda_pacientes($criterio);
			$data['titulo']='Resultado Busquedas';
			$this->load->view('resultados_busqueda',$data);
		}else{
		$data['titulo'] = 'Administrador - Citas';
		$this->load->view('buscar_paciente',$data);
	}
	}
	public function asignacion_cita($id){
		$data['titulo'] = 'Administrador - Citas';
		$data['paciente']=$this->modelo_admin->obt_paciente($id);
		$data['configuracion'] = $this->modelo_admin->obt_configuracion();
		$this->load->view('asignacion_cita', $data);
	}
	public function ingresar_cita(){
		if($this->input->post()){
			$codigo_pac = $this->input->post('codigo_paciente');
			$web = 'F';
			$fecha=$this->input->post('fecha');
			$estado='activa';
			$hora=$this->input->post('hora');

			$datos = array(
				'cita_web' => $web,
				'fecha'=> $fecha,
				'estado'=>$estado,
				'fk_codigo_confi'=>$hora,
				'fk_codigo_pac'=>$codigo_pac
				);

			$result = $this->modelo_admin->guardar_item($datos, 'cita');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('citas');
			}
		}

	}
	

}
