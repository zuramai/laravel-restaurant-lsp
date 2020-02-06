<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function masakan() {
        return $this->belongsTo('App\Masakan');
    }
}
