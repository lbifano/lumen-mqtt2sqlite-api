<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mqtt extends Model
{
    protected $table = 'mqtt_history_view';
    public $timestamps = false;
    protected $casts = [
        'value' => 'array'
    ];
    protected $fillable = ['id','ts','ts_last','topic','value'];
}