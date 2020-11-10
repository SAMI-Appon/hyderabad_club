<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Service extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $table = 'services';
    protected $guarded = ['id'];
}
