@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5 justify-content-center mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center pt-4">
                        <p class="text-uppercase">
                            <strong>Register</strong>
                        </p>
                    </div>
                    <div class="card-body">

                        <form action="/register_" method="post">
                            @csrf
                            <input value="{{ old('first_name') }}" type="text" name="first_name"
                                class="mb-2 form-control form-control-lg" placeholder="First Name" required>

                            <input value="{{ old('middle_name') }}" type="text" name="middle_name"
                                class="mb-2 form-control form-control-lg" placeholder="Middle Name" required>

                            <input value="{{ old('last_name') }}" type="text" name="last_name"
                                class="mb-2 form-control form-control-lg" placeholder="Last Name" required>

                            <input value="{{ old('email') }}" type="email" name="email"
                                class="mb-2 form-control form-control-lg" placeholder="Email" required>

                            <input value="{{ old('phone_number') }}" type="text" name="phone_number"
                                class="mb-2 form-control form-control-lg" placeholder="Phone Number" required>

                            <input value="{{ old('address') }}" type="text" name="address"
                                class="mb-2 form-control form-control-lg" placeholder="Address" required>

                            <input value="{{ old('username') }}" type="text" name="username"
                                class="mb-2 form-control form-control-lg" placeholder="Username" required>

                            <input value="{{ old('password') }}" type="password" name="password"
                                class="form-control form-control-lg mb-2" placeholder="Password" required>

                            <input value="{{ old('confirm_password') }}" type="password" name="confirm_password"
                                class="form-control form-control-lg mb-2" placeholder="Confirm Password" required>

                            @if (session('passwords_not_matched'))
                                <div class="alert alert-danger" role="alert">
                                    Passwords do not match
                                </div>
                            @endif
                            @if (session('user_exists'))
                                <div class="alert alert-danger" role="alert">
                                    User Already Exists!
                                </div>
                            @endif
                            @if (session('email_exists'))
                                <div class="alert alert-danger" role="alert">
                                    Email Has Already Taken!
                                </div>
                            @endif
                            <button class="btn mb-2 btn-primary btn-block" type="submit">Register</button>
                        </form>

                        <label for="">Already have an account? <a href="/login">Login Here</a></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
