<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    public function testProductCreateTest()
    {
        $data = [
            'name' => 'Coca-cola 600ml',
            'description' => 'refri   gerante lata - coca cola',
            'price' => "2,90 nezez ",
            'stocked' => true
        ];

        $product = $this->createProduct($data);

        print_r($product);die;

        $this->assertEquals($product->getId(), $product);
    }

    private function createProduct($data)
    {
        $product = new ProductService();

        return $product->create($data);
    }
}