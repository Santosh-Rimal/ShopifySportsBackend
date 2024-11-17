<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Category;
use App\Models\UserView;
use App\Models\RatingReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
    'name',
    'description',
    'price',
    'image',
    'category_id',
    'discount',
    'discount_start_date',
    'discount_end_date'
];


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


    public function userViews()
{
    return $this->hasMany(UserView::class);
}

    public function getIsDiscountActiveAttribute()
{
    $today = Carbon::today();

    // Check if the current date is within the discount period
    if ($this->discount && $this->discount_start_date && $this->discount_end_date
        && $today->between($this->discount_start_date, $this->discount_end_date)) {
        return true;
    }

    // If today is outside the discount period, set discount to 0
    $this->discount = 0;
    $this->save();

    return false;
}


}