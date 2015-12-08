<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller {

  public function __construct()
	{
	  parent::__construct();
	  $this->layout->setLayout('template'); // carga el template para todos las vistas
    $this->load->model('version_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('documento_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->layout->setTitle('Dacomment:Portafolio'); // edita el título por defecto
	}

	public function index()
	{
    $usuario = $this->session->userdata('usuario');
    
    if (!$usuario) {
      $this->session->set_flashdata("ControllerMessage","Inicia sesión para ver tus Documentos!");
      redirect(base_url(),301);
	  }
	  $this->layout->view('index',compact("portafolios"));
	}

  public function subir_documento($id_port=null,$id_doc=null)
  {
    if (!$id_port) {
        show_404();
      }

    $this->session->set_userdata("documento", $id_port);
    $this->layout->view('subir_documento', compact('id_port','id_doc'));

  }

  public function do_upload()
  {
    $id = $this->session->userdata('documento');
    $this->session->set_userdata("portafolio", null);

    $usuario = $this->session->userdata('usuario');
    $nombreDocumento = $this->input->post("nombreDocumento",true);
    $descripcionDocumento = $this->input->post("descripcionDocumento",true);
    $id_doc = $this->input->post("id_doc",true);

    if (!$id || !$nombreDocumento || !$usuario) 
    {
        show_404();
    }

    $carpetaPortafolio = './uploads/'.$id;
    $carpetaDocumento = $carpetaPortafolio.'/'.$nombreDocumento;

    if(!is_dir($carpetaPortafolio)) mkdir($carpetaPortafolio,0777);
    if(!is_dir($carpetaDocumento)) mkdir($carpetaDocumento,0777);

      $config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|txt';
      $config['upload_path'] = $carpetaDocumento;
      $config['max_size'] = '10000';
      $this->load->library('upload', $config);
    if ($this->upload->do_upload()) 
    {
      if($id_doc=="")
      {
         $data = array("PRO_ID"=>$id,"DOC_NOMBRE"=>$nombreDocumento, "DOC_FECHA"=>date("Y-m-d H:i:s"), "DOC_ESTADO"=>1, "ID_USUARIO"=>$usuario->USU_ID, "DOC_DESCRIPCION"=>$descripcionDocumento);
         $this->documento_model->insertarDocumento($data);

         $id_doc = $this->documento_model->obtenerIdDocumento($data);
         $dataversion = array("DOC_ID"=>$id_doc->DOC_ID,"VER_NUMERO"=>"1", "VER_FECHA"=>date("Y-m-d H:i:s"),"ID_USUARIO"=>$usuario->USU_ID, "VER_COMENTARIO"=>$descripcionDocumento);
         $this->version_model->insertarVersion($dataversion);
         $this->session->set_flashdata("ControllerMessage","Se ha subido un nuevo documento!");
            redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
      }else{
         $ult_version = $this->version_model->obtenerUltimaVersion($id_doc);
         $version = $ult_version->VER_NUMERO+1;
         $dataversion = array("DOC_ID"=>$id_doc,"VER_NUMERO"=>$version, "VER_FECHA"=>date("Y-m-d H:i:s"),"ID_USUARIO"=>$usuario->USU_ID, "VER_COMENTARIO"=>$descripcionDocumento);
         $this->version_model->insertarVersion($dataversion);
         $this->session->set_flashdata("ControllerMessage","Se ha Actualizado una nueva Version!");
            redirect(base_url()."portafolio/obtener_portafolio/".$id."/".$id_doc,301);
      }

    } else {
      $this->session->set_flashdata("ControllerMessage","Ha habido un error subiendo el nuevo documento! ".$this->upload->display_errors());
          redirect(base_url()."portafolio/obtener_portafolio/".$id,301);
    }

  }

  public function actualizar_version($id=null)
  {
    if (!$id) {
        show_404();
      }

    $this->session->set_userdata("documento", $id);
    $this->layout->view('subir_documento', compact('id'));

  }

  public function historia_documento($id_doc=null,$id_port=null)
  {
    if (!$id_doc || !$id_port) {
        show_404();
      }

    // $this->session->set_userdata("documento", $id);
    $versiones = $this->version_model->obtenerVersiones($id_doc);
    $this->layout->view('ver_documento', compact('id_doc','id_port','versiones'));

  }  

}