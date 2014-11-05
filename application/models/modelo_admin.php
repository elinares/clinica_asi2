<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelo_admin extends CI_Model {

    function __construct()
    {        
        parent::__construct();
    }

    function login($usuario, $password){
        return $this->db->get_where('usuario', array('nombre'=>$usuario, 'password'=>md5($password)))->row_array();
    }

    function obt_user_data($id){
        $data = $this->db->query('SELECT *,
                                  us.nombre AS nombre_usuario,
                                  pe.nombre AS nombre_persona,
                                  per.nombre AS nombre_perfil
                                  FROM usuario us
                                  INNER JOIN empleado em
                                  ON us.codigo_user=em.fk_codigo_user
                                  INNER JOIN persona pe
                                  ON pe.codigo_per=em.fk_codigo_per
                                  INNER JOIN perfil per
                                  ON us.fk_codigo_perf=per.codigo_perf
                                  AND us.codigo_user=?', $id)->row_array();
        return $data;
    }

    function obt_user_access($perfil){
        $data = $this->db->query('SELECT *
                                      FROM perfil_permiso pp
                                      INNER JOIN permiso per
                                      ON per.codigo_permi=pp.fk_codigo_permi
                                      AND pp.fk_codigo_perf=?', $perfil)->result_array();
        return $data;
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
        return $this->db->get_where('cargo', array('codigo_carg'=>$id))->row_array();
    }

    function obt_cargos(){
        return $this->db->get('cargo')->result_array();
    }

    /*CLINICAS*/

    function obt_clinica($id){
        return $this->db->get_where('clinica', array('codigo_cli'=>$id))->row_array();
    }

    function obt_clinicas(){
        return $this->db->get('clinica')->result_array();
    }

    /*CONSULTORIOS*/

    function obt_consultorio($id){
        $datos = $this->db->query('SELECT *
                                   FROM consultorio
                                   WHERE codigo_con=?;', $id)->row_array();
        return $datos;
    }

    function obt_consultorios(){
         $datos = $this->db->query('SELECT co.*, cl.nombre AS nombre_clinica
                                   FROM consultorio co, clinica cl
                                   WHERE co.fk_codigo_cli=cl.codigo_cli;')->result_array();
        return $datos;
        
    }

    /*DEPARTAMENTOS*/

    function obt_departamento($id){
        return $this->db->get_where('DEPARTAMENTO', array('codigo_dep'=>$id))->row_array();
    }

    function obt_departamentos(){
        return $this->db->get('departamento')->result_array();
    }

    /*ESPECIALIDADES*/

    function obt_especialidad($id){
        return $this->db->get_where('especialidad', array('codigo_esp'=>$id))->row_array();
    }

    function obt_especialidades(){
        return $this->db->get('especialidad')->result_array();
    }

    /*MUNICIPIOS*/

    function obt_municipio($id){
        $datos = $this->db->query('SELECT *
                                   FROM municipio
                                   WHERE codigo_muni=?;', $id)->row_array();
        return $datos;
    }

    function obt_municipios(){
        $datos = $this->db->query('SELECT mu.*, de.nombre AS nombre_departamento
                                   FROM "municipio" mu, "departamento" de
                                   WHERE mu.fk_codigo_dep=de.codigo_dep;')->result_array();
        return $datos;
    }

    /*PERFILES*/

    function obt_perfil($id){
        return $this->db->get_where('perfil', array('codigo_perf'=>$id))->row_array();
    }

    function obt_perfiles(){
        return $this->db->get('perfil')->result_array();
    }

    /*USUARIOS*/

    function obt_usuario($id){
        $datos = $this->db->query('SELECT *
                                   FROM usuario
                                   WHERE codigo_user=?;', $id)->row_array();
        return $datos;
    }

    function obt_usuarios(){
        $datos = $this->db->query('SELECT us.*, pe.nombre AS nombre_perfil
                                   FROM usuario us, perfil pe
                                   WHERE us.fk_codigo_perf=pe.codigo_perf;')->result_array();
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

    function obt_citas(){
        $datos=$this->db->query('select persona.nombres, persona.apellidos, paciente.codigo_pac, cita.fecha 
            from persona inner join paciente on paciente.fk_codigo_per =  persona.codigo_per 
            inner join cita on cita.fk_codigo_pac=paciente.codigo_pac ')->result_array();
        return $datos;
    }
    function busqueda_pacientes($criterio){
        $datos=$this->db->query("SELECT persona.nombres, persona.apellidos, paciente.codigo_pac
  FROM persona inner join paciente on paciente.fk_codigo_per=persona.codigo_per and persona.nombres like '%".$criterio."%'")->result_array();
        return $datos;
    }
    function obt_configuracion(){
        $datos=$this->db->query('SELECT codigo_confi, hora_inicial, hora_final
  FROM configuracion_cita;')->result_array();
        return $datos;


    }
    function obt_paciente($id){
    	$datos=$this->db->query('SELECT persona.nombres, persona.apellidos, paciente.codigo_pac from persona inner join paciente
    	on paciente.fk_codigo_per=persona.codigo_per where codigo_pac=?;', $id)->result_array();
    	return $datos;
    }
    /*
    CONFIGURACION CITA
    */
    function obt_configuracion_cita($id){
        return $this->db->get_where('configuracion_cita', array('codigo_confi'=>$id))->row_array();
    }

    function obt_configuracion_citas(){
        return $this->db->get('configuracion_cita')->result_array();
    }



     function obt_persona($id){
        $datos = $this->db->query('SELECT *
                                   FROM persona
                                   WHERE codigo_per=?;', $id)->row_array();
        return $datos;
    }


    /*    function obt_empleados(){
            $datos = $this->db->query('SELECT em.*, cl.nombre AS nombre_clinica
                                   FROM empleado em, clinica cl
                                   WHERE em.clinica=cl.cod_clinica;')->result_array();
        return $datos;

    }*/
    function obt_personas(){
            $datos = $this->db->query('SELECT pe.*, muni.nombre AS nombre_municipio
                                   FROM persona pe, municipio muni
                                   WHERE pe.fk_codigo_muni=muni.codigo_muni;')->result_array();
        return $datos;

    }

      function obt_empleado($id){
        $datos = $this->db->query('SELECT *
                                   FROM empleado
                                   WHERE codigo_emp=?;', $id)->row_array();
        return $datos;
    }

        function obt_empleados(){
            $datos = $this->db->query('SELECT empleado.*,persona.nombres,persona.apellidos,especialidad.nombre as especialidad,cargo.nombre as cargo from empleado 
inner join persona on empleado.fk_codigo_per=persona.codigo_per
inner join cargo on empleado.fk_codigo_carg=cargo.codigo_carg
inner join especialidad on empleado.fk_codigo_esp=especialidad.codigo_esp
;')->result_array();
        return $datos;

    }

        function buscar_empleados($criterio){
        $datos=$this->db->query("SELECT nombres,apellidos,codigo_per
  FROM persona where nombres   like '%".$criterio."%'")->result_array();
        return $datos;
    }

        function obt_empleado1($id){
        $datos=$this->db->query('SELECT * from persona  where codigo_per=?;', $id)->result_array();
        return $datos;
    }




 function obt_pacientes(){
        $datos=$this->db->query("SELECT persona.nombres, persona.apellidos, paciente.codigo_pac
  FROM persona inner join paciente on paciente.fk_codigo_per=persona.codigo_per ")->result_array();
        return $datos;
    }

  function obt_donante($id){
        $datos = $this->db->query('SELECT *
                                   FROM donante
                                   WHERE codigo_dont=?;', $id)->row_array();
        return $datos;
    }


    /*    function obt_empleados(){
            $datos = $this->db->query('SELECT em.*, cl.nombre AS nombre_clinica
                                   FROM empleado em, clinica cl
                                   WHERE em.clinica=cl.cod_clinica;')->result_array();
        return $datos;

    }*/
    function obt_donantes(){
            $datos = $this->db->query('SELECT don.*, per.nombres as nombres_donante
from donante don,  persona per
where don.fk_codigo_per = per.codigo_per;')->result_array();
        return $datos;

    }

     function obt_new_empleado($id){
        $datos = $this->db->query('SELECT *
                                   FROM empleado
                                   WHERE codigo_emp=?;', $id)->row_array();
        return $datos;
    }


    /*    function obt_empleados(){
            $datos = $this->db->query('SELECT em.*, cl.nombre AS nombre_clinica
                                   FROM empleado em, clinica cl
                                   WHERE em.clinica=cl.cod_clinica;')->result_array();
        return $datos;

    }*/
    function obt_new_empleados(){
            //$this->db->join('comments', 'comments.id = blogs.id');

            $datos = $this->db->query('select emp.*, per.nombres as nombres_empleado,per.apellidos as apellidos_empleado, per.fecha_nacimiento as cumpleaños, per.direccion, per.estado_civil as estado_civil, per.genero, per.dui
from empleado emp,  persona per
where emp.fk_codigo_per = per.codigo_per;')->result_array();
        return $datos;

    }



}

?>
