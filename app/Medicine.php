<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'Medicine';
    protected $fillable=['id_medicine','title','image', 'maker_id', 'form_id', 'dosage', 'amount', 'testimony', 'category_id'];
    protected $primaryKey = 'id_medicine';
    
    public function maker()
    {
    return $this->belongsTo('App\Maker', 'maker_id');
    }
    
    public function release()
    {
    return $this->belongsTo('App\Release', 'form_id');
    }
    
    public function category()
    {
      return $this->belongsTo('App\Category', 'category_id'); 
    }
}