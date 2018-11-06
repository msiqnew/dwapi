<?php

namespace Tests\Unit\App\services;

use App\Exceptions\CollectionsException;
use App\Exceptions\ProductsException;
use App\Repository\CollectionRepository;
use App\Repository\ProductRepository;
use App\Services\ImportService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportServiceTest extends TestCase
{
    use RefreshDatabase;

    private $importService;

    public function __construct()
    {
        parent::__construct();
        $this->importService = new ImportService(
            $this->createMock(ProductRepository::class),
            $this->createMock(CollectionRepository::class)
        );
    }

    public function testImportProductsCollections_throwsCollectionException_onBadCollectionData()
    {
        $this->expectException(CollectionsException::class);
        $this->expectExceptionMessage(CollectionsException::UNPROCESSABLE_DATA);
        $this->expectExceptionCode(CollectionsException::UNPROCESSABLE_DATA_CODE);

        $data = [
            [
                'wrongkey' => 'classic',
                'size' => 28,
                'products' => [
                    [
                        'image' => 'classic-28-black.png',
                        'name' => 'Classic 28mm (Black)',
                        'sku' => 'C99900200'
                    ]
                ]
            ]
        ];

        $this->importService->importProductsCollections($data);
    }

    public function testImportProductsCollections_throwsProductException_onBadProductData()
    {
        $this->expectException(ProductsException::class);
        $this->expectExceptionMessage(ProductsException::UNPROCESSABLE_DATA);
        $this->expectExceptionCode(ProductsException::UNPROCESSABLE_DATA_CODE);

        $data = [
            [
                'name' => 'classic',
                'size' => 28,
                'products' => [
                    [
                        'picture' => 'classic-28-black.png',
                        'thename' => 'Classic 28mm (Black)',
                        'somenumber' => 'C99900200'
                    ]
                ]
            ]
        ];

        $this->importService->importProductsCollections($data);
    }

    /*
     *  TODO:
     * add successful importProductsCollections test
     * add tests for all other methods
     *
    */

}
