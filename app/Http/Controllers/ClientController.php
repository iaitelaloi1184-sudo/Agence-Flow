<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $search = $request->input('search');

    $clients = Client::when($search, function ($query, $search) {
        return $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('secteur', 'like', "%{$search}%");
    })->get();

    return view('clients.index', compact('clients', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nom'   => 'required|string|max:255',
        'email' => 'nullable|email',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
           ->with('success', 'Client ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client){
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
        'nom' => 'required|string|max:255',
        'secteur' => 'nullable|string|max:255',
        'email' => 'nullable|email',
        'telephone' => 'nullable|string|max:20',
        'ton_communication' => 'nullable|string|max:255',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')
            ->with('success', 'Client modifié avec succès !');
    }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
           ->with('success','Client supprimé.');
    }

    public function search(Request $request)
    {
    $search = $request->input('search');

    $clients = Client::when($search, function ($query, $search) {
        return $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('secteur', 'like', "%{$search}%");
    })->get();

    return view('clients._rows', compact('clients'))->render();
    }
}  


