    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password_lama">Old Password</label>
                        <input type="password" class="form-control" id="password_lama" autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">New Password</label>
                        <input type="password" class="form-control" id="password_baru" autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="konfirmasi_password" autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSimpanPassword">Save</button>
                </div>
            </div>
        </div>
    </div>