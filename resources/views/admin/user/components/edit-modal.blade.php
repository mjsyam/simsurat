<div class="modal fade" id="edit_user_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="edit_user_modal_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Edit User</span>
                            </div>

                            <input type="text" name="id" hidden>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Nama</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" id="name"
                                    name="name">
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">NIK/NIP/NIM</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" id="number"
                                    name="number">
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Status</span>
                                </label>
                                <select class="drop-data form-select form-select-solid" name="status" required style="width: 100% !important;">
                                    @foreach ($userStatus as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="d-flex align-items-center fs-6 form-label mb-2">
                                    <span class="required fw-bold">Email</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" id="email"
                                    name="email">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="reset" id="add_user_modal_cancel" class="btn btn-sm btn-light me-3 w-lg-200px"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="add_user_modal_submit" class="btn btn-sm btn-success w-lg-200px"
                            data-bs-dismiss="modal">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
