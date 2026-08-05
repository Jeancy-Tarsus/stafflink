<div class="modal fade"
     id="modalShowFacture{{ $facture->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h5 class="modal-title">

                    <i class="fas fa-file-invoice-dollar"></i>

                    Détails de la facture

                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>
                                <th>Référence</th>
                                <td>{{ $facture->reference }}</td>
                            </tr>

                            <tr>
                                <th>Contrat</th>
                                <td>{{ $facture->contrat->reference }}</td>
                            </tr>

                            <tr>
                                <th>Client</th>
                                <td>{{ $facture->contrat->affectation->demande->client->nom }}</td>
                            </tr>

                            <tr>
                                <th>Travailleur</th>
                                <td>
                                    {{ $facture->contrat->affectation->travailleur->nom }}
                                    {{ $facture->contrat->affectation->travailleur->prenom }}
                                </td>
                            </tr>

                            <tr>
                                <th>Métier</th>
                                <td>
                                    {{ $facture->contrat->affectation->demande->metier->nom }}
                                </td>
                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>
                                <th>Date facture</th>
                                <td>{{ $facture->date_facture->format('d/m/Y') }}</td>
                            </tr>

                            <tr>
                                <th>Date échéance</th>
                                <td>
                                    {{ $facture->date_echeance ? $facture->date_echeance->format('d/m/Y') : '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Montant</th>
                                <td>
                                    {{ number_format($facture->montant,0,',',' ') }}
                                    FCFA
                                </td>
                            </tr>

                            <tr>
                                <th>Montant encaissé</th>
                                <td class="text-success">

                                    <strong>

                                        {{ number_format($facture->montant_encaisse,0,',',' ') }}

                                        FCFA

                                    </strong>

                                </td>
                            </tr>

                            <tr>
                                <th>Reste à payer</th>
                                <td class="text-danger">

                                    <strong>

                                        {{ number_format($facture->reste,0,',',' ') }}

                                        FCFA

                                    </strong>

                                </td>
                            </tr>

                            <tr>

                                <th>Statut</th>

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

                            </tr>

                        </table>

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-12">

                        <div class="card">

                            <div class="card-header">

                                <strong>Objet de la facture</strong>

                            </div>

                            <div class="card-body">

                                {{ $facture->objet }}

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="card">

                            <div class="card-header">

                                <strong>Conditions de paiement</strong>

                            </div>

                            <div class="card-body">

                                {{ $facture->conditions_paiement ?: 'Aucune condition renseignée.' }}

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card">

                            <div class="card-header">

                                <strong>Observation</strong>

                            </div>

                            <div class="card-body">

                                {{ $facture->observation ?: 'Aucune observation.' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                    Fermer

                </button>

            </div>

        </div>

    </div>

</div>
