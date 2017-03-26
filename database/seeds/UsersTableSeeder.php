<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
			array('username' => 'sa', 'last_name' => 'Administrador', 'name' => 'Usuario', 'email' => 'ivanalirio_@hotmail.com', 'password' => bcrypt('12345678'), 'state_id' => 'A', 'created_at' => Carbon::now()),
		);

		User::insert($users);
    }
}
