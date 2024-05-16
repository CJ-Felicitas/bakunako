@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert" style="background-color: #cd9f8e">
                User Information
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-md-12 p-1">
            <div class="card p-3">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/parent/editprofile" method="post">
                                @csrf
                                <input type="hidden" name="userid" value="{{ $user->id }}">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" readonly class="form-control"
                                    value="{{ $user->first_name }}">
                                <label for="middlename" class="mt-3">Middle Name</label>
                                <input type="text" name="middlename" readonly class="form-control"
                                    value="{{ $user->middle_name }}">
                                <label for="lastname" class="mt-3">Last Name</label>
                                <input type="text" name="lastname" readonly class="form-control"
                                    value="{{ $user->last_name }}">
                                <label for="email" class="mt-3">Email</label>
                                <input type="text" name="email" readonly class="form-control"
                                    value="{{ $user->email }}">
                                <label for="phonenumber" class="mt-3">Phone Number</label>
                                <input type="text" name="phonenumber" readonly class="form-control"
                                    value="{{ $user->phone_number }}">
                                <label for="address" class="mt-3">Address</label>
                                <input type="text" name="address" readonly class="form-control"
                                    value="{{ $user->address }}">
                                <label for="username" class="mt-3">Username</label>
                                <input type="text" name="username" readonly class="form-control"
                                    value="{{ $user->username }}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary" id="editButton">Edit</button>
                        <button type="button" class="btn btn-danger d-none" id="cancelButton">Cancel</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"
                            id="#myBtn">
                            Change Password
                        </button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="/parent/updatepassword" method="post">
                                    @csrf
                                    <input type="hidden" name="userid" value="{{ $user->id }}">
                                    <label for="currentPassword">Current Password</label>
                                    <input name="password" type="password" id="currentPassword" class="form-control"
                                        placeholder="Enter Current Password">
                                    <label for="newPassword" class="mt-2">New Password</label>
                                    <input name="newpassword" type="password" id="newPassword" class="form-control"
                                        placeholder="Enter New Password">
                                    <label for="confirmPassword" class="mt-2">Confirm Password</label>
                                    <input name="confirmpassword" type="password" id="confirmPassword"
                                        class="form-control" placeholder="Confirm New Password">
                                    <span id="passwordError" class="text-danger d-none">Passwords do not match</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (session('editprofilesuccess'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Success',
                    message: 'User Information has been updated successfully',
                });
            };
        </script>
    @endif
    @if (session('passwordchangesuccess'))
    <script>
        window.onload = function() {
            iziToast.success({
                title: 'Success',
                message: 'Password has been changed successfully',
            });
        };
    </script>
@endif
@if (session('passwordchangefailnotmatched'))
<script>
    window.onload = function() {
        iziToast.error({
            title: 'Error',
            message: 'New Password and confirm password does not matched',
        });
    };
</script>
@endif
@if (session('passwordchangefail'))
<script>
    window.onload = function() {
        iziToast.error({
            title: 'Error',
            message: 'Current Password is incorrect',
        });
    };
</script>
@endif

    <script>
        document.getElementById('confirmPassword').addEventListener('input', function() {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var passwordError = document.getElementById('passwordError');

            if (newPassword !== confirmPassword) {
                passwordError.classList.remove('d-none');
            } else {
                passwordError.classList.add('d-none');
            }
        });
    </script>



    <script>
        // Add event listener to the edit button
        document.getElementById('editButton').addEventListener('click', function() {
            // Select all input fields
            var inputs = document.querySelectorAll('input[type="text"]');
            // Loop through each input and remove the readonly attribute
            inputs.forEach(function(input) {
                input.removeAttribute('readonly');
            });
            // Hide edit button, show cancel button
            document.getElementById('editButton').classList.add('d-none');
            document.getElementById('cancelButton').classList.remove('d-none');
        });

        // Add event listener to the cancel button
        document.getElementById('cancelButton').addEventListener('click', function() {
            // Select all input fields
            var inputs = document.querySelectorAll('input[type="text"]');
            // Loop through each input and add the readonly attribute
            inputs.forEach(function(input) {
                input.setAttribute('readonly', 'readonly');
            });
            // Hide cancel button, show edit button
            document.getElementById('cancelButton').classList.add('d-none');
            document.getElementById('editButton').classList.remove('d-none');
        });
    </script>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
