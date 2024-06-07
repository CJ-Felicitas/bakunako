@extends('site.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-dark text-center font-weight-bold" style="background-color: #FDEDD4; font-size: 25px">
                Manage Vaccines
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Upload Photo
                </div>
                <div class="card-body">
                    <form action="/admin/addvaccine_" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="photo">Upload the Image of the Vaccine Here</label>
                            <input type="file" class="form-control-file" id="photo" name="photo"
                                onchange="previewPhoto(event)">
                        </div>

                        <div class="form-group text-center">
                            <img id="photo-preview" class="img-fluid rounded"
                                style="max-height: 100%; max-width: 100%; margin: auto;">
                        </div>
                        <div class="form-group">
                            <label for="vaccine_name">Name of the Vaccine</label>
                            <input type="text" class="form-control" name="vaccine_name" placeholder="Vaccine Name">

                            <label for="vaccine_name" class="mt-3">Dose Number</label>
                            <input type="text" class="form-control" name="dose_number" placeholder="(nth) dose of the vaccine">

                            <label for="vaccine_name" class="mt-3">Protection Against</label>
                            <input type="text" class="form-control" name="protection_from" placeholder="Protection Against from what Disease, Illness, or Virus?">

                            <label for="vaccine_name" class="mt-3">When to Give</label>
                            <input type="text" class="form-control" name="when_to_give" placeholder="Ideal date to administer the vaccine">

                            <label for="vaccine_name" class="mt-3">Description of Illness that the Vaccine Prevents or cures</label>
                            <input type="text" class="form-control" name="protection_from_description" placeholder="Describe the Disease, Ilness, or Virus.">

                            <label for="description" class="mt-3">Description of the Vaccine</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="resize: none"
                                placeholder="Vaccine's Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-black">List of all Healthcare Providers</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Vaccine's Name</th>
                                <th>Dose Number</th>
                                <th>Date Added</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vaccines as $vaccine)
                            <tr>
                                <td>{{ $vaccine->name }}</td>
                                <td>{{ ordinal($vaccine->dose_number) }}</td>
                                <td>{{ $vaccine->created_at }}</td>
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#descriptionModal" data-id="{{ $vaccine->id }}">Description</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Vaccine Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function previewPhoto(event) {
            const fileInput = event.target;
            const preview = document.getElementById('photo-preview');
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        }

        $('#descriptionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var vaccineId = button.data('id'); // Extract vaccine ID from data-* attributes

            $.ajax({
                url: '/admin/getdescription/' + vaccineId,
                method: 'GET',
                success: function(data) {
                    $('#modalDescription').text(data.description);
                },
                error: function() {
                    $('#modalDescription').text('Failed to load description');
                }
            });
        });
    </script>
@endsection
