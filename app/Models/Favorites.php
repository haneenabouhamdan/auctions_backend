<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Favorites extends Model
{
    use HasFactory;
    public function auction_item()
    {
        return $this->BelongsTo(AuctionItems::class)->with('auctionImages');
    }
   
}