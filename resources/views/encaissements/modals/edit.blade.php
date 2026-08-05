<div class="modal fade"
     id="modalEditEncaissement{{ $encaissement->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('encaissements.update',$encaissement->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier un encaissement

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
                                       value="{{ $encaissement->reference }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Facture</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $encaissement->facture->reference }}"
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
                                       value="{{ $encaissement->facture->contrat->affectation->demande->client->nom }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Travailleur</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $encaissement->facture->contrat->affectation->travailleur->nom }} {{ $encaissement->facture->contrat->affectation->travailleur->prenom }}"
                                       readonly>

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
                                       class="form-control"
                                       value="{{ $encaissement->date_encaissement->format('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Montant</label>

                                <input type="number"
                                       name="montant"
                                       class="form-control"
                                       value="{{ $encaissement->montant }}"
                                       min="1"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Mode de paiement</label>

                                <select name="mode_paiement"
                                        class="form-control">

                                    <option value="Espèces"
                                        {{ $encaissement->mode_paiement=='Espèces'?'selected':'' }}>

                                        Espèces

                                    </option>

                                    <option value="Virement bancaire"
                                        {{ $encaissement->mode_paiement=='Virement bancaire'?'selected':'' }}>

                                        Virement bancaire

                                    </option>

                                    <option value="Chèque"
                                        {{ $encaissement->mode_paiement=='Chèque'?'selected':'' }}>

                                        Chèque

                                    </option>

                                    <option value="Mobile Money"
                                        {{ $encaissement->mode_paiement=='Mobile Money'?'selected':'' }}>

                                        Mobile Money

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Référence du paiement</label>

                        <input type="text"
                               name="reference_paiement"
                               class="form-control"
                               value="{{ $encaissement->reference_paiement }}">

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="3"
                                  class="form-control">{{ $encaissement->observation }}</textarea>

                    </div>

                    <div class="alert alert-info">

                        <strong>Montant facture :</strong>

                        {{ number_format($encaissement->facture->montant,0,',',' ') }}

                        FCFA

                        <br>

                        <strong>Total encaissé :</strong>

                        {{ number_format($encaissement->facture->montant_encaisse,0,',',' ') }}

                        FCFA

                        <br>

                        <strong>Reste à payer :</strong>

                        {{ number_format($encaissement->facture->reste,0,',',' ') }}

                        FCFA

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
