@extends('adminlte::page')

@section('title','Encaissements')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        <i class="fas fa-cash-register"></i>

        Gestion des encaissements

    </h1>

    <button class="btn btn-success"
            data-toggle="modal"
            data-target="#modalCreateEncaissement">

        <i class="fas fa-plus"></i>

        Nouvel encaissement

    </button>

</div>

@stop

@section('content')

<div class="card card-success shadow">

    <div class="card-header">

        <form method="GET"
              action="{{ route('encaissements.index') }}">

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="recherche"
                           class="form-control"
                           placeholder="Référence..."
                           value="{{ request('recherche') }}">

                </div>

                <div class="col-md-3">

                    <button class="btn btn-success btn-block">

                        <i class="fas fa-search"></i>

                        Rechercher

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

                    <th>Facture</th>

                    <th>Client</th>

                    <th>Date</th>

                    <th>Montant</th>

                    <th>Mode</th>

                    <th width="170">

                        Actions

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($encaissements as $encaissement)

                <tr>

                    <td>

                        {{ $encaissements->firstItem()+$loop->index }}

                    </td>

                    <td>

                        {{ $encaissement->reference }}

                    </td>

                    <td>

                        {{ $encaissement->facture->reference }}

                    </td>

                    <td>

                        {{ $encaissement->facture->contrat->affectation->demande->client->nom }}

                    </td>

                    <td>

                        {{ $encaissement->date_encaissement->format('d/m/Y') }}

                    </td>

                    <td>

                        {{ number_format($encaissement->montant,0,',',' ') }}

                        FCFA

                    </td>

                    <td>

                        {{ $encaissement->mode_paiement }}

                    </td>

                    <td>

                        <div class="btn-group">

                            <button class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalShowEncaissement{{ $encaissement->id }}">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEditEncaissement{{ $encaissement->id }}">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $encaissement->id }})">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8"
                        class="text-center">

                        Aucun encaissement enregistré.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $encaissements->links('pagination::bootstrap-4') }}

    </div>

</div>

@foreach($encaissements as $encaissement)

    @include('encaissements.modals.show',['encaissement'=>$encaissement])

    @include('encaissements.modals.edit',['encaissement'=>$encaissement])

@endforeach

@include('encaissements.modals.create')

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
    icon: 'success',
    title: 'Succès',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Erreur',
    text: "{{ session('error') }}"
});
</script>
@endif

@if($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Erreur de validation',
    html: `{!! implode('<br>', $errors->all()) !!}`
});
</script>
@endif

<script>

$(document).ready(function () {

    @if($errors->any())
        $('#modalCreateEncaissement').modal('show');
    @endif

    // Sélection d'une facture
    $('#facture_id').on('change', function () {

        let option = $(this).find(':selected');

        let client = option.data('client') || '-';

        let montant = parseFloat(option.data('montant')) || 0;

        let encaisse = parseFloat(option.data('encaisse')) || 0;

        let reste = parseFloat(option.data('reste')) || 0;

        $('#clientFacture').text(client);

        $('#montantFacture').text(
            montant.toLocaleString('fr-FR') + ' FCFA'
        );

        $('#montantEncaisse').text(
            encaisse.toLocaleString('fr-FR') + ' FCFA'
        );

        $('#resteFacture').text(
            reste.toLocaleString('fr-FR') + ' FCFA'
        );

        $('#montant').attr('max', reste);

    });

    // Vérification du montant
    $('#montant').on('input', function () {

        let max = parseFloat($(this).attr('max')) || 0;

        let valeur = parseFloat($(this).val()) || 0;

        if (valeur > max && max > 0) {

            Swal.fire({
                icon: 'warning',
                title: 'Montant invalide',
                text: 'Le montant saisi dépasse le reste à payer.'
            });

            $(this).val(max);

        }

    });

});

// Confirmation de suppression
function confirmDelete(id)
{
    Swal.fire({

        title: 'Êtes-vous sûr ?',

        text: 'Cet encaissement sera supprimé.',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#d33',

        cancelButtonColor: '#3085d6',

        confirmButtonText: 'Oui, supprimer',

        cancelButtonText: 'Annuler'

    }).then((result) => {

        if(result.isConfirmed){

            let form = document.getElementById('delete-form');

            let url = "{{ route('encaissements.destroy', ':id') }}";

            form.action = url.replace(':id', id);

            form.submit();

        }

    });
}

</script>

@stop
