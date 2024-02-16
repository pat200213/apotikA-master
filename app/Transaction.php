<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function buyer(){
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function medicine(){
        return $this->hasMany('App\Medicine', 'medicine_id', 'id');
    }

    public function insertProduct($cart, $user){
        $total = 0;
        foreach($cart as $id => $detail){
            $total += $detail['price'] * $detail['quantity'];
            $this->medicines()->attach($id, ['quantity' => $detail['quantity'], 'subtotal' => $detail['price']]); 
        }

        return $total;
    }

    public $timestamps = false;
}
