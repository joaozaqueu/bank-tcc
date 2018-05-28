<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'client_id', 'due_date', 'payment'
    ];

    public function client() {
        return $this->belongsToMany(Client::class);
    }

    public function saleHasProduct() {
        return $this->hasMany(SaleHasProduct::class);
    }
}
