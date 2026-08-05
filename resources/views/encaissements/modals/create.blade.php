<div class="modal fade"
     id="modalCreateEncaissement"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('encaissements.store') }}"
              method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-success">

                    <h5 class="modal-title">

                        <i class="fas fa-cash-register"></i>

                        Nouvel encaissement

                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Facture</label>

                        <select name="facture_id"
                                id="facture_id"
                                class="form-control"
                                required>

                            <option value="">
                                -- Sélectionner une facture --
                            </option>

                            @foreach($factures as $facture)

                                <option
                                    value="{{ $facture->id }}"

                                    data-client="{{ $facture->contrat->affectation->demande->client->nom }}"

                                    data-montant="{{ $facture->montant }}"

                                    data-encaisse="{{ $facture->montant_encaisse }}"

                                    data-reste="{{ $facture->reste }}">

                                    {{ $facture->reference }}
                                    |
                                    {{ $facture->contrat->affectation->demande->client->nom }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="card card-light">

                        <div class="card-header">

                            <strong>

                                Informations de la facture

                            </strong>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <p>

                                        <strong>Client :</strong>

                                        <span id="clientFacture">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Montant facture :</strong>

                                        <span id="montantFacture">

                                            -

                                        </span>

                                    </p>

                                </div>

                                <div class="col-md-6">

                                    <p>

                                        <strong>Déjà encaissé :</strong>

                                        <span id="montantEncaisse">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Reste à payer :</strong>

                                        <span id="resteFacture"
                                              class="text-danger font-weight-bold">

                                            -

                                        </span>

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date</label>

                                <input type="date"
                                       name="date_encaissement"
                                       value="{{ date('Y-m-d') }}"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Montant reçu</label>

                                <input type="number"
                                       name="montant"
                                       id="montant"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Mode de paiement</label>

                                <select name="mode_paiement"
                                        class="form-control"
                                        required>

                                    <option>Espèces</option>

                                    <option>Virement bancaire</option>

                                    <option>Chèque</option>

                                    <option>Mobile Money</option>

                                </select>

                            </div>

                        </div>

                    </div>
                                        <div class="form-group">

                        <label>Référence du paiement</label>

                        <input type="text"
                               name="reference_paiement"
                               class="form-control"
                               placeholder="Ex : TRX458796">

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="3"
                                  class="form-control"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Enregistrer

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
