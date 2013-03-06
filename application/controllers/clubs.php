<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Clubs extends CI_Controller {
            
		function index()
		{
			$this->load->view('header');
			$this->load->view('clubs/clubs');
			$this->load->view('footer');
		}		
                
		function club() 
		{
			$this->load->view('header');
			$this->load->view('club/club');
			$this->load->view('footer');
		}
	}
?>
