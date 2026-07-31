@extends('adminlte::page')

@section('title', 'Clients')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-building"></i>
        Gestion des clients
    </h1>

    <button class="btn btn-primary"
            data-toggle="modal"
            data-target="#createClientModal">

        <i class="fas fa-plus"></i>
        Nouveau client

    </button>

</div>

@stop

@section('content')

<div class="card card-primary shadow-sm">

    <div class="card-header">

        <form action="{{ route('clients.index') }}"
              method="GET">

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           class="form-control"
                           name="recherche"
                           placeholder="Rechercher un client..."
                           value="{{ request('recherche') }}">

                </div>

                <div class="col-md-3">

                    <select class="form-control"
                            name="type">

                        <option value="">
                            Tous les types
                        </option>

                        <option value="Entreprise"
                            {{ request('type')=='Entreprise'?'selected':'' }}>

                            Entreprise

                        </option>

                        <option value="Particulier"
                            {{ request('type')=='Particulier'?'selected':'' }}>

                            Particulier

                        </option>

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-control"
                            name="actif">

                        <option value="">
                            Tous les statuts
                        </option>

                        <option value="1"
                            {{ request('actif')==='1'?'selected':'' }}>

                            Actif

                        </option>

                        <option value="0"
                            {{ request('actif')==='0'?'selected':'' }}>

                            Inactif

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

        <table class="table table-bordered table-hover table-striped align-middle">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Responsable</th>
                    <th>Téléphone</th>
                    <th>Ville</th>
                    <th>Statut</th>
                    <th width="170">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($clients as $client)

                <tr>

                    <td>

                        {{ $clients->firstItem()+$loop->index }}

                    </td>

                    <td>

                        {{ $client->nom }}

                    </td>

                    <td>

                        <span class="badge badge-info">

                            {{ $client->type }}

                        </span>

                    </td>

                    <td>

                        {{ $client->responsable }}

                    </td>

                    <td>

                        {{ $client->telephone }}

                    </td>

                    <td>

                        {{ $client->ville }}

                    </td>

                    <td>

                        @if($client->actif)

                            <span class="badge badge-success">

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
                                    data-target="#modalShowClient{{ $client->id }}">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEditClient{{ $client->id }}">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $client->id }})">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8"
                        class="text-center">

                        Aucun client enregistré.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $clients->links('pagination::bootstrap-4') }}

    </div>

</div>

@foreach($clients as $client)

    @include('clients.modals.show',['client'=>$client])

    @include('clients.modals.edit',['client'=>$client])

@endforeach

@include('clients.modals.create')

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

            let url = "{{ route('clients.destroy', ':id') }}";

            form.action = url.replace(':id', id);

            form.submit();

        }

    });

}

@if($errors->any())

$(document).ready(function () {

    $('#createClientModal').modal('show');

});

@endif

</script>

@stop
