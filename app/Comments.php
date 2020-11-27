<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function customers()
    {
        return $this->belongsTo('App\Contact','contact_id');
    }
}
