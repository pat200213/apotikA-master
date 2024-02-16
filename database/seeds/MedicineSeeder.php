<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            'name' => 'alopurinol',
            'form' => 'tab 100 mg*',
            'restriction_formula' => '30 tab/bulan.',
            'price' => 8000,
            'description' => 'Tidak diberikan pada saat nyeri akut.',
            'faskes1' => true,
            'faskes2' => true,
            'faskes3' => true,
            'category_id' => 3 
        ]);

        DB::table('medicines')->insert([
            'name' => 'kolkisin',
            'form' => 'tab 500 mcg',
            'restriction_formula' => '30 tab/bulan.',
            'description' => '',
            'price' => 5000,
            'faskes1' => true,
            'faskes2' => true,
            'faskes3' => true,
            'category_id' => 3
        ]);

        DB::table('medicines')->insert([
            'name' => 'gabapentin',
            'form' => 'kaps 100 mg',
            'restriction_formula' => '60 kaps/bulan.',
            'price' => 10000,
            'description' => 'Hanya untuk neuralgia pascaherpes 
                                atau nyeri neuropati diabetikum',
            'faskes1' => false,
            'faskes2' => true,
            'faskes3' => true,
            'category_id' => 4 
        ]);

        DB::table('medicines')->insert([
            'name' => 'karbamazepin',
            'form' => 'tab 100 mg',
            'restriction_formula' => '60 tab/bulan.',
            'description' => 'Hanya untuk neuralgia trigeminal.',
            'price' => 5000,
            'faskes1' => true,
            'faskes2' => true,
            'faskes3' => true,
            'category_id' => 4
        ]);

    }
}
