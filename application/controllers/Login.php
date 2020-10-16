<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . '/libraries/REST_Controller.php');

use Restserver\libraries\REST_Controller;

class Login extends REST_Controller
{

	public function __construct()
	{

		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");


		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_ticket', "", true);
		$this->load->model('m_datos', "", true);
	}

	public function index_post()
	{
		$data = $this->post();

		if (!isset($data['usuario']) || !isset($data['password'])) {

			$respuesta = array(
				'error' => TRUE,
				'mensaje' => 'La información enviada no es valida'
			);
			$this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST);
			return;
		}

		$condiciones = array(
			'usuario' => $data['usuario'],
			'password' => $data['password']
		);

		$login = $this->m_datos->login($condiciones);

		if (!isset($login)) {
			$respuesta = array(
				'error' => TRUE,
				'mensaje' => 'Usuario y/o contraseña no son validos'
			);

			$this->response($respuesta);
			return;
		}

		//AQUI, ya se valido usuario y contraseña

		//Generando Token Unico
		$token = bin2hex(openssl_random_pseudo_bytes(20));
		$token = hash('ripemd160', $data['usuario']);

		//Guardando el Token en la BD.
		$token_bd = array('token' => $token);
		$update = $this->m_datos->guardar_token($login, $token_bd);

		$respuesta = array(
			'error' => FALSE,
			'token' => $token,
			'codigo' => $login->codigo
		);

		$this->response($respuesta);
	}
}
