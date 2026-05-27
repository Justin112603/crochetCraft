<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id', 
        'product_id', 
        'quantity', 
        'price', 
        'subtotal',
        'commission',
        'total',
        'payment_method',
        'status',
        'image',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'commission' => 'decimal:2',
        'total' => 'decimal:2',
        'withdrawn_at' => 'datetime',
    ];

    // USER RELATIONSHIP
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ORDER ITEMS
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}