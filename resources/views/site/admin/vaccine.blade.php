@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
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
                            <input type="text" class="form-control" name="protection_from" placeholder="Protection Against from what Disease, Illness, or Virus">

                            <label for="vaccine_name" class="mt-3">When to Give</label>
                            <input type="text" class="form-control" name="when_to_give" placeholder="Ideal date to administer the vaccine E.g. 6, 10 and 14 weeks from Birth">

                            <label for="description" class="mt-3">Description of the Vaccine</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" style="resize: none"
                            placeholder="Vaccine's Description"></textarea>

                            <label for="protection_from_details" class="mt-3">Information</label>
                            <textarea name="protection_from_details" id="protection_from_details" cols="70" rows="10" class="form-control" style="resize: none"
                            placeholder="Vaccine Information"></textarea>

                            <label for="vaccine_name" class="mt-3">Sources</label>
                            <input type="text" class="form-control" name="source" placeholder="Sources of Information's">
                        </div>
                        <button type="submit" style="background-color: #cd9f8e" class="btn btn-block text-white">Upload</button>
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
                    <h6 class="m-0 font-weight-bold text-black">List of all Vaccines</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Vaccine's Name</th>
                                <th>Dose Number</th>
                                <th>Date Added</th>
                                <th>Description</th>
                                <th class="text-center">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vaccines as $vaccine)
                            <tr>
                                <td>{{ $vaccine->name }}</td>
                                <td>{{ ordinal($vaccine->dose_number) }}</td>
                                <td>{{ $vaccine->created_at }}</td>
                                <td>{{$vaccine->description}}</td>
                                <td>
                                    <button style="background-color: #cd9f8e"  class="btn btn-block text-white" data-toggle="modal" data-target="#descriptionModal" data-id="{{ $vaccine->id }}">Edit</button>
                                    <button  class="btn btn-danger mt-1"><a style="text-decoration: none;"class="text-white" href="/admin/deletevaccine/{{$vaccine->id}}">Delete</a></button>
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
                    <h5 class="modal-title" id="descriptionModalLabel">Manage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">

                        <form id="formx" action="/admin/editvaccine/{{$vaccine->id}}" method="post">
                            @csrf
                            <label for="">Name of Vaccine</label>
                            <input type="text" name="name" class="form-control">

                            <label for="" class="mt-3">Dose number</label>
                            <input type="text" name="dose_number" class="form-control">

                            <label for="" class="mt-3">Protection from</label>
                            <input type="text" name="protection_from" class="form-control">

                            <label for="" class="mt-3">When to give</label>
                            <input type="text" name="when_to_give" class="form-control">

                            <label for="" class="mt-3">Description</label>
                            <input type="text" name="description" class="form-control">

                            <label for="" class="mt-3">Information</label>
                            <input type="text" name="protection_from_details" class="form-control">

                            <label for="" class="mt-3">1st Source</label>
                            <input type="text" name="source" class="form-control">

                            <label for="" class="mt-3">2nd Source</label>
                            <input type="text" name="source_two" class="form-control">

                            <label for="" class="mt-3">3rd Source</label>
                            <input type="text" name="source_three" class="form-control">

                            <label for="" class="mt-3">4th Source</label>
                            <input type="text" name="source_four" class="form-control">

                            <label for="" class="mt-3">5th Source</label>
                            <input type="text" name="source_five" class="form-control">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn text-white" style="background-color: #cd9f8e" type="submit">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @if (session('success_edit'))
    <script>
        window.onload = function() {
            iziToast.success({
                title: 'Changes Applied',
                message: 'The changes to the vaccine has been applied successfully',
            });
        };
    </script>
@endif

@if (session('error_edit'))
<script>
    window.onload = function() {
        iziToast.error({
            title: 'Edit Failed',
            message: 'Something went wrong during the edit',
        });
    };
</script>
@endif

@if (session('success_delete'))
<script>
    window.onload = function() {
        iziToast.warning({
            title: 'Vaccine Deleted',
            message: 'Deleted Successfully',
        });
    };
</script>
@endif

<script src="/uikit/vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#descriptionModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var vaccineId = button.data('id'); // Extract vaccine ID from data-* attributes
            console.log(vaccineId);
            $.ajax({
                url: '/admin/getdescription/' + vaccineId,
                method: 'GET',
                success: function(data) {
                    console.log('Data received:', data); // Log the received data to the console

                    // Ensure the form fields are populated
      // Update the form's action attribute
      $('#formx').attr('action', '/admin/editvaccine/' + vaccineId);
                    $('#descriptionModal input[name="name"]').val(data.name);
                    $('#descriptionModal input[name="dose_number"]').val(data.dose_number);
                    $('#descriptionModal input[name="protection_from"]').val(data.protection_from);
                    $('#descriptionModal input[name="when_to_give"]').val(data.when_to_give);
                    $('#descriptionModal input[name="protection_from_details"]').val(data.protection_from_details);
                    $('#descriptionModal input[name="description"]').val(data.description);
                    $('#descriptionModal input[name="source"]').val(data.source);
                    $('#descriptionModal input[name="source_two"]').val(data.source_two);
                    $('#descriptionModal input[name="source_three"]').val(data.source_three);
                    $('#descriptionModal input[name="source_four"]').val(data.source_four);
                    $('#descriptionModal input[name="source_five"]').val(data.source_five);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error); // Log any error to the console
                }
            });
        });
    });
</script>

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


    </script>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
