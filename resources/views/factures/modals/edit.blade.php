<div class="modal fade"
     id="modalEditFacture{{ $facture->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('factures.update', $facture->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier la facture

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

                            <div class="form-group">

                                <label>Référence</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $facture->reference }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Contrat</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $facture->contrat->reference }}"
                                       readonly>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Client</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $facture->contrat->affectation->demande->client->nom }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Travailleur</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $facture->contrat->affectation->travailleur->nom }} {{ $facture->contrat->affectation->travailleur->prenom }}"
                                       readonly>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date facture</label>

                                <input type="date"
                                       name="date_facture"
                                       class="form-control"
                                       value="{{ $facture->date_facture->format('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date échéance</label>

                                <input type="date"
                                       name="date_echeance"
                                       class="form-control"
                                       value="{{ optional($facture->date_echeance)->format('Y-m-d') }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Montant (FCFA)</label>

                                <input type="number"
                                       name="montant"
                                       class="form-control"
                                       value="{{ $facture->montant }}"
                                       min="1"
                                       required>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Objet de la facture</label>

                        <input type="text"
                               name="objet"
                               class="form-control"
                               value="{{ $facture->objet }}"
                               required>

                    </div>

                    <div class="form-group">

                        <label>Conditions de paiement</label>

                        <textarea name="conditions_paiement"
                                  rows="3"
                                  class="form-control">{{ $facture->conditions_paiement }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="3"
                                  class="form-control">{{ $facture->observation }}</textarea>

                    </div>

                    <div class="alert alert-info">

                        <i class="fas fa-info-circle"></i>

                        <strong>Statut :</strong>

                        {{ $facture->statut }}

                        <br>

                        <small>

                            Le statut de la facture est mis à jour automatiquement selon les encaissements.

                        </small>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Mettre à jour

                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">

                        Fermer

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
