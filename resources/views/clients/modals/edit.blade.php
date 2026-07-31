<div class="modal fade"
     id="modalEditClient{{ $client->id }}"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <form action="{{ route('clients.update', $client->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier le client

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

                                <label>Nom du client</label>

                                <input type="text"
                                       name="nom"
                                       class="form-control"
                                       value="{{ old('nom', $client->nom) }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Type</label>

                                <select name="type"
                                        class="form-control">

                                    <option value="Entreprise"
                                        {{ $client->type=='Entreprise'?'selected':'' }}>
                                        Entreprise
                                    </option>

                                    <option value="Particulier"
                                        {{ $client->type=='Particulier'?'selected':'' }}>
                                        Particulier
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Statut</label>

                                <select name="actif"
                                        class="form-control">

                                    <option value="1"
                                        {{ $client->actif ? 'selected':'' }}>
                                        Actif
                                    </option>

                                    <option value="0"
                                        {{ !$client->actif ? 'selected':'' }}>
                                        Inactif
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Responsable</label>

                                <input type="text"
                                       name="responsable"
                                       class="form-control"
                                       value="{{ old('responsable', $client->responsable) }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Fonction</label>

                                <input type="text"
                                       name="fonction"
                                       class="form-control"
                                       value="{{ old('fonction', $client->fonction) }}">

                            </div>

                        </div>

                    </div>

                    <h5 class="text-primary mt-4">
                        <i class="fas fa-phone"></i>
                        Coordonnées
                    </h5>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Téléphone</label>

                                <input type="text"
                                       name="telephone"
                                       class="form-control"
                                       value="{{ old('telephone', $client->telephone) }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Téléphone secondaire</label>

                                <input type="text"
                                       name="telephone_secondaire"
                                       class="form-control"
                                       value="{{ old('telephone_secondaire', $client->telephone_secondaire) }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Email</label>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email', $client->email) }}">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-8">

                            <div class="form-group">

                                <label>Adresse</label>

                                <input type="text"
                                       name="adresse"
                                       class="form-control"
                                       value="{{ old('adresse', $client->adresse) }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Ville</label>

                                <input type="text"
                                       name="ville"
                                       class="form-control"
                                       value="{{ old('ville', $client->ville) }}"
                                       required>

                            </div>

                        </div>

                    </div>

                    <h5 class="text-primary mt-4">
                        <i class="fas fa-briefcase"></i>
                        Informations professionnelles
                    </h5>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Secteur d'activité</label>

                                <input type="text"
                                       name="secteur_activite"
                                       class="form-control"
                                       value="{{ old('secteur_activite', $client->secteur_activite) }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>RCCM</label>

                                <input type="text"
                                       name="rccm"
                                       class="form-control"
                                       value="{{ old('rccm', $client->rccm) }}">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>NIU</label>

                                <input type="text"
                                       name="niu"
                                       class="form-control"
                                       value="{{ old('niu', $client->niu) }}">

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
                                  class="form-control">{{ old('observation', $client->observation) }}</textarea>

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

                        Annuler

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
