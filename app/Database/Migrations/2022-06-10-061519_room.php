<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Room extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'ruangan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'ruangan_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'ruangan_status' => [
				'type' => 'INT',
				'constraint' => '4'
			],
			'created_time DATETIME DEFAULT CURRENT_TIMESTAMP',
			'created_by' => [
				'type'           => 'INT',
				'constraint'       => 4,
			],
			'updated_time DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_by' => [
				'type'           => 'INT',
				'constraint'       => 4,
			],
			'status' => [
				'type'           => 'INT',
				'constraint'       => 1,
			]
		]);

		// Membuat primary key
		$this->forge->addKey('ruangan_id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('ruangan', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ruangan');
	}
}
