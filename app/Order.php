<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function detail() {
        return $this->hasMany('App\OrderDetail', 'order_id', 'id');
    }

    public function meja() {
        return $this->belongsTo('App\Meja');
    }

    public function pelanggan() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transaction() {
        return $this->hasOne('App\Transaction','order_id', 'id');
    }
}
