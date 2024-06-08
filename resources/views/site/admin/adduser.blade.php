@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-dark text-center font-weight-bold" style="background-color:#FDEDD4; font-size: 25px">
                Create an account for Healthcare Provider
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
                                <label for="" class="">Clinic / Hospital Assigned</label>
                                <input required type="text" class="form-control" placeholder="Name of Clinic or Hospital" id="hospital" name="assigned_at">
                                    <label for="" class="mt-3">Address</label>
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
                    message: 'Healthcare Provider has been added successfully.',
                });
            };
        </script>
    @endif
    @if (session('password_wrong'))
        <script>
            window.onload = function() {
                iziToast.error({
                    title: 'Password Error',
                    message: 'Password is Incorrect',
                });
            };
        </script>
    @endif
    @if (session('username_exists'))
        <script>
            window.onload = function() {
                iziToast.error({
                    title: 'Username Exists',
                    message: 'Username already taken',
                });
            };
        </script>
    @endif
    @if (session('email_exists'))
    <script>
        window.onload = function() {
            iziToast.error({
                title: 'Email Exists',
                message: 'Email is already taken',
            });
        };
    </script>
@endif
@if (session('user_exists'))
<script>
    window.onload = function() {
        iziToast.error({
            title: 'User Exists',
            message: 'Healthcare Provider is already registered',
        });
    };
</script>
@endif
    </div>

          <!-- Row -->
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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Clinic / Hospital</th>
                        <th>Start date</th>

                        <th>Phone Number</th>


                      </tr>
                    </thead>

                    <tbody>

                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->assigned_at}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->phone_number}}</td>

                      </tr>
                    @endforeach



                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection

@section('custom-script')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable with Hover
    });
</script>
@endsection
