@extends('adminlte::page')

@section('title', 'Factures')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-file-invoice-dollar"></i>
        Gestion des factures
    </h1>

    <button class="btn btn-primary"
            data-toggle="modal"
            data-target="#modalCreateFacture">

        <i class="fas fa-plus"></i>

        Nouvelle facture

    </button>

</div>

@stop

@section('content')

<div class="card card-primary shadow-sm">

    <div class="card-header">

        <form action="{{ route('factures.index') }}"
              method="GET">

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           name="recherche"
                           class="form-control"
                           placeholder="Rechercher une facture..."
                           value="{{ request('recherche') }}">

                </div>

                <div class="col-md-3">

                    <select class="form-control"
                            name="statut">

                        <option value="">
                            Tous les statuts
                        </option>

                        <option value="Non payée"
                            {{ request('statut')=='Non payée'?'selected':'' }}>

                            Non payée

                        </option>

                        <option value="Partiellement payée"
                            {{ request('statut')=='Partiellement payée'?'selected':'' }}>

                            Partiellement payée

                        </option>

                        <option value="Payée"
                            {{ request('statut')=='Payée'?'selected':'' }}>

                            Payée

                        </option>

                        <option value="Annulée"
                            {{ request('statut')=='Annulée'?'selected':'' }}>

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

                    <th>Travailleur</th>

                    <th>Montant</th>

                    <th>Encaissé</th>

                    <th>Reste</th>

                    <th>Statut</th>

                    <th width="170">

                        Actions

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($factures as $facture)

                <tr>

                    <td>

                        {{ $factures->firstItem()+$loop->index }}

                    </td>

                    <td>

                        {{ $facture->reference }}

                    </td>

                    <td>

                        {{ $facture->contrat->affectation->demande->client->nom }}

                    </td>

                    <td>

                        {{ $facture->contrat->affectation->travailleur->nom }}

                        {{ $facture->contrat->affectation->travailleur->prenom }}

                    </td>

                    <td>

                        {{ number_format($facture->montant,0,',',' ') }}

                        FCFA

                    </td>

                    <td>

                        {{ number_format($facture->montant_encaisse,0,',',' ') }}

                        FCFA

                    </td>

                    <td>

                        {{ number_format($facture->reste,0,',',' ') }}

                        FCFA

                    </td>

                    <td>

                        @switch($facture->statut)

                            @case('Payée')

                                <span class="badge badge-success">

                                    Payée

                                </span>

                                @break

                            @case('Partiellement payée')

                                <span class="badge badge-warning">

                                    Partiellement payée

                                </span>

                                @break

                            @case('Annulée')

                                <span class="badge badge-danger">

                                    Annulée

                                </span>

                                @break

                            @default

                                <span class="badge badge-secondary">

                                    Non payée

                                </span>

                        @endswitch

                    </td>

                    <td>

                        <div class="btn-group">

                            <button class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalShowFacture{{ $facture->id }}">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEditFacture{{ $facture->id }}">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $facture->id }})">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9"
                        class="text-center">

                        Aucune facture enregistrée.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $factures->links('pagination::bootstrap-4') }}

    </div>

</div>

@foreach($factures as $facture)

    @include('factures.modals.show',['facture'=>$facture])

    @include('factures.modals.edit',['facture'=>$facture])

@endforeach

@include('factures.modals.create')

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
    html:`{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonText:'OK'
});
</script>
@endif

<script>

$(document).ready(function(){

    @if($errors->any())
        $('#modalCreateFacture').modal('show');
    @endif

    // ===========================
    // Informations du contrat
    // ===========================

    $('#contrat_id').on('change', function(){

        let option = $(this).find(':selected');

        if(option.val() == ''){

            $('#referenceContrat').text('-');
            $('#clientNom').text('-');
            $('#travailleurNom').text('-');
            $('#metierNom').text('-');
            $('#montantContrat').text('-');
            $('#montant').val('');

            return;
        }

        let montant = parseFloat(option.data('montant')) || 0;

        $('#referenceContrat').text(option.data('reference'));

        $('#clientNom').text(option.data('client'));

        $('#travailleurNom').text(option.data('travailleur'));

        $('#metierNom').text(option.data('metier'));

        $('#montantContrat').text(
            montant.toLocaleString('fr-FR') + ' FCFA'
        );

        $('#montant').val(montant);

    });

    // Réinitialiser le formulaire
    $('#modalCreateFacture').on('shown.bs.modal', function(){

        $('#contrat_id').val('').trigger('change');

    });

});

// ===========================
// Suppression
// ===========================

function confirmDelete(id)
{
    Swal.fire({

        title:'Êtes-vous sûr ?',

        text:'Cette action est irréversible !',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#dc3545',

        cancelButtonColor:'#6c757d',

        confirmButtonText:'Oui, supprimer',

        cancelButtonText:'Annuler'

    }).then((result)=>{

        if(result.isConfirmed){

            let form=document.getElementById('delete-form');

            let url="{{ route('factures.destroy', ':id') }}";

            form.action=url.replace(':id', id);

            form.submit();

        }

    });

}

</script>

@stop
