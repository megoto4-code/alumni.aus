<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class main extends CI_Model {

    function get_campuses() {
        $res = null;
        $res.= '<ul class="nav nav-tabs nav-stacked">';
        foreach ($this->db->get('campuses')->result() as $row) {
            $res.= '<li><a href="' . base_url() . 'home/alumni_records/' . $row->id . '">' . $row->name . '</a></li>';
        }
        $res.= '</ul>';
        return $res;
    }

    function get_schools() {
        $res = null;
        $this->db->where('campus', $this->uri->segment(3));
        $res.= '<ul class="nav nav-tabs nav-stacked">';
        foreach ($this->db->get('schools')->result() as $row) {
            $res.= '<li><a href="' . base_url() . 'home/alumni_records/' . $this->uri->segment(3) . '/' . $row->id . '">' . $row->name . '</a></li>';
        }
        $res.= '</ul>';
        return $res;
    }

    function get_departments() {
        $res = null;
        $this->db->where('school', $this->uri->segment(4));
        $res.= '<ul class="nav nav-tabs nav-stacked">';
        foreach ($this->db->get('departments')->result() as $row) {
            $res.= '<li><a href="' . base_url() . 'home/alumni_records/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $row->id . '">' . $row->name . '</a></li>';
        }
        $res.= '</ul>';
        return $res;
    }

    function get_courses() {
        $res = null;
        //$this->db->where('department', $this->uri->segment(5));
        $res.= '<ul class="nav nav-tabs nav-stacked">';
        foreach ($this->db->get('courses')->result() as $row) {
            $res.= '<li><a href="' . base_url() . 'home/alumni_records/' . $row->id . '">' . $row->name . '</a></li>';
        }
        $res.= '</ul>';
        return $res;
    }

    function get_alumni_records($cols = null, $order = 'name', $del = false, $limit = null, $offset = null) {
        $res = null;
        if ($cols != null) {
            foreach ($cols as $col) {
                $this->db->where($col['col'], $col['value']);
            }
        }
        $res.= '<table class="table table-striped">';
        $res.= '<tr><th>Name</th>';
        $res.= '<th>Course Completed</th>';
        $res.= '<th>Year</th>';
        $res.= '<th>Present address</th>';
        $res.= '<th>Organization</th>';
        $res.= '<th>Designation</th>';
        $res.= '<th>Email</th>';
        if ($del == TRUE) {
            $res.= '<th></th>';
        }
        $res.= '</tr>';
        $this->db->order_by($order, "desc");
        foreach ($this->db->get('alumni_records', $limit, $offset)->result() as $row) {
            $res.= '<tr>';
            $res.= '<td>' . $row->name . '</td>';
            $res.= '<td>' . $this->get_table_row_info('courses', 'id', 'name', $row->course) . '</td>';
            $res.= '<td>' . $row->year . '</td>';
            $res.= '<td>' . $row->address . '</td>';
            $res.= '<td>' . $row->organization . '</td>';
            $res.= '<td>' . $row->designation . '</td>';
            $res.= '<td>' . $row->email . '</td>';
            if ($del == TRUE) {
                $res.= '<td><div class="btn-group btn-block">
                <a class="btn btn-mini btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
                   Delete
                   <span class="caret"></span>
                 </a>
             <ul class="dropdown-menu"><li><a href="' . base_url() . 'admin/delete_alumni_record/' . $row->id .
                        '">Confirm Delete</a></li></ul></div></td>';
            }
            $res.= '</tr>';
        }
        $res.= '</table>';
        return $res;
    }

    function add_alumni_record() {
        $data = array(
            'name' => $this->input->post('name'),
            'course' => $this->input->post('course'),
            'year' => $this->input->post('year'),
            'address' => $this->input->post('address'),
            'organization' => $this->input->post('organization'),
            'designation' => $this->input->post('designation'),
            'email' => $this->input->post('email'),
        );
        $this->db->insert('alumni_records', $data);
        return $this->input->post('name');
    }

    function insert_carousel() {
        $data = array(
            'title' => $this->input->post('title'),
            'desc' => $this->input->post('desc'),
            'url' => $this->input->post('url'),
        );
        $this->db->insert('carousel', $data);
    }

    function insert_campus() {
        $data = array(
            'name' => $this->input->post('name'),
            'established' => $this->input->post('established'),
        );
        $this->db->insert('campuses', $data);
    }

    function insert_school() {
        $data = array(
            'name' => $this->input->post('name'),
            'campus' => $this->input->post('campus'),
            'established' => $this->input->post('established'),
        );
        $this->db->insert('schools', $data);
    }

    function insert_department() {
        $data = array(
            'name' => $this->input->post('name'),
            'established' => $this->input->post('established'),
            'school' => $this->input->post('school'),
        );
        $this->db->insert('departments', $data);
    }

    function insert_course() {
        $data = array(
            'name' => $this->input->post('name'),
            'duration' => $this->input->post('duration'),
        );
        $this->db->insert('courses', $data);
    }

    function get_pages_list() {
        $cache = '<table class="table table-hover">';
        $cache = $cache
                . '<tr>
                        <th>Name</th>
                        <th>title</th>
                        <th>content</th>
                        <th></th><th></th>                    
                   </tr>';
        foreach ($this->db->get('pages')->result() as $row) {
            $cache = $cache . '<tr>';
            $cache = $cache . '<td><a href="' . base_url() . 'home/pages/' . $row->name . '" target="_blank">' . humanize($row->name) . '</a></td>';
            $cache = $cache . '<td>' . word_limiter($row->title, 2) . '</td>';
            $cache = $cache . '<td>' . word_limiter($row->content, 8) . '</td>';
            $cache = $cache . '<td><a href="' . base_url() . 'admin/pages_menus/' . $row->id . '" class="btn btn-mini">Edit</a></td>';
            $cache = $cache . '<td><div class="btn-group btn-block">
                <a class="btn btn-mini btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
                   Delete
                   <span class="caret"></span>
                 </a>
             <ul class="dropdown-menu"><li><a href="' . base_url() . 'admin/delete_page/' . $row->id .
                    '">Confirm Delete</a></li></ul></div></td>';
            $cache = $cache . '</tr>';
        }
        $cache = $cache . '</table>';
        return $cache;
    }

    function create_page() {
        $data = array(
            'name' => underscore($this->input->post('name')),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        );
        $this->db->insert('pages', $data);
    }

    function update_page($id) {
        $data = array(
            'name' => underscore($this->input->post('name')),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        );
        $this->db->where('id', $id);
        $this->db->update('pages', $data);
    }

    function delete_page($id) {
        $row = $this->get_table_row_info('pages', 'id', 'title', $id);
        $this->db->delete('pages', array('id' => $id));
        return $row;
    }

    function create_menu() {
        $cache = null;
        foreach ($this->db->get('pages')->result() as $row) {
            $cache = $cache . '<li' . ($this->uri->segment(3) == $row->name ? ' class="active"' : '') . '><a href="' . base_url() . 'home/pages/' . $row->name . '">' . humanize($row->name) . '</a></li>';
        }
        return $cache;
    }

    function insert_feedback() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'subject' => $this->input->post('subject'),
            'body' => $this->input->post('description'),
        );
        $this->db->insert('feedbacks', $data);
    }

    function get_feedbacks($limit = null, $offset = null) {
        $this->db->order_by("id", "desc");
        $cache = null;
        foreach ($this->db->get('feedbacks', $limit, $offset)->result() as $row) {
            $cache = $cache . '<div class="btn-group">
                <a class="btn btn-mini btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
                   Delete
                   <span class="caret"></span>
                 </a>
             <ul class="dropdown-menu"><li><a href="' . base_url() . 'admin/delete_feedback/' . $row->id .
                    '">Confirm Delete</a></li></ul></div>';
            $cache = $cache . '<h4>' . $row->subject . '</h4>';
            $cache = $cache . '<p>' . $row->body . '</p>';
            $cache = $cache . '<p class="muted text-right">Given by ' . $row->name . ' [' . $row->email . ']</p>';
        }
        return $cache;
    }

    function delete_feedback($id) {
        $row = $this->get_table_row_info('feedbacks', 'id', 'subject', $id);
        $this->db->delete('feedbacks', array('id' => $id));
        return $row;
    }

    function _table_maker($from, $columns, $open_item = false, $limit = null, $offset = null, $edit = false, $del = false, $edit_in = null, $del_in = 'admin/delete_alumni/', $mask = false, $where = null, $open_items_in = 'home/alumni_details/', $class = 'table table-hover') {
        if ($where != null) {
            foreach ($where as $con) {
                $this->db->where($con['col'], $con['value']);
            }
        }
        $this->db->order_by("id", "desc");
        $cache = '<table class="' . $class . '">';
        $cache = $cache . '<tr>';
        for ($i = 0; $i < count($columns); $i++) {
            $cache = $cache . '<th>' . $columns[$i]['title'] . '</th>';
        }
        if ($open_item == TRUE) {
            $cache = $cache . '<td></td>';
        }
        if ($edit == TRUE) {
            $cache = $cache . '<td></td>';
        }
        if ($del == TRUE) {
            $cache = $cache . '<td></td>';
        }
        $cache = $cache . '</tr>';
        $count = 0;
        foreach ($this->db->get($from, $limit, $offset)->result() as $row) {
            $cache = $cache . '<tr>';
            for ($i = 0; $i < count($columns); $i++) {
                $temp = $row->$columns[$i]['id'];
                if ($mask == TRUE && isset($columns[$i]['mask'])) {
                    $temp = $this->get_table_row_info($columns[$i]['from'], $columns[$i]['where'], $columns[$i]['col'], $temp);
                }
                $cache = $cache . '<td>' . $temp . '</td>';
            }
            if ($open_item == TRUE) {
                $cache = $cache . '<td><a href="' . base_url() . $open_items_in
                        . $row->id . '" target="_blank" class="btn btn-mini pull-right">Details</a></td>';
            }
            if ($edit == TRUE) {
                $cache = $cache . '<td><a href="' . base_url() . $edit_in
                        . $row->id . '" class="btn btn-mini pull-right">Edit</a></td>';
            }
            if ($del == TRUE) {
                $cache = $cache . '<td><div class="btn-group btn-block">
                <a class="btn btn-mini btn-warning pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                   Delete
                   <span class="caret"></span>
                 </a>
             <ul class="dropdown-menu"><li><a href="' . base_url() . $del_in
                        . $row->id . '">Confirm Delete</a></li></ul></div></td>';
            }
            $cache = $cache . '</tr>';
            $count++;
        }
        $cache = $cache . '</table>';
        $cache = $cache . '<div class="alert alert-info text-right">Total rows:<b>' . $count . '</b></div>';
        return $cache;
    }

    function post_news($status = 1, $site = 1) {
        $data = array(
            'title' => $this->input->post('news_title'),
            'content' => $this->input->post('news_content'),
            'created' => date('Y-m-d'),
            'status' => $status,
            'site' => $site,
        );
        $this->db->insert('news', $data);
    }

    function get_news($edit = false, $limit = null, $offset = null) {
        $news = NULL;
        $this->db->order_by("id", "desc");
        $i = 1;
        foreach ($this->db->get('news', $limit, $offset)->result() as $row) {
            $news = $news . '<legend>' . $row->title . '</legend>';
            $news = $news . '<p>' . $row->content . '</p>';
            $news = $news . '<p class="muted text-right">Pulbished:' . $row->created . ' | Post NO: ' . $i++ . '</p>';
            if ($edit == TRUE) {

                // Confirm delete button
                $news = $news . '<div class="row"><div class="span2"><div class="btn-group btn-block">
                <a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
Delete
<span class = "caret"></span>
</a>
<ul class = "dropdown-menu"><li><a href = "' . base_url() . 'admin/delete_news_item/' . $row->id .
                        '">Confirm Delete</a></li></ul></div></div>';

                // Edit button
                $news = $news . '<div class = "span7"><a href = "' . base_url() . 'admin/index/' . $row->id . '" class = "btn btn-block btn-primary" target = "_blank">Edit</a></div></div>';
            }
        }
        return $news;
    }

    function get_news_row($id, $col) {
        $data = null;
        $this->db->where('id', $id);
        foreach ($this->db->get('news')->result() as $row) {
            $data = $row->$col;
        }
        return $data;
    }

    function update_news_row($id) {
        $this->db->where('id', $id);
        $data['title'] = $this->input->post('news_title');
        $data['content'] = $this->input->post('news_content');
        $this->db->update('news', $data);
    }

    function delete_news_row($id) {
        $row = $this->get_table_row_info('news', 'id', 'title', $id);
        $this->db->delete('news', array('id' => $id));
        return $row;
    }

    function get_table_row_info($table, $where, $col, $id) {
        $res = null;
        $this->db->where($where, $id);
        foreach ($this->db->get($table)->result() as $row) {
            $res = $row->$col;
        }
        return $res;
    }

    function get_site_info($id = 1) {
        $this->db->where('id', $id);
        foreach ($this->db->get('site')->result() as $row) {
            $data['site_name'] = $row->name;
            $data['site_slogun'] = $row->slogun;
            $data['site_logo'] = $row->logo;
            $data['site_logo_size'] = $row->logo_size;
            $data['site_contact'] = $row->contact;
            $data['site_copyright'] = $row->copyright;
            $data['site_owner'] = $row->owner;
            $data['site_licence'] = $row->serial_key;
            $data['site_status'] = $row->status;
            $data['creator'] = 'Surajit Sarma';
        }
        return ($data);
    }

    function set_site_info($id = 1) {
        $data = array(
            'name' => $this->input->post('name'),
            'slogun' => $this->input->post('slogun'),
            'logo' => $this->input->post('logo'),
            'logo_size' => $this->input->post('logo_size'),
            'contact' => $this->input->post('contact'),
            'copyright' => $this->input->post('copyright'),
            'owner' => $this->input->post('owner'),
        );
        $this->db->where('id', $id);
        $this->db->update('site', $data);
    }

    function register_licence($id = 1) {
        $data = array(
            'owner' => $this->input->post('owner'),
            'serial_key' => md5($this->input->post('serial_key')),
        );
        $this->db->where('id', $id);
        $this->db->update('site', $data);
    }

    function clear_licence($id = 1) {
        $data = array(
            'owner' => '',
            'serial_key' => '',
        );
        $this->db->where('id', $id);
        $this->db->update('site', $data);
    }

    function register_alumni($table = 'alumni') {
        $data = array(
            'fname' => $this->input->post('fname'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lname'),
            'sex' => $this->input->post('sex'),
            'organization' => $this->input->post('organization'),
            'address' => $this->input->post('address'),
            'campus' => $this->input->post('campus'),
            'school' => $this->input->post('school'),
            'department' => $this->input->post('department'),
            'course' => $this->input->post('course'),
            'session_from' => $this->input->post('session_from'),
            'session_to' => $this->input->post('session_to'),
            'designation' => $this->input->post('designation'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
        );
        $this->db->insert($table, $data);
    }

    function _dropdown_maker($name, $table, $item = 'name', $value = 'id', $class = 'input-block-level') {
        $this->db->order_by($item, "asc");
        $data = $this->get_table($table);
        $cache = '<select name="' . $name . '" class = "' . $class . '"><option value="" selected="selected">Select</option>';
        foreach ($data as $row) {
            $cache = $cache . '<option value="' . $row->$value . '"' . set_select($name, $row->$value) . '>' . $row->$item . '</option>';
        }
        $cache = $cache . '</select>';
        return $cache;
    }

    function get_table($table, $limit = null, $offset = null) {
        return $this->db->get($table, $limit, $offset)->result();
    }

    function is_empty_table($table) {
        if ($this->db->count_all($table) == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function insert_default_admin() {
        if ($this->is_empty_table('admin') == TRUE) {
            $data = array(
                'id' => 1,
                'username' => 'admin',
                'password' => md5('admin'),
            );
            $this->db->truncate('admin');
            $this->db->insert('admin', $data);
        }
    }

    function update_admin($id = 1) {
        $this->db->where('id', $id);
        $data = array(
            'username' => $this->input->post('current_username'),
            'password' => md5($this->input->post('current_password')),
        );
        $this->db->update('admin', $data);
    }

    function is_record_exists($table, $col, $str) {
        $found = FALSE;
        foreach ($this->db->get($table)->result() as $row) {
            if ($row->$col == $str) {
                $found = true;
            }
        }
        return $found;
    }

    function delete_row($table, $where, $id) {
        $this->db->delete($table, array($where => $id));
    }

    function is_dependant($id, $table, $col) {
        $this->db->where($col, $id);
        if ($this->db->get($table)->num_rows() > 0) {
            return TRUE;
        } else {
            return null;
        }
    }

}
