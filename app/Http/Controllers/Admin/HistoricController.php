<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Historic;

class HistoricController extends Controller
{
    public function index()
    {
    	return view('admin.historic.index');
    }

    public function historicList()
    {
    	return \Response::json(Historic::all(), 200);
    }
}
