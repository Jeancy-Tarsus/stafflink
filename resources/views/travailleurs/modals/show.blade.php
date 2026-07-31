<div class="modal fade"
     id="modalShowTravailleur{{ $travailleur->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="modalShowTravailleurLabel{{ $travailleur->id }}"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content shadow">

            <!-- Header -->
            <div class="modal-header bg-info">

                <h5 class="modal-title text-white"
                    id="modalShowTravailleurLabel{{ $travailleur->id }}">

                    <i class="fas fa-id-card"></i>
                    Fiche du travailleur

                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Photo -->
                <div class="text-center mb-4">

                    @if($travailleur->photo)

                        <img src="{{ asset('storage/'.$travailleur->photo) }}"
                             class="img-circle elevation-2"
                             width="160"
                             height="160"
                             style="object-fit:cover;"
                             alt="Photo">

                    @else

                        <img src="https://via.placeholder.com/160"
                             class="img-circle elevation-2"
                             width="160"
                             height="160"
                             alt="Photo">

                    @endif

                    <h3 class="mt-3 mb-1 font-weight-bold">
                        {{ $travailleur->prenom }} {{ $travailleur->nom }}
                    </h3>

                    <span class="badge badge-info px-3 py-2">
                        <i class="fas fa-briefcase"></i>
                        {{ optional($travailleur->metier)->nom }}
                    </span>

                </div>

                <hr>

                <!-- Informations -->

                <div class="row">

                    <div class="col-md-6">

                        <p>
                            <i class="fas fa-venus-mars text-primary"></i>
                            <strong> Sexe :</strong><br>
                            {{ $travailleur->sexe }}
                        </p>

                        <p>
                            <i class="fas fa-calendar-alt text-primary"></i>
                            <strong> Date de naissance :</strong><br>
                            {{ \Carbon\Carbon::parse($travailleur->date_naissance)->format('d/m/Y') }}
                        </p>

                        <p>
                            <i class="fas fa-phone text-primary"></i>
                            <strong> Téléphone :</strong><br>
                            {{ $travailleur->telephone }}
                        </p>

                        <p>
                            <i class="fas fa-envelope text-primary"></i>
                            <strong> Email :</strong><br>
                            {{ $travailleur->email ?: '-' }}
                        </p>

                    </div>

                    <div class="col-md-6">

                        <p>
                            <i class="fas fa-map-marker-alt text-danger"></i>
                            <strong> Adresse :</strong><br>
                            {{ $travailleur->adresse }}
                        </p>

                        <p>
                            <i class="fas fa-user-tie text-primary"></i>
                            <strong> Expérience :</strong><br>
                            {{ $travailleur->experience ?: '-' }}
                        </p>

                        <p>
                            <i class="fas fa-money-bill-wave text-success"></i>
                            <strong> Salaire souhaité :</strong><br>

                            @if($travailleur->salaire_souhaite)

                                {{ number_format($travailleur->salaire_souhaite,0,',',' ') }} FCFA

                            @else

                                -

                            @endif

                        </p>

                    </div>

                </div>

                <hr>

                <!-- Observation -->

                <div class="card card-light">

                    <div class="card-header">

                        <strong>

                            <i class="fas fa-sticky-note"></i>

                            Observation

                        </strong>

                    </div>

                    <div class="card-body">

                        {{ $travailleur->observation ?: 'Aucune observation.' }}

                    </div>

                </div>

                <!-- Badges -->

                <div class="text-center mt-4">

                    @if($travailleur->disponible)

                        <span class="badge badge-success px-3 py-2">

                            <i class="fas fa-check-circle"></i>

                            Disponible

                        </span>

                    @else

                        <span class="badge badge-warning px-3 py-2">

                            <i class="fas fa-clock"></i>

                            Indisponible

                        </span>

                    @endif


                    @if($travailleur->actif)

                        <span class="badge badge-primary px-3 py-2 ml-2">

                            <i class="fas fa-user-check"></i>

                            Actif

                        </span>

                    @else

                        <span class="badge badge-danger px-3 py-2 ml-2">

                            <i class="fas fa-user-times"></i>

                            Inactif

                        </span>

                    @endif

                </div>

            </div>

            <!-- Footer -->

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
