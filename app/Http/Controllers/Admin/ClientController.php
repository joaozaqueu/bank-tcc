<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * @return string
     */
    public function clients()
    {
        return view('admin.client.index')->render();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = Client::orderby('id', 'DESC')->paginate(10);
        return response()->json($clients);
    }

    /**
     * @param ClientFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ClientFormRequest $request)
    {
        $client = Client::create($request->all());
        return response()->json($client);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return response()->json($client);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id)->update($request->all());
        return response()->json($client);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return response()->json(['done']);
    }
}
