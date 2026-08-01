<div class="modal fade"
     id="modalEditDemande{{ $demande->id }}"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('demandes.update', $demande->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier la demande

                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <h5 class="text-primary">

                        <i class="fas fa-info-circle"></i>

                        Informations générales

                    </h5>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Client
                                    <span class="text-danger">*</span>

                                </label>

                                <select name="client_id"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Sélectionner --
                                    </option>

                                    @foreach($clients as $client)

                                        <option value="{{ $client->id }}"
                                            {{ $client->id == $demande->client_id ? 'selected' : '' }}>

                                            {{ $client->nom }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Métier recherché
                                    <span class="text-danger">*</span>

                                </label>

                                <select name="metier_id"
                                        class="form-control"
                                        required>

                                    <option value="">
                                        -- Sélectionner --
                                    </option>

                                    @foreach($metiers as $metier)

                                        <option value="{{ $metier->id }}"
                                            {{ $metier->id == $demande->metier_id ? 'selected' : '' }}>

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

                                <label>

                                    Nombre demandé

                                </label>

                                <input type="number"
                                       name="nombre"
                                       class="form-control"
                                       min="1"
                                       value="{{ $demande->nombre }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>

                                    Date de début

                                </label>

                                <input type="date"
                                       name="date_debut"
                                       class="form-control"
                                       value="{{ $demande->date_debut->format('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>

                                    Date de fin

                                </label>

                                <input type="date"
                                       name="date_fin"
                                       class="form-control"
                                       value="{{ $demande->date_fin ? $demande->date_fin->format('Y-m-d') : '' }}">

                            </div>

                        </div>

                    </div>

                    <h5 class="text-primary mt-4">

                        <i class="fas fa-exclamation-circle"></i>

                        Priorité

                    </h5>

                    <hr>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Urgence

                                </label>

                                <select name="urgence"
                                        class="form-control">

                                    <option value="Normale"
                                        {{ $demande->urgence == 'Normale' ? 'selected' : '' }}>

                                        Normale

                                    </option>

                                    <option value="Urgente"
                                        {{ $demande->urgence == 'Urgente' ? 'selected' : '' }}>

                                        Urgente

                                    </option>

                                    <option value="Très urgente"
                                        {{ $demande->urgence == 'Très urgente' ? 'selected' : '' }}>

                                        Très urgente

                                    </option>

                                </select>

                            </div>

                        </div>
                                                <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Statut

                                </label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $demande->statut }}"
                                       readonly>

                                <small class="text-muted">

                                    Le statut est géré automatiquement par le système.

                                </small>

                            </div>

                        </div>

                    </div>

                    <h5 class="text-primary mt-4">

                        <i class="fas fa-sticky-note"></i>

                        Observation

                    </h5>

                    <hr>

                    <div class="form-group">

                        <textarea name="observation"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Informations complémentaires...">{{ $demande->observation }}</textarea>

                    </div>

                    <div class="alert alert-info mt-3">

                        <i class="fas fa-info-circle"></i>

                        <strong>Référence :</strong>
                        {{ $demande->reference }}
                        <br>

                        <strong>Nombre déjà affecté :</strong>
                        {{ $demande->nombre_affectes }}

                        <br>

                        <strong>Nombre restant :</strong>
                        {{ $demande->nombre_restant }}

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Enregistrer les modifications

                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>

                        Annuler

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
