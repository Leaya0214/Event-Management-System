<div class="modal fade status_modal-{{ $detail->id }}" id="status_modal_{{ $detail->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Status</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="successMessage_{{ $detail->id }}" class="alert alert-success" style="display: none;"></div>

            <form id="status-form-{{ $detail->id }}" data-id="{{ $detail->id }}">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="status" class="col-sm-3">Edit Status</label>
                        <label for="status" class="col-sm-1">:</label>
                        <div class="col-md-8">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                                <option value="3">Raw Ready For Delivery</option>
                                <option value="7">Raw Delivered</option>
                                <option value="4">Selection Given</option>
                                <option value="5">Final Delivery</option>
                                <option value="6">Delivered</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('form[id^="status-form"]').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var id = form.data('id');

        $.ajax({
            url: '/event/status/' + id,
            type: 'put',
            data: {
                _token: '{{ csrf_token() }}',
                status: form.find('select[name="status"]').val()
            }
        })
        .done(function(response) {
            const successEl = $(`#successMessage_${id}`);
            successEl.html('Updating...').show();

            setTimeout(function() {
                $('#successMessage_' + id).hide();
                $('#status_modal_' + id).modal('hide');
            }, 3000);

            $.ajax({
                url: '/event/getAll',
                type: 'get',
                success: function(data) {
                    var table = $('#eventTable').DataTable();
                    var currentPage = table.page();
                    table.clear().rows.add(data).draw();
                    if (currentPage > 0) {
                         table.page(currentPage).draw('page');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching updated data:', xhr.responseText);
                }
            });
        })
        .fail(function(xhr) {
            console.error('Error updating data:', xhr.responseText);
        });
        });
    });
</script>

