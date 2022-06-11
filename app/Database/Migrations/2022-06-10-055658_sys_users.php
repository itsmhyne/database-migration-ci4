<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SysUsers extends Migration
{
	public function up()
	{
		// membuat kolom/field untuk tabel _sys_user

		$this->forge->addField([
			'user_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true
			],
			'user_name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'user_foto'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
				'default' => 'default_admin.png'
			],
			'user_phone'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'user_address' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'username' => [
				'type'           => 'VARCHAR',
				'constraint'       => 50,
			],
			'password' => [
				'type'           => 'VARCHAR',
				'constraint'       => 50,
			],
			'user_group_id' => [
				'type'           => 'VARCHAR',
				'constraint'       => 4,
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
		$this->forge->addKey('user_id', TRUE);

		// Membuat tabel _sys_user
		$this->forge->createTable('_sys_user', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel _sys_user
		$this->forge->dropTable('_sys_user');
	}
}
