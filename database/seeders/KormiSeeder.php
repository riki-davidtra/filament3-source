<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kormi;

class KormiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'KORMI Kabupaten Batanghari'],
            ['name' => 'KORMI Kabupaten Bungo'],
            ['name' => 'KORMI Kabupaten Kerinci'],
            ['name' => 'KORMI Kabupaten Merangin'],
            ['name' => 'KORMI Kabupaten Muaro Jambi'],
            ['name' => 'KORMI Kabupaten Sarolangun'],
            ['name' => 'KORMI Kabupaten Tanjung Jabung Barat'],
            ['name' => 'KORMI Kabupaten Tanjung Jabung Timur'],
            ['name' => 'KORMI Kabupaten Tebo'],
            ['name' => 'KORMI Kota Sungai Penuh'],
        ];

        foreach ($data as $item) {
            Kormi::updateOrCreate(
                ['name' => $item['name']],
                ['name' => $item['name']]
            );
        }
    }
}
