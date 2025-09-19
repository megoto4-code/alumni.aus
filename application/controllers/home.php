<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->admin_logged_in = false;
        if (isset($_SESSION['admin'])) {
            if ($_SESSION['admin'] == 'admin') {
                $this->admin_logged_in = TRUE;
            }
        }
    }

    public function index() {
        $this->data['title'] = 'home';
        $this->form_validation->set_rules('username', 'Username', 'required|callback__username_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback__password_check');
        $this->form_validation->set_message('required', '%s is empty');
        $this->form_validation->set_message('_username_check', 'No such username');
        $this->form_validation->set_message('_password_check', 'Incorrect password');
        $config['base_url'] = base_url() . 'home/index';
        $config['total_rows'] = $this->db->count_all('news');
        $config['per_page'] = 4;
        $config['full_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->data['paginator'] = $this->pagination->create_links();
        $this->data['news'] = $this->main->get_news($this->admin_logged_in, $config['per_page'], $this->uri->segment(3));
        if ($this->form_validation->run() == FALSE) {
            $this->_render('home', $this->data);
        } else {
            $_SESSION['admin'] = 'admin';
            redirect('admin');
        }
    }

    function pages($name = null) {
        if ($name == null) {
            redirect();
        }
        $this->data['title'] = humanize($name);
        $this->data['page_title'] = $this->main->get_table_row_info('pages', 'name', 'title', $name);
        $this->data['page_content'] = $this->main->get_table_row_info('pages', 'name', 'content', $name);
        $this->_render('page', $this->data);
    }

    function contact() {
        $this->data['title'] = 'contact us';
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_message('required', '%s box is empty');
        if ($this->form_validation->run() == false) {
            $this->_render('contact', $this->data);
        } else {
            $this->main->insert_feedback();
            $_SESSION['msg3'] = 'Thank you for your feedback.';
            redirect('home/contact');
        }
    }

    function register() {
        $this->data['title'] = 'register';
        $this->form_validation->set_rules('fname', 'First name', 'required|alpha');
        $this->form_validation->set_rules('mname', 'Middle name', 'alpha');
        $this->form_validation->set_rules('lname', 'Last name', 'required|alpha');
        $this->form_validation->set_rules('sex', 'Sex', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('campus', 'Campus', 'required');
        $this->form_validation->set_rules('school', 'School', 'required');
        $this->form_validation->set_rules('department', 'Deapartment', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('session_from', '\'Session from\'', 'required|is_natural');
        $this->form_validation->set_rules('session_to', '\'Session to\'', 'required|is_natural');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[registered.email]');
        $this->form_validation->set_rules('mobile', 'Mobile no', 'is_natural|is_unique[registered.mobile]');

        $this->form_validation->set_message('required', '%s box is empty');
        $this->form_validation->set_message('alpha', 'In %s box, only alphabetic characters are allowed');
        $this->form_validation->set_message('is_natural', '%s box should have to be a valid year');
        $this->form_validation->set_message('is_unique', 'The %s is already used by someone');

        if ($this->form_validation->run() == false) {
            $this->_render('register', $this->data);
        } else {
            $this->main->register_alumni('registered');
            $_SESSION['msg1'] = 'You are successfully registered.';
            redirect('home/register');
        }
    }

    function registered_alumni() {
        $this->data['title'] = 'registered alumni';
        $config['base_url'] = base_url() . 'home/registered_alumni';
        $config['total_rows'] = $this->db->count_all('registered');
        $config['per_page'] = 100;
        $config['full_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->data['paginator'] = $this->pagination->create_links();
        $columns = array(
            0 => array(
                'id' => 'fname',
                'title' => 'First name'
            ),
            1 => array(
                'id' => 'mname',
                'title' => 'Middle name'
            ),
            2 => array(
                'id' => 'lname',
                'title' => 'Last name'
            ),
            3 => array(
                'id' => 'sex',
                'title' => 'Sex'
            ),
            4 => array(
                'id' => 'session_to',
                'title' => 'Year'
            ),
            5 => array(
                'id' => 'email',
                'title' => 'Email'
            ),
            6 => array(
                'id' => 'mobile',
                'title' => 'Mobile'
            ),
        );
        $this->data['alumni_table'] = $this->main->_table_maker('registered', $columns, TRUE, $config['per_page'], $this->uri->segment(3), false, $this->admin_logged_in, null, 'admin/delete_registered_alumni/', FALSE, null,'home/registered_alumni_details/');
        $this->_render('alumni', $this->data);
    }

    function search() {
        $this->data['title'] = 'alumni search';
        $this->_render('search', $this->data);
    }

    function alumni($adv = null) {
        $this->data['title'] = 'alumni search';
        $config['base_url'] = base_url() . 'home/alumni';
        $config['total_rows'] = $this->db->count_all('alumni');
        $config['per_page'] = 50;
        $config['full_tag_open'] = '<div class="pagination pull-right"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->data['paginator'] = $this->pagination->create_links();
        $columns = array(
            0 => array(
                'id' => 'fname',
                'title' => 'First name'
            ),
            1 => array(
                'id' => 'mname',
                'title' => 'Middle name'
            ),
            2 => array(
                'id' => 'lname',
                'title' => 'Last name'
            ),
            3 => array(
                'id' => 'sex',
                'title' => 'Sex'
            ),
            4 => array(
                'id' => 'session_to',
                'title' => 'Year'
            ),
            5 => array(
                'id' => 'email',
                'title' => 'Email'
            ),
            6 => array(
                'id' => 'mobile',
                'title' => 'Mobile'
            ),
        );
        $get = $this->input->post('search');
        if ($get != null) {
            $cols = array(
                0 => array(
                    'col' => 'fname',
                    'value' => $this->input->post('fname'),
                ),
                1 => array(
                    'col' => 'mname',
                    'value' => $this->input->post('mname'),
                ),
                2 => array(
                    'col' => 'lname',
                    'value' => $this->input->post('lname'),
                ),
                3 => array(
                    'col' => 'organization',
                    'value' => $this->input->post('organization'),
                ),
                4 => array(
                    'col' => 'designation',
                    'value' => $this->input->post('designation'),
                ),
                5 => array(
                    'col' => 'email',
                    'value' => $this->input->post('email'),
                ),
                6 => array(
                    'col' => 'school',
                    'value' => $this->input->post('school'),
                ),
                7 => array(
                    'col' => 'department',
                    'value' => $this->input->post('department'),
                ),
                8 => array(
                    'col' => 'course',
                    'value' => $this->input->post('course'),
                ),
                9 => array(
                    'col' => 'session_from',
                    'value' => $this->input->post('session_from'),
                ),
                10 => array(
                    'col' => 'session_to',
                    'value' => $this->input->post('session_to'),
                ),
                11 => array(
                    'col' => 'mobile',
                    'value' => $this->input->post('mobile'),
                ),
            );

            for ($i = 0; $i <= 11; $i++) {
                if (trim($cols[$i]['value']) == null) {
                    unset($cols[$i]);
                }
            }
            //print_r($cols);
            $this->data['alumni_table'] = $this->main->_table_maker('alumni', $columns, TRUE, $config['per_page'], $this->uri->segment(3), false, $this->admin_logged_in, null, 'admin/delete_alumni/', FALSE, $cols);
        } else {
            $this->data['alumni_table'] = $this->main->_table_maker('alumni', $columns, TRUE, $config['per_page'], $this->uri->segment(3), false, $this->admin_logged_in);
        }
        $this->_render('alumni', $this->data);
    }

    function alumni_details($id) {
        if (!isset($id)) {
            redirect('home/search');
        }
        $this->data['title'] = 'Alumni id:' . $id;
        $this->data['fname'] = $this->main->get_table_row_info('alumni', 'id', 'fname', $id);
        $this->data['mname'] = $this->main->get_table_row_info('alumni', 'id', 'mname', $id);
        $this->data['lname'] = $this->main->get_table_row_info('alumni', 'id', 'lname', $id);
        $this->data['sex'] = $this->main->get_table_row_info('alumni', 'id', 'sex', $id);
        $this->data['address'] = $this->main->get_table_row_info('alumni', 'id', 'address', $id);
        $this->data['organization'] = $this->main->get_table_row_info('alumni', 'id', 'organization', $id);
        $this->data['campus'] = $this->main->get_table_row_info('campuses', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'campus', $id));
        $this->data['school'] = $this->main->get_table_row_info('schools', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'school', $id));
        $this->data['department'] = $this->main->get_table_row_info('departments', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'department', $id));
        $this->data['course'] = $this->main->get_table_row_info('courses', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'course', $id));
        $this->data['session_from'] = $this->main->get_table_row_info('alumni', 'id', 'session_from', $id);
        $this->data['session_to'] = $this->main->get_table_row_info('alumni', 'id', 'session_to', $id);
        $this->data['designation'] = $this->main->get_table_row_info('alumni', 'id', 'designation', $id);
        $this->data['email'] = $this->main->get_table_row_info('alumni', 'id', 'email', $id);
        $this->data['mobile'] = $this->main->get_table_row_info('alumni', 'id', 'mobile', $id);
        $this->data['notes'] = $this->main->get_table_row_info('alumni', 'id', 'notes', $id);
        $this->_render('alumni_details', $this->data);
    }

    function registered_alumni_details($id) {
        if (!isset($id)) {
            redirect('home/registered_alumni');
        }
        $this->data['title'] = 'Alumni id:' . $id;
        $this->data['fname'] = $this->main->get_table_row_info('registered', 'id', 'fname', $id);
        $this->data['mname'] = $this->main->get_table_row_info('registered', 'id', 'mname', $id);
        $this->data['lname'] = $this->main->get_table_row_info('registered', 'id', 'lname', $id);
        $this->data['sex'] = $this->main->get_table_row_info('registered', 'id', 'sex', $id);
        $this->data['address'] = $this->main->get_table_row_info('registered', 'id', 'address', $id);
        $this->data['organization'] = $this->main->get_table_row_info('registered', 'id', 'organization', $id);
        $this->data['campus'] = $this->main->get_table_row_info('campuses', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'campus', $id));
        $this->data['school'] = $this->main->get_table_row_info('schools', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'school', $id));
        $this->data['department'] = $this->main->get_table_row_info('departments', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'department', $id));
        $this->data['course'] = $this->main->get_table_row_info('courses', 'id', 'name', $this->main->get_table_row_info('alumni', 'id', 'course', $id));
        $this->data['session_from'] = $this->main->get_table_row_info('registered', 'id', 'session_from', $id);
        $this->data['session_to'] = $this->main->get_table_row_info('registered', 'id', 'session_to', $id);
        $this->data['designation'] = $this->main->get_table_row_info('registered', 'id', 'designation', $id);
        $this->data['email'] = $this->main->get_table_row_info('registered', 'id', 'email', $id);
        $this->data['mobile'] = $this->main->get_table_row_info('registered', 'id', 'mobile', $id);
        $this->data['notes'] = 'NA';
        $this->_render('alumni_details', $this->data);
    }

}
