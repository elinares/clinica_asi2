<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "administrador";
$route['404_override'] = '';

//SuperAdmin
$route['superadmin'] = "superadministrador/inicio";

//Admin
$route['inicio'] = "administrador/inicio";

//General
$route['logout'] = "administrador/logout";

/*Cargos*/
$route['cargos'] = "administrador/cargos";
$route['agregar_cargo'] = "administrador/agregar_cargo";
$route['editar_cargo/(:any)'] = "administrador/editar_cargo/$1";
$route['borrar_cargo/(:any)'] = "administrador/borrar_cargo/$1";

/*Clinicas*/
$route['clinicas'] = "administrador/clinicas";
$route['agregar_clinica'] = "administrador/agregar_clinica";
$route['editar_clinica/(:any)'] = "administrador/editar_clinica/$1";
$route['borrar_clinica/(:any)'] = "administrador/borrar_clinica/$1";

/*Consultorios*/
$route['consultorios'] = "administrador/consultorios";
$route['agregar_consultorio'] = "administrador/agregar_consultorio";
$route['editar_consultorio/(:any)'] = "administrador/editar_consultorio/$1";
$route['borrar_consultorio/(:any)'] = "administrador/borrar_consultorio/$1";

/*Departamentos*/
$route['departamentos'] = "administrador/departamentos";
$route['agregar_departamento'] = "administrador/agregar_departamento";
$route['editar_departamento/(:any)'] = "administrador/editar_departamento/$1";
$route['borrar_departamento/(:any)'] = "administrador/borrar_departamento/$1";

/*Especialidades*/
$route['especialidades'] = "administrador/especialidades";
$route['agregar_especialidad'] = "administrador/agregar_especialidad";
$route['editar_especialidad/(:any)'] = "administrador/editar_especialidad/$1";
$route['borrar_especialidad/(:any)'] = "administrador/borrar_especialidad/$1";

/*Municipios*/
$route['municipios'] = "administrador/municipios";
$route['agregar_municipio'] = "administrador/agregar_municipio";
$route['editar_municipio/(:any)'] = "administrador/editar_municipio/$1";
$route['borrar_municipio/(:any)'] = "administrador/borrar_municipio/$1";

/*Perfiles*/
$route['perfiles'] = "administrador/perfiles";
$route['agregar_perfil'] = "administrador/agregar_perfil";
$route['editar_perfil/(:any)'] = "administrador/editar_perfil/$1";
$route['borrar_perfil/(:any)'] = "administrador/borrar_perfil/$1";

/*Usuarios*/
$route['usuarios'] = "administrador/usuarios";
$route['agregar_usuario'] = "administrador/agregar_usuario";
$route['editar_usuario/(:any)'] = "administrador/editar_usuario/$1";
$route['borrar_usuario/(:any)'] = "administrador/borrar_usuario/$1";

/*Tipo Examen*/
$route['tipo_examenes'] = "administrador/tipo_examenes";
$route['agregar_tipo_examen'] = "administrador/agregar_tipo_examen";
$route['editar_tipo_examen/(:any)'] = "administrador/editar_tipo_examen/$1";
$route['borrar_tipo_examen/(:any)'] = "administrador/borrar_tipo_examen/$1";

/*Especialidad Examen*/
$route['especialidad_examenes'] = "administrador/especialidad_examenes";
$route['agregar_especialidad_examen'] = "administrador/agregar_especialidad_examen";
$route['editar_especialidad_examen/(:any)'] = "administrador/editar_especialidad_examen/$1";
$route['borrar_especialidad_examen/(:any)'] = "administrador/borrar_especialidad_examen/$1";

/*especialidad Empleados*/

$route['empleados'] = "administrador/empleados";
/*citas*/
$route['citas']="administrador/citas";
$route['buscar_paciente']="administrador/buscar_paciente";
$route['asignacion_cita/(:any)']="administrador/asignacion_cita/$1";
$route['ingresar_cita']="administrador/ingresar_cita";

/*Configuracion cita*/
$route['configuracion_citas'] = "administrador/configuracion_citas";
$route['agregar_configuracion_cita'] = "administrador/agregar_configuracion_cita";
$route['editar_configuracion_cita/(:any)'] = "administrador/editar_configuracion_cita/$1";
$route['borrar_configuracion_cita/(:any)'] = "administrador/borrar_configuracion_cita/$1";


$route['personas'] = "administrador/personas";
$route['agregar_persona'] = "administrador/agregar_persona";
$route['editar_persona/(:any)'] = "administrador/editar_persona/$1";
$route['borrar_persona/(:any)'] = "administrador/borrar_persona/$1";

$route['empleados'] = "administrador/empleados";
$route['agregar_empleado'] = "administrador/agregar_empleado";
$route['editar_empleado/(:any)'] = "administrador/editar_empleado/$1";
$route['borrar_empleado/(:any)'] = "administrador/borrar_empleado/$1";


$route['buscar_empleado'] = "administrador/buscar_empleado";
$route['asignacion_empleado/(:any)'] = "administrador/asignacion_empleado/$1";
//$route['asignacion_cita/(:any)']="administrador/asignacion_cita/$1";


/* pacientes*/
$route['pacientes'] = "administrador/pacientes";
$route['buscar_persona_paciente'] = "administrador/buscar_persona_paciente";
$route['resultado_busqueda_paciente'] = "administrador/resultado_busqueda_paciente";
$route['agregar_paciente_op1'] = "administrador/agregar_paciente_op1";
$route['agregar_paciente_op2/(:any)'] = "administrador/agregar_paciente_op2/$1";


//e new_empleados
$route['new_empleados'] = "administrador/new_empleados";
$route['agregar_new_empleado'] = "administrador/agregar_new_empleado";


//Laboratorios
$route['laboratorios'] = "administrador/laboratorios";
$route['agregar_laboratorio'] = "administrador/agregar_laboratorio";
$route['editar_laboratorio/(:any)'] = "administrador/editar_laboratorio/$1";
$route['borrar_laboratorio/(:any)'] = "administrador/borrar_laboratorio/$1";


//Tipo Productos
$route['tipo_productos'] = "administrador/tipo_productos";
$route['agregar_tipo_producto'] = "administrador/agregar_tipo_producto";
$route['editar_tipo_producto/(:any)'] = "administrador/editar_tipo_producto/$1";
$route['borrar_tipo_producto/(:any)'] = "administrador/borrar_tipo_producto/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */