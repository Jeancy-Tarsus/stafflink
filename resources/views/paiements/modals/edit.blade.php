<div class="modal fade"
     id="modalEditPaiement{{ $paiement->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('paiements.update',$paiement->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier un paiement

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
                                       value="{{ $paiement->reference }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Contrat</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $paiement->contrat->reference }}"
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
                                       value="{{ $paiement->contrat->affectation->demande->client->nom }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Travailleur</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $paiement->contrat->affectation->travailleur->nom }} {{ $paiement->contrat->affectation->travailleur->prenom }}"
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
                                       name="date_paiement"
                                       class="form-control"
                                       value="{{ $paiement->date_paiement->format('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Montant</label>

                                <input type="number"
                                       name="montant"
                                       class="form-control"
                                       value="{{ $paiement->montant }}"
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
                                        {{ $paiement->mode_paiement=='Espèces' ? 'selected' : '' }}>

                                        Espèces

                                    </option>

                                    <option value="Virement bancaire"
                                        {{ $paiement->mode_paiement=='Virement bancaire' ? 'selected' : '' }}>

                                        Virement bancaire

                                    </option>

                                    <option value="Chèque"
                                        {{ $paiement->mode_paiement=='Chèque' ? 'selected' : '' }}>

                                        Chèque

                                    </option>

                                    <option value="Mobile Money"
                                        {{ $paiement->mode_paiement=='Mobile Money' ? 'selected' : '' }}>

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
                               value="{{ $paiement->reference_paiement }}">

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="3"
                                  class="form-control">{{ $paiement->observation }}</textarea>

                    </div>

                    <div class="alert alert-info">

                        <strong>Salaire prévu :</strong>

                        {{ number_format($paiement->contrat->salaire,0,',',' ') }}

                        FCFA

                        <br>

                        <strong>Total payé :</strong>

                        {{ number_format($paiement->contrat->montant_paye,0,',',' ') }}

                        FCFA

                        <br>

                        <strong>Reste à payer :</strong>

                        {{ number_format($paiement->contrat->reste_a_payer,0,',',' ') }}

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
