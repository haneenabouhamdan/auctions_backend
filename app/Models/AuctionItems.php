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
    public function auctionImagess()
    {
        return $this->hasMany(AuctionImages::class);
    }
}
