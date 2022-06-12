<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengajuan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'pengajuan_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'ruangan_id'       => [
				'type'           => 'INT',
				'constraint'     => '5'
			],
			'komunitas_id' => [
				'type' => 'INT',
				'constraint' => '4',
				'default' => 1
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
		$this->forge->addKey('pengajuan_id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('pengajuan', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('pengajuan');
	}
}
