<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PushNotifications extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'push_notifications';

    public function customers()
    {
        return $this->belongsTo('App\Contact','user_id');
    }
}
