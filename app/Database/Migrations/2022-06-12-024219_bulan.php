<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bulan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'bulan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'bulan_kode'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 2
			],
			'bulan_nama' => [
				'type' => 'VARCHAR',
				'constraint' => '20'
			],
			'created_time DATETIME DEFAULT CURRENT_TIMESTAMP',
			'created_by' => [
				'type'           => 'INT',
				'constraint'       => 4,
				'default'           => 1,
			],
			'updated_time DATETIME',
			'updated_by' => [
				'type'           => 'INT',
				'constraint'       => 4,
				'null'           => true,
			],
			'status' => [
				'type'           => 'INT',
				'constraint'       => 1,
				'default'        => 1,
			]
		]);

		// Membuat primary key
		$this->forge->addKey('bulan_id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('bulan', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('bulan');
	}
}
