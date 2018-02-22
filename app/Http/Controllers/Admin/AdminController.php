<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $clients = count($clients = Client::all());

        //dump($items);die;

    	return view('admin.home.index')->with(compact('clients'));
    }
}
