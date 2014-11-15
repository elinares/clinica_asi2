<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function index(){
		
		}

public function municipio(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();
		//Obtener datos para reporte
		$municipios = $this->modelo_admin->obt_municipios();

		foreach ($municipios as $municipio) {
			$db_data[] = $municipio;
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


public function cargo(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$cargos = $this->modelo_admin->obt_cargos();
		foreach ($cargos as $cargo){
			$db_data[] = $cargo;
		}
		
		/*print_r($db_data);
		exit();*/

		$col_names = array(
			'codigo_carg' => 'Codigo',
			'nombre' => 'nombre'
			);

		$this->cezpdf->ezTable($db_data, $col_names, 'Listado de Cargos', array('width'=>350));
		$this->cezpdf->ezStream();


}

public function detalle_compra(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$compras = $this->modelo_admin->obt_reporte_compras();
		foreach ($compras as $compra){
			$db_data[] = $compra;
		}

		/*print_r($db_data);
		exit();*/

		$col_names = array(
			'codigo_clinica'=>'Codigo Clinica',
			'clinica'=>'Nombre Clinica',
			'factura'=> 'N° Factura',
			'codigo_producto'=> 'Codigo Producto',
			'producto'=>'Producto',			
			'fecha_compra'=>'Fecha Compra',
			
			'costo'=>'Costo',
			'cantidad'=> 'Cantidad',
			'total'=> 'Total'

			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Compras', array('width'=>550));
		$this->cezpdf->ezStream();

}

public function frm_compra_fecha(){

	if ($this->input->post()){
		$fecha_inicial= $this->input->post('fecha_inicial');
		$fecha_final=$this->input->post('fecha_final');

		$compras = $this->modelo_admin->obt_frm_compra_fecha($fecha_inicial,$fecha_final);
		print_r($compras);

		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		foreach ($compras as $compra){
			$db_data[] = $compra;
		}

		$col_names = array(
			'codigo_comp'=>'Codigo Compra',
			'factura'=> 'N° Factura',
			'fecha'=>'Fecha Compra',
			'clinica'=>'Nombre Clinica',
			'encargado'=>'Encargado/a',
			'total'=> 'Total'

			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Compras', array('width'=>550));
		$this->cezpdf->ezStream();
	}

	$this->load->view('reporte_compras_fechas');
}
public function detalle_donacion(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$donaciones = $this->modelo_admin->obt_reporte_donacion();
		foreach ($donaciones as $donacion){
			$db_data[] = $donacion;
		}

		/*print_r($db_data);
		exit();*/

			$col_names = array(
			'codigo_dona'=>'Codigo Donacion',
			'estado'=> 'Estado',
			'fecha'=>'Fecha Donacion',
			'donante' => 'Donante',
			'telefono' => 'Telefono',
			'email' => 'Email',
			'clinica'=> 'Clinica',
			'encargado' => 'encargado'


			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Reporte de Donaciones', array('width'=>550));
		$this->cezpdf->ezStream();


}

public function expediente(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$expedientes = $this->modelo_admin->obt_reporte_expediente();
		foreach ($expedientes as $expediente){
			$db_data[] = $expediente;
		}

		/*print_r($db_data);
		exit();*/

			$col_names = array(
			'codigo_pac' => 'Codigo Paciente',
			'codigo_exp'=>'Expediente',
			'nombres'=>'Nombres',
			'apellidos'=> 'Apellidos',
			'fecha_nacimiento'=>'Fecha de Nacimiento',
			'direccion' => 'Direccion',
			'estado_civil' => 'Estado Cvil',
			'genro' => 'Genero',
			'dui'=> 'DUI',
			'ocupacion' => 'Ocupacion',
			'fecha_registro'=> 'Registro'


			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Reporte de Expedienes', array('width'=>550));
		$this->cezpdf->ezStream();


}

public function historico(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$historicos = $this->modelo_admin->obt_historico();
		foreach ($historicos as $historico){
			$db_data[] = $historico;
		}

		/*print_r($db_data);
		exit();*/

			$col_names = array(
			'codigo_pac' => 'Codigo Paciente',
			'codigo_exp'=>'Expediente',
			'nombres'=>'Nombres',
			'apellidos'=> 'Apellidos',
			'altura'=>'Altura',
			'peso' => 'Peso',
			'presion_arterial' => 'Presión Arterial',
			'temperatura' => 'Temperatura',
			'fecha_consulta'=> 'Fecha Consulta',



			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Historico de Pacientes', array('width'=>550));
		$this->cezpdf->ezStream();


}


public function productos(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$productos = $this->modelo_admin->obt_reporte_producto();
		foreach ($productos as $producto){
			$db_data[] = $producto;
		}

		/*print_r($db_data);
		exit();*/

			$col_names = array(
			'clinica' => 'Clinica',
			'codigo_produ' => 'Codigo Producto',
			'producto'=>'Producto',
			'tipo_presentacion'=>'Tipo Presentacion',
			'precio'=> 'Precio',
			'cantidad_minima'=>'Cantidad Minima',
			'cantidad_maxima' => 'Cantidad Maxima',
			'existencia' => 'Existencia',
			'cantidad' => 'Cantidad',
			'fecha_vencimiento'=> 'Fecha Vencimiento',



			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Productos', array('width'=>550));
		$this->cezpdf->ezStream();


}

public function kardex(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$productos = $this->modelo_admin->obt_kardex();
		foreach ($productos as $producto){
			$db_data[] = $producto;
		}

		/*print_r($db_data);
		exit();*/

			$col_names = array(
			'codigo_producto' => 'Codigo Producto',
			'producto' => 'Producto',
			'entradas'=>'Entradas',
			'salidas'=>'Salidas',
			



			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Kardex', array('width'=>550));
		$this->cezpdf->ezStream();


}

public function citas(){
		$this->load->library('cezpdf');
		$this->load->helper('pdf');
		prep_pdf();

		$citas = $this->modelo_admin->obt_citas();
		foreach ($citas as $cita){
			$db_data[] = $cita;
		}

		/*print_r($db_data);
		exit();*/

			$col_names = array(
			'codigo_pac' => 'Codigo Paciente',
			'fecha' => 'Fecha',
			'estado'=>'Estado',
			'nombres'=>'Nombres ',
			'apellidos'=>'Apellidos'
			



			);
		$this->cezpdf->ezTable($db_data, $col_names, 'Citas ', array('width'=>550));
		$this->cezpdf->ezStream();


}

}

