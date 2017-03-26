<?php

use Illuminate\Database\Seeder;
use App\Models\UserState;
use Carbon\Carbon;
    
class UserStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$states = array(
			array('id' => 'A', 'user_state' => 'ACTIVO', 'created_at' => Carbon::now()),
			array('id' => 'B', 'user_state' => 'BAJA', 'created_at' => Carbon::now()),
			//...
		);

		UserState::insert($states);
    }
}
