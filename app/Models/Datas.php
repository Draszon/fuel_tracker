<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    protected $table = 'data';
    protected $fillable = ['date', 'quantity', 'km', 'consumption', 'money', 'location'];
}
