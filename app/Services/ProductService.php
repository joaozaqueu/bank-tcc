<?php
/**
 * Created by PhpStorm.
 * User: linuxlite
 * Date: 3/20/18
 * Time: 11:13 PM
 */

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $price = $this->replaceValue($data['price']);
         
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $price
        ]);

        return $product;
    }

    private function replaceValue($value)
    {
        return str_replace(',', '.', $value);
    }

}