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

  public function obtener_usuario($id=null)
  {
    if (!$id) {
      show_404();
    }
    $usuario = $this->usuario_model->getUsuarioPorId($id);
    if(!$usuario){
      show_404();
    }
      $this->layout->view('obtener_usuario',compact('usuario'));
  }

  public function autenticar_usuario()
  {
    $this->layout->view('autenticar_usuario');
    // Pregunta si esta insertando datos por post desde un formulario
    if ($this->input->post()) {
      // Genera el array con los datos a insertar en la base
      $data = array("USU_RUT"=>$this->input->post("rutusuario",true), "USU_PASSWORD"=>$this->input->post("passusuario",true));

      // Llama al metodo que esta en el modelo y le pasa el array, lo que retorna lo guarda en variable
      $autenticado = $this->usuario_model->autenticarUsuario($data);
        if ($autenticado) {

          $this->session->set_userdata("usuario", $autenticado);

          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Bienvenido ".$autenticado->USU_NOMBRES);
          redirect(base_url(),301);
        } else {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","El rut o contraseña no son válidos!");
          redirect(base_url()."usuarios/autenticar_usuario",301);
        }
    }

  }

  public function cerrar_sesion($id=null)
  {
      $this->session->sess_destroy();
      redirect(base_url(),301);
  }
}
