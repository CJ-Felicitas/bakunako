@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary font-weight-bold">
               Vaccine Descriptions and Information
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 text-justify">
                <h5 class="font-weight-bold">Vaccines play a crucial role in safeguarding infants from life-threatening
                    diseases, ultimately preserving millions of lives annually.
                    </h5>
                <p> <span class="ml-5"></span>For routine vaccines to be effective, it is crucial that infants receive the required doses according to
                    the recommended schedule from birth until their first birthday. Additionally, infants should also receive any
                    necessary additional doses during supplementary vaccination campaigns or outbreak responses as directed by
                    the Department of Health. </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 p-1">
            <div class="row justify-content-center">
                <div class="col-md-4 p-5 m-5 text-center" style="background-color: rgb(155, 183, 219); border-radius: 25px;">
                    <h3 class="font-weight-bold">Bacillus Calmette–Guérin (BCG)</h3>
                    <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/9/95/Smallpox_vaccine.jpg"
                        alt="">
                </div>
                <div class="col-md-4 p-5 m-5 justify-content-center text-center"
                    style="background-color: rgb(155, 183, 219); border-radius: 25px;">
                    <h3 class="font-weight-bold">Hepatitis B</h3>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Smallpox_vaccine.jpg" class="img-fluid"
                        alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 p-5 m-5 text-center" style="background-color: rgb(155, 183, 219); border-radius: 25px;">
                    <h3 class="font-weight-bold">Pentavalent Vaccine</h3>
                    <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/9/95/Smallpox_vaccine.jpg"
                        alt="">
                </div>
                <div class="col-md-4 p-5 m-5 justify-content-center text-center"
                    style="background-color: rgb(155, 183, 219); border-radius: 25px;">
                    <h3 class="font-weight-bold">Oral Polio Vaccine (OPV)
                    </h3>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Smallpox_vaccine.jpg" class="img-fluid"
                        alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 p-5 m-5 text-center" style="background-color: rgb(155, 183, 219); border-radius: 25px;">
                    <h3 class="font-weight-bold">Inactivated Polio Vaccine (IPV)</h3>
                    <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/9/95/Smallpox_vaccine.jpg"
                        alt="">
                </div>
                <div class="col-md-4 p-5 m-5 justify-content-center text-center"
                    style="background-color: rgb(155, 183, 219); border-radius: 25px;">
                    <h3 class="font-weight-bold"> Pneumococcal Conjugate Vaccine (PCV)
                    </h3>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/95/Smallpox_vaccine.jpg" class="img-fluid"
                        alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
