 <div class="modal fade" id="edit_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="edit_contact_form" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" class="edit_id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control edit_name" name="name" placeholder="Type here. . .">
                    </div>

                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control edit_company" name="company" placeholder="Type here. . .">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control edit_phone" name="phone" placeholder="Type here. . .">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control edit_email" name="email" placeholder="Type here. . .">
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>