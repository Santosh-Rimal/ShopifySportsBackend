<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Category;
use App\Models\RatingReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name',
'description',
'price',
'image',
'category_id'];


public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
public function category(){
     return $this->belongsTo(Category::class,'category_id');
}
// Product model
public function cart()
{
    return $this->hasMany(Cart::class);
}


public function ratingReviews()
    {
        return $this->hasMany(RatingReview::class);
    }

}