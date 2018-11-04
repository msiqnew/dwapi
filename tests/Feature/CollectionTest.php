<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollectionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostingData_createsCollection()
    {
        $data = [
            'name' => $this->faker->word,
            'size' => $this->faker->randomElement([24, 28, 32, 40]),
        ];
        $this->post('api/collections', $data)
            ->assertStatus(201)
            ->assertJson(['data' => $data]);
    }

    public function testGetProduct()
    {
        $cont = $this->get('api/collections/23')
            ->assertStatus(200)
            ->getContent();

        dump($cont);
    }

}
