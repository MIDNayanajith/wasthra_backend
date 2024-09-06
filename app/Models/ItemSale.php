<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    use HasFactory;

    protected $table = 'itemsale';
    protected $primaryKey = 'sale_id';

    protected $fillable = [
        'sale_id',
        'item_name',
        'customer_name',
        'qty',
        'date',
        'unit_price',
        'total_amount'
    ];
}
