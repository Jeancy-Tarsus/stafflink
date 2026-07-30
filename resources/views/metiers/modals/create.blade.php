<div class="modal fade"
     id="modalCreateMetier"
     tabindex="-1">


    <div class="modal-dialog">


        <div class="modal-content">



            <div class="modal-header bg-primary text-white">


                <h5 class="modal-title">

                    <i class="fas fa-plus"></i>

                    Nouveau métier

                </h5>



                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">


                    <span>
                        &times;
                    </span>


                </button>


            </div>




            <form action="{{ route('metiers.store') }}"
                  method="POST">


                @csrf



                <div class="modal-body">



                    <div class="form-group">


                        <label>
                            Nom du métier
                        </label>


                        <input type="text"
                               name="nom"
                               class="form-control"
                               placeholder="Ex: Informaticien"
                               required>


                    </div>




                    <div class="form-group">


                        <label>
                            Description
                        </label>


                        <textarea name="description"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Description du métier"></textarea>


                    </div>




                    <div class="form-group">


                        <label>
                            Statut
                        </label>


                        <select name="actif"
                                class="form-control">


                            <option value="1">
                                Actif
                            </option>


                            <option value="0">
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



                    <button type="submit"
                            class="btn btn-primary">


                        Enregistrer


                    </button>


                </div>




            </form>




        </div>


    </div>


</div>
