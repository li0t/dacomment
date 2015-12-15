<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller {

  public function __construct()
	{
	  parent::__construct();
	  $this->layout->setLayout('template'); // carga el template para todos las vistas
    $this->load->model('version_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('documento_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('portafolio_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('usuario_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->load->model('permiso_model'); // Indica que todos los metodos pueden llamar a este modelo
    $this->layout->setTitle('Dacomment:Portafolio'); // edita el título por defecto
	}

	public function index()
	{

    if (!$this->session->userdata('usuario')) {
      $this->session->set_flashdata("ControllerMessage","Inicia sesión para ver tus Documentos!");
      redirect(base_url(),301);
	  }
	  $this->layout->view('index');
	}

  public function subir_documento($id_port=null)
  {

    if (!$id_port) show_404();
    $this->layout->view('subir_documento', compact('id_port'));

  }

  public function do_upload()
  {

    $usuario = $this->session->userdata('usuario');

    $descripcionDocumento = $this->input->post("descripcionDocumento",true);
    $nombreDocumento = $this->input->post("nombreDocumento",true);
    $id_port =  $this->input->post("id_port",true);
    $id_doc = $this->input->post("id_doc",true);

    if (!$id_port || !$nombreDocumento || !$usuario || !$descripcionDocumento) {

      $this->session->set_flashdata("ControllerMessage","Hay un error en los parámetros!");
      redirect(base_url()."portafolio/obtener_portafolio/".$id_port,301);

    } else {

      $carpetaPortafolio = './uploads/'.$id_port;
      $carpetaDocumento = $carpetaPortafolio.'/'.$nombreDocumento;

      if (!is_dir($carpetaPortafolio)) mkdir($carpetaPortafolio,0777);
      if (!is_dir($carpetaDocumento)) mkdir($carpetaDocumento,0777);

      $fecha = date("Y-m-d H:i:s");

      $config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|txt';
      $config['upload_path'] = $carpetaDocumento;
      $config['file_name'] = $fecha; // El nombre del archivo corresponde a la fecha en la que fue subido.
      $config['max_size'] = '10000';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload())
      {
        if ($id_doc == "")
        {
          $data = array("PRO_ID"=>$id_port,"DOC_NOMBRE"=>$nombreDocumento, "DOC_FECHA"=>$fecha, "DOC_ESTADO"=>1, "ID_USUARIO"=>$usuario->USU_ID, "DOC_DESCRIPCION"=>$descripcionDocumento);
          $this->documento_model->insertarDocumento($data);

          $id_doc = $this->documento_model->obtenerIdDocumento($data);
          $dataversion = array("DOC_ID"=>$id_doc->DOC_ID,"VER_NUMERO"=>"1", "VER_FECHA"=>date("Y-m-d H:i:s"),"ID_USUARIO"=>$usuario->USU_ID, "VER_COMENTARIO"=>$descripcionDocumento);
          $this->version_model->insertarVersion($dataversion);
          $this->session->set_flashdata("ControllerMessage","Se ha subido un nuevo documento!");
          redirect(base_url()."portafolio/obtener_portafolio/".$id_port,301);
        } else {
          $ult_version = $this->version_model->obtenerUltimaVersion($id_doc);
          $version = $ult_version->VER_NUMERO+1;
          $dataversion = array("DOC_ID"=>$id_doc,"VER_NUMERO"=>$version, "VER_FECHA"=>date("Y-m-d H:i:s"),"ID_USUARIO"=>$usuario->USU_ID, "VER_COMENTARIO"=>$descripcionDocumento);
          $this->version_model->insertarVersion($dataversion);
          $this->session->set_flashdata("ControllerMessage","Se ha Actualizado una nueva Version!");
          redirect(base_url()."documento/historia_documento/".$id_doc."/".$id_port,301);
        }

      } else {
        $this->session->set_flashdata("ControllerMessage","Ha habido un error subiendo el nuevo documento! ".$this->upload->display_errors());
        redirect(base_url()."portafolio/obtener_portafolio/".$id_port,301);
      }
    }
  }

  public function versionar_documento($id_port=null,$id_doc=null)
  {

    if (!$id_port || !$id_doc)  show_404();

    $doc = $this->documento_model->obtenerDocumento(array("DOC_ID"=>$id_doc));

    if (!$doc) show_404();

    $this->layout->view('versionar_documento', compact('id_port','doc'));

  }

  public function historia_documento($id_doc=null,$id_port=null)
  {
    $usuario = $this->session->userdata('usuario');

    if (!$usuario) {
      $this->session->set_flashdata("ControllerMessage","Inicia sesión antes de ver tus documentos!");
      redirect(base_url(),301);
    }

    if (!$id_doc || !$id_port)  show_404();

    $versiones = $this->version_model->obtenerVersiones($id_doc);

    if(count($versiones) < 1){
      $this->session->set_flashdata("ControllerMessage","El documento no ha sido encontrado!");
      return redirect(base_url()."portafolio/obtener_portafolio/".$id_port,301);
    }

    $esCreadorDocumento = ($versiones[0]->ID_USUARIO === $usuario->USU_ID);
    $esCreadorPortafolio = (!$esCreadorDocumento) && $this->portafolio_model->esCreadorPortafolio(array("USU_ID"=>$usuario->USU_ID, "PRO_ID"=>$id_port));
    $tienePermisos = (!$esCreadorDocumento) ? $this->permiso_model->tienePermisosDocumento(array("USU_ID"=>$usuario->USU_ID, "DOC_ID"=>$id_doc)) : false;

    if (!$esCreadorPortafolio && !$esCreadorDocumento && !$tienePermisos) {
      $this->session->set_flashdata("ControllerMessage","No tienes permiso para ver este documento!");
      return redirect(base_url()."portafolio/obtener_portafolio/".$id_port,301);
    }

    $permisos = $this->permiso_model->obtenerPermisoDocumentos($id_doc);
    $this->layout->view('ver_documento', compact('id_doc','id_port','versiones','permisos', 'esCreadorPortafolio', 'esCreadorDocumento', 'tienePermisos'));

  }

  public function darpermiso_documento($id_port=null,$id_doc=null)
  {
    $usuario = $this->session->userdata('usuario');
    if (!$usuario)
    {
      $this->session->set_flashdata("ControllerMessage","Inicia para dar permisos a un documento!");
      redirect(base_url()."documento",301);
    }
    if (!$id_doc || !$id_port)
    {
      show_404();
    }

    $id_usu = $usuario->USU_ID;
    $usuariosp = $this->usuario_model->getUsuarioPermisoDoc($id_usu,$id_doc,$id_port);
    $permisos = $this->permiso_model->obtenerPermisos();
    $this->layout->view('darpermiso_documento', compact('id_usu','id_doc','id_port','usuariosp','permisos'));


    if ($this->input->post())
    {
      // Genera el array con los datos a insertar en la base
      $id_usu = $this->input->post("userper",true);
      $id_doc = $this->input->post("id_doc",true);
      $id_por = $this->input->post("id_port",true);
      $id_per = $this->input->post("permiso",true);

      $data = array("USU_ID"=>$id_usu,"DOC_ID"=>$id_doc,"PER_ID"=>$id_per);
      // Llama al metodo que esta en el modelo y le pasa el array, lo que retorna lo guarda en variable
      $insertar = $this->permiso_model->entregarPermisoDocumento($data);
        if ($insertar) {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Se han otorgado permisos para el portafolio!");
          redirect(base_url()."documento/historia_documento/".$id_doc."/".$id_por,301);
        }
        else
        {
          // Mensaje que se muestra 1 sola vez si es que esta correcto el insert y redirecciona
          $this->session->set_flashdata("ControllerMessage","Error otorgando permisos al portafolio!");
          redirect(base_url()."documento/darpermiso_documento/".$id_por."/".$id_doc,301);
        }
    }
  }

  public function quitarpermiso_documento($id_doc=null,$id_usu=null,$id_per=null,$id_port)
  {
    if (!$id_doc || !$id_usu || !$id_per || !$id_port)  show_404();


    $permisos = $this->permiso_model->eliminarPermisoDocumentos($id_doc,$id_usu,$id_per);
    redirect(base_url()."documento/historia_documento/".$id_doc."/".$id_port,301);
  }

  public function descargar_version($id_doc=null, $id_ver=null)
  {

    if (!$id_doc || !$id_ver)  show_404();

    $doc = $this->documento_model->obtenerDocumento(array("DOC_ID"=>$id_doc));
    $ver = $this->documento_model->obtenerVersion(array("VER_ID"=>$id_ver));
    $id_port = $doc->PRO_ID;

    if (!$id_doc || !$id_ver)  {
      $this->session->set_flashdata("ControllerMessage","Ha habido un error de parametros!");
      $this->layout->view('ver_documento', compact('id_doc','id_port','versiones'));
    }

    $versiones = $this->version_model->obtenerVersiones($id_doc);

    $fecha = str_replace(' ', '_', $ver->VER_FECHA);
    $path ="./uploads/$doc->PRO_ID/$doc->DOC_NOMBRE/$fecha";
    $files = glob($path."*");

    if (count($files) < 1) {
      $this->session->set_flashdata("ControllerMessage","Ha habido un error descargando el documento!");
      $this->layout->view('ver_documento', compact('id_doc','id_port','versiones', '0'));

    } else {

      $ext = pathinfo($files[0])['extension'];

      $this->load->helper('download');
      $data = file_get_contents($path.".".$ext);
      $name = $doc->DOC_NOMBRE."V".$ver->VER_NUMERO.".".$ext;

      force_download($name, $data);

      $this->layout->view('ver_documento', compact('id_doc','id_port','versiones'));
    }
  }

}
