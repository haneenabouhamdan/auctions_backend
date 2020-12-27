<?php

namespace App\Http\Controllers;
use App\Models\AuctionImages;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function add_images($images,$itemId){
        $num=count($images);
        for($i= 0 ;$i < $num; $i++){
            $img = new AuctionImages;
            $img->path=$images[$i]['dataURL'];
            $img->auction_items_id=$itemId;
            $img->save();
        }
    }
}