  @php
    $artists = App\Models\BackEnd\EventDetailsLog::where('event_details_id', $detail->id)->get();
@endphp
<div class="modal fade officeExperience-{{ $detail->id }}" id="shareExperince-{{ $detail->id }}" tabindex="-1"
    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('experinceStore') }}" method="POST" enctype="multipart/form-data"
                id="shareExperinceForm-{{ $detail->id }}" data-id="{{ $detail->id }}">
                @csrf
                <input type="hidden" name="detail_id" value="{{ $detail->id }}">
                <div class="modal-body">
                    <div class="form-group row pt-3">
                        <div class="col-sm-12">
                            <label for="artist" class="form-label text-bold"><strong>Select Artist</strong> </label>
                            <select name="artist_id" id="artist" class="form-control">
                                @foreach ($artists as $v_artist)
                                    <option value="{{ $v_artist->assigned_user_id }}">{{ $v_artist->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <div class="col-sm-12">
                            <label for="experience" class="form-label text-bold"><strong>Share Experience</strong>
                            </label>
                            <textarea name="experience" class="form-control" id="" cols="30" rows="10"
                                placeholder="Share Yore Experience About The Artist"></textarea>
                        </div>
                    </div>

                    <div id="message-container-{{ $detail->id }}" class="mt-3 border-1 p-2">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
     $(document).ready(function() {
        $('form[id^="shareExperinceForm"]').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            var formData = $(this).serialize();
            var modalBody = $(this).closest('.modal-content').find('.modal-body');
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
            })
            .done((response) => {
                if (response.hasOwnProperty('message')) {
                    modalBody.find('#message-container-' + id).append('<p class="text-success text-center">' + response.message + '</p>');
                    setTimeout(function() {
                        $('#shareExperince-' + id).modal('hide');
                        $('#shareExperinceForm-' + id)[0].reset();
                        $('#shareExperince-'+ id).modal('show');
                    }, 3000);
                } else {
                    console.error('Unexpected response format:', response);
                }
            })
            .fail((xhr) => {
                console.error('Error updating data:', xhr.responseText);
            });
        }
    });
    });

</script>
