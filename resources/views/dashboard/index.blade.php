@extends('adminlte::page')

@section('title', 'Tableau de bord')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h1 class="m-0"><i class="fas fa-tachometer-alt text-primary"></i>Tableau de bord</h1>

            <p class="text-muted">
                Bienvenue sur <strong>StaffLink</strong>
            </p>

        </div>

    </div>

@stop

@section('content')

    <div class="row">

        <div class="col-lg-2 col-md-4 col-6">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>{{ $nbClients }}</h3>

                    <p>Clients</p>

                </div>

                <div class="icon">

                    <i class="fas fa-building"></i>

                </div>

                <a href="{{ route('clients.index') }}"
                class="small-box-footer">

                    Voir plus

                    <i class="fas fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-6">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>{{ $nbTravailleurs }}</h3>

                    <p>Travailleurs</p>

                </div>

                <div class="icon">

                    <i class="fas fa-users"></i>

                </div>

                <a href="{{ route('travailleurs.index') }}"
                class="small-box-footer">

                    Voir plus

                    <i class="fas fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-6">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>{{ $nbDisponibles }}</h3>

                    <p>Disponibles</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-check"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-6">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>{{ $nbDemandes }}</h3>

                    <p>Demandes</p>

                </div>

                <div class="icon">

                    <i class="fas fa-file-alt"></i>

                </div>

                <a href="{{ route('demandes.index') }}"
                class="small-box-footer">

                    Voir plus

                    <i class="fas fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-6">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3>{{ $nbAffectations }}</h3>

                    <p>Affectations</p>

                </div>

                <div class="icon">

                    <i class="fas fa-user-tag"></i>

                </div>

                <a href="{{ route('affectations.index') }}"
                class="small-box-footer">

                    Voir plus

                    <i class="fas fa-arrow-circle-right"></i>

                </a>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-6">

            <div class="small-box bg-secondary">

                <div class="inner">

                    <h3>0</h3>

                    <p>Paiements</p>

                </div>

                <div class="icon">

                    <i class="fas fa-money-bill-wave"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-8">

            <div class="card card-primary card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-chart-line"></i>

                        Evolution des affectations

                    </h3>

                </div>

                <div class="card-body">

                    <canvas id="affectationChart"
                            height="120">

                    </canvas>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card card-success card-outline">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-chart-pie"></i>

                        Demandes par statut

                    </h3>

                </div>

                <div class="card-body">

                    <canvas id="statutChart"
                            height="220">

                    </canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-info">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-list"></i>

                        Dernières demandes

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <!-- Partie 3 -->
                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover text-nowrap">

                            <thead>

                            <tr>

                                <th>Référence</th>

                                <th>Client</th>

                                <th>Métier</th>

                                <th>Statut</th>

                            </tr>

                            </thead>

                            <tbody>

                            @forelse($dernieresDemandes as $demande)

                                <tr>

                                    <td>{{ $demande->reference }}</td>

                                    <td>{{ $demande->client->nom }}</td>

                                    <td>{{ $demande->metier->nom }}</td>

                                    <td>

                                        @if($demande->statut=='En attente')

                                            <span class="badge badge-warning">En attente</span>

                                        @elseif($demande->statut=='En cours')

                                            <span class="badge badge-info">En cours</span>

                                        @else

                                            <span class="badge badge-success">Terminée</span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center">

                                        Aucune demande

                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>


                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card card-success">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-user-check"></i>

                        Travailleurs disponibles

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <!-- Partie 3 -->
                    <div class="card-body p-0">

                        <table class="table table-hover">

                            <thead>

                                <tr>

                                <th>Photo</th>

                                <th>Nom</th>

                                <th>Métier</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($travailleursDisponibles as $travailleur)

                                <tr>

                                    <td>

                                        @if($travailleur->photo)

                                        <img src="{{ asset('storage/'.$travailleur->photo) }}"
                                        width="40"
                                        height="40"
                                        class="img-circle"
                                        style="object-fit:cover;">

                                        @else

                                        <img src="https://via.placeholder.com/40"
                                        class="img-circle">

                                        @endif

                                    </td>

                                    <td>

                                        {{ $travailleur->nom }}

                                        {{ $travailleur->prenom }}

                                    </td>

                                    <td>

                                    {{ $travailleur->metier->nom }}

                                    </td>

                                </tr>

                                @empty

                                    <tr>
                                        <td colspan="3" class="text-center">Aucun travailleur disponible</td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="card card-warning">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-user-tag"></i>

                        Dernières affectations

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <!-- Partie 3 -->
                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Travailleur</th>
                                    <th>Client</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($dernieresAffectations as $affectation)

                                <tr>

                                    <td>

                                        {{ $affectation->reference }}

                                    </td>

                                    <td>

                                        {{ $affectation->travailleur->nom }}

                                        {{ $affectation->travailleur->prenom }}

                                    </td>

                                    <td>

                                        {{ $affectation->demande->client->nom }}

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="3" class="text-center">

                                        Aucune affectation

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card card-danger">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-exclamation-circle"></i>

                        Demandes urgentes

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <!-- Partie 3 -->
                    <div class="card-body table-responsive p-0">

                        <table class="table table-hover">

                            <thead>

                                <tr>
                                    <th>Référence</th>
                                    <th>Client</th>
                                    <th>Urgence</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($demandesUrgentes as $demande)

                                <tr>

                                    <td>

                                        {{ $demande->reference }}

                                    </td>

                                    <td>

                                        {{ $demande->client->nom }}

                                    </td>

                                    <td>

                                        <span class="badge badge-danger">

                                            {{ $demande->urgence }}

                                        </span>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="3" class="text-center">

                                    Aucune demande urgente

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('affectationChart');

new Chart(ctx, {

    type: 'line',

    data: {

        labels: @json($mois),

        datasets: [{

            label: 'Affectations',

            data: @json($affectationsParMois),

            borderWidth: 3,

            tension: .4,

            fill: true,

            backgroundColor: 'rgba(60,141,188,.2)',

            borderColor: '#3c8dbc'

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        }

    }

});

const pie = document.getElementById('statutChart');

new Chart(pie, {

    type: 'doughnut',

    data: {

        labels: @json($statutLabels),

        datasets: [{

            data: @json($statutData),

            backgroundColor: [

                '#ffc107',

                '#17a2b8',

                '#28a745'

            ]

        }]

    },

    options: {

        responsive:true

    }

});

</script>

@stop
