<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participants_Music extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("Music_model");
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data["musics"] = $this->Music_model->getAll(); 
		$this->load->view('/Admin/templates/start');
		$this->load->view('/Admin/templates/header');
		$this->load->view('/Admin/templates/sidebar');
		$this->load->view('/Admin/participants_music/index',$data);
		$this->load->view('/Admin/templates/footer');
		$this->load->view('/Admin/participants_music/tamplatejs');
		$this->load->view('/Admin/templates/end');
	}
}