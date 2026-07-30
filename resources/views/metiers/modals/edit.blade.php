<div class="modal fade"
     id="modalEditMetier{{ $metier->id }}"
     tabindex="-1"
     data-backdrop="static"
     data-keyboard="false">


    <div class="modal-dialog">

        <div class="modal-content">


            <div class="modal-header bg-warning">

                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Modifier métier
                </h5>


                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>



            <form method="POST"
                  action="{{ route('metiers.update',$metier->id) }}">


                @csrf
                @method('PUT')


                <div class="modal-body">


                    <div class="form-group">

                        <label>
                            Nom
                        </label>

                        <input type="text"
                               name="nom"
                               class="form-control"
                               value="{{ $metier->nom }}">

                    </div>



                    <div class="form-group">

                        <label>
                            Description
                        </label>


                        <textarea name="description"
                                  class="form-control">{{ $metier->description }}</textarea>

                    </div>




                    <div class="form-group">

                        <label>
                            Statut
                        </label>


                        <select name="actif"
                                class="form-control">


                            <option value="1"
                            {{ $metier->actif ? 'selected':'' }}>
                                Actif
                            </option>


                            <option value="0"
                            {{ !$metier->actif ? 'selected':'' }}>
                                Inactif
                            </option>


                        </select>

                    </div>


                </div>




                <div class="modal-footer">


                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">

                        Fermer

                    </button>


                    <button class="btn btn-warning">

                        Modifier

                    </button>


                </div>



            </form>



        </div>

    </div>

</div>
