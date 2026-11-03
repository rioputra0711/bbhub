<?php

namespace Database\Seeders;

use App\Models\WoodSpecies;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WoodSpeciesSeeder extends Seeder
{
    /**
     * Species referenced by the catalogue and the landing page carousel.
     *
     * @var array<int, array{name: string, scientific_name: string, description: string}>
     */
    private array $species = [
        [
            'name' => 'Teak',
            'scientific_name' => 'Tectona grandis',
            'description' => 'Premium tropical hardwood with golden grain, high natural oil content, and excellent dimensional stability.',
        ],
        [
            'name' => 'Mahogany',
            'scientific_name' => 'Swietenia macrophylla',
            'description' => 'Deep reddish-brown hardwood prized for furniture, doors, and architectural facades.',
        ],
        [
            'name' => 'Sungkai',
            'scientific_name' => 'Peronema canescens',
            'description' => 'Lightweight Indonesian hardwood with a pale, even grain, easy to machine and finish.',
        ],
        [
            'name' => 'Merbau',
            'scientific_name' => 'Intsia bijuga',
            'description' => 'Dense, durable hardwood with strong weather resistance, suited to decking and exterior work.',
        ],
        [
            'name' => 'Bengkirai',
            'scientific_name' => 'Shorea laevis',
            'description' => 'Heavy tropical hardwood from Kalimantan with high durability for exterior slats and structures.',
        ],
        [
            'name' => 'Pine',
            'scientific_name' => 'Pinus merkusii',
            'description' => 'Fast-growing softwood, kiln dried for consistent moisture, suited to slats and secondary components.',
        ],
        [
            'name' => 'Rubberwood',
            'scientific_name' => 'Hevea brasiliensis',
            'description' => 'Plantation hardwood with uniform colour, widely used for furniture and finger joint timber.',
        ],
    ];

    public function run(): void
    {
        foreach ($this->species as $item) {
            WoodSpecies::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'name' => $item['name'],
                    'scientific_name' => $item['scientific_name'],
                    'description' => $item['description'],
                    'is_active' => true,
                ],
            );
        }
    }
}
