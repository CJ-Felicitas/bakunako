@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4;" class="alert alert-primary font-weight-bold text-dark">
                Edit the Details for {{ $infant->infant_firstname }} {{ $infant->infant_lastname }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 p-3">
            <form action="/parent/edit/infantdetails" method="post">
                @csrf
                <div class="form-group">
                    {{-- Infant's Info --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="hidden" name="id" value="{{$infant->id}}">
                            <input type="hidden" name="parent_id" value="{{$infant->user->id}}">
                            <label for="firstname">Infant's First Name</label>
                            <input type="text" value="{{ $infant->infant_firstname }}" id="firstname"
                                class="form-control" name="infant_firstname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Infant's Middle Name</label>
                            <input type="text" value="{{ $infant->infant_middlename }}" class="form-control"
                                name="infant_middlename" placeholder="Middle Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Infant's Last Name</label>
                            <input type="text" value="{{ $infant->infant_lastname }}" class="form-control"
                                name="infant_lastname" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="firstname">Date of Birth</label>
                            <input type="date" value="{{ $infant->date_of_birth }}" id="firstname" class="form-control"
                                name="date_of_birth" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Place of Birth</label>
                            <input type="text" value="{{ $infant->place_of_birth }}" class="form-control"
                                name="place_of_birth" placeholder="Place of Birth" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sex</label>
                            <select class="form-control" name="sex" id="">
                                @if ($infant->sex == 'Male')
                                    <option selected value="{{ $infant->sex }}">Male</option>
                                    <option selected value="Female">Female</option>
                                @endif
                                @if ($infant->sex == 'Female')
                                    <option selected value="{{ $infant->sex }}">Female</option>
                                    <option selected value="Male">Male</option>
                                @endif

                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="address">Address</label>
                            <input type="text" value="{{$infant->address}}" class="form-control" name="address"
                                placeholder="Address" required>
                        </div>
                    </div>
                    <hr>

                    {{-- Father Info --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="firstname">Father's First Name</label>
                            <input type="text" value="{{ $infant->father_firstname }}" id="firstname" class="form-control"
                                name="father_firstname" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Father's Middle Name</label>
                            <input type="text" value="{{ $infant->father_middlename }}" class="form-control"
                                name="father_middlename" placeholder="Middle Name">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Father's Last Name</label>
                            <input type="text" value="{{ $infant->father_lastname }}" class="form-control"
                                name="father_lastname" placeholder="Last Name">
                        </div>
                    </div>

                    {{-- Mother's Info --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="firstname">Mother's First Name</label>
                            <input type="text" value="{{ $infant->mother_firstname }}" id="firstname" class="form-control"
                                name="mother_firstname" placeholder="First Name">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Mother's Middle Name</label>
                            <input type="text" value="{{ $infant->mother_middlename }}" class="form-control"
                                name="mother_middlename" placeholder="Middle Name">
                        </div>
                        <div class="col-md-4">
                            <label for="middlename">Mother's Last Name</label>
                            <input type="text" value="{{ $infant->mother_lastname }}" class="form-control"
                                name="mother_lastname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row mt-4">



                        @if (session('password_error'))
                            <script>
                                window.onload = function() {
                                    iziToast.error({
                                        title: 'Invalid Password',
                                        message: 'The password you entered is not correct',
                                    });
                                };
                            </script>
                        @endif


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Enter the Password to Confirm</label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-block text-white" style="background-color: #CD9F8E"
                                type="submit">Save Changes</button>
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
