<?php

namespace Database\Seeders;

use App\Models\Council;
use Illuminate\Database\Seeder;

class CouncilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Council::create([
            'name' =>'Admin',
            'email'=>'admin@app.com',
            'password'=>bcrypt('password')
            ]);
    }
}
