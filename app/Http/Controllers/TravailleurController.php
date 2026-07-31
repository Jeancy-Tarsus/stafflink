<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTravailleurRequest;
use App\Http\Requests\UpdateTravailleurRequest;
use App\Models\Metier;
use App\Models\Travailleur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TravailleurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $travailleurs = Travailleur::with('metier')
    //         ->latest()
    //         ->paginate(10);

    //     $metiers = Metier::orderBy('nom')->get();

    //     return view('travailleurs.index', compact('travailleurs', 'metiers'));
    // }
    public function index(Request $request)
    {
        $query = Travailleur::with('metier');

        // Recherche
        if ($request->filled('recherche')) {

            $recherche = $request->recherche;

            $query->where(function ($q) use ($recherche) {

                $q->where('nom', 'like', "%{$recherche}%")
                    ->orWhere('prenom', 'like', "%{$recherche}%")
                    ->orWhere('telephone', 'like', "%{$recherche}%");
            });
        }

        // Filtre métier
        if ($request->filled('metier')) {

            $query->where('metier_id', $request->metier);
        }

        // Filtre disponibilité
        if ($request->disponibilite != '') {

            $query->where('disponible', $request->disponibilite);
        }

        $travailleurs = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $metiers = Metier::orderBy('nom')->get();

        return view('travailleurs.index', compact(
            'travailleurs',
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
    public function store(StoreTravailleurRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('travailleurs', 'public');
        }

        Travailleur::create($data);

        return redirect()
            ->route('travailleurs.index')
            ->with('success', 'Travailleur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travailleur $travailleur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travailleur $travailleur)
    {
        //
    }

    /**
     * Modifier un travailleur
     */
    public function update(UpdateTravailleurRequest $request, Travailleur $travailleur)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {

            if (
                $travailleur->photo &&
                Storage::disk('public')->exists($travailleur->photo)
            ) {

                Storage::disk('public')->delete($travailleur->photo);
            }

            $data['photo'] = $request->file('photo')
                ->store('travailleurs', 'public');
        }

        $travailleur->update($data);

        return redirect()
            ->route('travailleurs.index')
            ->with('success', 'Travailleur modifié avec succès.');
    }

    /**
     * Supprimer un travailleur
     */
    public function destroy(Travailleur $travailleur)
    {
        if (
            $travailleur->photo &&
            Storage::disk('public')->exists($travailleur->photo)
        ) {

            Storage::disk('public')->delete($travailleur->photo);
        }

        $travailleur->delete();

        return redirect()
            ->route('travailleurs.index')
            ->with('success', 'Travailleur supprimé avec succès.');
    }
}
