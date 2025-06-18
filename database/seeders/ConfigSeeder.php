<?php

namespace Database\Seeders;

use App\Models\ConfigGroup;
use App\Models\ConfigItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configGroups = [
            'configSite' => ConfigGroup::updateOrCreate(['name' => 'Site Config']),
            'contact'    => ConfigGroup::updateOrCreate(['name' => 'Contact']),
        ];

        $configItems = [
            [
                'config_group_id' => $configGroups['configSite']->uuid,
                'name'            => 'Site Name',
                'key'             => 'site_name',
                'type'            => 'text',
                'value'           => 'KORMI PROVINSI JAMBI',
            ],
            [
                'config_group_id' => $configGroups['configSite']->uuid,
                'name'            => 'Website URL',
                'key'             => 'website_url',
                'type'            => 'url',
                'value'           => 'http://127.0.0.1:8000/',
            ],
            [
                'config_group_id' => $configGroups['configSite']->uuid,
                'name'            => 'Logo',
                'key'             => 'logo',
                'type'            => 'file',
                'value_file'      => null,
            ],
            [
                'config_group_id' => $configGroups['configSite']->uuid,
                'name'            => 'Favicon',
                'key'             => 'favicon',
                'type'            => 'file',
                'value_file'      => null,
            ],
            [
                'config_group_id' => $configGroups['configSite']->uuid,
                'name'            => 'Meta',
                'key'             => 'meta',
                'type'            => 'textarea',
                'value'           => '<meta name="description" content="" />
    <meta property="og:title" content="KORMI PROVINSI JAMBI" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://example.com" />
    <meta property="og:image" content="" />',
            ],
            [
                'config_group_id' => $configGroups['contact']->uuid,
                'name'            => 'Address',
                'key'             => 'address',
                'type'            => 'text',
                'value'           => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, voluptas!',
            ],
            [
                'config_group_id' => $configGroups['contact']->uuid,
                'name'            => 'Email',
                'key'             => 'email',
                'type'            => 'email',
                'value'           => 'example@email.com',
            ],
            [
                'config_group_id' => $configGroups['contact']->uuid,
                'name'            => 'Phone Number',
                'key'             => 'phone_number',
                'type'            => 'number',
                'value'           => '0899999999999',
            ],
        ];
        foreach ($configItems as $configItem) {
            ConfigItem::updateOrCreate(['name' => $configItem['name']], $configItem);
        }
    }
}
