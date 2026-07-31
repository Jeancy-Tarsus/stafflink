@extends('adminlte::page')

@section('title', 'Travailleurs')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-users"></i>
        Gestion des travailleurs
    </h1>

    <button class="btn btn-primary"
            data-toggle="modal"
            data-target="#createTravailleurModal">

        <i class="fas fa-plus"></i>
        Nouveau travailleur

    </button>

</div>

@stop

@section('content')

    <div class="card card-primary shadow-sm">

        <div class="card-header">
            <div class="row">

                <div class="col-md-3">
                    <h3 class="card-title mt-2">Liste des travailleurs</h3>
                </div>

                <div class="col-md-9">

                    <form method="GET"
                        action="{{ route('travailleurs.index') }}">

                        <div class="row">

                            <div class="col-md-4">

                                <input
                                    type="text"
                                    name="recherche"
                                    class="form-control"
                                    placeholder="Nom, prénom ou téléphone..."
                                    value="{{ request('recherche') }}">

                            </div>

                            <div class="col-md-3">

                                <select name="metier"
                                        class="form-control">

                                    <option value="">

                                        Tous les métiers

                                    </option>

                                    @foreach($metiers as $metier)

                                        <option value="{{ $metier->id }}"
                                            {{ request('metier') == $metier->id ? 'selected' : '' }}>

                                            {{ $metier->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-3">

                                <select name="disponibilite"
                                        class="form-control">

                                    <option value="">

                                        Toutes disponibilités

                                    </option>

                                    <option value="1"
                                        {{ request('disponibilite') === '1' ? 'selected' : '' }}>

                                        Disponible

                                    </option>

                                    <option value="0"
                                        {{ request('disponibilite') === '0' ? 'selected' : '' }}>

                                        Indisponible

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

            </div>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover table-striped align-middle">

            <thead>

                <tr>

                    <th width="5%">#</th>
                    <th>Photo</th>
                    <th>Nom complet</th>
                    <th>Métier</th>
                    <th>Téléphone</th>
                    <th>Disponibilité</th>
                    <th>Statut</th>
                    <th width="170">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($travailleurs as $travailleur)

                <tr>

                    <td>

                        {{ $travailleurs->firstItem() + $loop->index }}

                    </td>

                    <td>

                        @if($travailleur->photo)

                            <img src="{{ asset('storage/'.$travailleur->photo) }}"
                                 width="45"
                                 height="45"
                                 class="img-circle"
                                 style="object-fit:cover;">

                        @else

                            <img src="https://via.placeholder.com/45"
                                 class="img-circle">

                        @endif

                    </td>

                    <td>

                        {{ $travailleur->nom }}
                        {{ $travailleur->prenom }}

                    </td>

                    <td>

                        {{ optional($travailleur->metier)->nom }}

                    </td>

                    <td>

                        {{ $travailleur->telephone }}

                    </td>

                    <td>

                        @if($travailleur->disponible)

                            <span class="badge badge-success">

                                Disponible

                            </span>

                        @else

                            <span class="badge badge-warning">

                                Indisponible

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($travailleur->actif)

                            <span class="badge badge-primary">

                                Actif

                            </span>

                        @else

                            <span class="badge badge-danger">

                                Inactif

                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="btn-group">

                            <button class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalShowTravailleur{{ $travailleur->id }}"
                                    title="Voir">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEditTravailleur{{ $travailleur->id }}"
                                    title="Modifier">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $travailleur->id }})"
                                    title="Supprimer">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Aucun travailleur enregistré.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $travailleurs->links('pagination::bootstrap-4') }}

    </div>

</div>

{{-- Toutes les modales --}}

@foreach($travailleurs as $travailleur)

    @include('travailleurs.modals.show', [
        'travailleur' => $travailleur
    ])

    @include('travailleurs.modals.edit', [
        'travailleur' => $travailleur,
        'metiers' => $metiers
    ])

@endforeach

@include('travailleurs.modals.create')

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

/**
 * Confirmation de suppression
 */
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

        if (result.isConfirmed) {

            let form = document.getElementById('delete-form');

            let url = "{{ route('travailleurs.destroy', ':id') }}";

            form.action = url.replace(':id', id);

            form.submit();
        }

    });
}

/**
 * Réouvrir automatiquement le modal Création
 * lorsqu'il y a des erreurs de validation.
 */
@if($errors->any())
$(document).ready(function () {
    $('#createTravailleurModal').modal('show');
});
@endif

</script>

@stop
