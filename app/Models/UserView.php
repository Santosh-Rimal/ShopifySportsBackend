<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserView extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'user_views';

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id', 
        'product_id'
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}