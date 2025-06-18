<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inorga;

class InorgaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Airsoft Brotherhood Unity Indonesia', 'abbreviation' => 'ABUI'],
            ['name' => 'Aliansi Taijiquan Nasional Indonesia', 'abbreviation' => 'ATNI'],
            ['name' => 'Asosiasi Instruktur Aerobik & Fitness Indonesia', 'abbreviation' => 'ASIAFI'],
            ['name' => 'Asosiasi Lari Trail Indonesia', 'abbreviation' => 'ASTI'],
            ['name' => 'Asosiasi Masyarakat Dansa Indonesia', 'abbreviation' => 'AMDI'],
            ['name' => 'Asosiasi Perguruan Pencak Silat Budaya Indonesia', 'abbreviation' => 'APPSBI'],
            ['name' => 'Asosiasi Senam Kebugaran Indonesia', 'abbreviation' => 'ASKI'],
            ['name' => 'Asosiasi Seni Tarung Tradisi Indonesia', 'abbreviation' => 'ASTA'],
            ['name' => 'Assosiasi BMX Indonesia', 'abbreviation' => 'BMXI'],
            ['name' => 'Barisan Atlet Veteran Tenis Indonesia', 'abbreviation' => 'BAVETI'],
            ['name' => 'B-Boy Indonesia', 'abbreviation' => 'B-BOY'],
            ['name' => 'Beladiri Kempo Indonesia', 'abbreviation' => 'BKI'],
            ['name' => 'Federasi Dancersport dan Breaking Indonesia', 'abbreviation' => 'FDBI'],
            ['name' => 'Federasi Olahraga Kreasi Budaya Indonesia', 'abbreviation' => 'FOKBI'],
            ['name' => 'Federasi Orienteering Nasional Indonesia', 'abbreviation' => 'FONI'],
            ['name' => 'Federasi Seni Panahan Seluruh Indonesia', 'abbreviation' => 'FESPATI'],
            ['name' => 'Ikatan Langkah Dansa Indonesia', 'abbreviation' => 'ILDI'],
            ['name' => 'Ikatan Olahraga Senam Kreasi Indonesia', 'abbreviation' => 'IOSKI'],
            ['name' => 'Ikatan Senam Dance Mix Indonesia', 'abbreviation' => 'ISDMI'],
            ['name' => 'Indonesia Drum Corps Association', 'abbreviation' => 'IDCA'],
            ['name' => 'Indonesia E-Sport Association', 'abbreviation' => 'IESPA'],
            ['name' => 'Indonesia Offroad Federation', 'abbreviation' => 'IOF'],
            ['name' => 'Indonesia Taekwondo Fun', 'abbreviation' => 'ITF'],
            ['name' => 'Kebugaran Lansia dan Pralansia Indonesia', 'abbreviation' => 'KLPI'],
            ['name' => 'Komunitas Indonesia Skateboard', 'abbreviation' => 'KIS'],
            ['name' => 'Lembaga Seni Pernapasan Satria Nusantara', 'abbreviation' => 'LSPSN'],
            ['name' => 'Olahraga Keseimbangan Indonesia', 'abbreviation' => 'OKI'],
            ['name' => 'Panah Indonesia', 'abbreviation' => 'PI'],
            ['name' => 'Perkumpulan Binaraga dan Fisik Indonesia', 'abbreviation' => 'PERBAFI'],
            ['name' => 'Perkumpulan Liong dan Barongsai Seluruh Indonesia', 'abbreviation' => 'PLBSI'],
            ['name' => 'Perkumpulan Pelayang Indonesia', 'abbreviation' => 'PELANGI'],
            ['name' => 'Perkumpulan Praktisi Yoga Nasional Indonesia', 'abbreviation' => 'PPYNI'],
            ['name' => 'Perkumpulan Seni Olahraga Bening Indonesia', 'abbreviation' => 'PSOBI'],
            ['name' => 'Perkumpulan Silat Harimau Minangkabau', 'abbreviation' => 'SHM'],
            ['name' => 'Persatuan Bola Sundul Indonesia', 'abbreviation' => 'PERBOSI'],
            ['name' => 'Persatuan Gateball Seluruh Indonesia', 'abbreviation' => 'PERGATSI'],
            ['name' => 'Persatuan Liong dan Barongsai Seluruh Indonesia', 'abbreviation' => 'PLBSI'],
            ['name' => 'Persatuan Olahraga Gulat Tangan Indonesia', 'abbreviation' => 'POGTI'],
            ['name' => 'Persatuan Olahraga Tradisional Indonesia', 'abbreviation' => 'PORTINA'],
            ['name' => 'Persatuan Pencak Silat Indonesia', 'abbreviation' => 'PPSI'],
            ['name' => 'Persatuan Silat Nasional Perisai Putih', 'abbreviation' => 'PSNP'],
            ['name' => 'Persatuan Street Soccer Indonesia', 'abbreviation' => 'PERSOSI'],
            ['name' => 'Persatuan Tenis Seluruh Indonesia', 'abbreviation' => 'PERTONSI'],
            ['name' => 'Senam Tera Indonesia', 'abbreviation' => 'STI'],
            ['name' => 'Silat Harimau Minangkabau', 'abbreviation' => 'SHM'],
            ['name' => 'Yayasan Jantung Indonesia', 'abbreviation' => 'YJI'],
            ['name' => 'Yayasan Pendidikan Silat Indonesia', 'abbreviation' => 'YPSKI'],
        ];

        foreach ($data as $item) {
            Inorga::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}
