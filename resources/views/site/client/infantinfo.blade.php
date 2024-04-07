@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary text-center">
              Infant Information
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" readonly value="{{$infant->infant_firstname}} {{$infant->infant_middlename}} {{$infant->infant_lastname}}">

            <label class="mt-3" for="date_of_birth">Date of Birth</label>
            <input type="text" class="form-control" value="{{$infant->date_of_birth}}" readonly>

            <label class="mt-3" for="place_of_birth">Place of Birth</label>
            <input type="text" class="form-control" value="{{$infant->place_of_birth}}" readonly>
        </div>
        <div class="col-md-6">
            <label for="mothers_name">Mother's Name</label>
            <input type="text" id="mothers_name" class="form-control" readonly value="{{$infant->mother_firstname}} {{$infant->mother_middlename}} {{$infant->mother_lastname}}">

            <label class="mt-3" for="fathers_name">Father's Name</label>
            <input type="text" id="mothers_name" class="form-control" readonly value="{{$infant->father_firstname}} {{$infant->father_middlename}} {{$infant->father_lastname}}">

            <label class="mt-3" for="Sex">Sex</label>
            <input type="text" class="form-control" value="{{$infant->sex}}" readonly>
        </div>
    </div>
    <div class="row mt-3">
        
        <div class="col-md-12">
            <label for="address">Address</label>
            <input type="text" id="address" class="form-control" value="{{$infant->address}}" readonly>
        </div>
    </div>
@endsection