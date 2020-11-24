<?php

namespace App\Http\Controllers;

use App\Utils\Util;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

class RoomController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    public function get_room()
    {
        echo 'dff';
        die();
    }
}
