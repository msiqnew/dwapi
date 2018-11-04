<?php

namespace Tests\Feature\App\test\services;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testImportProductsCollections_imports()
    {
        $data = [
            [
                'collection' => 'classic',
                'size' => 28,
                'products' => [
                    [
                        'image' => 'classic-28-black.png',
                        'name' => 'Classic 28mm (Black)',
                        'sku' => 'C99900200'
                    ],
                    [
                        'image' => 'classic-28-red.png',
                        'name' => 'Classic 28mm (Red)',
                        'sku' => 'C99900201'
                    ],
                ]
            ],
            [
                'collection' => 'not so classic',
                'size' => 32,
                'products' => [
                    [
                        'image' => 'not-so-classic-32-black.png',
                        'name' => 'NoClassic 32mm (Black)',
                        'sku' => 'C99900300'
                    ],
                    [
                        'image' => 'not-so-classic-32-red.png',
                        'name' => 'NoClassic 32mm (Red)',
                        'sku' => 'C99900301'
                    ],
                ]
            ],
        ];

        $this->json('POST', 'api/import', $data)
            ->assertStatus(201);

        // test if product added in db
    }
}
