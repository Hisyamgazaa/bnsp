<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
  protected $fillable = [
    'user_id',
    'order_number',
    'total_amount',
    'shipping_address',
    'phone_number',
    'notes'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function items(): HasMany
  {
    return $this->hasMany(OrderItem::class);
  }

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($order) {
      $order->order_number = 'ORD-' . date('Ymd') . '-' . str_pad(random_int(1, 999), 3, '0', STR_PAD_LEFT);
    });
  }
}
