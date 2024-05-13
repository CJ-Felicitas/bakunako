@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-dark" style="background-color: #FDEDD4;" role="alert">
                Add Infant
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 p-3">
            <form action="/parent/addinfant_" method="post">
                @csrf
                <div class="form-group">
                    {{-- Infant's Info --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="firstname">Infant's First Name</label>
                            <input type="text" value="{{ old('infant_firstname') }}" id="firstname" class="form-control"
                                name="infant_firstname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Infant's Middle Name</label>
                            <input type="text" value="{{ old('infant_middlename') }}" class="form-control"
                                name="infant_middlename" placeholder="Middle Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Infant's Last Name</label>
                            <input type="text" value="{{ old('infant_lastname') }}" class="form-control"
                                name="infant_lastname" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="firstname">Date of Birth</label>
                            <input type="date" value="{{ old('date_of_birth') }}" id="firstname" class="form-control"
                                name="date_of_birth" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Place of Birth</label>
                            <input type="text" value="{{ old('place_of_birth') }}" class="form-control"
                                name="place_of_birth" placeholder="Place of Birth" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sex</label>
                            <select class="form-control" name="sex" id="">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="address">Address</label>
                            <input type="text" value="{{ old('address') }}" class="form-control" name="address"
                                placeholder="Address" required>
                        </div>
                    </div>
                    <hr>

                    {{-- Father Info --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="firstname">Father's First Name</label>
                            <input type="text" value="{{ old('father_firstname') }}" id="firstname" class="form-control"
                                name="father_firstname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Father's Middle Name</label>
                            <input type="text" value="{{ old('father_middlename') }}" class="form-control"
                                name="father_middlename" placeholder="Middle Name">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Father's Last Name</label>
                            <input type="text" value="{{ old('father_lastname') }}" class="form-control"
                                name="father_lastname" placeholder="Last Name">
                        </div>
                    </div>

                    {{-- Mother's Info --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="firstname">Mother's First Name</label>
                            <input type="text" value="{{ old('mother_firstname') }}" id="firstname" class="form-control"
                                name="mother_firstname" placeholder="First Name">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Mother's Middle Name</label>
                            <input type="text" value="{{ old('mother_middlename') }}" class="form-control"
                                name="mother_middlename" placeholder="Middle Name">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Mother's Last Name</label>
                            <input type="text" value="{{ old('mother_lastname') }}" class="form-control"
                                name="mother_lastname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row mt-4">

                        {{-- @if (session('already_registered'))
                            <div class="alert alert-danger" role="alert">
                                The infant has already been registered
                            </div>
                        @endif --}}
                        @if (session('already_registered'))
                            <script>
                                window.onload = function() {
                                    iziToast.danger({
                                        title: 'Registration Error',
                                        message: 'The infant has already been registered.',
                                    });
                                };
                            </script>
                        @endif

                        @if (session('success'))
                        <script>
                            window.onload = function() {
                                iziToast.success({
                                    title: 'Registration Success',
                                    message: 'The infant has been registered successfully.',
                                });
                            };
                        </script>
                    @endif


                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-block text-dark" style="background-color: #CD9F8E" type="submit">Submit/Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom-script-header')
<script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection

