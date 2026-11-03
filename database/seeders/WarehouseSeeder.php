<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * @var array<int, array<string, mixed>>
     */
    private array $warehouses = [
        [
            'code' => 'WH-JPR',
            'name' => 'Jepara Hub',
            'dexter_warehouse_id' => 'DXT-JPR-01',
            'address' => 'Jl. Raya Jepara–Kudus KM 7, Bawu, Batealit',
            'city' => 'Jepara',
            'province' => 'Central Java',
            'postal_code' => '59461',
            'phone' => '+62 291 593 100',
            'contact_person' => 'Agus Setiawan',
            'capacity_m3' => 8500,
        ],
        [
            'code' => 'WH-SMG',
            'name' => 'Semarang Transit',
            'dexter_warehouse_id' => 'DXT-SMG-02',
            'address' => 'Kawasan Industri Candi Blok D-4, Ngaliyan',
            'city' => 'Semarang',
            'province' => 'Central Java',
            'postal_code' => '50186',
            'phone' => '+62 24 762 8810',
            'contact_person' => 'Rina Kusuma',
            'capacity_m3' => 6200,
        ],
        [
            'code' => 'WH-SBY',
            'name' => 'Surabaya Port Annex',
            'dexter_warehouse_id' => 'DXT-SBY-03',
            'address' => 'Jl. Perak Timur No. 112, Pabean Cantian',
            'city' => 'Surabaya',
            'province' => 'East Java',
            'postal_code' => '60165',
            'phone' => '+62 31 329 4471',
            'contact_person' => 'Bayu Pratama',
            'capacity_m3' => 4800,
        ],
    ];

    public function run(): void
    {
        foreach ($this->warehouses as $item) {
            Warehouse::updateOrCreate(
                ['code' => $item['code']],
                $item + ['is_active' => true],
            );
        }
    }
}
