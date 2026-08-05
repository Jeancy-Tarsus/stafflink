<div class="modal fade"
     id="modalEditContrat{{ $contrat->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <form action="{{ route('contrats.update', $contrat->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>

                        Modifier le contrat

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
                                       value="{{ $contrat->reference }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Client</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $contrat->affectation->demande->client->nom }}"
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
                                       value="{{ $contrat->affectation->travailleur->nom }} {{ $contrat->affectation->travailleur->prenom }}"
                                       readonly>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Métier</label>

                                <input type="text"
                                       class="form-control"
                                       value="{{ $contrat->affectation->demande->metier->nom }}"
                                       readonly>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date signature</label>

                                <input type="date"
                                       name="date_signature"
                                       class="form-control"
                                       value="{{ $contrat->date_signature->format('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date début</label>

                                <input type="date"
                                       name="date_debut"
                                       class="form-control"
                                       value="{{ $contrat->date_debut->format('Y-m-d') }}"
                                       required>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label>Date fin</label>

                                <input type="date"
                                       name="date_fin"
                                       class="form-control"
                                       value="{{ optional($contrat->date_fin)->format('Y-m-d') }}">

                            </div>

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Salaire</label>

                                <input type="number"
                                    step="0.01"
                                    name="salaire"
                                    class="form-control"
                                    value="{{ $contrat->salaire }}"
                                    required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Montant facturé au client (FCFA)</label>

                                <input type="number"
                                    step="0.01"
                                    name="montant_client"
                                    class="form-control"
                                    value="{{ $contrat->montant_client }}"
                                    required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Statut</label>

                                <select name="statut"
                                        class="form-control">

                                    <option value="Actif"
                                        {{ $contrat->statut == 'Actif' ? 'selected' : '' }}>
                                        Actif
                                    </option>

                                    <option value="Terminé"
                                        {{ $contrat->statut == 'Terminé' ? 'selected' : '' }}>
                                        Terminé
                                    </option>

                                    <option value="Résilié"
                                        {{ $contrat->statut == 'Résilié' ? 'selected' : '' }}>
                                        Résilié
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Observation</label>

                        <textarea name="observation"
                                  rows="4"
                                  class="form-control">{{ $contrat->observation }}</textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-warning">

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
