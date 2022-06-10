<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komunitas extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel news
		$this->forge->addField([
			'komunitas_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'komunitas_logo'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'komunitas_nama' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'bidang'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'jml_anggota' => [
				'type'           => 'INT',
				'constraint'           => 6,
			],
			'ketua'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'kontak'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'username'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'password'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'user_group_id'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
				'default' => 2
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
		$this->forge->addKey('komunitas_id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('komunitas', TRUE);
	}

	//---------------------

	public function down()
	{
		$this->forge->dropTable('komunitas');
	}
}
