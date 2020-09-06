<?php

namespace App\Http\Controllers;

use App\Client;
use App\Services\SunatService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index () {
        return view('client.index');
    }

    public function create () {
        $client = new Client;
        $btnText = __("Registrar cliente");
        return view('client.form', compact('client', 'btnText'));
    }

    public function store (Request $request) {

        Client::create([
            'document_number' => $request->document_number,
            'title' => $request->title
        ]);

        return redirect( route('clients.index') )
            ->with('message', __("Cliente registrado correctamente"));
    }

    public function destroy (Client $client) {
        $client->delete();
        return redirect( route('clients.index') )
            ->with('message', __("Cliente eliminado correctamente"));
    }

    public function datatable () {
        $clients = Client::get();
        return \DataTables::of($clients)
            ->addColumn('actions', 'client.datatable.actions')
            ->rawColumns(['actions'])
            ->toJson();
        return view('client.index', compact('clients'));
    }

    public function sunat(Request $request) {
        if(request()->ajax()) {
            $sunatService = resolve(SunatService::class);
            $response = $sunatService->sunatRuc($request->document);
            return response()->json($response, 200);
        }
        return abort(401);
    }
}
