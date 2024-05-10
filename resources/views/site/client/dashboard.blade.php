@extends('site.layouts.app')
@section('custom-css')
    <style>
        a:hover {
            text-decoration: none
        }
    </style>
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection

@section('content')
    @if ($infants->isEmpty())
        <div class="alert alert-warning">
            There are no infants currently added as of this moment, add an infant go get started.
        </div>

    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @foreach ($infants as $infant)
                    <div class="col-md-4 mt-4">
                        <a href="/parent/infant/{{ $infant->id }}">
                            <div class="card">
                                <div style="background-color: #FDEDD4"
                                    class="card-header py-4  d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">{{ $infant->infant_firstname }}
                                        {{ $infant->infant_middlename }} {{ $infant->infant_lastname }}</h6>
                                </div>
                                <div class="p-3" style="background-color: #CD9F8E">
                                    <label for=""><b class="text-dark">Date of Birth</b></label>
                                    <div><input type="text" class="form-control text-dark" disabled
                                            value="{{ $infant->date_of_birth }}"></div>

                                    <label class="mt-2" for=""><b class="text-dark">Sex</b></label>
                                    <div><input type="text" class="form-control text-dark" disabled value="{{ $infant->sex }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Fixed button -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <a href="/parent/addinfant">
            <button type="button" class="btn text-dark" style="background-color: #C8A796"><i class="fas fa-plus fa-fw"></i> Add a Baby</button>
        </a>
    </div>

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
@endsection
@section('custom-script-header')
<script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection

