<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_patients_profile_image_column extends CI_Migration {
    public function up(){
        $fields = array(
            'profile_image' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column('patients', $fields);
    }

    public function down() {
        $fields = array(
            'profile_image' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
        );
        $this->dbforge->modify_column('patients', $fields);
        // $this->dbforge->drop_column('patients', 'profile_image');
    }
}

?>