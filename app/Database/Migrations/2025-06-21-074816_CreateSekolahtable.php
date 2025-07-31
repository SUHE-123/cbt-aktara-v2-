<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSekolahTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'npsn'              => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'unique' => true],
            'nama_sekolah'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenjang'           => ['type' => 'ENUM', 'constraint' => ['SD', 'SMP', 'SMA', 'SMK', 'MA']],
            'status'            => ['type' => 'ENUM', 'constraint' => ['Negeri', 'Swasta'], 'default' => 'Swasta'],
            'alamat'            => ['type' => 'TEXT', 'null' => true],
            'desa_kelurahan'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'kecamatan'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'kab_kota'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'provinsi'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'kode_pos'          => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'kontak'            => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'email'             => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'kepala_sekolah'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'        => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'        => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('sekolah');
    }

    public function down()
    {
        $this->forge->dropTable('sekolah');
    }
}
