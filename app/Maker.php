<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    protected $table = 'maker';
    protected $primaryKey = 'id_maker';
    protected $fillable=['id_maker','title','address', 'phone','fax','email','website','brief_description'];
}