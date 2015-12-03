<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portafolio extends CI_Controller {

    	public function __construct()
	{
	  parent::__construct();
	  $this->layout->setLayout('template'); // carga el template para todos las vistas
	  $this->load->model('portafolio_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->layout->setTitle('Dacomment:Portafolio'); // edita el título por defecto
	}

	public function index()
	{
    $usuario = $this->session->userdata('usuario');
    if (!$usuario) {
      $this->session->set_flashdata("ControllerMessage","Inicia sesión para ver tus portafolios!");
      redirect(base_url(),301);
	  }
	  $portafolios = $this->portafolio_model->obtenerMisPortafolios(array("PRO_ESTADO"=>true,"USU_ID"=>$usuario->USU_ID));
	  $this->layout->view('index',compact("portafolios"));
	}

  public function obtener_portafolio($id=null)
  {
    if (!$id) {
      show_404();
    }
    $portafolio = $this->portafolio_model->obtenerPortafolioPorId($id);
    if(!$portafolio){
      show_404();
    }
      $permisos = $this->portafolio_model->obtenerPermisosPortafolio($id);
      $documentos = $this->portafolio_model->obtenerDocumentosPortafolio($id);
      $this->layout->view('obtener_portafolio',compact('portafolio','permisos','documentos'));
  }

	public function crear_portafolio()
	{
    $usuario = $this->session->userdata('usuario');
    if (!$usuario) {
      $this->session->set_flashdata("ControllerMessage","Inicia sesión para crear un portafolio!");
      redirect(base_url()."portafolio",301);
	  }
		$this->layout->view('crear_portafolio');
		// Pregunta si esta insertando datos por post desde un formulario
		if ($this->input->post()) {
			// Genera el array con los datos a insertar en la base
			$data = array("PRO_NOMBRE"=>$this->input->post("nomportafolio",true),"USU_ID"=>$usuario->USU_ID);
			// Llama al metodo que esta en el modelo y le pasa el array, lo que retorna lo guarda en variable
			$insertar = $this->portafolio_model->insertarPortafolio($data);
				if ($insertar) {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Se ha creado el portafolio");
					redirect(base_url()."portafolio",301);
				} else {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Error creando el portafolio");
					redirect(base_url()."portafolio/crear_portafolio",301);
				}
		}

	}

	public function editar_portafolio($id=null)
	{
	  if (!$id) {
	  	show_404();
	  }
	  $datos = $this->portafolio_model->obtenerPortafolioPorId($id);
	  if(sizeof($datos)==0){
	  	show_404();
	  }
	  		$this->layout->view('editar_portafolio',compact('id','datos'));

	  		if ($this->input->post())
	  		{
	  		// Genera el array con los datos a insertar en la base
			$data = array("PRO_NOMBRE"=>$this->input->post("nomportafolio",true));
			// Llama al metodo que esta en el modelo y le pasa el array, lo que retorna lo guarda en variable
			$actualiza = $this->portafolio_model->modificarPortafolio($data,$id);
				if ($actualiza) {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Se ha actualizado el portafolio");
					redirect(base_url()."portafolio",301);
				} else {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Error actualizando el portafolio");
					redirect(base_url()."portafolio/editar_portafolio/".$id,301);
				}

	  		}
	}

	public function eliminar_portafolio($id=null)
	{
		if (!$id) {
	  		show_404();
	  	}
	  	$data = array("PRO_ESTADO"=> false);
	  	$deshabilita = $this->portafolio_model->modificarPortafolio($data,$id);
	  	if ($deshabilita) {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Se ha eliminado el portafolio");
					redirect(base_url()."portafolio",301);
				} else {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Error Eliminando el portafolio");
					redirect(base_url()."portafolio",301);
				}

	}
}
