<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifikasi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'notifikasi_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'notifikasi_nama'       => [
				'type'           => 'INT',
				'constraint'     => '5'
			],
			'notifikasi_isi' => [
				'type' => 'TEXT',
				'null' => true
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
		$this->forge->addKey('notifikasi_id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('notifikasi', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('notifikasi');
	}
}
