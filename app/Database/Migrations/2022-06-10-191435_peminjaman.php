<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
{
	public function up()
	{

		$this->forge->addField([
			'peminjaman_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'peminjaman_nomor'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
			'ruangan_id'       => [
				'type'           => 'INT',
				'constraint'     => '4'
			],
			'komunitas_id'       => [
				'type'           => 'INT',
				'constraint'     => '4'
			],
			'peminjaman_status'       => [
				'type'           => 'INT',
				'constraint'     => '4',
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
		$this->forge->addKey('peminjaman_id', TRUE);
		$this->forge->createTable('peminjaman', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('peminjaman');
	}
}
