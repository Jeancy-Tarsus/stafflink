<div class="modal fade"
     id="createDemandeModal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('demandes.store') }}"
              method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-primary">

                    <h5 class="modal-title">

                        <i class="fas fa-plus-circle"></i>

                        Nouvelle demande de personnel

                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    {{-- Informations générales --}}

                    <h5 class="text-primary">

                        <i class="fas fa-info-circle"></i>

                        Informations générales

                    </h5>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Client <span class="text-danger">*</span></label>

                                <select name="client_id"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Sélectionner --
                                    </option>

                                    @foreach($clients as $client)

                                        <option value="{{ $client->id }}">

                                            {{ $client->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Métier recherché <span class="text-danger">*</span></label>

                                <select name="metier_id"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Sélectionner --
                                    </option>

                                    @foreach($metiers as $metier)

                                        <option value="{{ $metier->id }}">

                                            {{ $metier->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Nombre demandé</label>

                                <input type="number"
                                       name="nombre"
                                       min="1"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date de début</label>

                                <input type="date"
                                       name="date_debut"
                                       class="form-control"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date de fin</label>

                                <input type="date"
                                       name="date_fin"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                    {{-- Suivi --}}

                    <h5 class="text-primary mt-4">

                        <i class="fas fa-tasks"></i>

                        Suivi

                    </h5>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Urgence</label>

                                <select name="urgence"
                                        class="form-control">

                                    <option value="Normale">
                                        Normale
                                    </option>

                                    <option value="Urgente">
                                        Urgente
                                    </option>

                                    <option value="Très urgente">
                                        Très urgente
                                    </option>

                                </select>

                            </div>

                        </div>


                    </div>

                    {{-- Observation --}}

                    <h5 class="text-primary mt-4">

                        <i class="fas fa-sticky-note"></i>

                        Observation

                    </h5>

                    <hr>

                    <div class="form-group">

                        <textarea name="observation"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Informations complémentaires..."></textarea>

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

                        Annuler

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
