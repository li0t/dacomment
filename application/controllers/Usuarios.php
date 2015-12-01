<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    	public function __construct()
	{
	  parent::__construct();
	  $this->layout->setLayout('template'); // carga el template para todos las vistas
	  $this->load->model('usuario_model'); // Indica que todos los metodos pueden llamar a este modelo
	  
	}

	public function index()
	{
	  $this->layout->view('index');
	}
	
	public function listar_usuarios()
	{
	  $usuarios = $this->usuario_model->getTodosUsuarios();
	  $this->layout->view('listar_usuarios',compact("usuarios"));
	}
	
	public function editar_usuario()
	{
	  $usuarios = $this->usuario_model->getTodosUsuarios();
	  $this->layout->view('editar_usuario',compact("usuarios"));
	}
	
	public function eliminar_usuario()
	{
	  $usuarios = $this->usuario_model->getTodosUsuarios();
	  $this->layout->view('eliminar_usuario',compact("usuarios"));
	}
}
