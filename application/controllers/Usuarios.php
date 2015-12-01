<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    	public function __construct()
	{
	  parent::__construct();
	  $this->layout->setLayout('template'); // carga el template para todos las vistas
	  $this->load->model('usuario_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->layout->setTitle('Dacomment:Usuarios'); // edita el título por defecto
	}

	public function index()
	{
    $usuarios = $this->usuario_model->getTodosUsuarios();
	  $this->layout->view('index',compact("usuarios"));;
	}

}
