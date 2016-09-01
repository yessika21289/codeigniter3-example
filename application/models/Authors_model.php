<?php

/**
 * Created by PhpStorm.
 * User: Yessika
 * Date: 31/08/2016
 * Time: 20:32
 * Class Authors_model
 * @property CI_DB_driver|CI_DB_sqlite3_driver $db The DB driver
 */
class Authors_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * @return array of authors' data
     */
    public function get_report() {
        $this->db->select('news.posted_on, news.title, MAX(news.id) as news_id, authors.id, authors.name, authors.email, COUNT(news.id) as posts')
            ->from('authors')
            ->order_by('authors.id', 'ASC');
        $this->db->join('news', 'news.author_id = authors.id', 'left')
            ->group_by('authors.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return bool false if failed to insert new author else author's inserted id
     */
    public function set_author($name, $email, $password)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => sha1(md5($password))
        );
        if ($this->db->insert('authors', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * @param string $title
     * @param string $text
     * @return bool false if author not verified else array of author's logged in data
     */
    public function verify($email, $password)
    {
        $this->db->where('email', $email)
            ->where('password', $password);
        $query = $this->db->get('authors');
        if ($query->row_array()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}
