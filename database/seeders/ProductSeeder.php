<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductDocument;
use App\Models\Stock;
use App\Models\Warehouse;
use App\Models\WoodSpecies;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Catalogue rows. Stock volume on the product is derived from the seeded
     * stock batches so the listing and the warehouse ledger always agree.
     *
     * @var array<int, array<string, mixed>>
     */
    private array $products = [
        [
            'product_code' => 'BB-TK-001',
            'name' => 'Teak Kiln Dried Boards',
            'category' => 'solid-wood-boards',
            'species' => 'teak',
            'grade' => 'Grade A',
            'origin_region' => 'Jepara, Central Java',
            'thickness_mm' => 25,
            'width_mm' => 150,
            'length_m' => 2.1,
            'moisture_content_min' => 10,
            'moisture_content_max' => 12,
            'surface' => 'S4S',
            'price_per_m3' => 18500000,
            'min_order_m3' => 1,
            'image_path' => 'images/serat/stock-teak-kd.png',
            'description' => 'Export-ready teak boards, kiln dried to 10–12% moisture content and planed on four sides for direct use in furniture production.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/TK/2026/0114'],
                ['type' => 'fsc', 'document_number' => 'FSC-C104871'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-JPR', 'batch_code' => 'TK-KD-2601', 'location_code' => 'A-01-03', 'volume_m3' => 16.4, 'reserved_m3' => 2.5],
                ['warehouse' => 'WH-SMG', 'batch_code' => 'TK-KD-2602', 'location_code' => 'B-04-01', 'volume_m3' => 8.4, 'reserved_m3' => 1.0],
            ],
        ],
        [
            'product_code' => 'BB-TK-002',
            'name' => 'Teak Round Log Selection',
            'category' => 'solid-wood-round-logs',
            'species' => 'teak',
            'grade' => 'Grade A',
            'origin_region' => 'Cepu, Central Java',
            'thickness_mm' => 400,
            'width_mm' => 400,
            'length_m' => 2.6,
            'moisture_content_min' => 14,
            'moisture_content_max' => 18,
            'surface' => 'Round',
            'price_per_m3' => 22000000,
            'min_order_m3' => 2,
            'image_path' => 'images/timber-logs.jpg',
            'description' => 'Selected Perhutani teak logs, straight grain with minimum 40 cm diameter, graded for veneer and premium solid components.',
            'documents' => [
                ['type' => 'perhutani', 'document_number' => 'PHM/CP/2026/0087'],
                ['type' => 'svlk', 'document_number' => 'SVLK/TK/2026/0115'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-JPR', 'batch_code' => 'TK-LOG-2601', 'location_code' => 'L-02-01', 'volume_m3' => 38.9, 'reserved_m3' => 4.0],
                ['warehouse' => 'WH-SBY', 'batch_code' => 'TK-LOG-2602', 'location_code' => 'L-01-02', 'volume_m3' => 16.5, 'reserved_m3' => 0],
            ],
        ],
        [
            'product_code' => 'BB-TK-003',
            'name' => 'Teak Sawn Timber Grade A',
            'category' => 'solid-wood-sawn-timber',
            'species' => 'teak',
            'grade' => 'Grade A',
            'origin_region' => 'Blora, Central Java',
            'thickness_mm' => 30,
            'width_mm' => 200,
            'length_m' => 2.4,
            'moisture_content_min' => 12,
            'moisture_content_max' => 15,
            'surface' => 'Rough Sawn',
            'price_per_m3' => 21000000,
            'min_order_m3' => 1,
            'image_path' => 'images/serat/cat-solid-wood.png',
            'description' => 'Rough sawn teak for structural furniture parts, air dried then finished under cover to hold a stable grain.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/TK/2026/0116'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-JPR', 'batch_code' => 'TK-SWN-2601', 'location_code' => 'A-03-02', 'volume_m3' => 22.8, 'reserved_m3' => 3.2],
            ],
        ],
        [
            'product_code' => 'BB-TK-004',
            'name' => 'Teak Finger Joint Timber',
            'category' => 'processed-wood-finger-joint-timber',
            'species' => 'teak',
            'grade' => 'Grade A',
            'origin_region' => 'Jepara, Central Java',
            'thickness_mm' => 20,
            'width_mm' => 100,
            'length_m' => 2.4,
            'moisture_content_min' => 8,
            'moisture_content_max' => 10,
            'surface' => 'S4S',
            'price_per_m3' => 14800000,
            'min_order_m3' => 1,
            'image_path' => 'images/serat/cat-processed-wood.png',
            'description' => 'Finger jointed teak strips with matched colour and grain, kiln dried for stable yields in long component runs.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/TK/2026/0117'],
                ['type' => 'iso', 'document_number' => 'ISO-9001-2015/JPR'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-JPR', 'batch_code' => 'TK-FJ-2601', 'location_code' => 'C-01-01', 'volume_m3' => 12.6, 'reserved_m3' => 1.4],
                ['warehouse' => 'WH-SBY', 'batch_code' => 'TK-FJ-2602', 'location_code' => 'C-02-03', 'volume_m3' => 7.2, 'reserved_m3' => 0.8],
            ],
        ],
        [
            'product_code' => 'BB-MH-001',
            'name' => 'Mahogany Sawn Timber',
            'category' => 'solid-wood-sawn-timber',
            'species' => 'mahogany',
            'grade' => 'Grade A',
            'origin_region' => 'Semarang, Central Java',
            'thickness_mm' => 30,
            'width_mm' => 200,
            'length_m' => 2.4,
            'moisture_content_min' => 12,
            'moisture_content_max' => 15,
            'surface' => 'Rough Sawn',
            'price_per_m3' => 8500000,
            'min_order_m3' => 1,
            'image_path' => 'images/serat/stock-mahoni.png',
            'description' => 'Deep red grain sawn timber prepared for high-end furniture, doors, and facade panels.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/MH/2026/0061'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-SMG', 'batch_code' => 'MH-SWN-2601', 'location_code' => 'B-01-02', 'volume_m3' => 27.5, 'reserved_m3' => 2.5],
                ['warehouse' => 'WH-SBY', 'batch_code' => 'MH-SWN-2602', 'location_code' => 'B-03-01', 'volume_m3' => 8.5, 'reserved_m3' => 0.5],
            ],
        ],
        [
            'product_code' => 'BB-MH-002',
            'name' => 'Mahogany Kiln Dried Lumber',
            'category' => 'processed-wood-kiln-dried-lumber',
            'species' => 'mahogany',
            'grade' => 'Grade A',
            'origin_region' => 'Semarang, Central Java',
            'thickness_mm' => 25,
            'width_mm' => 150,
            'length_m' => 2.4,
            'moisture_content_min' => 10,
            'moisture_content_max' => 12,
            'surface' => 'S2S',
            'price_per_m3' => 9400000,
            'min_order_m3' => 1,
            'image_path' => 'images/serat/cat-processed-wood.png',
            'description' => 'Kiln dried mahogany lumber, stress relieved in the chamber for predictable movement after machining.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/MH/2026/0062'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-SMG', 'batch_code' => 'MH-KD-2601', 'location_code' => 'C-03-02', 'volume_m3' => 19.4, 'reserved_m3' => 1.9],
            ],
        ],
        [
            'product_code' => 'BB-SK-001',
            'name' => 'Sungkai S4S Planed',
            'category' => 'solid-wood-boards',
            'species' => 'sungkai',
            'grade' => 'Grade A',
            'origin_region' => 'Blora, Central Java',
            'thickness_mm' => 25,
            'width_mm' => 150,
            'length_m' => 2.0,
            'moisture_content_min' => 10,
            'moisture_content_max' => 12,
            'surface' => 'S4S',
            'price_per_m3' => 9800000,
            'min_order_m3' => 1,
            'image_path' => 'images/serat/stock-sungkai.png',
            'description' => 'Pale, even-grained sungkai planed on four sides, a practical core material for indoor furniture and panelling.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/SK/2026/0039'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-JPR', 'batch_code' => 'SK-S4S-2601', 'location_code' => 'A-02-01', 'volume_m3' => 18.5, 'reserved_m3' => 0],
            ],
        ],
        [
            'product_code' => 'BB-MB-001',
            'name' => 'Merbau Heavy Decking',
            'category' => 'solid-wood-boards',
            'species' => 'merbau',
            'grade' => 'Export Grade',
            'origin_region' => 'Papua, Indonesia',
            'thickness_mm' => 20,
            'width_mm' => 140,
            'length_m' => 2.4,
            'moisture_content_min' => 12,
            'moisture_content_max' => 14,
            'surface' => 'S4S',
            'price_per_m3' => 16200000,
            'min_order_m3' => 2,
            'image_path' => 'images/timber-planks.jpg',
            'description' => 'Dense merbau decking boards with natural weather resistance, kiln dried and end-matched for exterior installation.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/MB/2026/0022'],
                ['type' => 'fsc', 'document_number' => 'FSC-C104871'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-SBY', 'batch_code' => 'MB-DCK-2601', 'location_code' => 'D-01-01', 'volume_m3' => 31.0, 'reserved_m3' => 5.0],
                ['warehouse' => 'WH-SMG', 'batch_code' => 'MB-DCK-2602', 'location_code' => 'D-02-02', 'volume_m3' => 11.0, 'reserved_m3' => 1.0],
            ],
        ],
        [
            'product_code' => 'BB-BK-001',
            'name' => 'Bengkirai Exterior Slats',
            'category' => 'solid-wood-boards',
            'species' => 'bengkirai',
            'grade' => 'Grade A',
            'origin_region' => 'Kalimantan, Indonesia',
            'thickness_mm' => 19,
            'width_mm' => 90,
            'length_m' => 2.4,
            'moisture_content_min' => 14,
            'moisture_content_max' => 18,
            'surface' => 'Rough Sawn',
            'price_per_m3' => 11500000,
            'min_order_m3' => 2,
            'image_path' => 'images/serat/cat-solid-wood.png',
            'description' => 'Air dried bengkirai slats with high density and natural durability for screens, ceilings, and outdoor cladding.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/BK/2026/0054'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-SBY', 'batch_code' => 'BK-SLT-2601', 'location_code' => 'E-01-03', 'volume_m3' => 24.7, 'reserved_m3' => 2.2],
                ['warehouse' => 'WH-JPR', 'batch_code' => 'BK-SLT-2602', 'location_code' => 'E-02-01', 'volume_m3' => 5.5, 'reserved_m3' => 0],
            ],
        ],
        [
            'product_code' => 'BB-PN-001',
            'name' => 'Pine Kiln Dried Slats',
            'category' => 'processed-wood-kiln-dried-lumber',
            'species' => 'pine',
            'grade' => 'Grade B',
            'origin_region' => 'North Sumatra, Indonesia',
            'thickness_mm' => 18,
            'width_mm' => 120,
            'length_m' => 2.4,
            'moisture_content_min' => 8,
            'moisture_content_max' => 10,
            'surface' => 'S4S',
            'price_per_m3' => 6200000,
            'min_order_m3' => 3,
            'image_path' => 'images/serat/cat-processed-wood.png',
            'description' => 'Kiln dried pine slats for secondary components, packaging frames, and painted interior elements.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/PN/2026/0091'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-SMG', 'batch_code' => 'PN-KD-2601', 'location_code' => 'F-01-01', 'volume_m3' => 42.0, 'reserved_m3' => 3.0],
                ['warehouse' => 'WH-JPR', 'batch_code' => 'PN-KD-2602', 'location_code' => 'F-02-02', 'volume_m3' => 18.0, 'reserved_m3' => 0],
            ],
        ],
        [
            'product_code' => 'BB-RW-001',
            'name' => 'Rubberwood Finger Joint Panel',
            'category' => 'processed-wood-laminated-panels',
            'species' => 'rubberwood',
            'grade' => 'Grade A',
            'origin_region' => 'South Sumatra, Indonesia',
            'thickness_mm' => 18,
            'width_mm' => 1220,
            'length_m' => 2.44,
            'moisture_content_min' => 8,
            'moisture_content_max' => 10,
            'surface' => 'Sanded',
            'price_per_m3' => 5900000,
            'min_order_m3' => 2,
            'image_path' => 'images/serat/cat-processed-wood.png',
            'description' => 'Edge glued rubberwood panels with uniform colour and flatness, produced from plantation timber.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/RW/2026/0073'],
                ['type' => 'iso', 'document_number' => 'ISO-9001-2015/SMS'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-SMG', 'batch_code' => 'RW-PNL-2601', 'location_code' => 'G-01-02', 'volume_m3' => 26.4, 'reserved_m3' => 1.6],
            ],
        ],
        [
            'product_code' => 'BB-CS-001',
            'name' => 'Custom Teak Cut-to-size',
            'category' => 'custom-cut-to-size',
            'species' => 'teak',
            'grade' => 'Grade A',
            'origin_region' => 'Jepara, Central Java',
            'thickness_mm' => 25,
            'width_mm' => 150,
            'length_m' => 1.0,
            'moisture_content_min' => 10,
            'moisture_content_max' => 12,
            'surface' => 'Sanded',
            'price_per_m3' => 24000000,
            'min_order_m3' => 0.5,
            'is_custom_order' => true,
            'image_path' => 'images/serat/cat-custom-size.png',
            'description' => 'Teak components cut and profiled to a customer drawing, priced per cubic metre against the confirmed specification.',
            'documents' => [
                ['type' => 'svlk', 'document_number' => 'SVLK/TK/2026/0118'],
            ],
            'stocks' => [
                ['warehouse' => 'WH-JPR', 'batch_code' => 'TK-CTS-2601', 'location_code' => 'C-04-02', 'volume_m3' => 3.4, 'reserved_m3' => 0.4],
            ],
        ],
    ];

    public function run(): void
    {
        $categories = ProductCategory::pluck('id', 'slug');
        $species = WoodSpecies::pluck('id', 'slug');
        $warehouses = Warehouse::pluck('id', 'code');

        foreach ($this->products as $row) {
            $categoryId = $categories[$row['category']] ?? null;
            $speciesId = $species[$row['species'] ?? ''] ?? null;

            if ($categoryId === null) {
                $this->command?->warn("Skipping {$row['product_code']}: category {$row['category']} not found.");

                continue;
            }

            $product = Product::updateOrCreate(
                ['product_code' => $row['product_code']],
                [
                    'category_id' => $categoryId,
                    'species_id' => $speciesId,
                    'name' => $row['name'],
                    'slug' => str($row['product_code'].' '.$row['name'])->slug()->value(),
                    'grade' => $row['grade'] ?? null,
                    'origin_country' => $row['origin_country'] ?? 'Indonesia',
                    'origin_region' => $row['origin_region'] ?? null,
                    'thickness_mm' => $row['thickness_mm'] ?? null,
                    'width_mm' => $row['width_mm'] ?? null,
                    'length_m' => $row['length_m'] ?? null,
                    'moisture_content_min' => $row['moisture_content_min'] ?? null,
                    'moisture_content_max' => $row['moisture_content_max'] ?? null,
                    'surface' => $row['surface'] ?? null,
                    'price_per_m3' => $row['price_per_m3'] ?? null,
                    'min_order_m3' => $row['min_order_m3'] ?? 1,
                    'available_volume_m3' => 0,
                    'description' => $row['description'] ?? null,
                    'image_path' => $row['image_path'] ?? null,
                    'is_custom_order' => $row['is_custom_order'] ?? false,
                    'is_active' => true,
                ],
            );

            $this->seedDocuments($product, $row['documents'] ?? []);
            $this->seedStocks($product, $warehouses, $row['stocks'] ?? []);
            $this->syncAvailableVolume($product);
        }
    }

    /**
     * @param  array<int, array{type: string, document_number: string}>  $documents
     */
    private function seedDocuments(Product $product, array $documents): void
    {
        foreach ($documents as $document) {
            ProductDocument::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'type' => $document['type'],
                    'document_number' => $document['document_number'],
                ],
                [
                    'issued_at' => now()->subMonths(4)->toDateString(),
                    'expires_at' => now()->addYear()->toDateString(),
                    'is_verified' => true,
                ],
            );
        }
    }

    /**
     * @param  \Illuminate\Support\Collection<string, int>  $warehouses
     * @param  array<int, array<string, mixed>>  $stocks
     */
    private function seedStocks(Product $product, $warehouses, array $stocks): void
    {
        foreach ($stocks as $stock) {
            $warehouseId = $warehouses[$stock['warehouse']] ?? null;

            if ($warehouseId === null) {
                continue;
            }

            Stock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'warehouse_id' => $warehouseId,
                    'batch_code' => $stock['batch_code'],
                ],
                [
                    'location_code' => $stock['location_code'] ?? null,
                    'volume_m3' => $stock['volume_m3'],
                    'reserved_m3' => $stock['reserved_m3'] ?? 0,
                    'status' => 'available',
                    'last_counted_at' => now()->subDays(3),
                ],
            );
        }
    }

    private function syncAvailableVolume(Product $product): void
    {
        $stock = $product->stocks()->get();

        $available = $stock->sum(fn (Stock $row) => (float) $row->volume_m3 - (float) $row->reserved_m3);

        $product->forceFill(['available_volume_m3' => round($available, 3)])->save();
    }
}
