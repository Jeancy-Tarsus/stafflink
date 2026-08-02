@extends('adminlte::page')

@section('title', 'Contrats')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-file-signature"></i>
        Gestion des contrats
    </h1>

    <button type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#modalCreateContrat">

        <i class="fas fa-plus"></i>
        Nouveau contrat

    </button>

</div>

@stop

@section('content')

<div class="card card-primary shadow-sm">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover table-striped align-middle">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Référence</th>
                    <th>Client</th>
                    <th>Travailleur</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Salaire</th>
                    <th>Statut</th>
                    <th width="180">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($contrats as $contrat)

                <tr>

                    <td>

                        {{ $contrats->firstItem()+$loop->index }}

                    </td>

                    <td>

                        {{ $contrat->reference }}

                    </td>

                    <td>

                        {{ $contrat->affectation->demande->client->nom }}

                    </td>

                    <td>

                        {{ $contrat->affectation->travailleur->nom }}

                        {{ $contrat->affectation->travailleur->prenom }}

                    </td>

                    <td>

                        {{ $contrat->date_debut->format('d/m/Y') }}

                    </td>

                    <td>

                        {{ $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : '-' }}

                    </td>

                    <td>

                        {{ number_format($contrat->salaire,0,',',' ') }} FCFA

                    </td>

                    <td>

                        @if($contrat->statut=='Actif')

                            <span class="badge badge-success">

                                Actif

                            </span>

                        @elseif($contrat->statut=='Terminé')

                            <span class="badge badge-primary">

                                Terminé

                            </span>

                        @else

                            <span class="badge badge-danger">

                                Résilié

                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="btn-group">

                            <button type="button"
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalShowContrat{{ $contrat->id }}">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button type="button"
                                    class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEditContrat{{ $contrat->id }}">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $contrat->id }})">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9"
                        class="text-center">

                        Aucun contrat enregistré.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $contrats->links('pagination::bootstrap-4') }}

    </div>

</div>
@foreach($contrats as $contrat)

    @include('contrats.modals.show', ['contrat' => $contrat])

    @include('contrats.modals.edit', ['contrat' => $contrat])

@endforeach

@include('contrats.modals.create')

<form id="delete-form" method="POST">

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

    icon: 'success',

    title: 'Succès',

    text: "{{ session('success') }}",

    timer: 2000,

    showConfirmButton: false

});

</script>
@endif

{{-- Erreur --}}
@if(session('error'))
<script>

Swal.fire({

    icon: 'error',

    title: 'Erreur',

    text: "{{ session('error') }}"

});

</script>
@endif

{{-- Erreurs de validation --}}
@if($errors->any())
<script>

Swal.fire({

    icon: 'error',

    title: 'Erreur de validation',

    html: `{!! implode('<br>', $errors->all()) !!}`,

    confirmButtonText: 'OK'

});

</script>
@endif

<script>

function confirmDelete(id)
{
    Swal.fire({

        title: 'Êtes-vous sûr ?',

        text: 'Cette action est irréversible !',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#dc3545',

        cancelButtonColor: '#6c757d',

        confirmButtonText: 'Oui, supprimer',

        cancelButtonText: 'Annuler'

    }).then((result) => {

        if(result.isConfirmed){

            let form = document.getElementById('delete-form');

            let url = "{{ route('contrats.destroy', ':id') }}";

            form.action = url.replace(':id', id);

            form.submit();

        }

    });
}

@if($errors->any())

$(document).ready(function(){

    $('#modalCreateContrat').modal('show');

});

@endif

</script>

@stop
