<div class="modal fade"
     id="modalShowEncaissement{{ $encaissement->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h5 class="modal-title">

                    <i class="fas fa-eye"></i>

                    Détails de l'encaissement

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

                                <td>{{ $encaissement->reference }}</td>

                            </tr>

                            <tr>

                                <th>Facture</th>

                                <td>{{ $encaissement->facture->reference }}</td>

                            </tr>

                            <tr>

                                <th>Client</th>

                                <td>{{ $encaissement->facture->contrat->affectation->demande->client->nom }}</td>

                            </tr>

                            <tr>

                                <th>Travailleur</th>

                                <td>

                                    {{ $encaissement->facture->contrat->affectation->travailleur->nom }}

                                    {{ $encaissement->facture->contrat->affectation->travailleur->prenom }}

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>

                                <th>Date</th>

                                <td>{{ $encaissement->date_encaissement->format('d/m/Y') }}</td>

                            </tr>

                            <tr>

                                <th>Montant reçu</th>

                                <td>

                                    {{ number_format($encaissement->montant,0,',',' ') }}

                                    FCFA

                                </td>

                            </tr>

                            <tr>

                                <th>Mode de paiement</th>

                                <td>{{ $encaissement->mode_paiement }}</td>

                            </tr>

                            <tr>

                                <th>Référence paiement</th>

                                <td>

                                    {{ $encaissement->reference_paiement ?: '-' }}

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-4">

                        <div class="small-box bg-primary">

                            <div class="inner">

                                <h4>

                                    {{ number_format($encaissement->facture->montant,0,',',' ') }}

                                </h4>

                                <p>

                                    Montant facture

                                </p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-file-invoice-dollar"></i>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="small-box bg-success">

                            <div class="inner">

                                <h4>

                                    {{ number_format($encaissement->facture->montant_encaisse,0,',',' ') }}

                                </h4>

                                <p>

                                    Total encaissé

                                </p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-money-bill-wave"></i>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="small-box bg-danger">

                            <div class="inner">

                                <h4>

                                    {{ number_format($encaissement->facture->reste,0,',',' ') }}

                                </h4>

                                <p>

                                    Reste à payer

                                </p>

                            </div>

                            <div class="icon">

                                <i class="fas fa-balance-scale"></i>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="form-group">

                    <label>Observation</label>

                    <textarea class="form-control"
                              rows="3"
                              readonly>{{ $encaissement->observation }}</textarea>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-dismiss="modal">

                    Fermer

                </button>

            </div>

        </div>

    </div>

</div>
