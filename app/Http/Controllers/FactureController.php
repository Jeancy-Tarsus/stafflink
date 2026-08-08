<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Contrat;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::with([
            'contrat.affectation.demande.client',
            'contrat.affectation.travailleur'
        ])

            ->latest()
            ->paginate(10);

        // Contrats qui n'ont pas encore de facture
        $contrats = Contrat::with([
            'affectation.demande.client',
            'affectation.travailleur'
        ])
            ->whereDoesntHave('facture')
            ->get();

        return view('factures.index', compact(
            'factures',
            'contrats'
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
    public function store(StoreFactureRequest $request)
    {
        $data = $request->validated();

        $dernierId = Facture::max('id') + 1;

        $data['reference'] =
            'FAC-' .
            date('Y') .
            '-' .
            str_pad($dernierId, 4, '0', STR_PAD_LEFT);

        $data['statut'] = 'Non payée';

        Facture::create($data);

        return redirect()
            ->route('factures.index')
            ->with('success', 'Facture créée avec succès.');
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
    public function update(UpdateFactureRequest $request, Facture $facture)
    {
        $facture->update($request->validated());

        return redirect()
            ->route('factures.index')
            ->with('success', 'Facture modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture)
    {
        try {

            $facture->delete();

            return redirect()
                ->route('factures.index')
                ->with(
                    'success',
                    'Facture supprimée avec succès.'
                );
        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()
                ->route('factures.index')
                ->with(
                    'error',
                    'Impossible de supprimer cette facture car elle possède déjà des encaissements.'
                );
        } catch (\Exception $e) {

            return redirect()
                ->route('factures.index')
                ->with(
                    'error',
                    'Une erreur est survenue.'
                );
        }
    }
}
