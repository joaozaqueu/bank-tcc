<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Product extends Model
{
    use Eloquence;

    protected $searchableColumns = ['name'];

    protected $fillable = [
        'name', 'description', 'price', 'stocked'
    ];

    public function SaleHasProduct(){
        return $this->hasMany(SaleHasProduct::class);
    }
}
