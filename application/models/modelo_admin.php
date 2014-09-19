<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelo_admin extends CI_Model {

    function __construct()
    {        
        parent::__construct();
    }

    /*CLINICAS*/

    function obt_clinica($id){
        return $this->db->get_where('clinica', array('cod_clinica'=>$id))->row_array();
    }

    function obt_clinicas(){
        return $this->db->get('clinica')->result_array();
    }

    function guardar_clinica($datos){
        return $this->db->insert('clinica', $datos);
    }
    
    function act_clinica($datos, $id){
        $this->db->where('cod_clinica', $id);
        return $this->db->update('clinica', $datos);
    }
}

?>