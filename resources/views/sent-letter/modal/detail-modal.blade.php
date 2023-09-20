<div class="modal fade" id="letter_detail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body mx-2 mb-7">
                <div class="col-lg-12 text-center mb-9">
                    <span class="fs-1 fw-bolder text-dark d-block mb-1">Letter Sented To</span>
                </div>

                <div class="col-lg-12">
                    <table class="table align-top border table-rounded gy-5" id="table_detail">
                        <thead class="">
                            <tr class="fw-bold fs-7 text-gray-500 text-uppercase overflow-y-auto w-full">
                                <th class="w-50px">#</th>
                                <th class="w-300px">Nama</th>
                                {{-- <th class="w-200px">Role</th>
                                <th class="w-200px">Identifier</th> --}}
                                <th class="w-100px">Status</th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-9">
                    <button type="reset" class="btn btn-sm btn-info me-3 w-lg-200px"
                        data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
