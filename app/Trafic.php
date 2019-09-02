<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trafic extends Model
{
    protected $table = 'trafics';

    public function BDCOMall()
    {
        return $this->belongsTo('App\BDCOMall', 'dbcom_id', 'id');
    }
}
