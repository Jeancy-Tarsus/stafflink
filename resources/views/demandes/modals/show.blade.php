<div class="modal fade"
     id="modalShowDemande{{ $demande->id }}"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <div class="modal-content shadow">

            <div class="modal-header bg-info">

                <h5 class="modal-title">

                    <i class="fas fa-clipboard-list"></i>

                    Détails de la demande

                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="text-center mb-4">

                    <h3>

                        {{ $demande->reference }}

                    </h3>

                    <span class="badge badge-primary">

                        {{ $demande->statut }}

                    </span>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>

                                <th>Client</th>

                                <td>{{ $demande->client->nom }}</td>

                            </tr>

                            <tr>

                                <th>Métier</th>

                                <td>{{ $demande->metier->nom }}</td>

                            </tr>

                            <tr>

                                <th>Nombre demandé</th>

                                <td>{{ $demande->nombre }}</td>

                            </tr>

                            <tr>

                                <th>Nombre affecté</th>

                                <td>{{ $demande->nombre_affectes }}</td>

                            </tr>

                            <tr>

                                <th>Nombre restant</th>

                                <td>

                                    <span class="badge badge-info">

                                        {{ $demande->nombre_restant }}

                                    </span>

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>

                                <th>Date début</th>

                                <td>

                                    {{ $demande->date_debut->format('d/m/Y') }}

                                </td>

                            </tr>

                            <tr>

                                <th>Date fin</th>

                                <td>

                                    {{ $demande->date_fin ? $demande->date_fin->format('d/m/Y') : '-' }}

                                </td>

                            </tr>

                            <tr>

                                <th>Urgence</th>

                                <td>

                                    {{ $demande->urgence }}

                                </td>

                            </tr>

                            <tr>

                                <th>Statut</th>

                                <td>

                                    {{ $demande->statut }}

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

                <div class="card card-light mt-3">

                    <div class="card-header">

                        Observation

                    </div>

                    <div class="card-body">

                        {{ $demande->observation ?: 'Aucune observation.' }}

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-dismiss="modal">

                    Fermer

                </button>

            </div>

        </div>

    </div>

</div>
