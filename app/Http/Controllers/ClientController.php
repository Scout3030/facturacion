<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index () {
        return view('client.index');
    }

    public function create () {
        $client = new Client;
        $btnText = __("Crear nuevo cliente");
        return view('clients.form', compact('client', 'btnText'));
    }

    public function datatable () {
        $clients = Client::get();
        return \DataTables::of($clients)
            ->toJson();
        return view('client.index', compact('clients'));
    }
}
