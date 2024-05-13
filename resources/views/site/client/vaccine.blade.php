@extends('site.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div style="background-color: #FDEDD4;" class="alert alert-primary font-weight-bold text-dark">
                Recommended Vaccines and Schedules
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 text-justify">
                <h5 class="font-weight-bold">Vaccines play a crucial role in safeguarding infants from life-threatening
                    diseases, ultimately preserving millions of lives annually.
                </h5>
                <p> <span class="ml-5"></span>For routine vaccines to be effective, it is crucial that infants receive the
                    required doses according to
                    the recommended schedule from birth until their first birthday. Additionally, infants should also
                    receive any
                    necessary additional doses during supplementary vaccination campaigns or outbreak responses as directed
                    by
                    the Department of Health. </p>
            </div>
        </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide mt-3 mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/BCG.png"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/HepatitisB.png"
                    alt="Second slide">
            </div>
            <div class="carousel-item">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/ipv.png"
                    alt="Third slide">
            </div>
            <div class="carousel-item">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/mmr.png"
                    alt="Fourth slide">
            </div>
            <div class="carousel-item">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/opv.png"
                    alt="Fifth slide">
            </div>
            <div class="carousel-item">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/pcv.png"
                    alt="Sixth slide">
            </div>
            <div class="carousel-item">
                <img width="588px" height="700px" class="d-block w-100"
                    src="/images/pentavalent.png"
                    alt="Seventh slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection
