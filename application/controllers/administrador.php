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

					//Verificación para perfil super administrador
					if($result['fk_codigo_perf'] != 1){
						
						$user_id = $result['codigo_user'];
						//Se obtiene la información general del usuario
						$user_data = $this->modelo_admin->obt_user_data($user_id);
						//Se obtienen los permisos que posee el usuario basados en su perfil
						$user_access = $this->modelo_admin->obt_user_access($result['fk_codigo_perf']);
						//Se agregan los permisos a la información general del usuario
						$user_data['permisos'] = $user_access;

						$this->session->set_userdata( 'user_info', $user_data );
						redirect('inicio');

					}else{

						$this->session->set_userdata( 'user_info', $result );
						redirect('superadmin');

					}					

				}				
			}else{
				$this->session->set_userdata('mensaje', 'Usuario y/o contraseña incorrectos.');
				redirect('/');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Cargo';

		$this->load->view('login', $data);
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

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_carg', 'cargo');

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

		$this->db->where('codigo_carg', $id);
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

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_cli', 'clinica');

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

		$this->db->where('codigo_cli', $id);
		$result = $this->db->delete('clinica'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('clinicas');
		}
	}

	/*MANTENIMIENTO CONSULTORIOS*/

	public function consultorios()
	{
		$user_info = $this->session->userdata('user_info');

		$data['consultorios'] = $this->modelo_admin->obt_consultorios($user_info['codigo_cli']);
		$data['titulo'] = 'Administrador - Consultorios';

		$this->load->view('lista_consultorios', $data);
	}

	public function agregar_consultorio()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$user_info = $this->session->userdata('user_info');

			$datos = array(
				'nombre' => $nombre,
				'fk_codigo_cli'=> $user_info['codigo_cli']
				);

			$result = $this->modelo_admin->guardar_item($datos, 'consultorio');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('consultorios');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Consultorio';

		$this->load->view('agregar_consultorio', $data);
	}

	public function editar_consultorio($id){

		$datos = $this->modelo_admin->obt_consultorio($id);

		$user_info = $this->session->userdata('user_info');

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre,
				'fk_codigo_cli'=> $user_info['codigo_cli']
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_con', 'consultorio');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('consultorios');
			}
		}

		$data['info_con'] = $datos;

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

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_dep', 'departamento');

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

		$this->db->where('codigo_dep', $id);
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

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_esp', 'especialidad');

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

		$this->db->where('codigo_esp', $id);
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

		$this->load->view('agregar_municipio', $data);
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

	/*MANTENIMIENTO PERFILES*/

	public function perfiles()
	{
		$user_info = $this->session->userdata('user_info');

		$data['perfiles'] = $this->modelo_admin->obt_perfiles($user_info['codigo_cli']);
		$data['titulo'] = 'Administrador - Perfiles';

		$this->load->view('lista_perfiles', $data);
	}

	public function agregar_perfil()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');

			$user_info = $this->session->userdata('user_info');

			$datos = array(
				'nombre' => $nombre,
				'fk_codigo_cli' => $user_info['codigo_cli']
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

		$user_info = $this->session->userdata('user_info');

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');

			$datos2 = array(
				'nombre' => $nombre,
				'fk_codigo_cli' => $user_info['codigo_cli']
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_perf', 'perfil');

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

		$this->db->where('codigo_perf', $id);
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
				'fk_codigo_perf'=> $perfil
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
				'fk_codigo_perf'=> $perfil
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_user', 'usuario');

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

		$this->db->where('codigo_user', $id);
		$result = $this->db->delete('usuario'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('usuarios');
		}
	}
	

	



/*-------------------- paciente-----------------------------------------------------------------------------------------------------*/
	
	public function pacientes()
	{
		$data['pacientes'] = $this->modelo_admin->obt_pacientes();
		$data['titulo'] = 'Administrador - pacientes';

		$this->load->view('lista_pacientes', $data);
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


public function buscar_persona_paciente()
	{
		
		if ($this->input->post()){
			$criterio=$this->input->post('criterio');
			$criterio2=$this->input->post('criterio2');
			
			$data['resultados_busqueda_paciente']=$this->modelo_admin->busqueda_persona_pacientes(strtoupper($criterio),strtoupper($criterio2));
			$data['titulo']='Resultado Busquedas';
			$this->load->view('resultados_busqueda_paciente',$data);
		}else{
		$data['titulo'] = 'Administrador -pacientes';
		$this->load->view('buscar_persona_paciente',$data);
	}

}




public function agregar_paciente_op1()
	{	
		if($this->input->post()){
			//agregamos los datos de persona	
			$nombres = $this->input->post('nombres');
			$apellidos = $this->input->post('apellidos');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$direccion = $this->input->post('direccion');
			$estado_civil = $this->input->post('estado_civil');
			$genero = $this->input->post('genero');
			$dui = $this->input->post('dui');
			$fk_codigo_muni = $this->input->post('fk_codigo_muni');

			$datos = array(
				//formamos el arreglo para personas
				'nombres' => strtoupper($nombres),
				'apellidos' => strtoupper($apellidos),
				'fecha_nacimiento'=> $fecha_nacimiento,
				'direccion'=> $direccion,
				'estado_civil' => $estado_civil,
				'genero' => $genero,
				'dui' => $dui,
				'fk_codigo_muni' => $fk_codigo_muni
				);


			//INSERTAS EL REGISTRO DE PERSONA
			$result = $this->modelo_admin->guardar_item($datos, 'persona');

			if($result){//SI EL REGISTRO SE EFECTUO
				$fk_codigo_per = $this->db->insert_id();
				//CAPTURAS LOS VALORES DE EMPLEADO
				$ocupacion = $this->input->post('ocupacion');

				$fecha=date("Y-m-d");
			
				//$fk_codigo_espe = $this->input->post('fk_codigo_espe');



				//ARMAS ARREGLO PARA INSERTAR EMPLEADO
				$datos2 = array(
					'fk_codigo_per' => $fk_codigo_per,
					'ocupacion' => $ocupacion,
					'fecha_registro' => $fecha


				
					//'fk_codigo_esp' => $fk_codigo_esp
				);

				//INSERTAS EL REGISTRO DE EMPLEADO
				$result2 = $this->modelo_admin->guardar_item($datos2, 'paciente');
				
				if($result2){
				$user_info = $this->session->userdata('user_info');
					
					$fk_codigo_pac = $this->db->insert_id();
					$fk_codigo_cli = $user_info['codigo_cli'];
					$codigo_fisico = $this->input->post('codigo_fisico');
					$alergia =$this->input->post('alergia');
					$enfermedad =$this->input->post('enfermedad');
					$antecedente =$this->input->post('antecedente');

					$datos3 = array(
					'codigo_fisico' => $codigo_fisico,
					'alergia' => $alergia,
					'enfermedad_padecida' => $enfermedad,
					'antecedente' => $antecedente,
					'fk_codigo_pac' => $fk_codigo_pac,
					'fk_codigo_cli' => $fk_codigo_cli,
					'fecha_creacion' => date("Y-m-d")
			

				);

				$result3 = $this->modelo_admin->guardar_item($datos3, 'expediente');

					if($result3){
					$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
					redirect('pacientes');

				}





				}				
			}
		}

 		$data['departamento'] = $this->modelo_admin->departamentos();
		$data['titulo'] = 'Administrador';
		$this->load->view('agregar_paciente_op1', $data);

	}



public function agregar_paciente_op2($id){

if($this->input->post() ){
			//agregamos los datos de persona	

				$fk_codigo_per = $this->input->post('ocupacion');
				$ocupacion = $this->input->post('ocupacion');
				$fecha=date("Y-m-d");
			
				//$fk_codigo_espe = $this->input->post('fk_codigo_espe');



				//ARMAS ARREGLO PARA INSERTAR EMPLEADO
				$datos = array(
					'fk_codigo_per' => $fk_codigo_per,
					'ocupacion' => $ocupacion,
					'fecha_registro' => $fecha,


				
					//'fk_codigo_esp' => $fk_codigo_esp
				);

				//INSERTAS EL REGISTRO DE EMPLEADO
				$result = $this->modelo_admin->guardar_item($datos, 'paciente');
				
				if($result){
					$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
					redirect('pacientes');
				}				
			}
		
		$data['persona']=$this->modelo_admin->obt_persona($id);
		$data['titulo'] = 'Administrador';
		$this->load->view('agregar_paciente_op2', $data);


}

public function llena_municipio()
    {

    	
       $options = "";
       if($this->input->post('departamento'))
        {
            $departamento = $this->input->post('departamento');
            $municipi = $this->modelo_admin->municipios($departamento);
            foreach($municipi as $fila)
            {
            ?>
                <option value="<?php echo $fila->codigo_muni ?>" ><?php echo $fila->nombre ?></option>
            <?php
            }

        }
    }





/*-------------------- paciente---------------------------------------------------------------------------------------------------------------*/




	
	/*CITAS*/
	public function citas()
	{
		$data['citas'] = $this->modelo_admin->obt_citas();
		$data['titulo'] = 'Administrador - Citas';

		$this->load->view('lista_citas', $data);
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
	/*
	MANTENIMIENTO CONFIGURACION CITA
	*/

	public function configuracion_citas()
	{
		$data['configuracion_citas'] = $this->modelo_admin->obt_configuracion_citas();
		$data['titulo'] = 'Administrador - Configuracion Cita';

		$this->load->view('lista_configuracion_cita', $data);
	}

	/* AGREGAR UNA CONFIGURACION CITA*/

	public function agregar_configuracion_cita()
	{
		if($this->input->post()){
			$hrinicial = $this->input->post('hora_inicial');
			$hrfinal = $this->input->post('hora_final');
			$catidad_maxima = $this->input->post('catidad_maxima');
			$consultorio = $this->input->post('consultorio');
			$datos = array(
				'hora_inicial' => $hrinicial,
				'hora_final' => $hrfinal,
				'cantidad_maxima' => $catidad_maxima,
				 'fk_codigo_con' => $consultorio
				);

			$result = $this->modelo_admin->guardar_item($datos, 'configuracion_cita');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('configuracion_citas');
			}
	}

	$data['consultorios'] = $this->modelo_admin->obt_consultorios();
	$data['titulo'] = 'Administrador - Agregar Configuracion Cita';

	$this->load->view('agregar_configuracion_cita', $data);
	}

	/*EDITAR UNA CONFIGURACION CITA*/
	public function editar_configuracion_cita($id){

		$datos = $this->modelo_admin->obt_configuracion_cita($id);

		if($this->input->post()){		
			$tipo = $this->input->post('nombre');
				$hrinicial = $this->input->post('hora_inicial');
				$hrfinal = $this->input->post('hora_final');
				$catidad_maxima = $this->input->post('cantidad_maxima');
				$consultorio = $this->input->post('consultorio');
			$datos2 = array(
				'hora_inicial' => $hrinicial,
				'hora_final' => $hrfinal,
				'cantidad_maxima' => $catidad_maxima,
				 'fk_codigo_con' => $consultorio
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_confi', 'configuracion_cita');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('configuracion_citas');
			}
		}

		$data['info_configuracion_cita'] = $datos;
		$data['consultorios'] = $this->modelo_admin->obt_consultorios();
		$data['titulo'] = 'Administrador - Editar Configuracion Cita';

		$this->load->view('editar_configuracion_cita', $data);
	}

	/*BORRAR UNA CONFIGURACION CITA*/

	public function borrar_configuracion_cita($id){

		$this->db->where('codigo_confi', $id);
		$result = $this->db->delete('configuracion_cita'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('configuracion_citas');
		}
	}

	//mantenimiento personas
	public function personas()
	{
		$data['personas'] = $this->modelo_admin->obt_personas();
		$data['titulo'] = 'Administrador - personas';

		$this->load->view('lista_personas', $data);
	}

	public function agregar_persona()
	{
		if($this->input->post()){
			//$nombre = $this->input->post('empleado');
			$nombres = $this->input->post('nombres');
			//$primer_apellido = $this->input->post('empleado')
			$apellidos = $this->input->post('apellidos');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$direccion = $this->input->post('direccion');
			$estado_civil = $this->input->post('estado_civil');
			$genero = $this->input->post('genero');
			$dui = $this->input->post('dui');
			$fk_codigo_muni = $this->input->post('fk_codigo_muni');


			$datos = array(
				'nombres' => strtoupper($nombres),
				'apellidos' => strtoupper($apellidos),
				'fecha_nacimiento'=> $fecha_nacimiento,
				'direccion'=> $direccion,
				'estado_civil' => $estado_civil,
				'genero' => $genero,
				'dui' => $dui,
				'fk_codigo_muni' => $fk_codigo_muni
				);

			$result = $this->modelo_admin->guardar_item($datos, 'persona');
			if($result){
				$this->session->set_userdata('mensaje', 'Persona agregada con éxito.');
				redirect('personas');
			}
		}


		$data['personas'] = $this->modelo_admin->obt_personas();

		$data['municipios'] = $this->modelo_admin->obt_municipios();

		$data['titulo'] = 'Administrador - Agregar personas';

		$this->load->view('agregar_persona', $data);
	}

/*public function editar_consultorio($id){
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
		$this->load->view('editar_consultorio', $data);*/
	public function editar_persona($id){

		$datos = $this->modelo_admin->obt_persona($id);

		if($this->input->post()){		
			$nombres = $this->input->post('nombres');
			$apellidos = $this->input->post('apellidos');
			$segundo_apellido = $this->input->post('segundo_apellido');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$direccion = $this->input->post('direccion');
			$estado_civil = $this->input->post('estado_civil');
			$genero = $this->input->post('genero');
			$dui = $this->input->post('dui');
			$fk_codigo_muni = $this->input->post('fk_codigo_muni');



			$datos2 = array(
				'nombres' => strtoupper($nombres),
				'apellidos' => strtoupper($apellidos),
				'fecha_nacimiento'=> $fecha_nacimiento,
				'direccion'=> $direccion,
				'estado_civil' => $estado_civil,
				'genero' => $genero,
				'dui' => $dui,
				'fk_codigo_muni' => $fk_codigo_muni
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_per', 'persona');

			if($result){				
				$this->session->set_userdata('mensaje', 'Empleado actualizado con éxito.');
				redirect('personas');
			}
		}

		$data['info_perso'] = $datos;
		$data['personas'] = $this->modelo_admin->obt_personas();
	  $data['municipios'] = $this->modelo_admin->obt_municipios();
		$data['titulo'] = 'Administrador - Editar Persona';
		$this->load->view('editar_persona', $data);
	

}
	public function borrar_persona($id){

		$this->db->where('codigo_per', $id);
		$result = $this->db->delete('persona'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('personas');
		}
	}

//mantenimiento Empleado
	public function empleados()
	{
		$data['empleados'] = $this->modelo_admin->obt_empleados();
		$data['titulo'] = 'Administrador - empleados';

		$this->load->view('lista_empleados', $data);
	}

		public function buscar_empleado()
	{
		
		if ($this->input->post()){
			$criterio=$this->input->post('criterio');
			
			$data['resultado_busqueda_empleado']=$this->modelo_admin->buscar_empleados($criterio);
			$data['titulo']='Resultado Busquedas';
			$this->load->view('resultado_busqueda_empleado',$data);
		}else{
		$data['titulo'] = 'Administrador - Empleado';
		$this->load->view('buscar_empleado',$data);
	}
	}

		public function asignacion_empleado($id){
		$data['titulo'] = 'Administrador - empleados';
		$data['empleados']=$this->modelo_admin->obt_empleado1($id);

		$data['personas'] = $this->modelo_admin->obt_personas();
		$data['usuarios'] = $this->modelo_admin->obt_usuarios();
		$data['cargos'] = $this->modelo_admin->obt_cargos();
		$data['especialidades'] = $this->modelo_admin->obt_especialidades();
		$this->load->view('agregar_empleado', $data);
	}

	public function agregar_empleado()
	{
		if($this->input->post()){

			$fk_codigo_per = $this->input->post('fk_codigo_per');
			$fk_codigo_user = $this->input->post('fk_codigo_user');
			$nit = $this->input->post('nit');
			$isss = $this->input->post('isss');
			$nup = $this->input->post('nup');
			$jvpm = $this->input->post('jvpm');
			$fk_codigo_carg = $this->input->post('fk_codigo_carg');
			$fk_codigo_esp = $this->input->post('fk_codigo_esp');
			//$clinica = $this->input->post('clinica');

			$datos = array(
				'fk_codigo_per' => $fk_codigo_per,
				//pk de clinica que se inserta en la fk 
				'fk_codigo_user'=> $fk_codigo_user,
				'nit'=> $nit,
				'isss' => $isss,
				'nup' => $nup,
				'jvpm' => $jvpm,
				'fk_codigo_carg' => $fk_codigo_carg,
				'fk_codigo_esp' => $fk_codigo_esp
				);


			$result = $this->modelo_admin->guardar_item($datos, 'empleado');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('empleados');
			}
		}

//		$data['titulo'] = 'Administrador - Agregar Consultorio';

		 //mandamos a llamar a la foranea
//		$this->load->view('agregar_empleado', $data);
	}

/*public function editar_consultorio($id){
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
		$this->load->view('editar_consultorio', $data);*/
	public function editar_empleado($id)
	{

		$datos = $this->modelo_admin->obt_empleado($id);

		if($this->input->post()){
			$fk_codigo_per = $this->input->post('fk_codigo_per');
			$fk_codigo_user = $this->input->post('fk_codigo_user');
			$nit = $this->input->post('nit');
			$isss = $this->input->post('isss');
			$nup = $this->input->post('nup');
			$jvpm = $this->input->post('jvpm');
			$fk_codigo_cargo = $this->input->post('fk_codigo_cargo');
			//$clinica = $this->input->post('clinica');

			$datos = array(
				'codigo_per' => $persona,
				//pk de clinica que se inserta en la fk 
				'codigo_user'=> $usuario,
				'nit'=> $nit,
				'isss' => $isss,
				'nup' => $nup,
				'jvpm' => $jvpm,
				'codigo_carg' => $cargo
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_emp', 'empleado');

			if($result){				
				$this->session->set_userdata('mensaje', 'Empleado actualizado con éxito.');
				redirect('personas');
			}
		}

		$data['info_emple'] = $datos;
		$data['empleados'] = $this->modelo_admin->obt_empleados();

		$data['personas'] = $this->modelo_admin->obt_personas();
		$data['usuarios'] = $this->modelo_admin->obt_usuarios();
		$data['cargos'] = $this->modelo_admin->obt_cargos();

		$data['titulo'] = 'Administrador - Editar empleado';
		$this->load->view('editar_empleado', $data);
	

}
	public function borrar_empleado($id){

		$this->db->where('codigo_emp', $id);
		$result = $this->db->delete('empleado'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('empleados');
		}
	}

	



	public function new_empleados()
	{
		$data['new_empleados'] = $this->modelo_admin->obt_new_empleados();
		$data['titulo'] = 'Administrador - empleados';

		$this->load->view('lista_new_empleados', $data);
	}
public function agregar_new_empleado()
	{
		if($this->input->post()){
			//agregamos los datos de persona	
			$nombres = $this->input->post('nombres');
			$apellidos = $this->input->post('apellidos');
			$fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$direccion = $this->input->post('direccion');
			$estado_civil = $this->input->post('estado_civil');
			$genero = $this->input->post('genero');
			$dui = $this->input->post('dui');
			$fk_codigo_muni = $this->input->post('fk_codigo_muni');

			$datos = array(
				//formamos el arreglo para personas
				'nombres' => strtoupper($nombres),
				'apellidos' => strtoupper($apellidos),
				'fecha_nacimiento'=> $fecha_nacimiento,
				'direccion'=> $direccion,
				'estado_civil' => $estado_civil,
				'genero' => $genero,
				'dui' => $dui,
				'fk_codigo_muni' => $fk_codigo_muni
				);


			//INSERTAS EL REGISTRO DE PERSONA
			$result = $this->modelo_admin->guardar_item($datos, 'persona');

			if($result){//SI EL REGISTRO SE EFECTUO
				$fk_codigo_per = $this->db->insert_id();
				//CAPTURAS LOS VALORES DE EMPLEADO
				$fk_codigo_user = $this->input->post('fk_codigo_user');	
				$nit = $this->input->post('nit');
				$isss = $this->input->post('isss');
				$nup = $this->input->post('nup');
				$jvpm = $this->input->post('jvpm');
				$fk_codigo_carg = $this->input->post('fk_codigo_carg');
				//$fk_codigo_espe = $this->input->post('fk_codigo_espe');



				//ARMAS ARREGLO PARA INSERTAR EMPLEADO
				$datos2 = array(
					'fk_codigo_per' => $fk_codigo_per,

					'fk_codigo_user'=> $fk_codigo_user,
					'nit' => $nit,
					'isss' => $isss,
					'nup' => $nup,
					'jvpm' => $jvpm,
					'fk_codigo_carg' => $fk_codigo_carg
					//'fk_codigo_esp' => $fk_codigo_esp
				);

				//INSERTAS EL REGISTRO DE EMPLEADO
				$result2 = $this->modelo_admin->guardar_item($datos2, 'empleado');
				
				if($result2){
					$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
					redirect('empleados');
				}				
			}
		}

		$data['titulo'] = 'Administrador';

		$data['municipios'] = $this->modelo_admin->obt_municipios();
		$data['usuarios'] = $this->modelo_admin->obt_usuarios();
		$data['cargos'] = $this->modelo_admin->obt_cargos();
		$data['especialidades'] = $this->modelo_admin->obt_especialidades();
		$this->load->view('agregar_new_empleado', $data);

	}

/*MANTENIMIENTO Tipo_Examen*/

public function tipo_examenes()
	{

		$data['tipo_examenes'] = $this->modelo_admin->obt_tipo_examenes();
		$data['titulo'] = 'Administrador - Tipo Examenes';

		$this->load->view('lista_tipo_examenes', $data);
	}

	
	public function agregar_tipo_examen()
	{
		if($this->input->post()){
			$tipo = $this->input->post('tipo');

			$datos = array(
				'tipo' => $tipo
				);

			$result = $this->modelo_admin->guardar_item($datos, 'tipo_examen');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('tipo_examenes');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Cargo';

		$this->load->view('agregar_tipo_examen', $data);
	}

	public function editar_tipo_examen($id){

		$datos = $this->modelo_admin->obt_tipo_examen($id);

		if($this->input->post()){		
			$tipo = $this->input->post('tipo');

			$datos2 = array(
				'tipo' => $tipo
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_tipex', 'tipo_examen');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('tipo_examenes');
			}
		}

		$data['info_tipoex'] = $datos;
		$data['titulo'] = 'Administrador - Editar Tipo Examen';

		$this->load->view('editar_tipo_examen', $data);
	}

	public function borrar_tipo_examen($id){

		$this->db->where('codigo_tipex', $id);
		$result = $this->db->delete('tipo_examen'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('tipo_examenes');
		}
	}

/*MANTENIMIENTO Tipo Especialidad*/
public function especialidad_examenes()
	{
		$data['especialidad_examenes'] = $this->modelo_admin->obt_especialidad_examenes();

		$data['titulo'] = 'Administrador - especialidad examenes';

		$this->load->view('lista_especialidad_examen', $data);
	}
	public function especialidad_examenes1(){
		$data['especialidad_examenes1'] = $this->modelo_admin->obt_especialidad_examenes1();
		$this->load->view('lista_especialidad_examen', $data);
	}

	public function agregar_especialidad_examen()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$tipo = $this->input->post('tipo');

			$datos = array(
				'nombre' => $nombre,
				'fk_codigo_tipex'=> $tipo
				);

			$result = $this->modelo_admin->guardar_item($datos, 'especialidad_examen');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('especialidad_examenes');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Municipio';

		$data['tipo_examenes'] = $this->modelo_admin->obt_tipo_examenes();

		$this->load->view('agregar_especialidad_examen', $data);
	}

	public function editar_especialidad_examen($id){

		$datos = $this->modelo_admin->obt_especialidad_examen($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$tipo = $this->input->post('tipo');

			$datos2 = array(
				'nombre' => $nombre,
				'fk_codigo_tipex'=> $tipo
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_espe', 'especialidad_examen');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('especialidad_examenes');
			}
		}

		$data['info_espe'] = $datos;

		$data['tipo_examenes'] = $this->modelo_admin->obt_tipo_examenes();

		$data['titulo'] = 'Administrador - Editar especialidad examen';

		$this->load->view('editar_especialidad_examen', $data);
	}

	public function borrar_especialidad_examen($id){

		$this->db->where('codigo_espe', $id);
		$result = $this->db->delete('especialidad_examen'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('especialidad_examenes');
		}
	}


/*MANTENIMIENTO LABORATORIOS*/

	public function laboratorios()
	{
		$data['laboratorios'] = $this->modelo_admin->obt_laboratorios();
		$data['titulo'] = 'Administrador - Lab';

		$this->load->view('lista_laboratorio', $data);
	}

	public function agregar_laboratorio()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$direccion = $this->input->post('direccion');
			$especialidad = $this->input->post('especialidad');

			$datos = array(
				'nombre' => $nombre,
				'direccion'=>$direccion,
				'fk_codigo_espe'=> $especialidad
				);

			$result = $this->modelo_admin->guardar_item($datos, 'laboratorio');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('laboratorios');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Laboratorio';

		$data['especialidad_examenes'] = $this->modelo_admin->obt_especialidad_examenes();

		$this->load->view('agregar_laboratorio', $data);
	}

	public function editar_laboratorio($id){

		$datos = $this->modelo_admin->obt_laboratorio($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$direccion = $this->input->post('direccion');
			$especialidad = $this->input->post('especialidad');


			$datos2 = array(
				'nombre' => $nombre,
				'direccion'=>$direccion,
				'fk_codigo_espe'=> $especialidad
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_lab', 'laboratorio');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('laboratorios');
			}
		}

		$data['info_lab'] = $datos;

		$data['especialidad_examenes'] = $this->modelo_admin->obt_especialidad_examenes();

		$data['titulo'] = 'Administrador - Editar Laboratorio';

		$this->load->view('editar_laboratorio', $data);
	}

	public function borrar_laboratorio($id){

		$this->db->where('codigo_lab', $id);
		$result = $this->db->delete('laboratorio'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('laboratorios');
		}
	}

	//Tipo producto

	public function tipo_productos()
	{
		$data['tipo_productos'] = $this->modelo_admin->obt_tipo_productos();
		$data['titulo'] = 'Administrador - tipo productos';

		$this->load->view('lista_tipo_productos', $data);
	}

	public function agregar_tipo_producto()
	{
		if($this->input->post()){
			$nombre = $this->input->post('nombre');
			$precio = $this->input->post('precio');
			$cantidad_minima = $this->input->post('cantidad_minima');
            $cantidad_maxima = $this->input->post('cantidad_maxima');
            $existencia = $this->input->post('existencia');
            $medicamento = $this->input->post('medicamento');

			$datos = array(
				'nombre' => $nombre,
				'precio' => $precio,
				'cantidad_minima' => $cantidad_minima,
				'cantidad_maxima' => $cantidad_maxima,
				'existencia' => $existencia,
				'medicamento' => $medicamento
				);

			$result = $this->modelo_admin->guardar_item($datos, 'tipo_producto');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('tipo_productos');
			}
		}

		$data['titulo'] = 'Administrador - Agregar tipo_producto';
		$data['tipo_productos']= $this->modelo_admin-> obt_tipo_productos();

		$this->load->view('agregar_tipo_producto', $data);
	}

	public function editar_tipo_producto($id){

		$datos = $this->modelo_admin->obt_tipo_producto($id);

		if($this->input->post()){		
			$nombre = $this->input->post('nombre');
			$precio = $this->input->post('precio');
			$cantidad_minima = $this->input->post('cantidad_minima');
			$cantidad_maxima = $this->input->post('cantidad_maxima');
			$existencia = $this->input->post('existencia');
			$medicamento = $this->input->post('medicamento');

			$datos2 = array(
				'nombre' => $nombre,
				'precio' => $precio,
				'cantidad_minima' => $cantidad_minima,
				'cantidad_maxima' => $cantidad_maxima,
				'existencia' => $existencia,
				'medicamento' => $medicamento
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_tipoprod', 'tipo_producto');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('tipo_productos');
			}
		}

		$data['info_tip_prod'] = $datos;
		$data['titulo'] = 'Administrador - Editar tipo_producto';

		$this->load->view('editar_tipo_producto', $data);
	}

	public function borrar_tipo_producto($id){

		$this->db->where('codigo_tipoprod', $id);
		$result = $this->db->delete('tipo_producto'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('tipo_productos');
		}
	}


	/*MANTENIMIENTO CTipo Presentacion*/

	public function tipo_presentaciones()
	{

		$data['tipo_presentaciones'] = $this->modelo_admin->obt_tipo_presentaciones();
		$data['titulo'] = 'Administrador - Tipo Presentación';

		$this->load->view('lista_tipo_presentacion', $data);
	}

	
	public function agregar_tipo_presentacion()
	{
		if($this->input->post()){
			$tipo = $this->input->post('tipo');

			$datos = array(
				'tipo' => $tipo
				);

			$result = $this->modelo_admin->guardar_item($datos, 'tipo_presentacion');

			if($result){
				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('tipo_presentaciones');
			}
		}

		$data['titulo'] = 'Administrador - Agregar Tipo Presentación';

		$this->load->view('agregar_tipo_presentacion', $data);
	}

	public function editar_tipo_presentacion($id){

		$datos = $this->modelo_admin->obt_tipo_presentacion($id);

		if($this->input->post()){		
			$tipo = $this->input->post('tipo');

			$datos2 = array(
				'tipo' => $tipo
				);

			$result = $this->modelo_admin->act_item($datos2, $id, 'codigo_tipre', 'tipo_presentacion');

			if($result){				
				$this->session->set_userdata('mensaje', 'Registro actualizado con éxito.');
				redirect('tipo_presentaciones');
			}
		}

		$data['info_tipre'] = $datos;
		$data['titulo'] = 'Administrador - Editar Tipo Presentacion';

		$this->load->view('editar_tipo_presentacion', $data);
	}

	public function borrar_tipo_presentacion($id){

		$this->db->where('codigo_tipre', $id);
		$result = $this->db->delete('tipo_presentacion'); 

		if($result){
			$this->session->set_userdata('mensaje', 'Registro eliminado con éxito.');
			redirect('tipo_presentaciones');
		}
	}


	/*COMPRAS*/

	public function compras()
	{

		$data['compras'] = $this->modelo_admin->obt_compras();
		$data['titulo'] = 'Administrador - Compras';

		$this->load->view('lista_compras', $data);
	}

	
	public function agregar_compra()
	{
		if($this->input->post()){

			$num=count($this->input->post('cantidad_producto'));

			$user_info = $this->session->userdata('user_info');

			//Ecabezado
			$factura = $this->input->post('factura');
			$fecha = $this->input->post('fecha');			

			//Detalle
			$codigo_producto = $this->input->post('codigo_producto');
			$presentacion_producto = $this->input->post('presentacion_producto');
			$costo_producto = $this->input->post('costo_producto');
			$cantidad_producto = $this->input->post('cantidad_producto');
			$fvenc_producto = $this->input->post('fvenc_producto');	

			$datos = array(
				'factura' => $factura,
				'fecha' => $fecha,
				'fk_codigo_cli' => $user_info['codigo_cli']
				);

			//Se inserta encabezado de compra
			$result = $this->modelo_admin->guardar_item($datos, 'compra');

			if($result){
				$id_compra = $this->db->insert_id();

				$num=count($this->input->post('cantidad_producto'));
				
				//Se recorren los detalles ingresados
				for ($i=0; $i < $num; $i++) { 

					$datos[$i] = array(
					'cantidad' => $cantidad_producto[$i],
					'fecha_vencimiento' => $fvenc_producto[$i],
					'fk_codigo_tipoprod' => $codigo_producto[$i],
					'fk_codigo_cli' => $user_info['codigo_cli'],
					'fk_codigo_tipre' => $presentacion_producto[$i]				
					);

					//Se inserta detalle en producto
					$result2 = $this->modelo_admin->guardar_item($datos[$i], 'producto');

					if($result2){
						$id_producto = $this->db->insert_id();

						$datos2[$i] = array(
						'costo' => $costo_producto[$i],
						'cantidad' => $cantidad_producto[$i],
						'fk_codigo_produ' => $id_producto,
						'fk_codigo' => $id_compra
						);

						//Se inserta detalle compra
						$result3 = $this->modelo_admin->guardar_item($datos2[$i], 'detalle_compra');

						if($result3){

							$existencia[$i] = $this->db->query("SELECT existencia FROM tipo_producto WHERE codigo_tipoprod = ".$codigo_producto[$i]."")->row_array();
							$datos3[$i] = array('existencia' => $cantidad_producto[$i] + $existencia[$i]["existencia"]);
							$this->db->where( "codigo_tipoprod", $codigo_producto[$i]);
							$result4 = $this->db->update('tipo_producto', $datos3[$i]);

						}	
					}					
				}	

				$this->session->set_userdata('mensaje', 'Registro agregado con éxito.');
				redirect('compras');

			}
		}

		$data['tipos_presentaciones'] = $this->modelo_admin->obt_tipo_presentaciones();
		$data['tipos_productos'] = $this->modelo_admin->obt_tipo_productos();
		$data['titulo'] = 'Administrador - Agregar Compra';

		$this->load->view('agregar_compra', $data);
	}

	//ALERTAS

	public function maxima_existencia(){
		$data['titulo'] = 'Administrador - Lista de Medicamentos';
		$data['medicamentos'] = $this->modelo_admin->maxima_existencia();
		$this->load->view('lista_maxima_existencia', $data);
	}

	public function minima_existencia(){
		$data['titulo'] = 'Administrador - Lista de Medicamentos';
		$data['medicamentos'] = $this->modelo_admin->minima_existencia();
		$this->load->view('lista_minima_existencia', $data);
	}

	public function lista_vencimientos(){
		$user_info = $this->session->userdata('user_info');

		$data['titulo'] = 'Administrador - Lista de Medicamentos';
		$data['medicamentos'] = $this->modelo_admin->lista_vencimientos($user_info['codigo_cli']);
		$this->load->view('lista_vencimientos', $data);
	}

	//SIGNOS VITALES Y COLA DE CONSULTA
	public function signos_vitales($id){
		$user_info = $this->session->userdata('user_info');

		if($this->input->post()){
			$sintoma = $this->input->post('sintoma');
			$altura = $this->input->post('altura');
			$peso = $this->input->post('peso');
			$presion = $this->input->post('presion');
			$temperatura = $this->input->post('temperatura');

			$consultorio = $this->input->post('consultorio');
			$tipo_servicio = $this->input->post('tipo_servicio');

			$datos = array(
				'sintoma' => $sintoma,
				'altura' => $altura,
				'peso' => $peso,
				'presion_arterial' => $presion,
				'temperatura' => $temperatura,
				'diagnostico' => '-',
				'examen_fisico' => '-',
				'fecha_consulta' => date('Y-m-d'),
				'fk_codigo_exp' => $id
				);

			$result = $this->modelo_admin->guardar_item($datos, 'historico');

			if($result){

				$datos2 = array(
					'estado' => 'Pendiente',
					'fecha' => date('Y-m-d'),
					'fk_codigo_cli' => $user_info['codigo_cli'],
					'fk_codigo_con' => $consultorio,
					'fk_codigo_emp' => $user_info['codigo_emp'],
					'fk_codigo_tipser' => $tipo_servicio,
					'fk_codigo_exp' => $id
					);

				$result2 = $this->modelo_admin->guardar_item($datos2, 'servicio_medico');

				if($result2){
					$this->session->set_userdata('mensaje', 'Paciente agregado a cola de consulta con éxito.');
					redirect('pacientes');
				}				
			}
		}

		$data['expediente'] = $id;
		$data['consultorios'] = $this->modelo_admin->obt_consultorios($user_info['codigo_cli']);
		$data['tipos_servicios'] = $this->modelo_admin->obt_tipo_servicios();
		$data['titulo'] = 'Toma de Signos Vitales';		
		$this->load->view('agregar_signos_vitales', $data);
	}

	//CONSULTORIO (LISTA DE CONSULTAS PENDIENTES)
	public function consultorio($id){
		$consultorio = $this->modelo_admin->obt_consultorio($id);
		$data['consultorio'] = $consultorio;
		$data['consultas_pendientes'] = $this->modelo_admin->obt_consultas_pendientes($id);
		$data['titulo'] = 'Consultas Pendientes - '.$consultorio['nombre'];		
		$this->load->view('lista_consultas_pendientes', $data);
	}
}

