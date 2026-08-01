<div class="modal fade"
     id="modalShowAffectation{{ $affectation->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h5 class="modal-title">

                    <i class="fas fa-user-check"></i>

                    Détails de l'affectation

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

                        <div class="text-center mb-3">

                            @if($affectation->travailleur->photo)

                                <img src="{{ asset('storage/'.$affectation->travailleur->photo) }}"
                                     class="img-circle elevation-2"
                                     width="120"
                                     height="120"
                                     style="object-fit:cover;">

                            @else

                                <img src="https://via.placeholder.com/120"
                                     class="img-circle">

                            @endif

                        </div>

                        <table class="table table-sm">

                            <tr>
                                <th>Travailleur</th>
                                <td>
                                    {{ $affectation->travailleur->nom }}
                                    {{ $affectation->travailleur->prenom }}
                                </td>
                            </tr>

                            <tr>
                                <th>Métier</th>
                                <td>
                                    {{ $affectation->demande->metier->nom }}
                                </td>
                            </tr>

                            <tr>
                                <th>Téléphone</th>
                                <td>
                                    {{ $affectation->travailleur->telephone }}
                                </td>
                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>
                                <th>Référence</th>
                                <td>{{ $affectation->reference }}</td>
                            </tr>

                            <tr>
                                <th>Client</th>
                                <td>{{ $affectation->demande->client->nom }}</td>
                            </tr>

                            <tr>
                                <th>Date d'affectation</th>
                                <td>{{ $affectation->date_affectation->format('d/m/Y') }}</td>
                            </tr>

                            <tr>
                                <th>Date de fin</th>
                                <td>
                                    {{ $affectation->date_fin ? $affectation->date_fin->format('d/m/Y') : '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Date retour</th>
                                <td>
                                    {{ $affectation->date_retour ? $affectation->date_retour->format('d/m/Y') : '-' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Statut</th>
                                <td>

                                    @if($affectation->statut=='En mission')

                                        <span class="badge badge-success">
                                            En mission
                                        </span>

                                    @elseif($affectation->statut=='Terminée')

                                        <span class="badge badge-primary">
                                            Terminée
                                        </span>

                                    @else

                                        <span class="badge badge-danger">
                                            Suspendue
                                        </span>

                                    @endif

                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                <hr>

                <h6>

                    <i class="fas fa-comment"></i>

                    Observation

                </h6>

                <div class="alert alert-light">

                    {{ $affectation->observation ?: 'Aucune observation.' }}

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
