@extends('adminlte::page')

@section('title', 'Affectations')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        <i class="fas fa-user-check"></i>

        Gestion des affectations

    </h1>

    <button class="btn btn-primary"
            data-toggle="modal"
            data-target="#createAffectationModal">

        <i class="fas fa-plus"></i>

        Nouvelle affectation

    </button>

</div>

@stop

@section('content')

<div class="card card-primary shadow">

    <div class="card-header">

        <form method="GET"
              action="{{ route('affectations.index') }}">

            <div class="row">

                <div class="col-md-6">

                    <input type="text"
                           name="recherche"
                           class="form-control"
                           placeholder="Référence ou travailleur..."
                           value="{{ request('recherche') }}">

                </div>

                <div class="col-md-4">

                    <select name="statut"
                            class="form-control">

                        <option value="">
                            Tous les statuts
                        </option>

                        <option value="En mission">
                            En mission
                        </option>

                        <option value="Terminée">
                            Terminée
                        </option>

                        <option value="Suspendue">
                            Suspendue
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

                    <th>Travailleur</th>

                    <th>Date</th>

                    <th>Statut</th>

                    <th width="170">

                        Actions

                    </th>

                </tr>

            </thead>

            <tbody>
                @forelse($affectations as $affectation)

<tr>

    <td>

        {{ $affectations->firstItem() + $loop->index }}

    </td>

    <td>

        <span class="badge badge-dark">

            {{ $affectation->reference }}

        </span>

    </td>

    <td>

        {{ $affectation->demande->client->nom }}

    </td>

    <td>

        {{ $affectation->demande->metier->nom }}

    </td>

    <td>

        {{ $affectation->travailleur->nom }}

        {{ $affectation->travailleur->prenom }}

    </td>

    <td>

        {{ $affectation->date_affectation->format('d/m/Y') }}

    </td>

    <td>

        @if($affectation->statut == 'En mission')

            <span class="badge badge-success">

                En mission

            </span>

        @elseif($affectation->statut == 'Terminée')

            <span class="badge badge-primary">

                Terminée

            </span>

        @else

            <span class="badge badge-danger">

                Suspendue

            </span>

        @endif

    </td>

    <td>

        <div class="btn-group">

            <button class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#modalShowAffectation{{ $affectation->id }}">

                <i class="fas fa-eye"></i>

            </button>

            <button class="btn btn-warning btn-sm"
                    data-toggle="modal"
                    data-target="#modalEditAffectation{{ $affectation->id }}">

                <i class="fas fa-edit"></i>

            </button>

            <button class="btn btn-danger btn-sm"
                    onclick="confirmDelete({{ $affectation->id }})">

                <i class="fas fa-trash"></i>

            </button>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="8" class="text-center">

        Aucune affectation enregistrée.

    </td>

</tr>

@endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $affectations->links('pagination::bootstrap-4') }}

    </div>

</div>

{{-- Toutes les modales --}}
@foreach($affectations as $affectation)

    @include('affectations.modals.show', [
        'affectation' => $affectation
    ])

    @include('affectations.modals.edit', [
        'affectation' => $affectation,
        'demandes' => $demandes,
        'travailleurs' => $travailleurs
    ])

@endforeach

@include('affectations.modals.create')

<form id="delete-form" method="POST">

    @csrf

    @method('DELETE')

</form>

@stop


@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

@if(session('error'))
<script>

Swal.fire({

    icon:'error',

    title:'Erreur',

    text:"{{ session('error') }}"

});

</script>
@endif

@if($errors->any())

<script>

Swal.fire({

    icon:'error',

    title:'Erreur de validation',

    html:`{!! implode('<br>', $errors->all()) !!}`

});

$(document).ready(function(){

    $('#createAffectationModal').modal('show');

});

</script>

@endif

<script>

function confirmDelete(id)
{

    Swal.fire({

        title:'Supprimer cette affectation ?',

        text:'Cette action est irréversible.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#dc3545',

        cancelButtonColor:'#6c757d',

        confirmButtonText:'Oui',

        cancelButtonText:'Annuler'

    }).then((result)=>{

        if(result.isConfirmed){

            let form=document.getElementById('delete-form');

            let url="{{ route('affectations.destroy',':id') }}";

            form.action=url.replace(':id',id);

            form.submit();

        }

    });

}

</script>

@stop
