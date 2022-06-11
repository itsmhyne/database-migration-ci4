<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SysStatus extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'status_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'status_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
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
		$this->forge->addKey('status_id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('_sys_status', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('_sys_status');
	}
}
