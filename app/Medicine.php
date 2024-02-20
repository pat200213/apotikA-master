<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['stock','name', 'supplier_id'];

    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction','medicine_id','id');
    }   
    
    public static function showExpensiveMedicine($cat){
        $list_all_medicine = [];

        foreach($cat as $c){
            $list_medicine = [];

            $data = Medicine::where('category_id', $c->id)
                        ->orderBy('price', 'DESC')
                        ->first();

            $list_medicine = [
                'medicines_id'=>$data->id,
                'category_id'=>$c->id,
                'category_name'=>$c->category_name,
                'medicines_name'=>$data->name,
                'price'=>$data->price
            ];

            array_push($list_all_medicine, $list_medicine);

        }

        return $list_all_medicine;
       
    }
}
