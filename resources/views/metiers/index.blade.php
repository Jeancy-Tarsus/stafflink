@extends('adminlte::page')

@section('title', 'Métiers')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1>
            <i class="fas fa-briefcase"></i>
            Gestion des métiers
        </h1>


        <button type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalCreateMetier"
                data-backdrop="static">

            <i class="fas fa-plus"></i>
            Nouveau métier

        </button>


    </div>

@stop


@section('content')

    <div class="card card-primary shadow-sm">


        <div class="card-header">

            <h3 class="card-title">
                Liste des métiers
            </h3>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="thead-light">

                        <tr>
                            <th width="5%">#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Statut</th>
                            <th width="150">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($metiers as $metier)

                            <tr>

                                <td>
                                    {{ $metiers->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $metier->nom }}
                                </td>

                                <td>
                                    {{ $metier->description }}
                                </td>

                                <td>

                                    @if($metier->actif)

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
                                    <div class="btn-group" role="group">

                                        <button type="button"
                                                class="btn btn-warning btn-sm"
                                                data-toggle="modal"
                                                data-target="#modalEditMetier{{ $metier->id }}"
                                                data-backdrop="static"
                                                title="Modifier">

                                            <i class="fas fa-edit"></i>

                                        </button>

                                        <button type="button"
                                                class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $metier->id }})"
                                                title="Supprimer">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </div>
                                </td>


                            </tr>

                            {{-- Modal modification --}}
                            @include('metiers.modals.edit', ['metier' => $metier])

                            @empty

                            <tr>

                                <td colspan="5" class="text-center">

                                    Aucun métier enregistré.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-center mt-3">

                {{ $metiers->links('pagination::bootstrap-4') }}

            </div>

        </div>

    </div>

    {{-- Modal ajout métier --}}
    @include('metiers.modals.create')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if(session('success'))

        <script>

            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });

        </script>

    @endif



    @if($errors->any())

        <script>

            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: "{{ $errors->first() }}",
            });

        </script>

    @endif

    <form id="delete-form"
      method="POST">

    @csrf
    @method('DELETE')

</form>
<script>

    function confirmDelete(id)
    {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {

            if (result.isConfirmed) {

                let form = document.getElementById('delete-form');

                let url = "{{ route('metiers.destroy', ':id') }}";
                url = url.replace(':id', id);

                form.action = url;

                form.submit();
            }

        });
    }

</script>
@stop
