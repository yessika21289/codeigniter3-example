<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Migration_Add_authors
 * @property CI_DB_forge $dbforge The DB Forge
 */
class Migration_Add_authors extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => FALSE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => FALSE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => FALSE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('authors');
    }

    public function down()
    {
        $this->dbforge->drop_table('authors');
    }
}
