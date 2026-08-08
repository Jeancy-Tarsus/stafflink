<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Contrat;
use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::with([
            'contrat.affectation.demande.client',
            'contrat.affectation.travailleur'
        ])
            ->latest()
            ->paginate(10);

        $contrats = Contrat::with([
            'affectation.demande.client',
            'affectation.travailleur'
        ])
            ->where('statut', 'Actif')
            ->get();

        return view('paiements.index', compact(
            'paiements',
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
    public function store(StorePaiementRequest $request)
    {
        $contrat = Contrat::findOrFail($request->contrat_id);

        // Vérifier le reste à payer
        if ($request->montant > $contrat->reste_a_payer) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Le montant dépasse le salaire restant à payer.'
                );
        }

        $data = $request->validated();

        $numero = Paiement::max('id') + 1;

        $data['reference'] =
            'PAY-' .
            date('Y') .
            '-' .
            str_pad($numero, 4, '0', STR_PAD_LEFT);

        Paiement::create($data);

        return redirect()
            ->route('paiements.index')
            ->with(
                'success',
                'Paiement enregistré avec succès.'
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
    public function update(UpdatePaiementRequest $request, Paiement $paiement)
    {
        $contrat = $paiement->contrat;

        // Total payé sans ce paiement
        $totalSansPaiement = $contrat->paiements()
            ->where('id', '!=', $paiement->id)
            ->sum('montant');

        $resteAutorise = $contrat->salaire - $totalSansPaiement;

        if ($request->montant > $resteAutorise) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Le montant dépasse le salaire restant à payer.'
                );
        }

        $paiement->update($request->validated());

        return redirect()
            ->route('paiements.index')
            ->with(
                'success',
                'Paiement modifié avec succès.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Paiement $paiement)
{
    try {

        $paiement->delete();

        return redirect()
            ->route('paiements.index')
            ->with(
                'success',
                'Paiement supprimé avec succès.'
            );

    } catch (\Exception $e) {

        return redirect()
            ->route('paiements.index')
            ->with(
                'error',
                'Une erreur est survenue.'
            );

    }
}
}
