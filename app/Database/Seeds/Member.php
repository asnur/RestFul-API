<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Member extends Seeder
{
	public function run()
	{
		for ($i = 1; $i <= 100; $i++) {
			$faker = \Faker\Factory::create('id_ID');
			$data = [
				'nama' => $faker->name,
				'umur' => $faker->randomNumber(2),
				'alamat' => $faker->address
			];
			$this->db->table('member')->insert($data);
		}
	}
}
