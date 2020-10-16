<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . '/libraries/REST_Controller.php');

use Restserver\libraries\REST_Controller;

class Usuarios extends REST_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_datos', "", true);
	}


	public function todos_get($pagina = 0)
	{
		$pagina = $pagina * 10;

		$respuesta = $this->m_datos->obt_usuarios($pagina);

		$this->response($respuesta);
	}

	public function buscar_get($termino)
	{
		$respuesta = $this->m_datos->buscar_usuarios($termino);

		$this->response($respuesta);
	}
}
