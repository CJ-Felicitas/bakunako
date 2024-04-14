@extends('site.layouts.app')
@section('custom-css')
    <style>
        a:hover {
            text-decoration: none
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                @foreach ($infants as $infant)
                    <div class="col-md-4 mt-4">
                        <a href="/parent/infant/{{ $infant->id }}">
                            <div class="card">
                                <div
                                    class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-light">{{ $infant->infant_firstname }}
                                        {{ $infant->infant_middlename }} {{ $infant->infant_lastname }}</h6>
                                </div>
                                <div class="p-3">
                                    <label for=""><b>Date of Birth</b></label>
                                    <div><input type="text" class="form-control" disabled
                                            value="{{ $infant->date_of_birth }}"></div>

                                    <label class="mt-2" for=""><b>Sex</b></label>
                                    <div><input type="text" class="form-control" disabled value="{{ $infant->sex }}">
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
            <button type="button" class="btn btn-primary">Add a Baby</button>
        </a>
    </div>
@endsection
