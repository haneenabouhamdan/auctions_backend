<?php

namespace App\Http\Controllers;
use App\Models\Winner;
use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WinnerController extends Controller
{
    public function add_winner(Request $request){
        $item = new Winner;
        $item->winners_id=$request->get('Winner');
        $item->item_id=$request->get('item_id');
        $item->price=$request->get('price');
        $item->save();
        return json_encode($item);
    }
   public function get_winner($id){
       $item = Winner::where('item_id','=',$id)->get();
       return response()->json(['item'=>$item]);
   }
   public function getCountWins(){
    $item = Winner::where('winners_id','=',Auth::id())->count();
    return response()->json(['item'=>$item]);
}
    
}