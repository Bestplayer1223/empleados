<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="modalTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="CloseModal"></button>
            </div>
            <div class="modal-body fs-5 p-5">

                <div class="alert alert-primary" role="alert">
                    Los campos con asteriscos (*) son obligatorios
                </div>

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputName" class="col-form-label fw-bold">Nombre completo *</label>
                    </div>
                    <div class="col-10">
                        <input type="text" id="inputName" placeholder="Nombre completo del empleado"
                            class="form-control">
                    </div>
                </div>

                <div class="row g-3 mt-2  align-items-center">
                    <div class="col-auto">
                        <label for="emailInput" class="col-form-label fw-bold">Correo electrónico *</label>
                    </div>
                    <div class="col-10">
                        <input type="text" id="inputEmail" placeholder="Correo electrónico" class="form-control">
                    </div>
                </div>

                <div class="row g-3 mt-2 col-12 d-flex flex-row align-items-center">
                    <div class="col-2 d-flex justify-content-end">
                      <label for="genreInput" class="col-form-label fw-bold ">Sexo *</label>
                    </div>

                    <div class="d-flex flex-column col-5">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="genreInput" value="M" id="genreM">
                        <label class="form-check-label" for="genreM">
                          Masculino
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="genreInput" value="F" id="genreF">
                        <label class="form-check-label" for="genreF">
                          Femenino
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="row g-3 mt-2  align-items-center">
                    <div class="col-2 d-flex justify-content-end">
                        <label for="selectArea" class="col-form-label fw-bold">Área *</label>
                    </div>
                    <div class="col-10">
                        <select class="form-select rounded" id="selectArea" >
                            <option selected value="-1">Seleccione</option>
                          </select>
                    </div>
                </div>

                <div class="mb-3 mt-4 d-flex flex-row  col-12">
                    <label for="inputDescription" class="form-label col-2 fw-bold text-end">Descripción * &nbsp;&nbsp;&nbsp;</label>
                    <textarea class=" form-control" id="inputDescription" value="" placeholder="Descripción de la experiencia del empleado" rows="3"></textarea>
                </div>

                <div class=" offset-2 form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="sw_boletin">
                    <label class="form-check-label fw-bold" for="sw_boletin">
                      Deseo recibir boletín informativo
                    </label>
                  </div>



                  <div class="row g-3 mt-2 col-12 d-flex flex-row align-items-center">
                    <div class="col-2 d-flex justify-content-end">
                      <label for="inputName" class="col-form-label fw-bold ">Roles *</label>
                    </div>

                    <div id="roles" class="d-flex flex-column col-5">

                    </div>
                  </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
                <button type="button" class="btn btn-success" id="btnSaveMWorker">Guardar</button>
            </div>
        </div>
    </div>
</div>
