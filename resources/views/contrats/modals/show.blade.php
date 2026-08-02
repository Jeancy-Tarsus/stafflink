<div class="modal fade"
     id="modalShowContrat{{ $contrat->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h5 class="modal-title">

                    <i class="fas fa-file-signature"></i>

                    Détails du contrat

                </h5>

                <button class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>

                                <th>Référence</th>

                                <td>{{ $contrat->reference }}</td>

                            </tr>

                            <tr>

                                <th>Client</th>

                                <td>{{ $contrat->affectation->demande->client->nom }}</td>

                            </tr>

                            <tr>

                                <th>Travailleur</th>

                                <td>

                                    {{ $contrat->affectation->travailleur->nom }}

                                    {{ $contrat->affectation->travailleur->prenom }}

                                </td>

                            </tr>

                            <tr>

                                <th>Métier</th>

                                <td>

                                    {{ $contrat->affectation->demande->metier->nom }}

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tr>

                                <th>Date signature</th>

                                <td>{{ $contrat->date_signature->format('d/m/Y') }}</td>

                            </tr>

                            <tr>

                                <th>Début</th>

                                <td>{{ $contrat->date_debut->format('d/m/Y') }}</td>

                            </tr>

                            <tr>

                                <th>Fin</th>

                                <td>

                                    {{ $contrat->date_fin ? $contrat->date_fin->format('d/m/Y') : '-' }}

                                </td>

                            </tr>

                            <tr>

                                <th>Salaire</th>

                                <td>

                                    {{ number_format($contrat->salaire,2,',',' ') }}

                                    FCFA

                                </td>

                            </tr>

                            <tr>

                                <th>Statut</th>

                                <td>

                                    @if($contrat->statut=='Actif')

                                        <span class="badge badge-success">

                                            Actif

                                        </span>

                                    @elseif($contrat->statut=='Terminé')

                                        <span class="badge badge-primary">

                                            Terminé

                                        </span>

                                    @else

                                        <span class="badge badge-danger">

                                            Résilié

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

                <hr>

                <h5>

                    Observation

                </h5>

                <div class="alert alert-light">

                    {{ $contrat->observation ?: 'Aucune observation.' }}

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
