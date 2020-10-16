<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . '/libraries/REST_Controller.php');
use Restserver\libraries\REST_Controller;

class Prueba extends REST_Controller {

	public function __construct() {
		
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_datos',"",true);
	}

	
	public function index()
	{
		$this->load->view('welcome_message');
	} 

	public function obtener_arreglo_get( $index = 0 ) {

		$consulta = $this->m_datos->obt_usuarios();
		$this->response();

		if( $index > 2){
			$respuesta = array('error' => TRUE, 'mensaje' => 'No existe' );

			$this->response( $respuesta, REST_Controller::HTTP_BAD_REQUEST );
		}
		else{

			$arreglo = array('Manzana', 'Pera', 'Piña' );
			$respuesta = array('error' => FALSE, 'fruta' => $arreglo[$index]);

			$this->response( $consulta );


		}
		
		
		
	}
}
