<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'address_to',
        'address_from',
        'status',
        'courier_id',
        'order_date'
    ];

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }
}
