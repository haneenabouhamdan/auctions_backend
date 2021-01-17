<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function auctionItems()
    {
        return $this->belongsTo(AuctionItems::class,'item_id');
    }
    
}