<div class="modal fade"
     id="modalEditTravailleur{{ $travailleur->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Modifier le travailleur
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <form method="POST"
                  action="{{ route('travailleurs.update', $travailleur->id) }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">

                <div class="row">

    <div class="col-md-12 text-center mb-4">

        @if($travailleur->photo)

            <img src="{{ asset('storage/'.$travailleur->photo) }}"
                 width="150"
                 height="150"
                 class="img-circle elevation-2 mb-3"
                 style="object-fit:cover;">

        @else

            <img src="https://via.placeholder.com/150"
                 class="img-circle elevation-2 mb-3">

        @endif

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>Nom</label>

            <input type="text"
                   name="nom"
                   class="form-control"
                   value="{{ old('nom', $travailleur->nom) }}"
                   required>

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>Prénom</label>

            <input type="text"
                   name="prenom"
                   class="form-control"
                   value="{{ old('prenom', $travailleur->prenom) }}"
                   required>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        <div class="form-group">

            <label>Sexe</label>

            <select name="sexe" class="form-control">

                <option value="Masculin"
                    {{ $travailleur->sexe == 'Masculin' ? 'selected' : '' }}>
                    Masculin
                </option>

                <option value="Féminin"
                    {{ $travailleur->sexe == 'Féminin' ? 'selected' : '' }}>
                    Féminin
                </option>

            </select>

        </div>

    </div>

    <div class="col-md-4">

        <div class="form-group">

            <label>Date de naissance</label>

            <input type="date"
                   name="date_naissance"
                   class="form-control"
                   value="{{ old('date_naissance', $travailleur->date_naissance->format('Y-m-d')) }}">

        </div>

    </div>

    <div class="col-md-4">

        <div class="form-group">

            <label>Nouvelle photo</label>

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

            <label>Téléphone</label>

            <input type="text"
                   name="telephone"
                   class="form-control"
                   value="{{ old('telephone', $travailleur->telephone) }}"
                   required>

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $travailleur->email) }}">

        </div>

    </div>

</div>

<div class="form-group">

    <label>Adresse</label>

    <textarea name="adresse"
              class="form-control"
              rows="2"
              required>{{ old('adresse', $travailleur->adresse) }}</textarea>

</div>

<hr>

<h5 class="text-primary mb-3">
    <i class="fas fa-briefcase"></i>
    Informations professionnelles
</h5>

<div class="row">

    <div class="col-md-6">

        <div class="form-group">

            <label>Métier</label>

            <select name="metier_id"
                    class="form-control"
                    required>

                @foreach($metiers as $metier)

                    <option value="{{ $metier->id }}"
                        {{ $travailleur->metier_id == $metier->id ? 'selected' : '' }}>

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
                   value="{{ old('experience', $travailleur->experience) }}">

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
                   value="{{ old('salaire_souhaite', $travailleur->salaire_souhaite) }}"
                   min="0">

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>Disponibilité</label>

            <select name="disponible"
                    class="form-control">

                <option value="1"
                    {{ $travailleur->disponible ? 'selected' : '' }}>
                    Disponible
                </option>

                <option value="0"
                    {{ !$travailleur->disponible ? 'selected' : '' }}>
                    Indisponible
                </option>

            </select>

        </div>

    </div>

</div>

<hr>

<h5 class="text-primary mb-3">
    <i class="fas fa-sticky-note"></i>
    Observation
</h5>

<div class="form-group">

    <textarea name="observation"
              class="form-control"
              rows="3">{{ old('observation', $travailleur->observation) }}</textarea>

</div>



                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        Fermer
                    </button>

                    <button type="submit"
                            class="btn btn-warning">
                        <i class="fas fa-save"></i>
                        Modifier
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
