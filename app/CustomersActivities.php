<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomersActivities extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function customers()
    {
        return $this->belongsTo('App\Contact','customer_id');
    }
    public function services()
    {
        return $this->belongsTo('App\Service','service_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
   
}
