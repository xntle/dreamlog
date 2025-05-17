<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateDreamsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false
            ],
            'content'     => [
                'type' => 'TEXT',
                'null' => false
            ],
            'tags'        => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Comma-separated tags, e.g. dream,nightmare,peaceful'
            ],
            'image_url'   => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true
            ],
            'created_at'  => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('dreams');
    }

    public function down()
    {
        $this->forge->dropTable('dreams');
    }
}
