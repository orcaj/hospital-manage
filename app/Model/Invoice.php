<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'civil_id','service_id' ,
    ];

    public function getService(){
    	return $this->belongsTo('App\Model\Service', 'service_id', 'id');
    }

    public function getPatient(){
    	return $this->belongsTo('App\Model\Patient', 'civil_id', 'civil_id');
    }

}
