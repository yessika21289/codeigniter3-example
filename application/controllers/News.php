<?php

/**
 * Class News
 * @property News_model $news_model The News model
 * @property CI_Form_validation $form_validation The form validation lib
 * @property CI_Input $input The input lib
 * @property CI_Session $session The session lib
 */
class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        //check if author has yet logged in
        $logged_in = $this->session->userdata('logged_in');

        if (!$logged_in) {
            redirect('authors');
        } else {
            $data['news'] = $this->news_model->get_news();
            $data['title'] = 'Home';
            $data['author'] = $this->session->userdata('name');
            $this->load->view('templates/header', $data);
            $this->load->view('news/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function view($id = NULL)
    {
        //check if author has yet logged in
        $logged_in = $this->session->userdata('logged_in');

        if (!$logged_in) {
            redirect('authors');
        } else {
            $data['news_item'] = $this->news_model->get_news($id);
            $data['msg'] = $this->session->flashdata('add_news');

            if (empty($data['news_item'])) {
                show_404();
            }

            $data['title'] = $data['news_item']['title'];

            $this->load->view('templates/header', $data);
            $this->load->view('news/view');
            $this->load->view('templates/footer');
        }
    }

    public function create()
    {
        //check if author has yet logged in
        $logged_in = $this->session->userdata('logged_in');

        if (!$logged_in) {
            redirect('authors');
        } else {
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $data['title'] = 'Create a news item';

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');
            } else {
                $author_id = $this->session->userdata('id');
                $news = $this->news_model->set_news($this->input->post_get('title', true), $this->input->post_get('text', true), $author_id);
                if($news) {
                    $msg =
                        "<div class=\"alert alert-success\">
                            <strong>Success!</strong> Great success adding news item!
                        </div>";
                    $this->session->set_flashdata('add_news', $msg);
                    redirect('news/view/'.$news);
                } else {
                    redirect('news');
                }
            }
        }
    }

}
