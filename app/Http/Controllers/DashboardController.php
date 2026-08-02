<?php

// namespace App\Http\Controllers;

// use App\Models\Travailleur;
// use App\Models\Client;
// use App\Models\Demande;
// use App\Models\Affectation;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $nbTravailleurs = Travailleur::count();

//         $nbDisponibles = Travailleur::where('disponible', true)->count();

//         $nbMission = Travailleur::where('disponible', false)->count();

//         $nbClients = Client::count();

//         $nbDemandes = Demande::count();

//         $nbAffectations = Affectation::count();

//         return view('dashboard.index', compact(

//             'nbTravailleurs',

//             'nbDisponibles',

//             'nbMission',

//             'nbClients',

//             'nbDemandes',

//             'nbAffectations'

//         ));
//     }
// }


namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Travailleur;
use App\Models\Metier;
use App\Models\Demande;
use App\Models\Affectation;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Cartes statistiques
        |--------------------------------------------------------------------------
        */

        $nbClients = Client::count();

        $nbTravailleurs = Travailleur::count();

        $nbDisponibles = Travailleur::where('disponible', true)->count();

        $nbAffectations = Affectation::count();

        $nbDemandes = Demande::count();

        /*
        |--------------------------------------------------------------------------
        | Dernières demandes
        |--------------------------------------------------------------------------
        */

        $dernieresDemandes = Demande::with(['client', 'metier'])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Dernières affectations
        |--------------------------------------------------------------------------
        */

        $dernieresAffectations = Affectation::with([
            'travailleur',
            'demande.client'
        ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Travailleurs disponibles
        |--------------------------------------------------------------------------
        */

        $travailleursDisponibles = Travailleur::with('metier')
            ->where('disponible', true)
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Demandes urgentes
        |--------------------------------------------------------------------------
        */

        $demandesUrgentes = Demande::with('client')
            ->where('urgence', '!=', 'Normale')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Répartition des demandes
        |--------------------------------------------------------------------------
        */

        $enAttente = Demande::where('statut', 'En attente')->count();

        $enCours = Demande::where('statut', 'En cours')->count();

        $terminees = Demande::where('statut', 'Terminée')->count();


        /*
|--------------------------------------------------------------------------
| Données pour le graphique des statuts
|--------------------------------------------------------------------------
*/

        $statutLabels = ['En attente', 'En cours', 'Terminée'];

        $statutData = [
            Demande::where('statut', 'En attente')->count(),
            Demande::where('statut', 'En cours')->count(),
            Demande::where('statut', 'Terminée')->count(),
        ];

        /*
|--------------------------------------------------------------------------
| Affectations par mois
|--------------------------------------------------------------------------
*/

        $mois = [
            'Jan',
            'Fév',
            'Mar',
            'Avr',
            'Mai',
            'Juin',
            'Juil',
            'Août',
            'Sep',
            'Oct',
            'Nov',
            'Déc'
        ];

        $affectationsParMois = [];

        for ($i = 1; $i <= 12; $i++) {

            $affectationsParMois[] = Affectation::whereMonth('created_at', $i)
                ->whereYear('created_at', now()->year)
                ->count();
        }

        return view('dashboard.index', compact(

            'nbClients',

            'nbTravailleurs',

            'nbDisponibles',

            'nbAffectations',

            'nbDemandes',

            'dernieresDemandes',

            'dernieresAffectations',

            'travailleursDisponibles',

            'demandesUrgentes',

            'enAttente',

            'enCours',

            'terminees',
            'statutLabels',

            'statutData',

            'mois',

            'affectationsParMois',

        ));
    }
}
