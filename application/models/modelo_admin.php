<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelo_admin extends CI_Model {

    function __construct()
    {        
        parent::__construct();
    }

    function login($usuario, $password){
        return $this->db->get_where('usuario', array('nombre'=>$usuario, 'password'=>md5($password)))->row_array();
    }

    /*GENERALES*/

    function guardar_item($datos, $tabla){
        return $this->db->insert($tabla, $datos);
    }

    function act_item($datos, $id, $campo, $tabla){
        $this->db->where($campo, $id);
        return $this->db->update($tabla, $datos);
    }

    /*CARGOS*/

    function obt_cargo($id){
        return $this->db->get_where('cargo', array('cod_cargo'=>$id))->row_array();
    }

    function obt_cargos(){
        return $this->db->get('cargo')->result_array();
    }

    /*CLINICAS*/

    function obt_clinica($id){
        return $this->db->get_where('clinica', array('cod_clinica'=>$id))->row_array();
    }

    function obt_clinicas(){
        return $this->db->get('clinica')->result_array();
    }

    /*CONSULTORIOS*/

    function obt_consultorio($id){
        $datos = $this->db->query('SELECT *
                                   FROM consultorio
                                   WHERE cod_consultorio=?;', $id)->row_array();
        return $datos;
    }

    function obt_consultorios(){
        $datos = $this->db->query('SELECT co.*, cl.nombre AS nombre_clinica
                                   FROM consultorio co, clinica cl
                                   WHERE co.cod_clinica=cl.cod_clinica;')->result_array();
        return $datos;
    }

    /*DEPARTAMENTOS*/

    function obt_departamento($id){
        return $this->db->get_where('departamento', array('cod_departamento'=>$id))->row_array();
    }

    function obt_departamentos(){
        return $this->db->get('departamento')->result_array();
    }

    /*ESPECIALIDADES*/

    function obt_especialidad($id){
        return $this->db->get_where('especialidad', array('cod_especialidad'=>$id))->row_array();
    }

    function obt_especialidades(){
        return $this->db->get('especialidad')->result_array();
    }

    /*MUNICIPIOS*/

    function obt_municipio($id){
        $datos = $this->db->query('SELECT *
                                   FROM municipio
                                   WHERE cod_municipio=?;', $id)->row_array();
        return $datos;
    }

    function obt_municipios(){
        $datos = $this->db->query('SELECT mu.*, de.nombre AS nombre_departamento
                                   FROM municipio mu, departamento de
                                   WHERE mu.cod_departamento=de.cod_departamento;')->result_array();
        return $datos;
    }

    /*PERFILES*/

    function obt_perfil($id){
        return $this->db->get_where('perfil', array('cod_perfil'=>$id))->row_array();
    }

    function obt_perfiles(){
        return $this->db->get('perfil')->result_array();
    }

    /*USUARIOS*/

    function obt_usuario($id){
        $datos = $this->db->query('SELECT *
                                   FROM usuario
                                   WHERE cod_usuario=?;', $id)->row_array();
        return $datos;
    }

    function obt_usuarios(){
        $datos = $this->db->query('SELECT us.*, pe.nombre AS nombre_perfil
                                   FROM usuario us, perfil pe
                                   WHERE us.cod_perfil=pe.cod_perfil;')->result_array();
        return $datos;
    }
    /*TIPO EXAMEN*/
    function obt_tipoexamen($id){
        return $this->db->get_where('tipo_examen', array('cod_tipoExm'=>$id))->row_array();
    }

    function obt_tipoexamenes(){
        return $this->db->get('tipo_examen')->result_array();
    }
    /*ESPECIALIDAD EXAMEN*/
    function obt_especialidadexamen($id){
        return $this->db->get_where('especialidad_examen', array('cod_especialidad'=>$id))->row_array();
    }

    function obt_especialidadexamenes(){
        return $this->db->get('especialidad_examen')->result_array();
    }
}

?>