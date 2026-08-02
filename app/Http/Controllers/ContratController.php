<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Affectation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContratRequest;
use App\Http\Requests\UpdateContratRequest;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contrats = Contrat::with([
            'affectation.demande.client',
            'affectation.travailleur'
        ])
            ->latest()
            ->paginate(10);

        $affectations = Affectation::with([
            'demande.client',
            'travailleur'
        ])
            ->whereDoesntHave('contrat')
            ->get();

        return view('contrats.index', compact(
            'contrats',
            'affectations'
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
    public function store(StoreContratRequest $request)
    {
        $data = $request->validated();

        $dernierId = Contrat::max('id') + 1;

        $data['reference'] =
            'CTR-' .
            date('Y') .
            '-' .
            str_pad($dernierId, 4, '0', STR_PAD_LEFT);

        $data['statut'] = 'Actif';

        Contrat::create($data);

        return redirect()
            ->route('contrats.index')
            ->with('success', 'Contrat créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateContratRequest $request,
        Contrat $contrat
    ) {
        $contrat->update(
            $request->validated()
        );

        return redirect()
            ->route('contrats.index')
            ->with('success', 'Contrat modifié avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return redirect()
            ->route('contrats.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }
}
