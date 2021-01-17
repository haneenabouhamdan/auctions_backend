<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function edit_profile($request){

        $user = User::findOrFail(Auth::id());
        
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->balance = $request->get('balance');
        $user->email = $request->get('email');
        $user->country = $request->get('country');
        $suer->state = $request->get('state');
        $user->password = $request->get('password');

        $user->save();

        return json_encode($user);
    }
    public function add_fav(Request $request){
        $fav = new Favorites;
        $fav->auction_items_id = $request->get('auction_id');
        $fav->user_id = Auth::id();
        $fav->save();
        return response()->json(['item'=>$fav]);
    }
  
    public function uploadimage(Request $request)
    {
        $user = User::findOrFail(Auth::id());
           
      //check file
      if ($request->hasFile('image'))
      {
            $file      = $request->file('image');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = date('His').'-'.$filename;
            //move image to public/img folder
            $file->move(public_path('ProfilePictures'), $picture);
            $user->image='/ProfilePictures'.'/'.$picture;
            $user->save();
            return response()->json(["message" => "Image Uploaded Succesfully"]);
      } 
      else
      {
            return response()->json(["message" => "Select image first."]);
      }
    }
    public function getUser($owner_id){
        $owner = User::findOrFail($owner_id);
        return response()->json(["user"=>$owner]);
    }
    public function getUseer($id){
        $item = User::findOrFail($id);
        return response()->json(["user"=>$item]);
    }
    public function getAllEmails(){
        $emails= User::Where('id','!=',Auth::id())
                    ->get('email');
        return response()->json(['emails'=>$emails]);
    }
    public function getUserByFullname(Request $request){
        $email=User::where('first_name','=',$request->get('fname'))
        ->where('last_name','=',$request->get('lname'))->get('email');
        return response()->json(['email'=>$email]);
    }
    public function getEmail($id){
        $email=User::where('id','=',$id)->get('email');
        return response()->json(['email'=>$email]);
    }
   
}
