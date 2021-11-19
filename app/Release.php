<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $table = 'Release';
    protected $primaryKey = 'id_form';
    protected $fillable=['id_form','title'];

}