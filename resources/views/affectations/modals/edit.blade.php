<div class="modal fade"
     id="modalEditAffectation{{ $affectation->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <form action="{{ route('affectations.update', $affectation->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier l'affectation

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
                                       value="{{ $affectation->reference }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Client</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $affectation->demande->client->nom }}"
                                       readonly>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Travailleur</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $affectation->travailleur->nom }} {{ $affectation->travailleur->prenom }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Métier</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $affectation->demande->metier->nom }}"
                                       readonly>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Date de fin</label>

                                <input type="date"
                                       name="date_fin"
                                       class="form-control"
                                       value="{{ optional($affectation->date_fin)->format('Y-m-d') }}">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Statut</label>

                                <select name="statut"
                                        class="form-control">

                                    <option value="En mission"
                                        {{ $affectation->statut=='En mission' ? 'selected' : '' }}>
                                        En mission
                                    </option>

                                    <option value="Suspendue"
                                        {{ $affectation->statut=='Suspendue' ? 'selected' : '' }}>
                                        Suspendue
                                    </option>

                                    <option value="Terminée"
                                        {{ $affectation->statut=='Terminée' ? 'selected' : '' }}>
                                        Terminée
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="4"
                                  class="form-control">{{ $affectation->observation }}</textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-warning">

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
