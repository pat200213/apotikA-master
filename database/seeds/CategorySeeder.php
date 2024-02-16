<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            'category_name' => 'ANALGESIK NARKOTIK'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'ANALGESIK NON NARKOTIK'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'ANTIPIRAI'
        ]);

        DB::table('categories')->insert([
            'category_name' => 'NYERI NEUROPATIK'
        ]);


    }
}
