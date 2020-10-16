<?php

class m_ticket extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_tickets()
    {

    	$query =  $this->db->get('ticket');

    	$respuesta = array(
    		'error' => FALSE,
    		'tickets' => $query->result_array()
    	);

   		return $respuesta;
    }
}
?>