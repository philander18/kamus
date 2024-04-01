<?php

namespace App\Controllers;

use App\Models\KamusModel;
use DateTime;

class Kamus extends BaseController
{
    protected $KamusModel;
    public function __construct()
    {
        $this->KamusModel = new KamusModel();
    }
    public function index()
    {
        return view('Templates/index');
    }
}
