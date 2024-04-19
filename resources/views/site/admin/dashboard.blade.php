@extends('site.layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5 p-3">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 text-center">
                            <h2>Number of Male Infants</h2>
                        </div>
                        <div class="col-md-5 text-center">
                            <div class="font-weight-bold" style="font-size: 70px;">
                                {{$male_count}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 p-3">
            <div class="card bg-gradient-danger text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 text-center">
                            <h2>Number of Female Infants</h2>
                        </div>
                        <div class="col-md-5 text-center">
                            <div class="font-weight-bold" style="font-size: 70px;">
                                {{$female_count}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10 p-3">
            <div class="card bg-gradient-success text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Total Number of Infants:    <span class="font-weight-bold">{{$total}}</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
