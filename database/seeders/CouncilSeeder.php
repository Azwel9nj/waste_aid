<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Council;

class CouncilSeeder extends Seeder
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
