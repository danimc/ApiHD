<?php

class m_datos extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_usuarios($pagina)
    {
    	$qry = "";

    	$qry = "SELECT * FROM usuario LIMIT $pagina ,10";

    	$query = $this->db->query($qry);

    	$respuesta = array(
    		'error' => FALSE,
    		'usuarios' => $query->result_array()
    	);

   		return $respuesta;
    }

    function buscar_usuarios($termino)
    {

    	$qry = "";

    	$qry = "SELECT * FROM usuario where codigo = $termino ";

    	$query = $this->db->query($qry);

    	$respuesta = array(
    		'error' => FALSE,
    		'busqueda' => $termino,
    		'usuarios' => $query->result_array()
    	);

   		return $respuesta;
    }

    function login($condiciones)
    {
    	return $this->db->get_where('usuario', $condiciones)->row();
    }

    function guardar_token($login, $token)
    {
    	$this->db->where( 'codigo', $login->codigo );

    	return $this->db->update('usuario', $token);
    }

    function validar_usr($condiciones)
    {
    	$this->db->where( $condiciones );

    	return $this->db->get('usuario')->row();
    }
    
}
?>