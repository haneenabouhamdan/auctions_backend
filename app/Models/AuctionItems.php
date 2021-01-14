<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionItems extends Model
{
    use HasFactory;
    public function auctionCatgories()
    {
        return $this->belongsTo(AuctionCategories::class);
    }
    public function auctionImages()
    {
        return $this->hasMany(AuctionImages::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function favorites(){
        return $this->hasMany(Favorites::class);
    }
    public function scopeArea($query,$area_min,$area_max){
        if($area_min!='a' && $area_max!='a'){
            return $query->where('area','<',$area_max)->where('area','>',$area_min);
        }
        return $query;
    }
    public function scopeCategory($query,$category){
        if($category!='a'){
            return $query->where('preffered_price','=',$category);
        }
        return $query;
    }
    public function scopeBaths($query,$baths){
        if($baths!='a'){
            return $query->where('bathrooms','>',$baths);
        }
        return $query;
    }
    public function scopeBeds($query,$beds){
        if($beds!='a'){
            return $query->where('bedrooms','>',$beds);
        }
        return $query;
    }
    public function scopeType($query,$array){
        $length=count($array);
        if($length>0){
            return $query->orWhere('type',$array[((int)$length) - 1])->type(array_pop($array));
        }
        return $query;
    }
    public function scopeElec($query,$electricity){
        if($electricity!='a'){
            return $query->where('electricity','=',$electricity);
        }
        return $query;
    }
    public function scopeElev($query,$elevator){
        if($elevator!='a'){
            return $query->where('elevator','=',$elevator);
        }
        return $query;
    }
    public function scopeParking($query,$parking){
        if($parking!='a'){
            return $query->where('parking','=',$parking);
        }
        return $query;
    }
    public function scopeCat($query,$cat){
        if($cat!='a'){
            return $query->where('auction_categories_id','=',$cat);
        }
        return $query;
    }
}
