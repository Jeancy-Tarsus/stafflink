<div class="modal fade" id="createTravailleurModal" tabindex="-1" role="dialog" aria-labelledby="createTravailleurModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <form action="{{ route('travailleurs.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="modal-content">

                <div class="modal-header bg-primary">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus"></i>
                        Nouveau travailleur
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nom <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="nom"
                                    class="form-control"
                                    value="{{ old('nom') }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prénom <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="prenom"
                                    class="form-control"
                                    value="{{ old('prenom') }}"
                                    required>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sexe</label>

                                <select name="sexe" class="form-control">

                                    <option value="">-- Sélectionner --</option>

                                    <option value="Masculin">Masculin</option>

                                    <option value="Féminin">Féminin</option>

                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date de naissance</label>

                                <input type="date"
                                    name="date_naissance"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Photo</label>

                                <input type="file"
                                    name="photo"
                                    class="form-control">

                            </div>

                        </div>

                    </div>


                <hr>

                <h5 class="text-primary mb-3">
                    <i class="fas fa-address-book"></i>
                    Coordonnées
                </h5>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Téléphone <span class="text-danger">*</span></label>
                            <input type="text"
                                name="telephone"
                                class="form-control"
                                value="{{ old('telephone') }}"
                                placeholder="Ex : 06XXXXXXXX"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="exemple@email.com">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Adresse <span class="text-danger">*</span></label>
                            <textarea name="adresse"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Saisir l'adresse complète"
                                    required>{{ old('adresse') }}</textarea>
                        </div>
                    </div>

                </div>


                <hr>

                <h5 class="text-primary mb-3">
                    <i class="fas fa-briefcase"></i>
                    Informations professionnelles
                </h5>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Métier <span class="text-danger">*</span></label>

                            <select name="metier_id" class="form-control" required>

                                <option value="">-- Sélectionner un métier --</option>

                                @foreach($metiers as $metier)
                                    <option value="{{ $metier->id }}">
                                        {{ $metier->nom }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expérience</label>

                            <input type="text"
                                name="experience"
                                class="form-control"
                                placeholder="Ex : 5 ans">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Salaire souhaité (FCFA)</label>

                            <input type="number"
                                name="salaire_souhaite"
                                class="form-control"
                                min="0"
                                step="1000">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Disponible</label>

                            <select name="disponible" class="form-control">

                                <option value="1">Oui</option>
                                <option value="0">Non</option>

                            </select>

                        </div>

                    </div>

                </div>

                <hr>

                <h5 class="text-primary mb-3">
                    <i class="fas fa-sticky-note"></i>
                    Observations
                </h5>

                <div class="form-group">

                    <label>Observation</label>

                    <textarea name="observation"
                            class="form-control"
                            rows="3"
                            placeholder="Informations complémentaires..."></textarea>

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
