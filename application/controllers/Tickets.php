<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . '/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Tickets extends REST_Controller {

	public function __construct() {

		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");

		
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_ticket',"",true);
		$this->load->model('m_datos',"",true);
	}

	/*public function index_get()
	{
		$tickets = $this->m_ticket->obt_tickets();

		$this->response( $tickets );
	}*/

	public function generar_ticket_post($token = "0", $id_usuario = "0")
	{

		$data = $this->post();

		if( $token == "0" || $id_usuario == "0"){
			$respuesta = array(
								'error' => TRUE,
								'mensaje' => 'Token y/o Usuario Invalido.'
							);
			$this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );
			return;
		}

		if ( !isset( $data['categoria'] ) || strlen( $data['categoria'] )== 0 ) {
				$respuesta = array(
								'error' => TRUE,
								'mensaje' => 'Falta la categoria.'
							);
			$this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );
			return;
		}

		// AQUI TODO ESTA BIEN

		$condiciones = array(
							'id' 	=> $id_usuario,
							'token' => $token 
							);
		$existe = $this->m_datos->validar_usr($condiciones);

		if( !$existe ) {
			$respuesta = array(
								'error' => TRUE,
								'mensaje' => 'Usuario y Token incorrectos'
							);
		}

	}
}