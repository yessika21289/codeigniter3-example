<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Add_news
 * @property CI_DB_forge $dbforge The DB Forge
 */
class Migration_Modify_news extends CI_Migration {

    public function up()
    {
        $new_column = array(
            'author_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ),
            'posted_on' => array(
                'type' => 'INT',
                'constraint' => 11
            ),
        );
        $this->dbforge->add_column('news', $new_column);
    }

    public function down()
    {
        $this->dbforge->drop_table('news');
    }
}
