<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
protected $fillable = [
        'user_id',
        'name',
        'phoneno',
        'province',
        'district',
        'city',
        'postalcode',
        'streetaddress',
        'total',
        'status',
        'invoice',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}