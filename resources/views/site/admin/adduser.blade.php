@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-dark" style="background-color:#FDEDD4;">
                Create an Account
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <form action="/admin/adduser_" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" placeholder="Username" id="username"
                                    name="username" required>
                                <label for="" class="mt-3">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" id="firstname"
                                    name="firstname" required>
                                <label for="" class="mt-3">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Middle Name" id="middle_name"
                                    name="middlename" required>
                                <label for="" class="mt-3">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="first_name"
                                    name="lastname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="">Email</label>
                                <input type="text" class="form-control" placeholder="Email" id="email" name="email"
                                    required>
                                <label for="contact_number" class="mt-3">Contact Number</label>
                                <input type="text" class="form-control" placeholder="Contact Number" id="contact_number"
                                    name="phone_number" required>
                                <label for="password" class="mt-3">Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="password"
                                    name="password" required>
                                <label for="confirm_password" class="mt-3">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <label for="level">Select Priviledge Level</label>
                                <select required name="user_type_id" id="level" class="form-control">
                                    <option value="" selected disabled hidden>Select Priviledge Level</option>
                                    <option value="1">Administrator (Full Access)</option>
                                    <option value="3">Healthcare provider</option>
                                </select> --}}
                                    <label for="" class="">Address</label>
                                    <input required type="text" class="form-control" placeholder="Address" id="address"
                                        name="address">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn text-white" style="background-color: #CD9F8E;">Submit</button>
                        </div>
                </form>
            </div>
        </div>

    </div>
    @if (session('success'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Success',
                    message: 'Partner has been added successfully.',
                });
            };
        </script>
    @endif
    </div>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
