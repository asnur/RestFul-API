<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
	public function run()
	{
		$data = [
			'username' => 'admin',
			'password' => md5('admin')
		];
		$this->db->table('user')->insert($data);
	}
}
