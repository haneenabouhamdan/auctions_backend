<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interests;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InterestsController extends Controller
{
    //
    public function add_interest(Request $request){
        $item = new Interests;
        if($request->get('type')!='a')
        $item->type=$request->get('type');
        if($request->get('category')!='a')
        $item->category=$request->get('category');
        if($request->get('area')!='a')
        $item->area=$request->get('area');
        if($request->get('longitude')!='a')
        $item->longitude= $request->get('longitude');
        if($request->get('latitude')!='a')
        $item->latitude= $request->get('latitude');
        if($request->get('category')!='a')
        $item->category= $request->get('category');
        $item->users_id= Auth::id();
        $item->save();
        return response()->json(['item'=>$item]);
    }
    public function get_interests(){
        $items= Interests::where('users_id','=',Auth::id())
        ->orderBy('created_at','DESC')->get();
        return response()->json(['items'=>$items]);
    }
    public function del_interest(Request $request){
        $items= Interests::where('id','=',$request->get('id'))->delete();
        
        return response()->json(['items'=>$items]);
    }
}
