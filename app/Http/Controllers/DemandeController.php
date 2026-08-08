<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Metier;
use App\Http\Requests\StoreDemandeRequest;
use App\Http\Requests\UpdateDemandeRequest;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Demande::with(['client', 'metier']);

        // Recherche
        if ($request->filled('recherche')) {

            $recherche = $request->recherche;

            $query->where('reference', 'like', "%{$recherche}%")
                ->orWhereHas('client', function ($q) use ($recherche) {

                    $q->where('nom', 'like', "%{$recherche}%");
                });
        }

        // Filtre client
        if ($request->filled('client')) {

            $query->where('client_id', $request->client);
        }

        // Filtre métier
        if ($request->filled('metier')) {

            $query->where('metier_id', $request->metier);
        }

        // Filtre statut
        if ($request->filled('statut')) {

            $query->where('statut', $request->statut);
        }

        $demandes = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $clients = Client::orderBy('nom')->get();

        $metiers = Metier::orderBy('nom')->get();

        return view('demandes.index', compact(
            'demandes',
            'clients',
            'metiers'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Enregistrer une nouvelle demande
     */
    public function store(StoreDemandeRequest $request)
    {
        // Récupération des données validées
        $data = $request->validated();

        // Génération automatique de la référence
        $dernierId = Demande::max('id') + 1;

        $data['reference'] = 'DEM-' .
            date('Y') . '-' .
            str_pad($dernierId, 4, '0', STR_PAD_LEFT);

        // Statut par défaut
        $data['statut'] = 'En attente';

        // Nombre déjà affecté
        $data['nombre_affectes'] = 0;

        // Enregistrement
        Demande::create($data);

        return redirect()
            ->route('demandes.index')
            ->with('success', 'Demande enregistrée avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demande $demande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeRequest $request, Demande $demande)
    {

        $demande->update($request->validated());

        return redirect()
            ->route('demandes.index')
            ->with('success', 'Demande modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        try {

            $demande->delete();

            return redirect()
                ->route('demandes.index')
                ->with(
                    'success',
                    'Demande supprimée avec succès.'
                );
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('demandes.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette demande car elle possède déjà des affectations.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('demandes.index')
                ->with(
                    'error',
                    'Une erreur est survenue.'
                );
        }
    }
}
