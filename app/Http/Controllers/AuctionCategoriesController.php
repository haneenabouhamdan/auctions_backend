<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuctionCategories;

class AuctionCategoriesController extends Controller
{
    //
    public function getHomesCategories(){
        $categories= AuctionCategories::Where('Flag',0)->orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories]);
    }
    public function getLandsCategories(){
        $categories= AuctionCategories::Where('Flag',1)->orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories]);
    }
}
