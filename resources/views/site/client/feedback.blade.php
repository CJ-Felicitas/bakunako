@extends('site.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="/izitoast/iziToast.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div style="background-color: #FDEDD4; font-size: 25px" class="alert text-center alert-primary font-weight-bold text-dark">
            Feedback Form
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form action="/parent/submitfeedback_" method="post">
                            @csrf
                        <label for="name" class="text-dark">Name</label>
                        {{-- hold value --}}
                        <input type="hidden" value="{{ Auth::user()->first_name }}" name="first_name">
                        <input type="hidden" value="{{ Auth::user()->middle_name }}" name="middle_name">
                        <input type="hidden" value="{{ Auth::user()->last_name }}" name="last_name">

                        {{-- read only --}}
                        <input readonly
                            value="{{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}"
                            type="text" id="name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="text-dark">Email</label>
                        <input name="email" readonly value="{{ Auth::user()->email }}" type="text" id="email"
                            class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <textarea placeholder="Message" name="feedback_message" class="form-control text-dark" style="resize: none" id="" cols="30"
                            rows="10"></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn text-white" style="background-color: #C8A796">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <script>
        window.onload = function() {
            iziToast.success({
                title: 'Feedback',
                message: 'Your Feedback has been submitted, Thank You!',
            });
        };
    </script>
@endif

@endsection
@section('custom-script-header')
    <script src="/izitoast/iziToast.min.js" type="text/javascript"></script>
@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {

            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>
@endsection
