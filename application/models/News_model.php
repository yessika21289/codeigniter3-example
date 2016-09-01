<?php

/**
 * Class News_model
 * @property CI_DB_driver|CI_DB_sqlite3_driver $db The DB driver
 */
class News_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * @param bool $id
     * @return array of news' data
     */
    public function get_news($id = FALSE)
    {
        if ($id === FALSE) {
            $this->db->select('news.*, authors.id, authors.name, authors.email')
                ->from('news')
                ->join('authors', 'news.author_id = authors.id', 'left')
                ->order_by('news.posted_on', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('news.*, authors.id, authors.name, authors.email')
            ->from('news')
            ->join('authors', 'news.author_id = authors.id', 'left')
            ->where('news.id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    /**
     * @param string $title
     * @param string $text
     * @return bool false if failed to insert news else news' inserted id
     */
    public function set_news($title, $text, $author_id)
    {
        $this->load->helper('url');

        $slug = url_title($title, 'dash', TRUE);

        $data = array(
            'title' => $title,
            'slug' => $slug,
            'text' => $text,
            'author_id' => $author_id,
            'posted_on' => time()
        );

        if ($this->db->insert('news', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

}
