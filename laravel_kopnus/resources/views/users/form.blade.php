<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div  class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="#" method="POST"  id="form">
            <div class="loading d-none"></div>
              <div class="modal-header">
                  <h5 class="modal-title">Create Users</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                  </div>
                  <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" >
                  </div>
                  <div class="form-group">
                    <label for="name">Address</label>
                    <textarea class="form-control"  id="address" name="address"></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
        </div>
    </div>
</div>
@push('js')
<script>
  jQuery(function () {
    $('#modalForm').on('show.bs.modal', function (e) {

    });

  });

</script>
@endpush
