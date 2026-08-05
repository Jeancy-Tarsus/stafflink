<div class="modal fade"
     id="modalCreatePaiement"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('paiements.store') }}"
              method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-success">

                    <h5 class="modal-title">

                        <i class="fas fa-money-check-alt"></i>

                        Nouveau paiement

                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Contrat</label>

                        <select name="contrat_id"
                                id="contrat_id"
                                class="form-control"
                                required>

                            <option value="">
                                -- Sélectionner un contrat --
                            </option>

                            @foreach($contrats as $contrat)

                                <option
                                    value="{{ $contrat->id }}"
                                    data-client="{{ $contrat->affectation->demande->client->nom }}"
                                    data-travailleur="{{ $contrat->affectation->travailleur->nom }} {{ $contrat->affectation->travailleur->prenom }}"
                                    data-salaire="{{ $contrat->salaire }}"
                                    data-paye="{{ $contrat->montant_paye }}"
                                    data-reste="{{ $contrat->reste_a_payer }}"
                                    data-reference="{{ $contrat->reference }}">

                                    {{ $contrat->reference }}
                                    |
                                    {{ $contrat->affectation->demande->client->nom }}
                                    |
                                    {{ $contrat->affectation->travailleur->nom }}
                                    {{ $contrat->affectation->travailleur->prenom }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="card card-light">

                        <div class="card-header">

                            <strong>

                                Informations du contrat

                            </strong>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <p>

                                        <strong>Client :</strong>

                                        <span id="clientContrat">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Travailleur :</strong>

                                        <span id="travailleurContrat">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Salaire prévu :</strong>

                                        <span id="salaireContrat">

                                            -

                                        </span>

                                    </p>

                                </div>

                                <div class="col-md-6">

                                    <p>

                                        <strong>Déjà payé :</strong>

                                        <span id="dejaPaye">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Reste à payer :</strong>

                                        <span id="resteAPayer"
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
                                       name="date_paiement"
                                       class="form-control"
                                       value="{{ date('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Montant</label>

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
