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

    public function set_author($name, $email, $password)
    {
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => sha1(md5($password))
        );
        return $this->db->insert('authors', $data);
    }

    /**
     * @param string $title
     * @param string $text
     * @return mixed
     */
    public function verify($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('authors');
        if ($query->row_array()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}
