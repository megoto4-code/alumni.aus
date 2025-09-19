<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class licence extends CI_Controller {

    public function __construct() {
        parent::__construct();   
        session_start();
    }

    function index() {
        $this->data = $this->main->get_site_info();
        if ($this->data['site_licence'] == md5($this->alumnilib->get_serial_key())) {
            exit('This product is licenced');
        }
        $this->form_validation->set_rules('owner', 'Ownerof/Organization', 'required');
        $this->form_validation->set_rules('serial_key', 'Serial key', 'required|callback__is_valid_serial_key');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $data = $this->main->get_site_info();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('licence', $data);
        } else {
            $this->main->register_licence();
            $_SESSION['msg2'] = 'This Product is licenced';
            redirect();
        }
    }

    function _is_valid_serial_key($str) {

        if ($str != $this->alumnilib->get_serial_key()) {
            $this->form_validation->set_message('_is_valid_serial_key', 'Sorry, the serial key is not valid');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    function kill() {
        $this->form_validation->set_rules('owner', 'Ownerof/Organization', 'required');
        $this->form_validation->set_rules('serial_key', 'Serial key', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $data = $this->main->get_site_info();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('licence', $data);
        } else {
            $this->main->register_licence();
            redirect();
        }
    }
    
    function clear() {
        $this->main->clear_licence();
        $_SESSION['msg2'] = 'Licence is cleared';
        redirect();
    }

}
