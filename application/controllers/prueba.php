<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {
	
	public function index()
	{
		//Llamado de librerias y helper
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf();

		//Obtener datos para reporte
		$municipios = $this->modelo_admin->obt_municipios();

		foreach ($municipios as $municipio) {
			$db_data[0] = $municipio;
		}

		/*print_r($db_data);
		exit();*/
		
		//Asignacion de encabezados
		$col_names = array(
			'nombre' => 'Nombre',
			'nombre_departamento' => 'Departamento'
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, 'Listado de municipios', array('width'=>550));
		$this->cezpdf->ezStream();
	}

}

