<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // Recherche
        if ($request->filled('recherche')) {

            $recherche = $request->recherche;

            $query->where(function ($q) use ($recherche) {

                $q->where('nom', 'like', "%{$recherche}%")
                    ->orWhere('responsable', 'like', "%{$recherche}%")
                    ->orWhere('telephone', 'like', "%{$recherche}%")
                    ->orWhere('ville', 'like', "%{$recherche}%");
            });
        }

        // Filtre par type
        if ($request->filled('type')) {

            $query->where('type', $request->type);
        }

        // Filtre par statut
        if ($request->filled('actif')) {

            $query->where('actif', $request->actif);
        }

        $clients = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Enregistrer un nouveau client
     */
    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Modifier un client
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client modifié avec succès.');
    }

    /**
     * Supprimer un client
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
