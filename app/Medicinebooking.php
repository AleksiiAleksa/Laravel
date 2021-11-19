<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicinebooking extends Model
{
    protected $table = 'Medicinebooking';
    protected $primaryKey = 'id_medicine_booking';
    protected $fillable=['id_medicine_booking','medicine_id','user_id', 'amount'];
    
    public function medicine()
    {
    return $this->belongsTo('App\Medicine', 'medicine_id');
    }
    
    public function user()
    {
    return $this->belongsTo('App\User', 'user_id');
    }
    
}