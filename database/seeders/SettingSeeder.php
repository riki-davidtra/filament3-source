<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\SettingItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'siteConfig' => Setting::updateOrCreate(['name' => 'Site Config']),
            'contact'    => Setting::updateOrCreate(['name' => 'Contact']),
        ];

        $settingItems = [
            [
                'setting_uuid' => $settings['siteConfig']->uuid,
                'name'       => 'Site Name',
                'key'        => 'site_name',
                'type'       => 'text',
                'value'      => 'SITE NAME',
            ],
            [
                'setting_uuid' => $settings['siteConfig']->uuid,
                'name'       => 'Website URL',
                'key'        => 'website_url',
                'type'       => 'url',
                'value'      => 'http://127.0.0.1:8000/',
            ],
            [
                'setting_uuid' => $settings['siteConfig']->uuid,
                'name'       => 'Logo',
                'key'        => 'logo',
                'type'       => 'file',
                'value'      => null,
            ],
            [
                'setting_uuid' => $settings['siteConfig']->uuid,
                'name'       => 'Favicon',
                'key'        => 'favicon',
                'type'       => 'file',
                'value'      => null,
            ],
            [
                'setting_uuid' => $settings['siteConfig']->uuid,
                'name'       => 'Meta',
                'key'        => 'meta',
                'type'       => 'textarea',
                'value'      => '<meta name="description" content="" />
    <meta property = "og:title" content       = "SITE NAME" />
    <meta property = "og:description" content = "" />
    <meta property = "og:type" content        = "website" />
    <meta property = "og:url" content         = "https://example.com" />
    <meta property = "og:image" content       = "" />',
            ],
            [
                'setting_uuid' => $settings['contact']->uuid,
                'name'       => 'Address',
                'key'        => 'address',
                'type'       => 'text',
                'value'      => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, voluptas!',
            ],
            [
                'setting_uuid' => $settings['contact']->uuid,
                'name'       => 'Email',
                'key'        => 'email',
                'type'       => 'email',
                'value'      => 'example@email.com',
            ],
            [
                'setting_uuid' => $settings['contact']->uuid,
                'name'       => 'Phone Number',
                'key'        => 'phone_number',
                'type'       => 'number',
                'value'      => '0899999999999',
            ],
        ];
        foreach ($settingItems as $settingItem) {
            SettingItem::updateOrCreate(['name' => $settingItem['name']], $settingItem);
        }
    }
}
