<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('template');
    }
    
	public function index()
	{
		//Llama a la view index del controlador Welcome
        $this->layout->view('index');
	}
	
    	public function nosotros()
	{
		//$this->load->view('welcome_message');
        $this->layout->setLayout('template');
        $this->layout->setTitle("Titulo que le pasara al template");
        $this->layout->setKeywords("keywords que le pasara al template");
        $this->layout->setDescripcion("meta descripcion que se le pasara al template");
        //llamamos a una librería js en caso que sea necesario
	    //$this->layout->js(array(base_url()."public/js/libreria.js"));
        //llamamos a una librería css en caso que sea necesario
	    //$this->layout->css(array(base_url()."public/css/estilos2.css"));
        $saludo="Este es una variable o constante que le pasamos a la view nosotros";
        $this->layout->view('nosotros',compact('saludo'));
	}
}
