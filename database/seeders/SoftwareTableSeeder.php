<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Software;

class SoftwareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Software::factory()->count(2)->create();
    }
}
