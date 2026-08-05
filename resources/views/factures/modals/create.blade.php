<div class="modal fade"
     id="modalCreateFacture"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('factures.store') }}"
              method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-primary">

                    <h5 class="modal-title">

                        <i class="fas fa-file-invoice-dollar"></i>

                        Nouvelle facture

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
                                    data-reference="{{ $contrat->reference }}"
                                    data-client="{{ $contrat->affectation->demande->client->nom }}"
                                    data-travailleur="{{ $contrat->affectation->travailleur->nom }} {{ $contrat->affectation->travailleur->prenom }}"
                                    data-metier="{{ $contrat->affectation->demande->metier->nom }}"
                                    data-montant="{{ $contrat->montant_client }}">

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

                                        <strong>Référence :</strong>

                                        <span id="referenceContrat">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Client :</strong>

                                        <span id="clientNom">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Montant facturé :</strong>

                                        <span id="montantContrat">

                                            -

                                        </span>

                                    </p>

                                </div>

                                <div class="col-md-6">

                                    <p>

                                        <strong>Travailleur :</strong>

                                        <span id="travailleurNom">

                                            -

                                        </span>

                                    </p>

                                    <p>

                                        <strong>Métier :</strong>

                                        <span id="metierNom">

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

                                <label>Date facture</label>

                                <input type="date"
                                       name="date_facture"
                                       class="form-control"
                                       value="{{ date('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date échéance</label>

                                <input type="date"
                                       name="date_echeance"
                                       class="form-control">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Montant (FCFA)</label>

                                <input type="number"
                                       id="montant"
                                       name="montant"
                                       class="form-control"
                                       readonly
                                       required>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Objet de la facture</label>

                        <input type="text"
                               name="objet"
                               class="form-control"
                               placeholder="Ex : Mise à disposition d'un travailleur"
                               required>

                    </div>

                    <div class="form-group">

                        <label>Conditions de paiement</label>

                        <textarea name="conditions_paiement"
                                  rows="3"
                                  class="form-control"
                                  placeholder="Ex : Paiement sous 30 jours"></textarea>

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
                            class="btn btn-primary">

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
