<div class="modal fade"
     id="modalShowClient{{ $client->id }}"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <div class="modal-content shadow">

            <div class="modal-header bg-info">

                <h5 class="modal-title text-white">

                    <i class="fas fa-building"></i>

                    Fiche du client

                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="text-center mb-4">

                    <i class="fas fa-building fa-5x text-primary"></i>

                    <h3 class="mt-3 font-weight-bold">

                        {{ $client->nom }}

                    </h3>

                    <span class="badge badge-info">

                        {{ $client->type }}

                    </span>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-6">

                        <p>

                            <i class="fas fa-user text-primary"></i>

                            <strong> Responsable :</strong><br>

                            {{ $client->responsable }}

                        </p>

                        <p>

                            <i class="fas fa-user-tie text-primary"></i>

                            <strong> Fonction :</strong><br>

                            {{ $client->fonction ?: '-' }}

                        </p>

                        <p>

                            <i class="fas fa-phone text-primary"></i>

                            <strong> Téléphone :</strong><br>

                            {{ $client->telephone }}

                        </p>

                        <p>

                            <i class="fas fa-mobile-alt text-primary"></i>

                            <strong> Téléphone secondaire :</strong><br>

                            {{ $client->telephone_secondaire ?: '-' }}

                        </p>

                    </div>

                    <div class="col-md-6">

                        <p>

                            <i class="fas fa-envelope text-primary"></i>

                            <strong> Email :</strong><br>

                            {{ $client->email ?: '-' }}

                        </p>

                        <p>

                            <i class="fas fa-map-marker-alt text-danger"></i>

                            <strong> Adresse :</strong><br>

                            {{ $client->adresse }}

                        </p>

                        <p>

                            <i class="fas fa-city text-primary"></i>

                            <strong> Ville :</strong><br>

                            {{ $client->ville }}

                        </p>

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-6">

                        <p>

                            <i class="fas fa-briefcase text-success"></i>

                            <strong> Secteur d'activité :</strong><br>

                            {{ $client->secteur_activite }}

                        </p>

                    </div>

                    <div class="col-md-3">

                        <p>

                            <i class="fas fa-file-contract text-primary"></i>

                            <strong> RCCM :</strong><br>

                            {{ $client->rccm ?: '-' }}

                        </p>

                    </div>

                    <div class="col-md-3">

                        <p>

                            <i class="fas fa-id-card text-primary"></i>

                            <strong> NIU :</strong><br>

                            {{ $client->niu ?: '-' }}

                        </p>

                    </div>

                </div>

                <hr>

                <div class="card card-light">

                    <div class="card-header">

                        <strong>

                            <i class="fas fa-sticky-note"></i>

                            Observation

                        </strong>

                    </div>

                    <div class="card-body">

                        {{ $client->observation ?: 'Aucune observation.' }}

                    </div>

                </div>

                <div class="text-center mt-4">

                    @if($client->actif)

                        <span class="badge badge-success px-3 py-2">

                            <i class="fas fa-check-circle"></i>

                            Client actif

                        </span>

                    @else

                        <span class="badge badge-danger px-3 py-2">

                            <i class="fas fa-times-circle"></i>

                            Client inactif

                        </span>

                    @endif

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                    <i class="fas fa-times"></i>

                    Fermer

                </button>

            </div>

        </div>

    </div>

</div>
