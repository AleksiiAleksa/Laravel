<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'Cart';
    protected $primaryKey = 'id_cart';
    protected $fillable=['id_cart','medicine_id','user_id', 'amount'];
    
    public function medicine()
    {
    return $this->belongsTo('App\Medicine', 'medicine_id');
    }
    
    public function user()
    {
    return $this->belongsTo('App\User', 'user_id');
    }
    
}