<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affectation;
use App\Models\Demande;
use App\Models\Travailleur;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAffectationRequest;
use App\Http\Requests\UpdateAffectationRequest;

class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Affectation::with([
            'demande.client',
            'demande.metier',
            'travailleur'
        ]);

        // Recherche
        if ($request->filled('recherche')) {

            $recherche = $request->recherche;

            $query->where('reference', 'like', "%{$recherche}%")
                ->orWhereHas('travailleur', function ($q) use ($recherche) {

                    $q->where('nom', 'like', "%{$recherche}%")
                        ->orWhere('prenom', 'like', "%{$recherche}%");
                });
        }

        // Filtre statut
        if ($request->filled('statut')) {

            $query->where('statut', $request->statut);
        }

        $affectations = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /* Demandes encore ouvertes*/

        $demandes = Demande::with(['client', 'metier'])
            ->whereColumn('nombre_affectes', '<', 'nombre')
            ->orderByDesc('created_at')
            ->get();

        /*Travailleurs disponibles*/

        $travailleurs = Travailleur::where('disponible', true)
            ->where('actif', true)
            ->orderBy('nom')
            ->get();

        return view(
            'affectations.index',
            compact(
                'affectations',
                'demandes',
                'travailleurs'
            )
        );
    }


    public function travailleursDisponibles(Demande $demande)
    {
        $travailleurs = Travailleur::where('metier_id', $demande->metier_id)
            ->where('disponible', true)
            ->where('actif', true)
            ->orderBy('nom')
            ->get([
                'id',
                'nom',
                'prenom'
            ]);

        return response()->json($travailleurs);
    }

    public function getTravailleurs(Demande $demande)
    {
        $travailleurs = Travailleur::where('metier_id', $demande->metier_id)
            ->where('disponible', true)
            ->where('actif', true)
            ->orderBy('nom')
            ->get([
                'id',
                'nom',
                'prenom'
            ]);

        return response()->json($travailleurs);
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
    public function store(StoreAffectationRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            // Récupération de la demande
            $demande = Demande::findOrFail($data['demande_id']);

            // Vérifier que la demande n'est pas terminée
            if ($demande->nombre_affectes >= $demande->nombre) {

                return redirect()
                    ->route('affectations.index')
                    ->with('error', 'Cette demande est déjà entièrement satisfaite.');
            }

            // Récupération du travailleur
            $travailleur = Travailleur::findOrFail($data['travailleur_id']);

            // Vérifier le métier
            if ($travailleur->metier_id != $demande->metier_id) {

                return redirect()
                    ->route('affectations.index')
                    ->with('error', 'Le travailleur sélectionné ne possède pas le métier demandé.');
            }

            // Vérifier la disponibilité
            if (!$travailleur->disponible) {

                return redirect()
                    ->route('affectations.index')
                    ->with('error', 'Ce travailleur est déjà en mission.');
            }

            // Vérifier qu'il n'est pas déjà affecté à cette demande
            $existe = Affectation::where('demande_id', $demande->id)
                ->where('travailleur_id', $travailleur->id)
                ->exists();

            if ($existe) {

                return redirect()
                    ->route('affectations.index')
                    ->with('error', 'Ce travailleur est déjà affecté à cette demande.');
            }

            // Génération de la référence
            $dernierId = Affectation::max('id') + 1;

            $data['reference'] = 'AFF-' .
                date('Y') . '-' .
                str_pad($dernierId, 4, '0', STR_PAD_LEFT);

            // Statut par défaut
            $data['statut'] = 'En mission';

            // Création de l'affectation
            Affectation::create($data);

            // Le travailleur devient indisponible
            $travailleur->update([
                'disponible' => false
            ]);

            // Mise à jour de la demande
            $demande->increment('nombre_affectes');

            $demande->refresh();

            if ($demande->nombre_affectes == 0) {

                $demande->statut = 'En attente';
            } elseif ($demande->nombre_affectes < $demande->nombre) {

                $demande->statut = 'En cours';
            } else {

                $demande->statut = 'Terminée';
            }

            $demande->save();

            DB::commit();

            return redirect()
                ->route('affectations.index')
                ->with('success', 'Travailleur affecté avec succès.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('affectations.index')
                ->with('error', $e->getMessage());
        }
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
    public function update(UpdateAffectationRequest $request, Affectation $affectation)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            /*Si la mission est terminée*/

            if ($data['statut'] == 'Terminée') {

                // Enregistrer la date réelle de retour
                $data['date_retour'] = now()->toDateString();

                // Le travailleur redevient disponible
                $affectation->travailleur->update([
                    'disponible' => true
                ]);
            }

            /*Si la mission reprend*/

            if ($data['statut'] == 'En mission') {

                $data['date_retour'] = null;

                $affectation->travailleur->update([
                    'disponible' => false
                ]);
            }

            /*Mise à jour de l'affectation*/

            $affectation->update($data);

            DB::commit();

            return redirect()
                ->route('affectations.index')
                ->with('success', 'Affectation modifiée avec succès.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('affectations.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affectation $affectation)
    {
        DB::beginTransaction();

        try {

            // Interdire la suppression d'une mission en cours
            if ($affectation->statut == 'En mission') {

                DB::rollBack();

                return redirect()
                    ->route('affectations.index')
                    ->with('error', 'Impossible de supprimer une affectation en mission. Veuillez d\'abord terminer ou suspendre la mission.');
            }

            // Remettre le travailleur disponible
            $affectation->travailleur->update([
                'disponible' => true
            ]);

            // Décrémenter le nombre d'affectés
            if ($affectation->demande->nombre_affectes > 0) {

                $affectation->demande->decrement('nombre_affectes');
            }

            // Recalculer le statut de la demande
            $demande = $affectation->demande;

            $demande->refresh();

            if ($demande->nombre_affectes == 0) {

                $demande->statut = 'En attente';
            } elseif ($demande->nombre_affectes < $demande->nombre) {

                $demande->statut = 'En cours';
            } else {

                $demande->statut = 'Terminée';
            }

            $demande->save();

            // Supprimer l'affectation
            $affectation->delete();

            DB::commit();

            return redirect()
                ->route('affectations.index')
                ->with('success', 'Affectation supprimée avec succès.');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('affectations.index')
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
