<div class="modal fade"
     id="modalCreateContrat"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <form action="{{ route('contrats.store') }}"
              method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-primary">

                    <h5 class="modal-title">

                        <i class="fas fa-file-signature"></i>

                        Nouveau contrat

                    </h5>

                    <button class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>

                            Affectation

                        </label>

                        <select name="affectation_id"
                                class="form-control"
                                required>

                            <option value="">

                                Choisir...

                            </option>

                            @foreach($affectations as $affectation)

                                <option value="{{ $affectation->id }}">

                                    {{ $affectation->reference }}

                                    |

                                    {{ $affectation->demande->client->nom }}

                                    |

                                    {{ $affectation->travailleur->nom }}

                                    {{ $affectation->travailleur->prenom }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>

                                    Date signature

                                </label>

                                <input type="date"
                                       name="date_signature"
                                       class="form-control"
                                       value="{{ date('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>

                                    Début

                                </label>

                                <input type="date"
                                       name="date_debut"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>

                                    Fin

                                </label>

                                <input type="date"
                                       name="date_fin"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Salaire

                                </label>

                                <input type="number"
                                       step="0.01"
                                       name="salaire"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Observation

                                </label>

                                <textarea name="observation"
                                          rows="3"
                                          class="form-control"></textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Enregistrer

                    </button>

                    <button class="btn btn-secondary"
                            data-dismiss="modal">

                        Fermer

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
