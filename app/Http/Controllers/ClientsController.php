<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\EditClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ClientsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:client-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:client-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications;
        $clients = Client::all();
        $user = Auth::user();

        return view('clients.index', compact('clients', 'notifications', 'user'));
    }

    public function store(CreateClientRequest $request)
    {
        $clients = Client::create($request->validated());

        return redirect()->route('clients.index');
    }

    public function create()
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        return view('clients.create', compact('notifications', 'user'))->with('success-create', 'The client added successfully');
    }

    public function show(Client $clients)
    {
        //
    }

    public function edit(Client $client)
    {
        $notifications = auth()->user()->unreadNotifications;
        $user = Auth::user();
        return view('clients.edit', compact('client', 'notifications', 'user'));

    }

    public function update(EditClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('success-edit', 'The client updated successfully');

    }

    public function destroy(Client $client)
    {
        if ($client->tasks()->exists()) {
            return redirect()->back()->with('status', 'Client belongs to task. Cannot delete.');
        } else {
            $client->delete();
        }

        return redirect()->back()->with('success-delete', 'The client deleted successfully');
    }
}
