<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncaissementRequest;
use App\Http\Requests\UpdateEncaissementRequest;
use App\Models\Encaissement;
use App\Models\Facture;
use Illuminate\Http\Request;

class EncaissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $encaissements = Encaissement::with('facture.contrat.affectation.demande.client')
            ->latest()
            ->paginate(10);

        $factures = Facture::where('statut', '!=', 'Payée')->get();

        return view('encaissements.index', compact(
            'encaissements',
            'factures'
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
    public function store(StoreEncaissementRequest $request)
    {
        $facture = Facture::findOrFail($request->facture_id);

        // Vérifier le reste à payer
        if ($request->montant > $facture->reste) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Le montant dépasse le reste à payer de cette facture.'
                );
        }

        $data = $request->validated();

        $numero = Encaissement::max('id') + 1;

        $data['reference'] =
            'ENC-' .
            date('Y') .
            '-' .
            str_pad($numero, 4, '0', STR_PAD_LEFT);

        Encaissement::create($data);

        // Mise à jour du statut de la facture
        $facture->mettreAJourStatut();

        return redirect()
            ->route('encaissements.index')
            ->with(
                'success',
                'Encaissement enregistré avec succès.'
            );
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
    public function update(UpdateEncaissementRequest $request, Encaissement $encaissement)
    {
        $facture = $encaissement->facture;

        // Calcul du reste en excluant cet encaissement
        $totalSansCetEncaissement = $facture->encaissements()
            ->where('id', '!=', $encaissement->id)
            ->sum('montant');

        $resteAutorise = $facture->montant - $totalSansCetEncaissement;

        if ($request->montant > $resteAutorise) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Le montant dépasse le reste à payer.'
                );
        }

        $encaissement->update($request->validated());

        $facture->mettreAJourStatut();

        return redirect()
            ->route('encaissements.index')
            ->with(
                'success',
                'Encaissement modifié avec succès.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Encaissement $encaissement)
    {
        $facture = $encaissement->facture;

        $encaissement->delete();

        $facture->mettreAJourStatut();

        return redirect()
            ->route('encaissements.index')
            ->with(
                'success',
                'Encaissement supprimé avec succès.'
            );
    }
}
