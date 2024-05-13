@extends('layouts.app')
@section('custom-css')
    <style>
        #whyimmunized {
            text-align: justify;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <!-- Left Content -->
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="fw-bold">Schedule the vaccination of your baby today!</h1>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="text-center">
                            <button style="background-color: #cd9f8e; border-radius: 20px" class="btn btn-lg btn-block text-dark">GET SCHEDULE</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center mt-5 align-items-center">
                <img src="/images/image_one.png" width="80%" alt="">
            </div>
        </div>
        {{--  --}}
        <div class="row mt-5"></div>
        <hr>

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="p-5">
                    <h3 class="fw-bolder">Why Immunize your baby?</h3>
                    <p id="whyimmunized">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                        a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of
                        the printing and typesetting industry. Lorem Ipsum is simply dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text.</p>
                </div>
            </div>
            <div class="col-md-4 p-5 justify-content-center align-items-center">
                <img width="100%" src="/images/why_image.png" alt="">
            </div>
        </div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <hr>
        {{--  --}}
        <div class="row p-5">
            <div class="row align-items-center justify-content-center">
                <h3 class="text-center">About Vaccines</h3>
            </div>
           <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#!" class="btn btn-primary">Button</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#!" class="btn btn-primary">Button</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#!" class="btn btn-primary">Button</a>
                        </div>
                      </div>
                </div>
           </div>
           <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#!" class="btn btn-primary">Button</a>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#!" class="btn btn-primary">Button</a>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#!" class="btn btn-primary">Button</a>
                    </div>
                  </div>
            </div>
       </div>
        </div>
    </div>
    @if (session('reg_success'))
        <script>
            window.onload = function() {
                iziToast.success({
                    title: 'Registered',
                    message: 'User Registered Successfully',
                });
            };
        </script>
    @endif
@endsection
