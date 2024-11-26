<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnerShipController extends Controller
{
    public function index()
    {
        return view('partnership.index');
    }
}
