<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        [
          'name' => 'Becode Animal',
          'slug' => 'becode-animal'
        ],
        [
          'name' => 'Becode Art',
          'slug' => 'becode-art'
        ],
        [
          'name' => 'Becode Nature',
          'slug' => 'becode-nature'
        ],
        [
          'name' => 'Becode Cinema',
          'slug' => 'becode-cinema'
        ]
      ]);
    }
}
