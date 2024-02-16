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
}
