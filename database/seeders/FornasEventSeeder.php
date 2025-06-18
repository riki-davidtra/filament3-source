<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FornasEvent;

class FornasEventSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            [
                'title'         => 'Pendaftaran Peserta Pada FORNAS VIII NTB Tahun 2025',
                'opening_date'  => '2025-06-01',
                'closing_date'  => '2025-06-20',
                'letter_number' => '04.011/Dep.I/Fornas.NTB/2025',
                'letter_file'   => null,
                'description'   => 'Pendaftaran peserta FORNAS VIII NTB 2025 telah memasuki tahap Entry by Number dan Entry by Name, setelah ditutupnya tahap Entry by Sport pada 31 Mei 2025. KORMI Provinsi Jambi mengimbau KORMI Kabupaten/Kota segera mengirimkan data kontingen pegiat sesuai format yang ditentukan, paling lambat 20 Juni 2025.',
            ],
        ];

        foreach ($data as $item) {
            FornasEvent::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
