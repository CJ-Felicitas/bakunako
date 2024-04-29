@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary">
                List of Vouchers
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mcdonalds</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Burger Mcdo</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2">CLAIMED AT</span>
                                            <span>June 1, 2002</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button disabled class="btn btn-secondary btn-sm">CLAIMED</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mcdonalds</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Burger Mcdo</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-warning mr-2">NOT YET CLAIMED</span>
                                            <span> </span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-success btn-sm">CLAIM</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
