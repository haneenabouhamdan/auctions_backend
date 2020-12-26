<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionImages extends Model
{
    use HasFactory;
    public function auctionItems()
    {
        return $this->belongsTo(AuctionItems::class);
    }
}