<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Top level categories plus solid wood children.
     *
     * @var array<int, array{name: string, type: string, description: string, children?: array<int, string>}>
     */
    private array $categories = [
        [
            'name' => 'Solid Wood',
            'type' => 'solid_wood',
            'description' => 'Sawn timber, boards, and logs in standard or selected grades.',
            'children' => ['Sawn Timber', 'Boards', 'Round Logs'],
        ],
        [
            'name' => 'Processed Wood',
            'type' => 'processed_wood',
            'description' => 'Kiln dried, planed, laminated, and finger joint timber ready for production.',
            'children' => ['Kiln Dried Lumber', 'Laminated Panels', 'Finger Joint Timber'],
        ],
        [
            'name' => 'Custom Sizes',
            'type' => 'custom',
            'description' => 'Cut-to-size components and profiles produced against a customer specification.',
            'children' => ['Cut-to-size', 'Custom Profiles'],
        ],
    ];

    public function run(): void
    {
        $sortOrder = 0;

        foreach ($this->categories as $item) {
            $parent = ProductCategory::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'parent_id' => null,
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'description' => $item['description'],
                    'sort_order' => $sortOrder++,
                    'is_active' => true,
                ],
            );

            foreach ($item['children'] ?? [] as $index => $childName) {
                ProductCategory::updateOrCreate(
                    ['slug' => Str::slug($item['type'].' '.$childName)],
                    [
                        'parent_id' => $parent->id,
                        'name' => $childName,
                        'type' => $item['type'],
                        'description' => null,
                        'sort_order' => $index,
                        'is_active' => true,
                    ],
                );
            }
        }
    }
}
