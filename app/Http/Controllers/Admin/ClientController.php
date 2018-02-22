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
     * @var int
     */
    private $client;

    /**
     * @var int
     */
    private $pages = 10;

    /**
     * ClientController constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderby('id', 'DESC')->paginate($this->pages);

        //dump($clients);die;
        return view('admin.client.index', compact('clients'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            Client::create($request->all());

            $notification = array(
                'message' => 'Cadastro efutuado com sucesso!',
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }

        return view('admin.client.form')->render();
    }

    /**
     * @param ClientFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClientFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->client->create($dataForm);

        if ($insert) {
            return redirect()->route('clients.index');
        }
        else {
            return redirect()->route('clients.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Client $client)
    {
        $client = $this->client->find($client)->first();

        return view('admin.client.form', compact('client'))->render();
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        $dataForm = $request->all();

        $client = $this->client->find($client)->first();

        $update = $client->update($dataForm);

        if ($update && $request->ajax()) {
            return redirect()->route('clients.index');
        }
        else {
            return redirect()->route('clients.edit')->with(['errors' => 'Falhar ao editar']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client = Client::find($client)->first();

        try {
            $message = 'Registro excluído com sucesso';
            $status = Response::HTTP_OK;
            $client->delete();
        } catch (\Exception $exception) {
            $message = 'Falha ao excluir este registro';
            $status = Response::HTTP_CONFLICT;
        }

        return Response::create([
            'message' => $message
        ], $status);
    }
}
