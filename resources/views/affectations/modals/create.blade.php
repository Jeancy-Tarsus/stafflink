<div class="modal fade"
     id="createAffectationModal"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <form action="{{ route('affectations.store') }}" method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-primary">

                    <h5 class="modal-title">

                        <i class="fas fa-user-check"></i>

                        Nouvelle affectation

                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Demande</label>

                        <select name="demande_id"
                                class="form-control"
                                required>

                            <option value="">Sélectionner une demande</option>

                            @foreach($demandes as $demande)

                                <option value="{{ $demande->id }}">

                                    {{ $demande->reference }}
                                    -
                                    {{ $demande->client->nom }}
                                    -
                                    {{ $demande->metier->nom }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Travailleur</label>

                        <select name="travailleur_id"
                                class="form-control"
                                required>

                            <option value="">Sélectionner un travailleur</option>

                            @foreach($travailleurs as $travailleur)

                                <option value="{{ $travailleur->id }}">

                                    {{ $travailleur->nom }}
                                    {{ $travailleur->prenom }}
                                    -
                                    {{ $travailleur->metier->nom }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Date d'affectation</label>

                                <input type="date"
                                       name="date_affectation"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Date de fin</label>

                                <input type="date"
                                       name="date_fin"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="3"
                                  class="form-control"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Enregistrer

                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">

                        Annuler

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
