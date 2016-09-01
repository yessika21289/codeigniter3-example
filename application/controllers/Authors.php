<?php

/**
 * Created by PhpStorm.
 * User: Yessika
 * Date: 31/08/2016
 * Time: 20:34
 * Class Authors
 * @property Authors_model $authors_model The Authors model
 * @property CI_Form_validation $form_validation The form validation lib
 * @property CI_Input $input The input lib
 * @property CI_Session $session The session lib
 */
class Authors extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('authors_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        //check if author has yet logged in
        $logged_in = $this->session->userdata('logged_in');
        $data['msg'] = $this->session->flashdata('login_failed_msg');

        if (!isset($logged_in)) {
            $data['title'] = 'Author Login';
            $this->load->view('templates/header', $data);
            $this->load->view('authors/login');
            $this->load->view('templates/footer');
        } else {
            redirect('news');
        }
    }
    
    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $data['title'] = 'Author Register';

        //validation for registration form
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_message('min_length', '{field} must have at least {param} characters.');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('authors/register');
            $this->load->view('templates/footer');
        } else {
            //call function in Authors model to insert new author
            $new_author = $this->authors_model->set_author($this->input->post_get('name', true), $this->input->post_get('email', true), $this->input->post_get('password', true));
            if ($new_author) {
                //new author logged in right after registration success
                $data = array(
                    'id' => $new_author,
                    'name' => $this->input->post_get('name', true),
                    'email' => $this->input->post_get('email', true),
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                redirect('news');
            } else {
                redirect('authors');
            }
        }
    }

    public function login()
    {
        $this->load->library('form_validation');

        //validation for login form
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Author Login';
            $this->load->view('templates/header', $data);
            $this->load->view('authors/login');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post_get('email', true);
            $password = sha1(md5($this->input->post_get('password', true)));
            //call function in Authors model to verify author login data
            $author = $this->authors_model->verify($email, $password);
            if (!empty($author)) {
                $data = array(
                    'id' => $author['id'],
                    'name' => $author['name'],
                    'email' => $author['email'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                redirect('news');
            } else {
                //set message if login failed
                $msg =
                    "<div class='alert alert-danger' role='alert'>
                        <strong>Login failed!</strong>
                        <br/>Username/Password do not match.
                    </div>";
                $this->session->set_flashdata('login_failed_msg', $msg);
                redirect('authors');
            }
        }
    }

    public function logout()
    {
        //delete session of logged in author
        $this->session->sess_destroy();
        redirect('authors');
    }

    public function report()
    {
        //check if author has yet logged in
        $logged_in = $this->session->userdata('logged_in');

        if (!$logged_in) {
            redirect('authors');
        } else {
            //call function in Authors model to get authors' data
            $data['authors_report'] = $this->authors_model->get_report();
            $data['title'] = 'Authors Report';
            $data['author'] = $this->session->userdata('name');
            $this->load->view('templates/header', $data);
            $this->load->view('authors/report');
            $this->load->view('templates/footer');
        }
    }

}
