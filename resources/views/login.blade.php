@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center pt-4">
                        <p class="text-uppercase">
                            <strong>Login as Parent</strong>
                        </p>
                    </div>
                    <div class="card-body">

                        <form action="/login_" method="post">
                            @csrf
                            <input value="{{ old('username') }}" type="text" name="username"
                                class="mb-2 form-control form-control-lg" placeholder="Username">

                            <input value="{{ old('password') }}" type="password" name="password"
                                class="form-control form-control-lg mb-2" placeholder="Password">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    Invalid Credentials
                                </div>
                            @endif
                            <button class="btn mb-2 btn-primary btn-block" type="submit">Login</button>
                        </form>

                        <label for="">Dont have an account? <a href="/register">Register here</a></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
