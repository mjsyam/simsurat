<div class="modal fade" id="delete_user_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-5 mx-lg-15 mb-7">
                <form id="delete_user_modal_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="me-n10 pe-10" data-kt-scroll-max-height="auto" data-kt-scroll-offset="300px">
                        <div class="row mb-9">
                            <div class="col-lg-12 text-center mb-9">
                                <span class="fs-1 fw-bolder text-dark d-block mb-1">Hapus User</span>
                            </div>


                            <input type="text" name="id" hidden>

                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="reset" id="delete_user_modal_cancel" class="btn btn-sm btn-light me-3 w-lg-200px"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="delete_user_modal_submit" class="btn btn-sm btn-danger w-lg-200px"
                            data-bs-dismiss="modal">
                            <span class="indicator-label">Delete</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
