<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name','price' , 'department_id' , 'doctor_id','status','status_date',
    ];

    public function getDepartment(){
    	return $this->belongsTo('App\Model\Department', 'department_id', 'id');
    }

    public function getDoctor(){
    	return $this->belongsTo('App\Model\Doctor', 'doctor_id', 'id');
    }

}
