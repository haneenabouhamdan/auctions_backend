<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ImagesController;
use Illuminate\Http\Request;
use App\Models\AuctionItems;
use Illuminate\Support\Facades\Auth;

class AuctionItemsController extends Controller
{
    protected $ImagesController;
    public function __construct(ImagesController $ImagesController){
        $this->ImagesController = $ImagesController;
    }

    public function add_item(Request $request){
        $item = new AuctionItems;
        $item->start_date = $request->get('start_date');
        $item->planned_close_date = $request->get('planned_close_date');
        $item->type = $request->get('type');
        $item->final_price=$request->get('final_price');
        $item->area = $request->get('area');
        $item->description = $request->get('description');
        $item->bedrooms = $request->get('bedrooms');
        $item->bathrooms = $request->get('bathrooms');
        $item->diningrooms = $request->get('diningrooms');
        $item->Balcony = $request->get('Balcony');
        $item->parking = $request->get('parking');
        $item->elevator = $request->get('elevator');
        $item->electricity = $request->get('electricity');
        $item->heating_cooling = $request->get('heating_cooling');
        $item->starting_price = $request->get('starting_price');
        $item->preffered_price = $request->get('preffered_price');
        $item->longitude = $request->get('longitude');
        $item->latitude = $request->get('latitude');
        $item->category_id = $request->get('category_id');
        $item->user_id = Auth::id();
        $item->save();
        return $this->ImagesController->add_images($request->get('images'),$item->id);
        return response()->json(['item'=>$request]);

    }
    public function getResidentialItems(){
        $categories= AuctionItems::Where('category_id','1')->orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories]);
    }
    public function getCommercialItems(){
        $categories= AuctionItems::Where('category_id','2')->orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories]);
    }
    public function getIndustrialItems(){
        $categories=AuctionItems::Where('category_id','3')->orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories]);
    }
    public function getOthersItems(){
        $categories=AuctionItems::Where('category_id','4')->orderBy('created_at','desc')->get();
        return response()->json(['categories'=>$categories]);
    }
}