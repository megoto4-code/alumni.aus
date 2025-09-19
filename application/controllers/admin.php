<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        if (!isset($_SESSION['admin'])) {
            redirect();
        } elseif ($_SESSION['admin'] != 'admin') {
            redirect();
        }
    }

    function index($news_id = NULL) {
        $this->data['title'] = 'administrator home';
        $this->form_validation->set_rules('news_title', 'News title', 'required');
        $this->form_validation->set_rules('news_content', 'News content', 'required');
        $this->data['news_id'] = $news_id;
        if ($news_id != NULL) {
            $this->data['news_title'] = $this->main->get_news_row($news_id, 'title');
            $this->data['news_content'] = $this->main->get_news_row($news_id, 'content');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->_render('admin_home', $this->data);
        } else {
            if ($news_id != NULL) {
                $this->main->update_news_row($news_id);
                $_SESSION['msg3'] = 'News titled  "' . $this->main->get_news_row($news_id, 'title') . '" is successfully updated.';
                redirect('admin/index/' . $news_id);
            } else {
                $this->main->post_news();
                $_SESSION['msg3'] = 'News titled  "' . $this->input->post('news_title') . '" is successfully posted.';
                redirect('admin');
            }
        }
    }

    /*
      function alumni($id = null) {
      $this->data['title'] = 'alumni';
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('course', 'Course', 'required');
      $this->form_validation->set_rules('year', 'Year', 'required');
      $this->form_validation->set_rules('email', 'Email', 'valid_email');

      if ($this->form_validation->run() == FALSE) {
      $this->_render('alumni_admin', $this->data);
      } else {
      $name = $this->main->add_alumni_record();
      $_SESSION['msg3'] = 'Person named "' . $name . '" is added to alumni database successfully';
      redirect('admin/alumni');
      }
      }
     */

    function alumni() {
        $this->data['title'] = 'alumni';
        $this->form_validation->set_rules('fname', 'First name', 'required|alpha');
        $this->form_validation->set_rules('mname', 'Middle name', 'alpha');
        $this->form_validation->set_rules('lname', 'Last name', 'required|alpha');
        $this->form_validation->set_rules('campus', 'Campus', 'required');
        $this->form_validation->set_rules('school', 'School', 'required');
        $this->form_validation->set_rules('department', 'Deapartment', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('mobile', 'Mobile no', 'is_natural');
        $this->form_validation->set_message('required', '%s box is empty');
        $this->form_validation->set_message('alpha', 'In %s box, only alphabetic characters are allowed');

        if ($this->form_validation->run() == false) {
            $this->_render('alumni_form', $this->data);
        } else {
            $this->main->register_alumni();
            $_SESSION['msg1'] = 'Alumni named "<b>' . $this->input->post('fname') . '</b>" is added in the database';
            redirect('admin/alumni');
        }
    }

    function alumni_all($order = 'id') {
        $this->data['title'] = 'alumni database';
        $this->data['record_table'] = $this->main->get_alumni_records(null, $order, $this->admin_logged_in);
        $this->_render('alumni_all', $this->data);
    }

    function delete_alumni($id = null) {
        if ($id != null) {
            $this->main->delete_row('alumni', 'id', $id);
        }
        $_SESSION['msg3'] = 'One alumni record is deleted';
        redirect('home/alumni');
    }

    function delete_registered_alumni($id = null) {
        if ($id != null) {
            $this->main->delete_row('registered', 'id', $id);
        }
        $_SESSION['msg3'] = 'One registered alumni record is deleted';
        redirect('home/registered_alumni');
    }

    function site_settings() {
        $this->data['title'] = 'site settings';
        $this->form_validation->set_rules('name', 'Site name', 'required');
        /* $this->form_validation->set_rules('slogun', 'Site slogun', 'required');
          $this->form_validation->set_rules('logo', 'Site logo', 'required');
          $this->form_validation->set_rules('logo_size', 'Site logo size', 'required');
          $this->form_validation->set_rules('name', 'Site name', 'required');
          $this->form_validation->set_rules('contact', 'Site contact address', 'required');
          $this->form_validation->set_rules('copyright', 'Site copyright text', 'required');
          $this->form_validation->set_rules('owner', 'Site owner name', 'required'); */
        $this->form_validation->set_message('required', '%s is empty');
        if ($this->form_validation->run() == FALSE) {
            $this->_render('site_settings', $this->data);
        } else {
            $this->main->set_site_info();
            $_SESSION['msg3'] = 'Information is updated.';
            redirect('admin/site_settings');
        }
    }

    function delete_news_item($id = null) {
        if ($id == NULL) {
            redirect();
        }
        $news = $this->main->delete_news_row($id);
        $_SESSION['msg2'] = 'News titled "' . $news . '" is deleted permanently';
        redirect();
    }

    function pages_menus($id = null) {
        $this->data['title'] = 'pages and menus';
        $this->data['pages_list'] = $this->main->get_pages_list();
        $this->form_validation->set_rules('name', 'Page name', 'required');
        $this->form_validation->set_rules('title', 'Page title', 'required');
        $this->form_validation->set_rules('content', 'Page content', 'required');
        $this->form_validation->set_message('required', '%s is empty');
        $this->data['edit_page'] = FALSE;
        if ($id != null) {
            $this->data['edit_page'] = $id;
            $this->data['edit_page_name'] = humanize($this->main->get_table_row_info('pages', 'id', 'name', $id));
            $this->data['edit_page_title'] = $this->main->get_table_row_info('pages', 'id', 'title', $id);
            $this->data['edit_page_content'] = $this->main->get_table_row_info('pages', 'id', 'content', $id);
        } else {
            $this->form_validation->set_rules('name', 'Page name', 'is_unique[pages.name]');
            $this->form_validation->set_message('is_unique', 'The page named %s is already created');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->_render('pages_menus', $this->data);
        } else {
            if ($id != null) {
                $this->main->update_page($id);
                $_SESSION['msg3'] = 'Page titled "' . $this->input->post('title') . '" is successfully updated';
                redirect('admin/pages_menus/' . $id);
            } else {
                $this->main->create_page();
                $_SESSION['msg3'] = 'Page titled "' . $this->input->post('title') . '" is created successfully';
                redirect('admin/pages_menus');
            }
        }
    }

    function carousel() {
        $this->data['title'] = 'carousel';
        $columns = array(
            0 => array(
                'id' => 'title',
                'title' => 'Title'
            ),
            1 => array(
                'id' => 'desc',
                'title' => 'Description'
            ),
            2 => array(
                'id' => 'url',
                'title' => 'Path'
            ),
        );
        $this->form_validation->set_rules('url', 'Path(url)', 'required');
        $this->data['carousel_table'] = $this->main->_table_maker('carousel', $columns, false, null, null, FALSE, true, null, 'admin/delete_carousel/');
        if ($this->form_validation->run() == FALSE) {
            $this->_render('carousel', $this->data);
        } else {
            $this->main->insert_carousel();
            $_SESSION['msg3'] = 'Image is added to the slidheshow successfully';
            redirect('admin/carousel');
        }
    }

    function delete_carousel($id = null) {
        if ($id != null) {
            $this->main->delete_row('carousel', 'id', $id);
        }
        redirect('admin/carousel');
    }

    function campuses() {
        $this->data['title'] = 'campuses';
        $columns = array(
            0 => array(
                'id' => 'name',
                'title' => 'Campus name'
            ),
            1 => array(
                'id' => 'established',
                'title' => 'Established'
            ),
        );
        $this->data['name'] = null;
        $this->data['established'] = null;
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->data['campuses_table'] = $this->main->_table_maker('campuses', $columns, false, null, null, FALSE, true, null, 'admin/delete_campus/');
        if ($this->form_validation->run() == FALSE) {
            $this->_render('campuses', $this->data);
        } else {
            $this->main->insert_campus();
            redirect('admin/campuses');
        }
    }

    function delete_campus($id = null) {
        if ($id != null) {
            if ($this->main->is_dependant($id, 'schools', 'campus')) {
                $_SESSION['msg3'] = 'This item cannot be deleted due to its dependency';
            } else {
                $this->main->delete_row('campuses', 'id', $id);
            }
        }
        redirect('admin/campuses');
    }

    function schools() {
        $this->data['title'] = 'schools';
        $columns = array(
            0 => array(
                'id' => 'name',
                'title' => 'School name'
            ),
            1 => array(
                'id' => 'established',
                'title' => 'Established'
            ),
        );
        $this->data['name'] = null;
        $this->data['established'] = null;
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('campus', 'Campus', 'required');
        $this->data['schools_table'] = $this->main->_table_maker('schools', $columns, false, null, null, FALSE, true, null, 'admin/delete_school/');
        if ($this->form_validation->run() == FALSE) {
            $this->_render('schools', $this->data);
        } else {
            $this->main->insert_school();
            redirect('admin/schools');
        }
    }

    function delete_school($id = null) {
        if ($id != null) {
            if ($this->main->is_dependant($id, 'departments', 'school')) {
                $_SESSION['msg3'] = 'This item cannot be deleted due to its dependency';
            } else {
                $this->main->delete_row('schools', 'id', $id);
            }
        }
        redirect('admin/schools');
    }

    function departments() {
        $this->data['title'] = 'departments';
        $columns = array(
            0 => array(
                'id' => 'name',
                'title' => 'Department name'
            ),
            1 => array(
                'id' => 'established',
                'title' => 'Established'
            ),
            2 => array(
                'id' => 'school',
                'title' => 'School',
                'mask' => TRUE,
                'from' => 'schools',
                'where' => 'id',
                'col' => 'name',
            ),
        );
        $this->data['name'] = null;
        $this->data['established'] = null;
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('school', 'school', 'required');
        $this->data['departments_table'] = $this->main->_table_maker('departments', $columns, false, null, null, FALSE, true, null, 'admin/delete_department/', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->_render('departments', $this->data);
        } else {
            $this->main->insert_department();
            redirect('admin/departments');
        }
    }

    function delete_department($id = null) {
        if ($id != null) {
            if ($this->main->is_dependant($id, 'alumni', 'department')) {
                $_SESSION['msg3'] = 'This item cannot be deleted due to its dependency';
            } else {
                $this->main->delete_row('departments', 'id', $id);
            }
        }
        redirect('admin/departments');
    }

    function courses() {
        $this->data['title'] = 'courses';
        $columns = array(
            0 => array(
                'id' => 'name',
                'title' => 'Course name'
            ),
            1 => array(
                'id' => 'duration',
                'title' => 'Duration'
            ),
        );
        $this->data['name'] = null;
        $this->data['established'] = null;
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->data['departments_table'] = $this->main->_table_maker('courses', $columns, false, null, null, FALSE, true, null, 'admin/delete_course/', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->_render('courses', $this->data);
        } else {
            $this->main->insert_course();
            redirect('admin/courses');
        }
    }

    function delete_course($id = null) {
        if ($id != null) {
            if ($this->main->is_dependant($id, 'alumni', 'course')) {
                $_SESSION['msg3'] = 'This item cannot be deleted due to its dependency';
            } else {
                $this->main->delete_row('courses', 'id', $id);
            }
        }
        redirect('admin/courses');
    }

    function delete_page($id = null) {
        if ($id != NULL) {
            $page_title = $this->main->delete_page($id);
        }
        $_SESSION['msg3'] = 'Page titled "' . $page_title . '" is deleted';
        redirect('admin/pages_menus');
    }

    function feedbacks() {
        $this->data['title'] = 'feedbacks';
        $config['base_url'] = base_url() . 'admin/feedbacks';
        $config['total_rows'] = $this->db->count_all('feedbacks');
        $config['per_page'] = 5;
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
        $this->data['feedbacks'] = $this->main->get_feedbacks($config['per_page'], $this->uri->segment(3));
        $this->_render('feedbacks', $this->data);
    }

    function delete_feedback($id) {
        if ($id == NULL) {
            redirect();
        }
        $feedback = $this->main->delete_feedback($id);
        $_SESSION['msg2'] = 'Feedback titled "' . $feedback . '" is deleted permanently';
        redirect('admin/feedbacks');
    }

    function account_settings() {
        $this->data['title'] = 'account settings';
        $this->form_validation->set_rules('previous_username', 'previous username', 'required|callback__username_check');
        $this->form_validation->set_rules('previous_password', 'previous password', 'required|callback__password_check');
        $this->form_validation->set_rules('current_username', 'current username', 'required|min_length[5]');
        $this->form_validation->set_rules('current_password', 'current password', 'required|min_length[6]');
        $this->form_validation->set_message('_username_check', 'Previous username is incorrect');
        $this->form_validation->set_message('_password_check', 'Previous password is incorrect');
        if ($this->form_validation->run() == FALSE) {
            $this->_render('account_settings', $this->data);
        } else {
            $this->main->update_admin();
            $_SESSION['msg2'] = 'Administrator username and password is successfully changed.';
            redirect('admin/account_settings');
        }
    }

    function logout() {
        unset($_SESSION['admin']);
        $_SESSION['msg2'] = 'You are successfully logged out.';
        redirect();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */