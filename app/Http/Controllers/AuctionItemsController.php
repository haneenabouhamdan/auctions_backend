<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ImagesController;
use Illuminate\Http\Request;
use App\Models\AuctionItems;
use App\Models\User;
use App\Models\Favorites;
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
        $item->preffered_price = $request->get('category');
        $item->longitude = $request->get('longitude');
        $item->latitude = $request->get('latitude');
        $item->auction_categories_id = $request->get('auction_categories_id');
        $item->users_id = Auth::id();
        $item->save();
        $this->ImagesController->add_images($request->get('images'),$item->id);
        return response()->json(['item'=>$item->id,'owner'=>$item->users_id]);

    }
    public function getResidentialItems(){
        $item= AuctionItems::Where('users_id','!=',Auth::id())
            ->Where('actual_close_date','=',null)
            ->Where(function($query){
            $query->Where('auction_categories_id',1)
                ->orWhere('auction_categories_id',4);
             })
                ->orderBy('created_at','desc')
                ->with('auctionImages')
                ->paginate(10);
        return response()->json(['items'=>$item]);
    }
    public function getFavItems(){
       $item = AuctionItems::with('auctionImages')
       ->whereHas('favorites',
       function($query){
           $query->where('user_id',Auth::id());
       })->paginate(10);
        return response()->json(['items'=>$item]);
    }
    public function removeFavItems(Request $request){
        $item = Favorites::where('auction_items_id','=',$request->get('auction_id'))->delete();
        return response()->json(["Deleted"]);
    }
    public function removeItems(Request $request){
        $item = AuctionItems::where('id','=',$request->get('auction_id'))->delete();
        return response()->json(["Deleted"]);
    }
    public function getCommercialItems(){
        $item= AuctionItems::Where('users_id','!=',Auth::id())
        ->Where('actual_close_date','=',null)
         ->Where(function($query){
            $query->Where('auction_categories_id',2)
                ->orWhere('auction_categories_id',4);
             })
        ->orderBy('created_at','desc')
        ->with('auctionImages')
        ->paginate(10);
        return response()->json(['items'=>$item]);
    }
    public function getIndustrialItems(){
        $item= AuctionItems::Where('users_id','!=',Auth::id())
        ->Where('actual_close_date','=',null)
        ->Where(function($query){
           $query->Where('auction_categories_id',3)
               ->orWhere('auction_categories_id',4);
            })
        ->orderBy('created_at','desc')
        ->with('auctionImages')
        ->paginate(10);
        return response()->json(['items'=>$item]);
    }
    public function getOthersItems(){
        $item= AuctionItems::Where('auction_categories_id','=',4)
        ->Where('users_id','!=',Auth::id())
        ->Where('actual_close_date','=',null)
        ->orderBy('created_at','desc')
        ->with('auctionImages')
        ->paginate(10);
        return response()->json(['items'=>$item]);
    }
    public function getAllItems(){
        $items=AuctionItems::Where('users_id',Auth::id())
                            ->with('auctionImages')->orderBy('created_at','DESC')->paginate(10);
        return response()->json(['items'=>$items]);

    }
    public function getAllOtherItems(){
        $items=AuctionItems::Where('users_id','!=',Auth::id())
                            ->Where('actual_close_date','=',null)
                            ->with('auctionImages')->paginate(10);
        return response()->json(['items'=>$items]);

    }
   
    public function getCount(){
        $num = AuctionItems::where('users_id','=',Auth::id())->count();
        return response()->json(['item'=>$num]);
    }
    public function getFavCount(){
        $num = Favorites::where('user_id','=',Auth::id())->count();
        return response()->json(['item'=>$num]);
    }
    public function getItem(){
       $num = AuctionItems::latest()->first();;
        return response()->json(['item'=>$num]);
    }
     public function closeAuc(Request $request)
    {
        $item = AuctionItems::findOrFail($request->get('auction_id'));
        $item->actual_close_date = $request->get('closeDate');
        $item->save();
        return json_encode($item);
    }
   
}