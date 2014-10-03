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

$route['inicio'] = "administrador/inicio";

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

/*Empleados*/
$route['empleados'] = "administrador/empleados";
$route['agregar_empleado'] = "administrador/agregar_empleado";
$route['editar_empleado/(:any)'] = "administrador/editar_empleado/$1";
$route['borrar_empleado/(:any)'] = "administrador/borrar_empleado/$1";

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

/*Usuarios*/
$route['usuarios'] = "administrador/usuarios";
$route['agregar_usuario'] = "administrador/agregar_usuario";
$route['editar_usuario/(:any)'] = "administrador/editar_usuario/$1";
$route['borrar_usuario/(:any)'] = "administrador/borrar_usuario/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */