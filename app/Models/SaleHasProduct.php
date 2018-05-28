<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleHasProduct extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'quantity', 'total'
    ];

    /**
     * @param $request
     * @return mixed
     */
    public static function addProductForSale($request)
    {
        $sale = $request->request->getInt('sale');
        $product = $request->request->getInt('product');
        $quantity = $request->request->getInt('quantity');

        $total = $quantity * Product::find($product)->price;

        $saleHasProduct = SaleHasProduct::create([
            'sale_id' => $sale,
            'product_id' => $product,
            'quantity' => $quantity,
            'total' => $total
        ]);

        return $saleHasProduct;
    }

    public function sale()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
