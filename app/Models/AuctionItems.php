<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionItems extends Model
{
    use HasFactory;
    public function auctionCatgories()
    {
        return $this->belongsTo(AuctionCategories::class);
    }
    public function auctionImages()
    {
        return $this->hasMany(AuctionImages::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function favorites(){
        return $this->hasMany(Favorites::class);
    }
}
