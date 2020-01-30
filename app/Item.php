<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    public function category2()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }
}
