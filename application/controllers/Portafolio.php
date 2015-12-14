<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portafolio extends CI_Controller {

  public function __construct()
	{
	  parent::__construct();
	  $this->layout->setLayout('template'); // carga el template para todos las vistas
	  $this->load->model('portafolio_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('permiso_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('documento_model'); // Indica que todos los metodos pueden llamar a este modelo
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
      $documentos = $this->documento_model->obtenerDocumentosPortafolio($id);
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

  public function entregar_nuevo_permiso($id=null)
  {

    if (!$id) {
      show_404();
    }
    $usuario = $this->session->userdata('usuario');
    if (!$usuario) 
    {
      $this->session->set_flashdata("ControllerMessage","Inicia agregar permisos a un portafolio!");
      redirect(base_url()."portafolio",301);
    }

    $usuarios = $this->permiso_model->obtenerPermisos();
    $permisos = $this->permiso_model->obtenerPermisos();
    $this->layout->view('entregar_nuevo_permiso',compact('id','permisos'));
    // Pregunta si esta insertando datos por post desde un formulario
    if ($this->input->post()) {
      // Genera el array con los datos a insertar en la base
      $data = array("USU_ID"=>$this->input->post("usuarioid",true),"PER_ID"=>$this->input->post("permisoid",true),"PRO_ID"=>$id);
      // Llama al metodo que esta en el modelo y le pasa el array, lo que retorna lo guarda en variable
      $insertar = $this->portafolio_model->entregarPermisosPortafolio($data);
        if ($insertar) {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Se han otorgado permisos para el portafolio!");
          redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
        } else {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Error otorgando permisos al portafolio!");
          redirect(base_url()."portafolio/nuevo_permiso_portafolio/".$id,301);
        }
    }
  }


  public function editar_permiso_usuario($id=null, $usuario=null)
  {
    if (!$id || !$usuario) {
      show_404();
    }
    if (!$this->session->userdata('usuario')) {
      $this->session->set_flashdata("ControllerMessage","Inicia agregar permisos a un portafolio!");
      redirect(base_url()."portafolio",301);
    }
    $permisos = $this->permiso_model->obtenerPermisos();
    $this->layout->view('editar_permiso_usuario',compact('id','usuario','permisos'));
    // Pregunta si esta insertando datos por post desde un formulario
    if ($this->input->post()) {
      // Genera el array con los datos a insertar en la base
      $data = array("PRO_ID"=>$id, "USU_ID"=>$usuario,"PER_ID"=>$this->input->post("permisoid",true));
      // Llama al metodo que esta en el modelo y le pasa el array, lo que retorna lo guarda en variable
      $actualizar = $this->portafolio_model->editarPermisosPortafolio($data);
        if ($actualizar) {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Se han modificado los permisos del portafolio!");
          redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
        } else {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Error modificando los permisos al portafolio!");
          redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
        }
    }
  }

  public function eliminar_permiso_usuario($id=null, $usuario=null)
	{
		if (!$id || !$usuario) {
	  		show_404();
	  	}
	  	$elimina = $this->portafolio_model->eliminarPermisoUsuario($id, $usuario);
	  	if ($elimina) {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Se ha removido el permiso del portafolio!");
					redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
				} else {
					// Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
					$this->session->set_flashdata("ControllerMessage","Error removiendo el permiso del portafolio!");
					redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
				}

	}
}
