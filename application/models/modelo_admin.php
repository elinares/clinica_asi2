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
        $data = $this->db->query('SELECT 
                                      us.nombre AS nombre_usuario,
                                      us.estado,
                                      us.fk_codigo_perf,
                                      pe.nombres AS nombre_persona,
                                      pe.apellidos AS apellidos_persona,
                                      cli.nombre as nombre_clinica,
                                      perf.nombre AS nombre_perfil,
                                      cli.codigo_cli,
                                      em.codigo_emp                                                      
                                      FROM usuario us
                                      INNER JOIN empleado em ON us.codigo_user=em.fk_codigo_user
                                      INNER JOIN persona pe ON pe.codigo_per=em.fk_codigo_per
                                      INNER JOIN empleado_clinica empcli ON empcli.fk_codigo_emp=em.codigo_emp
                                      INNER JOIN clinica cli ON empcli.fk_codigo_cli=cli.codigo_cli
                                      INNER JOIN perfil perf ON us.fk_codigo_perf=perf.codigo_perf
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

    /*COMPRAS*/

    function obt_compras(){
        return $this->db->query('SELECT c.codigo_comp, c.factura, c.fecha, t.total
                                 FROM compra c,
                                 (SELECT sum(costo * cantidad) AS total, fk_codigo 
                                  FROM detalle_compra 
                                  GROUP BY fk_codigo) t
                                  WHERE c.codigo_comp=t.fk_codigo;')->result_array();
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

    function obt_consultorios($id){
         $datos = $this->db->query('SELECT co.*, cl.nombre AS nombre_clinica
                                   FROM consultorio co, clinica cl
                                   WHERE co.fk_codigo_cli=cl.codigo_cli
                                   AND co.fk_codigo_cli=?;', $id)->result_array();
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

    function obt_perfiles($id){
        return $this->db->query('SELECT *
                                 FROM perfil
                                 WHERE fk_codigo_cli=?;', $id)->result_array();
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

    function obt_citas($id){
       $datos=$this->db->query(' SELECT persona.nombres, persona.apellidos, paciente.codigo_pac, cita.fecha, configuracion_cita.codigo_confi, consultorio.codigo_con, clinica.codigo_cli
            from persona inner join paciente on paciente.fk_codigo_per =  persona.codigo_per 
            inner join cita on cita.fk_codigo_pac=paciente.codigo_pac
            inner join configuracion_cita on cita.fk_codigo_confi=configuracion_cita.codigo_confi 
            inner join consultorio on configuracion_cita.fk_codigo_con=consultorio.codigo_con
            inner join clinica on consultorio.fk_codigo_cli=clinica.codigo_cli where codigo_cli=?;',$id)->result_array();
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

     function obt_configuracion_citas($id){
        $datos=$this->db->query('SELECT configuracion_cita.codigo_confi, configuracion_cita.hora_inicial, configuracion_cita.hora_final, configuracion_cita.cantidad_maxima, consultorio.nombre, clinica.nombre, clinica.codigo_cli 
          from configuracion_cita 
          inner join consultorio on consultorio.codigo_con=configuracion_cita.fk_codigo_con 
          inner join clinica on consultorio.fk_codigo_cli=clinica.codigo_cli where clinica.codigo_cli=?;',$id)->result_array();
        return $datos;
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
        $datos=$this->db->query("SELECT *
                                 FROM persona pe
                                 INNER JOIN paciente  pa
                                 ON pa.fk_codigo_per=pe.codigo_per
                                 INNER JOIN municipio mu 
                                 ON pe.fk_codigo_muni=mu.codigo_muni
                                 INNER JOIN expediente ex
                                 ON pa.codigo_pac=ex.fk_codigo_pac")->result_array();
        return $datos;
    }



function busqueda_persona_pacientes($criterio,$criterio2){
        $datos=$this->db->query("SELECT *
                                 FROM persona pe
                                 INNER JOIN paciente pa
                                 ON pe.codigo_per=pa.fk_codigo_per
                                 INNER JOIN expediente ex
                                 ON pa.codigo_pac=ex.fk_codigo_pac
                                 AND pe.nombres like '%".$criterio."%' 
                                 AND pe.apellidos like '%".$criterio2."%' ")->result_array();
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


 /*Tipo Examen*/

    function obt_tipo_examen($id){
        return $this->db->get_where('tipo_examen', array('codigo_tipex'=>$id))->row_array();
    }

    function obt_tipo_examenes(){
        return $this->db->get('tipo_examen')->result_array();
    }


/* Especialidad Examen*/

function obt_especialidad_examen($id){
        $datos = $this->db->query('SELECT *
                                   FROM especialidad_examen
                                   WHERE codigo_espe=?;', $id)->row_array();
        return $datos;
    }

    function obt_especialidad_examenes(){
        $datos = $this->db->query('SELECT espe.*, tip.tipo as tipo_examen
                                  from especialidad_examen espe, tipo_examen tip 
                                  where espe.fk_codigo_tipex = tip.codigo_tipex;')->result_array();
        return $datos;
    }
    function obt_especialidad_examenes1(){
       return $this->db->get('especialidad_examen')->result_array();
    }

/* Especialidad Examen*/

function obt_laboratorio($id){
        $datos = $this->db->query('SELECT *
                                   FROM laboratorio
                                   WHERE codigo_lab=?;', $id)->row_array();
        return $datos;
    }

    function obt_laboratorios(){
        $datos = $this->db->query('SELECT lab.*, espe.nombre as especialidad_examen
from laboratorio lab, especialidad_examen espe 
where lab.fk_codigo_espe=espe.codigo_espe;')->result_array();
        return $datos;
    }

  /* Tipo Producto*/
     function obt_tipo_producto($id){
        return $this->db->get_where('tipo_producto', array('codigo_tipoprod'=>$id))->row_array();
    }

    function obt_tipo_productos(){
        return $this->db->get('tipo_producto')->result_array();
    }

       /*Tipo Presentacion*/

    function obt_tipo_presentacion($id){
        return $this->db->get_where('tipo_presentacion', array('codigo_tipre'=>$id))->row_array();
    }

    function obt_tipo_presentaciones(){
        return $this->db->get('tipo_presentacion')->result_array();
    }

    /*Tipo Servicio*/

    function obt_tipo_servicios(){
        return $this->db->get('tipo_servicio')->result_array(); 
    }


//  LLENA LOS SELECT CON LOS MUNICIPIOS DE UN DEPARTAMENTO---------------------------------


public function departamentos()
    {
        $this->db->order_by('nombre','asc');
        $departamento = $this->db->get('departamento');
        if($departamento->num_rows()>0)
        {
            return $departamento->result();
        }
    }
    
    public function municipios($departamento)
    {
        $this->db->where('fk_codigo_dep',$departamento);
        $this->db->order_by('nombre','asc');
        $municipi = $this->db->get('municipio');

        if($municipi->num_rows()>0)
        {
            return $municipi->result();
        }
    }
//----------------------------------------------------------------------------------


    //ALERTAS

    function maxima_existencia(){
      return $this->db->query('SELECT *
                       FROM tipo_producto
                       WHERE existencia >= cantidad_maxima
                       AND medicamento = 1;')->result_array();
    }

    function minima_existencia(){
      return $this->db->query('SELECT *
                       FROM tipo_producto
                       WHERE existencia <= cantidad_minima
                       AND medicamento = 1;')->result_array();
    }

    function lista_vencimientos($id){
      return $this->db->query('SELECT * 
                               FROM(
                               SELECT p.codigo_produ, p.cantidad, p.fecha_vencimiento, tp.nombre, p.fecha_vencimiento - date(timestamp \'now()\') as dias
                               FROM producto p
                               INNER JOIN tipo_producto tp
                               ON p.fk_codigo_tipoprod=tp.codigo_tipoprod
                               AND tp.medicamento = 1
                               AND P.fk_codigo_cli = ?
                               ORDER BY p.fecha_vencimiento ASC
                               ) venc
                               WHERE venc.dias<=7;', $id)->result_array();
    }

    //CONSULTAS PENDIENTES

    function obt_consultas_pendientes($id){
      return $this->db->query('SELECT * 
                               FROM servicio_medico sm
                               INNER JOIN expediente ex
                               ON sm.fk_codigo_exp=ex.codigo_exp
                               INNER JOIN paciente pa
                               ON ex.fk_codigo_pac=pa.codigo_pac
                               INNER JOIN persona pe
                               ON pa.fk_codigo_per=pe.codigo_per
                               INNER JOIN tipo_servicio ts
                               ON sm.fk_codigo_tipser=ts.codigo_tipser
                               AND sm.estado=\'Pendiente\'
                               AND sm.fk_codigo_con=?;', $id)->result_array();
    }
     /*Obtener ultima clinica*/
    function obt_ultima_clinica(){
      return $this->db->query('SELECT MAX(codigo_cli) AS ultimo_id FROM clinica')->row_array();
    }

    function obt_usuarios_superadmin(){
    return $this->db->query('SELECT  persona.nombres, persona.apellidos, usuario.codigo_user, usuario.nombre as usuario
                              FROM persona 
                              INNER JOIN empleado
                              ON empleado.fk_codigo_per = persona.codigo_per
                              INNER JOIN usuario
                              ON empleado.fk_codigo_user = usuario.codigo_user;') ->result_array();
    }
    /*obtener modulo*/
      function obt_modulo(){
        return $this->db->get('modulo')->result_array();
    }

     function obt_reporte_compras(){
       $datos = $this->db->query('SELECT  compra.fk_codigo_cli as codigo_clinica,clinica.nombre as clinica,compra.factura,detalle_compra.fk_codigo_produ as codigo_producto,tipo_producto.nombre as producto,
 compra.fecha as fecha_compra,detalle_compra.costo,detalle_compra.cantidad,(detalle_compra.costo * detalle_compra.cantidad) as total
from compra inner join clinica
on compra.fk_codigo_cli=clinica.codigo_cli 
inner join detalle_compra
on detalle_compra.fk_codigo = compra.codigo_comp
inner join tipo_producto
on tipo_producto.codigo_tipoprod = detalle_compra.fk_codigo_produ')->result_array();
                                  return $datos;
    }

   function obt_frm_compra_fecha($fecha_inicial,$fecha_final){
$datos = $this->db->query('SELECT compra.codigo_comp, compra.factura, compra.fecha, clinica.nombre as clinica, clinica.encargado,(detalle_compra.costo * detalle_compra.cantidad) as total
from compra inner join clinica 
on compra.fk_codigo_cli=clinica.codigo_cli 
inner join detalle_compra 
on detalle_compra.fk_codigo = compra.codigo_comp
and compra.fecha between \''.$fecha_inicial.'\' and \''.$fecha_final.'\';')->result_array();
                                      return $datos;

    }

    function obt_reporte_donacion(){
$datos = $this->db->query('SELECT donacion.codigo_dona,donacion.estado,donacion.fecha,donante.nombre as donante,donante.telefono,donante.email,clinica.nombre as clinica, clinica.encargado
from donacion inner join donante
on donacion.fk_codigo_dont = donante.codigo_dont
inner join clinica
on donacion.fk_codigo_cli = clinica.codigo_cli;')->result_array();
                                      return $datos;

    }


    function obt_reporte_expediente(){
$datos = $this->db->query('SELECT departamento.nombre as departamento,municipio.nombre as municipio,
       persona.nombres,persona.apellidos,persona.fecha_nacimiento,persona.direccion,persona.estado_civil,persona.genero,persona.dui,
       paciente.codigo_pac,paciente.ocupacion,paciente.fecha_registro,
       expediente.codigo_exp,expediente.codigo_fisico,expediente.alergia,expediente.enfermedad_padecida,expediente.antecedente,expediente.fecha_creacion
  from persona inner join paciente
  on paciente.fk_codigo_per = persona.codigo_per
  inner join expediente
  on  expediente.fk_codigo_pac=paciente.codigo_pac
  inner join departamento
  on persona.fk_codigo_muni   = departamento.codigo_dep
  inner join municipio
  on departamento.codigo_dep = municipio.fk_codigo_dep')->result_array();
                                      return $datos;

    }
    function obt_historico(){
$datos = $this->db->query('SELECT paciente.codigo_pac as No_Paciente,expediente.codigo_exp,persona.nombres,persona.apellidos,historico.altura,historico.peso,historico.presion_arterial,historico.temperatura,historico.fecha_consulta
from persona inner join paciente
on persona.codigo_per=paciente.fk_codigo_per
inner join expediente
on paciente.codigo_pac = expediente.fk_codigo_pac
inner join historico
on expediente.codigo_exp=historico.fk_codigo_exp')->result_array();
                                      return $datos;

    }

        function obt_reporte_producto(){
$datos = $this->db->query('SELECT clinica.nombre as clinica,tipo_producto.nombre as producto,tipo_presentacion.tipo as tipo_presentacion,tipo_producto.precio,tipo_producto.cantidad_minima,tipo_producto.cantidad_maxima,tipo_producto.existencia,producto.codigo_produ,producto.cantidad,producto.fecha_vencimiento
from producto inner join clinica
on producto.fk_codigo_cli = clinica.codigo_Cli
inner join tipo_producto
on producto.fk_codigo_tipoprod = tipo_producto.codigo_tipoprod
inner join tipo_presentacion
on producto.fk_codigo_tipre = tipo_presentacion.codigo_tipre')->result_array();
                                      return $datos;

    }

    function obt_kardex(){
$datos = $this->db->query('SELECT producto.codigo_produ as codigo_producto, tipo_producto.nombre as producto, detalle_compra.cantidad as entradas, detalle_receta.cantidad as salidas
from producto inner join tipo_producto
on producto.fk_codigo_tipoprod = tipo_producto.codigo_tipoprod
inner join detalle_compra
on detalle_compra.fk_codigo_produ = producto.codigo_produ
inner join detalle_receta
on detalle_receta.fk_codigo_tipoprod=tipo_producto.codigo_tipoprod;')->result_array();
                                      return $datos;

    }

    function obt_cita(){
$datos = $this->db->query('SELECT paciente.codigo_pac,cita.fecha,cita.estado,persona.nombres,persona.apellidos
from paciente inner join persona
on persona.codigo_per = paciente.fk_codigo_per
inner join cita
on cita.fk_codigo_pac = paciente.codigo_pac;')->result_array();
                                      return $datos;

    }

     /*DONACIONES*/

    function obt_donacion($id){
        $datos = $this->db->query('SELECT *
                                   FROM donacion
                                   WHERE codigo_dona=?;', $id)->row_array();
        return $datos;
    }

    function obt_donaciones(){
            $datos = $this->db->query('SELECT dona.*, don.nombre as nombres_donante,don.primer_apellido as apellido1, don.segundo_apellido as apellido2,
                                       don.direccion, don.telefono, don.email, don.tipo_documento, don.numero_documento, cli.nombre as clinica 
                                       from donante don, clinica cli, donacion dona where dona.fk_codigo_dont = don.codigo_dont and dona.fk_codigo_cli = cli.codigo_cli')->result_array();
        return $datos;

    }

    //HISTORICO

    function obt_historico_expediente($id){
      return $this->db->query('SELECT *
                               FROM historico
                               WHERE fk_codigo_exp=?
                               ORDER BY fecha_consulta DESC', $id)->result_array();
    }

    //EXPEDIENTE

    function obt_paciente_expediente($id){
      return $this->db->query('SELECT * 
                               FROM expediente ex
                               INNER JOIN paciente pa
                               ON ex.fk_codigo_pac=pa.codigo_pac
                               INNER JOIN persona pe
                               ON pa.fk_codigo_per=pe.codigo_per                               
                               AND ex.codigo_exp=?;', $id)->row_array();
    }

}

?>
