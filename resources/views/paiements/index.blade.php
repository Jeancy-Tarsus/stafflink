@extends('adminlte::page')

@section('title','Paiements')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        <i class="fas fa-money-check-alt"></i>

        Gestion des paiements

    </h1>

    <button class="btn btn-success"
            data-toggle="modal"
            data-target="#modalCreatePaiement">

        <i class="fas fa-plus"></i>

        Nouveau paiement

    </button>

</div>

@stop

@section('content')

<div class="card card-success shadow">

    <div class="card-header">

        <form action="{{ route('paiements.index') }}"
              method="GET">

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           class="form-control"
                           name="recherche"
                           placeholder="Rechercher..."
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

                    <th>Contrat</th>

                    <th>Client</th>

                    <th>Travailleur</th>

                    <th>Date</th>

                    <th>Montant</th>

                    <th>Mode</th>

                    <th width="170">

                        Actions

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($paiements as $paiement)

                <tr>

                    <td>

                        {{ $paiements->firstItem()+$loop->index }}

                    </td>

                    <td>

                        {{ $paiement->reference }}

                    </td>

                    <td>

                        {{ $paiement->contrat->reference }}

                    </td>

                    <td>

                        {{ $paiement->contrat->affectation->demande->client->nom }}

                    </td>

                    <td>

                        {{ $paiement->contrat->affectation->travailleur->nom }}

                        {{ $paiement->contrat->affectation->travailleur->prenom }}

                    </td>

                    <td>

                        {{ $paiement->date_paiement->format('d/m/Y') }}

                    </td>

                    <td>

                        {{ number_format($paiement->montant,0,',',' ') }}

                        FCFA

                    </td>

                    <td>

                        {{ $paiement->mode_paiement }}

                    </td>

                    <td>

                        <div class="btn-group">

                            <button class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalShowPaiement{{ $paiement->id }}">

                                <i class="fas fa-eye"></i>

                            </button>

                            <button class="btn btn-warning btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalEditPaiement{{ $paiement->id }}">

                                <i class="fas fa-edit"></i>

                            </button>

                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmDelete({{ $paiement->id }})">

                                <i class="fas fa-trash"></i>

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9"
                        class="text-center">

                        Aucun paiement enregistré.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $paiements->links('pagination::bootstrap-4') }}

    </div>

</div>

@foreach($paiements as $paiement)

    @include('paiements.modals.show',['paiement'=>$paiement])

    @include('paiements.modals.edit',['paiement'=>$paiement])

@endforeach

@include('paiements.modals.create')

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

    html:`{!! implode('<br>',$errors->all()) !!}`

});

</script>

@endif

<script>

$(document).ready(function(){

    @if($errors->any())

        $('#modalCreatePaiement').modal('show');

    @endif

});

function confirmDelete(id)
{

    Swal.fire({

        title:'Êtes-vous sûr ?',

        text:'Ce paiement sera supprimé.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#dc3545',

        cancelButtonColor:'#6c757d',

        confirmButtonText:'Oui, supprimer',

        cancelButtonText:'Annuler'

    }).then((result)=>{

        if(result.isConfirmed){

            let form=document.getElementById('delete-form');

            let url="{{ route('paiements.destroy', ':id') }}";

            form.action=url.replace(':id',id);

            form.submit();

        }

    });

}

// ===============================
// Informations du contrat
// ===============================

$('#contrat_id').on('change', function(){

    let option = $(this).find(':selected');

    let client = option.data('client');

    let travailleur = option.data('travailleur');

    let salaire = parseFloat(option.data('salaire')) || 0;

    let dejaPaye = parseFloat(option.data('paye')) || 0;

    let reste = parseFloat(option.data('reste')) || 0;

    $('#clientContrat').text(client);

    $('#travailleurContrat').text(travailleur);

    $('#salaireContrat').text(
        salaire.toLocaleString('fr-FR') + ' FCFA'
    );

    $('#dejaPaye').text(
        dejaPaye.toLocaleString('fr-FR') + ' FCFA'
    );

    $('#resteAPayer').text(
        reste.toLocaleString('fr-FR') + ' FCFA'
    );

    $('#montant').attr('max', reste);

});


// Vérification du montant

$('#montant').on('input', function(){

    let max = parseFloat($(this).attr('max')) || 0;

    let valeur = parseFloat($(this).val()) || 0;

    if(valeur > max && max > 0){

        Swal.fire({

            icon:'warning',

            title:'Montant invalide',

            text:'Le montant dépasse le salaire restant à payer.'

        });

        $(this).val(max);

    }

});


</script>

@stop
