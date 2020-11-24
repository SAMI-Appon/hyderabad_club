<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public static function forDropdown($type)
    {
        $Rooms = Rooms::where('type', $type)->pluck('name', 'id');
        return $Rooms;
    }
}
