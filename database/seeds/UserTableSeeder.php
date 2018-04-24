<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run() {

		if(env('APP_ENV') != 'production')
		{
			$password = Hash::make('bni123');
	
				$users[] = [
					'name' => 'admin',
					'username' => 'admin',
					'email' => 'admin@myapp.com',					
					'password' => $password
				];		

			User::insert($users);
		}
	}
}
// php artisan db:seed --class=UserTableSeeder