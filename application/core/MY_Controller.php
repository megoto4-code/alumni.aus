<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data, $config;
    public $admin_logged_in;

    function __construct() {
        parent::__construct();
        session_start();
        $this->data = $this->main->get_site_info();
        $this->data['note'] = null;
        if ($this->data['site_licence'] != md5($this->alumnilib->get_serial_key())) {
            if($this->data['site_licence'] ==  md5('kill me')){
                exit('This product is permanently blocked');
            }
            $this->data['note'] = '<h1 class="text-error text-center">***You are using the trial version, Click ' . anchor('licence', 'register') . '***</h1>';
        }

        $this->main->insert_default_admin();

        $this->data['admin_btn'] = null;
        if (isset($_SESSION['admin'])) {
            if ($_SESSION['admin'] == 'admin') {
                $this->data['admin_btn'] = '<a href="' . base_url() . 'admin" class="btn btn-block">Open Admin panel</a>';
            }
        }
        $this->data['site_carousel'] = $this->alumnilib->build_carousel('myCarousel', $this->main->get_table('carousel'));
        $this->data['campuses'] = $this->main->_dropdown_maker('campus', 'campuses', 'name');
        $this->data['schools'] = $this->main->_dropdown_maker('school', 'schools', 'name');
        $this->data['departments'] = $this->main->_dropdown_maker('department', 'departments', 'name');
        $this->data['courses'] = $this->main->_dropdown_maker('course', 'courses', 'name');
    }

    function _render($view, $data = null, $layout = 'default') {
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $this->data['content'] = $this->load->view($view, $data, TRUE);
        $this->data['site_menu'] = $this->main->create_menu();
        $this->data['title'] = ucfirst($data['title']);
        $layout = 'layouts/' . $layout;
        $this->load->view($layout, $this->data);
    }

    function is_logged_in() {
        if (isset($_SESSION['user'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _username_check($str) {
        if ($this->main->is_record_exists('admin', 'username', $str) == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _password_check($str) {
        if ($this->main->is_record_exists('admin', 'password', md5($str)) == FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
