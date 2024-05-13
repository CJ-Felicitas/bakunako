@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert text-dark" style="background-color:#FDEDD4">
                Feedbacks
            </div>
        </div>
    </div>
    @if ($feedbacks->isEmpty())
        <div class="alert alert-warning">
            There are no feedbacks available as of this moment.
        </div>
    @endif
    @foreach ($feedbacks as $feedback)
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><span class="badge badge-secondary">Name: </span> <span
                                            class="font-weight-bold">{{ $feedback->first_name }}
                                            {{ $feedback->middle_name }} {{ $feedback->last_name }}</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6><span class="badge badge-secondary">Email: </span> <span
                                            class="font-weight-bold">{{ $feedback->email }}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><span class="badge badge-secondary">Message/Feedback</span></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea readonly class="form-control" style="resize:none;" name="" id="" cols="30"
                                            rows="5">{{ $feedback->messaage }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- space footer --}}
    <div class="m-5"></div>
@endsection
