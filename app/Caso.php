<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    protected $fillable=['familia','direccion','user_id','lat','lng'];
}
