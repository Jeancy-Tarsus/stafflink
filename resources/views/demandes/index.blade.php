@extends('adminlte::page')

@section('title', 'Demandes')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-clipboard-list"></i>
        Gestion des demandes
    </h1>

    <button class="btn btn-primary"
            data-toggle="modal"
            data-target="#createDemandeModal">

        <i class="fas fa-plus"></i>
        Nouvelle demande

    </button>

</div>

@stop

@section('content')

<div class="card card-primary shadow-sm">

    <div class="card-header">

        <form action="{{ route('demandes.index') }}"
              method="GET">

            <div class="row">

                <div class="col-md-3">

                    <input type="text"
                           name="recherche"
                           class="form-control"
                           placeholder="Référence ou client..."
                           value="{{ request('recherche') }}">

                </div>

                <div class="col-md-3">

                    <select name="client"
                            class="form-control">

                        <option value="">
                            Tous les clients
                        </option>

                        @foreach($clients as $client)

                            <option value="{{ $client->id }}"
                                {{ request('client')==$client->id?'selected':'' }}>

                                {{ $client->nom }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <select name="metier"
                            class="form-control">

                        <option value="">
                            Tous les métiers
                        </option>

                        @foreach($metiers as $metier)

                            <option value="{{ $metier->id }}"
                                {{ request('metier')==$metier->id?'selected':'' }}>

                                {{ $metier->nom }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <select name="statut"
                            class="form-control">

                        <option value="">
                            Tous les statuts
                        </option>

                        <option value="En attente">En attente</option>

                        <option value="En cours">En cours</option>

                        <option value="Partiellement satisfaite">
                            Partiellement satisfaite
                        </option>

                        <option value="Terminée">
                            Terminée
                        </option>

                        <option value="Annulée">
                            Annulée
                        </option>

                    </select>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary btn-block">

                        <i class="fas fa-search"></i>

                        Filtrer

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover table-striped">

            <thead>

            <tr>

                <th>#</th>

                <th>Référence</th>

                <th>Client</th>

                <th>Métier</th>

                <th>Demandés</th>

                <th>Affectés</th>

                <th>Restants</th>

                <th>Urgence</th>

                <th>Statut</th>

                <th>Progression</th>

                <th width="170">

                    Actions

                </th>

            </tr>

            </thead>

            <tbody>
                @forelse($demandes as $demande)

<tr>

    <td>

        {{ $demandes->firstItem() + $loop->index }}

    </td>

    <td>

        <span class="badge badge-dark">

            {{ $demande->reference }}

        </span>

    </td>

    <td>

        {{ $demande->client->nom }}

    </td>

    <td>

        {{ $demande->metier->nom }}

    </td>

    <td class="text-center">

        {{ $demande->nombre }}

    </td>

    <td class="text-center">

        {{ $demande->nombre_affectes }}

    </td>

    <td class="text-center">

        <span class="badge badge-info">

            {{ $demande->nombre_restant }}

        </span>

    </td>

    <td>

        @switch($demande->urgence)

            @case('Normale')

                <span class="badge badge-secondary">

                    {{ $demande->urgence }}

                </span>

            @break

            @case('Urgente')

                <span class="badge badge-warning">

                    {{ $demande->urgence }}

                </span>

            @break

            @case('Très urgente')

                <span class="badge badge-danger">

                    {{ $demande->urgence }}

                </span>

            @break

        @endswitch

    </td>

    <td>

        @switch($demande->statut)

            @case('En attente')

                <span class="badge badge-secondary">

                    {{ $demande->statut }}

                </span>

            @break

            @case('En cours')

                <span class="badge badge-primary">

                    {{ $demande->statut }}

                </span>

            @break

            @case('Partiellement satisfaite')

                <span class="badge badge-warning">

                    {{ $demande->statut }}

                </span>

            @break

            @case('Terminée')

                <span class="badge badge-success">

                    {{ $demande->statut }}

                </span>

            @break

            @case('Annulée')

                <span class="badge badge-danger">

                    {{ $demande->statut }}

                </span>

            @break

        @endswitch

    </td>

    <td width="180">

        @php

            $pourcentage = $demande->nombre > 0
                ? round(($demande->nombre_affectes * 100) / $demande->nombre)
                : 0;

        @endphp

        <div class="progress progress-sm">

            <div class="progress-bar bg-success"
                 role="progressbar"
                 style="width: {{ $pourcentage }}%">

            </div>

        </div>

        <small>

            {{ $pourcentage }} %

        </small>

    </td>

    <td>

        <div class="btn-group">

            <button class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#modalShowDemande{{ $demande->id }}"
                    title="Voir">

                <i class="fas fa-eye"></i>

            </button>

            <button class="btn btn-warning btn-sm"
                    data-toggle="modal"
                    data-target="#modalEditDemande{{ $demande->id }}"
                    title="Modifier">

                <i class="fas fa-edit"></i>

            </button>

            <button class="btn btn-danger btn-sm"
                    onclick="confirmDelete({{ $demande->id }})"
                    title="Supprimer">

                <i class="fas fa-trash"></i>

            </button>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="11"
        class="text-center">

        Aucune demande enregistrée.

    </td>

</tr>

@endforelse

</table>

</div>

<div class="card-footer">

    {{ $demandes->links('pagination::bootstrap-4') }}

</div>

</div>

@foreach($demandes as $demande)

    @include('demandes.modals.show', [
        'demande' => $demande
    ])

    @include('demandes.modals.edit', [
        'demande' => $demande,
        'clients' => $clients,
        'metiers' => $metiers
    ])

@endforeach

@include('demandes.modals.create')

<form id="delete-form"
      method="POST">

    @csrf

    @method('DELETE')

</form>

@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Succès --}}
@if(session('success'))
<script>

Swal.fire({

    icon:'success',

    title:'Succès',

    text:"{{ session('success') }}",

    timer:2000,

    showConfirmButton:false

});

</script>
@endif


{{-- Erreur --}}
@if(session('error'))
<script>

Swal.fire({

    icon:'error',

    title:'Erreur',

    text:"{{ session('error') }}"

});

</script>
@endif


{{-- Validation --}}
@if($errors->any())

<script>

Swal.fire({

    icon:'error',

    title:'Erreur de validation',

    html:`{!! implode('<br>', $errors->all()) !!}`

});

</script>

@endif

<script>

function confirmDelete(id)
{

    Swal.fire({

        title:'Supprimer cette demande ?',

        text:"Cette action est irréversible.",

        icon:'warning',

        showCancelButton:true,

        confirmButtonText:'Oui, supprimer',

        cancelButtonText:'Annuler',

        confirmButtonColor:'#dc3545'

    }).then((result)=>{

        if(result.isConfirmed){

            let form=document.getElementById('delete-form');

            let url="{{ route('demandes.destroy',':id') }}";

            form.action=url.replace(':id',id);

            form.submit();

        }

    });

}

</script>

@stop
